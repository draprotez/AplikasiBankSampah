<?php
session_start();
include '../config/database.php';
include '../models/penarikanModels.php';
include '../models/saldoModels.php';
if (!isset($_SESSION['is_logged_in'])) { die("ERROR: Akses tidak sah!"); }
$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'create':
        if (isset($_POST['tarik_saldo'])) {
            $id_user = $_POST['id_user'];
            $jumlah = (float)$_POST['jumlah'];
            $tanggal = $_POST['tanggal_penarikan'];
            $metode = $_POST['metode'];
            $saldo_tersedia = getSaldoUser($conn, $id_user);
            if ($jumlah > $saldo_tersedia) {
                header("Location: ../views/kelolaPenarikanViews.php?error_popup=Saldo tidak cukup!"); 
                exit();
            }

            $data = [
                'id_user' => $id_user,
                'jumlah' => $jumlah,
                'tanggal_penarikan' => $tanggal,
                'metode' => $metode
            ];

            $result = insertPenarikan($conn, $data);
            if ($result) {
                header("Location: ../views/kelolaPenarikanViews.php?success=Penarikan berhasil!");
            } else {
                header("Location: ../views/kelolaPenarikanViews.php?error_popup=Gagal menyimpan!"); 
            }
        }
        break;

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

    default:
        header("Location: ../views/kelolaPenarikanViews.php");
        break;
}
exit();
?>