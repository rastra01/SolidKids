<?php
require 'databasekey.php'; 

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Koneksi ke database (gunakan PDO untuk keamanan)
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query untuk mencari pengguna berdasarkan username
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Periksa status verifikasi akun
                if ($user['verified'] == 1) {
                    // Akun sudah diverifikasi, set session untuk login
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];
        
                    // Redirect ke halaman setelah login sukses
                    header('Location: Dashbordmahasiswa.php');
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
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="container">
        <div class="form-image">
            <img src="../img/login3.gif" alt="Side Image" style="width: 600px; height: 600px">
        </div>
        <div class="login-form">
            <h2 align="center" style="border-radius: 7px;">Log in</h2>
            <form id="login-form" method="post" action="">
                <?php if (isset($error_message)) : ?>
                <p style="color: red; font-style: italic;"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <label for="username">Username</label><br>
                <input type="text" id="username" name="username" placeholder="Username" required><br><br>
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" placeholder="Password" required><br>
                <!-- <div class="forgot-password">Forgot Password?</div> -->
                <button type="submit" name="login" class="text">Log in</button><br><br>
            </form>
            <div class="create-account">Not Registered Yet? <a href="registrasi.php">Create an account</a></div>
        </div>
    </div>
</body>

</html>