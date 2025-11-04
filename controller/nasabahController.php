<?php
session_start();
include '../config/database.php';
include '../models/kelolaNasabahModels.php';

if (!isset($_SESSION['is_logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php?error=Akses tidak sah!");
    exit();
}
$action = $_POST['action'] ?? $_GET['action'] ?? '';
switch ($action) {

    //Create Nasabah
    case 'create':
        if (isset($_POST['tambah_user'])) { 
            if (empty($_POST['nama']) || empty($_POST['username']) || empty($_POST['password'])) {
                header("Location: ../views/kelolaNasabahViews.php?error_popup=Nama, Username, dan Password wajib diisi!"); 
                exit();
            }
            $data = [
                'nama'     => trim($_POST['nama']),
                'username' => trim($_POST['username']),
                'email'    => trim($_POST['email']),
                'no_hp'    => trim($_POST['no_hp']),
                'alamat'   => trim($_POST['alamat']),
                'password_hashed' => password_hash($_POST['password'], PASSWORD_DEFAULT) // Hashing!
            ];
            $result = insertUser($conn, $data);
            if ($result === true) {
                header("Location: ../views/kelolaNasabahViews.php?success=Nasabah baru berhasil ditambahkan!");
            } else {
                 header("Location: ../views/kelolaNasabahViews.php?error_popup=" . urlencode($result)); 
            }
        } else {
             header("Location: ../views/kelolaNasabahViews.php");
        }
        break;

    //Update Nasabah
    case 'update':
        if (isset($_POST['update_user'])) {
            $data = [
                'id_user'  => $_POST['id_user'],
                'nama'     => trim($_POST['nama']),
                'username' => trim($_POST['username']),
                'email'    => trim($_POST['email']),
                'no_hp'    => trim($_POST['no_hp']),
                'alamat'   => trim($_POST['alamat'])
            ];
            $password_baru = $_POST['password'];
            if (empty($data['id_user'])) {
                 header("Location: ../views/kelolaNasabahViews.php?error=ID User tidak valid untuk update!");
                 exit();
            }
            $result = updateUser($conn, $data);

            if ($result !== true) {
                header("Location: ../views/kelolaNasabahViews.php?error_popup_edit=" . urlencode($result)); // Error di popup edit
                exit();
            }
            if (!empty($password_baru)) {
                $password_hashed = password_hash($password_baru, PASSWORD_DEFAULT);
                $pass_result = updateUserPassword($conn, $data['id_user'], $password_hashed); 
                
                if ($pass_result !== true) {
                     header("Location: ../views/kelolaNasabahViews.php?error_popup_edit=" . urlencode($pass_result)); // Error di popup edit
                    exit();
                }
            }
            header("Location: ../views/kelolaNasabahViews.php?success=Data nasabah berhasil diupdate!");
            
        } else {
            header("Location: ../views/kelolaNasabahViews.php");
        }
        break;

    //Delete Nasabah
    case 'delete':
        if (isset($_GET['id'])) {
            $id_user = $_GET['id'];
            $result = deleteUser($conn, $id_user);
            if ($result === true) {
                header("Location: ../views/kelolaNasabahViews.php?success=Nasabah berhasil dihapus!");
            } else {
                header("Location: ../views/kelolaNasabahViews.php?error=" . urlencode($result));
            }
        } else {
            header("Location: ../views/kelolaNasabahViews.php?error=ID Nasabah tidak ditemukan!");
        }
        break;

    default:
        header("Location: ../views/kelolaNasabahViews.php");
        break;

}
exit();
?>