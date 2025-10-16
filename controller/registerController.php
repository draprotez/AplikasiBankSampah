<?php
require_once("../config/database.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama_admin = $_POST['nama_admin'];
    $username   = $_POST['username'];
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek apakah username sudah digunakan
    $cek = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $cek->bind_param("s", $username);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {
        header("Location: ../register.php?error=Username sudah digunakan");
        exit();
    }

    // Insert ke database
    $stmt = $conn->prepare("INSERT INTO admin (nama_admin, username, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama_admin, $username, $password);

    if ($stmt->execute()) {
        header("Location: ../login.php?success=Registrasi berhasil, silakan login");
        exit();
    } else {
        header("Location: ../register.php?error=Terjadi kesalahan saat menyimpan data");
        exit();
    }
}
?>
