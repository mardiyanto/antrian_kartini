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

// Ambil data dari request JSON
$data = json_decode(file_get_contents("php://input"), true);
$loket = intval($data['loket']);
$nomorAntrian = intval($data['antrian']);
$tanggal = date('Y-m-d');

// Periksa apakah antrian sudah ada di database
$sql = "SELECT * FROM antrian WHERE tanggal = '$tanggal' AND loket = $loket AND nomor_antrian = $nomorAntrian";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    // Simpan data baru
    $insertSql = "INSERT INTO antrian (tanggal, loket, nomor_antrian, status) VALUES ('$tanggal', $loket, $nomorAntrian, 'sudah')";
    if ($conn->query($insertSql) === TRUE) {
        echo json_encode(['message' => 'Nomor antrian disimpan.']);
    } else {
        echo json_encode(['message' => 'Gagal menyimpan nomor antrian.']);
    }
} else {
    echo json_encode(['message' => 'Nomor antrian sudah ada di database.']);
}

$conn->close();
?>
