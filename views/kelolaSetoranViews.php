<?php
session_start();
if (!isset($_SESSION['is_logged_in'])) { header("Location: ../login.php"); exit(); }

include '../config/database.php';
include '../models/setoranModels.php';
include '../models/kelolaNasabahModels.php';  
include '../models/sampahModels.php'; 

$setoran_list = getAllSetoran($conn);
$users = getAllUsers($conn);
$sampah_list = getAllSampah($conn);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Setoran</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-forms.css">
</head>
<body>

    <?php include '../includes/header.php'; ?>

    <div class="container">
        <button onclick="openForm('createForm')" class="btn btn-tambah">Tambah Setoran</button>
        <?php if (isset($_GET['success'])) echo '<div class="alert alert-success">'.htmlspecialchars($_GET['success']).'</div>'; ?>
        <?php if (isset($_GET['error'])) echo '<div class="alert alert-error">'.htmlspecialchars($_GET['error']).'</div>'; ?>
        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th class="col-tanggal">Tanggal Setor</th>
                        <th class="col-nama">Nama Nasabah</th>
                        <th class="col-jenis">Jenis Sampah</th>
                        <th class="col-berat">Berat (kg)</th>
                        <th class="col-harga">Total Harga (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($setoran_list)): ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">Belum ada data setoran.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($setoran_list as $setoran): ?>
                            <tr>
                                <td class="col-tanggal"><?php echo htmlspecialchars($setoran['tanggal_setor']); ?></td>
                                <td class="col-nama"><?php echo htmlspecialchars($setoran['nama_user']); ?></td>
                                <td class="col-jenis"><?php echo htmlspecialchars($setoran['nama_jenis']); ?></td>
                                <td class="col-berat"><?php echo htmlspecialchars($setoran['berat_kg']); ?></td>
                                <td class="col-harga"><?php echo number_format($setoran['total_harga'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <br>
        <button type="button" class="btn btn-tambah" style="background-color: red;" onclick="window.location.href='../logout.php'">Logout</button>
    </div>

    <div id="createForm" class="modal-overlay">
        <div class="popup-form">
            <h2>Form Tambah Setoran</h2>
            
            <form action="../controller/setoranController.php" method="POST">
                
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
                <input type="number" step="0.01" id="berat_kg" name="berat_kg" placeholder="Berat : 6" required>
                
                <label for="tanggal_setor">Tanggal Setor:</label>
                <input type="date" id="tanggal_setor" name="tanggal_setor" value="<?php echo date('Y-m-d'); ?>" required>
                
                <div class="form-actions">
                    <button type="submit" name="tambah_setoran" class="btn btn-simpan">Simpan Setoran</button>
                    <button type="button" onclick="closeForm('createForm')" class="btn btn-batal">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <script>
        // Fungsi untuk membuka popup
        function openForm(modalId) {
            document.getElementById(modalId).style.display = 'flex';
        }

        // Fungsi untuk menutup popup
        function closeForm(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
    </script>

</body>
</html>