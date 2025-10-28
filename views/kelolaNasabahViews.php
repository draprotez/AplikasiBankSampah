<?php
session_start();
// Cek jika admin belum login
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: ../login.php?error=Akses ditolak!");
    exit();
}

// Memanggil koneksi dan model
include '../config/database.php';
include '../models/kelolaNasabahModels.php';

// Mengambil semua data user
$users = getAllUsers($conn);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Nasabah (Users)</title>
    <style>
        body { font-family: sans-serif; }
        .container { width: 90%; margin: 20px auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; color: white; }
        .btn-tambah { background-color: #007bff; display: inline-block; margin-bottom: 10px; }
        .btn-edit { background-color: #ffc107; }
        .btn-delete { background-color: #dc3545; }
        .alert { padding: 10px; margin-bottom: 10px; border-radius: 4px; }
        .alert-success { background-color: #d4edda; color: #155724; }
        .alert-error { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <div class="container">
        <h1>Kelola Nasabah (Users)</h1>
        
        <a href="createNasabahViews.php" class="btn btn-tambah">Tambah Nasabah Baru</a>
        <input type="text" id="search-kelola" class="search" placeholder="Cari Data Nasabah...">

        <?php
        // Menampilkan pesan sukses/error dari URL
        if (isset($_GET['success'])) {
            echo '<div class="alert alert-success">' . htmlspecialchars($_GET['success']) . '</div>';
        }
        if (isset($_GET['error'])) {
            echo '<div class="alert alert-error">' . htmlspecialchars($_GET['error']) . '</div>';
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="7">Belum ada data nasabah.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id_user']; ?></td>
                            <td><?php echo htmlspecialchars($user['nama']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['no_hp']); ?></td>
                            <td><?php echo htmlspecialchars($user['alamat']); ?></td>
                            <td>
                                <a href="editNasabahViews.php?id=<?php echo $user['id_user']; ?>" class="btn btn-edit">Edit</a>
                                <a href="../controller/deleteNasabahController.php?id=<?php echo $user['id_user']; ?>" 
                                   class="btn btn-delete" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <br>
        <a href="dashboardAdmin.php">Kembali ke Dashboard</a>
    </div>
</body>
</html>