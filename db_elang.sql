-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2020 at 08:06 PM
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
(1, 'aga', 'aga');

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

--
-- Dumping data for table `ikan`
--

INSERT INTO `ikan` (`id_ikan`, `ukuran`, `spesifikasi`, `waktu_lelang`, `harga_ikan`, `status_lelang`, `gambar_ikan`, `jenis_ikan`, `id_pelelang`, `status_kirim`) VALUES
(1, '11', 'iwak peyek', '2020-01-07 11:41:57', 1000000, 'selesai', 'ikan/resize_10563087345e1017e77a457.jpg', 'kakap', 2, ''),
(2, '15', 'ikan tongkol dapet sepeda', '2020-01-05 12:23:58', 1000000, 'selesai', 'ikan/resize_1832464915e117319dcdee.jpg', 'salmon', 2, ''),
(3, '15', 'ikan tongkol dapet sepeda', '2020-01-09 10:08:00', 100000, 'selesai', 'ikan/resize_15878622845e146faa23d48.jpg', 'kakap', 2, 'terima'),
(4, '11', 'salmonella', '2020-01-12 12:36:07', 100000, 'selesai', 'ikan/resize_14103583575e1aad4b24b4a.jpg', 'salmon', 2, 'terima'),
(5, '', '', '0000-00-00 00:00:00', 0, 'selesai', 'ikan/resize_3094274225e1ab2322cab6.jpg', 'kakap', 2, 'kirim'),
(6, '', '', '0000-00-00 00:00:00', 0, 'selesai', 'ikan/resize_15685930885e1ab2f0e4436.jpg', 'kakap', 2, ''),
(7, '1', 'ikan tongkol dapet sepeda', '2020-01-14 15:30:52', 100000, 'berlangsung', 'ikan/resize_18451422165e1ad95d8b649.jpg', 'kakap', 2, '');

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
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `id_notif` int(15) NOT NULL,
  `baca` enum('belum','sudah','','') NOT NULL,
  `id_penawar` int(9) NOT NULL,
  `id_transfer` int(8) NOT NULL,
  `id_tawaran` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`id_notif`, `baca`, `id_penawar`, `id_transfer`, `id_tawaran`) VALUES
(15, 'sudah', 2, 35, 0),
(16, 'sudah', 2, 36, 0),
(17, 'sudah', 2, 37, 0),
(18, 'belum', 1, 0, 21),
(19, 'sudah', 2, 0, 20),
(20, 'sudah', 2, 38, 0);

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
(1, '2020-01-14 01:58:43');

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

--
-- Dumping data for table `pelelang`
--

INSERT INTO `pelelang` (`id_pelelang`, `nama_pelelang`, `rek_pelelang`, `alamat_pelelang`, `pp_pelelang`, `password_pelelang`, `notelp_pelelang`, `email_pelelang`, `catatan_pelelang`) VALUES
(2, 'aga', '12345', 'jember', 'pppl/resize_7781288625dfc418f6689d.jpg', 'aga', '123', 'aga@gmail.com', 'pelelang pro'),
(3, 'arfan', '', '', '', '123', '12', 'aga@gmail.com', ''),
(4, 'aga', '', '', '', 'qwe', '123', 'aga12@gmail.com', ''),
(5, 'aga', '', '', '', 'qwe', '123', 'aga12@gmail.com', ''),
(6, 'kazene', '', '', '', 'aga', '1111111', 'aga@gmail.com', ''),
(7, 'fukuro aga', '12345', 'jember city', 'pppl/resize_19310244555e11793fb59dc.jpg', 'aga', '123', 'aga@gmail.com', 'ahli ikan dari east blue');

-- --------------------------------------------------------

--
-- Table structure for table `pemenang`
--

CREATE TABLE `pemenang` (
  `id_pemenang` int(9) NOT NULL,
  `id_tawaran` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemenang`
--

INSERT INTO `pemenang` (`id_pemenang`, `id_tawaran`) VALUES
(27, 15),
(29, 17);

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

--
-- Dumping data for table `penawar`
--

INSERT INTO `penawar` (`id_penawar`, `nama_penawar`, `rek_penawar`, `alamat_penawar`, `pp_penawar`, `password_penawar`, `notelp_penawar`, `email_penawar`, `saldo`) VALUES
(1, 'pandu', '321', 'jelbuk', '', 'aga', '123', 'aga@gmail.com', 300000),
(2, 'aga', '69', 'jember', 'pppn/resize_5834266365e001a36d5e3b.jpg', 'aga', '09811111111', 'aga@gmail.com', 1620000),
(3, 'wahyu', '', '', '', 'wahyu', '123', 'wahyu@gmail.com', 300000),
(4, 'cr', '', '', '', 'aga', '123', 'aga@gmail.com', 300000),
(5, 'kaka', '', '', '', 'aga', '123', 'aga@gmail.com', 300000),
(6, 'buffon', '', '', '', 'aga', '123', 'aga@gmail.com', 0);

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

--
-- Dumping data for table `tawaran`
--

INSERT INTO `tawaran` (`id_tawaran`, `jumlah_tawaran`, `id_penawar`, `id_ikan`) VALUES
(10, 100000, 4, 3),
(15, 110000, 2, 3),
(17, 110000, 2, 4),
(19, 105000, 1, 4),
(20, 150000, 2, 7),
(21, 145000, 1, 7);

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

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`id_transfer`, `bukti_transfer`, `id_penawar`, `nama_rek`, `nominal`, `status_transfer`, `waktu`, `id_bank`) VALUES
(35, 'buktitopup/resize_11495758335e1b5725cf536.jpg', 2, 'a', 150000, 'konfirm', '2020-01-13 00:26:33', 5),
(36, 'buktitopup/resize_7411849785e1b5738d1478.jpg', 2, 'b', 100000, 'konfirm', '2020-01-13 00:27:15', 5),
(37, 'buktitopup/resize_1376235435e1b574c34daa.jpg', 2, 'c', 150000, 'gagal', '2020-01-13 00:27:37', 5),
(38, 'buktitopup/resize_9761078415e1c6e7d05af3.jpg', 2, 'saa', 50000, 'belum', '2020-01-13 20:18:42', 5);

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
-- Dumping data for table `transfer_pelelang`
--

INSERT INTO `transfer_pelelang` (`id_transfer_pelelang`, `status_transpelelang`, `bukti_transpelelang`, `id_pemenang`) VALUES
(2, 'konfirm', 'buktitrans/resize_16021716465e191ad4a81be.jpg', 27),
(4, 'konfirm', 'buktitrans/resize_14086721365e1ab5330c232.jpg', 29);

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
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_admin`
--
ALTER TABLE `bank_admin`
  MODIFY `id_bank` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ikan`
--
ALTER TABLE `ikan`
  MODIFY `id_ikan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jenis_ikan`
--
ALTER TABLE `jenis_ikan`
  MODIFY `id_jenis_ikan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `id_notif` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `now`
--
ALTER TABLE `now`
  MODIFY `id_now` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pelelang`
--
ALTER TABLE `pelelang`
  MODIFY `id_pelelang` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pemenang`
--
ALTER TABLE `pemenang`
  MODIFY `id_pemenang` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `penawar`
--
ALTER TABLE `penawar`
  MODIFY `id_penawar` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tawaran`
--
ALTER TABLE `tawaran`
  MODIFY `id_tawaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id_transfer` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `transfer_pelelang`
--
ALTER TABLE `transfer_pelelang`
  MODIFY `id_transfer_pelelang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
