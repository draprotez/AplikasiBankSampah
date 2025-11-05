<?php
session_start();
include '../config/database.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit;
}

$id_user = $_SESSION['user_id'];

// Hitung total setoran
$q1 = $conn->query("SELECT SUM(total_harga) AS total_setor FROM setoran WHERE id_user = '$id_user'");
$total_setor = $q1->fetch_assoc()['total_setor'] ?? 0;

// Hitung total penarikan
$q2 = $conn->query("SELECT SUM(jumlah) AS total_tarik FROM penarikan WHERE id_user = '$id_user'");
$total_tarik = $q2->fetch_assoc()['total_tarik'] ?? 0;

// Hitung saldo akhir
$saldo = $total_setor - $total_tarik;

$transaksi = [];

// Ambil riwayat transaksi setoran
$q_setoran = $conn->query("
  SELECT s.tanggal_setor AS tanggal, j.nama_jenis, s.berat_kg, s.total_harga AS nominal, 'Setoran' AS tipe
  FROM setoran s
  JOIN jenis_sampah j ON s.id_jenis = j.id_jenis
  WHERE s.id_user = '$id_user'
");
if ($q_setoran->num_rows > 0) {
    while ($row = $q_setoran->fetch_assoc()) {
        $transaksi[] = $row;
    }
}

// Ambil riwayat transaksi penarikan
$q_penarikan = $conn->query("
  SELECT tanggal_penarikan AS tanggal, metode AS nama_jenis, NULL AS berat_kg, jumlah AS nominal, 'Penarikan' AS tipe
  FROM penarikan
  WHERE id_user = '$id_user'
");
if ($q_penarikan->num_rows > 0) {
     while ($row = $q_penarikan->fetch_assoc()) {
        $transaksi[] = $row;
    }
}

// Urutkan semua transaksi berdasarkan tanggal (terbaru dulu)
usort($transaksi, function($a, $b) {
    return strtotime($b['tanggal']) - strtotime($a['tanggal']);
});

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Nasabah</title>
  <link rel="stylesheet" href="../assets/css/nasabah.css">
  <link rel="website icon" type="png" href="../assets/images/bsmam.png" />
</head>
<body>

<?php include '../includes/headerNasabah.php'; ?>

  <div class="content">
    <!-- Dashboard -->
    <section id="dashboard" class="active">
      <h2>Hallo <?= htmlspecialchars($_SESSION['username']); ?>!</h2>
      <div class="saldo-card">
        <p class="saldo-label">Saldo Anda</p>
        <h1 class="saldo-amount">Rp <?= number_format($saldo, 0, ',', '.'); ?></h1>
      </div>
    </section>

    <!-- Riwayat -->
    <section id="riwayat">
      <h2>Riwayat Transaksi</h2>
      <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jenis Transaksi</th>
                <th>Detail</th>
                <th>Nominal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($transaksi)): ?>
              <tr><td colspan="4" style="text-align:center;">Belum ada transaksi</td></tr>
            <?php else: ?>
              <?php foreach ($transaksi as $trx): ?>
                <tr>
                  <td><?= htmlspecialchars($trx['tanggal']); ?></td>
                  <td>
                      <?php if ($trx['tipe'] == 'Setoran'): ?>
                          <span style="color: green; font-weight: bold;">Setoran</span>
                      <?php else: ?>
                          <span style="color: red; font-weight: bold;">Penarikan</span>
                      <?php endif; ?>
                  </td>
                  <td>
                      <?php 
                      if ($trx['tipe'] == 'Setoran') {
                          echo htmlspecialchars($trx['nama_jenis']) . ' (' . htmlspecialchars($trx['berat_kg']) . ' Kg)';
                      } else {
                          echo 'Metode: ' . htmlspecialchars($trx['nama_jenis']); // nama_jenis berisi metode untuk penarikan
                      }
                      ?>
                  </td>
                  <td style="text-align: right;">
                      <?php 
                      if ($trx['tipe'] == 'Setoran') {
                          echo '+ ' . number_format($trx['nominal'], 0, ',', '.');
                      } else {
                          echo '- ' . number_format($trx['nominal'], 0, ',', '.');
                      }
                      ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
      </table>
    </section>
    <br>
    <button type="button" 
        onclick="window.location.href='../logout.php'" 
        style="
            background-color: #FF0000; /* Warna merah */
            color: #FFFFFF;           /* Warna teks putih */
            padding: 10px 25px;       /* Padding atas/bawah & kiri/kanan */
            border: none;             /* Hapus border */
            border-radius: 8px;       /* Sudut melengkung */
            font-family: 'Poppins', sans-serif; /* Font */
            font-size: 15px;          /* Ukuran font */
            font-weight: 500;         /* Ketebalan font */
            cursor: pointer;          /* Kursor tangan */
            text-align: center;       /* Teks di tengah */
            text-decoration: none;    /* Hapus garis bawah */
            display: inline-block;    /* Agar padding berfungsi */
            margin-top: 20px;         /* Jarak dari atas (opsional) */
        ">
    Logout
</button>
  </div>

      <?php include '../includes/footer.php'; ?>


  <script>
    function showSection(id) {
        // Sembunyikan semua section & nonaktifkan semua tombol nav-btn
        document.querySelectorAll("section").forEach(sec => sec.classList.remove("active"));
        document.querySelectorAll(".nav-btn").forEach(btn => btn.classList.remove("active"));
        
        // Tampilkan section yang dipilih
        const sectionToShow = document.getElementById(id);
        if (sectionToShow) {
            sectionToShow.classList.add("active");
        } else {
        }
        
        // Aktifkan tombol
        const buttonToActivate = document.getElementById('btn-' + id); 
        if (buttonToActivate) {
            buttonToActivate.classList.add("active");
        } else {
        }
    }

    // Kode ini akan berjalan HANYA SEKALI
    window.addEventListener('DOMContentLoaded', (event) => {
        
        const urlParams = new URLSearchParams(window.location.search);
        const sectionParam = urlParams.get('section');

        // Tentukan section mana yang harus ditampilkan pertama kali
        let initialSection = 'dashboard';
        if (sectionParam === 'riwayat') {
            initialSection = 'riwayat';
        } 
        showSection(initialSection);
    });
</script>
</body>
</html>
