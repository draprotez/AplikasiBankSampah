<?php 
require_once("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama     = trim($_POST['nama']);
    $alamat   = trim($_POST['alamat']);
    $no_hp    = trim($_POST['no_hp']);
    $email    = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Validasi dasar
    if (empty($nama) || empty($alamat) || empty($no_hp) || empty($email) || empty($username) || empty($_POST['password'])) {
        header("Location: ../register.php?error=Semua kolom wajib diisi");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=Format email tidak valid");
        exit();
    }

    // Cek apakah username sudah digunakan
    $cek = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $cek->bind_param("s", $username);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {
        header("Location: ../register.php?error=Username sudah digunakan");
        exit();
    }

    // Simpan data ke tabel users
    $stmt = $conn->prepare("
        INSERT INTO users (nama, alamat, no_hp, email, username, password)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("ssssss", $nama, $alamat, $no_hp, $email, $username, $password);

    if ($stmt->execute()) {
        header("Location: ../login.php?success=Registrasi berhasil, silakan login");
        exit();
    } else {
        header("Location: ../register.php?error=Terjadi kesalahan saat menyimpan data");
        exit();
    }
}
?>
