-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 25, 2019 at 08:30 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_mycin`
--

-- --------------------------------------------------------

--
-- Table structure for table `aturan`
--

CREATE TABLE `aturan` (
  `id` bigint(20) NOT NULL,
  `gejala_id` bigint(20) NOT NULL,
  `penyakit_id` bigint(20) NOT NULL,
  `md` decimal(3,2) NOT NULL,
  `mb` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aturan`
--

INSERT INTO `aturan` (`id`, `gejala_id`, `penyakit_id`, `md`, `mb`) VALUES
(1, 2, 1, '0.20', '0.70'),
(2, 6, 1, '0.10', '0.80'),
(3, 1, 2, '0.20', '0.60'),
(4, 3, 2, '0.40', '0.70'),
(5, 4, 2, '0.10', '0.80'),
(6, 7, 3, '0.10', '0.70'),
(7, 6, 3, '0.20', '0.60'),
(8, 1, 3, '0.10', '0.80'),
(9, 1, 4, '0.20', '0.60'),
(10, 2, 4, '0.20', '0.70'),
(11, 3, 4, '0.20', '0.60'),
(12, 4, 4, '0.10', '0.60'),
(13, 5, 4, '0.10', '0.80'),
(14, 6, 4, '0.10', '0.70'),
(15, 7, 4, '0.05', '0.80');

-- --------------------------------------------------------

--
-- Table structure for table `info_gejala`
--

CREATE TABLE `info_gejala` (
  `id` bigint(20) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `keterangan` text NOT NULL DEFAULT '- Tidak Ada Keterangan -'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_gejala`
--

INSERT INTO `info_gejala` (`id`, `kode`, `keterangan`) VALUES
(1, 'KD-01', 'Panas'),
(2, 'KD-02', 'Sakit Kepala'),
(3, 'KD-03', 'Bersin'),
(4, 'KD-04', 'Batuk'),
(5, 'KD-05', 'Pilek, Hidung Buntu'),
(6, 'KD-06', 'Badan Lemas'),
(7, 'KD-07', 'Kedinginan');

-- --------------------------------------------------------

--
-- Table structure for table `info_penyakit`
--

CREATE TABLE `info_penyakit` (
  `id` bigint(20) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `nama` text NOT NULL,
  `keterangan` text NOT NULL DEFAULT '- Tidak Ada Keterangan -'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_penyakit`
--

INSERT INTO `info_penyakit` (`id`, `kode`, `nama`, `keterangan`) VALUES
(1, 'PK-A', 'Anemia', '- Tidak Ada Keterangan -'),
(2, 'PK-B', 'Bronkhitis', '- Tidak Ada Keterangan -'),
(3, 'PK-D', 'Demam', '- Tidak Ada Keterangan -'),
(4, 'PK-F', 'Flu', '- Tidak Ada Keterangan -');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gejala_id` (`gejala_id`),
  ADD KEY `penyakit_id` (`penyakit_id`);

--
-- Indexes for table `info_gejala`
--
ALTER TABLE `info_gejala`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_penyakit`
--
ALTER TABLE `info_penyakit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aturan`
--
ALTER TABLE `aturan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `info_gejala`
--
ALTER TABLE `info_gejala`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `info_penyakit`
--
ALTER TABLE `info_penyakit`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aturan`
--
ALTER TABLE `aturan`
  ADD CONSTRAINT `aturan_ibfk_1` FOREIGN KEY (`gejala_id`) REFERENCES `info_gejala` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `aturan_ibfk_2` FOREIGN KEY (`penyakit_id`) REFERENCES `info_penyakit` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
