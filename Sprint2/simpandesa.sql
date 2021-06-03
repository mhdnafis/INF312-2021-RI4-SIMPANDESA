-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 02, 2021 at 06:47 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `simpandesa`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(128) NOT NULL,
  `gambar` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `gambar`) VALUES
(1, 'Tenda', 'tent.png'),
(2, 'Terpal', 'carpet.png'),
(3, 'Tali tambang', 'rope.png'),
(4, 'Kuali/belangong', 'cauldron.png'),
(5, 'keranda mayit', 'coffin.png'),
(6, 'Meja/Kursi (per set)', 'chair.png'),
(7, 'Pemotong rumput', 'lawn-mower.png'),
(8, 'Sound System', 'sound-system.png');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `id_konfirmasi` int(11) NOT NULL,
  `id_kuantitas` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl_pinjem` int(11) NOT NULL,
  `tgl_kembali` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status_kembali` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konfirmasi`
--

INSERT INTO `konfirmasi` (`id_konfirmasi`, `id_kuantitas`, `id_barang`, `tgl_pinjem`, `tgl_kembali`, `id_user`, `status_kembali`) VALUES
(43, 0, 1, 1622505600, 1623196800, 1, 1),
(44, 0, 2, 1622505600, 1623196800, 1, 1),
(45, 0, 2, 1622505600, 1623196800, 1, 1),
(46, 0, 3, 1622505600, 1623196800, 1, 1),
(47, 0, 4, 1622505600, 1623196800, 1, 1),
(48, 0, 1, 1622592000, 1622764800, 3, 1),
(49, 0, 3, 1622592000, 1622764800, 3, 1),
(50, 0, 3, 1622592000, 1622764800, 3, 1),
(51, 0, 8, 1622592000, 1622764800, 3, 1),
(52, 0, 1, 1622592000, 1622851200, 4, 1),
(53, 0, 2, 1622592000, 1622851200, 4, 0),
(54, 0, 2, 1622592000, 1622851200, 4, 1),
(55, 0, 6, 1622566800, 1622739600, 6, 0),
(56, 0, 6, 1622566800, 1622739600, 6, 0),
(57, 0, 5, 1625011200, 1625097600, 5, 0),
(58, 0, 5, 1625788800, 1625875200, 1, 1),
(59, 0, 1, 1622678400, 1623974400, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kuantitas`
--

CREATE TABLE `kuantitas` (
  `id_kuantitas` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kuantitas`
--

INSERT INTO `kuantitas` (`id_kuantitas`, `id_barang`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 3),
(5, 2),
(6, 2),
(7, 4),
(8, 6),
(9, 6),
(10, 7),
(11, 7),
(12, 8),
(15, 5),
(16, 5),
(17, 2),
(18, 3),
(19, 2),
(20, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `pass` varchar(128) NOT NULL,
  `hak_akses` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nik`, `nama`, `pass`, `hak_akses`) VALUES
(1, '1234567890', 'jokowi', '123', 'user'),
(2, '0987654321', 'agus', '123', 'admin'),
(3, '123123123', 'Naufal Alfadhil', '123123', 'user'),
(4, '456343222', 'Daffaq SP', '123', 'user'),
(5, '6789012391283', 'Agus Budiman', '123', 'user'),
(6, '017823701823', 'Panjul', '123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indexes for table `kuantitas`
--
ALTER TABLE `kuantitas`
  ADD PRIMARY KEY (`id_kuantitas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `kuantitas`
--
ALTER TABLE `kuantitas`
  MODIFY `id_kuantitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
