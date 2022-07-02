-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2022 at 06:06 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_skripsi_pm`
--

-- --------------------------------------------------------

--
-- Table structure for table `aspek`
--

CREATE TABLE `aspek` (
  `id_aspek` int(11) NOT NULL,
  `kode_aspek` varchar(6) NOT NULL,
  `nama_aspek` varchar(100) NOT NULL,
  `persentase` float NOT NULL,
  `bobot_cf` float NOT NULL,
  `bobot_sf` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aspek`
--

INSERT INTO `aspek` (`id_aspek`, `kode_aspek`, `nama_aspek`, `persentase`, `bobot_cf`, `bobot_sf`) VALUES
(1, 'A001', 'sikap', 40, 60, 40),
(2, 'A002', 'Pengetahuan', 20, 60, 40),
(3, 'A003', 'Keterampilan', 40, 60, 40);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `id_aspek` int(11) NOT NULL,
  `kode_kriteria` varchar(6) NOT NULL,
  `deskripsi` varchar(128) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `nilai` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `id_aspek`, `kode_kriteria`, `deskripsi`, `jenis`, `nilai`) VALUES
(2, 1, 'A11', 'Core Factor', 'Disiplin', 5),
(4, 1, 'A12', 'Core Factor', 'Core Factor', 5),
(5, 1, 'A13', 'Secondary Factor', 'Kerja Sama', 4),
(6, 1, 'A14', 'Core Factor', 'Tanggung Jawab', 5),
(7, 1, 'A15', 'Secondary Factor', 'komunikasi', 4),
(8, 1, 'A16', 'Secondary Factor', 'Dedikasi', 3),
(9, 2, 'A21', 'Secondary Factor', 'Konseptual', 3),
(10, 2, 'A22', 'Core Factor', 'Prosedural', 5),
(11, 3, 'A31', 'Core Factor', 'Penggunaan Alat', 5),
(12, 3, 'A32', 'Secondary Factor', 'Perawatan Alat', 4),
(13, 3, 'A33', 'Core Factor', 'Kreatifitas/inisiatif', 5);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_sikap`
--

CREATE TABLE `nilai_sikap` (
  `kdnilai1` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `nilai_dis` int(3) NOT NULL,
  `target_dis` int(3) NOT NULL,
  `selisih_dis` float NOT NULL,
  `nilai_bobot_dis` float NOT NULL,
  `nilai_kr` int(3) NOT NULL,
  `target_kr` int(3) NOT NULL,
  `selisih_kr` float NOT NULL,
  `nilai_bobot_kr` float NOT NULL,
  `nilai_ks` int(3) NOT NULL,
  `target_ks` int(3) NOT NULL,
  `selisih_ks` float NOT NULL,
  `nilai_bobot_ks` float NOT NULL,
  `nilai_tj` int(3) NOT NULL,
  `target_tj` int(3) NOT NULL,
  `selisih_tj` float NOT NULL,
  `nilai_bobot_tj` float NOT NULL,
  `nilai_kom` int(3) NOT NULL,
  `target_kom` int(3) NOT NULL,
  `selisih_kom` float NOT NULL,
  `nilai_bobot_kom` float NOT NULL,
  `nilai_ded` int(3) NOT NULL,
  `target_ded` int(3) NOT NULL,
  `selisih_ded` float NOT NULL,
  `nilai_bobot_ded` float NOT NULL,
  `nilai_cf_1` float NOT NULL,
  `nilai_sf_1` float NOT NULL,
  `nilai_to_1` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `NIS` varchar(30) NOT NULL,
  `Nama` varchar(128) NOT NULL,
  `Alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `NIS`, `Nama`, `Alamat`) VALUES
(1, '192010009', 'Ahmad Khaliq Giana Putra', 'bogor'),
(2, '192010021', 'Alvin Deska Saputra', 'bogor'),
(3, '202110230', 'Ardiansyah Wicaksana', 'bogor'),
(4, '1920100037', 'Arpan Afandi', 'bogor'),
(5, '1920100067', 'Egi Hartono', 'bogor'),
(6, '192010072', 'Endang Wahyudi', 'bogor'),
(7, '192010080', 'Farhan Hakim', 'bogor'),
(8, '192010255', 'Hera Nuraeni', 'bogor'),
(9, '192010101', 'Idrus', 'bogor'),
(10, '192010141', 'M. Herdian', 'bogor'),
(11, '192010129', 'Mitha Haerunisa', 'bogor'),
(12, '192010135', 'Muhamad Bayhaqi', 'bogor'),
(13, '192010144', 'Muhammad Irfan Maulana', 'bogor'),
(14, '192010153', 'Muhammad Javier', 'bogor'),
(15, '1920100084', 'Pirman Setia Budi', 'bogor'),
(16, '1920100194', 'Rizqia Khoerunnisa', 'bogor');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$sBKs1X7KyoXHNnswPVKeVONiGMJ8NUiIX.rVXfreCOz1ptN1wfKHu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aspek`
--
ALTER TABLE `aspek`
  ADD PRIMARY KEY (`id_aspek`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`),
  ADD KEY `id_aspek` (`id_aspek`);

--
-- Indexes for table `nilai_sikap`
--
ALTER TABLE `nilai_sikap`
  ADD PRIMARY KEY (`kdnilai1`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aspek`
--
ALTER TABLE `aspek`
  MODIFY `id_aspek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nilai_sikap`
--
ALTER TABLE `nilai_sikap`
  MODIFY `kdnilai1` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
