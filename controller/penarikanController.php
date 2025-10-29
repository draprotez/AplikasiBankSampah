<?php
session_start();
include '../config/database.php';
include '../models/penarikanModels.php';
include '../models/saldoModels.php'; // WAJIB untuk validasi

// Keamanan: Pastikan hanya admin yang login
if (!isset($_SESSION['is_logged_in'])) { die("ERROR: Akses tidak sah!"); }

// Tentukan aksi (dari form POST atau link GET)
$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'create':
        if (isset($_POST['tarik_saldo'])) {
            
            // 1. Ambil data
            $id_user = $_POST['id_user'];
            $jumlah = (float)$_POST['jumlah'];
            $tanggal = $_POST['tanggal_penarikan'];
            $metode = $_POST['metode']; // <-- TAMBAHKAN BARIS INI

            // 2. Validasi Saldo
            $saldo_tersedia = getSaldoUser($conn, $id_user);
            
            // (Logika validasi saldo Anda...)
            if ($jumlah > $saldo_tersedia) {
                // PENTING: Ubah 'error' menjadi 'error_popup'
                header("Location: ../views/kelolaPenarikanViews.php?error_popup=Saldo tidak cukup!"); 
                exit();
            }

            // 3. Siapkan data
            $data = [
                'id_user' => $id_user,
                'jumlah' => $jumlah,
                'tanggal_penarikan' => $tanggal,
                'metode' => $metode // <-- TAMBAHKAN BARIS INI
            ];

            // 4. Panggil Model Insert
            $result = insertPenarikan($conn, $data);
            if ($result) {
                header("Location: ../views/kelolaPenarikanViews.php?success=Penarikan berhasil!");
            } else {
                // PENTING: Ubah 'error' menjadi 'error_popup'
                header("Location: ../views/kelolaPenarikanViews.php?error_popup=Gagal menyimpan!"); 
            }
        }
        break;
    /**
     * CASE DELETE
     */
    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = deletePenarikan($conn, $id);
            if ($result) {
                header("Location: ../views/kelolaPenarikanViews.php?success=Penarikan berhasil dicatat!");
            } else {
                header("Location: ../views/kelolaPenarikanViews.php?error=Gagal menghapus data!");
            }
        }
        break;

    /**
     * DEFAULT
     */
    default:
        header("Location: ../views/kelolaPenarikanViews.php");
        break;
}
exit();
?>