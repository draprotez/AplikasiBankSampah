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
  <style>
    .pagination-controls {
          text-align: center;
          margin-top: 20px;
          display: flex; /* Agar tombol dan info sejajar */
          justify-content: center;
          align-items: center;
          gap: 10px; /* Jarak antar elemen */
      }
      .pagination-controls button {
          background-color: #2ecc71;
          color: white;
          border: none;
          padding: 8px 15px;
          border-radius: 5px;
          cursor: pointer;
          font-family: 'Poppins', sans-serif;
          transition: background-color 0.2s ease;
      }
      .pagination-controls button:hover:not(:disabled) { /* Efek hover hanya jika tidak disabled */
          background-color: #27ae60;
      }
      .pagination-controls button:disabled {
          background-color: #cccccc;
          cursor: not-allowed;
          opacity: 0.6;
      }
      .page-info {
          font-size: 14px;
          font-weight: 500;
          color: #555;
      }
      /* Sembunyikan baris yang tidak aktif */
      tbody#jenisSampahTableBody tr.hidden-row {
         display: none;
      }
  </style>
</head>
<body>
  <!-- Navbar -->
  <header class="navbar">
    <div class="nav-container">
      <div class="logo">
        <img src="assets/images/bsmam.png" alt="" style="height: 50px; width: auto;">
        Migunani Asri Madani
      </div>
      <div class="nav-right">
        <ul>
          <li><a href="#About" >Beranda</a></li>
          <li><a href="#Steps">Cara Kerja</a></li>
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
      <img src="assets/images/logobs1.jpg" alt="Bank Sampah" class="hero-image">
    </div>
  </section>

  <!-- Tentang Kami -->
  <section class="about" id="About">
    <h2>Tentang Kami</h2>
    <p>
      Bank Sampah Migunani Asri Madani adalah sebuah organisasi masyarakat yang aktif dalam pengelolaan limbah dengan melibatkan partisipasi publik. Kami hadir sebagai alternatif praktis untuk mengurangi akumulasi sampah melalui sistem yang mirip dengan perbankan, di mana masyarakat dapat menyimpan limbah yang masih memiliki nilai jual.
    </p>
    <div class="visi-misi">
      <div class="visi">
        <h3>Visi</h3>
        <p>"Mewujudkan lingkungan bersih, sehat, dan berkelanjutan melalui pengelolaan sampah yang bernilai ekonomi."</p>
      </div>
      <div class="misi">
        <h3>Misi</h3>
        <p>1.Meningkatkan kesadaran masyarakat akan pentingnya memilah dan mengelola sampah. <br>

          2.Mengubah sampah menjadi sumber daya yang bermanfaat dan bernilai jual. <br>

          3.Mendorong partisipasi aktif warga dalam menjaga kebersihan lingkungan. <br>

          4.Menjalin kerja sama dengan pemerintah dan mitra dalam pengelolaan sampah berkelanjutan.</p>
      </div>
    </div>

    <h2>Struktural Kepengurusan</h2>
    <div class="struktur-text">
      <img src="assets/images/struktur.png" alt="">
    </div>

    <!-- Struktur Carousel -->
    <div class="struktur-carousel">
      <button class="arrow prev">&#10094;</button>
      <div class="struktur-track">
        <div class="struktur-card">
          <img src="assets/images/logobs2.jpg" alt="">
          </div>
        <div class="struktur-card">
          <img src="assets/images/logobs5.jpg" alt="">
          </div>
        <div class="struktur-card">
          <img src="assets/images/logobs6.jpg" alt="">
          </div>
      </div>
      <button class="arrow next">&#10095;</button>
    </div>
  </section>

  <!-- Cara Kerja -->
  <section class="steps" id="Steps">
    <h2>Cara Kerjanya?</h2>
    <div class="step-container">
      <div class="step">
        <img src="assets/images/logobs9.png" alt="">
        <p>1. Kumpulkan Sampah</p>
      </div>
      <div class="step">
        <img src="assets/images/logobs8.png" alt="">
        <p>2. Timbang di Bank Sampah</p>
      </div>
      <div class="step">
        <img src="assets/images/logobs7.png" alt="">
        <p>3. Dapatkan Saldo Rupiah</p>
      </div>
    </div>

    <h3>Sampah Apa Saja yang Diterima?</h3>
    <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Jenis Sampah</th>
              <th>Harga per Kg (Rp)</th>
            </tr>
          </thead>
          <tbody id="jenisSampahTableBody">
            <?php if (empty($jenis_sampah_list)): ?>
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
    </div>

    <div id="paginationControls" class="pagination-controls">
        <button id="prevButton" disabled>« Previous</button>
        <span id="pageInfo" class="page-info">Halaman 1 dari 1</span>
        <button id="nextButton" disabled>Next »</button>
    </div>
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

    const tableBody = document.getElementById('jenisSampahTableBody');
    const rows = tableBody.getElementsByTagName('tr');
    const prevButton = document.getElementById('prevButton');
    const nextButton = document.getElementById('nextButton');
    const pageInfo = document.getElementById('pageInfo');

    const itemsPerPage = 10; // Tampilkan 10 item per halaman
    const totalItems = rows.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    let currentPage = 1;

    // --- Fungsi untuk menampilkan halaman tertentu ---
    function displayPage(page) {
        currentPage = page;
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;

        // Sembunyikan/Tampilkan baris sesuai halaman
        for (let i = 0; i < totalItems; i++) {
            if (i >= startIndex && i < endIndex) {
                rows[i].classList.remove('hidden-row');
                rows[i].style.display = ""; // Pastikan tampil
            } else {
                rows[i].classList.add('hidden-row');
                rows[i].style.display = "none"; // Sembunyikan
            }
        }
        updatePaginationControls(); // Perbarui tombol dan info halaman
    }

    // --- Fungsi untuk update status tombol & info halaman ---
    function updatePaginationControls() {
        // Update teks info halaman
        pageInfo.textContent = `Halaman ${currentPage} dari ${totalPages}`;

        // Aktifkan/Nonaktifkan tombol Previous
        prevButton.disabled = currentPage === 1;

        // Aktifkan/Nonaktifkan tombol Next
        nextButton.disabled = currentPage === totalPages;
    }

    // --- Event listener untuk tombol ---
    prevButton.addEventListener('click', () => {
        if (currentPage > 1) {
            displayPage(currentPage - 1);
        }
    });

    nextButton.addEventListener('click', () => {
        if (currentPage < totalPages) {
            displayPage(currentPage + 1);
        }
    });

    // --- Inisialisasi saat halaman dimuat ---
    if (totalItems > 0 && totalPages > 0) { // Hanya jalankan jika ada data & halaman
         displayPage(1); // Tampilkan halaman pertama
    } else {
         // Sembunyikan kontrol jika tidak ada data atau hanya 1 halaman
         document.getElementById('paginationControls').style.display = 'none';
    }
  </script>

</body>
</html>
