-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2022 at 08:26 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_guru`
--

CREATE TABLE `user_guru` (
  `Id` int(11) NOT NULL,
  `Nama` varchar(225) NOT NULL,
  `Nip` varchar(255) NOT NULL,
  `Tempat` varchar(225) NOT NULL,
  `Tanggal` date NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Alamat` varchar(225) NOT NULL,
  `Posisi` varchar(255) NOT NULL,
  `Username` varchar(225) NOT NULL,
  `Password` varchar(225) NOT NULL,
  `Profil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_guru`
--

INSERT INTO `user_guru` (`Id`, `Nama`, `Nip`, `Tempat`, `Tanggal`, `Email`, `Alamat`, `Posisi`, `Username`, `Password`, `Profil`) VALUES
(3, 'Dra. Aisyah. S', '196408241998022002', 'Luwu', '1964-08-24', '', '', 'Wakasek Kesiswaan ', 'aisyahs', '24081964', 'profil.png'),
(4, 'Drs. Muhammad Azas', '196505072005021001', 'Luwu', '1965-05-07', '', '', 'Guru Mapel', 'muhazas', '07051965', 'profil.png'),
(5, 'Drs. Amir Tanggu', '196604212005021001', '', '0000-00-00', '', '', 'Guru Mapel', 'drsamirtanggu', '21041966', ''),
(6, 'Djumariah, S.Pd', '196808241998022004', '', '0000-00-00', '', '', 'Guru Mapel', 'djumariah', '24081968', ''),
(7, 'Hairiana, ST', '196807272006042013', '', '0000-00-00', '', '', 'Guru Mapel', 'hairiana', '27071968', ''),
(8, 'Manda, S.Pd', '197102151998032012', '', '0000-00-00', '', '', 'Guru Mapel', 'manda', '15021971', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_guru`
--
ALTER TABLE `user_guru`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_guru`
--
ALTER TABLE `user_guru`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
