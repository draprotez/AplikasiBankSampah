<?php
session_start();
include '../config/database.php';
include '../models/sampahModels.php';
if (!isset($_SESSION['is_logged_in'])) { die("ERROR: Akses tidak sah!"); }
$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
// case create
    case 'create':
        if (isset($_POST['nama_jenis'])) {
            $data = [
                'nama_jenis' => $_POST['nama_jenis'],
                'kategori' => $_POST['kategori'],
                'harga_per_kg' => $_POST['harga_per_kg']
            ];
            $result = insertSampah($conn, $data);
            if ($result) {
                header("Location: ../views/kelolaSampahViews.php?success=Jenis sampah baru berhasil ditambahkan!");
            } else {
                header("Location: ../views/kelolaSampahViews.php?error=Gagal menambahkan data!");
            }
        }
        break;
// case update
    case 'update':
        if (isset($_POST['id_jenis'])) {
            $data = [
                'id_jenis' => $_POST['id_jenis'],
                'nama_jenis' => $_POST['nama_jenis'],
                'kategori' => $_POST['kategori'],
                'harga_per_kg' => $_POST['harga_per_kg']
            ];
            $result = updateSampah($conn, $data);
            if ($result) {
                header("Location: ../views/kelolaSampahViews.php?success=Data sampah berhasil diupdate!");
            } else {
                header("Location: ../views/kelolaSampahViews.php?error=Gagal mengupdate data!");
            }
        }
        break;
// case delete
    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = deleteSampah($conn, $id);
            if ($result) {
                header("Location: ../views/kelolaSampahViews.php?success=Data sampah berhasil dihapus!");
            } else {
                header("Location: ../views/kelolaSampahViews.php?error=Gagal menghapus data! Kemungkinan karena jenis sampah ini sudah dipakai di data setoran.");
            }
        }
        break;
    default:
        header("Location: ../views/kelolaSampahViews.php");
        break;
}

exit();
?>