-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2022 at 06:15 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

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
-- Table structure for table `alur`
--

CREATE TABLE `alur` (
  `Id_Alur` int(11) NOT NULL,
  `Id_Mapel` int(11) NOT NULL,
  `Judul` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alur`
--

INSERT INTO `alur` (`Id_Alur`, `Id_Mapel`, `Judul`) VALUES
(3, 50, 'Pertemuan 1'),
(4, 50, 'pertemuan 2');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id_announ` int(11) NOT NULL,
  `judul` varchar(225) NOT NULL,
  `deskripsi` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id_announ`, `judul`, `deskripsi`, `image`) VALUES
(1, 'News 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type ', 'announ_1.jpg'),
(2, 'News ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, ', 'announ_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detail_mapel`
--

CREATE TABLE `detail_mapel` (
  `Id_Mapel` int(11) NOT NULL,
  `Nama_Mapel` int(225) NOT NULL,
  `Id_Tugas` int(11) NOT NULL,
  `Id_Alur` int(11) NOT NULL,
  `Id_Forum` int(11) NOT NULL,
  `Id_Exam` int(11) NOT NULL,
  `Id_Docs` int(11) NOT NULL,
  `Id_Pengumuman` int(11) NOT NULL,
  `Id_Tautan` int(11) NOT NULL,
  `Nama` varchar(225) NOT NULL,
  `Nis/Nip` int(40) NOT NULL,
  `Id_Progress` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `docs`
--

CREATE TABLE `docs` (
  `Id_Docs` int(11) NOT NULL,
  `Id_Mapel` int(11) NOT NULL,
  `Materi` varchar(225) NOT NULL,
  `Judul` varchar(225) NOT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `docs`
--

INSERT INTO `docs` (`Id_Docs`, `Id_Mapel`, `Materi`, `Judul`, `Waktu`) VALUES
(3, 50, 'Materi Pertemuan 3', 'PERNYATAAN IZIN ORANG TUA 2022.pdf', '2022-05-03 10:07:03');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `Id_Forum` int(11) NOT NULL,
  `Id_Mapel` int(11) NOT NULL,
  `Nama_Forum` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`Id_Forum`, `Id_Mapel`, `Nama_Forum`) VALUES
(14, 50, 'forum');

-- --------------------------------------------------------

--
-- Table structure for table `forum_cat`
--

CREATE TABLE `forum_cat` (
  `Id_ForumCat` int(11) NOT NULL,
  `Id_Forum` int(11) NOT NULL,
  `Judul` varchar(225) NOT NULL,
  `Deskripsi` text NOT NULL,
  `Waktu` datetime NOT NULL DEFAULT current_timestamp(),
  `Nama` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_cat`
--

INSERT INTO `forum_cat` (`Id_ForumCat`, `Id_Forum`, `Judul`, `Deskripsi`, `Waktu`, `Nama`) VALUES
(33, 14, 'Kelompok 1', '<p>Tempat Diskusi&nbsp;Kelompok 1</p>\r\n', '2022-05-18 18:14:16', 'Manda, S.Pd');

-- --------------------------------------------------------

--
-- Table structure for table `forum_reply`
--

CREATE TABLE `forum_reply` (
  `Id_Reply` int(11) NOT NULL,
  `Id_ForumThr` int(11) NOT NULL,
  `Id_ForumCat` int(11) NOT NULL,
  `NamaUser` varchar(225) NOT NULL,
  `JudulReply` varchar(255) NOT NULL,
  `DeskripsiReply` text NOT NULL,
  `WaktuReply` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_reply`
--

INSERT INTO `forum_reply` (`Id_Reply`, `Id_ForumThr`, `Id_ForumCat`, `NamaUser`, `JudulReply`, `DeskripsiReply`, `WaktuReply`) VALUES
(57, 39, 33, 'Manda, S.Pd', 'Frontend', '<p>semangat✌</p>\r\n', '2022-05-18 18:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `forum_thread`
--

CREATE TABLE `forum_thread` (
  `Id_ForumThr` int(11) NOT NULL,
  `Id_ForumCat` int(11) NOT NULL,
  `Judul` varchar(225) NOT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `Deskripsi` text NOT NULL,
  `Nama` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_thread`
--

INSERT INTO `forum_thread` (`Id_ForumThr`, `Id_ForumCat`, `Judul`, `Waktu`, `Deskripsi`, `Nama`) VALUES
(39, 33, 'Frontend', '2022-05-18 10:16:45', '<p>Diskusi Frontend</p>\r\n', 'Abdillah'),
(42, 39, 'Frontend', '2022-05-18 10:48:00', '<p>wfrs</p>\r\n', 'Abdillah');

-- --------------------------------------------------------

--
-- Table structure for table `guru_terdaftar`
--

CREATE TABLE `guru_terdaftar` (
  `Id_Anggota` int(11) NOT NULL,
  `Nama` varchar(225) NOT NULL,
  `Nip` varchar(225) NOT NULL,
  `Id_Kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru_terdaftar`
--

INSERT INTO `guru_terdaftar` (`Id_Anggota`, `Nama`, `Nip`, `Id_Kelas`) VALUES
(19, 'Manda, S.Pd', '197102151998032012', 50),
(20, 'Manda, S.Pd', '197102151998032012', 44);

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_ujian`
--

CREATE TABLE `jawaban_ujian` (
  `id_jawab` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `soal` text NOT NULL,
  `jawaban` text NOT NULL,
  `skor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jawaban_ujian`
--

INSERT INTO `jawaban_ujian` (`id_jawab`, `id_ujian`, `nama`, `soal`, `jawaban`, `skor`) VALUES
(87, 2, 'Abdillah', '12', 'yahs', 23),
(88, 2, 'Abdillah', '14', 'kamar', 23),
(89, 2, 'Abdillah', '11', 'yah', 23),
(90, 2, 'Abdillah', '2', '<p>baik</p>\r\n', 23);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `Id_Kelas` int(11) NOT NULL,
  `Nama_Kelas` varchar(225) NOT NULL,
  `Tingkat_Kelas` varchar(225) NOT NULL,
  `Tipe_Kelas` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`Id_Kelas`, `Nama_Kelas`, `Tingkat_Kelas`, `Tipe_Kelas`) VALUES
(42, 'X Mipa 1', 'X', 'Mipa'),
(43, 'X Mipa 2', 'X', 'Mipa'),
(44, 'X MIPA 3', 'X', 'Mipa'),
(46, 'X MIPA 4', 'X', 'Mipa'),
(47, 'X MIPA 5', 'X', 'Mipa'),
(48, 'X MIPA 6', 'X', 'Mipa'),
(49, 'X IPS 1', 'X', 'Ips'),
(50, 'X IPS 2', 'X', 'IPS'),
(51, 'XI MIPA 1', 'XI', 'Mipa'),
(52, 'XI MIPA 2', 'XI', 'Mipa'),
(53, 'XI MIPA 3', 'XI', 'Mipa'),
(54, 'XI MIPA 4', 'XI', 'Mipa'),
(55, 'XI MIPA 5', 'XI', 'Mipa'),
(56, 'XI MIPA 5', 'XI', 'Mipa'),
(57, 'XI MIPA 6', 'XI', 'Mipa'),
(58, 'XI MIPA 7', 'XI', 'Mipa'),
(59, 'XI IPS 1', 'XI', 'Ips'),
(60, 'XI IPS 2', 'XI', 'Ips'),
(61, 'XII MIPA 1', 'XII', 'Mipa'),
(62, 'XII MIPA 2', 'XII', 'Mipa'),
(63, 'XII MIPA 3', 'XII', 'Mipa'),
(64, 'XII MIPA 4', 'XII', 'Mipa'),
(65, 'XII MIPA 5', 'XII', 'Mipa'),
(66, 'XII MIPA 6', 'XII', 'Mipa'),
(67, 'XII IPS 1', 'XII', 'Ips'),
(68, 'XII IPS 2', 'XII', 'Ips');

-- --------------------------------------------------------

--
-- Table structure for table `kumpul_tugas`
--

CREATE TABLE `kumpul_tugas` (
  `id_kumpul` int(11) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Nis` varchar(255) NOT NULL,
  `Waktu` datetime NOT NULL DEFAULT current_timestamp(),
  `Lampiran` varchar(225) NOT NULL,
  `Id_Tugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kumpul_tugas`
--

INSERT INTO `kumpul_tugas` (`id_kumpul`, `Nama`, `Nis`, `Waktu`, `Lampiran`, `Id_Tugas`) VALUES
(129, 'Abdillah', '2021005179', '2022-04-20 13:30:20', 'D121191079_T1.docx', 42),
(142, 'Abdillah', '2021005179', '2022-04-20 22:10:56', 'D121191079_T1.docx', 56);

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard`
--

CREATE TABLE `leaderboard` (
  `id_leader` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `nis` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leaderboard`
--

INSERT INTO `leaderboard` (`id_leader`, `nama`, `nis`, `total`) VALUES
(1, 'Abdillah', 2021005179, 150);

-- --------------------------------------------------------

--
-- Table structure for table `matapelajaran`
--

CREATE TABLE `matapelajaran` (
  `Id_Mapel` int(11) NOT NULL,
  `Nama_Mapel` varchar(225) NOT NULL,
  `Nama_Guru` varchar(225) NOT NULL,
  `Jlh_Siswa` int(11) NOT NULL,
  `Hari` varchar(225) NOT NULL,
  `Waktu` varchar(225) NOT NULL,
  `Semester` varchar(225) NOT NULL,
  `Sampul` varchar(225) NOT NULL,
  `Tipe_Kelas` varchar(225) NOT NULL,
  `Deskripsi` varchar(225) NOT NULL,
  `Id_Kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matapelajaran`
--

INSERT INTO `matapelajaran` (`Id_Mapel`, `Nama_Mapel`, `Nama_Guru`, `Jlh_Siswa`, `Hari`, `Waktu`, `Semester`, `Sampul`, `Tipe_Kelas`, `Deskripsi`, `Id_Kelas`) VALUES
(8357, 'Matematika Wajib X Mipa 6', 'Manda, S.Pd', 0, 'Selasa', '10:00', 'Ganjil', 'cover6.webp', 'X', '', 50),
(9623, 'Kimia X Mipa 6', 'Hairiana, ST', 0, 'Jumat', '23:59', 'Ganjil', 'cover1.webp', 'X', '', 40),
(9953, 'Bahasa Indonesia XI Mipa 2', 'Manda, S.Pd', 0, 'Kamis', '10:30', 'Genap', 'cover5.jpg', 'XI', '', 44),
(9956, 'Biologi XI Mipa 6', 'Dra. Aisyah. S', 0, 'Jumat', '10:00', 'Ganjil', 'cover2.jpg', 'XI', '', 42);

-- --------------------------------------------------------

--
-- Table structure for table `materi_alur`
--

CREATE TABLE `materi_alur` (
  `Id_Materi` int(11) NOT NULL,
  `Id_Alur` int(11) NOT NULL,
  `Nama` varchar(225) NOT NULL,
  `Deskripsi` text NOT NULL,
  `Lampiran` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materi_alur`
--

INSERT INTO `materi_alur` (`Id_Materi`, `Id_Alur`, `Nama`, `Deskripsi`, `Lampiran`) VALUES
(1, 3, 'Materi 1', 'Baca Materi berikut', 'D121191079_AndiRusmiati_T5.pdf'),
(2, 3, 'Materi 2', 'Baca Lagi Materinya', 'Materi Manajemen Basis Data.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `mengerjakan`
--

CREATE TABLE `mengerjakan` (
  `Id_Anggota` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `durasi` varchar(225) NOT NULL,
  `skor` int(11) NOT NULL,
  `xp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mengumpulkan`
--

CREATE TABLE `mengumpulkan` (
  `Id_Anggota` int(11) NOT NULL,
  `Id_Tugas` int(11) NOT NULL,
  `xp` int(11) NOT NULL,
  `skor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `Id_Pengumuman` int(11) NOT NULL,
  `Id_Mapel` int(11) NOT NULL,
  `Judul` varchar(225) NOT NULL,
  `Deskripsi` text NOT NULL,
  `Waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`Id_Pengumuman`, `Id_Mapel`, `Judul`, `Deskripsi`, `Waktu`) VALUES
(2, 50, 'Info Perubahan Jadwal', 'Karena jadwal mata pelajaran ini bertabrakan dengan kelas lain, maka kita harus melakukan diskusi terkait perubahan jadwal kedepannya', '2022-04-28 22:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `poin`
--

CREATE TABLE `poin` (
  `id_poin` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `nis` int(11) NOT NULL,
  `skor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poin`
--

INSERT INTO `poin` (`id_poin`, `nama`, `nis`, `skor`) VALUES
(41, 'Abdillah', 2021005179, 50),
(42, 'Abdillah', 2021005179, 50),
(48, 'Abdillah', 2021005179, 50);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `Id_Semester` int(11) NOT NULL,
  `Semester` varchar(225) NOT NULL,
  `Id_Kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`Id_Semester`, `Semester`, `Id_Kelas`) VALUES
(13, 'Genap', 9228),
(14, 'Ganjil', 2260),
(16, 'Ganjil', 4180),
(19, 'Genap', 482),
(20, 'Genap', 8536),
(21, 'Genap', 2365),
(22, 'Ganjil', 6573),
(23, 'Ganjil', 40),
(24, 'Ganjil', 2739),
(25, 'Ganjil', 9289),
(26, 'Ganjil', 6975),
(27, 'Ganjil', 8646),
(28, 'Ganjil', 666),
(29, 'Ganjil', 985),
(30, 'Ganjil', 274),
(31, 'Ganjil', 292),
(32, 'Ganjil', 50),
(33, 'Ganjil', 40),
(34, 'Ganjil', 6128),
(35, 'Ganjil', 50),
(36, 'Ganjil', 50),
(37, 'Genap', 44),
(38, 'Ganjil', 42),
(39, 'Ganjil', 42),
(40, 'Ganjil', 42);

-- --------------------------------------------------------

--
-- Table structure for table `siswa_terdaftar`
--

CREATE TABLE `siswa_terdaftar` (
  `Id_Anggota` int(11) NOT NULL,
  `Nama` varchar(225) NOT NULL,
  `Nis` varchar(225) NOT NULL,
  `Id_Kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa_terdaftar`
--

INSERT INTO `siswa_terdaftar` (`Id_Anggota`, `Nama`, `Nis`, `Id_Kelas`) VALUES
(74, 'Abdillah', '2021005179', 50),
(75, 'Abdillah', '2021005179', 40),
(78, 'Abdillah', '2021005179', 42);

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id_slide` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id_slide`, `judul`, `deskripsi`, `image`) VALUES
(1, 'Selamat Datang di ELEARNING SMANEL', 'Selamat Datang di ELEARNING SMANEL', 'home_1.jpeg'),
(2, 'Perkembangan Smanel', 'Lorem Ipsum', 'home_2.jpeg'),
(3, 'Selamat Datang di Elearning Smanell', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'home_3.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `soal_essay`
--

CREATE TABLE `soal_essay` (
  `id_soal` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `soal` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soal_essay`
--

INSERT INTO `soal_essay` (`id_soal`, `id_ujian`, `soal`) VALUES
(2, 2, 'kerjakan');

-- --------------------------------------------------------

--
-- Table structure for table `soal_pg`
--

CREATE TABLE `soal_pg` (
  `id_soal` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `soal` varchar(225) NOT NULL,
  `opsi1` varchar(225) NOT NULL,
  `opsi2` varchar(225) NOT NULL,
  `opsi3` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soal_pg`
--

INSERT INTO `soal_pg` (`id_soal`, `id_ujian`, `soal`, `opsi1`, `opsi2`, `opsi3`) VALUES
(11, 2, 'perhatikan gambar berikut', 'yah', 'baik', 'oke'),
(12, 2, 'soal lagi', 'yahs', 'yes', 'yoi'),
(14, 2, '<p>Perhatikan gambar berikut!</p>\r\n\r\n<p><img alt=\"\" src=\"ckeditor/uploads/apartmentkiev_olgafradina_00010-810x527.jpg\" style=\"height:72px; width:110px\" /></p>\r\n\r\n<p>Gambar diatas adalah...</p>\r\n', 'rumah', 'kantor', 'kamar');

-- --------------------------------------------------------

--
-- Table structure for table `tambah_kelas`
--

CREATE TABLE `tambah_kelas` (
  `Id_TambahKls` int(11) NOT NULL,
  `Kelas` varchar(225) NOT NULL,
  `Nama_Kelas` varchar(255) NOT NULL,
  `Hari` varchar(225) NOT NULL,
  `Waktu` varchar(225) NOT NULL,
  `Semester` varchar(255) NOT NULL,
  `Deskripsi` text NOT NULL,
  `Kajian` varchar(255) NOT NULL,
  `Capaian` varchar(225) NOT NULL,
  `Bahan_Ajar` varchar(225) NOT NULL,
  `Sampul` varchar(225) NOT NULL,
  `tanggal_buat` date DEFAULT current_timestamp(),
  `Nama_Guru` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tambah_kelas`
--

INSERT INTO `tambah_kelas` (`Id_TambahKls`, `Kelas`, `Nama_Kelas`, `Hari`, `Waktu`, `Semester`, `Deskripsi`, `Kajian`, `Capaian`, `Bahan_Ajar`, `Sampul`, `tanggal_buat`, `Nama_Guru`) VALUES
(40, 'X', 'Kimia X Mipa 6', 'Jumat', '11:00', 'Ganjil', '', '', '', '', 'cover1.webp', '2022-04-25', 'Hairiana, ST'),
(42, 'XI', 'Biologi XI Mipa 6', 'Jumat', '10:00', 'Ganjil', '', '', '', '', 'cover2.jpg', '2022-04-25', 'Dra. Aisyah. S'),
(43, 'XI', 'Fisika XI Mipa 1', 'Selasa', '09:30', 'Genap', '', '', '', '', 'cover3.jpg', '2022-04-25', 'Manda, S.Pd'),
(44, 'XI', 'Bahasa Indonesia XI Mipa 2', 'Kamis', '10:30', 'Genap', '', '', '', '', 'cover5.jpg', '2022-04-25', 'Manda, S.Pd'),
(49, 'X', 'Sejarah X Mipa 1', 'Kamis', '11:00', 'Ganjil', '', '', '', '', 'cover4.jpg', '2022-04-25', 'Manda, S.Pd'),
(50, 'X', 'Matematika Wajib X Mipa 6', 'Selasa', '10:00', 'Ganjil', '', '', '', '', 'cover6.webp', '2022-04-25', 'Manda, S.Pd');

-- --------------------------------------------------------

--
-- Table structure for table `tautan`
--

CREATE TABLE `tautan` (
  `Id_Tautan` int(11) NOT NULL,
  `Id_Mapel` int(11) NOT NULL,
  `Judul` varchar(225) NOT NULL,
  `Link` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tautan`
--

INSERT INTO `tautan` (`Id_Tautan`, `Id_Mapel`, `Judul`, `Link`) VALUES
(2, 50, 'Tes Again', 'https://www.youtube.com/watch?v=hhp2QifxxR0');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `Id_Tugas` int(11) NOT NULL,
  `judul_tugas` varchar(225) NOT NULL,
  `dl_tugas` date NOT NULL,
  `jam_dl` time NOT NULL,
  `skor` int(11) NOT NULL,
  `deskripsi_tugas` text NOT NULL,
  `lampiran` varchar(225) NOT NULL,
  `Id_Mapel` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`Id_Tugas`, `judul_tugas`, `dl_tugas`, `jam_dl`, `skor`, `deskripsi_tugas`, `lampiran`, `Id_Mapel`) VALUES
(42, 'tugas 1', '2022-04-21', '10:00:00', 0, 'Lanjutkan tugas 1 sesuai dengan instruksi yang telah dijelaskan dipertemuan tadi', '', '50'),
(56, 'tugas 2', '2022-04-22', '10:00:00', 100, 'kerjakan soal berikut', 'netflix_cleaning.csv', '50');

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL,
  `Id_Mapel` int(11) NOT NULL,
  `judul_ujian` varchar(225) NOT NULL,
  `Waktu_Aktif` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Waktu_Berakhir` datetime NOT NULL,
  `durasi` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `Id_Mapel`, `judul_ujian`, `Waktu_Aktif`, `Waktu_Berakhir`, `durasi`) VALUES
(2, 50, 'Tes lagi', '2022-05-19 17:32:11', '2022-05-19 23:21:00', '3600');

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE `user_admin` (
  `Id` int(11) NOT NULL,
  `Nama` varchar(225) NOT NULL,
  `Nip` varchar(225) NOT NULL,
  `Tempat` varchar(225) NOT NULL,
  `Tanggal` date NOT NULL,
  `Email` varchar(225) NOT NULL,
  `Alamat` varchar(225) NOT NULL,
  `Posisi` varchar(225) NOT NULL,
  `Username` varchar(225) NOT NULL,
  `Password` varchar(225) NOT NULL,
  `Profil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_admin`
--

INSERT INTO `user_admin` (`Id`, `Nama`, `Nip`, `Tempat`, `Tanggal`, `Email`, `Alamat`, `Posisi`, `Username`, `Password`, `Profil`) VALUES
(1, 'Admin', '', 'Luwu', '1967-10-10', '', '', 'Operator', 'adminsmanel', 'admin123', 'profil.png');

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
(5, 'Drs. Amir Tanggu', '196604212005021001', 'Luwu', '1966-04-21', '', '', 'Guru Mapel', 'drsamirtanggu', '21041966', 'profil.png'),
(6, 'Djumariah, S.Pd', '196808241998022004', 'Magelang', '1968-08-24', '', '', 'Guru Mapel', 'djumariah', '24081968', 'profil.png'),
(7, 'Hairiana, ST', '196807272006042013', 'Luwu', '1968-07-27', '', '', 'Guru Mapel', 'hairiana', '27071968', 'profil.png'),
(8, 'Manda, S.Pd', '197102151998032012', 'Kolaka Utara', '1971-02-15', '', '', 'Guru Mapel', 'manda', '15021971', 'profil.png'),
(9, 'Nasrum, S. Pd', '197106201998021002', 'Luwu', '1971-06-20', '', '', 'Guru Mapel', 'nasrumspd', '20061971', 'profil.png'),
(10, 'Lisda Andulan Patandung, S. Pd', '197308192003122009', 'Luwu', '1973-08-19', '', '', 'Guru Mapel', 'lisdaandulanp', '19081973', 'profil.png'),
(11, 'Indrawati, S. Pd', '197406292005022001', 'Luwu', '1974-06-29', '', '', 'Guru Mapel', 'indrawatispd', '29061974', 'profil.png'),
(12, 'Akrar, S. Pd', '197701072006041013', 'Luwu', '1977-01-07', '', '', 'Guru Mapel', 'akrarspd', '07011977', 'profil.png'),
(13, 'Aris, S.E.', '196903132009031002', 'Pinrang', '1969-03-13', '', '', 'Guru Mapel', 'arisse', '13031969', 'profil.png'),
(14, 'Sitti Khadijah Siampe, S.Ag', '196905082003122005', 'Luwu', '1977-01-07', '', '', 'Guru Mapel', 'akrarspd', '07011977', 'profil.png'),
(16, 'Hidarman, S.Ag.', '197103122007011029', 'Luwu', '1971-03-12', '', '', 'Guru Mapel', 'hidarmansag', '12031971', 'profil.png'),
(17, 'Ruslinah, S.Sos.', '197412122005022002', 'Jakarta', '1974-12-12', '', '', 'Guru Mapel', 'ruslinahssos', '12121974', 'profil.png'),
(18, 'Arsam Syamsuddin, S.Pd.', '197512092003121004', 'Luwu', '1975-12-09', '', '', 'Guru Mapel', 'arsamsyamsuddinspd', '09121975', 'profil.png'),
(19, 'Nurwati, SE', '197602242006042023', 'Luwu', '1976-02-24', '', '', 'Guru Mapel', 'nurwatise', '24021976', 'profil.png'),
(20, 'Ir. Jufri', '197604292008011008', 'Luwu', '1976-04-29', '', '', 'Kepala Sekolah', 'irjufri', '29041976', 'profil.png'),
(21, 'Asmawati, S.Pd.', '197803052008012012', 'Luwu', '1978-03-05', '', '', 'Guru Mapel', 'asmawatispd', '05031978', 'profil.png'),
(22, 'Besse Aras, SE', '197806132008012010', 'Luwu', '1978-06-13', '', '', 'Guru Mapel', 'bessearasse', '13061978', 'profil.png'),
(23, 'Muhammad Saleh, S.Pd.', '197902022008011015', 'Bulukumba', '1979-02-02', '', '', 'Guru Mapel', 'muhammadsalehspd', '02021979', 'profil.png'),
(24, 'Fitria, S.Pd.', '198207222009032004', 'Luwu', '1982-07-22', '', '', 'Guru Mapel', 'fitriaspd', '22071982', 'profil.png'),
(25, 'Aisyah Pata\'Dungan, S.Pd.', '198512162010012041', 'Dili/Timor Leste', '1985-12-16', '', '', 'Guru Mapel', 'aisyahpatadunganspd', '16121985', 'profil.png'),
(26, 'Rismayanti, S.Pd.', '198712242011012010', 'Luwu', '1987-12-24', '', '', 'Guru Mapel', 'rismayantispd', '24121987', 'profil.png'),
(27, 'Syarifuddin, S.Pd.', '198009092014101002', 'Luwu', '1980-09-09', '', '', 'Guru Mapel', 'syarifuddinspd', '09091980', 'profil.png'),
(28, 'Jumriah Hadiseng, S.Pd.', '198107012014102002', 'Luwu', '1981-07-01', '', '', 'Guru Mapel', 'jumriahhadisengspd', '01071981', 'profil.png'),
(29, 'Emmil, S.Pd.', '198205072014101003', 'Luwu', '1982-05-07', '', '', 'Guru Mapel', 'emmilspd', '07051982', 'profil.png'),
(30, 'Irmatiana Musir, S.Pd.I', '199006172019032019', 'Luwu', '1990-06-17', '', '', 'Guru Mapel', 'irmatianamusirspdi', '17061990', 'profil.png'),
(31, 'Abidah, A.Ma.Pd.', '197704072014102001', 'Luwu', '1977-08-07', '', '', 'Operator Komputer', 'abidahamapd', '07041977', 'profil.png'),
(32, 'Ridwan Santo, S.Pd', '', 'Bonelemo', '1982-08-03', '', '', '', 'ridwansantospd', '03081982', 'profil.png'),
(33, 'Langsi Yustiana, S.Pd', '', 'Langkidi', '1987-11-27', '', '', '', 'langsiyustianaspd', '27111987', 'profil.png'),
(34, 'Hasrianto, S.Pd', '', 'Jambu', '1987-11-30', '', '', '', 'hasriantospd', '30111987', 'profil.png'),
(35, 'Wilfiani, S.Pd', '', 'Sarurang', '1988-11-18', '', '', '', 'wilfianispd', '18111988', 'profil.png'),
(36, 'Hasniah Mahmud, S.Pd', '', 'Bajo', '1984-03-03', '', '', '', 'hasniahmahmudspd', '03031984', 'profil.png'),
(37, 'Akmal. A, S.Pd', '', 'Tabbaja', '1989-06-06', '', '', '', 'akmalaspd', '06061989', 'profil.png'),
(38, 'Islamuddin, S.Pd', '', 'Rumaju', '1988-08-31', '', '', '', 'islamuddinspd', '31081988', 'profil.png'),
(39, 'Linda Lasodding, S.Pd', '', 'Bua', '1990-04-20', '', '', '', 'lindalasoddingspd', '20041990', 'profil.png'),
(40, 'Aswar, S.Pd', '', 'Sampeang', '1992-01-14', '', '', '', 'aswarspd', '14011992', 'profil.png'),
(41, 'Suci Utami, S.Si', '', 'Bajo', '1990-02-02', '', '', '', 'suciutamissi', '02021990', 'profil.png'),
(42, 'Susanna, S.Pd', '', 'Balabatu', '1993-05-20', '', '', '', 'susannaspd', '20051993', 'profil.png'),
(43, 'Junedi, S.Or', '', 'Sumabu', '1989-10-08', '', '', '', 'junedisor', '08101989', 'profil.png'),
(44, 'Nirwana, S.Pd', '', 'Bontang', '1991-11-13', '', '', '', 'nirwanaspd', '13111991', 'profil.png'),
(45, 'Nurlina, S.Pd', '', 'Parigusi', '1994-09-11', '', '', '', 'nurlinaspd', '11091994', 'profil.png'),
(46, 'Ferawati, S.Pd', '', 'Rumaju', '1993-07-03', '', '', '', 'ferawatispd', '03071993', 'profil.png'),
(47, 'Muhammad Risaldi, S.Pd', '', 'Sampeang', '1992-04-20', '', '', '', 'muhammadrisaldispd', '20041992', 'profil.png'),
(48, 'Novha Prayoghi Hs, S.Pd', '', 'Belopa', '1994-03-08', '', '', '', 'novhaprayoghihsspd', '08031994', 'profil.png'),
(49, 'Hussein, S.Pd.', '', 'Bajo', '1991-01-04', '', '', '', 'husseinspd', '04011991', 'profil.png'),
(50, 'Mutmainnah, S.Pd.', '', 'Jambu', '1994-04-04', '', '', '', 'mutmainnahspd', '04041994', 'profil.png'),
(51, 'Jusniar Fudil, S.Pd.', '', 'Saparua', '1995-06-23', '', '', '', 'jusniarfudilspd', '23061995', 'profil.png'),
(52, 'Nurma Dania', '', 'Ulusalu', '1996-01-14', '', '', '', 'nurmadania', '14011996', 'profil.png'),
(53, 'Besse Jaya', '', 'Rumaju', '1995-01-15', '', '', '', 'bessejaya', '15011995', 'profil.png'),
(54, 'Hamriani', '', 'Pintoe', '1993-01-01', '', '', '', 'hamriani', '01011993', 'profil.png'),
(55, 'Siti Rahmawati', '', 'Jakarta', '1996-02-08', '', '', '', 'sitirahmawati', '08021996', 'profil.png'),
(56, 'Sidrah B.M', '', 'Tumbubara', '1995-11-26', '', '', '', 'sidrahbm', '26111995', 'profil.png'),
(57, 'Muh. Yusri Yusuf, S.Pd.', '', 'Jambu', '1995-05-27', '', '', '', 'muhyusriyusufspd', '27051995', 'profil.png'),
(58, 'Aminah Ahmad, S.Pd.', '', 'Padan Gsappa', '1993-07-20', '', '', '', 'aminahahmadspd', '20071993', 'profil.png'),
(59, 'Hafid', '', 'Jambu', '1968-10-01', '', '', '', 'hafid', '01101968', 'profil.png'),
(60, 'Sahidah,A.Ma.Pd', '', 'Jambu', '1979-02-13', '', '', '', 'sahidahamapd', '13021979', 'profil.png'),
(61, 'Asmiati', '', 'Bastem', '1974-11-02', '', '', '', 'asmiati', '02111974', 'profil.png'),
(62, 'Ratnadewi, S.E.', '', 'Kampungbaru', '1979-04-21', '', '', '', 'ratnadewise', '21041979', 'profil.png'),
(63, 'Sunarti', '', 'Jambu', '1980-10-29', '', '', '', 'sunarti', '29101980', 'profil.png'),
(64, 'Hakim', '', 'Balambang', '1965-12-31', '', '', '', 'hakim', '31121965', 'profil.png'),
(65, 'Akhida Idham, S.Pd.', '', 'Rumaju', '1988-10-25', '', '', '', 'akhidaidhamspd', '25101994', 'profil.png'),
(66, 'Rahmayanti, A, Ma.Pust.', '', 'Bajo', '1988-08-14', '', '', '', 'rahmayantiamapust', '14081988', 'profil.png');

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
  `Profil` varchar(225) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_siswa`
--

INSERT INTO `user_siswa` (`Id`, `Nama`, `Nis`, `Kelas`, `Tempat`, `Tanggal`, `Email`, `Alamat`, `Username`, `Password`, `Profil`, `last_login`) VALUES
(1, 'Abdillah', '2021005179', 'X Mipa 6', 'Tolajuk', '2006-04-20', '', 'Kampung Tangga', 'abdillah', '20062004', 'baymax.jpg', '2022-05-18 15:01:55'),
(10, 'Ade Setiawan K.', '2021005180', 'X MIPA 6', 'Langkidi', '2006-06-01', '', 'Pendidikan', 'adesetiawank', '20060601', 'profil.png', '2022-05-17 05:30:26'),
(11, 'Ade Setiawan Saguni', '2021005181', 'X MIPA 6', 'Boneposi', '2006-05-04', '', 'Rante Limbong', 'adesetiawans', '20060504', 'profil.png', '2022-05-17 05:46:09'),
(12, 'Aidil', '2021005182', 'X MIPA 6', 'Tibussan', '2006-04-14', '', 'Tibussan', 'aidil', '20060414', 'profil.png', '2022-05-17 05:46:28'),
(13, 'Anes', '2021005183', 'X MIPA 6', 'Saringan', '2005-11-23', '', 'Ulusalu', 'anes', '20051123', 'profil.png', '2022-05-18 06:49:57'),
(14, 'Annisa.S', '2021005184', 'X MIPA 6', 'Langkidi', '2006-08-31', '', 'Langkidi', 'annisas', '20060831', 'profil.png', '2022-05-18 06:49:57'),
(15, 'Ariel Syamsir', '2021005185', 'X MIPA 6', 'Sampeang', '2006-02-27', '', 'Bakabalik', 'arielsyamsir', '20060227', 'profil.png', '2022-05-18 15:02:29'),
(16, 'Asia Asri', '2021005186', 'X MIPA 6', 'Sarurang', '2006-02-01', '', 'Sarurang', 'asiaasri', '20060201', 'profil.png', '2022-05-18 06:49:57'),
(17, 'Chairul Anwar', '2021005187', 'X MIPA 6', 'Kadong-Kadong', '2006-07-04', '', 'Dadeko', 'chairulanwar', '20060704', 'profil.png', '2022-05-18 06:49:57'),
(18, 'Dina Humairah Zamruddin', '2021005188', 'X MIPA 6', 'Tettekang', '2005-08-05', '', 'Rambuanga', 'dinahumairazamruddin', '20050805', 'profil.png', '2022-05-18 06:49:57'),
(19, 'Elsa', '2021005293', 'X MIPA 6', 'Sumabu', '2006-10-17', '', 'Sumabu', 'elsa', '20061017', 'profil.png', '2022-05-18 06:49:57'),
(20, 'Fauzan Alreihan', '2021005189', 'X MIPA 6', 'Belopa', '2006-05-30', '', 'Jl. Amir Gattang', 'fauzanalreihan', '20060530', 'profil.png', '2022-05-18 06:49:57'),
(21, 'Gading Ramadhan', '2021005190', 'X MIPA 6', 'Belopa', '2005-11-02', '', 'Pandoso', 'gadingramadhan', '20051102', 'profil.png', '2022-05-18 06:49:57'),
(22, 'Haeril', '20210051891', 'X MIPA 6', 'Paragusi', '2007-07-24', '', 'Tondok Tangga', 'haeril', '20070724', 'profil.png', '2022-05-18 06:49:57'),
(23, 'Intan Qarunia Yusuf', '2021005192', 'X MIPA 6', 'Cilallang', '2006-04-23', '', 'Dsn. Tabbaja', 'intanqaruniayusuf', '20060423', 'profil.png', '2022-05-18 06:49:57'),
(24, 'Intan Stevany Nur Ikhsan', '2021005193', 'X MIPA 6', 'Kaili', '2007-07-07', '', 'Langkidi', 'intanstevanynurikhsan', '20070707', 'profil.png', '2022-05-18 06:49:57'),
(25, 'Irfadilla Ramadhani', '2021005194', 'X MIPA 6', 'Balabatu', '2006-10-02', '', 'Balabatu', 'irfadillaramadhani', '20061002', 'profil.png', '2022-05-18 06:49:57'),
(26, 'Juwita', '2021005195', 'X MIPA 6', 'Padang Lobo', '2007-02-14', '', 'Dusun Padang Lobo', 'juwita', '20070214', 'profil.png', '2022-05-18 06:49:57'),
(27, 'Kurniawan', '2021005196', 'X MIPA 6', 'Pandoso', '2006-05-25', '', '(Tidak Diisi)', 'kurniawan', '20060525', 'profil.png', '2022-05-18 06:49:57'),
(28, 'Lisdiayanti', '2021005197', 'X MIPA 6', 'Boneposi', '2006-10-03', '', 'Kumpang', 'lisdiayanti', '20061003', 'profil.png', '2022-05-18 06:49:57'),
(29, 'Miftahul Airah', '2021005198', 'X MIPA 6', 'Buntu Karua', '2006-07-20', '', 'Ponglemba', 'miftahulairah', '20060720', 'profil.png', '2022-05-18 06:49:57'),
(30, 'Muh. Ferdiansyah', '2021005199', 'X MIPA 6', 'Salubone', '2005-12-03', '', 'Lingk. Pasar Baru', 'muhferdiansyah', '20051203', 'profil.png', '2022-05-18 06:49:57'),
(31, 'Muh. Rojas Jazhali Syahputra', '2021005200', 'X MIPA 6', 'Makassar', '2006-09-17', '', 'Buntu Barana', 'muhrojasjazhalisyahputra', '20060917', 'profil.png', '2022-05-18 06:49:57'),
(32, 'Muhammad Albani Putra Sularno', '2021005201', 'X MIPA 6', 'Karanganyar', '2006-04-26', '', 'Jl. Pendidikan', 'muhammadalbaniputrasularno', '20060426', 'profil.png', '2022-05-18 06:49:57'),
(33, 'Muhammad Ayyul', '2021005202', 'X MIPA 6', 'Parigusi', '2005-05-17', '', 'Parigusi', 'muhammadayyul', '20050517', 'profil.png', '2022-05-18 06:49:57'),
(34, 'Muhammad Farhan', '2021005203', 'X MIPA 6', 'Bajo', '2006-03-31', '', 'Bajo', 'muhammadfarhan', '20060331', 'profil.png', '2022-05-18 06:49:57'),
(35, 'Mursalim Tahrim', '2021005301', 'X MIPA 6', 'Balabatu', '2006-03-14', '', 'Balabatu', 'mursalimtahrim', '20060314', 'profil.png', '2022-05-18 06:49:57'),
(36, 'Nensi Lestari', '2021005204', 'X MIPA 6', 'Bala Batu', '2005-02-28', '', 'Tolapi', 'nensilestari', '20050228', 'profil.png', '2022-05-18 06:55:58'),
(37, 'Nurhadijah Saleh', '2021005205', 'X MIPA 6', 'Boneposi', '2005-04-10', '', 'Kumpang', 'nurhadijahsaleh', '2005-04-10', 'profil.png', '2022-05-18 06:49:57'),
(38, 'Nurlinda', '2021005206', 'X MIPA 6', 'Sumabu', '2006-11-29', '', 'Sumabu', 'nurlinda', '20061129', 'profil.png', '2022-05-18 06:49:57'),
(39, 'Olis Utari', '2021005207', 'X MIPA 6', 'Bajo', '2006-07-09', '', 'Ulusalu', 'olisutari', '20060709', 'profil.png', '2022-05-18 06:49:57'),
(40, 'Rini Pratiwi', '2021005208', 'X MIPA 6', 'Waituo', '2006-09-02', '', 'Lalang Koli', 'rinipratiwi', '20060902', 'profil.png', '2022-05-18 06:49:57'),
(41, 'Sabil', '2021005209', 'X MIPA 6', 'Pandoso', '2005-10-14', '', 'Pandoso', 'sabil', '20051014', 'profil.png', '2022-05-18 06:49:57'),
(42, 'Salwa', '2021005210', 'X MIPA 6', 'Balla', '2006-05-24', '', 'DSN Tirowali', 'salwa', '20060504', 'profil.png', '2022-05-18 06:49:57'),
(43, 'Santri', '2021005211', 'X MIPA 6', 'Balabatu', '2006-07-16', '', 'Mappolo', 'santri', '20060716', 'profil.png', '2022-05-18 06:49:57'),
(44, 'Sindy Syahraini', '2021005212', 'X MIPA 6', 'Battang', '2006-05-12', '', 'Battang', 'sindysyahraini', '20060512', 'profil.png', '2022-05-18 06:49:57'),
(45, 'Suwandi', '2021005213', 'X MIPA 6', 'Jambu', '2005-12-10', '', 'Jambu', 'suwandi', '20051210', 'profil.png', '2022-05-18 06:49:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alur`
--
ALTER TABLE `alur`
  ADD PRIMARY KEY (`Id_Alur`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id_announ`);

--
-- Indexes for table `detail_mapel`
--
ALTER TABLE `detail_mapel`
  ADD PRIMARY KEY (`Id_Mapel`);

--
-- Indexes for table `docs`
--
ALTER TABLE `docs`
  ADD PRIMARY KEY (`Id_Docs`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`Id_Forum`);

--
-- Indexes for table `forum_cat`
--
ALTER TABLE `forum_cat`
  ADD PRIMARY KEY (`Id_ForumCat`);

--
-- Indexes for table `forum_reply`
--
ALTER TABLE `forum_reply`
  ADD PRIMARY KEY (`Id_Reply`);

--
-- Indexes for table `forum_thread`
--
ALTER TABLE `forum_thread`
  ADD PRIMARY KEY (`Id_ForumThr`);

--
-- Indexes for table `guru_terdaftar`
--
ALTER TABLE `guru_terdaftar`
  ADD PRIMARY KEY (`Id_Anggota`);

--
-- Indexes for table `jawaban_ujian`
--
ALTER TABLE `jawaban_ujian`
  ADD PRIMARY KEY (`id_jawab`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`Id_Kelas`),
  ADD KEY `Id_Kelas` (`Id_Kelas`);

--
-- Indexes for table `kumpul_tugas`
--
ALTER TABLE `kumpul_tugas`
  ADD PRIMARY KEY (`id_kumpul`);

--
-- Indexes for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD PRIMARY KEY (`id_leader`);

--
-- Indexes for table `matapelajaran`
--
ALTER TABLE `matapelajaran`
  ADD PRIMARY KEY (`Id_Mapel`),
  ADD KEY `Id_Kelas` (`Id_Kelas`,`Semester`),
  ADD KEY `Semester` (`Semester`);

--
-- Indexes for table `materi_alur`
--
ALTER TABLE `materi_alur`
  ADD PRIMARY KEY (`Id_Materi`);

--
-- Indexes for table `mengerjakan`
--
ALTER TABLE `mengerjakan`
  ADD PRIMARY KEY (`Id_Anggota`);

--
-- Indexes for table `mengumpulkan`
--
ALTER TABLE `mengumpulkan`
  ADD PRIMARY KEY (`Id_Anggota`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`Id_Pengumuman`);

--
-- Indexes for table `poin`
--
ALTER TABLE `poin`
  ADD PRIMARY KEY (`id_poin`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`Id_Semester`);

--
-- Indexes for table `siswa_terdaftar`
--
ALTER TABLE `siswa_terdaftar`
  ADD PRIMARY KEY (`Id_Anggota`),
  ADD KEY `Id_Mapel` (`Id_Kelas`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id_slide`);

--
-- Indexes for table `soal_essay`
--
ALTER TABLE `soal_essay`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `soal_pg`
--
ALTER TABLE `soal_pg`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `tambah_kelas`
--
ALTER TABLE `tambah_kelas`
  ADD PRIMARY KEY (`Id_TambahKls`),
  ADD KEY `Semester` (`Semester`);

--
-- Indexes for table `tautan`
--
ALTER TABLE `tautan`
  ADD PRIMARY KEY (`Id_Tautan`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`Id_Tugas`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`);

--
-- Indexes for table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user_guru`
--
ALTER TABLE `user_guru`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user_siswa`
--
ALTER TABLE `user_siswa`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alur`
--
ALTER TABLE `alur`
  MODIFY `Id_Alur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id_announ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_mapel`
--
ALTER TABLE `detail_mapel`
  MODIFY `Id_Mapel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `docs`
--
ALTER TABLE `docs`
  MODIFY `Id_Docs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `Id_Forum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `forum_cat`
--
ALTER TABLE `forum_cat`
  MODIFY `Id_ForumCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `forum_reply`
--
ALTER TABLE `forum_reply`
  MODIFY `Id_Reply` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `forum_thread`
--
ALTER TABLE `forum_thread`
  MODIFY `Id_ForumThr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `guru_terdaftar`
--
ALTER TABLE `guru_terdaftar`
  MODIFY `Id_Anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jawaban_ujian`
--
ALTER TABLE `jawaban_ujian`
  MODIFY `id_jawab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `Id_Kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `kumpul_tugas`
--
ALTER TABLE `kumpul_tugas`
  MODIFY `id_kumpul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `leaderboard`
--
ALTER TABLE `leaderboard`
  MODIFY `id_leader` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `matapelajaran`
--
ALTER TABLE `matapelajaran`
  MODIFY `Id_Mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9957;

--
-- AUTO_INCREMENT for table `materi_alur`
--
ALTER TABLE `materi_alur`
  MODIFY `Id_Materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mengerjakan`
--
ALTER TABLE `mengerjakan`
  MODIFY `Id_Anggota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mengumpulkan`
--
ALTER TABLE `mengumpulkan`
  MODIFY `Id_Anggota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `Id_Pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `poin`
--
ALTER TABLE `poin`
  MODIFY `id_poin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `Id_Semester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `siswa_terdaftar`
--
ALTER TABLE `siswa_terdaftar`
  MODIFY `Id_Anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id_slide` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `soal_essay`
--
ALTER TABLE `soal_essay`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `soal_pg`
--
ALTER TABLE `soal_pg`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tambah_kelas`
--
ALTER TABLE `tambah_kelas`
  MODIFY `Id_TambahKls` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tautan`
--
ALTER TABLE `tautan`
  MODIFY `Id_Tautan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `Id_Tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_guru`
--
ALTER TABLE `user_guru`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `user_siswa`
--
ALTER TABLE `user_siswa`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
