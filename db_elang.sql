-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2020 at 08:04 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_elang`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(5) NOT NULL,
  `nama_admin` varchar(35) NOT NULL,
  `password_admin` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `password_admin`) VALUES
(1, 'aga', 'aga'),
(2, 'arfan', 'arfan');

-- --------------------------------------------------------

--
-- Table structure for table `bank_admin`
--

CREATE TABLE `bank_admin` (
  `id_bank` int(2) NOT NULL,
  `nama_bank` varchar(10) NOT NULL,
  `no_rek` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_admin`
--

INSERT INTO `bank_admin` (`id_bank`, `nama_bank`, `no_rek`) VALUES
(1, 'BRI', '3356-2564-9632-9845'),
(2, 'BNI', '3356-2564-9632-9731'),
(3, 'MANDIRI', '3356-2564-9632-1234'),
(4, 'BCA', '3356-2564-9632-4830'),
(5, 'BTN', '3356-2564-9632-7777');

-- --------------------------------------------------------

--
-- Table structure for table `ikan`
--

CREATE TABLE `ikan` (
  `id_ikan` int(10) NOT NULL,
  `ukuran` varchar(15) NOT NULL,
  `spesifikasi` varchar(500) NOT NULL,
  `waktu_lelang` datetime NOT NULL,
  `harga_ikan` int(15) NOT NULL,
  `status_lelang` enum('berlangsung','selesai','','') NOT NULL,
  `gambar_ikan` varchar(50) NOT NULL,
  `jenis_ikan` varchar(15) NOT NULL,
  `id_pelelang` int(8) NOT NULL,
  `status_kirim` enum('kirim','terima','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_ikan`
--

CREATE TABLE `jenis_ikan` (
  `id_jenis_ikan` int(5) NOT NULL,
  `nama_jenis` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_ikan`
--

INSERT INTO `jenis_ikan` (`id_jenis_ikan`, `nama_jenis`) VALUES
(1, 'tuna'),
(2, 'salmon'),
(3, 'kakap'),
(4, 'tongkol'),
(5, 'tengiri'),
(6, 'kerapu'),
(7, 'teri'),
(8, 'hiu'),
(9, 'pari'),
(10, 'bandeng'),
(11, 'makarel'),
(12, 'sarden'),
(13, 'marlin'),
(14, 'cakalang');

-- --------------------------------------------------------

--
-- Table structure for table `lupa_password`
--

CREATE TABLE `lupa_password` (
  `id` int(11) NOT NULL,
  `email_pengguna` varchar(50) NOT NULL,
  `code_lupas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `id_notif` int(15) NOT NULL,
  `baca` enum('belum','sudah','','') NOT NULL,
  `id_penawar` int(9) NOT NULL,
  `id_transfer` int(8) NOT NULL,
  `id_tawaran` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `now`
--

CREATE TABLE `now` (
  `id_now` int(11) NOT NULL,
  `now` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `now`
--

INSERT INTO `now` (`id_now`, `now`) VALUES
(1, '2020-02-03 13:52:53');

-- --------------------------------------------------------

--
-- Table structure for table `pelelang`
--

CREATE TABLE `pelelang` (
  `id_pelelang` int(8) NOT NULL,
  `nama_pelelang` varchar(45) NOT NULL,
  `rek_pelelang` varchar(25) NOT NULL,
  `alamat_pelelang` varchar(45) NOT NULL,
  `pp_pelelang` varchar(50) NOT NULL,
  `password_pelelang` varchar(15) NOT NULL,
  `notelp_pelelang` varchar(20) NOT NULL,
  `email_pelelang` varchar(35) NOT NULL,
  `catatan_pelelang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemenang`
--

CREATE TABLE `pemenang` (
  `id_pemenang` int(9) NOT NULL,
  `id_tawaran` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penawar`
--

CREATE TABLE `penawar` (
  `id_penawar` int(9) NOT NULL,
  `nama_penawar` varchar(35) NOT NULL,
  `rek_penawar` varchar(25) NOT NULL,
  `alamat_penawar` varchar(45) NOT NULL,
  `pp_penawar` varchar(50) NOT NULL,
  `password_penawar` varchar(15) NOT NULL,
  `notelp_penawar` varchar(20) NOT NULL,
  `email_penawar` varchar(35) NOT NULL,
  `saldo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tawaran`
--

CREATE TABLE `tawaran` (
  `id_tawaran` int(10) NOT NULL,
  `jumlah_tawaran` int(15) NOT NULL,
  `id_penawar` int(9) NOT NULL,
  `id_ikan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `id_transfer` int(8) NOT NULL,
  `bukti_transfer` varchar(50) NOT NULL,
  `id_penawar` int(9) NOT NULL,
  `nama_rek` varchar(50) NOT NULL,
  `nominal` int(7) NOT NULL,
  `status_transfer` enum('belum','konfirm','gagal','') NOT NULL,
  `waktu` datetime NOT NULL,
  `id_bank` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_pelelang`
--

CREATE TABLE `transfer_pelelang` (
  `id_transfer_pelelang` int(10) NOT NULL,
  `status_transpelelang` enum('kirim','konfirm','','') NOT NULL,
  `bukti_transpelelang` varchar(50) NOT NULL,
  `id_pemenang` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `bank_admin`
--
ALTER TABLE `bank_admin`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `ikan`
--
ALTER TABLE `ikan`
  ADD PRIMARY KEY (`id_ikan`),
  ADD KEY `id_pelelang` (`id_pelelang`);

--
-- Indexes for table `jenis_ikan`
--
ALTER TABLE `jenis_ikan`
  ADD PRIMARY KEY (`id_jenis_ikan`);

--
-- Indexes for table `lupa_password`
--
ALTER TABLE `lupa_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id_notif`);

--
-- Indexes for table `now`
--
ALTER TABLE `now`
  ADD PRIMARY KEY (`id_now`);

--
-- Indexes for table `pelelang`
--
ALTER TABLE `pelelang`
  ADD PRIMARY KEY (`id_pelelang`);

--
-- Indexes for table `pemenang`
--
ALTER TABLE `pemenang`
  ADD PRIMARY KEY (`id_pemenang`),
  ADD KEY `id_tawaran` (`id_tawaran`);

--
-- Indexes for table `penawar`
--
ALTER TABLE `penawar`
  ADD PRIMARY KEY (`id_penawar`);

--
-- Indexes for table `tawaran`
--
ALTER TABLE `tawaran`
  ADD PRIMARY KEY (`id_tawaran`),
  ADD KEY `id_ikan` (`id_ikan`),
  ADD KEY `id_penawar` (`id_penawar`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id_transfer`),
  ADD KEY `id_penawar` (`id_penawar`),
  ADD KEY `id_bank` (`id_bank`);

--
-- Indexes for table `transfer_pelelang`
--
ALTER TABLE `transfer_pelelang`
  ADD PRIMARY KEY (`id_transfer_pelelang`),
  ADD KEY `id_pemenang` (`id_pemenang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bank_admin`
--
ALTER TABLE `bank_admin`
  MODIFY `id_bank` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ikan`
--
ALTER TABLE `ikan`
  MODIFY `id_ikan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `jenis_ikan`
--
ALTER TABLE `jenis_ikan`
  MODIFY `id_jenis_ikan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `lupa_password`
--
ALTER TABLE `lupa_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `id_notif` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `now`
--
ALTER TABLE `now`
  MODIFY `id_now` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pelelang`
--
ALTER TABLE `pelelang`
  MODIFY `id_pelelang` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pemenang`
--
ALTER TABLE `pemenang`
  MODIFY `id_pemenang` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `penawar`
--
ALTER TABLE `penawar`
  MODIFY `id_penawar` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tawaran`
--
ALTER TABLE `tawaran`
  MODIFY `id_tawaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id_transfer` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `transfer_pelelang`
--
ALTER TABLE `transfer_pelelang`
  MODIFY `id_transfer_pelelang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ikan`
--
ALTER TABLE `ikan`
  ADD CONSTRAINT `ikan_ibfk_1` FOREIGN KEY (`id_pelelang`) REFERENCES `pelelang` (`id_pelelang`);

--
-- Constraints for table `pemenang`
--
ALTER TABLE `pemenang`
  ADD CONSTRAINT `pemenang_ibfk_1` FOREIGN KEY (`id_tawaran`) REFERENCES `tawaran` (`id_tawaran`);

--
-- Constraints for table `tawaran`
--
ALTER TABLE `tawaran`
  ADD CONSTRAINT `tawaran_ibfk_1` FOREIGN KEY (`id_ikan`) REFERENCES `ikan` (`id_ikan`),
  ADD CONSTRAINT `tawaran_ibfk_2` FOREIGN KEY (`id_penawar`) REFERENCES `penawar` (`id_penawar`);

--
-- Constraints for table `transfer`
--
ALTER TABLE `transfer`
  ADD CONSTRAINT `transfer_ibfk_1` FOREIGN KEY (`id_penawar`) REFERENCES `penawar` (`id_penawar`),
  ADD CONSTRAINT `transfer_ibfk_2` FOREIGN KEY (`id_bank`) REFERENCES `bank_admin` (`id_bank`);

--
-- Constraints for table `transfer_pelelang`
--
ALTER TABLE `transfer_pelelang`
  ADD CONSTRAINT `transfer_pelelang_ibfk_1` FOREIGN KEY (`id_pemenang`) REFERENCES `pemenang` (`id_pemenang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
