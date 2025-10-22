<?php
session_start();
// Check if user is logged in and is an admin
if (!isset($_SESSION['is_logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php?error=Unauthorized access!");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
  <h3 class="judul">Dashboard Admin</h3>

  <div class="navbar">
    <button class="nav-btn active" onclick="showSection('dashboard')">Dashboard</button>
    <button class="nav-btn" onclick="showSection('kelola')">Kelola Nasabah</button>
    <button class="nav-btn" onclick="showSection('setoran')">Kelola Setoran</button>
    <button class="nav-btn" onclick="showSection('penarikan')">Kelola Penarikan</button>
    <button class="nav-btn" onclick="showSection('harga')">Kelola Harga</button>
  </div>

  <div class="content">
    <!-- Dashboard -->
    <section id="dashboard" class="active">
      <h2>Hallo Admin!</h2>
    </section>

    <!-- Kelola Nasabah -->
    <section id="kelola">
      <h2>Kelola Nasabah</h2>
      <input type="text" id="search-kelola" class="search" placeholder="Cari Data Nasabah...">

      <table id="table-kelola">
        <tr>
          <th>ID</th><th>Nama Nasabah</th><th>Saldo</th><th>Aksi</th>
        </tr>
        <tr>
          <td>23-11-2025</td><td>Anton Wardani</td><td>Rp.100.000</td>
          <td><button class="btn-green">Konfirmasi</button> <button class="btn-blue" onclick="openForm()">Edit</button></td>
        </tr>
        <tr>
          <td>23-11-2025</td><td>Agung Budiono</td><td>Rp.80.000</td>
          <td><button class="btn-green">Konfirmasi</button> <button class="btn-blue" onclick="openForm()">Edit</button></td>
        </tr>
      </table>

      <!-- Popup Form Edit -->
      <div id="editForm" class="popup">
        <div class="popup-content">
          <h3>Edit Data Nasabah</h3>
          <input type="text" placeholder="Username">
          <input type="text" placeholder="ID">
          <input type="email" placeholder="Email">
          <input type="password" placeholder="Password">
          <input type="text" placeholder="Nomor Telepon">
          <input type="text" placeholder="Alamat">
          <div class="popup-buttons">
            <button class="btn-green">Simpan</button>
            <button class="btn-red" onclick="closeForm()">Batal</button>
          </div>
        </div>
      </div>
    </section>

    <!-- Konfirmasi Setoran -->
    <section id="setoran">
      <h2>Kelola Setoran</h2>
      <input type="text" id="search-setoran" class="search" placeholder="Cari Data Nasabah...">
      <button class="btn-green">Tambah</button>
      <table id="table-setoran">
        <tr><th>Tanggal</th><th>Nama</th><th>Jumlah</th><th>Aksi</th></tr>
        <tr><td>23-11-2025</td><td>Anton Wardani</td><td>Rp 200.000</td><td><button class="btn-green">Edit</button> </tr>
        <tr><td>23-11-2025</td><td>Agung Budiono</td><td>Rp 350.000</td><td><button class="btn-green">Edit</button> </tr>
      </table>
    </section>

    <!-- Konfirmasi Penarikan -->
    <section id="penarikan">
      <h2>Kelola Penarikan</h2>
      <input type="text" id="search-penarikan" class="search" placeholder="Cari Data Nasabah...">
      <button class="btn-green">Tambah</button>
      <table id="table-penarikan">
        <tr><th>Tanggal</th><th>Nama</th><th>Metode</th><th>Penarikan</th></tr>
        <tr><td>23-11-2025</td><td>Anton Wardani</td><td>Transfer</td><td>Rp. 100.000</td>
        <tr><td>23-11-2025</td><td>Agung Budiono</td><td>Ambil Tunai</td><td>Rp. 100.000</td>
      </table>
    </section>

    <!-- Kelola Harga -->
    <section id="harga">
      <h2>Kelola Harga</h2>
      <table>
        <tr><th>Jenis Sampah</th><th>Harga per Kg</th><th>Aksi</th></tr>
        <tr><td>Plastik</td><td>Rp 3.000</td><td><button class="btn-green">Edit</button> <button class="btn-red">Hapus</button></td></tr>
      </table>
    </section>
  </div>

  <script>
    // Ganti Section
    function showSection(id) {
      document.querySelectorAll("section").forEach(sec => sec.classList.remove("active"));
      document.querySelectorAll(".nav-btn").forEach(btn => btn.classList.remove("active"));
      document.getElementById(id).classList.add("active");
      event.target.classList.add("active");
    }

    // Popup Form
    function openForm() {
      document.getElementById("editForm").style.display = "flex";
    }
    function closeForm() {
      document.getElementById("editForm").style.display = "none";
    }

    // Fungsi Search Universal
    function setupSearch(inputId, tableId) {
      document.getElementById(inputId).addEventListener("keyup", function() {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll(`#${tableId} tr:not(:first-child)`);
        rows.forEach(row => {
          let name = row.cells[1].textContent.toLowerCase();
          row.style.display = name.includes(value) ? "" : "none";
        });
      });
    }

    // Inisialisasi untuk ketiga halaman
    setupSearch("search-kelola", "table-kelola");
    setupSearch("search-setoran", "table-setoran");
    setupSearch("search-penarikan", "table-penarikan");
  </script>
</body>
</html>