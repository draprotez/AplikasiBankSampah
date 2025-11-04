<?php
session_start();
include '../config/database.php';
include '../models/beritaModels.php';

// Keamanan: Pastikan hanya admin yang login
if (!isset($_SESSION['is_logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php?error=Akses tidak sah!");
    exit();
}

// Tentukan folder target untuk upload gambar
$target_dir = "../assets/images/berita/"; 
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0755, true);
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {

    case 'create':
        if (isset($_POST['tambah_berita'])) {
            $judul = $_POST['judul'];
            $konten = $_POST['konten'];
            $gambar_baru = $_FILES['gambar'];
            $nama_file_baru = "";

            // Validasi dasar
            if (empty($judul) || empty($konten)) {
                header("Location: ../views/kelolaBeritaViews.php?error_popup=Judul dan Konten wajib diisi!");
                exit();
            }

            // --- Logika Upload Gambar ---
            if (isset($gambar_baru) && $gambar_baru['error'] == 0) {
                $nama_file_baru = uniqid() . '-' . basename($gambar_baru["name"]);
                $target_file = $target_dir . $nama_file_baru;

                // Cek ukuran & tipe file
                if (move_uploaded_file($gambar_baru["tmp_name"], $target_file)) {
                } else {
                    header("Location: ../views/kelolaBeritaViews.php?error_popup=Gagal mengupload gambar!");
                    exit();
                }
            } else {
                 header("Location: ../views/kelolaBeritaViews.php?error_popup=Gambar wajib di-upload!");
                 exit();
            }
            $data = [
                'judul' => $judul,
                'konten' => $konten,
                'gambar' => $nama_file_baru
            ];

            $result = insertBerita($conn, $data);
            if ($result === true) {
                header("Location: ../views/kelolaBeritaViews.php?success=Berita baru berhasil ditambahkan!");
            } else {
                header("Location: ../views/kelolaBeritaViews.php?error_popup=Gagal menyimpan ke database!");
            }
        }
        break;


    case 'update':
        if (isset($_POST['update_berita'])) {
            $id = $_POST['id_berita'];
            $judul = $_POST['judul'];
            $konten = $_POST['konten'];
            $gambar_baru = $_FILES['gambar'];
            $gambar_lama = $_POST['gambar_lama'];
            $nama_file_untuk_db = $gambar_lama;

            // --- Logika Upload Gambar Baru
            if (isset($gambar_baru) && $gambar_baru['error'] == 0 && !empty($gambar_baru['name'])) {
                $nama_file_baru = uniqid() . '-' . basename($gambar_baru["name"]);
                $target_file = $target_dir . $nama_file_baru;

                if (move_uploaded_file($gambar_baru["tmp_name"], $target_file)) {
                    $nama_file_untuk_db = $nama_file_baru;
                    if (!empty($gambar_lama) && file_exists($target_dir . $gambar_lama)) {
                        unlink($target_dir . $gambar_lama);
                    }
                } else {
                    header("Location: ../views/kelolaBeritaViews.php?error_popup_edit=Gagal mengupload gambar baru!");
                    exit();
                }
            }
            $data = [
                'id' => $id,
                'judul' => $judul,
                'konten' => $konten,
                'gambar' => $nama_file_untuk_db
            ];

            $result = updateBerita($conn, $data);
            if ($result === true) {
                header("Location: ../views/kelolaBeritaViews.php?success=Berita berhasil diupdate!");
            } else {
                header("Location: ../views/kelolaBeritaViews.php?error_popup_edit=Gagal mengupdate database!");
            }
        }
        break;


    case 'delete':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // Ambil data berita untuk dapat nama file gambar
            $berita = getBeritaById($conn, $id);
            if ($berita) {
                // Hapus data dari database
                $result = deleteBerita($conn, $id);
                if ($result) {
                    // Hapus file gambar dari server
                    $gambar_lama = $berita['gambar'];
                    if (!empty($gambar_lama) && file_exists($target_dir . $gambar_lama)) {
                        unlink($target_dir . $gambar_lama);
                    }
                    header("Location: ../views/kelolaBeritaViews.php?success=Berita berhasil dihapus!");
                } else {
                    header("Location: ../views/kelolaBeritaViews.php?error=Gagal menghapus data dari database!");
                }
            } else {
                header("Location: ../views/kelolaBeritaViews.php?error=Berita tidak ditemukan!");
            }
        }
        break;
    default:
        header("Location: ../views/kelolaBeritaViews.php");
        break;
}
exit();
?>