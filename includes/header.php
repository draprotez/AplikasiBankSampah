<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <h3 class="judul">Dashboard Admin</h3>

  <div class="navbar">
    <button class="nav-btn active" onclick="showSection('dashboard')"><a href="../views/dashboardAdmin.php">Dashboard</a></button>
    <button class="nav-btn" onclick="showSection('kelola')"><a href="../views/dashboardAdminKelolaViews.php">Kelola Nasabah</a></button>
    <button class="nav-btn" onclick="showSection('setoran')"><a href="../views/dashboardAdminKelolaSetoranViews.php">Kelola Setoran</a></button>
    <button class="nav-btn" onclick="showSection('penarikan')"><a href="../views/dashboardAdminKelolaPenarikanViews.php">Kelola Penarikan</a></button>
    <button class="nav-btn" onclick="showSection('harga')"><a href="../views/dashboardAdminKelolaHargaViews.php">Kelola Harga</a></button>
  </div>
</body>
</html>