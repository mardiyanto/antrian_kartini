<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "database_antrian";
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$tanggal = date('Y-m-d');
$loket = isset($_GET['loket']) ? intval($_GET['loket']) : 1;

// Ambil nomor antrian terakhir untuk loket
$sql = "SELECT nomor_antrian FROM antrian WHERE tanggal = '$tanggal' AND loket = $loket ORDER BY nomor_antrian DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(['last_antrian' => intval($row['nomor_antrian'])]);
} else {
    echo json_encode(['last_antrian' => 0]); // Mulai dari 0 jika belum ada
}

$conn->close();
?>