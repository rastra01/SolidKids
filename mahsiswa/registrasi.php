<?php
require 'databasekey.php';

function uploadPhoto($user_id, $photo_type, $file) {
    global $conn;

    $file_name = $file['name'];
    $file_size = $file['size'];
    $file_type = $file['type'];
    $file_data = file_get_contents($file['tmp_name']);

    $sql = "INSERT INTO photos (file_name, file_data, file_size, file_type, photo_type, user_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssissi", $file_name, $file_data, $file_size, $file_type, $photo_type, $user_id);
    $stmt->execute();
    $stmt->close();
}

// Cek apakah ada data yang dikirim melalui form registrasi
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_photo']) && isset($_FILES['document_photo'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $universitas = $_POST['universitas'];
    $angkatan = $_POST['angkatan'];
    $namalengkap = $_POST['nama_lengkap'];

    // Insert data pengguna ke tabel users
    $sql = "INSERT INTO users (username, password, email, universitas, angkatan,nama_lengkap) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssis",$username, $password, $email, $universitas, $angkatan,$namalengkap);
    $stmt->execute();
    $user_id = $stmt->insert_id;
    $stmt->close();

    // Upload foto profil
    uploadPhoto($user_id, 'profile', $_FILES['profile_photo']);

    // Upload foto dokumen
    uploadPhoto($user_id, 'document', $_FILES['document_photo']);

    header("Location: index.php");
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/registrasi.css">
    <title>Form Registrasi</title>
</head>
<body>
    <div class="container">
        <div class="title centered">Form Registrasi</div>
        <form id="register-form" method="post" action="" enctype="multipart/form-data" class="register-form">
            <div class="form-section">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" required>
                
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Username" required>
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-section">
                <label for="universitas">Universitas</label>
                <input type="text" id="universitas" name="universitas" placeholder="Universitas" required>

                <label for="angkatan">Angkatan</label>
                <input type="number" id="angkatan" name="angkatan" placeholder="Angkatan" required>
                
                <label for="profile_photo">Foto Profil:</label>
                <input type="file" name="profile_photo" id="profile_photo" required>

                <label for="document_photo">Foto Dokumen:</label>
                <input type="file" name="document_photo" id="document_photo" required>
            </div>
            <div class="centered">
                <button type="submit" name="register">Register</button>
            </div>
        </form>
    </div>
</body>
</html>