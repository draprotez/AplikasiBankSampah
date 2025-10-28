<?php
// Memulai session jika perlu (meski registrasi biasanya tidak perlu, tapi baik untuk konsistensi)
session_start();

// Memanggil file koneksi dan model
include '../config/database.php';
include '../models/adminModels.php'; // Panggil model admin yang baru

// Cek apakah tombol submit sudah ditekan
if (isset($_POST['register_admin'])) {
    
    // 1. Ambil data dari form
    $nama_admin = $_POST['nama_admin'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // 2. Validasi Input Sederhana
    if (empty($nama_admin) || empty($username) || empty($password)) {
        header("Location: ../views/registerAdminViews.php?error=Semua field wajib diisi!");
        exit();
    }

    if ($password !== $confirm_password) {
        header("Location: ../views/registerAdminViews.php?error=Password dan Konfirmasi Password tidak cocok!");
        exit();
    }

    // 3. HASH PASSWORD (PENTING!)
    // Gunakan password_hash() untuk mengenkripsi password
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // 4. Siapkan data untuk Model
    $data = [
        'nama_admin' => $nama_admin,
        'username' => $username,
        'password_hashed' => $password_hashed
    ];

    // 5. Panggil Model untuk menyimpan data
    $result = insertAdmin($conn, $data);

    // 6. Arahkan kembali berdasarkan hasil
    if ($result === true) {
        // Jika sukses, arahkan ke halaman login dengan pesan sukses
        header("Location: ../login.php?success=Registrasi admin berhasil! Silakan login.");
    } else {
        // Jika gagal (pesan error didapat dari model, misal: username duplikat)
        header("Location: ../views/registerAdminViews.php?error=" . urlencode($result));
    }
    exit();

} else {
    // Jika file diakses langsung tanpa submit, tendang ke halaman registrasi
    header("Location: ../views/registerAdminViews.php");
    exit();
}
?>