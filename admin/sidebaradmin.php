<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sidebar.css">
    <title>Document</title>
</head>
<body>
<div class="sidebar">
            <div class="brand">
                <img src="../foto/logo4.png" alt="logo">
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="../admin/index_admin.php" class="nav-link">
                            <i class="fa-solid fa-gauge"></i>&nbsp;&nbsp;
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../mahsiswa/cek_konten.php" class="nav-link">
                            <i class="fa-solid fa-check"></i>&nbsp;&nbsp;
                            <p>Cek Konten</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../admin/cek_pelanggan.php" class="nav-link">
                            <i class="fa-solid fa-user-check"></i>&nbsp;&nbsp;
                            <p>Cek Pelanggan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../admin/cek_mahasiswa.php" class="nav-link">
                            <i class="fa-solid fa-file"></i>&nbsp;&nbsp;&nbsp;
                            <p>Cek Mahasiswa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../admin/setting.php" class="nav-link text-">
                            <i class="fa-solid fa-gears"></i>&nbsp;&nbsp;
                            <p>Pengaturan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../logout.php" class="nav-link text-red">
                            <i class="nav-icon fas fa-power-off"></i>&nbsp;
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
</body>
</html>