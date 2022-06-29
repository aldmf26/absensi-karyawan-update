-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 25, 2022 at 04:06 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi-karyawan-update`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id` int(11) NOT NULL,
  `idShift` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `fotoMasuk` varchar(256) NOT NULL,
  `fotoPulang` varchar(256) NOT NULL,
  `jamMasuk` time NOT NULL,
  `jamPulang` time NOT NULL,
  `lama` time NOT NULL,
  `urlMasuk` text NOT NULL,
  `urlPulang` text NOT NULL,
  `jenis` varchar(16) NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_absensi`
--

INSERT INTO `tb_absensi` (`id`, `idShift`, `idUser`, `tanggal`, `fotoMasuk`, `fotoPulang`, `jamMasuk`, `jamPulang`, `lama`, `urlMasuk`, `urlPulang`, `jenis`, `catatan`) VALUES
(1, 4, 2, '2022-06-21', 'Foto-1655820673.png', '', '21:11:13', '00:00:00', '00:00:00', 'https://maps.google.com/maps?&z=15&mrt=yp&t=k&q=-6.9932+110.4215', '', 'Hadir', '-'),
(2, 4, 2, '2022-06-23', 'Foto-1655965960.png', '', '13:32:40', '00:00:00', '00:00:00', 'https://maps.google.com/maps?&z=15&mrt=yp&t=k&q=-7.7405+110.2427', '', 'Izin', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_aplikasi`
--

CREATE TABLE `tb_aplikasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `telp` varchar(16) NOT NULL,
  `email` varchar(256) NOT NULL,
  `alamat` text NOT NULL,
  `logo` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_aplikasi`
--

INSERT INTO `tb_aplikasi` (`id`, `nama`, `telp`, `email`, `alamat`, `logo`) VALUES
(1, 'E-Absensi Pegawai Honorer Satpol PP Prov. Kal-sel', '089618367556', 'nurmuhaidi@gmail.com', 'Ngasem Candi Rt. 03 Rw. 01 Kec. Batealit Kab. Jepara', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `lokasi` varchar(256) NOT NULL,
  `kegiatan` varchar(256) NOT NULL,
  `masalah` text NOT NULL,
  `foto` varchar(256) NOT NULL,
  `terdaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kegiatan`
--

INSERT INTO `tb_kegiatan` (`id`, `idUser`, `lokasi`, `kegiatan`, `masalah`, `foto`, `terdaftar`) VALUES
(1, 2, 'https://maps.google.com/maps?&z=15&mrt=yp&t=k&q=-6.9932+110.4215', 'Tes Kegiatan', 'Tes Masalah', 'Kegiatan-1655822180.png', '2022-06-21 16:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `tb_shift`
--

CREATE TABLE `tb_shift` (
  `id` int(11) NOT NULL,
  `shift` varchar(64) NOT NULL,
  `terdaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_shift`
--

INSERT INTO `tb_shift` (`id`, `shift`, `terdaftar`) VALUES
(1, 'Pagi', '2022-02-09 18:06:16'),
(2, 'Malam', '2022-02-09 18:06:24'),
(3, 'Full Time', '2022-02-09 18:06:32'),
(4, 'BIS', '2022-02-09 18:06:38');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `telp` varchar(16) NOT NULL,
  `email` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `skin` varchar(8) NOT NULL,
  `level` varchar(16) NOT NULL,
  `terdaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `telp`, `email`, `username`, `password`, `foto`, `skin`, `level`, `terdaftar`) VALUES
(1, 'Nilna Muna', '089618367556', 'nilna@gmail.com', 'admin', '$2y$10$EbHqhyHeVEruxXYzj4ceuOFa6dkKNIOisJBrIFBLuf0d.cH6isoiu', 'Profil-1644404892.png', 'blue', 'Administrator', '2022-02-09 16:46:13'),
(2, 'Mudah', '081234567890', 'mudah@gmail.com', 'mudah', '$2y$10$ElnsyOnwENXF1oUvBZpdO.GWncXmoArYwzoYFEr6Ow0h7TwQ/xceW', 'no-image.png', 'blue', 'Karyawan', '2022-02-09 18:10:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK01` (`idUser`),
  ADD KEY `FK02` (`idShift`);

--
-- Indexes for table `tb_aplikasi`
--
ALTER TABLE `tb_aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_shift`
--
ALTER TABLE `tb_shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_aplikasi`
--
ALTER TABLE `tb_aplikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_shift`
--
ALTER TABLE `tb_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD CONSTRAINT `FK01` FOREIGN KEY (`idUser`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK02` FOREIGN KEY (`idShift`) REFERENCES `tb_shift` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
