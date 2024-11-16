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

// Ambil data nomor terakhir yang sedang dipanggil untuk setiap loket
$sql = "
    SELECT loket, nomor_antrian, waktu_panggilan 
    FROM antrian 
    WHERE waktu_panggilan IN (
        SELECT MAX(waktu_panggilan) 
        FROM antrian 
        WHERE status = 'dipanggil' 
        GROUP BY loket
    )
    ORDER BY loket ASC
";

$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Return data dalam format JSON
header("Content-Type: application/json");
echo json_encode($data);

$conn->close();
?>

