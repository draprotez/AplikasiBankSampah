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

// Ambil riwayat transaksi setoran
$q3 = $conn->query("
  SELECT s.tanggal_setor, j.nama_jenis, s.berat_kg, s.total_harga
  FROM setoran s
  JOIN jenis_sampah j ON s.id_jenis = j.id_jenis
  WHERE s.id_user = '$id_user'
  ORDER BY s.tanggal_setor DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Nasabah</title>
  <link rel="stylesheet" href="../assets/css/nasabah.css">
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
        <tr><th>Tanggal</th><th>Jenis</th><th>Berat</th><th>Nominal</th></tr>
        <?php if ($q3->num_rows > 0): ?>
          <?php while ($row = $q3->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['tanggal_setor']); ?></td>
              <td><?= htmlspecialchars($row['nama_jenis']); ?></td>
              <td><?= htmlspecialchars($row['berat_kg']); ?> Kg</td>
              <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="4" style="text-align:center;">Belum ada transaksi</td></tr>
        <?php endif; ?>
      </table>
    </section>
  </div>

  <script>
    function showSection(id) {
        // Sembunyikan semua section & nonaktifkan semua tombol nav-btn
        document.querySelectorAll("section").forEach(sec => sec.classList.remove("active"));
        document.querySelectorAll(".nav-btn").forEach(btn => btn.classList.remove("active"));
        
        // Tampilkan section yang dipilih
        const sectionToShow = document.getElementById(id);
        if (sectionToShow) {
            sectionToShow.classList.add("active");
            // console.log("Showing section:", id); // Untuk debugging
        } else {
            // console.error("Section not found:", id); // Untuk debugging
        }
        
        // Aktifkan tombol yang sesuai (menggunakan ID tombol btn-...)
        const buttonToActivate = document.getElementById('btn-' + id); 
        if (buttonToActivate) {
            buttonToActivate.classList.add("active");
            // console.log("Activating button:", 'btn-' + id); // Untuk debugging
        } else {
             // console.warn("Button not found for section:", id); // Untuk debugging
        }
    }

    // Kode ini akan berjalan HANYA SEKALI saat halaman selesai dimuat
    window.addEventListener('DOMContentLoaded', (event) => {
        // console.log("DOM Loaded. Checking URL parameter..."); // Untuk debugging
        
        const urlParams = new URLSearchParams(window.location.search);
        const sectionParam = urlParams.get('section');
        
        // console.log("URL section parameter:", sectionParam); // Untuk debugging

        // Tentukan section mana yang harus ditampilkan pertama kali
        let initialSection = 'dashboard'; // Defaultnya dashboard
        if (sectionParam === 'riwayat') { // Jika URL bilang ?section=riwayat
            initialSection = 'riwayat';
        } 
        // Anda bisa tambahkan 'else if' lain jika ada section lain yang bisa di-link

        // console.log("Initial section to show:", initialSection); // Untuk debugging
        showSection(initialSection); // Panggil fungsi untuk menampilkannya
    });
</script>
</body>
</html>
