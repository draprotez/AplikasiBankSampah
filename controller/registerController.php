<?php
require_once("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    $no_hp    = trim($_POST['no_hp']);
    $alamat   = trim($_POST['alamat']);

    // Validasi input kosong
    if (empty($username) || empty($email) || empty($password) || empty($no_hp) || empty($alamat)) {
        header("Location: ../register.php?error=Semua kolom wajib diisi");
        exit();
    }

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=Format email tidak valid");
        exit();
    }

    // Cek username sudah digunakan
    $cek = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $cek->bind_param("s", $username);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {
        header("Location: ../register.php?error=Username sudah digunakan");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Isi kolom nama dengan username agar tetap sesuai struktur DB
    $stmt = $conn->prepare("INSERT INTO users (nama, alamat, no_hp, email, username, password)
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $alamat, $no_hp, $email, $username, $hashedPassword);

    if ($stmt->execute()) {
        header("Location: ../login.php?success=Registrasi berhasil, silakan login");
        exit();
    } else {
        header("Location: ../register.php?error=Gagal menyimpan data ke database");
        exit();
    }
}
?>
