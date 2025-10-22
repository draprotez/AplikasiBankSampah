<?php
session_start();
require_once("../config/database.php");
require_once("../controller/transaksiController.php");

if (!isset($_SESSION['is_logged_in']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];

// ambil id_user dari username
$stmt = $conn->prepare("SELECT id_user FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$id_user = $user['id_user'];

// ambil data transaksi dari database
$riwayat = getRiwayatTransaksi($id_user);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="../assets/css/dashboardUser.css">
</head>
<body>
    <nav class="navbar">
        <a href="dashboardUser.php">Dashboard</a>
        <a href="riwayatTransaksi.php" class="active">Riwayat Transaksi</a>
    </nav>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <th>Jenis Sampah</th>
                    <th>Berat (kg)</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $riwayat->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['tanggal_pengajuan']) ?></td>
                        <td><?= htmlspecialchars($row['jenis_sampah']) ?></td>
                        <td><?= htmlspecialchars($row['berat']) ?></td>
                        <td>Rp.<?= number_format($row['harga'], 0, ',', '.') ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
