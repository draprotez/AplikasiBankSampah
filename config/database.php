<?php
$host = "127.0.0.1"; // boleh angka dari xampp atau "localhost"
$user = "root";
$pass = "";
$db   = "db_banksampah";

//untuk membuat koneksi dan ambil data variable dari yang atas sesuaikan 
$conn = new mysqli($host, $user, $pass, $db);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>