-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2022 at 08:19 AM
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
-- Table structure for table `user_siswa`
--

CREATE TABLE `user_siswa` (
  `Id` int(11) NOT NULL,
  `Nama` varchar(225) NOT NULL,
  `Nis` varchar(225) NOT NULL,
  `Kelas` varchar(225) NOT NULL,
  `Tempat` varchar(225) NOT NULL,
  `Tanggal` date NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Alamat` varchar(225) NOT NULL,
  `Username` varchar(225) NOT NULL,
  `Password` varchar(225) NOT NULL,
  `Profil` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_siswa`
--

INSERT INTO `user_siswa` (`Id`, `Nama`, `Nis`, `Kelas`, `Tempat`, `Tanggal`, `Email`, `Alamat`, `Username`, `Password`, `Profil`) VALUES
(1, 'Abdillah', '2021005179', 'X Mipa 6', 'Tolajuk', '2006-04-20', '', 'Kampung Tangga', 'abdillah', '20042006', 'baymax.jpg'),
(2, 'Aisyah', '2021005180', 'X Mipa 6', 'Tolajuk', '2006-10-08', '', 'Kampung Tangga', 'aisyah', '08102006', 'profil.png'),
(3, 'Badia', '2021005181', 'X Mipa 6', 'Tolajuk', '2006-11-03', '', 'Kampung Tangga', 'badia', '03112006', 'profil.png'),
(4, 'Dina', '2021005182', 'X Mipa 6', 'Tolajuk', '2006-05-18', '', 'Kampung Tangga', 'dina', '18052006', 'profil.png'),
(5, 'Faiqa', '2021005183', 'X Mipa 6', 'Tolajuk', '2006-12-05', '', 'Kampung Tangga', 'faiqa', '0512006', 'profil.png'),
(6, 'Ihlasul', '2021005184', 'X Mipa 6', 'Tolajuk', '2006-07-23', '', 'Kampung Tangga', 'ihlasul', '23072006', 'profil.png'),
(7, 'Wilbert', '2021005185', 'X Mipa 6', 'Tolajuk', '2006-03-28', '', 'Kampung Tangga', 'wilbert', '28032006', 'profil.png'),
(8, 'Yudi', '2021005186', 'X Mipa 6', 'Tolajuk', '2006-10-17', '', 'Kampung Tangga', 'yudi', '17102006', 'profil.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_siswa`
--
ALTER TABLE `user_siswa`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_siswa`
--
ALTER TABLE `user_siswa`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
