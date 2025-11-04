<?php
session_start();
if (!isset($_SESSION['is_logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php?error=Akses ditolak!");
    exit();
}
include '../config/database.php';
include '../models/beritaModels.php';

$berita_list = getAllBerita($conn);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Berita & Kegiatan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-forms.css">
    <style>
        .popup-confirm { background-color: #fff; padding: 30px 40px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); width: 350px; text-align: center; }
        .popup-confirm p { font-size: 16px; color: #333; margin-bottom: 25px; }
        .popup-confirm .confirm-actions { display: flex; justify-content: center; gap: 15px; }
        .popup-confirm .btn-confirm-delete { background-color: var(--danger-color); flex: 1; border:none; cursor:pointer; font-size:14px; font-weight:500; padding:10px 15px; border-radius:20px; color:white; transition:var(--transition); }
        .popup-confirm .btn-confirm-cancel { background-color: #6c757d; flex: 1; border:none; cursor:pointer; font-size:14px; font-weight:500; padding:10px 15px; border-radius:20px; color:white; transition:var(--transition); }
        .popup-confirm .btn-confirm-delete:hover, .popup-confirm .btn-confirm-cancel:hover { transform: scale(1.05); }
        .img-preview { max-width: 100px; height: auto; margin-top: 10px; }
    </style>
</head>
<body>

    <?php include '../includes/header.php'; ?>

    <div class="container">
        
        <button onclick="openForm('createForm')" class="btn btn-tambah">Tambah Berita Baru</button>

        <?php
        if (isset($_GET['success'])) { echo '<div class="alert alert-success">' . htmlspecialchars($_GET['success']) . '</div>'; }
        if (isset($_GET['error'])) { echo '<div class="alert alert-error">' . htmlspecialchars($_GET['error']) . '</div>'; }
        ?>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th class="col-tanggal">Tanggal Post</th>
                        <th>Gambar</th>
                        <th class="col-nama">Judul Berita</th>
                        <th class="col-aksi">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($berita_list)): ?>
                        <tr> <td colspan="4" style="text-align: center;">Belum ada berita.</td> </tr>
                    <?php else: ?>
                        <?php foreach ($berita_list as $berita): ?>
                            <tr>
                                <td class="col-tanggal"><?php echo date("d-m-Y", strtotime($berita['tanggal_post'])); ?></td>
                                <td>
                                    <img src="../assets/images/berita/<?php echo htmlspecialchars($berita['gambar']); ?>" alt="Gambar Berita" class="img-preview">
                                </td>
                                <td class="col-nama"><?php echo htmlspecialchars($berita['judul']); ?></td>
                                <td class="col-aksi">
                                    <button type="button" class="btn btn-edit" 
                                            onclick="openEditBeritaForm(this)"
                                            data-id="<?php echo $berita['id']; ?>"
                                            data-judul="<?php echo htmlspecialchars($berita['judul']); ?>"
                                            data-konten="<?php echo htmlspecialchars($berita['konten']); ?>"
                                            data-gambar="<?php echo htmlspecialchars($berita['gambar']); ?>">
                                        Edit
                                    </button>
                                     <button type="button" class="btn btn-delete" 
                                            onclick="openDeleteConfirm(this)"
                                            data-url="../controller/beritaController.php?action=delete&id=<?php echo $berita['id']; ?>">
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
            <h2>Form Tambah Berita</h2>
            <?php if (isset($_GET['error_popup'])) echo '<div class="alert alert-error">'.htmlspecialchars($_GET['error_popup']).'</div>'; ?>
            <form action="../controller/beritaController.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="create">
                
                <label>Judul Berita:</label>
                <input type="text" name="judul" placeholder="Judul Berita" required>
                
                <label>Konten:</label>
                <textarea name="konten" rows="5" placeholder="Isi berita..." required></textarea>
                
                <label>Upload Gambar:</label>
                <input type="file" name="gambar" accept="image/png, image/jpeg, image/jpg" required>
                
                <div class="form-actions">
                    <button type="submit" name="tambah_berita" class="btn btn-simpan">Simpan</button>
                    <button type="button" onclick="closeForm('createForm')" class="btn btn-batal">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editForm" class="modal-overlay">
        <div class="popup-form">
            <h2>Edit Berita</h2>
            <?php if (isset($_GET['error_popup_edit'])) echo '<div class="alert alert-error">'.htmlspecialchars($_GET['error_popup_edit']).'</div>'; ?>
            <form action="../controller/beritaController.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id_berita" id="edit_id_berita">
                <input type="hidden" name="gambar_lama" id="edit_gambar_lama">
                
                <label>Judul Berita:</label>
                <input type="text" id="edit_judul" name="judul" required>
                
                <label>Konten:</label>
                <textarea id="edit_konten" name="konten" rows="5" required></textarea>
                
                <label>Gambar Saat Ini:</label>
                <img src="" id="edit_img_preview" class="img-preview" alt="Preview Gambar Lama">
                
                <label>Upload Gambar Baru (Kosongkan jika tidak diubah):</label>
                <input type="file" name="gambar" accept="image/png, image/jpeg, image/jpg">
                
                <div class="form-actions">
                    <button type="submit" name="update_berita" class="btn btn-simpan">Update</button>
                    <button type="button" onclick="closeForm('editForm')" class="btn btn-batal">Batal</button>
                </div>
            </form>
        </div>
    </div>
    
    <div id="deleteConfirmModal" class="modal-overlay">
        <div class="popup-confirm">
             <p>Yakin ingin hapus berita ini?</p>
             <div class="confirm-actions">
                 <button type="button" onclick="confirmDelete()" class="btn btn-confirm-delete">Ya, Hapus</button>
                 <button type="button" onclick="closeForm('deleteConfirmModal')" class="btn btn-confirm-cancel">Batal</button>
             </div>
             <input type="hidden" id="deleteUrlInput">
         </div>
         <br>
    </div>


    <?php include '../includes/footer.php'; ?>
    <script src="../assets/js/admin-script.js"></script>
    <script>
        // UNTUK MEMBUKA POPUP EDIT BERITA ---
        function openEditBeritaForm(buttonElement) {
            const id = buttonElement.getAttribute('data-id');
            const judul = buttonElement.getAttribute('data-judul');
            const konten = buttonElement.getAttribute('data-konten');
            const gambar = buttonElement.getAttribute('data-gambar');

            // Isi nilai ke dalam field form popup edit
            document.getElementById('edit_id_berita').value = id;
            document.getElementById('edit_judul').value = judul;
            document.getElementById('edit_konten').value = konten;
            document.getElementById('edit_gambar_lama').value = gambar;

            const imgPreview = document.getElementById('edit_img_preview');
            imgPreview.src = '../assets/images/berita/' + gambar;

            openForm('editForm');
        }

        // Cek jika ada error popup dari URL
        <?php if (isset($_GET['error_popup'])): ?>
            openForm('createForm');
        <?php endif; ?>
        <?php if (isset($_GET['error_popup_edit'])): ?>
            openForm('editForm');
        <?php endif; ?>
    </script>

</body>
</html>