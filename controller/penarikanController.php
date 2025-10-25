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
    /**
     * CASE CREATE
     */
    case 'create':
        if (isset($_POST['tarik_saldo'])) {
            
            // 1. Ambil data
            $id_user = $_POST['id_user'];
            $jumlah = (float)$_POST['jumlah'];
            $tanggal = $_POST['tanggal_penarikan'];

            // 2. LOGIKA VALIDASI SALDO
            $saldo_tersedia = getSaldoUser($conn, $id_user);

            if ($jumlah <= 0) {
                // Tidak boleh tarik 0 atau minus
                header("Location: ../views/createPenarikanViews.php?error=Jumlah penarikan tidak boleh nol atau negatif!");
                exit();
            }

            if ($jumlah > $saldo_tersedia) {
                // Saldo tidak cukup
                header("Location: ../views/createPenarikanViews.php?error=Saldo tidak cukup! Saldo tersedia: Rp " . number_format($saldo_tersedia, 0, ',', '.'));
                exit();
            }

            // 3. Jika Lolos Validasi, siapkan data
            $data = [
                'id_user' => $id_user,
                'jumlah' => $jumlah,
                'tanggal_penarikan' => $tanggal
            ];

            // 4. Panggil Model Insert
            $result = insertPenarikan($conn, $data);
            if ($result) {
                header("Location: ../views/kelolaPenarikanViews.php?success=Penarikan berhasil dicatat!");
            } else {
                header("Location: ../views/createPenarikanViews.php?error=Gagal menyimpan data ke database!");
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
                header("Location: ../views/kelolaPenarikanViews.php?success=Data penarikan berhasil dihapus (saldo dikembalikan).");
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