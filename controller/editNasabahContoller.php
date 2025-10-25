<?php
session_start();
include '../config/database.php';
include '../models/kelolaNasabahModels.php';

// Keamanan: Pastikan hanya admin yang login yang bisa menjalankan ini
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    die("ERROR: Akses tidak sah!");
}

// Cek apakah form disubmit
if (isset($_POST['update_user'])) {
    
    // 1. Ambil Data
    $data = [
        'id_user'  => $_POST['id_user'],
        'nama'     => $_POST['nama'],
        'username' => $_POST['username'],
        'email'    => $_POST['email'],
        'no_hp'    => $_POST['no_hp'],
        'alamat'   => $_POST['alamat']
    ];
    $password_baru = $_POST['password'];

    // 2. Panggil Model untuk update data (selain password)
    $result = updateUser($conn, $data);

    if ($result !== true) {
        // Gagal update data
        header("Location: ../views/kelolaNasabahViews.php?error=" . urlencode($result));
        exit();
    }

    // 3. Cek apakah admin ingin mengubah password
    if (!empty($password_baru)) {
        $password_hashed = password_hash($password_baru, PASSWORD_DEFAULT);
        $pass_result = updateUserPassword($conn, $data['id_user'], $password_hashed);
        
        if ($pass_result !== true) {
            // Gagal update password
            header("Location: ../views/kelolaNasabahViews.php?error=" . urlencode($pass_result));
            exit();
        }
    }

    // 4. Jika semua berhasil
    header("Location: ../views/kelolaNasabahViews.php?success=Data nasabah berhasil diupdate!");
    exit();

} else {
    // Jika file diakses langsung, tendang ke dashboard
    header("Location: ..//views/dashboardAdmin.php");
    exit();
}
?>