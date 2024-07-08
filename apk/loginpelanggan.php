<?php
require '../mahsiswa/databasekey.php'; 

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Koneksi ke database (gunakan PDO untuk keamanan)
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query untuk mencari pengguna berdasarkan username
        $stmt = $pdo->prepare('SELECT * FROM pelanggan WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Periksa status verifikasi akun
                if ($user['verified'] == 1) {
                    // Akun sudah diverifikasi, set session untuk login
                    $_SESSION['pelanggan_id'] = $user['pelanggan_id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];
        
                    // Redirect ke halaman setelah login sukses
                    header('Location: landingpage.html');
                    exit;
                } elseif ($user['verified'] == 0) {
                    // Akun belum diverifikasi
                    $error_message = "Akun Anda belum diverifikasi oleh admin.";
                } elseif ($user['verified'] == 2) {
                    // Akun tidak lolos verifikasi
                    $error_message = "Akun Anda tidak lolos verifikasi.";
                } else {
                    // Status verifikasi tidak dikenal
                    $error_message = "Status verifikasi akun tidak dikenal.";
                }
            } else {
                // Kombinasi username dan password salah
                $error_message = "Kombinasi username dan password salah.";
            }
        } else {
            $error_message = "Kombinasi username dan password salah.";
        }
        
    } catch(PDOException $e) {
        $error_message = "Koneksi database gagal: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/registrasipelanggan.css">
    <title>Log In</title>
</head>
<body>
    <div class="container">
        <div class="title centered">Log In</div>
        <form id="subscribe-form" method="post" action="" class="subscribe-form">
                <?php if (isset($error_message)) : ?>
                    <p style="color: red; font-style: italic;"><?php echo $error_message; ?></p>
                <?php endif; ?>
            <div class="form-section">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Username" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="centered">
                <button type="submit" name="subscribe">Log In</button>
            </div>
        </form>
        <div class="create-account">Belum punya akun? <a href="../mahsiswa/registrasipelanggan.html">Berlangganan</a></div>
    </div>
</body>
</html>