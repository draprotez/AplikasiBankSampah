<?php
session_start(); //untuk memulai session
include '../config/database.php'; //untuk ke database

//untuk ambil data dari form login.php
$username = $_POST['username'];
$password = $_POST['password'];

//untuk mencari query admin berdasarkan username DAN password
$sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

//untuk mengecek apakah admin ditemukan (hasil query > 0)
if ($result->num_rows > 0) {
    //jika memiliki user akan bisa login
    $admin = $result->fetch_assoc();
    $_SESSION['username'] = $admin['username'];
    $_SESSION['nama_admin'] = $admin['nama_admin'];
    $_SESSION['is_logged_in'] = true;
    
    //untuk ke halaman login
    header("Location: ../views/dashboardAdmin.php");
    exit();
} else {
    //jika data tidak ada akan menampilkan ini dan kembali ke halaman login
    header("Location: ../login.php?error=Username atau password salah!");
    exit();
}
?>