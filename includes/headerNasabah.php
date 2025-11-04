<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
    <h3 class="judul">Dashboard Nasabah</h3>

    <header class="header-nav">
        <a href="#" id="hamburger-menu-nasabah"><i data-feather="menu"></i></a>
        
        <nav>
            <a href="dashboardNasabah.php">Dashboard</a>
            <a href="dashboardNasabah.php?section=riwayat">Riwayat Transaksi</a>
        </nav>
    </header>

    <script>
        feather.replace();
        
        // Toggle menu untuk mobile
        const hamburgerButton = document.getElementById('hamburger-menu-nasabah');
        const navMenu = document.querySelector('.header-nav nav');
        
        hamburgerButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            navMenu.classList.toggle('active');
        });
        
        // Menutup menu saat klik di luar area
        document.addEventListener('click', function(e) {
            if (!navMenu.contains(e.target) && !hamburgerButton.contains(e.target)) {
                navMenu.classList.remove('active');
            }
        });
        
        // Menutup menu saat item menu diklik (opsional)
        navMenu.addEventListener('click', function(e) {
            if (e.target.tagName === 'A') {
                navMenu.classList.remove('active');
            }
        });
        
        // Menutup menu saat resize window (jika lebar window berubah menjadi desktop)
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                navMenu.classList.remove('active');
            }
        });
    </script>
</body>
</html>