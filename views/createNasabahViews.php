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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        /* 1. Latar Belakang (Body) 
          Kita buat seolah-olah ada di belakang popup
        */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5; /* Latar belakang abu-abu muda */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            /* Trik untuk meniru tampilan "di belakang modal" */
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mN8/w8AAuMB8DtXNJsAAAAASUVORK5CYII='); /* Latar belakang dim */
        }

        /* 2. Kontainer Form (Modal Abu-abu) 
          Ini adalah .container Anda, ditata agar terlihat seperti gambar
        */
        .popup-form {
            background-color: #EAEAEA; /* Warna abu-abu dari gambar */
            padding: 30px 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            width: 400px;
            box-sizing: border-box;
        }

        /* 3. Input Fields
          Menyembunyikan label dan menata input
        */
        label {
            display: none; /* Sembunyikan label, karena desain tidak memakainya */
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 14px 20px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 10px; /* Sesuai gambar */
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            box-sizing: border-box;
            background-color: #FFFFFF; /* Warna putih */
        }
        
        /* 4. Tombol Aksi (Simpan & Batal) 
        */
        .form-actions {
            display: flex;
            justify-content: center; /* Tombol di tengah */
            gap: 15px; /* Jarak antar tombol */
            margin-top: 10px;
        }

        .btn {
            border: none;
            padding: 12px 20px;
            border-radius: 20px; /* Bentuk pill */
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            flex: 1; /* Lebar tombol sama */
            text-align: center;
            text-decoration: none;
            color: white;
        }

        .btn-simpan {
            background-color: #28a745; /* Hijau "Simpan" */
        }

        .btn-batal {
            background-color: #dc3545; /* Merah "Batal" */
        }

        /* 5. Pesan Error/Sukses 
        */
        .error { color: #721c24; background-color: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
        .success { color: #155724; background-color: #d4edda; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="popup-form">
        
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">' . htmlspecialchars($_GET['error']) . '</p>';
        }
        if (isset($_GET['success'])) {
            echo '<p class="success">' . htmlspecialchars($_GET['success']) . '</p>';
        }
        ?>
        
        <form action="../controller/createNasabahController.php" method="POST">
            
            <input type="text" id="nama" name="nama" placeholder="Nama Nasabah" required>
            
            <input type="text" id="username" name="username" placeholder="Username" required>
            
            <input type="password" id="password" name="password" placeholder="Password" required>
            
            <input type="email" id="email" name="email" placeholder="Email">
            
            <input type="text" id="no_hp" name="no_hp" placeholder="Nomor Telephone">
            
            <textarea id="alamat" name="alamat" rows="3" placeholder="Alamat"></textarea>
            
            <div class="form-actions">
                <button type="submit" name="tambah_user" class="btn btn-simpan">Simpan</button>
                
                <a href="kelolaNasabahView.php" class="btn btn-batal">Batal</a>
            </div>
        </form>
        
    </div>
</body>
</html>