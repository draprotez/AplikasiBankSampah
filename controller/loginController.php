<?php
session_start();
include '../config/database.php';

// Ambil data dari form login.php
$login_input = $_POST['username']; // Bisa username atau email
$password = $_POST['password'];

// Coba login sebagai admin dulu
$sql_admin = "SELECT * FROM admin WHERE username = ?";
$stmt = $conn->prepare($sql_admin);
$stmt->bind_param("s", $login_input);
$stmt->execute();
$result_admin = $stmt->get_result();

if ($result_admin->num_rows > 0) {
    $admin = $result_admin->fetch_assoc();

    // Gunakan password_verify untuk mengecek hash
    if (password_verify($password, $admin['password'])) {
        
        $_SESSION['user_id'] = $admin['id_admin'];
        $_SESSION['username'] = $admin['username'];
        $_SESSION['nama_admin'] = $admin['nama_admin'];
        $_SESSION['role'] = 'admin';
        $_SESSION['is_logged_in'] = true;

        header("Location: ../views/dashboardAdmin.php");
        exit();
    }
}

// Jika bukan admin, coba login sebagai user (cek username atau email)
// Bagian ini sudah benar
$sql_users = "SELECT * FROM users WHERE username = ? OR email = ?";
$stmt = $conn->prepare($sql_users);
$stmt->bind_param("ss", $login_input, $login_input);
$stmt->execute();
$result_user = $stmt->get_result();

if ($result_user->num_rows > 0) {
    $user = $result_user->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['role'] = 'user';
        $_SESSION['is_logged_in'] = true;

        header("Location: ../views/dashboardNasabah.php");
        exit();
    }
}

// Jika tidak cocok keduanya
header("Location: ../login.php?error=Username atau password salah!");
exit();
?>