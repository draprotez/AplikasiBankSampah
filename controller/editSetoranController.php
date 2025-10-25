<?php
session_start();
include '../config/database.php';
include '../models/sampahModels.php';
include '../models/setoranModels.php';

if (!isset($_SESSION['is_logged_in'])) { die("ERROR: Akses tidak sah!"); }

if (isset($_POST['update_setoran'])) {
    
    // 1. Ambil data dari form
    $id_setoran = $_POST['id_setoran'];
    $id_user = $_POST['id_user'];
    $id_jenis = $_POST['id_jenis'];
    $berat_kg = (float)$_POST['berat_kg'];
    $tanggal_setor = $_POST['tanggal_setor'];

    // 2. Ambil harga per kg dari model sampah (untuk menghitung ulang)
    $sampah = getSampahById($conn, $id_jenis);
    if (!$sampah) {
        header("Location: ../views/kelolaSetoranViews.php?error=Jenis sampah tidak valid!");
        exit();
    }
    $harga_per_kg = (float)$sampah['harga_per_kg'];

    // 3. LOGIKA INTI: Hitung Ulang total harga
    $total_harga = $berat_kg * $harga_per_kg;

    // 4. Siapkan data untuk model setoran
    $data = [
        'id_setoran' => $id_setoran,
        'id_user' => $id_user,
        'id_jenis' => $id_jenis,
        'berat_kg' => $berat_kg,
        'total_harga' => $total_harga,
        'tanggal_setor' => $tanggal_setor
    ];

    // 5. Panggil model untuk update
    $result = updateSetoran($conn, $data);

    if ($result) {
        header("Location: ../views/kelolaSetoranViews.php?success=Setoran berhasil diupdate!");
    } else {
        header("Location: ../views/kelolaSetoranViews.php?error=Gagal mengupdate setoran!");
    }
    exit();

} else {
    header("Location: ../views/dashboardAdmin.php");
    exit();
}
?>