<?php 
session_start();

// Pastikan variabel sesi untuk user ID telah diatur
if (!isset($_SESSION['user_id'])) {
    die("User tidak terautentikasi. Silakan login terlebih dahulu.");
}

$logged_in_user_id = $_SESSION['user_id'];

include 'databasekey.php'; // Pastikan file ini berisi koneksi ke database

$sql = "
    SELECT v.video_id, v.title, v.description, v.upload_date, v.verified, t.name AS category_name, v.video_file 
    FROM videos v
    JOIN video_topics vt ON v.video_id = vt.video_id
    JOIN topics t ON vt.topic_id = t.topic_id
    WHERE v.user_id = ? AND v.verified IN (1, 2)
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $logged_in_user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/style.css">
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
                                                    <th>Status Konten</th>

                                                </tr>
                                            </thead>
                                            <tbody>
            <?php
            if ($result->num_rows > 0) {
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    $status = $row["verified"] == 1 ? "Lolos verifikasi" : "Tidak lolos verifikasi";
                    echo "<tr>
                            <td width='5%'>" . $no++ . "</td>
                            <td>" . htmlspecialchars($row["category_name"]) . "</td>
                            <td>" . htmlspecialchars($row["title"]) . "</td>
                            <td>" . htmlspecialchars($row["description"]) . "</td>
                            <td>" . date("d M Y", strtotime($row["upload_date"])) . "</td>
                            <td>";
                    if ($row['video_file']) {
                        echo '<video width="320" height="240" controls>
                                <source src="' . htmlspecialchars($row['video_file']) . '" type="video/mp4">
                                Your browser does not support the video tag.
                              </video>';
                    } else {
                        echo '<p>Video tidak ditemukan</p>';
                    }
                    echo "</td>
                            <td width='15%'>" . htmlspecialchars($status) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
            }
            $stmt->close();
            $conn->close();
            ?>
        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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

</body>

</html>