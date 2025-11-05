<?php
include 'config/database.php';

// Table Jenis Sampah
$query_jenis_sampah = $conn->query("SELECT nama_jenis, harga_per_kg FROM jenis_sampah ORDER BY nama_jenis ASC");
$jenis_sampah_list = []; // Siapkan array kosong
if ($query_jenis_sampah && $query_jenis_sampah->num_rows > 0) {
    $jenis_sampah_list = $query_jenis_sampah->fetch_all(MYSQLI_ASSOC);
}
// Berita
$query_berita = $conn->query("SELECT judul, konten, gambar FROM berita ORDER BY tanggal_post DESC LIMIT 5"); 
$berita_list = [];
if ($query_berita && $query_berita->num_rows > 0) {
    $berita_list = $query_berita->fetch_all(MYSQLI_ASSOC);
}
// Footer
$tahunSekarang = date("Y"); 
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bank Sampah Anda</title>
  <link rel="website icon" type="png" href="assets/images/bsmam.png" />
  <link rel="stylesheet" href="assets/css/styles-index.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/feather-icons"></script>
  <style>
    
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
        <button id="hamburger-menu">
            <i data-feather="menu"></i>
        </button>
        <div class="menu-overlay"></div>
        <div class="nav-right"> <!-- PERBAIKI: HAPUS EXTRA 'd' -->
            <ul>
                <li><a href="#About">Beranda</a></li>
                <li><a href="#Steps">Cara Kerja</a></li>
                <li class="nav-dropdown">
                    <a href="#" class="dropdown-toggle">Kontak</a>
                    <div class="dropdown-menu">
                        <a href="https://www.youtube.com/@banksampahmigunaniasrimada9587?si=VRvTW7M_A-BuiT3E" target="_blank">YouTube BS MAM</a>
                        <a href="https://www.youtube.com/channel/UCfl4CWSqsyHxavGZdjO_6wA" target="_blank">YouTube RW.05</a>
                        <a href="https://www.instagram.com/bsmam05?igsh=bG8xYnQ0NXA0anpl" target="_blank">Instagram</a>
                    </div>
                </li>
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

    <h2>Profil Pengurus Bank Sampah Migunani Asri Madani</h2>
    <div class="struktur-text">
        <table>
            <tr>
                <td class="col-1"><img src="assets/images/profil/1.png" alt="">
    <p>PURWONO <br> PEMBINA </p></td>
                <td class="col-2"><img src="assets/images/profil/2.png" alt="">
    <p>BAMBANG SETYO TRIWIYANTO<br> PEMBINA </p></td>
                <td class="col-3"><img src="assets/images/profil/3.png" alt="">
    <p>NURHILALUDIN <br> PEMBINA </p></td>
            </tr>
            <tr>
                <td class="col-1"><img src="assets/images/profil/4.png" alt="">
    <p>VIVI FITRIANI <br> KETUA </p></td>
                <td class="col-2"><img src="assets/images/profil/5.png" alt="">
    <p>SHINTA DEWI <br> SEKRETARIS </p></td>
                <td class="col-3"><img src="assets/images/profil/7.png" alt="">
    <p>SUPRAMININGSIH  <br> BENDAHARA </p></td>
            </tr>
            <tr>
                <td class="col-1"><img src="assets/images/profil/6.png" alt="">
    <p>CHRISTINA IKA ANDRIWARINI  <br> ANGGOTA(PENIMBANGAN) </p></td>
                <td class="col-2"><img src="assets/images/profil/11.png" alt="">
    <p>ROHAYAH <br> ANGGOTA(PENIMBANGAN) </p></td>
                <td class="col-3"><img src="assets/images/profil/12.png" alt="">
    <p>YANI ASTUTI  <br> ANGGOTA(PENIMBANGAN) </p></td>
            </tr>
            <tr>
                <td class="col-1"><img src="assets/images/profil/16.png" alt="">
    <p>SISTI IRAWATI <br> ANGGOTA(PENIMBANGAN) </p></td>
                <td class="col-2"><img src="assets/images/profil/17.png" alt="">
    <p>NITA LESTARI YANTI <br> ANGGOTA(PENIMBANGAN) </p></td>
            </tr>
            <tr>
                <td class="col-1"><img src="assets/images/profil/8.png" alt="">
    <p>ISTININGSIH RAHAYU  <br> ANGGOTA(PENCATATAN) </p></td>
                <td class="col-2"><img src="assets/images/profil/9.png" alt="">
    <p>ATI KARMILA  <br> ANGGOTA(PENCATATAN) </p></td>
                <td class="col-3"><img src="assets/images/profil/10.png" alt="">
    <p>YATUN <br> ANGGOTA(PENCATATAN)  </p></td>
            </tr>
            <tr>
                <td class="col-1"><img src="assets/images/profil/13.png" alt="">
    <p>SITI AINUN RANGKUTI  <br> ANGGOTA(PENCATATAN) </p></td>
                <td class="col-2"><img src="assets/images/profil/15.png" alt="">
    <p>TRI DATI NINGSIH <br> ANGGOTA(PENCATATAN) </p></td>
                <td class="col-3"><img src="assets/images/profil/14.png" alt="">
    <p>KARTIKA <br> ANGGOTA(PEMILAHAN) </p></td>
            </tr>
            <tr>
                <td class="col-1"><img src="assets/images/profil/18.png" alt="">
    <p>YULIANSIH <br> ANGGOTA </p></td>
                <td class="col-2"><img src="assets/images/profil/19.png" alt="">
    <p>TARMINI <br> ANGGOTA </p></td>
                <td class="col-3"><img src="assets/images/profil/20.png" alt="">
    <p>IDA NURSANTI <br> ANGGOTA </p></td>
            </tr>
            <tr>
                <td class="col-1"><img src="assets/images/profil/21.png" alt="">
    <p>IDA NURSANTI <br> ANGGOTA </p></td>
                <td class="col-2"><img src="assets/images/profil/22.png" alt="">
    <p>RAMTONO <br> ANGGOTA(TIDAK TETAP) </p></td>
            </tr>
        </table>
    </div>

    <!-- Struktur Carousel -->
    <div class="struktur-carousel">
      <button class="arrow prev">&#10094;</button>
      <div class="struktur-track">
        
        <?php if (empty($berita_list)): ?>
            <div class="struktur-card">
              <p style="text-align:center; padding: 20px;">Belum ada berita atau kegiatan.</p>
            </div>
        <?php else: ?>
            <?php foreach ($berita_list as $berita): ?>
              <div class="struktur-card">
                <img src="assets/images/berita/<?php echo htmlspecialchars($berita['gambar']); ?>" alt="<?php echo htmlspecialchars($berita['judul']); ?>">
                <p>
                    <strong><?php echo htmlspecialchars($berita['judul']); ?></strong><br>
                    <?php 
                        $konten_singkat = htmlspecialchars($berita['konten']);
                        if (strlen($konten_singkat) > 100) {
                            $konten_singkat = substr($konten_singkat, 0, 100) . '...';
                        }
                        echo $konten_singkat;
                    ?>
                </p>
              </div>
            <?php endforeach; ?>
        <?php endif; ?>

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
  <footer class="main-footer">
  <div class="footer-content">
    <p>&copy; <?php echo $tahunSekarang; ?> <a href="https://github.com/draprotez">draprotez</a>. All Rights Reserved.</p>
    </div>
  </footer>

  <script>
    // Inisialisasi Feather Icons
    feather.replace();

    // Deklarasi variabel global
    const hamburgerMenu = document.getElementById('hamburger-menu');
    const navRight = document.querySelector('.nav-right');
    const menuOverlay = document.querySelector('.menu-overlay');
    const navDropdown = document.querySelector('.nav-dropdown');
    const dropdownToggle = document.querySelector('.dropdown-toggle');

    // ===== FIX: FUNGSI UNTUK MENUTUP SEMUA MENU =====
    function closeAllMenus() {
        if (navRight) navRight.classList.remove('active');
        if (menuOverlay) menuOverlay.classList.remove('active');
        if (navDropdown) navDropdown.classList.remove('active');
        
        // Kembalikan icon ke menu
        if (hamburgerMenu) {
            const icon = hamburgerMenu.querySelector('i');
            if (icon) {
                icon.setAttribute('data-feather', 'menu');
                feather.replace();
            }
        }
    }

    // ===== HAMBURGER MENU =====
    if (hamburgerMenu && navRight && menuOverlay) {
        hamburgerMenu.addEventListener('click', function(e) {
            e.stopPropagation();
            const isActive = navRight.classList.contains('active');
            
            // Tutup semua menu dulu
            closeAllMenus();
            
            // Jika sebelumnya tidak aktif, buka menu utama
            if (!isActive) {
                navRight.classList.add('active');
                menuOverlay.classList.add('active');
                
                // Ganti icon ke close
                const icon = this.querySelector('i');
                if (icon) {
                    icon.setAttribute('data-feather', 'x');
                    feather.replace();
                }
            }
        });
    }

    // ===== DROPDOWN KONTAK - FIXED VERSION =====
    if (dropdownToggle && navDropdown) {
        dropdownToggle.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                e.stopPropagation();
                
                // Tutup dropdown lain jika ada yang terbuka
                document.querySelectorAll('.nav-dropdown').forEach(dropdown => {
                    if (dropdown !== navDropdown) {
                        dropdown.classList.remove('active');
                    }
                });
                
                // Toggle dropdown yang diklik
                navDropdown.classList.toggle('active');
                
                // Pastikan menu utama tetap terbuka di mobile
                if (navRight) navRight.classList.add('active');
                if (menuOverlay) menuOverlay.classList.add('active');
            }
        });

        // Untuk desktop - hover functionality
        if (window.innerWidth > 768) {
            navDropdown.addEventListener('mouseenter', function() {
                const dropdownMenu = this.querySelector('.dropdown-menu');
                if (dropdownMenu) dropdownMenu.style.display = 'block';
            });
            
            navDropdown.addEventListener('mouseleave', function() {
                const dropdownMenu = this.querySelector('.dropdown-menu');
                if (dropdownMenu) dropdownMenu.style.display = 'none';
            });
        }
    }

    // ===== OVERLAY UNTUK MENUTUP MENU =====
    if (menuOverlay) {
        menuOverlay.addEventListener('click', function() {
            closeAllMenus();
        });
    }

    // ===== TUTUP MENU SAAT KLIK DI LUAR - FIXED =====
    document.addEventListener('click', function(e) {
        // Jika klik di luar navbar dan bukan hamburger menu
        if (!e.target.closest('.navbar') && !e.target.closest('#hamburger-menu')) {
            closeAllMenus();
        }
        
        // Jika klik di luar dropdown kontak di desktop
        if (window.innerWidth > 768 && navDropdown) {
            if (!e.target.closest('.nav-dropdown')) {
                const dropdownMenu = navDropdown.querySelector('.dropdown-menu');
                if (dropdownMenu) dropdownMenu.style.display = 'none';
            }
        }
        
        // Jika klik di luar dropdown kontak di mobile
        if (window.innerWidth <= 768 && navDropdown) {
            if (!e.target.closest('.nav-dropdown')) {
                navDropdown.classList.remove('active');
            }
        }
    });

    // ===== RESIZE HANDLER - FIXED =====
    window.addEventListener('resize', function() {
        // Reset semua menu saat resize ke desktop
        if (window.innerWidth > 768) {
            closeAllMenus();
            
            // Reset dropdown display untuk desktop
            if (navDropdown) {
                const dropdownMenu = navDropdown.querySelector('.dropdown-menu');
                if (dropdownMenu) dropdownMenu.style.display = 'none';
            }
        }
    });

    // ===== SMOOTH SCROLL =====
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href !== '') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    // Hitung offset untuk navbar fixed
                    const navbarHeight = document.querySelector('.navbar')?.offsetHeight || 0;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - navbarHeight;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                    
                    // Tutup menu mobile setelah klik link
                    if (window.innerWidth <= 768) {
                        closeAllMenus();
                    }
                }
            }
        });
    });

    // ===== CAROUSEL FUNCTIONALITY =====
    const prev = document.querySelector('.prev');
    const next = document.querySelector('.next');
    const track = document.querySelector('.struktur-track');
    
    if (prev && next && track) {
        let position = 0;
        const cardWidth = 320;
        const totalCards = track.children.length;
        const maxPosition = -((totalCards - 1) * cardWidth);

        next.addEventListener('click', () => {
            position -= cardWidth;
            if (position < maxPosition) position = 0;
            track.style.transform = `translateX(${position}px)`;
        });

        prev.addEventListener('click', () => {
            position += cardWidth;
            if (position > 0) position = maxPosition;
            track.style.transform = `translateX(${position}px)`;
        });
    }

    // ===== PAGINATION FUNCTIONALITY =====
    const tableBody = document.getElementById('jenisSampahTableBody');
    const paginationControls = document.getElementById('paginationControls');
    
    if (tableBody && paginationControls) {
        const rows = tableBody.getElementsByTagName('tr');
        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');
        const pageInfo = document.getElementById('pageInfo');

        if (prevButton && nextButton && pageInfo) {
            const itemsPerPage = 10;
            const totalItems = rows.length;
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            let currentPage = 1;

            function displayPage(page) {
                currentPage = page;
                const startIndex = (page - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;

                for (let i = 0; i < totalItems; i++) {
                    if (i >= startIndex && i < endIndex) {
                        rows[i].classList.remove('hidden-row');
                        rows[i].style.display = "";
                    } else {
                        rows[i].classList.add('hidden-row');
                        rows[i].style.display = "none";
                    }
                }
                updatePaginationControls();
            }

            function updatePaginationControls() {
                pageInfo.textContent = `Halaman ${currentPage} dari ${totalPages}`;
                prevButton.disabled = currentPage === 1;
                nextButton.disabled = currentPage === totalPages;
            }

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

            if (totalItems > 0 && totalPages > 0) {
                displayPage(1);
            } else {
                paginationControls.style.display = 'none';
            }
        }
    }

    // ===== FIX: EVENT LISTENER UNTUK LINK DROPDOWN =====
    document.querySelectorAll('.dropdown-menu a').forEach(link => {
        link.addEventListener('click', function(e) {
            // Biarkan link berfungsi normal
            if (window.innerWidth <= 768) {
                // Tutup menu mobile setelah klik link dropdown
                setTimeout(() => {
                    closeAllMenus();
                }, 300);
            }
        });
    });
</script>

</body>
</html>
