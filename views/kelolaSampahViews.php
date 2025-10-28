<?php
session_start();
if (!isset($_SESSION['is_logged_in'])) { header("Location: ../login.php"); exit(); }

include '../config/database.php';
include '../models/sampahModels.php';

// Mengambil semua data sampah
$sampah_list = getAllSampah($conn);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Harga & Jenis Sampah</title>
    <style>
        body { font-family: sans-serif; } .container { width: 80%; margin: 20px auto; }
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
    <?php include '../includes/header.php'; ?>
    <div class="container">
        <h1>Kelola Harga & Jenis Sampah</h1>
        
        <a href="kelolaSampahViews.php?action=tambah" class="btn btn-tambah">Tambah Jenis Sampah Baru</a>

        <?php if (isset($_GET['success'])) echo '<div class="alert alert-success">'.htmlspecialchars($_GET['success']).'</div>'; ?>
        <?php if (isset($_GET['error'])) echo '<div class="alert alert-error">'.htmlspecialchars($_GET['error']).'</div>'; ?>

        <hr>

        <?php
        // ----- TAMPILKAN FORM CREATE / UPDATE -----
        // Kita gunakan halaman yang sama untuk menampilkan form (lebih efisien)
        
        $action = $_GET['action'] ?? '';
        $id_edit = $_GET['id'] ?? 0;
        $sampah_edit = null;

        if ($action == 'edit' && $id_edit > 0) {
            $sampah_edit = getSampahById($conn, $id_edit);
        }
        
        // Form akan muncul jika action=tambah ATAU action=edit
        if ($action == 'tambah' || ($action == 'edit' && $sampah_edit)):
        ?>
            <h2><?php echo ($action == 'tambah') ? 'Form Tambah Sampah' : 'Form Edit Sampah'; ?></h2>
            <form action="../controller/sampahController.php" method="POST">
                
                <?php if ($action == 'edit'): ?>
                    <input type="hidden" name="id_jenis" value="<?php echo $sampah_edit['id_jenis']; ?>">
                    <input type="hidden" name="action" value="update">
                <?php else: ?>
                    <input type="hidden" name="action" value="create">
                <?php endif; ?>

                <label>Nama Jenis Sampah:</label>
                <input type="text" name="nama_jenis" value="<?php echo $sampah_edit['nama_jenis'] ?? ''; ?>" required>
                
                <label>Kategori:</label>
                <select name="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="organik" <?php echo (($sampah_edit['kategori'] ?? '') == 'organik') ? 'selected' : ''; ?>>Organik</option>
                    <option value="anorganik" <?php echo (($sampah_edit['kategori'] ?? '') == 'anorganik') ? 'selected' : ''; ?>>Anorganik</option>
                    <option value="elektronik" <?php echo (($sampah_edit['kategori'] ?? '') == 'elektronik') ? 'selected' : ''; ?>>Elektronik</option>
                    <option value="logam" <?php echo (($sampah_edit['kategori'] ?? '') == 'logam') ? 'selected' : ''; ?>>Logam</option>
                </select>
                
                <label>Harga per Kg (Rp):</label>
                <input type="number" step="0.01" name="harga_per_kg" value="<?php echo $sampah_edit['harga_per_kg'] ?? ''; ?>" required>
                
                <button type="submit"><?php echo ($action == 'tambah') ? 'Simpan' : 'Update'; ?></button>
                <a href="kelolaSampahViews.php">Batal</a>
            </form>
            <hr>
        <?php endif; // Selesai bagian form ?>
        

        <h2>Daftar Jenis Sampah</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Jenis</th>
                    <th>Kategori</th>
                    <th>Harga per Kg (Rp)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($sampah_list)): ?>
                    <tr><td colspan="5">Belum ada data jenis sampah.</td></tr>
                <?php else: ?>
                    <?php foreach ($sampah_list as $sampah): ?>
                        <tr>
                            <td><?php echo $sampah['id_jenis']; ?></td>
                            <td><?php echo htmlspecialchars($sampah['nama_jenis']); ?></td>
                            <td><?php echo htmlspecialchars($sampah['kategori']); ?></td>
                            <td><?php echo number_format($sampah['harga_per_kg'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="kelolaSampahViews.php?action=edit&id=<?php echo $sampah['id_jenis']; ?>" class="btn btn-edit">Edit</a>
                                
                                <a href="../controller/sampahController.php?action=delete&id=<?php echo $sampah['id_jenis']; ?>" 
                                   class="btn btn-delete" 
                                   onclick="return confirm('Yakin ingin hapus jenis sampah ini? Ini bisa error jika sampah sudah dipakai di data setoran.');">Delete</a>
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