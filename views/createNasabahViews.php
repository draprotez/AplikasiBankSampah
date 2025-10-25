<?php
session_start();
// Hanya admin yang sudah login bisa mengakses halaman ini
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    // Arahkan ke login.php di folder root
    header("Location: ../login.php?error=Akses ditolak!");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User Baru</title>
    <style>
        /* (Anda bisa letakkan kode CSS di sini) */
        body { font-family: sans-serif; background: #f4f4f4; }
        .container { width: 50%; margin: 50px auto; background: white; padding: 20px; border-radius: 8px; }
        .error { color: red; }
        .success { color: green; }
        input, textarea, button { width: 100%; padding: 8px; margin-bottom: 10px; box-sizing: border-box; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Formulir Pendaftaran User Baru</h2>

        <?php
        // Menampilkan pesan error/sukses dari URL
        if (isset($_GET['error'])) {
            echo '<p class="error">' . htmlspecialchars($_GET['error']) . '</p>';
        }
        if (isset($_GET['success'])) {
            echo '<p class="success">' . htmlspecialchars($_GET['success']) . '</p>';
        }
        ?>

        <form action="../controller/createNasabahController.php" method="POST">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" required>
            
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            
            <label for="no_hp">No. HP:</label>
            <input type="text" id="no_hp" name="no_hp">
            
            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" rows="3"></textarea>
            
            <button type="submit" name="tambah_user">Daftarkan User</button>
        </form>
        <br>
        <a href="dashboardAdmin.php">Kembali ke Dashboard</a>
    </div>
</body>
</html>