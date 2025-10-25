<?php
session_start();
if (!isset($_SESSION['is_logged_in'])) { header("Location: ../login.php"); exit(); }

include '../config/database.php';
include '../models/kelolaNasabahModels.php';  // Diperlukan untuk daftar user
include '../models/sampahModels.php'; // Diperlukan untuk daftar sampah

$users = getAllUsers($conn);
$sampah_list = getAllSampah($conn);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Setoran Baru</title>
    <style>
        body { font-family: sans-serif; } .container { width: 50%; margin: 20px auto; background: white; padding: 20px; }
        input, select, button, textarea { width: 100%; padding: 8px; margin-bottom: 10px; box-sizing: border-box; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Tambah Setoran</h2>
        
        <form action="../controller/createSetoranController.php" method="POST">
            
            <label for="id_user">Nasabah (User):</label>
            <select id="id_user" name="id_user" required>
                <option value="">-- Pilih Nasabah --</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['id_user']; ?>">
                        <?php echo htmlspecialchars($user['nama']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <label for="id_jenis">Jenis Sampah:</label>
            <select id="id_jenis" name="id_jenis" required>
                <option value="">-- Pilih Jenis Sampah --</option>
                <?php foreach ($sampah_list as $sampah): ?>
                    <option value="<?php echo $sampah['id_jenis']; ?>">
                        <?php echo htmlspecialchars($sampah['nama_jenis']) . ' (Rp ' . $sampah['harga_per_kg'] . '/kg)'; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <label for="berat_kg">Berat (kg):</label>
            <input type="number" step="0.01" id="berat_kg" name="berat_kg" required>
            
            <label for="tanggal_setor">Tanggal Setor:</label>
            <input type="date" id="tanggal_setor" name="tanggal_setor" value="<?php echo date('Y-m-d'); ?>" required>
            
            <button type="submit" name="tambah_setoran">Simpan Setoran</button>
        </form>
        <br>
        <a href="kelolaSetoranViews.php">Batal dan Kembali</a>
    </div>
</body>
</html>