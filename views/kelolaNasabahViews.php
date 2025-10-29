<?php
session_start();
// Cek jika admin belum login
if (!isset($_SESSION['is_logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php?error=Akses ditolak!");
    exit();
}

// Memanggil koneksi dan model
include '../config/database.php';
// Ganti nama model ini jika file Anda namanya userModel.php
include '../models/kelolaNasabahModels.php'; 
// PENTING: Panggil model saldo
include '../models/saldoModels.php'; 

// Mengambil semua data user
$users = getAllUsers($conn);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Nasabah (Users)</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-forms.css">
</head>
<body>

    <?php include '../includes/header.php'; ?>

    <div class="container">
        
        <!-- <div class="search-container">
            <input type="text" id="search-kelola" class="search-bar" placeholder="Cari Data Nasabah...">
        </div> -->

        <button onclick="openForm('createForm')" class="btn btn-tambah">Tambah Nasabah</button>

        <?php
        // Notifikasi
        if (isset($_GET['success'])) { echo '<div class="alert alert-success">' . htmlspecialchars($_GET['success']) . '</div>'; }
        if (isset($_GET['error'])) { echo '<div class="alert alert-error">' . htmlspecialchars($_GET['error']) . '</div>'; }
        ?>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th class="col-id">ID</th>
                        <th class="col-nama">Nama Nasabah</th>
                        <th class="col-saldo">Saldo</th>
                        <th class="col-aksi">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)): ?>
                        <tr> <td colspan="4" style="text-align: center;">Belum ada data nasabah.</td> </tr>
                    <?php else: ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td class="col-id"><?php echo $user['id_user']; ?></td>
                                <td class="col-nama"><?php echo htmlspecialchars($user['nama']); ?></td>
                                <td class="col-saldo">
                                    <?php
                                    $saldo = getSaldoUser($conn, $user['id_user']);
                                    echo 'Rp ' . number_format($saldo, 0, ',', '.');
                                    ?>
                                </td>
                                <td class="col-aksi">
                                    <button type="button" class="btn btn-delete" 
                                            onclick="openDeleteConfirm(this)"
                                            data-url="../controller/nasabahController.php?action=delete&id=<?php echo $user['id_user']; ?>">
                                        Delete
                                    </button>
                                    
                                    <button type="button" class="btn btn-edit" 
                                            onclick="openEditForm(this)"
                                            data-id="<?php echo $user['id_user']; ?>"
                                            data-nama="<?php echo htmlspecialchars($user['nama']); ?>"
                                            data-username="<?php echo htmlspecialchars($user['username']); ?>"
                                            data-email="<?php echo htmlspecialchars($user['email']); ?>"
                                            data-nohp="<?php echo htmlspecialchars($user['no_hp']); ?>"
                                            data-alamat="<?php echo htmlspecialchars($user['alamat']); ?>">
                                        Edit
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
             <form action="../controller/nasabahController.php" method="POST">
                <input type="hidden" name="action" value="create"> <input type="text" id="nama" name="nama" placeholder="Nama Nasabah" required>
                <input type="text" id="username" name="username" placeholder="Username" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <input type="email" id="email" name="email" placeholder="Email">
                <input type="text" id="no_hp" name="no_hp" placeholder="Nomor Telephone">
                <textarea id="alamat" name="alamat" rows="3" placeholder="Alamat"></textarea>
                <div class="form-actions">
                    <button type="submit" name="tambah_user" class="btn btn-simpan">Simpan</button>
                    <button type="button" onclick="closeForm('createForm')" class="btn btn-batal">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editForm" class="modal-overlay">
        <div class="popup-form">
            <h2>Edit Data Nasabah</h2>
             <form action="../controller/nasabahController.php" method="POST">
                <input type="hidden" name="action" value="update"> <input type="hidden" name="id_user" id="edit_id_user"> 
                <input type="text" id="edit_nama" name="nama" placeholder="Nama Nasabah" required>
                <input type="text" id="edit_username" name="username" placeholder="Username" required>
                <input type="email" id="edit_email" name="email" placeholder="Email">
                <input type="text" id="edit_no_hp" name="no_hp" placeholder="Nomor Telephone">
                <textarea id="edit_alamat" name="alamat" rows="3" placeholder="Alamat"></textarea>
                <input type="password" id="edit_password" name="password" placeholder="Password Baru">
                <small class="info" style="display:block; text-align: center;">*Kosongkan password jika tidak diubah*</small>
                 <div class="form-actions">
                    <button type="submit" name="update_user" class="btn btn-simpan">Update</button>
                    <button type="button" onclick="closeForm('editForm')" class="btn btn-batal">Batal</button>
                </div>
            </form>
        </div>
    </div>
    
    <div id="deleteConfirmModal" class="modal-overlay">
        <div class="popup-confirm"> <p>Apakah Anda yakin ingin menghapus nasabah ini?</p>
            <div class="confirm-actions">
                 <button type="button" onclick="confirmDelete()" class="btn btn-confirm-delete">Ya, Hapus</button>
                 <button type="button" onclick="closeForm('deleteConfirmModal')" class="btn btn-confirm-cancel">Batal</button>
            </div>
             <input type="hidden" id="deleteUrlInput"> 
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

        // Fungsi untuk membuka popup edit
        function openEditForm(buttonElement) {
        const id = buttonElement.getAttribute('data-id');
        const nama = buttonElement.getAttribute('data-nama');
        const username = buttonElement.getAttribute('data-username');
        const email = buttonElement.getAttribute('data-email');
        const nohp = buttonElement.getAttribute('data-nohp');
        const alamat = buttonElement.getAttribute('data-alamat');

        document.getElementById('edit_id_user').value = id; 
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_username').value = username;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_no_hp').value = nohp;
        document.getElementById('edit_alamat').value = alamat;
        document.getElementById('edit_password').value = ''; // Kosongkan password
            openForm('editForm');
        }

        // --- FUNGSI BARU UNTUK MEMBUKA POPUP KONFIRMASI DELETE ---
        function openDeleteConfirm(buttonElement) {
            const deleteUrl = buttonElement.getAttribute('data-url');
            document.getElementById('deleteUrlInput').value = deleteUrl;
            openForm('deleteConfirmModal');
        }

        // --- FUNGSI BARU UNTUK MENJALANKAN DELETE SETELAH KONFIRMASI ---
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