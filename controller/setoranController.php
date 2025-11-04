<?php
session_start();
include '../config/database.php';
include '../models/sampahModels.php';
include '../models/setoranModels.php';

if (!isset($_SESSION['is_logged_in'])) { die("ERROR: Akses tidak sah!"); }

if (isset($_POST['tambah_setoran'])) {
    
    // Ambil data dari form
    $id_user = $_POST['id_user'];
    $id_jenis = $_POST['id_jenis'];
    $berat_kg = (float)$_POST['berat_kg'];
    $tanggal_setor = $_POST['tanggal_setor'];

    // Ambil harga per kg dari model sampah
    $sampah = getSampahById($conn, $id_jenis);
    if (!$sampah) {
        header("Location: ../views/kelolaSetoranViews.php?error=Jenis sampah tidak valid!");
        exit();
    }
    $harga_per_kg = (float)$sampah['harga_per_kg'];

    // LOGIKA INTI: Hitung total harga
    $total_harga = $berat_kg * $harga_per_kg;

    // Siapkan data untuk model setoran
    $data = [
        'id_user' => $id_user,
        'id_jenis' => $id_jenis,
        'berat_kg' => $berat_kg,
        'total_harga' => $total_harga,
        'tanggal_setor' => $tanggal_setor
    ];

    // Panggil model untuk insert
    $result = insertSetoran($conn, $data);

    if ($result) {
        header("Location: ../views/kelolaSetoranViews.php?success=Setoran baru berhasil ditambahkan!");
    } else {
        header("Location: ../views/kelolaSetoranViews.php?error=Gagal menambahkan setoran!");
    }
    exit();

} else {
    header("Location: ../views/dashboardAdmin.php");
    exit();
}
?>