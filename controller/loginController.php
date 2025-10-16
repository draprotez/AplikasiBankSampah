<?php
session_start();
include '../config/database.php';

// Ambil data dari form login.php
$username = $_POST['username'];
$password = $_POST['password'];

// Coba login sebagai admin dulu
$sql_admin = "SELECT * FROM admin WHERE username = ?";
$stmt = $conn->prepare($sql_admin);
$stmt->bind_param("s", $username);
$stmt->execute();
$result_admin = $stmt->get_result();

if ($result_admin->num_rows > 0) {
    $admin = $result_admin->fetch_assoc();

    // Verifikasi password (gunakan password_hash di database)
    if (password_verify($password, $admin['password'])) {
        $_SESSION['username'] = $admin['username'];
        $_SESSION['nama_admin'] = $admin['nama_admin'];
        $_SESSION['role'] = 'admin';
        $_SESSION['is_logged_in'] = true;

        header("Location: ../views/dashboardAdmin.php");
        exit();
    }
}

// Jika bukan admin, coba login sebagai user
$sql_user = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql_user);
$stmt->bind_param("s", $username);
$stmt->execute();
$result_user = $stmt->get_result();

if ($result_user->num_rows > 0) {
    $user = $result_user->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['role'] = 'user';
        $_SESSION['is_logged_in'] = true;

        header("Location: ../views/dashboardUser.php");
        exit();
    }
}

// Jika tidak cocok keduanya
header("Location: ../login.php?error=Username atau password salah!");
exit();
?>
