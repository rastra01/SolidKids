<?php
$user = 'root';
$pass = '';
$dbname = 'test';
$servername = 'localhost';

$conn = mysqli_connect($servername, $user, $pass, $dbname);
if (!$conn) {
    die("koneksi gagal: " . mysqli_connect_error());
}
?>