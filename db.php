<?php
$host = 'localhost';
$dbname = 'antrian_system';
$username = 'root';
$password = '';

// Koneksi ke MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Cek apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
