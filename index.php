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
        <a href="login.php"><button class="login-btn">Login Nasabah</button></a>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <div class="hero-text">
        <h2>Ubah Sampah Jadi Rupiah, Bantu Lingkungan Tercinta</h2>
        <button class="cta-btn">Gabung Sekarang</button>
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
      <tr>
        <th>Jenis Sampah</th>
        <th>Berat(kg)</th>
        <th>Lapak(kg)</th>
        <th>Nasabah(kg)</th>
      </tr>
      <tr><td>Botol Plastik</td><td>10</td><td>Rp 2.000</td><td>20</td></tr>
      <tr><td>Kertas</td><td>5</td><td>Rp 1.000</td><td>30</td></tr>
      <tr><td>Kaleng</td><td>3</td><td>Rp 3.000</td><td>12</td></tr>
      <tr><td>Kardus</td><td>4</td><td>Rp 1.500</td><td>6</td></tr>
    </table>
  </section>

  <!-- Footer -->
  <footer>
    <p>Alamat Bank Sampah Anda | Hubungi Kami: 0812-3456-7890</p>
    <p>© 2025 Bank Sampah Anda. All Rights Reserved.</p>
  </footer>

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
