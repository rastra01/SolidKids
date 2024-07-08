<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/graph.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Document</title>
</head>

<body>
    <div class="container">
        <?php include 'sidebaradmin.php';?>
        <div class="content">
            <div class="header">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li>
                                <h1>Administrasi
                                </h1>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
            <div class="main">
                <div class="card-container">
                    <div class="card">
                        <div class="judul" style="background-color: #9195f6">
                            <h2>Status Verifikasi Konten Kreator</h2>
                        </div>
                        <div class="grafik">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                    <div class="card">
                        <div class="judul" style="background-color: #E0BB20">
                            <h2>Jumlah Video Bulan Ini</h2>
                        </div>
                        <div class="grafik">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                    <!-- <div class="card">
                        <div class="judul" style="background-color: #9195f6">
                            <h2>Pendapatan Website</h2>
                        </div>
                        <div class="grafik">
                            <canvas id="barChart2"></canvas>
                        </div>
                    </div>
                    <div class="card">
                        <div class="judul" style="background-color: #E0BB20">
                            <h2>Mahasiswa Aktif</h2>
                        </div>
                        <div class="grafik">
                            <canvas id="barChart3"></canvas>
                        </div>
                    </div> -->
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

    <script>
     document.addEventListener("DOMContentLoaded", function() {
            // Ambil data dari PHP menggunakan fetch atau XHR
            fetch('char_data.php')
                .then(response => response.json())
                .then(data => {
                    // Pie Chart
                    const pieCtx = document.getElementById('pieChart').getContext('2d');
                    const myPieChart = new Chart(pieCtx, {
                        type: 'pie',
                        data: {
                            labels: ['Verified', ' Not Verified'],
                            datasets: [{
                                data: [data.pieChart['Not Verified'], data.pieChart['Verified']],
                                backgroundColor: ['#36A2EB', '#FF6384']
                            }]
                        },
                        options: {
                            responsive: true,
                            title: {
                                display: true,
                                text: 'Verified vs Not Verified Users'
                            }
                        }
                    });

                    // Bar Chart
                    const barCtx = document.getElementById('barChart').getContext('2d');
                    const barChart = new Chart(barCtx, {
                        type: 'line',
                        data: {
                            labels: data.barChart.labels, // Label (misal: bulan)
                            datasets: data.barChart.datasets // Dataset (misal: pendapatan)
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    // Pie Chart
   

    // Bar Chart 2
    const barCtx2 = document.getElementById('barChart2').getContext('2d');
    const barChart2 = new Chart(barCtx2, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: "Pendapatan",
                backgroundColor: "rgba(60,141,188,0.9)",
                borderColor: "rgba(60,141,188,0.8)",
                pointRadius: false,
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: [100000, 50000, 40000, 190000, 86000, 270000],
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Bar Chart 3
    const barCtx3 = document.getElementById('barChart3').getContext('2d');
    const barChart3 = new Chart(barCtx3, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: "Aktif",
                backgroundColor: "rgba(60,141,188,0.9)",
                borderColor: "rgba(60,141,188,0.8)",
                pointRadius: false,
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: [7, 5, 8, 9, 10, 7],
            }, {
                label: "Tidak Aktif",
                backgroundColor: "rgba(210, 214, 222, 1)",
                borderColor: "rgba(210, 214, 222, 1)",
                pointRadius: false,
                pointColor: "#3b8bba",
                pointStrokeColor: "#c1c7d1",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [10, 2, 4, 1, 8, 5],
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    </script>
</body>
</html>