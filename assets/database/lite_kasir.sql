-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2022 at 12:50 PM
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
  `nama_customer` varchar(255) NOT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `nama_customer`, `status`) VALUES
(1, 'mahasiswa', NULL),
(2, 'Jun', 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `dt_pembelian`
--

CREATE TABLE `dt_pembelian` (
  `id` bigint(20) NOT NULL,
  `id_ht_pembelian` bigint(20) NOT NULL,
  `id_produk` bigint(20) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_beli` float NOT NULL,
  `harga_jual` float NOT NULL,
  `kuantitas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dt_pembelian`
--

INSERT INTO `dt_pembelian` (`id`, `id_ht_pembelian`, `id_produk`, `nama_produk`, `harga_beli`, `harga_jual`, `kuantitas`) VALUES
(3, 3, 4, 'Komputer', 2000000, 4000000, 1),
(5, 5, 4, 'Komputer', 2000000, 4000000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `dt_penjualan`
--

CREATE TABLE `dt_penjualan` (
  `id` bigint(14) NOT NULL,
  `id_ht_penjualan` int(11) NOT NULL,
  `id_produk` bigint(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga_beli` float NOT NULL,
  `harga_jual` float NOT NULL,
  `kuantitas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dt_penjualan`
--

INSERT INTO `dt_penjualan` (`id`, `id_ht_penjualan`, `id_produk`, `nama_produk`, `harga_beli`, `harga_jual`, `kuantitas`) VALUES
(5, 12, 1, 'Hp', 20000, 25000, 3),
(6, 13, 4, 'Komputer', 2000000, 4000000, 1),
(7, 13, 1, 'Hp', 20000, 25000, 3),
(8, 14, 5, 'Monitor', 1500000, 2000000, 2),
(9, 15, 1, 'Hp', 20000, 25000, 1),
(10, 16, 7, 'Makroni Bantet', 3000, 4000, 6);

-- --------------------------------------------------------

--
-- Table structure for table `ht_pembelian`
--

CREATE TABLE `ht_pembelian` (
  `id` bigint(20) NOT NULL,
  `id_supplier` bigint(20) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `waktu` datetime NOT NULL,
  `total_bayar` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ht_pembelian`
--

INSERT INTO `ht_pembelian` (`id`, `id_supplier`, `nama_supplier`, `waktu`, `total_bayar`) VALUES
(3, 1, 'Junas', '2022-06-07 13:45:18', 4000000),
(5, 2, 'Ragils', '2022-06-07 13:52:24', 40000000);

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
(12, 2, 'Jun', '2022-05-31 13:13:30', 60000, 'Admin'),
(13, 1, 'mahasiswa', '2022-05-31 13:21:30', 4060000, 'Admin'),
(14, 2, 'Jun', '2022-06-07 14:13:52', 4000000, 'Admin'),
(15, 2, 'Jun', '2022-06-07 14:51:36', 25000, 'Admin'),
(16, 2, 'Jun', '2022-06-21 16:58:39', 24000, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(1, 'Makanan'),
(3, 'Minuman');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `id` bigint(11) NOT NULL,
  `nama_owner` varchar(50) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`id`, `nama_owner`, `no_hp`, `alamat`) VALUES
(1, 'Mahasiswa', '081297551925', ''),
(3, 'Ujun', '081297551925', ''),
(4, 'Junas Owner', '081297551925', ''),
(5, 'RE', '081297551925', '');

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
  `id_kategori` bigint(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kuantitas` int(3) NOT NULL,
  `harga_jual` float NOT NULL,
  `harga_beli` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `id_owner`, `id_kategori`, `nama`, `kuantitas`, `harga_jual`, `harga_beli`) VALUES
(1, 1, 1, 'Hp', 43, 25000, 20000),
(4, 3, 1, 'Komputer', 60, 4000000, 2000000),
(5, 5, 3, 'Monitor', 48, 2000000, 1500000),
(7, 5, 3, 'Makroni Bantet', 28, 4000, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` bigint(20) NOT NULL,
  `nama_supplier` varchar(50) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama_supplier`, `no_hp`, `alamat`) VALUES
(1, 'Junas', '081297551925', ''),
(2, 'Ragils', '081297551925', '');

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
-- Indexes for table `dt_pembelian`
--
ALTER TABLE `dt_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dt_penjualan`
--
ALTER TABLE `dt_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ht_pembelian`
--
ALTER TABLE `ht_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ht_penjualan`
--
ALTER TABLE `ht_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
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
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dt_pembelian`
--
ALTER TABLE `dt_pembelian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dt_penjualan`
--
ALTER TABLE `dt_penjualan`
  MODIFY `id` bigint(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ht_pembelian`
--
ALTER TABLE `ht_pembelian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ht_penjualan`
--
ALTER TABLE `ht_penjualan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
