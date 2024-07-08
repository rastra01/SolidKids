<?php
include 'databasekey.php'; // Menyertakan file koneksi database di atas

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $child_name = $_POST['child_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Mengenkripsi password
    $parent_agreement = isset($_POST['parent_agreement']) ? 1 : 0;

    // Mengambil data file bukti transfer
    $proof_photo = $_FILES['proof_photo'];
    $file_name = $proof_photo['name'];
    $file_tmp = $proof_photo['tmp_name'];
    $file_size = $proof_photo['size'];
    $file_type = $proof_photo['type'];
    $file_data = file_get_contents($file_tmp);

    // Memasukkan data pengguna ke dalam tabel `users`
    $stmt = $conn->prepare("INSERT INTO pelanggan (full_name, email, username, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $child_name, $email, $username, $password);

    if ($stmt->execute()) {
        $user_id = $stmt->insert_id; // Mendapatkan ID pengguna yang baru saja ditambahkan

        // Memasukkan bukti transfer ke dalam tabel `transaction_receipts`
        $stmt = $conn->prepare("INSERT INTO buktitransfer (file_name, file_data, file_size, file_type, pelanggan_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisi", $file_name, $file_data, $file_size, $file_type, $user_id);

        if ($stmt->execute()) {
            echo "Pendaftaran dan upload bukti transfer sedang diproses.";
        } else {
            echo "Gagal menyimpan bukti transfer: " . $stmt->error;
        }
    } else {
        echo "Gagal menyimpan data pengguna: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
