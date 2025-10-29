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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Harga & Jenis Sampah</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-forms.css">
</head>
<body>

    <?php include '../includes/header.php'; ?>

    <div class="container">

        <div class="search-container">
            <input type="text" id="search-kelola" class="search-bar" placeholder="Cari Jenis Sampah...">
        </div>

        <button onclick="openForm('createForm')" class="btn btn-tambah">Tambah Jenis Sampah</button>

        <?php if (isset($_GET['success'])) echo '<div class="alert alert-success">'.htmlspecialchars($_GET['success']).'</div>'; ?>
        <?php if (isset($_GET['error'])) echo '<div class="alert alert-error">'.htmlspecialchars($_GET['error']).'</div>'; ?>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th class="col-id">ID</th>
                        <th class="col-nama">Nama Jenis</th>
                        <th class="col-kategori">Kategori</th>
                        <th class="col-harga">Harga per Kg (Rp)</th>
                        <th class="col-aksi">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($sampah_list)): ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">Belum ada data jenis sampah.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($sampah_list as $sampah): ?>
                            <tr>
                                <td class="col-id"><?php echo $sampah['id_jenis']; ?></td>
                                <td class="col-nama"><?php echo htmlspecialchars($sampah['nama_jenis']); ?></td>
                                <td class="col-kategori"><?php echo htmlspecialchars($sampah['kategori']); ?></td>
                                <td class="col-harga"><?php echo number_format($sampah['harga_per_kg'], 0, ',', '.'); ?></td>
                                <td class="col-aksi">
                                    <button type="button" class="btn btn-edit" 
                                            onclick="openEditSampahForm(this)"
                                            data-id="<?php echo $sampah['id_jenis']; ?>"
                                            data-nama="<?php echo htmlspecialchars($sampah['nama_jenis']); ?>"
                                            data-kategori="<?php echo htmlspecialchars($sampah['kategori']); ?>"
                                            data-harga="<?php echo htmlspecialchars($sampah['harga_per_kg']); ?>">
                                        Edit
                                    </button>
                                    
                                    <button type="button" class="btn btn-delete" 
                                            onclick="openDeleteConfirm(this)"
                                            data-url="../controller/sampahController.php?action=delete&id=<?php echo $sampah['id_jenis']; ?>">
                                        Delete
                                    </button>
                                </td>
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
            <h2>Form Tambah Sampah</h2>
            <form action="../controller/sampahController.php" method="POST">
                <input type="hidden" name="action" value="create">

                <label>Nama Jenis Sampah:</label>
                <input type="text" name="nama_jenis" placeholder="Nama Sampah" required>
                
                <label>Kategori:</label>
                <select name="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="organik">Organik</option>
                    <option value="anorganik">Anorganik</option>
                    <option value="elektronik">Elektronik</option>
                    <option value="logam">Logam</option>
                </select>
                
                <label>Harga per Kg (Rp):</label>
                <input type="number" step="1" min="0" name="harga_per_kg" placeholder="Contoh: 3000" required>
                
                <div class="form-actions">
                     <button type="submit" name="tambah_sampah" class="btn btn-simpan">Simpan</button> 
                    <button type="button" onclick="closeForm('createForm')" class="btn btn-batal">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editForm" class="modal-overlay">
        <div class="popup-form">
            <h2>Form Edit Sampah</h2>
            <form action="../controller/sampahController.php" method="POST">
                <input type="hidden" name="id_jenis" id="edit_id_jenis">
                <input type="hidden" name="action" value="update">

                <label>Nama Jenis Sampah:</label>
                <input type="text" id="edit_nama_jenis" name="nama_jenis" required>
                
                <label>Kategori:</label>
                <select id="edit_kategori" name="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="organik">Organik</option>
                    <option value="anorganik">Anorganik</option>
                    <option value="elektronik">Elektronik</option>
                    <option value="logam">Logam</option>
                </select>
                
                <label>Harga per Kg (Rp):</label>
                <input type="number" step="1" min="0" id="edit_harga_per_kg" name="harga_per_kg" required>
                
                <div class="form-actions">
                     <button type="submit" name="update_sampah" class="btn btn-simpan">Update</button> 
                    <button type="button" onclick="closeForm('editForm')" class="btn btn-batal">Batal</button>
                </div>
            </form>
        </div>
    </div>
    
    <div id="deleteConfirmModal" class="modal-overlay">
        <div class="popup-confirm">
            <p>Yakin ingin hapus jenis sampah ini? Ini bisa error jika sampah sudah dipakai di data setoran.</p>
            <div class="confirm-actions">
                <button type="button" onclick="confirmDelete()" class="btn btn-confirm-delete">Ya, Hapus</button>
                <button type="button" onclick="closeForm('deleteConfirmModal')" class="btn btn-confirm-cancel">Batal</button>
            </div>
            <input type="hidden" id="deleteUrlInput">
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <script>
        // Fungsi untuk membuka popup (bisa untuk create, edit, atau delete)
        function openForm(modalId) {
            document.getElementById(modalId).style.display = 'flex';
        }

        // Fungsi untuk menutup popup (bisa untuk create, edit, atau delete)
        function closeForm(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // --- FUNGSI BARU UNTUK MEMBUKA POPUP EDIT ---
        function openEditSampahForm(buttonElement) {
            // Ambil data dari atribut data-* tombol yang diklik
            const id = buttonElement.getAttribute('data-id');
            const nama = buttonElement.getAttribute('data-nama');
            const kategori = buttonElement.getAttribute('data-kategori');
            const harga = buttonElement.getAttribute('data-harga');

            // Isi nilai ke dalam field form popup edit
            document.getElementById('edit_id_jenis').value = id;
            document.getElementById('edit_nama_jenis').value = nama;
            document.getElementById('edit_kategori').value = kategori;
            document.getElementById('edit_harga_per_kg').value = harga;
           
            // Tampilkan popup edit
            openForm('editForm');
        }

        // --- FUNGSI BARU UNTUK POPUP DELETE ---
        function openDeleteConfirm(buttonElement) {
            const deleteUrl = buttonElement.getAttribute('data-url');
            document.getElementById('deleteUrlInput').value = deleteUrl;
            openForm('deleteConfirmModal');
        }

        function confirmDelete() {
            const deleteUrl = document.getElementById('deleteUrlInput').value;
            if (deleteUrl) {
                window.location.href = deleteUrl; // Arahkan ke URL Hapus
            } else {
                alert('Error: URL Hapus tidak ditemukan!');
            }
        }
    </script>

</body>
</html>