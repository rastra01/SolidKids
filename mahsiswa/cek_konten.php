<?php 

include "../mahsiswa/databasekey.php";

try {
    // Membuat koneksi PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
    // Atur mode error untuk PDO agar dilemparkan sebagai pengecualian
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Query SQL menggunakan PDO
    $query = "SELECT videos.*, topics.name AS topic_name FROM videos 
              LEFT JOIN video_topics ON videos.video_id = video_topics.video_id
              LEFT JOIN topics ON video_topics.topic_id = topics.topic_id
              WHERE videos.verified = 0";
    
    // Menyiapkan statement PDO
    $stmt = $pdo->prepare($query);
    
    // Mengeksekusi statement
    $stmt->execute();
    
    // Mengambil hasil query
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // Tangani kesalahan koneksi atau eksekusi query
    die("Koneksi gagal: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Document</title>
</head>

<body>
    <div class="container">
        <?php include '../admin/sidebaradmin.php';?>
        <div class="content">
            <div class="header">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Cek Konten</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index_admin.php">Home</a></li>
                            <li class="breadcrumb-item active">Cek Konten</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
            <div class="main">
                <section>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kategori</th>
                                                    <th>Judul Video</th>
                                                    <th>Deskripsi Video</th>
                                                    <th>Tanggal Upload</th>
                                                    <th>Video</th>
                                                    <th>Cek Konten</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($result as $row): ?>
                                            <tr>
                                                <td><?php echo $row['video_id']; ?></td>
                                                <td><?php echo $row['topic_name']; ?></td>
                                                <td><?php echo $row['title']; ?></td>
                                                <td><?php echo $row['description']; ?></td>
                                                <td><?php echo $row['upload_date']; ?></td>
                                                <td>
                                                <?php if (file_exists($row['video_file'])): ?>
                                                <video width="320" height="240" controls>
                                                <source src="<?php echo $row['video_file']; ?>" type="video/mp4">
                                                Your browser does not support the video tag.
                                                </video>
                                                <?php else: ?>
                                                <p>Video tidak ditemukan</p>
                                                <?php endif; ?>
                                                </td>
                                                <td>
                                                <button class="btn-sm btn-primary" style="width:70px;" onclick="verifyVideo(<?php echo $row['video_id']; ?>)">Terima</button>
                                                |
                                                <button class="btn-sm btn-danger" style="width:70px;" onclick="rejectVideo(<?php echo $row['video_id']; ?>)">Tolak</button>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <script>
        function verifyVideo(videoId) {
            fetch('../admin/verifikasi_konten.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'video_id=' + videoId + '&action=accept'
            })
            .then(response => {
                if (response.ok) {
                    // Redirect atau tindakan lain setelah berhasil
                    window.location.href = 'cek_konten.php';
                } else {
                    // Handle error
                    console.error('Gagal melakukan verifikasi');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function rejectVideo(videoId) {
            fetch('../admin/verifikasi_konten.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'video_id=' + videoId + '&action=reject'
            })
            .then(response => {
                if (response.ok) {
                    // Redirect atau tindakan lain setelah berhasil
                    window.location.href = 'cek_konten.php';
                } else {
                    // Handle error
                    console.error('Gagal melakukan verifikasi');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
            <footer>
                <strong> <a href="#">Solid Kids</a></strong>
                <div class="float-right d-none d-sm-inline-block">
                    <a href="#"><b>solidkids@gmail.com</b></a>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>