<?php
session_start();
// Memanggil file koneksi database dan model nasabah
include '../config/database.php';
// Pastikan nama file model ini benar (misal: kelolaNasabahModels.php atau userModel.php)
include '../models/kelolaNasabahModels.php'; 

// Keamanan: Pastikan hanya admin yang login yang bisa menjalankan ini
if (!isset($_SESSION['is_logged_in']) || $_SESSION['role'] !== 'admin') {
    // Jika bukan admin, arahkan ke login
    header("Location: ../login.php?error=Akses tidak sah!");
    exit();
}

// Tentukan aksi yang diminta (dari form POST atau link GET)
$action = $_POST['action'] ?? $_GET['action'] ?? '';

// Gunakan switch untuk menangani aksi yang berbeda
switch ($action) {

    //Create Nasabah
    case 'create':
        // Cek apakah form tambah disubmit (nama tombol submit)
        if (isset($_POST['tambah_user'])) { 
            
            // 1. Validasi Input 
            if (empty($_POST['nama']) || empty($_POST['username']) || empty($_POST['password'])) {
                // Redirect kembali ke form create (jika terpisah) atau list (jika popup)
                // Sesuaikan redirect ini jika form create Anda ada di file terpisah
                header("Location: ../views/kelolaNasabahViews.php?error_popup=Nama, Username, dan Password wajib diisi!"); 
                exit();
            }
            
            // 2. Siapkan Data untuk Model
            $data = [
                'nama'     => trim($_POST['nama']),
                'username' => trim($_POST['username']),
                'email'    => trim($_POST['email']),
                'no_hp'    => trim($_POST['no_hp']),
                'alamat'   => trim($_POST['alamat']),
                'password_hashed' => password_hash($_POST['password'], PASSWORD_DEFAULT) // Hashing!
            ];

            // 3. Panggil Model untuk menyimpan data
            $result = insertUser($conn, $data); // Pastikan nama fungsi ini insertUser

            // 4. Arahkan kembali ke View berdasarkan hasil
            if ($result === true) {
                // Kembali ke halaman daftar nasabah
                header("Location: ../views/kelolaNasabahViews.php?success=Nasabah baru berhasil ditambahkan!");
            } else {
                // Kembali ke halaman daftar dengan error popup
                 header("Location: ../views/kelolaNasabahViews.php?error_popup=" . urlencode($result)); 
            }
        } else {
             // Jika tombol submit tidak ada, kembali ke daftar
             header("Location: ../views/kelolaNasabahViews.php");
        }
        break; // Akhir case 'create'

    //Update Nasabah
    case 'update':
        // Cek apakah form update disubmit
        if (isset($_POST['update_user'])) {
            
            // 1. Ambil Data
            $data = [
                'id_user'  => $_POST['id_user'],
                'nama'     => trim($_POST['nama']),
                'username' => trim($_POST['username']),
                'email'    => trim($_POST['email']),
                'no_hp'    => trim($_POST['no_hp']),
                'alamat'   => trim($_POST['alamat'])
            ];
            $password_baru = $_POST['password']; // Ambil password baru (jika ada)

            // Validasi dasar (contoh: ID harus ada)
            if (empty($data['id_user'])) {
                 header("Location: ../views/kelolaNasabahViews.php?error=ID User tidak valid untuk update!");
                 exit();
            }

            // 2. Panggil Model untuk update data (selain password)
            $result = updateUser($conn, $data); // Pastikan nama fungsi ini updateUser

            if ($result !== true) {
                // Gagal update data utama
                header("Location: ../views/kelolaNasabahViews.php?error_popup_edit=" . urlencode($result)); // Error di popup edit
                exit();
            }

            // 3. Cek apakah admin ingin mengubah password
            if (!empty($password_baru)) {
                $password_hashed = password_hash($password_baru, PASSWORD_DEFAULT);
                // Pastikan nama fungsi ini updateUserPassword
                $pass_result = updateUserPassword($conn, $data['id_user'], $password_hashed); 
                
                if ($pass_result !== true) {
                    // Gagal update password
                     header("Location: ../views/kelolaNasabahViews.php?error_popup_edit=" . urlencode($pass_result)); // Error di popup edit
                    exit();
                }
            }

            // 4. Jika semua berhasil
            header("Location: ../views/kelolaNasabahViews.php?success=Data nasabah berhasil diupdate!");
            
        } else {
            // Jika tombol submit update tidak ada
            header("Location: ../views/kelolaNasabahViews.php");
        }
        break; // Akhir case 'update'

    //Delete Nasabah
    case 'delete':
        // Pastikan ID dikirim melalui GET
        if (isset($_GET['id'])) {
            $id_user = $_GET['id'];

            // 2. Panggil Model untuk hapus data
            $result = deleteUser($conn, $id_user); // Pastikan nama fungsi ini deleteUser

            // 3. Arahkan kembali ke View berdasarkan hasil
            if ($result === true) {
                header("Location: ../views/kelolaNasabahViews.php?success=Nasabah berhasil dihapus!");
            } else {
                header("Location: ../views/kelolaNasabahViews.php?error=" . urlencode($result));
            }
        } else {
            // Jika ID tidak ada
            header("Location: ../views/kelolaNasabahViews.php?error=ID Nasabah tidak ditemukan!");
        }
        break; // Akhir case 'delete'

    default:
        // Jika aksi tidak valid, kembalikan ke halaman daftar nasabah
        header("Location: ../views/kelolaNasabahViews.php");
        break; // Akhir case default

}

// Pastikan script berhenti setelah redirect
exit();
?>