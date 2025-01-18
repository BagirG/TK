-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2024 at 04:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tkdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabungan`
--

CREATE TABLE `tabungan` (
  `id_murid` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `ket` varchar(20) NOT NULL,
  `tgl` datetime NOT NULL,
  `nominal` decimal(20,0) NOT NULL,
  `saldo` decimal(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabungan`
--

INSERT INTO `tabungan` (`id_murid`, `username`, `nama`, `kelas`, `ket`, `tgl`, `nominal`, `saldo`) VALUES
(10, 'agung', 'agung', '4A', 'Setoran', '2024-10-16 20:49:00', 10000, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_murid`
--

CREATE TABLE `tb_murid` (
  `id_murid` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `notlp` int(12) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `foto_profil` varchar(100) NOT NULL,
  `pw` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `tb_murid`
--
DELIMITER $$
CREATE TRIGGER `after_insert_tb_murid` AFTER INSERT ON `tb_murid` FOR EACH ROW BEGIN
    INSERT INTO tabungan (id_murid, username, nama, kelas, saldo)
    VALUES (NEW.id_murid, NEW.username, NEW.nama, NEW.kelas, 0);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tabungan`
--

CREATE TABLE `tb_tabungan` (
  `id_tabungan` int(50) NOT NULL,
  `id_murid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` text NOT NULL,
  `kelas` text NOT NULL,
  `tanggal_setoran` datetime NOT NULL,
  `setoran` int(11) NOT NULL,
  `tanggal_penarikan` date NOT NULL,
  `penarikan` int(11) NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tabungan`
--

INSERT INTO `tb_tabungan` (`id_tabungan`, `id_murid`, `username`, `nama`, `kelas`, `tanggal_setoran`, `setoran`, `tanggal_penarikan`, `penarikan`, `saldo`) VALUES
(212, 312, 'dasfas', 'budi', 'das', '2024-10-09 00:00:00', 14000, '0000-00-00', 0, 0),
(1221, 2312, 'sadas', 'gdfgdf', 'A3', '2024-09-19 00:00:00', 40000, '2024-10-01', 20000, 40000),
(1223, 0, 'aguss', 'aguus', 'B1', '2024-10-02 00:00:00', 20000, '0000-00-00', 0, 20000),
(1225, 0, 'ana', 'ana', '4A', '2024-10-10 09:02:00', 10000, '0000-00-00', 0, 0),
(1226, 0, 'arfi', 'arfi', 'A32', '2024-10-02 00:00:00', 20000, '0000-00-00', 0, 20000),
(1227, 0, 'anggi', 'anggi', 'A32', '2024-10-02 00:00:00', 20000, '0000-00-00', 0, 20000),
(1228, 0, 'admiral', 'admiral', '4A', '2024-10-02 00:00:00', 20000, '0000-00-00', 0, 20000),
(1228, 0, '', 'admiral', '4A', '2024-10-09 00:00:00', 5000, '0000-00-00', 0, 0),
(1229, 0, 'ami', 'ami', '4A', '2024-10-02 00:00:00', 20000, '0000-00-00', 0, 20000),
(1229, 0, '', 'ami', '4A', '2024-10-09 00:00:00', 14000, '0000-00-00', 0, 0),
(1230, 0, 'aki', 'aki', '4A', '2024-10-02 00:00:00', 20000, '0000-00-00', 0, 20000),
(1231, 0, 'amrul', 'amrul', 'B1', '2024-10-02 00:00:00', 20000, '0000-00-00', 0, 20000),
(1232, 0, 'bagus', 'bagus', '4A', '2024-10-02 00:00:00', 20000, '0000-00-00', 0, 20000),
(1233, 0, 'akura', 'akura', 'B1', '2024-10-02 00:00:00', 20000, '0000-00-00', 0, 20000),
(1234, 0, 'akira', 'akira', 'A32', '2024-10-02 00:00:00', 20000, '0000-00-00', 0, 20000),
(1235, 0, 'umar', 'umar', 'B2', '2024-10-05 00:00:00', 20000, '0000-00-00', 0, 20000),
(1235, 0, '', 'umar', 'B2', '2024-10-09 00:00:00', 10000, '0000-00-00', 0, 0),
(1239, 0, 'umar_1', 'umar', 'B2', '2024-10-09 21:41:00', 20000, '2024-10-09', 10000, 0),
(1240, 0, 'umar_2', 'umar', 'B2', '0000-00-00 00:00:00', 0, '0000-00-00', 0, 0),
(1241, 0, 'umar_3', 'umar', 'B2', '0000-00-00 00:00:00', 0, '0000-00-00', 0, 0),
(1242, 0, '', 'aguss', '4A', '2024-10-04 21:39:00', 5000, '0000-00-00', 0, 0),
(1242, 0, '', 'aguss', '4A', '2024-10-07 21:38:00', 5000, '0000-00-00', 0, 0),
(1242, 0, 'aguss', 'aguss', '4A', '2024-10-09 00:00:00', 20000, '0000-00-00', 0, 0),
(1242, 0, '', 'aguss', '4A', '2024-10-09 21:05:00', 5000, '0000-00-00', 0, 0),
(1243, 0, 'aguss', 'aguss', '4A', '0000-00-00 00:00:00', 0, '0000-00-00', 0, 0),
(1244, 0, 'root', 'aguss', '4A', '0000-00-00 00:00:00', 0, '0000-00-00', 0, 0),
(1245, 0, 'anjas', 'anjas', 'B12', '2024-10-09 00:00:00', 10000, '0000-00-00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `roles` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `notlp` int(100) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `foto_profil` varchar(100) NOT NULL,
  `pw` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `kelas`, `tgl_lahir`, `roles`, `alamat`, `notlp`, `jk`, `foto_profil`, `pw`) VALUES
(11, 'aldi', 'aldi', '4A', '2024-10-04', 'guru', 'bali', 2147483647, 'Laki-Laki', '../assets/images/profile/download.png', 'aldi'),
(12, 'aldii', 'aldii', '', '2024-10-04', 'murid', '', 0, '', '../assets/images/profile/download (1).png', 'aldii'),
(121, 'dian', 'dian', 'B1s', '0000-00-00', 'guru', 'gdfgdfgd', 2147483647, '', '../assets/images/profile/png-clipart-quran-quran.png', 'dian'),
(133, 'agusss', 'agusss', '', '0000-00-00', '', 'agusss', 0, '', '', ''),
(134, 'tegar', 'tegar', '', '0000-00-00', '', 'tegar', 0, '', '', 'tegar'),
(135, 'guru', 'guru', '', '0000-00-00', 'guru', 'guru', 0, '', '', 'guru'),
(136, 'ari', 'ari', '', '0000-00-00', 'guru', 'ari', 0, 'Laki-laki', '', 'ari'),
(137, 'sakinah', 'sakinah', '', '0000-00-00', 'guru', 'dasgsdf', 0, 'Perempuan', '', 'sakinah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD PRIMARY KEY (`id_murid`,`tgl`) USING BTREE;

--
-- Indexes for table `tb_murid`
--
ALTER TABLE `tb_murid`
  ADD PRIMARY KEY (`id_murid`);

--
-- Indexes for table `tb_tabungan`
--
ALTER TABLE `tb_tabungan`
  ADD PRIMARY KEY (`id_tabungan`,`tanggal_setoran`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabungan`
--
ALTER TABLE `tabungan`
  MODIFY `id_murid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_murid`
--
ALTER TABLE `tb_murid`
  MODIFY `id_murid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_tabungan`
--
ALTER TABLE `tb_tabungan`
  MODIFY `id_tabungan` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1246;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_murid`
--
ALTER TABLE `tb_murid`
  ADD CONSTRAINT `tb_murid_ibfk_1` FOREIGN KEY (`id_murid`) REFERENCES `tabungan` (`id_murid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
