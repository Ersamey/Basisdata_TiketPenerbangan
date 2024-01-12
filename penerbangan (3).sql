-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2024 at 11:30 PM
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
-- Database: `penerbangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `bandara`
--

CREATE TABLE `bandara` (
  `id` int(11) NOT NULL,
  `nama_bandara` varchar(50) NOT NULL,
  `lokasi_bandara` varchar(50) NOT NULL,
  `kode_bandara` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bandara`
--

INSERT INTO `bandara` (`id`, `nama_bandara`, `lokasi_bandara`, `kode_bandara`) VALUES
(1, 'Halim Perdanakusuma', 'Jakarta', 'HLP'),
(2, 'Ngurah Rai', 'Bali', 'DPS'),
(3, 'Mutiara Sis-Aljufri', 'Sulawesi Tengah', 'PLW'),
(4, 'Minangkabau', 'Sumatera Barat', 'PDG'),
(5, 'Soekarno Hatta', 'Jakarta', 'CGK');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `id_rute` int(11) NOT NULL,
  `id_pesawat` int(11) NOT NULL,
  `jam_keberangkatan` time NOT NULL,
  `tanggal_keberangkatan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `id_rute`, `id_pesawat`, `jam_keberangkatan`, `tanggal_keberangkatan`) VALUES
(1, 3, 1, '09:00:00', '2023-12-27'),
(2, 5, 1, '19:00:00', '2023-11-12'),
(3, 4, 2, '07:00:00', '2023-11-12'),
(4, 6, 3, '16:00:00', '2023-11-12'),
(6, 12, 1, '18:00:00', '2024-01-01'),
(7, 1, 3, '09:00:00', '2023-12-24'),
(8, 1, 5, '19:00:00', '2023-12-25'),
(9, 2, 4, '07:00:00', '2023-12-25'),
(10, 3, 6, '05:00:00', '2023-12-27'),
(11, 5, 5, '16:00:00', '2023-12-26'),
(12, 7, 4, '13:00:00', '2023-12-25'),
(13, 7, 6, '14:00:00', '2023-12-28'),
(14, 8, 1, '21:00:00', '2023-12-27'),
(15, 9, 4, '08:30:00', '2023-12-25'),
(16, 9, 5, '20:00:00', '2023-12-29'),
(17, 10, 2, '13:00:00', '2023-12-26'),
(18, 11, 8, '19:30:00', '2023-12-26'),
(19, 11, 3, '14:30:00', '2023-12-28');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kapasitas_eksekutif` int(11) NOT NULL,
  `kapasitas_bisnis` int(11) NOT NULL,
  `kapasitas_ekonomi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kapasitas_eksekutif`, `kapasitas_bisnis`, `kapasitas_ekonomi`) VALUES
(1, 6, 16, 30),
(2, 4, 14, 28),
(3, 8, 18, 32),
(4, 10, 20, 34);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `harga_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `harga_kelas`) VALUES
(1, 'Eksekutif', 700000),
(2, 'Bisnis', 500000),
(3, 'Ekonomi', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `maskapai`
--

CREATE TABLE `maskapai` (
  `id` int(11) NOT NULL,
  `nama_maskapai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maskapai`
--

INSERT INTO `maskapai` (`id`, `nama_maskapai`) VALUES
(1, 'Garuda Indonesia'),
(2, 'Lion Air'),
(3, 'Air Asia'),
(4, 'Batik Air');

-- --------------------------------------------------------

--
-- Table structure for table `penumpang`
--

CREATE TABLE `penumpang` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `no_ktp` varchar(20) NOT NULL,
  `nama_penumpang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penumpang`
--

INSERT INTO `penumpang` (`id`, `id_user`, `no_telp`, `no_ktp`, `nama_penumpang`) VALUES
(1, 1, '081234567890', '320123456789', 'Salma Shakira Nurul Azmi'),
(2, 2, '081345678901', '320234567890', 'Oktavina Zahra Rahmawati'),
(3, 3, '081456789012', '320345678901', 'Shanny Mayasari'),
(4, 4, '081567890123', '320456789012', 'Wicheriani Galuh D'),
(63, 1, '085723114972', '23533262', 'Satria Bima'),
(69, 4, '244634', '32050505', 'Ersa Meilia'),
(103, 4, '089578223450', '32050505', 'Ersameymeow'),
(104, 4, '089578223450', '32050505', 'Ersa'),
(105, 4, '089578223450', '32050505', 'Satria'),
(106, 18, '08123456789', '12345', 'cece'),
(107, 18, '089578223450', '32050505', 'Wicheriani'),
(108, 4, '089578223450', '32050505', 'Wicheriani'),
(109, 18, '089578223450', '32050505', 'Wicheriani'),
(110, 18, '089578223450', '32050505', 'Wicheriani'),
(111, 19, '089578223450', '32050505', 'Irham'),
(112, 19, '089578223450', '32050505', 'Irham'),
(113, 18, '089578223450', '32050505', 'Irham'),
(114, 18, '089578223450', '32050505', 'Irham'),
(116, 4, '0852111111', '3212345678', 'Ersa Meymey');

-- --------------------------------------------------------

--
-- Table structure for table `pesawat`
--

CREATE TABLE `pesawat` (
  `id` int(11) NOT NULL,
  `id_maskapai` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `kode_pesawat` varchar(10) NOT NULL,
  `nama_pesawat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesawat`
--

INSERT INTO `pesawat` (`id`, `id_maskapai`, `id_kategori`, `kode_pesawat`, `nama_pesawat`) VALUES
(1, 1, 1, 'GA', 'Airbus A330'),
(2, 1, 2, 'GA', 'Boing 737-800NG'),
(3, 2, 3, 'JT', 'Airbus 330-900NEO'),
(4, 2, 4, 'JT', 'Boing 737-900ER'),
(5, 3, 1, 'QZ', 'Airbus A320'),
(6, 3, 2, 'QZ', 'Airbus 320PK-AZQ'),
(7, 4, 3, 'ID', 'Airbus A200'),
(8, 4, 4, 'ID', 'Airbus A320NEO');

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `id` int(11) NOT NULL,
  `id_bandara_asal` int(11) NOT NULL,
  `id_bandara_tujuan` int(11) NOT NULL,
  `harga` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rute`
--

INSERT INTO `rute` (`id`, `id_bandara_asal`, `id_bandara_tujuan`, `harga`) VALUES
(1, 1, 2, 1000000),
(2, 1, 3, 2400000),
(3, 1, 4, 1500000),
(4, 2, 1, 1000000),
(5, 2, 3, 1200000),
(6, 2, 4, 3000000),
(7, 3, 1, 2300000),
(8, 3, 2, 1044000),
(9, 3, 4, 3300000),
(10, 4, 1, 1220000),
(11, 4, 2, 3600000),
(12, 4, 3, 3300000);

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `kode_tiket` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id`, `id_transaksi`, `kode_tiket`) VALUES
(2, 2, '8812345678'),
(3, 3, '2212345678'),
(10, 39, '2355246003'),
(13, 45, '8154064939'),
(33, 78, '4091802518'),
(44, 83, '1466668881'),
(45, 83, '5639182060'),
(50, 87, '1534414825'),
(51, 87, '2212851738'),
(52, 87, '6625400128'),
(53, 88, '8874565632'),
(54, 88, '2782305998'),
(55, 88, '8755831022'),
(58, 90, '3466700692'),
(59, 91, '3938194269'),
(60, 90, '2607178167'),
(61, 91, '3792348533'),
(62, 85, '1454505649'),
(63, 93, '1037618507'),
(64, 85, '5559473786'),
(65, 93, '1089356796'),
(66, 85, '6439946533'),
(67, 93, '6818567549'),
(68, 85, '2164788515'),
(69, 85, '5411900288');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_penumpang` int(11) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `status_pembayaran` enum('Berhasil','Gagal','Diproses') DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `kursi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_jadwal`, `id_user`, `id_penumpang`, `harga`, `status_pembayaran`, `id_kelas`, `kursi`) VALUES
(2, 1, 2, 2, 2200000, 'Berhasil', 1, 2),
(3, 2, 3, 3, 1900000, 'Berhasil', 1, 3),
(39, 3, 1, 62, 1500000, 'Berhasil', 2, 3),
(45, 8, 4, 68, 1700000, 'Berhasil', 1, 4),
(78, 8, 4, 101, 1100000, 'Diproses', 3, 30),
(83, 9, 18, 106, 3100000, 'Berhasil', 1, 2),
(85, 10, 4, 108, 2200000, 'Diproses', 1, 1),
(87, 9, 18, 110, 2900000, 'Berhasil', 2, 16),
(88, 7, 19, 111, 1700000, 'Berhasil', 1, 6),
(90, 1, 18, 113, 2200000, 'Diproses', 1, 1),
(91, 7, 18, 114, 1700000, 'Diproses', 1, 1),
(93, 17, 4, 116, 1920000, 'Berhasil', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'Salma', '12345'),
(2, 'Oktavina', '23456'),
(3, 'Shanny', '34567'),
(4, 'Ersa', '45678'),
(5, 'Satria', '56789'),
(17, 'Jajang', '123456'),
(18, 'cece', '12345'),
(19, 'irham', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bandara`
--
ALTER TABLE `bandara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rute` (`id_rute`),
  ADD KEY `id_pesawat` (`id_pesawat`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maskapai`
--
ALTER TABLE `maskapai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penumpang`
--
ALTER TABLE `penumpang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pesawat`
--
ALTER TABLE `pesawat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_maskapai` (`id_maskapai`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bandara_asal` (`id_bandara_asal`),
  ADD KEY `id_bandara_tujuan` (`id_bandara_tujuan`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_penumpang` (`id_penumpang`),
  ADD KEY `transaksi_ibfk_4` (`id_kelas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bandara`
--
ALTER TABLE `bandara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `maskapai`
--
ALTER TABLE `maskapai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penumpang`
--
ALTER TABLE `penumpang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `pesawat`
--
ALTER TABLE `pesawat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rute`
--
ALTER TABLE `rute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_rute`) REFERENCES `rute` (`id`),
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_pesawat`) REFERENCES `pesawat` (`id`);

--
-- Constraints for table `penumpang`
--
ALTER TABLE `penumpang`
  ADD CONSTRAINT `penumpang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `pesawat`
--
ALTER TABLE `pesawat`
  ADD CONSTRAINT `pesawat_ibfk_1` FOREIGN KEY (`id_maskapai`) REFERENCES `maskapai` (`id`),
  ADD CONSTRAINT `pesawat_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`);

--
-- Constraints for table `rute`
--
ALTER TABLE `rute`
  ADD CONSTRAINT `rute_ibfk_1` FOREIGN KEY (`id_bandara_asal`) REFERENCES `bandara` (`id`),
  ADD CONSTRAINT `rute_ibfk_2` FOREIGN KEY (`id_bandara_tujuan`) REFERENCES `bandara` (`id`);

--
-- Constraints for table `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_penumpang`) REFERENCES `penumpang` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
