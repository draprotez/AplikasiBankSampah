<?php
session_start();
// Cek jika admin belum login
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: ../login.php?error=Akses ditolak!");
    exit();
}

// Memanggil koneksi dan model
include '../config/database.php';
include '../models/kelolaNasabahModels.php';

// Ambil ID dari URL
$id_user = $_GET['id'];
if (empty($id_user)) {
    header("Location: kelolaNasabahViews.php?error=ID User tidak valid!");
    exit();
}

// Ambil data user yang akan diedit
$user = getUserById($conn, $id_user);

// Jika user tidak ditemukan
if (!$user) {
    header("Location: kelolaNasabahViews.php?error=User tidak ditemukan!");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Nasabah</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; }
        .container { width: 50%; margin: 50px auto; background: white; padding: 20px; border-radius: 8px; }
        input, textarea, button { width: 100%; padding: 8px; margin-bottom: 10px; box-sizing: border-box; }
        .info { font-size: 0.9em; color: #555; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Data Nasabah</h2>

        <form action="../controller/editNasabahContoller.php" method="POST">
            <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
            
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($user['nama']); ?>" required>
            
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
            
            <label for="no_hp">No. HP:</label>
            <input type="text" id="no_hp" name="no_hp" value="<?php echo htmlspecialchars($user['no_hp']); ?>">
            
            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" rows="3"><?php echo htmlspecialchars($user['alamat']); ?></textarea>
            
            <hr>
            <label for="password">Password Baru:</label>
            <input type="password" id="password" name="password">
            <small class="info">Kosongkan jika tidak ingin mengubah password.</small>
            <br><br>
            
            <button type="submit" name="update_user">Update Data User</button>
        </form>
        <br>
        <a href="kelolaNasabahViews.php">Batal dan Kembali</a>
    </div>
</body>
</html>