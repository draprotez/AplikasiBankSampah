<?php
session_start();
include '../config/database.php';
include '../models/kelolaNasabahModels.php';

// Keamanan: Pastikan hanya admin yang login yang bisa menjalankan ini
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    die("ERROR: Akses tidak sah!");
}

// 1. Ambil ID dari URL
if (isset($_GET['id'])) {
    $id_user = $_GET['id'];

    // 2. Panggil Model untuk hapus data
    $result = deleteUser($conn, $id_user);

    // 3. Arahkan kembali ke View berdasarkan hasil
    if ($result === true) {
        header("Location: ../views/kelolaNasabahViews.php?success=Nasabah berhasil dihapus!");
    } else {
        header("Location: ../views/kelolaNasabahViews.php?error=" . urlencode($result));
    }
    exit();

} else {
    // Jika ID tidak ada, tendang kembali
    header("Location: ../views/kelolaNasabahViews.php?error=ID Nasabah tidak ditemukan!");
    exit();
}
?>