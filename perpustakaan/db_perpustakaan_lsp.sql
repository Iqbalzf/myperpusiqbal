-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 13, 2026 at 05:48 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan_lsp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$qELwsqeA6v826gJjngyGp.F6it7XGqlPCdi8m3benAAeCAQZXsEHu');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text,
  `no_hp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama`, `alamat`, `no_hp`) VALUES
(1, 'Iqbal Zaka Firdana', 'Desa Gandarum, Kec. Kajen', '082329241359'),
(2, 'Ahmad Fauzi', 'Desa Bojong, Kec. Bojong', '081234567890'),
(4, 'Muhammad Rizki', 'Desa Kedungwuni Timur, Kec. Kedungwuni', '085712345678'),
(5, 'Nurul Hidayah', 'Desa Karanganyar, Kec. Tirto', '083812345679'),
(6, 'Andi Pratama', 'Desa Doro, Kec. Doro', '081356789012'),
(7, 'Dewi Lestari', 'Desa Wiradesa, Kec. Wiradesa', '082256789013'),
(8, 'Rudi Hartono Budianto', 'Desa Buaran, Kec. Buaran', '085678901234'),
(9, 'Fitriani Putri', 'Desa Kesesi, Kec. Kesesi', '081987654321'),
(10, 'Budi Santoso', 'Desa Sragi, Kec. Sragi', '083145678901'),
(11, 'Wahyu Widodo', 'Desa Gandarum, Kec. Kajen', '082867654532'),
(12, 'Rickytukam Almahendra', 'Desa Gandarum, Kec. Kajen', '085678901234');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int NOT NULL,
  `judul` varchar(150) NOT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `tahun_terbit` int DEFAULT NULL,
  `stok` int NOT NULL,
  `sampul` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `pengarang`, `tahun_terbit`, `stok`, `sampul`) VALUES
(1, 'Algoritma dan Pemrograman', 'Rinaldi Munir', 2018, 2, 'algoritma.jpg'),
(2, 'Basis Data', 'Abdul Kadir', 2017, 4, 'basisdata.jpg'),
(3, 'Pemrograman Web dengan PHP', 'Budi Raharjo', 2019, 6, 'php.jpg'),
(4, 'Struktur Data', 'Sartono Wiro', 2016, 3, 'strukturdata.jpg'),
(5, 'Rekayasa Perangkat Lunak', 'Pressman', 2015, 2, 'rpl.jpg'),
(6, 'Sistem Operasi', 'Silberschatz', 2014, 4, 'sistemoperasi.jpg'),
(7, 'Jaringan Komputer', 'Andrew S. Tanenbaum', 2016, 5, 'jaringan.jpg'),
(8, 'Pemrograman Java', 'Deitel & Deitel', 2018, 6, 'java.jpg'),
(9, 'Pemrograman Python', 'Mark Lutz', 2020, 7, 'python.jpg'),
(10, 'Kecerdasan Buatan', 'Stuart Russell', 2021, 3, 'ai.jpg'),
(11, 'Machine Learning', 'Tom M. Mitchell', 2020, 4, 'ml.jpg'),
(12, 'Data Mining', 'Jiawei Han', 2017, 2, 'datamining.jpg'),
(13, 'Keamanan Sistem Informasi', 'William Stallings', 2019, 3, 'keamanan.jpg'),
(14, 'Manajemen Proyek TI', 'Schwalbe', 2018, 5, 'manajemenproyek.jpg'),
(15, 'Analisis dan Desain Sistem', 'Jogiyanto', 2016, 4, 'ads.jpg'),
(16, 'Laskar Pelangi', 'Andrea Hirata', 2005, 7, 'laskarpelangi.jpg'),
(17, 'Bumi Manusia', 'Pramoedya Ananta Toer', 1980, 5, 'bumimanusia.jpg'),
(18, 'Negeri 5 Menara', 'Ahmad Fuadi', 2009, 6, 'negeri5menara.jpg'),
(19, 'Ayat-Ayat Cinta', 'Habiburrahman El Shirazy', 2004, 4, 'ayatayatcinta.jpg'),
(20, 'Perahu Kertas', 'Dee Lestari', 2009, 5, 'perahukertas.jpg'),
(21, 'Dilan: Dia adalah Dilanku Tahun 1990', 'Pidi Baiq', 2014, 8, 'dilan1990.jpg'),
(22, 'Hujan', 'Tere Liye', 2016, 6, 'hujan.jpg'),
(23, 'Pulang', 'Tere Liye', 2015, 5, 'pulang.jpg'),
(24, 'Supernova: Ksatria, Puteri, dan Bintang Jatuh', 'Dee Lestari', 2001, 4, 'supernova.jpg'),
(25, 'Sang Pemimpi', 'Andrea Hirata', 2006, 6, 'sangpemimpi.jpg'),
(26, 'The Alchemist', 'Paulo Coelho', 1988, 7, 'thealchemist.jpg'),
(27, 'Harry Potter and the Philosopher\'s Stone', 'J.K. Rowling', 1997, 10, 'harrypotter1.jpg'),
(28, 'The Hobbit', 'J.R.R. Tolkien', 1937, 10, 'hobbit.jpg'),
(29, 'The Lord of the Rings', 'J.R.R. Tolkien', 1954, 4, 'lotr.jpg'),
(30, 'To Kill a Mockingbird', 'Harper Lee', 1960, 3, 'mockingbird.jpg'),
(31, '1984', 'George Orwell', 1949, 4, '1984.jpg'),
(32, 'Animal Farm', 'George Orwell', 1945, 6, 'animalfarm.jpg'),
(33, 'The Da Vinci Code', 'Dan Brown', 2003, 5, 'davinci.jpg'),
(34, 'The Fault in Our Stars', 'John Green', 2012, 6, 'tfios.jpg'),
(35, 'Rich Dad Poor Dad', 'Robert T. Kiyosaki', 1997, 7, 'richdad.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id_detail` int NOT NULL,
  `id_peminjaman` int NOT NULL,
  `id_buku` int NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id_detail`, `id_peminjaman`, `id_buku`, `jumlah`) VALUES
(1, 1, 31, 1),
(2, 2, 31, 1),
(3, 3, 31, 2),
(4, 4, 31, 1),
(5, 5, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi_denda`
--

CREATE TABLE `konfigurasi_denda` (
  `id` int NOT NULL,
  `denda_per_hari` int NOT NULL,
  `max_hari_pinjam` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `konfigurasi_denda`
--

INSERT INTO `konfigurasi_denda` (`id`, `denda_per_hari`, `max_hari_pinjam`) VALUES
(1, 1000, 7);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int NOT NULL,
  `id_anggota` int NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `status` enum('dipinjam','dikembalikan') DEFAULT 'dipinjam',
  `tanggal_kembali` date DEFAULT NULL,
  `denda` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_anggota`, `tanggal_pinjam`, `tanggal_jatuh_tempo`, `status`, `tanggal_kembali`, `denda`) VALUES
(1, 1, '2026-01-13', '2026-01-20', 'dikembalikan', '2026-01-13', 0),
(2, 2, '2026-01-13', '2026-01-20', 'dikembalikan', '2026-01-13', 0),
(3, 9, '2026-01-11', '2026-01-12', 'dikembalikan', '2026-01-13', 1000),
(4, 2, '2026-01-13', '2026-01-20', 'dikembalikan', '2026-01-13', 0),
(5, 5, '2026-01-13', '2026-01-20', 'dipinjam', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int NOT NULL,
  `id_peminjaman` int NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `total_denda` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `idx_detail_peminjaman` (`id_peminjaman`),
  ADD KEY `idx_detail_buku` (`id_buku`);

--
-- Indexes for table `konfigurasi_denda`
--
ALTER TABLE `konfigurasi_denda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `idx_peminjaman_anggota` (`id_anggota`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_peminjaman` (`id_peminjaman`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `konfigurasi_denda`
--
ALTER TABLE `konfigurasi_denda`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD CONSTRAINT `detail_peminjaman_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
