<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'database_antrian');

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Loket yang ingin ditampilkan
$loket = 1;

// Nomor antrian saat ini (status 'sedang')
$current_result = $conn->query("
    SELECT nomor_antrian 
    FROM antrian 
    WHERE tanggal = CURDATE() AND loket = $loket AND status = 'sedang' 
    LIMIT 1
");
$current_antrian = $current_result->num_rows > 0 ? $current_result->fetch_assoc()['nomor_antrian'] : '-';

// Nomor antrian berikutnya (status 'belum')
$next_result = $conn->query("
    SELECT nomor_antrian 
    FROM antrian 
    WHERE tanggal = CURDATE() AND loket = $loket AND status = 'belum' 
    ORDER BY nomor_antrian ASC 
    LIMIT 1
");
$next_antrian = $next_result->num_rows > 0 ? $next_result->fetch_assoc()['nomor_antrian'] : '-';

// Total antrian yang belum dipanggil
$total_result = $conn->query("
    SELECT COUNT(*) AS total 
    FROM antrian 
    WHERE tanggal = CURDATE() AND loket = $loket AND status = 'belum'
");
$total_antrian = $total_result->fetch_assoc()['total'];

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor Antrian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid p-3 bg-success text-white">
        <h3>Monitor Antrian Pendaftaran</h3>
        <p>Loket <?= $loket ?> | Tanggal: <?= date('d M Y') ?></p>
    </div>

    <div class="container mt-3">
        <div class="row">
            <!-- Video -->
            <div class="col-md-8">
                <iframe width="100%" height="400" src="https://www.youtube.com/embed/dummy-video-id" frameborder="0" allowfullscreen></iframe>
            </div>
            <!-- Antrian -->
            <div class="col-md-4">
                <div class="card mb-3 text-center">
                    <div class="card-header bg-info text-white">NOMOR ANTRIAN SEKARANG</div>
                    <div class="card-body">
                        <h1 class="display-3"><?= $current_antrian ?></h1>
                    </div>
                </div>
                <div class="card mb-3 text-center">
                    <div class="card-header bg-warning text-white">ANTRIAN SELANJUTNYA</div>
                    <div class="card-body">
                        <h1 class="display-4"><?= $next_antrian ?></h1>
                    </div>
                </div>
                <div class="card text-center">
                    <div class="card-header bg-primary text-white">TOTAL ANTRIAN</div>
                    <div class="card-body">
                        <h1 class="display-5"><?= $total_antrian ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="container-fluid text-center mt-5 p-3 bg-success text-white">
        <p>Selamat datang di sistem antrian loket <?= $loket ?></p>
    </footer>
</body>
</html>
