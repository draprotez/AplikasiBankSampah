<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Nasabah</title>
  <link rel="stylesheet" href="../assets/css/nasabah.css">
</head>
<body>
  <h3 class="judul">Dashboard Nasabah</h3>

  <div class="navbar">
    <button class="nav-btn active" onclick="showSection('dashboard')">Dashboard</button>
    <button class="nav-btn" onclick="showSection('riwayat')">Riwayat Transaksi</button>
    <a href="../logout.php" class="log-btn">Logout</a>
  </div>

  <div class="content">
    <!-- Dashboard -->
    <section id="dashboard" class="active">
      <h2>Hallo Nasabah!</h2>
      <div class="saldo-card">
        <p class="saldo-label">Saldo Anda</p>
        <h1 class="saldo-amount">Rp 14.000.000</h1>
      </div>
    </section>

    <!-- Setor Sampah -->
    <section id="setor">
      <h2>Setor Sampah</h2>
      <form class="form">
        <label>Jenis Sampah</label>
        <input type="text" placeholder="Contoh: Botol Plastik">
        <label>Berat (Kg)</label>
        <input type="number" placeholder="Masukkan berat sampah">
        <button class="btn-green">Kirim Setoran</button>
      </form>
    </section>

    <!-- Penarikan -->
    <section id="penarikan">
      <h2>Penarikan Dana</h2>
      <form class="form">
        <label>Jumlah Penarikan</label>
        <input type="number" placeholder="Masukkan jumlah penarikan">
        <label>Metode</label>
        <select>
          <option>Ambil Tunai</option>
          <option>Transfer Bank</option>
        </select>
        <button class="btn-green">Ajukan Penarikan</button>
      </form>
    </section>

    <!-- Riwayat -->
    <section id="riwayat">
      <h2>Riwayat Transaksi</h2>
      <table>
        <tr><th>Tanggal</th><th>Jenis</th><th>Berat</th><th>Nominal</th></tr>
        <tr><td>23-11-2025</td><td>Plastik</td><td>3</td><td>Rp 6.000</td></tr>
        <tr><td>20-11-2025</td><td>Kertas</td><td>5</td><td>Rp 10.000</td></tr>
      </table>
    </section>
  </div>

  <script>
    function showSection(id) {
      document.querySelectorAll("section").forEach(sec => sec.classList.remove("active"));
      document.querySelectorAll(".nav-btn").forEach(btn => btn.classList.remove("active"));
      document.getElementById(id).classList.add("active");
      event.target.classList.add("active");
    }
  </script>
</body>
</html>