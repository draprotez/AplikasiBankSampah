<?php
session_start();
include '../config/database.php';
include '../models/setoranModels.php';

if (!isset($_SESSION['is_logged_in'])) { die("ERROR: Akses tidak sah!"); }

if (isset($_GET['id'])) {
    $id_setoran = $_GET['id'];
    
    $result = deleteSetoran($conn, $id_setoran);

    if ($result) {
        header("Location: ../views/kelolaSetoranViews.php?success=Setoran berhasil dihapus!");
    } else {
        header("Location: ../views/kelolaSetoranViews.php?error=Gagal menghapus setoran!");
    }
    exit();

} else {
    header("Location: ../views/kelolaSetoranViews.php?error=ID Setoran tidak valid!");
    exit();
}
?>