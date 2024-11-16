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
$sql = "SELECT id FROM antrian WHERE tanggal = ? AND loket = ? AND nomor_antrian = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $tanggal, $loket, $nomorAntrian);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // Simpan data baru
    $insertSql = "INSERT INTO antrian (tanggal, loket, nomor_antrian, status) VALUES (?, ?, ?, 'dipanggil')";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("sii", $tanggal, $loket, $nomorAntrian);

    if ($insertStmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Nomor antrian disimpan.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan nomor antrian.']);
    }
    $insertStmt->close();
} else {
    // Update status jika nomor sudah ada
    $updateSql = "UPDATE antrian SET status = 'dipanggil' WHERE tanggal = ? AND loket = ? AND nomor_antrian = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("sii", $tanggal, $loket, $nomorAntrian);

    if ($updateStmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Nomor antrian diperbarui.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui nomor antrian.']);
    }
    $updateStmt->close();
}

$stmt->close();
$conn->close();
?>
