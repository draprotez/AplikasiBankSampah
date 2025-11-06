<?php
$host = "sql101.infinityfree.com";
$user = "if0_40315014";
$pass = "IxeCmqGR1v4rQw";
$db   = "IxeCmqGR1v4rQw";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>
