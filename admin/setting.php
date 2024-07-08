<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/setting.css">
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
                        <h1 class="m-0">Pengaturan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index_admin.php">Home</a></li>
                            <li class="breadcrumb-item active">pengaturan</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
            <div class="main">
                <div class="card">
                    <!-- <div class="profile-img">
                        <img src="https://via.placeholder.com/100" alt="Profile Picture">
                    </div> -->
                    <div class="profile-name"></div>
                    <div class="profile-role"></div>
                    <div class="profile-info">
                        <p><strong>Email:</strong></p>
                        <p><strong>Phone:</strong></p>
                        <p><strong>Location:</strong></p>
                    </div>
                </div>
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