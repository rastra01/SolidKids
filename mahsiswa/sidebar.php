<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <title>Document</title>
</head>
<body>
<div class="sidebar">
    <div class="brand">
        <img src="../foto/logo4.png" alt="logo">
    </div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="Dashbordmahasiswa.php" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="Riwayat.php" class="nav-link">
                    <i class="fas fa-history"></i>&nbsp;&nbsp;
                    <p>Riwayat Konten</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="upload.php" class="nav-link">
                    <i class="fas fa-upload"></i>&nbsp;&nbsp;
                    <p>Upload Konten</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="setting.php" class="nav-link">
                    <i class="fas fa-cogs"></i>&nbsp;&nbsp;
                    <p>Pengaturan</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- <div class="help-center">
        <a href="#">
            <i class="fas fa-question-circle"></i>&nbsp;
            <p>Help Center</p>
        </a>
    </div> -->
    <div class="logout">
        <a href="../logout.php" class="text-red">
            <i class="fas fa-power-off"></i>&nbsp;
            <p>Logout</p>
        </a>
    </div>
</div>

</body>
</html>
