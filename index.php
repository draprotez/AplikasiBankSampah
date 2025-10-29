<?php
// --- TAMBAHKAN BLOK PHP INI DI PALING ATAS ---
include 'config/database.php'; // Sesuaikan path ke file koneksi database Anda

// Ambil data dari tabel jenis_sampah
$query_jenis_sampah = $conn->query("SELECT nama_jenis, harga_per_kg FROM jenis_sampah ORDER BY nama_jenis ASC");
$jenis_sampah_list = []; // Siapkan array kosong
if ($query_jenis_sampah && $query_jenis_sampah->num_rows > 0) {
    $jenis_sampah_list = $query_jenis_sampah->fetch_all(MYSQLI_ASSOC);
}
// --- AKHIR BLOK PHP BARU ---
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bank Sampah Anda</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <header class="navbar">
    <div class="nav-container">
      <div class="logo">Bank Sampah Anda</div>
      <div class="nav-right">
        <ul>
          <li><a href="#">Beranda</a></li>
          <li><a href="#">Cara Kerja</a></li>
        </ul>
        <a href="login.php"><button class="login-btn">Login</button></a>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <div class="hero-text">
        <h2>Ubah Sampah Jadi Rupiah, Bantu Lingkungan Tercinta</h2>
        <a href="register.php"><button class="cta-btn">Gabung Sekarang</button></a>
      </div>
      <img src="assets/images/jus.jpg" alt="Bank Sampah" class="hero-image">
    </div>
  </section>

  <!-- Tentang Kami -->
  <section class="about">
    <h2>Tentang Kami</h2>
    <p>
      Bank Sampah Anda adalah inisiatif lingkungan yang mengajak masyarakat untuk menabung sampah
      dan mendapatkan manfaat ekonomi. Dengan konsep ramah lingkungan, kami membantu masyarakat
      mendaur ulang sampah menjadi sesuatu yang bernilai.
    </p>

    <div class="visi-misi">
      <div class="visi">
        <h3>Visi</h3>
        <p>Mewujudkan lingkungan yang bersih dan sehat melalui pengelolaan sampah berbasis ekonomi sirkular.</p>
      </div>
      <div class="misi">
        <h3>Misi</h3>
        <p>Mengedukasi masyarakat, meningkatkan kesadaran lingkungan, dan menciptakan sistem pengelolaan
        sampah berkelanjutan yang memberikan manfaat ekonomi bagi warga.</p>
      </div>
    </div>

    <h2>Struktural Kepengurusan</h2>
    <div class="struktur-text">
      Penasihat Ketua RW 05 GSA<br>
      Pembina I Purwono<br>
      Pembina II Bambang Tri S<br>
      Ketua Vivi Fitriani S.Sos<br>
      Sekretaris I Shinta Dewi<br>
      Sekretaris II Yoko Nita<br>
      Bendahara Suprapminingsih
    </div>

    <!-- Struktur Carousel -->
    <div class="struktur-carousel">
      <button class="arrow prev">&#10094;</button>
      <div class="struktur-track">
        <div class="struktur-card">
          <img src="jus.jpg" alt="Struktur 1">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="struktur-card">
          <img src="jus.jpg" alt="Struktur 2">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="struktur-card">
          <img src="jus.jpg" alt="Struktur 3">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
      </div>
      <button class="arrow next">&#10095;</button>
    </div>
  </section>

  <!-- Cara Kerja -->
  <section class="steps">
    <h2>Cara Kerjanya?</h2>
    <div class="step-container">
      <div class="step">
        <img src="jus.jpg" alt="Step 1">
        <p>1. Kumpulkan Sampah</p>
      </div>
      <div class="step">
        <img src="jus.jpg" alt="Step 2">
        <p>2. Timbang di Bank Sampah</p>
      </div>
      <div class="step">
        <img src="jus.jpg" alt="Step 3">
        <p>3. Dapatkan Saldo Rupiah</p>
      </div>
    </div>

    <h3>Sampah Apa Saja yang Diterima?</h3>
    <table>
      <thead> <tr>
          <th>Jenis Sampah</th>
          <th>Harga per Kg (Rp)</th>
          </tr>
      </thead>
      <tbody> <?php if (empty($jenis_sampah_list)): ?>
          <tr>
            <td colspan="2" style="text-align: center;">Data jenis sampah belum tersedia.</td>
            </tr>
        <?php else: ?>
          <?php foreach ($jenis_sampah_list as $sampah): ?>
            <tr>
              <td><?php echo htmlspecialchars($sampah['nama_jenis']); ?></td>
              <td><?php echo number_format($sampah['harga_per_kg'], 0, ',', '.'); ?></td>
              </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </section>

  <!-- Footer -->
  <?php include 'includes/footer.php'; ?>

  <script>
    const prev = document.querySelector('.prev');
    const next = document.querySelector('.next');
    const track = document.querySelector('.struktur-track');
    let position = 0;

    next.addEventListener('click', () => {
      position -= 320;
      if (position < -640) position = 0;
      track.style.transform = `translateX(${position}px)`;
    });

    prev.addEventListener('click', () => {
      position += 320;
      if (position > 0) position = -640;
      track.style.transform = `translateX(${position}px)`;
    });
  </script>
</body>
</html>
