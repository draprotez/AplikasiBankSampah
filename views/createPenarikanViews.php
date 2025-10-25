<?php
session_start();
if (!isset($_SESSION['is_logged_in'])) { header("Location: ../login.php"); exit(); }

include '../config/database.php';
include '../models/kelolaNasabahModels.php';  // Diperlukan untuk daftar user
include '../models/saldoModels.php'; // Diperlukan untuk cek saldo

// Ambil semua user
$users = getAllUsers($conn);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Penarikan Saldo</title>
    <style>
        body { font-family: sans-serif; } .container { width: 50%; margin: 20px auto; background: white; padding: 20px; }
        input, select, button { width: 100%; padding: 8px; margin-bottom: 10px; box-sizing: border-box; }
        .info { font-size: 0.9em; color: #555; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Penarikan Saldo</h2>
        
        <?php if (isset($_GET['error'])) echo '<p style="color:red;">'.htmlspecialchars($_GET['error']).'</p>'; ?>

        <form action="../controller/penarikanController.php" method="POST">
            <input type="hidden" name="action" value="create">
            
            <label for="id_user">Nasabah (User):</label>
            <select id="id_user" name="id_user" required>
                <option value="">-- Pilih Nasabah --</option>
                <?php foreach ($users as $user): ?>
                    <?php
                    // Panggil model saldo untuk setiap user
                    $saldo = getSaldoUser($conn, $user['id_user']);
                    ?>
                    <option value="<?php echo $user['id_user']; ?>">
                        <?php echo htmlspecialchars($user['nama']) . ' (Saldo: Rp ' . number_format($saldo, 0, ',', '.') . ')'; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <label for="jumlah">Jumlah Penarikan (Rp):</label>
            <input type="number" step="100" id="jumlah" name="jumlah" placeholder="Contoh: 50000" required>
            <small class="info">Pastikan jumlah tidak melebihi saldo yang tersedia.</small>
            <br><br>

            <label for="tanggal_penarikan">Tanggal Penarikan:</label>
            <input type="date" id="tanggal_penarikan" name="tanggal_penarikan" value="<?php echo date('Y-m-d'); ?>" required>
            
            <button type="submit" name="tarik_saldo">Tarik Saldo</button>
        </form>
        <br>
        <a href="kelolaPenarikanViews.php">Batal dan Kembali</a>
    </div>
</body>
</html>