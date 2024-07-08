<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/upload.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <title>Document</title>
</head>
<body>
    <div class="container">
       <?php include 'sidebar.php';?>
        <div class="content">
            <div class="header">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Riwayat Konten</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index_admin.php">Home</a></li>
                            <li class="breadcrumb-item active">Riwayat Konten</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
            <div class="main">
                <section>
                    <div class="upload-container">
                        <h2>Upload Video</h2>
                        <form id="uploadForm" action="proces_upload.php" method="POST" enctype="multipart/form-data">
    <label for="kategori">Kategori</label>
    <select class="form-control" name="topic_id" id="topic_id" required>
        <option value="" disabled selected>-Pilih Kategori-</option>
        <option value="1">Angka & Huruf</option>
        <option value="2">Warna & Bentuk</option>
        <option value="3">Musik & Bernyanyi</option>
    </select><br><br>
    <label for="judul">Judul Video</label>
    <input type="text" id="title" name="title" placeholder="Masukkan Judul Video" required><br><br>
    <label for="deskripsi">Deskripsi</label>
    <input type="text" id="description" name="description" placeholder="Masukkan Deskripsi Video" required><br><br>
    <label for="videoFile">File Video</label>
    <input type="file" id="videoFile" name="video_file" required><br><br>
    <button type="submit">Upload</button>
</form>

                        <div class="preview" id="preview"></div>
                    </div>
                </section>
            </div>
            <footer>
                <strong> <a href="#">Solid Kids</a></strong>
                <div class="float-right d-none d-sm-inline-block">
                    <a href="#"><b>solidkids@gmail.com</b></a>
                </div>
            </footer>
        </div>
    </div>

    <script>
    function uploadVideo() {
        const name = document.getElementById('name').value;
        const date = document.getElementById('date').value;
        const videoFile = document.getElementById('videoFile').files[0];
        const preview = document.getElementById('preview');

        if (name && date && videoFile) {
            const videoUrl = URL.createObjectURL(videoFile);
            preview.innerHTML = `<p><strong>Name:</strong> ${name}</p>
                                     <p><strong>Date:</strong> ${date}</p>
                                     <video controls>
                                        <source src="${videoUrl}" type="${videoFile.type}">
                                        Your browser does not support the video tag.
                                     </video>`;
        } else {
            preview.innerHTML = "Please fill in all fields and select a video.";
        }
    }
    </script>
</body>

</html>