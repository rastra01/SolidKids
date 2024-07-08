<?php
session_start();

// Pastikan variabel sesi untuk user ID telah diatur
if (!isset($_SESSION['user_id'])) {
    // Jika user_id tidak ada di sesi, Anda bisa mengarahkan pengguna ke halaman login atau menampilkan pesan error
    die("User tidak terautentikasi. Silakan login terlebih dahulu.");
}

$logged_in_user_id = $_SESSION['user_id'];

include 'databasekey.php';

// Validasi dan escape input sebelum digunakan dalam query SQL
$topic_id = intval($_POST['topic_id']);  // Misalnya, mengubah ke integer jika topik ID adalah integer
$title = $conn->real_escape_string($_POST['title']);
$description = $conn->real_escape_string($_POST['description']);
$user_id = $logged_in_user_id; // Menggunakan user_id yang sedang login

// Informasi file video
$video_file = $_FILES['video_file'];
$video_file_name = $conn->real_escape_string($video_file['name']);
$video_file_temp = $video_file['tmp_name'];
$video_file_size = $video_file['size'];

// Direktori tempat menyimpan video di server
$upload_directory = "Video/"; // Ganti dengan direktori penyimpanan yang sesuai

// Membuat nama unik untuk file video
$video_file_path = $upload_directory . uniqid() . "_" . $video_file_name;

// Memindahkan file video ke direktori upload
if (move_uploaded_file($video_file_temp, $video_file_path)) {
    
    // Query untuk menyimpan informasi video ke dalam tabel videos
    $sql_video = "INSERT INTO `videos` (title, description, user_id, video_file)
                  VALUES ('$title', '$description', '$user_id', '$video_file_path')";
    
    if ($conn->query($sql_video) === TRUE) {
        $video_id = $conn->insert_id; // Mendapatkan ID video yang baru saja diunggah
        
        // Query untuk menyimpan relasi antara video dan topik ke dalam tabel video_topics
        $sql_video_topics = "INSERT INTO `video_topics` (video_id, topic_id)
                             VALUES ('$video_id', '$topic_id')";
        
        if ($conn->query($sql_video_topics) === TRUE) {
            echo "Video berhasil diunggah dan terhubung dengan kategori.";
        } else {
            echo "Error: " . $sql_video_topics . "<br>" . $conn->error;
        }
        
    } else {
        echo "Error: " . $sql_video . "<br>" . $conn->error;
    }
    
} else {
    echo "Gagal mengunggah video.";
}

// Menutup koneksi database
$conn->close();
?>
