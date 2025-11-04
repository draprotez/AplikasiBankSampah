-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2025 at 01:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_banksampah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`, `created_at`) VALUES
(9, 'Administrator Migunani Asri Madani', 'AdminMAM', '$2y$10$gaaJ0FvnR.bh10d3PVIK9uLCkv1A3nVZYVbBn4ToM2czLkhDDaHeS', '2025-10-30 07:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal_post` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_sampah`
--

CREATE TABLE `jenis_sampah` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(100) NOT NULL,
  `kategori` enum('organik','anorganik','elektronik','logam') NOT NULL,
  `harga_per_kg` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_sampah`
--

INSERT INTO `jenis_sampah` (`id_jenis`, `nama_jenis`, `kategori`, `harga_per_kg`, `created_at`) VALUES
(4, 'Acrylic', 'anorganik', 1000.00, '2025-10-30 02:26:14'),
(5, 'Aki motor/mobil', 'elektronik', 6000.00, '2025-10-30 02:26:14'),
(6, 'Aluminium, teflon', 'logam', 7000.00, '2025-10-30 02:26:14'),
(7, 'Antena, siku', 'logam', 10000.00, '2025-10-30 02:26:14'),
(8, 'Besi, pedal/sadel sepeda, knalpot', 'logam', 3000.00, '2025-10-30 02:26:14'),
(9, 'Bodong warna (BW)', 'anorganik', 1300.00, '2025-10-30 02:26:14'),
(10, 'Botol Bersih (BB)', 'anorganik', 3200.00, '2025-10-30 02:26:14'),
(11, 'Botol syrup, beling (BS)', 'anorganik', 200.00, '2025-10-30 02:26:14'),
(12, 'Boncos Kertas', 'anorganik', 300.00, '2025-10-30 02:26:14'),
(13, 'Botol/gelas Kotor (BK)', 'anorganik', 1500.00, '2025-10-30 02:26:14'),
(14, 'Duplex', 'anorganik', 300.00, '2025-10-30 02:26:14'),
(15, 'Emberan/ mainan', 'anorganik', 1000.00, '2025-10-30 02:26:14'),
(16, 'Ember hitam', 'anorganik', 900.00, '2025-10-30 02:26:14'),
(17, 'Fiber pagar', 'anorganik', 700.00, '2025-10-30 02:26:14'),
(18, 'Galon merk aqua, vit/satuan', 'anorganik', 3500.00, '2025-10-30 02:26:14'),
(19, 'Gelas Ale-ale (GA)', 'anorganik', 1000.00, '2025-10-30 02:26:14'),
(20, 'Gelas Bersih (GB)', 'anorganik', 3000.00, '2025-10-30 02:26:14'),
(21, 'Gelas Stiker (GS)', 'anorganik', 1000.00, '2025-10-30 02:26:14'),
(22, 'HP', 'elektronik', 1700.00, '2025-10-30 02:26:14'),
(23, 'Hornest', 'anorganik', 400.00, '2025-10-30 02:26:14'),
(24, 'Impact, helm, yakult, LED, charger, printer', 'anorganik', 700.00, '2025-10-30 02:26:14'),
(25, 'Inject', 'anorganik', 1000.00, '2025-10-30 02:26:14'),
(26, 'Jas hujan bagus, karpet talang', 'anorganik', 700.00, '2025-10-30 02:26:14'),
(27, 'Kabel Besar (KB)', 'logam', 1500.00, '2025-10-30 02:26:14'),
(28, 'Kabel Kecil (KK)', 'logam', 2500.00, '2025-10-30 02:26:14'),
(29, 'Kabin, stainles, magic jar, kawat baring', 'logam', 1800.00, '2025-10-30 02:26:14'),
(30, 'Kaleng', 'logam', 2000.00, '2025-10-30 02:26:14'),
(31, 'Kardus', 'anorganik', 1200.00, '2025-10-30 02:26:14'),
(32, 'Karung (kg)', 'anorganik', 500.00, '2025-10-30 02:26:14'),
(33, 'Kawat Springbed', 'logam', 500.00, '2025-10-30 02:26:14'),
(34, 'Keping VCD', 'elektronik', 3000.00, '2025-10-30 02:26:14'),
(35, 'Kresek (asoy), PP, PE ( boncos plastik )', 'anorganik', 300.00, '2025-10-30 02:26:14'),
(36, 'Kristal', 'anorganik', 3000.00, '2025-10-30 02:26:14'),
(37, 'Kuningan', 'logam', 25000.00, '2025-10-30 02:26:14'),
(38, 'LKS, buku pelajaran, majalah, koran', 'anorganik', 300.00, '2025-10-30 02:26:14'),
(39, 'Naso, jerigen putih, botol susu', 'anorganik', 1000.00, '2025-10-30 02:26:14'),
(40, 'Paku', 'logam', 2000.00, '2025-10-30 02:26:14'),
(41, 'Paralon abu-abu', 'anorganik', 700.00, '2025-10-30 02:26:14'),
(42, 'Paralon putih', 'anorganik', 1000.00, '2025-10-30 02:26:14'),
(43, 'HVS, Putihan, buku tulis tanpa sampul', 'anorganik', 1100.00, '2025-10-30 02:26:14'),
(44, 'Plat nomor, panci', 'logam', 8000.00, '2025-10-30 02:26:14'),
(45, 'Regulator gas', 'logam', 10000.00, '2025-10-30 02:26:14'),
(46, 'Selang', 'anorganik', 700.00, '2025-10-30 02:26:14'),
(47, 'Sak Semen', 'anorganik', 1000.00, '2025-10-30 02:26:14'),
(48, 'Seng, kawat', 'logam', 2500.00, '2025-10-30 02:26:14'),
(49, 'Tembaga Lidi', 'logam', 70000.00, '2025-10-30 02:26:14'),
(50, 'Tembaga serabut (TS)', 'logam', 50000.00, '2025-10-30 02:26:14'),
(51, 'Pintu Kamar Mandi', 'anorganik', 700.00, '2025-10-30 02:26:14'),
(52, 'Wajan', 'logam', 7000.00, '2025-10-30 02:26:14'),
(53, 'Tutup Galon (TG)', 'anorganik', 2000.00, '2025-10-30 02:26:14'),
(54, 'Tutup Botol Kecil/ campur (TBK)', 'anorganik', 1200.00, '2025-10-30 02:26:14'),
(55, 'Minyak Jelantah (Mijel)', 'organik', 4000.00, '2025-10-30 02:26:14'),
(56, 'Sachet an (MLP)', 'anorganik', 300.00, '2025-10-30 02:26:14');

-- --------------------------------------------------------

--
-- Table structure for table `penarikan`
--

CREATE TABLE `penarikan` (
  `id_penarikan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `metode` enum('Ambil Tunai','Transfer') NOT NULL DEFAULT 'Ambil Tunai',
  `tanggal_penarikan` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setoran`
--

CREATE TABLE `setoran` (
  `id_setoran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `berat_kg` decimal(10,2) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `tanggal_setor` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `alamat`, `no_hp`, `email`, `username`, `password`, `created_at`) VALUES
(13, 'eka', 'pamulang', '09821', 'eka@gmail.com', 'eka', '$2y$10$LOfgO6L0W7MmNfjtg/6rseaUf0z9Gjs6bJHzdxXR5DRiBcp1vlf12', '2025-11-04 07:29:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_sampah`
--
ALTER TABLE `jenis_sampah`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `penarikan`
--
ALTER TABLE `penarikan`
  ADD PRIMARY KEY (`id_penarikan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `setoran`
--
ALTER TABLE `setoran`
  ADD PRIMARY KEY (`id_setoran`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jenis_sampah`
--
ALTER TABLE `jenis_sampah`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `penarikan`
--
ALTER TABLE `penarikan`
  MODIFY `id_penarikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `setoran`
--
ALTER TABLE `setoran`
  MODIFY `id_setoran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penarikan`
--
ALTER TABLE `penarikan`
  ADD CONSTRAINT `penarikan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `setoran`
--
ALTER TABLE `setoran`
  ADD CONSTRAINT `setoran_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `setoran_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_sampah` (`id_jenis`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
