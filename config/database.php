<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "db_banksampah";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>