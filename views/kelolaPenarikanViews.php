<?php
session_start();
if (!isset($_SESSION['is_logged_in'])) { header("Location: ../login.php"); exit(); }

include '../config/database.php';
include '../models/penarikanModels.php';
// --- BARIS DITAMBAHKAN ---
// Diperlukan untuk dropdown di popup
include '../models/kelolaNasabahModels.php'; 
include '../models/saldoModels.php'; 
// --- AKHIR BARIS DITAMBAHKAN ---

// Mengambil semua data histori penarikan
$penarikan_list = getAllPenarikan($conn);

// --- BARIS DITAMBAHKAN ---
// Variabel ini diperlukan untuk form popup
$users = getAllUsers($conn);
// --- AKHIR BARIS DITAMBAHKAN ---
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Penarikan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-forms.css">
</head>
<body>

    <?php include '../includes/header.php'; ?>

    <div class="container">

        <!-- <div class="search-container">
            <input type="text" id="search-kelola" class="search-bar" placeholder="Cari Data Nasabah...">
        </div> -->

        <button onclick="openForm('createForm')" class="btn btn-tambah">Tambah Penarikan</button>

        <?php if (isset($_GET['success'])) echo '<div class="alert alert-success">'.htmlspecialchars($_GET['success']).'</div>'; ?>
        <?php if (isset($_GET['error'])) echo '<div class="alert alert-error">'.htmlspecialchars($_GET['error']).'</div>'; ?>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th class="col-tanggal">Tanggal</th>
                        <th class="col-nama">Nama Nasabah</th>
                        <th class="col-metode">Metode</th>
                        <th class="col-jumlah">Jumlah (Rp)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($penarikan_list)): ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">Belum ada data penarikan.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($penarikan_list as $penarikan): ?>
                            <tr>
                                <td class="col-tanggal"><?php echo htmlspecialchars($penarikan['tanggal_penarikan']); ?></td>
                                <td class="col-nama"><?php echo htmlspecialchars($penarikan['nama_user']); ?></td>
                                <td class="col-metode"><?php echo htmlspecialchars($penarikan['metode']); ?></td>
                                <td class="col-jumlah"><?php echo number_format($penarikan['jumlah'], 0, ',', '.'); ?></td>
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
            <h2>Form Penarikan Saldo</h2>
            
            <?php if (isset($_GET['error_popup'])): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($_GET['error_popup']); ?></div>
            <?php endif; ?>

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
                <small class="info">*Pastikan jumlah tidak melebihi saldo yang tersedia*</small>
                <br><br>

                <label for="metode">Metode Penarikan:</label>
                <select id="metode" name="metode" required>
                    <option value="Ambil Tunai">Ambil Tunai</option>
                    <option value="Transfer">Transfer</option>
                </select>
                <label for="tanggal_penarikan">Tanggal Penarikan:</label>
                <input type="date" id="tanggal_penarikan" name="tanggal_penarikan" value="<?php echo date('Y-m-d'); ?>" required>
                
                <div class="form-actions">
                    <button type="submit" name="tarik_saldo" class="btn btn-simpan">Tarik Saldo</button>
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
        
        // Cek jika ada error popup dari URL, langsung tampilkan modal
        <?php if (isset($_GET['error_popup'])): ?>
            openForm('createForm');
        <?php endif; ?>
    </script>

</body>
</html>