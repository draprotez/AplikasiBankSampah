<?php
session_start();

include '../config/database.php';
include '../models/adminModels.php';
if (isset($_POST['register_admin'])) {
    $nama_admin = $_POST['nama_admin'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($nama_admin) || empty($username) || empty($password)) {
        header("Location: ../views/registerAdminViews.php?error=Semua field wajib diisi!");
        exit();
    }

    if ($password !== $confirm_password) {
        header("Location: ../views/registerAdminViews.php?error=Password dan Konfirmasi Password tidak cocok!");
        exit();
    }
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $data = [
        'nama_admin' => $nama_admin,
        'username' => $username,
        'password_hashed' => $password_hashed
    ];
    $result = insertAdmin($conn, $data);
    if ($result === true) {
        header("Location: ../login.php?success=Registrasi admin berhasil! Silakan login.");
    } else {
        header("Location: ../views/registerAdminViews.php?error=" . urlencode($result));
    }
    exit();

} else {
    header("Location: ../views/registerAdminViews.php");
    exit();
}
?>