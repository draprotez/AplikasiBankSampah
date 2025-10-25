<?php
session_start();
if (!isset($_SESSION['is_logged_in'])) { header("Location: ../login.php"); exit(); }

include '../config/database.php';
include '../models/setoranModels.php';

// Mengambil semua data setoran (dengan JOIN)
$setoran_list = getAllSetoran($conn);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Setoran</title>
    <style>
        body { font-family: sans-serif; } .container { width: 90%; margin: 20px auto; }
        table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; } .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; color: white; }
        .btn-tambah { background-color: #007bff; display: inline-block; margin-bottom: 10px; }
        .btn-edit { background-color: #ffc107; } .btn-delete { background-color: #dc3545; }
        .alert { padding: 10px; margin-bottom: 10px; border-radius: 4px; }
        .alert-success { background-color: #d4edda; color: #155724; }
        .alert-error { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kelola Setoran Nasabah</h1>
        <a href="createSetoranViews.php" class="btn btn-tambah">Tambah Setoran Baru</a>

        <?php if (isset($_GET['success'])) echo '<div class="alert alert-success">'.htmlspecialchars($_GET['success']).'</div>'; ?>
        <?php if (isset($_GET['error'])) echo '<div class="alert alert-error">'.htmlspecialchars($_GET['error']).'</div>'; ?>

        <table>
            <thead>
                <tr>
                    <th>Tanggal Setor</th>
                    <th>Nama Nasabah</th>
                    <th>Jenis Sampah</th>
                    <th>Berat (kg)</th>
                    <th>Total Harga (Rp)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($setoran_list)): ?>
                    <tr><td colspan="6">Belum ada data setoran.</td></tr>
                <?php else: ?>
                    <?php foreach ($setoran_list as $setoran): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($setoran['tanggal_setor']); ?></td>
                            <td><?php echo htmlspecialchars($setoran['nama_user']); ?></td>
                            <td><?php echo htmlspecialchars($setoran['nama_jenis']); ?></td>
                            <td><?php echo htmlspecialchars($setoran['berat_kg']); ?></td>
                            <td><?php echo number_format($setoran['total_harga'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="editSetoranView.php?id=<?php echo $setoran['id_setoran']; ?>" class="btn btn-edit">Edit</a>
                                <a href="../controller/deleteSetoranController.php?id=<?php echo $setoran['id_setoran']; ?>" 
                                   class="btn btn-delete" 
                                   onclick="return confirm('Yakin ingin hapus data ini?');">Delete</a>
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