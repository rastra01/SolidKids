<?php 
include '../mahsiswa/databasekey.php';

$id = $_GET['id'];

// Debug: Periksa ID yang diterima
if (!$id) {
    die("No ID provided");
}

$sql = "SELECT file_data, file_type FROM photos WHERE user_id = ? AND photo_type = 'document'";
$stmt = $conn->prepare($sql);

// Debug: Periksa kesalahan SQL
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($file_data, $file_type);
$stmt->fetch();
$stmt->close();
$conn->close();

// Debug: Periksa apakah data ditemukan
if (!$file_data) {
    die("No image found for user ID: " . htmlspecialchars($id));
}

header("Content-type: $file_type");
echo $file_data;
?>