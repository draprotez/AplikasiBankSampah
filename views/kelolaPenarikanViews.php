<?php
session_start();
if (!isset($_SESSION['is_logged_in'])) { header("Location: ../login.php"); exit(); }

include '../config/database.php';
include '../models/penarikanModels.php';

// Mengambil semua data histori penarikan
$penarikan_list = getAllPenarikan($conn);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Penarikan</title>
    <style>
        body { font-family: sans-serif; } .container { width: 90%; margin: 20px auto; }
        table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; } .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; color: white; }
        .btn-tambah { background-color: #007bff; display: inline-block; margin-bottom: 10px; }
        .btn-delete { background-color: #dc3545; }
        .alert { padding: 10px; margin-bottom: 10px; border-radius: 4px; }
        .alert-success { background-color: #d4edda; color: #155724; }
        .alert-error { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Histori Penarikan Saldo</h1>
        <a href="createPenarikanViews.php" class="btn btn-tambah">Lakukan Penarikan Baru</a>

        <?php if (isset($_GET['success'])) echo '<div class="alert alert-success">'.htmlspecialchars($_GET['success']).'</div>'; ?>
        <?php if (isset($_GET['error'])) echo '<div class="alert alert-error">'.htmlspecialchars($_GET['error']).'</div>'; ?>

        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Nasabah</th>
                    <th>Jumlah (Rp)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($penarikan_list)): ?>
                    <tr><td colspan="4">Belum ada data penarikan.</td></tr>
                <?php else: ?>
                    <?php foreach ($penarikan_list as $penarikan): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($penarikan['tanggal_penarikan']); ?></td>
                            <td><?php echo htmlspecialchars($penarikan['nama_user']); ?></td>
                            <td><?php echo number_format($penarikan['jumlah'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="../controller/penarikanController.php?action=delete&id=<?php echo $penarikan['id_penarikan']; ?>" 
                                   class="btn btn-delete" 
                                   onclick="return confirm('Yakin ingin HAPUS penarikan ini? Saldo nasabah akan dikembalikan.');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <br><a href="dashboardAdmin.php">Kembali ke Dashboard</a>
    </div>
</body>
</html>