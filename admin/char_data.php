<?php 
include '../mahsiswa/databasekey.php';

// Ambil data untuk pie chart
$sql_verified = "
    SELECT verified, COUNT(*) as count 
    FROM users 
    GROUP BY verified
";
$stmt_verified = $conn->prepare($sql_verified);
$stmt_verified->execute();
$result_verified = $stmt_verified->get_result();

$verifiedData = [
    'Verified' => 2,
    'Not Verified' => 1
];

if ($result_verified->num_rows > 0) {
    while ($row = $result_verified->fetch_assoc()) {
        if ($row['verified'] == 1) {
            $verifiedData['Not Verified'] = $row['count'];
        } else {
            $verifiedData['Verified'] = $row['count'];
        }
    }
} else {
    echo "0 results";
}

// Ambil data untuk bar chart
$sql_videos = "
    SELECT DATE(upload_date) AS upload_day, COUNT(*) AS total_videos
    FROM videos
    GROUP BY DATE(upload_date)
    ORDER BY upload_day
";
$stmt_videos = $conn->prepare($sql_videos);
$stmt_videos->execute();
$result_videos = $stmt_videos->get_result();

$upload_days = [];
$total_videos = [];

if ($result_videos->num_rows > 0) {
    while ($row = $result_videos->fetch_assoc()) {
        $upload_days[] = $row["upload_day"];
        $total_videos[] = $row["total_videos"];
    }
} else {
    echo "0 results"; 
}

$stmt_verified->close();
$stmt_videos->close();
$conn->close();

$data = [
    'pieChart' => $verifiedData,
    'barChart' => [
        'labels' => $upload_days,
        'datasets' => [
            [
                'label' => "Total Videos",
                'backgroundColor' => "rgba(60,141,188,0.9)",
                'borderColor' => "rgba(60,141,188,0.8)",
                'data' => $total_videos,
            ]
        ]
    ]
];

echo json_encode($data);
?>
