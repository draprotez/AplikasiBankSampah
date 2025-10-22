<?php
session_start();
require_once("../config/database.php");

if (!isset($_SESSION['is_logged_in']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];

// Ambil id_user
$stmt = $conn->prepare("SELECT id_user, nama FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$id_user = $user['id_user'];

// Hitung total transaksi (setoran)
$sql_setoran = "
    SELECT SUM(harga) AS total_setoran 
    FROM transaksi 
    WHERE id_user = ?
";
$stmt = $conn->prepare($sql_setoran);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$total_setoran = $result['total_setoran'] ?? 0;

// Hitung total penarikan
$sql_penarikan = "
    SELECT SUM(jumlah) AS total_penarikan 
    FROM penarikan 
    WHERE id_user = ?
";
$stmt = $conn->prepare($sql_penarikan);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$total_penarikan = $result['total_penarikan'] ?? 0;

// Saldo akhir
$saldo = $total_setoran - $total_penarikan;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <link rel="stylesheet" href="../assets/css/dashboardUser.css">
</head>
<body>
    <nav class="navbar">
        <a href="dashboardUser.php" class="active">Dashboard</a>
        <a href="riwayatTransaksi.php">Riwayat Transaksi</a>
    </nav>

    <div class="container">
        <h2>Hallo Nasabah!</h2>
        <div class="saldo-card">
            <p class="label">Saldo Anda</p>
            <h1>Rp <?= number_format($saldo, 0, ',', '.') ?></h1>
        </div>
    </div>
</body>
</html>
