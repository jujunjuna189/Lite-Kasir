-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2022 at 04:10 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lite_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` bigint(20) NOT NULL,
  `nama_customer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `nama_customer`) VALUES
(1, 'mahasiswa'),
(2, 'Jun');

-- --------------------------------------------------------

--
-- Table structure for table `dt_penjualan`
--

CREATE TABLE `dt_penjualan` (
  `id` bigint(14) NOT NULL,
  `id_produk` bigint(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga_beli` float NOT NULL,
  `harga_jual` float NOT NULL,
  `kuantitas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dt_penjualan`
--

INSERT INTO `dt_penjualan` (`id`, `id_produk`, `nama_produk`, `harga_beli`, `harga_jual`, `kuantitas`) VALUES
(1, 1, 'Roti', 5000, 7000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ht_penjualan`
--

CREATE TABLE `ht_penjualan` (
  `id` bigint(20) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `waktu` datetime NOT NULL,
  `total_bayar` float NOT NULL,
  `kasir` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ht_penjualan`
--

INSERT INTO `ht_penjualan` (`id`, `id_customer`, `nama_customer`, `waktu`, `total_bayar`, `kasir`) VALUES
(1, 1, 'mahasiswa', '2022-03-23 14:37:18', 1222, 'jaka');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `id` bigint(11) NOT NULL,
  `nama_owner` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`id`, `nama_owner`, `status`) VALUES
(1, 'Mahasiswa', 'mahasiswa'),
(3, 'Ujun', 'juna');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` bigint(20) NOT NULL,
  `id_produk` bigint(20) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` bigint(11) NOT NULL,
  `id_owner` bigint(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kuantitas` int(3) NOT NULL,
  `harga_jual` float NOT NULL,
  `harga_beli` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `id_owner`, `nama`, `kuantitas`, `harga_jual`, `harga_beli`) VALUES
(1, 1, 'Hp', 20, 20000, 25000),
(4, 3, 'Komputer', 26, 4000000, 2000000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `akses` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `akses`) VALUES
(1, 'juna', '09a4b07cc37f30fb0538a6057c2e51a3', 'Juna', 'Kasir'),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dt_penjualan`
--
ALTER TABLE `dt_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ht_penjualan`
--
ALTER TABLE `ht_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dt_penjualan`
--
ALTER TABLE `dt_penjualan`
  MODIFY `id` bigint(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ht_penjualan`
--
ALTER TABLE `ht_penjualan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
