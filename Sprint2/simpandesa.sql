-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 02, 2021 at 10:51 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `simpandesa`
--

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
(5, '6789012391283', 'Agus Budiman', '123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
