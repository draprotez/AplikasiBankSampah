<?php
session_start();
if(!isset($_SESSION['is_logged_in']) || $_SESSION['role'] !=='admin') {
  header("Location: ../login.php?error=Akses ditolak!");
  exit();
}

include '../config/database.php';
include '../models/setoranModels.php'; 

$setoran_list = getAllSetoran($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/admin-forms.css">
  <link rel="website icon" type="png" href="../assets/images/bsmam.png" />
</head>
<body>
  <?php include '../includes/header.php'; ?>

  <div class="container">
    <h1>Hallo Admin!</h1>

    <?php if (isset($_GET['success'])): ?>
      <div class="alert alert-success"><?php echo htmlspecialchars($_GET['success']); ?></div>
    <?php endif; ?>
    
    <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-error"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>

    <div class="word">
      <h3>Laporan Setoran</h3>
    </div>
    <div class="table-card">
      <table>
        <thead>
          <tr>
            <th class="col-nama">Nama Nasabah</th> 
            
            <th class="col-nama">Nama Sampah</th>
            <th class="col-tanggal">Tanggal</th>
            <th class="col-berat">Berat (kg)</th>
            <th class="col-harga">Total Harga (Rp)</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($setoran_list)): ?>
            <tr>
              <td colspan="6" class="text-center">Belum ada data setoran.</td> 
            </tr>
          <?php else: ?>
            <?php foreach ($setoran_list as $setoran): ?>
              <tr>
                <td class="col-nama"><?php echo htmlspecialchars($setoran['nama_user']); ?></td> 
                
                <td class="col-nama"><?php echo htmlspecialchars($setoran['nama_jenis']); ?></td>
                <td class="col-tanggal"><?php echo date("d-m-Y", strtotime($setoran['tanggal_setor'])); ?></td>
                <td class="col-berat"><?php echo htmlspecialchars($setoran['berat_kg']); ?></td>
                <td class="col-harga"><?php echo number_format($setoran['total_harga'], 0, ',', '.'); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <br>
    
    <button type="button" class="btn btn-tambah" style="background-color: red;" onclick="window.location.href='../logout.php'">Logout</button>
  </div>
  <?php include '../includes/footer.php'; ?>
</body>
</html>