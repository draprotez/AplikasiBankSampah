<?php
session_start();
// Memanggil file koneksi dan model
// (Gunakan ../ untuk naik satu level folder)
include '../config/database.php';
include '../models/createNasabahModels.php';

// Keamanan: Pastikan hanya admin yang login yang bisa menjalankan ini
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    die("ERROR: Akses tidak sah!");
}

// Cek apakah form disubmit
if (isset($_POST['tambah_user'])) {
    
    // 1. Validasi Input (bisnis logik)
    if (empty($_POST['nama']) || empty($_POST['username']) || empty($_POST['password'])) {
        // Redirect kembali ke View dengan pesan error
        header("Location: ../views/createNasabahViews.php?error=Nama, Username, dan Password wajib diisi!");
        exit();
    }
    
    // 2. Siapkan Data untuk Model
    $data = [
        'nama'     => $_POST['nama'],
        'username' => $_POST['username'],
        'email'    => $_POST['email'],
        'no_hp'    => $_POST['no_hp'],
        'alamat'   => $_POST['alamat'],
        'password_hashed' => password_hash($_POST['password'], PASSWORD_DEFAULT) // Hashing!
    ];

    // 3. Panggil Model untuk menyimpan data
    $result = insertUser($conn, $data);

    // 4. Arahkan kembali ke View berdasarkan hasil
    if ($result === true) {
        // Sukses
        header("Location: ../views/createNasabahViews.php?success=User baru berhasil ditambahkan!");
    } else {
        // Gagal (Pesan error didapat dari model)
        header("Location: ../views/createNasabahViews.php?error=" . urlencode($result));
    }
    exit();

} else {
    // Jika file diakses langsung, tendang ke dashboard
    header("Location: ../views/dashboardAdmin.php");
    exit();
}
?>