<?php
session_start();

// Hapus semua variabel sesi
$_SESSION = array();

// Jika diinginkan menghancurkan sesi sama sekali, hapus juga sesi cookie.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Akhir sesi
session_destroy();

// Redirect ke halaman login
header('Location: ../dash/mahsiswa/index.php');
exit;
?>
