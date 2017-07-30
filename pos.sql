-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2017 at 03:58 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bayar`
--

CREATE TABLE `tb_bayar` (
  `id_bayar` binary(16) NOT NULL,
  `id_order` binary(16) NOT NULL,
  `id_toko` binary(16) NOT NULL,
  `bank_asal` varchar(255) DEFAULT NULL,
  `acc_name` varchar(255) DEFAULT NULL,
  `bank_tujuan` varchar(255) DEFAULT NULL,
  `jumlah_uang` int(11) NOT NULL,
  `status` enum('checked','pending') DEFAULT 'pending',
  `tgl_input` date DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_gambar`
--

CREATE TABLE `tb_gambar` (
  `id_gambar` int(11) NOT NULL,
  `id_produk` binary(16) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `featured` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_children_1`
--

CREATE TABLE `tb_kategori_children_1` (
  `id_kategori` int(11) NOT NULL,
  `id_user` binary(16) DEFAULT NULL,
  `id_kategori_parent` int(11) DEFAULT '0' COMMENT 'untuk multi level, bila tidak pakai 0 (induk)',
  `kategori` varchar(64) DEFAULT NULL,
  `aktif` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori_children_1`
--

INSERT INTO `tb_kategori_children_1` (`id_kategori`, `id_user`, `id_kategori_parent`, `kategori`, `aktif`) VALUES
(1, 0x05f18b7566a0444888d50abfead883cb, 1, '11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_children_2`
--

CREATE TABLE `tb_kategori_children_2` (
  `id_kategori` int(11) NOT NULL,
  `id_user` binary(16) DEFAULT NULL,
  `id_kategori_children1` int(11) DEFAULT '0' COMMENT 'untuk multi level, bila tidak pakai 0 (induk)',
  `kategori` varchar(64) DEFAULT NULL,
  `aktif` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_parent`
--

CREATE TABLE `tb_kategori_parent` (
  `id_kategori` int(11) NOT NULL,
  `id_user` binary(16) DEFAULT NULL,
  `kategori` varchar(64) DEFAULT NULL,
  `aktif` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori_parent`
--

INSERT INTO `tb_kategori_parent` (`id_kategori`, `id_user`, `kategori`, `aktif`) VALUES
(1, 0x3316be5770864b1aaf5133bbf686f41d, 'kat', 1),
(2, 0x2f949fc9875548dfb95776e550f8fc6b, 'q', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(255) DEFAULT NULL,
  `drawer` int(11) DEFAULT NULL COMMENT '1/0,',
  `banner` int(11) DEFAULT NULL COMMENT '1/0,',
  `icon` text,
  `color` varchar(50) DEFAULT NULL,
  `darkcolor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` binary(16) NOT NULL,
  `id_user` binary(16) NOT NULL,
  `id_toko` binary(16) NOT NULL,
  `nama_toko` varchar(50) DEFAULT NULL,
  `nama_pembeli` varchar(50) DEFAULT NULL,
  `telp_pembeli` varchar(20) DEFAULT NULL,
  `email_pembeli` varchar(50) DEFAULT NULL,
  `diskon` double DEFAULT NULL,
  `total` int(11) NOT NULL,
  `tgl_order` datetime NOT NULL,
  `status` enum('lunas','batal','pending') NOT NULL DEFAULT 'pending',
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_detail`
--

CREATE TABLE `tb_order_detail` (
  `id_order_detail` int(11) NOT NULL,
  `id_order` binary(16) NOT NULL,
  `id_produk` binary(16) NOT NULL,
  `id_toko` binary(16) NOT NULL COMMENT 'untuk kemungkinan statistik barang yang terjual',
  `nama_produk` varchar(100) DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id_pembelian` binary(16) NOT NULL,
  `id_user` binary(16) NOT NULL,
  `id_toko` binary(16) NOT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `tgl_pembelian` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian_detail`
--

CREATE TABLE `tb_pembelian_detail` (
  `id_pembelian_detail` int(11) NOT NULL,
  `id_pembelian` binary(16) NOT NULL,
  `id_produk` binary(16) NOT NULL,
  `id_toko` binary(16) NOT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` binary(16) NOT NULL,
  `id_toko` binary(16) NOT NULL,
  `barcode` varchar(50) DEFAULT NULL,
  `kategori` text COMMENT 'json{''remote_id'':'''',children_1:'''',children_2:''''}',
  `nama_produk` varchar(128) NOT NULL,
  `harga` int(11) NOT NULL,
  `satuan` varchar(50) DEFAULT NULL COMMENT 'like kg, pcs, lusin, or anything',
  `detail` text,
  `stok` int(11) DEFAULT '0',
  `tgl_input` datetime NOT NULL,
  `jenis` enum('ready','pre-order') DEFAULT 'ready',
  `tgl_update` datetime DEFAULT NULL,
  `aktif` varchar(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `id_toko`, `barcode`, `kategori`, `nama_produk`, `harga`, `satuan`, `detail`, `stok`, `tgl_input`, `jenis`, `tgl_update`, `aktif`) VALUES
(0x0c0226872a804cc396c7005ab99e3284, 0xaf7f77de12294104a66b2effc5142398, NULL, '{"parent_id":"2","child_1":0}', 'q', 1, 'pcs', 'q', 1, '2017-07-15 14:16:42', 'ready', '2017-07-15 14:16:42', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_toko`
--

CREATE TABLE `tb_toko` (
  `id_toko` binary(16) NOT NULL,
  `id_user` binary(16) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` text,
  `no_telp` varchar(25) DEFAULT NULL,
  `aktif` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_toko`
--

INSERT INTO `tb_toko` (`id_toko`, `id_user`, `nama_toko`, `username`, `password`, `alamat`, `no_telp`, `aktif`) VALUES
(0xaf7f77de12294104a66b2effc5142398, 0x2f949fc9875548dfb95776e550f8fc6b, 'q', 'q', '7694f4a66316e53c8cdd9d9954bd611d', 'q', 'q', 1),
(0xf1460225e60247aca59b124f8f3814a3, 0x3316be5770864b1aaf5133bbf686f41d, 'adamista', 'adi', 'c46335eb267e2e1cde5b017acb4cd799', 'terban', '098123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` binary(16) NOT NULL,
  `id_facebook` text,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(25) DEFAULT NULL,
  `alamat` text,
  `aktif` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `id_facebook`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `alamat`, `aktif`) VALUES
(0x2f949fc9875548dfb95776e550f8fc6b, NULL, 'q', '7694f4a66316e53c8cdd9d9954bd611d', 'q', 'q', 'q', 'q', 1),
(0x3316be5770864b1aaf5133bbf686f41d, 'banteng', 'adi', 'c46335eb267e2e1cde5b017acb4cd799', 'adi', 'adihandoko2@gmail.com', '09871', 'terban', 1),
(0x75161c20bea8410bbbb060eb8e39146f, NULL, 'w', 'f1290186a5d0b1ceab27f4e77c0c5d68', 'w', 'ww', 'w', 'w', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_voucher`
--

CREATE TABLE `tb_voucher` (
  `id_voucher` binary(16) DEFAULT NULL,
  `id_user` binary(16) DEFAULT NULL,
  `id_toko` binary(16) DEFAULT NULL,
  `nama_voucher` varchar(50) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `tgl_input` datetime DEFAULT NULL,
  `tgl_kadaluarsa` datetime DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bayar`
--
ALTER TABLE `tb_bayar`
  ADD PRIMARY KEY (`id_bayar`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indexes for table `tb_gambar`
--
ALTER TABLE `tb_gambar`
  ADD PRIMARY KEY (`id_gambar`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `tb_kategori_children_1`
--
ALTER TABLE `tb_kategori_children_1`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_kategori_children_2`
--
ALTER TABLE `tb_kategori_children_2`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_kategori_parent`
--
ALTER TABLE `tb_kategori_parent`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indexes for table `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  ADD PRIMARY KEY (`id_order_detail`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indexes for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indexes for table `tb_pembelian_detail`
--
ALTER TABLE `tb_pembelian_detail`
  ADD PRIMARY KEY (`id_pembelian_detail`),
  ADD KEY `id_pembelian` (`id_pembelian`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tb_toko`
--
ALTER TABLE `tb_toko`
  ADD PRIMARY KEY (`id_toko`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_gambar`
--
ALTER TABLE `tb_gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_kategori_children_1`
--
ALTER TABLE `tb_kategori_children_1`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_kategori_children_2`
--
ALTER TABLE `tb_kategori_children_2`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_kategori_parent`
--
ALTER TABLE `tb_kategori_parent`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  MODIFY `id_order_detail` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_pembelian_detail`
--
ALTER TABLE `tb_pembelian_detail`
  MODIFY `id_pembelian_detail` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
