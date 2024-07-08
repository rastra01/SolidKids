<?php
require '../mahsiswa/databasekey.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil user_id dan action dari form
    $user_id = $_POST['pelanggan_id'];
    $action = $_POST['action'];

    try {
        // Lakukan koneksi ke database
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Lakukan query update untuk mengubah status verifikasi berdasarkan action
        if ($action === 'reject') {
            $stmt = $pdo->prepare('UPDATE pelanggan SET verified = 2 WHERE pelanggan_id = :pelanggan_id');
        } elseif ($action === 'accept') {
            $stmt = $pdo->prepare('UPDATE pelanggan SET verified = 1 WHERE pelanggan_id = :pelanggan_id');
        } else {
            throw new Exception('Aksi tidak dikenal');
        }
        $stmt->execute(['pelanggan_id' => $user_id]);

        // Redirect ke halaman admin setelah verifikasi
        header('Location: cek_pelanggan.php');
        exit;
    } catch (PDOException $e) {
        // Tangani kesalahan jika koneksi atau query gagal
        echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
        // Tangani kesalahan jika aksi tidak dikenal
        echo "Error: " . $e->getMessage();
    }
} else {
    // Jika tidak diakses melalui POST, redirect atau tampilkan pesan kesalahan
    header('Location: cek_pelanggan.php'); // Redirect ke halaman admin jika tidak melalui POST
    exit;
}
?>
