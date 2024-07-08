<?php 
require '../mahsiswa/databasekey.php';

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query untuk mendapatkan daftar pengguna yang belum diverifikasi
    $stmt = $pdo->prepare('SELECT * FROM pelanggan WHERE verified = 0');
    $stmt->execute();
    $pelanggan = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Koneksi database gagal: " . $e->getMessage();
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

    <title>Document</title>
</head>

<body>
    <div class="container">
        <?php include 'sidebaradmin.php';?>
        <div class="content">
            <div class="header">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Cek Pelanggan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index_admin.php">Home</a></li>
                            <li class="breadcrumb-item active">Cek Pelanggan</li>
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
                                                    <th>Nama Lengkap</th>
                                                    <th>Email</th>
                                                    <th>username</th>
                                                    <th>Tanggal Pembuatan</th>
                                                    <th>Bukti Transfer</th>
                                                    <th>Terima | Tolak</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pelanggan as $user): ?>
                                                <tr>
                                                    <td width="5%">
                                                        <?php echo $user['pelanggan_id']; ?>
                                                    </td>
                                                    <td><?php echo $user['full_name']; ?></td>
                                                    <td><?php echo $user['email']; ?></td>
                                                    <td><?php echo $user['username']; ?></td>
                                                    <td><?php echo $user['created_at']; ?></td>
                                                    <td><img src="proses_transfer.php?id=<?php echo $user['pelanggan_id']; ?>" width="100px"></td>
                                                    <td width="15%">
                                                        <button class="btn-sm btn-primary" style="width:70px;" onclick="verifyUser(<?php echo $user['pelanggan_id']; ?>)">Terima</button>
                                                        |
                                                        <button class="btn-sm btn-danger" 
                                                            style="width:70px" onclick="rejectUser(<?php echo $user['pelanggan_id']; ?>)">Tolak</button>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <script>
                                                function verifyUser(userId) {
                                                    fetch('Verifikasi_pelanggan.php', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/x-www-form-urlencoded',
                                                        },
                                                        body: 'pelanggan_id=' + userId + '&action=accept'
                                                    })
                                                    .then(response => {
                                                        if (response.ok) {
                                                            // Redirect atau tindakan lain setelah berhasil
                                                            window.location.href = 'cek_pelanggan.php';
                                                        } else {
                                                            // Handle error
                                                            console.error('Gagal melakukan verifikasi');
                                                        }
                                                    })
                                                    .catch(error => {
                                                        console.error('Error:', error);
                                                    });
                                                }
                                                    
                                                function rejectUser(userId) {
                                                    fetch('Verifikasi_pelanggan.php', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/x-www-form-urlencoded',
                                                        },
                                                        body: 'pelanggan_id=' + userId + '&action=reject'
                                                    })
                                                    .then(response => {
                                                        if (response.ok) {
                                                        // Redirect atau tindakan lain setelah berhasil
                                                            window.location.href = 'cek_pelanggan.php';
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