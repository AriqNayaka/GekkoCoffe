-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 09:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ariqahmadnayaka_reservasirestoran`
--
CREATE DATABASE IF NOT EXISTS `ariqahmadnayaka_reservasirestoran` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ariqahmadnayaka_reservasirestoran`;

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `subtotal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `id_transaksi`, `id_produk`, `harga`, `jumlah`, `subtotal`) VALUES
(1, 1, 1, '10000', '1', '10000'),
(2, 1, 2, '15000', '1', '15000'),
(3, 2, 1, '10000', '2', '20000'),
(4, 2, 2, '15000', '2', '30000'),
(5, 2, 3, '7000', '1', '7000'),
(6, 3, 2, '15000', '1', '15000'),
(7, 4, 1, '15000', '1', '15000'),
(8, 4, 2, '20000', '1', '20000'),
(9, 5, 2, '20000', '1', '20000'),
(10, 6, 3, '7000', '1', '7000'),
(11, 7, 5, '15000', '1', '15000'),
(12, 8, 2, '20000', '1', '20000'),
(13, 9, 2, '20000', '2', '40000'),
(14, 10, 1, '15000', '1', '15000'),
(15, 11, 1, '15000', '1', '15000'),
(16, 11, 5, '15000', '2', '30000'),
(17, 12, 5, '15000', '1', '15000'),
(18, 13, 2, '20000', '1', '20000'),
(20, 15, 2, '20000', '1', '20000'),
(21, 16, 3, '7000', '2', '14000'),
(22, 17, 2, '20000', '5', '100000'),
(23, 17, 5, '15000', '3', '45000'),
(24, 18, 5, '15000', '1', '15000'),
(25, 19, 1, '16000', '1', '13000'),
(26, 20, 1, '16000', '1', '16000'),
(27, 21, 1, '16000', '1', '16000'),
(38, 32, 2, '20000', '2', '80000'),
(39, 33, 2, '20000', '2', '80000'),
(40, 34, 2, '20000', '1', '20000'),
(41, 35, 1, '16000', '1', '16000'),
(42, 36, 1, '16000', '1', '16000'),
(43, 37, 7, '7000', '1', '7000');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `id_operator` int(11) NOT NULL,
  `aktivitas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `tanggal`, `id_operator`, `aktivitas`) VALUES
(11, '2023-11-14 02:11:22', 2, 'OPERATOR operator telah login'),
(12, '2023-11-14 02:11:23', 2, 'OPERATOR operator telah login'),
(13, '2023-11-14 02:11:27', 2, 'OPERATOR operator telah logout'),
(14, '2023-11-14 02:11:40', 5, 'OPERATOR imam telah login'),
(15, '2023-11-14 02:11:44', 5, 'OPERATOR imam telah logout'),
(16, '2023-11-14 02:11:23', 5, 'OPERATOR imam telah login'),
(17, '2023-11-14 02:11:25', 5, 'OPERATOR imam telah logout'),
(18, '2023-11-14 02:11:29', 5, 'OPERATOR imamsyhd telah login'),
(19, '2023-11-14 02:11:18', 5, 'OPERATOR imam telah logout'),
(20, '2023-11-14 02:11:22', 5, 'OPERATOR imam telah login'),
(21, '2023-11-14 03:11:10', 5, 'OPERATOR imam telah logout'),
(22, '2023-11-14 08:11:04', 2, 'OPERATOR operator telah login'),
(23, '2023-11-14 08:11:06', 2, 'OPERATOR operator telah Mengacc transaksi : 5'),
(24, '2023-11-14 08:11:01', 2, 'OPERATOR operator telah logout'),
(25, '2023-11-14 08:11:35', 5, 'OPERATOR imam telah login'),
(26, '2023-11-14 08:11:50', 5, 'OPERATOR imam telah Mengacc transaksi : 7'),
(27, '2023-11-14 08:11:59', 5, 'OPERATOR imam telah logout'),
(28, '2023-11-15 02:11:51', 2, 'OPERATOR operator telah login'),
(29, '2023-11-15 02:11:28', 2, 'OPERATOR operator telah logout'),
(30, '2023-11-15 02:11:31', 5, 'OPERATOR imam telah login'),
(31, '2023-11-15 02:11:14', 5, 'OPERATOR imamsyhd telah Mengacc transaksi : 10'),
(32, '2023-11-15 02:11:26', 5, 'OPERATOR imamsyhd telah logout'),
(33, '2023-11-15 05:11:13', 5, 'OPERATOR imam telah login'),
(34, '2023-11-15 05:11:34', 5, 'OPERATOR imam telah Mengacc transaksi : 13'),
(35, '2023-11-15 05:11:18', 5, 'OPERATOR imamsyhd telah logout'),
(36, '2023-11-15 07:11:21', 5, 'OPERATOR imamsyhd telah login'),
(37, '2023-11-15 07:11:28', 5, 'OPERATOR imamsyhd telah logout'),
(38, '2023-11-16 04:11:05', 5, 'OPERATOR imamsyhd telah login'),
(39, '2023-11-16 04:11:31', 5, 'OPERATOR imamsyhd telah Mengacc transaksi : 18'),
(40, '2023-11-16 04:11:45', 5, 'OPERATOR imamsyhd telah logout'),
(41, '2023-11-16 08:11:31', 2, 'OPERATOR operator telah login'),
(42, '2023-11-16 08:11:38', 2, 'OPERATOR operator telah Mengacc transaksi : 37'),
(43, '2023-11-16 08:11:53', 2, 'OPERATOR operator telah logout'),
(44, '2023-11-16 08:11:37', 2, 'OPERATOR operator telah login'),
(45, '2023-11-16 08:11:47', 2, 'OPERATOR operator telah logout');

-- --------------------------------------------------------

--
-- Table structure for table `logchat`
--

CREATE TABLE `logchat` (
  `id` int(11) NOT NULL,
  `aktivitas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logchat`
--

INSERT INTO `logchat` (`id`, `aktivitas`) VALUES
(1, 'PRODUK MAKANAN/MINUMAN telah ditambah!'),
(2, 'Data MAKANAN/MINUMAN telah dirubah!'),
(3, 'Data MAKANAN/MINUMAN telah dirubah!'),
(4, 'Data MAKANAN/MINUMAN telah dirubah!'),
(5, 'Data MAKANAN/MINUMAN telah dirubah!'),
(6, 'Produk MAKANAN/MINUMAN telah ditambah!'),
(7, 'Data MAKANAN/MINUMAN telah dirubah!'),
(8, 'Data MAKANAN/MINUMAN telah dirubah!'),
(9, 'Data MAKANAN/MINUMAN telah dirubah!'),
(10, 'Data MAKANAN/MINUMAN telah dirubah!'),
(11, 'Data MAKANAN/MINUMAN telah dirubah!'),
(12, 'Data MAKANAN/MINUMAN telah dirubah!'),
(13, 'Data MAKANAN/MINUMAN telah dirubah!'),
(14, 'Data MAKANAN/MINUMAN telah dirubah!'),
(15, 'Data MAKANAN/MINUMAN telah dirubah!'),
(16, 'Produk MAKANAN/MINUMAN telah ditambah!'),
(17, 'Produk MAKANAN/MINUMAN telah ditambah!'),
(18, 'Data MAKANAN/MINUMAN telah dirubah!'),
(19, 'Data MAKANAN/MINUMAN telah dirubah!'),
(20, 'Produk MAKANAN/MINUMAN telah ditambah!'),
(21, 'Data MAKANAN/MINUMAN telah dirubah!'),
(22, 'Data MAKANAN/MINUMAN telah dirubah!'),
(23, 'Data MAKANAN/MINUMAN telah dirubah!');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_produk`
--

CREATE TABLE `tabel_produk` (
  `id` int(11) NOT NULL,
  `produk` varchar(100) NOT NULL,
  `jenis` enum('MAKANAN','MINUMAN') NOT NULL,
  `harga` varchar(100) NOT NULL,
  `gambar` text NOT NULL,
  `status` enum('ENABLE','DISABLE') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_produk`
--

INSERT INTO `tabel_produk` (`id`, `produk`, `jenis`, `harga`, `gambar`, `status`) VALUES
(1, 'CHOCO JELLYS', 'MINUMAN', '16000', 'juice-3175117_1280.jpg', 'ENABLE'),
(2, 'DONDONG JUICE', 'MAKANAN', '20000', 'detox-1995433_1280.jpg', 'ENABLE'),
(3, 'TAHU PONG', 'MINUMAN', '7000', 'food-5981232_1280.jpg', 'ENABLE'),
(4, 'CHIKEN FRIED RICE', 'MAKANAN', '10000', '', 'DISABLE'),
(5, 'MIE SAMBAL IJO', 'MAKANAN', '15000', 'burgers-1976198_1280.jpg', 'ENABLE'),
(6, 'BURGER', 'MAKANAN', '15000', 'chicken-2030706_1280.jpg', 'DISABLE'),
(7, 'PIZZA', 'MAKANAN', '7000', 'pizza-1949183_1280.jpg', 'ENABLE'),
(8, 'KOPI GULA PASIR', '', '20000', 'rice-1381146_1280.jpg', 'DISABLE'),
(9, 'SATE TUSUK', '', '25000', 'skewer-3370443_1280.jpg', 'DISABLE');

--
-- Triggers `tabel_produk`
--
DELIMITER $$
CREATE TRIGGER `insert_tabel_produk` AFTER INSERT ON `tabel_produk` FOR EACH ROW INSERT INTO logchat VALUES ('','Produk MAKANAN/MINUMAN telah ditambah!')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_tabel_produk` AFTER UPDATE ON `tabel_produk` FOR EACH ROW INSERT INTO logchat VALUES ('','Data MAKANAN/MINUMAN telah dirubah!')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_transaksi`
--

CREATE TABLE `tabel_transaksi` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_operator` int(11) NOT NULL,
  `diskon` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `bayar` varchar(100) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `status` enum('ORDER','DONE','DELETE') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_transaksi`
--

INSERT INTO `tabel_transaksi` (`id`, `id_user`, `id_operator`, `diskon`, `total`, `bayar`, `tanggal`, `status`) VALUES
(1, 3, 2, '0', '33000', '53000', '2023-August-13', 'DONE'),
(2, 3, 2, '5000', '68200', '70000', '2023-November-10', 'DONE'),
(3, 3, 5, '0', '22000', '53000', '2023-November-13', 'DONE'),
(4, 3, 4, '0', '44000', '55000', '2023-November-13', 'DELETE'),
(5, 3, 2, '0', '27500', '30000', '2023-November-14', 'DONE'),
(6, 7, 5, '0', '13200', '15000', '2023-November-14', 'DONE'),
(7, 7, 5, '0', '22000', '30000', '2023-November-09', 'DELETE'),
(8, 7, 4, '0', '27500', '40000', '2023-November-14', 'ORDER'),
(9, 3, 1, '0', '10000', '', '2023-November-15', 'DELETE'),
(10, 3, 5, '0', '21500', '22000', '2023-November-15', 'DONE'),
(11, 7, 4, '0', '54500', '55000', '2023-November-15', 'ORDER'),
(12, 3, 4, '0', '21500', '22000', '2023-November-15', 'ORDER'),
(13, 3, 5, '0', '27000', '30000', '2023-November-15', 'DONE'),
(15, 7, 1, '0', '27000', '30000', '2023-November-31', 'DELETE'),
(16, 3, 4, '1000', '20400', '55000', '2023-November-15', 'ORDER'),
(17, 7, 1, '5000', '2102505000', '1111111111111111', '2023-November-16', 'DONE'),
(18, 7, 5, '0', '20750', '21000', '2023-November-16', 'DONE'),
(19, 3, 4, '', '16000', '25000', '', 'DELETE'),
(20, 3, 4, '', '16000', '25000', '', 'DELETE'),
(21, 3, 4, '', '16000', '25000', '2023-November-16', 'ORDER'),
(24, 7, 4, '', '80000', '40000', '2023-November-16', 'ORDER'),
(25, 7, 4, '', '80000', '40000', '2023-November-16', 'ORDER'),
(26, 3, 4, '', '80000', '50000', '2023-November-16', 'ORDER'),
(27, 3, 4, '', '80000', '50000', '2023-November-16', 'ORDER'),
(28, 3, 4, '', '80000', '50000', '2023-November-16', 'ORDER'),
(29, 3, 4, '', '80000', '50000', '2023-November-16', 'ORDER'),
(30, 3, 4, '', '80000', '50000', '2023-November-16', 'ORDER'),
(31, 3, 1, '', '80000', '50000', '2023-November-16', 'DONE'),
(32, 3, 4, '', '80000', '50000', '2023-November-16', 'ORDER'),
(33, 3, 4, '', '80000', '50000', '2023-November-16', 'ORDER'),
(34, 3, 4, '', '20000', '50000', '2023-November-16', 'ORDER'),
(35, 3, 4, '', '16000', '50000', '2023-November-16', 'ORDER'),
(36, 3, 4, '', '16000', '50000', '2023-November-16', 'ORDER'),
(37, 3, 2, '0', '12350', '15000', '2023-November-16', 'DONE');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_user`
--

CREATE TABLE `tabel_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('ADMIN','OPERATOR','CUSTOMER') NOT NULL,
  `status` enum('ALWAYS','ACTIVE','DISACTIVE') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_user`
--

INSERT INTO `tabel_user` (`id`, `username`, `password`, `role`, `status`) VALUES
(1, 'admin', '123', 'ADMIN', 'ALWAYS'),
(2, 'operator', '123', 'OPERATOR', 'ACTIVE'),
(3, 'customer', '123', 'CUSTOMER', 'ALWAYS'),
(4, 'dummy', '123', 'OPERATOR', 'ALWAYS'),
(5, 'imamsyhd', '123', 'OPERATOR', 'ACTIVE'),
(6, 'ikan', '123', 'OPERATOR', 'DISACTIVE'),
(7, 'hilalbudi', '123', 'CUSTOMER', 'ALWAYS'),
(9, 'yuhades', '123', 'OPERATOR', 'DISACTIVE'),
(10, 'minkum', '123', 'OPERATOR', 'DISACTIVE'),
(11, 'ariqahmad', '123', 'OPERATOR', 'DISACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaksi` (`id_transaksi`,`id_produk`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_operator` (`id_operator`);

--
-- Indexes for table `logchat`
--
ALTER TABLE `logchat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_produk`
--
ALTER TABLE `tabel_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_transaksi`
--
ALTER TABLE `tabel_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`,`id_operator`),
  ADD KEY `id_operator` (`id_operator`);

--
-- Indexes for table `tabel_user`
--
ALTER TABLE `tabel_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `logchat`
--
ALTER TABLE `logchat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tabel_produk`
--
ALTER TABLE `tabel_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tabel_transaksi`
--
ALTER TABLE `tabel_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tabel_user`
--
ALTER TABLE `tabel_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `tabel_transaksi` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tabel_produk` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`id_operator`) REFERENCES `tabel_user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tabel_transaksi`
--
ALTER TABLE `tabel_transaksi`
  ADD CONSTRAINT `tabel_transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tabel_user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tabel_transaksi_ibfk_2` FOREIGN KEY (`id_operator`) REFERENCES `tabel_user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
tabeltabeltabel