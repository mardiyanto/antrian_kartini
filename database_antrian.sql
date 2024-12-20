-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15 Nov 2024 pada 17.11
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_antrian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian`
--

CREATE TABLE `antrian` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `loket` int(11) NOT NULL,
  `nomor_antrian` int(11) NOT NULL,
  `status` varchar(20) DEFAULT 'belum',
  `waktu_panggilan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `antrian`
--

INSERT INTO `antrian` (`id`, `tanggal`, `loket`, `nomor_antrian`, `status`, `waktu_panggilan`) VALUES
(2, '2024-11-15', 3, 1, 'sudah', '2024-11-15 15:22:18'),
(4, '2024-11-15', 2, 1, 'sudah', '2024-11-15 15:22:18'),
(5, '2024-11-15', 2, 2, 'sudah', '2024-11-15 15:22:23'),
(7, '2024-11-15', 3, 2, 'sudah', '2024-11-15 15:22:23'),
(9, '2024-11-15', 3, 3, 'sudah', '2024-11-15 15:22:29'),
(10, '2024-11-15', 2, 3, 'sudah', '2024-11-15 15:22:29'),
(11, '2024-11-15', 3, 4, 'sudah', '2024-11-15 15:22:35'),
(12, '2024-11-15', 2, 4, 'sudah', '2024-11-15 15:22:35'),
(14, '2024-11-15', 3, 5, 'sudah', '2024-11-15 15:22:40'),
(15, '2024-11-15', 2, 5, 'sudah', '2024-11-15 15:22:40'),
(17, '2024-11-15', 1, 6, 'sudah', '2024-11-15 15:23:18'),
(18, '2024-11-15', 3, 6, 'sudah', '2024-11-15 15:23:18'),
(19, '2024-11-15', 2, 6, 'sudah', '2024-11-15 15:23:18'),
(20, '2024-11-15', 1, 7, 'sudah', '2024-11-15 15:23:52'),
(21, '2024-11-15', 2, 7, 'sudah', '2024-11-15 15:23:52'),
(22, '2024-11-15', 3, 7, 'sudah', '2024-11-15 15:23:52'),
(23, '2024-11-15', 1, 8, 'sudah', '2024-11-15 15:23:57'),
(24, '2024-11-15', 2, 8, 'sudah', '2024-11-15 15:23:57'),
(25, '2024-11-15', 3, 8, 'sudah', '2024-11-15 15:23:57'),
(26, '2024-11-15', 2, 9, 'sudah', '2024-11-15 15:23:57'),
(27, '2024-11-15', 3, 9, 'sudah', '2024-11-15 15:23:57'),
(28, '2024-11-15', 1, 9, 'sudah', '2024-11-15 15:23:57'),
(29, '2024-11-15', 1, 10, 'sudah', '2024-11-15 15:24:03'),
(30, '2024-11-15', 3, 10, 'sudah', '2024-11-15 15:24:03'),
(31, '2024-11-15', 2, 10, 'sudah', '2024-11-15 15:24:03'),
(32, '2024-11-15', 1, 11, 'sudah', '2024-11-15 15:24:05'),
(33, '2024-11-15', 3, 11, 'sudah', '2024-11-15 15:24:05'),
(34, '2024-11-15', 2, 11, 'sudah', '2024-11-15 15:24:05'),
(68, '2024-11-15', 2, 12, 'sudah', '2024-11-15 15:34:20'),
(69, '2024-11-15', 3, 12, 'sudah', '2024-11-15 15:34:20'),
(70, '2024-11-15', 1, 12, 'sudah', '2024-11-15 15:34:20'),
(71, '2024-11-15', 2, 13, 'sudah', '2024-11-15 15:35:00'),
(72, '2024-11-15', 1, 13, 'sudah', '2024-11-15 15:35:00'),
(73, '2024-11-15', 3, 13, 'sudah', '2024-11-15 15:35:00'),
(74, '2024-11-15', 1, 14, 'sudah', '2024-11-15 15:35:36'),
(75, '2024-11-15', 2, 14, 'sudah', '2024-11-15 15:35:36'),
(76, '2024-11-15', 3, 14, 'sudah', '2024-11-15 15:35:36'),
(77, '2024-11-15', 1, 15, 'sudah', '2024-11-15 15:35:48'),
(78, '2024-11-15', 2, 15, 'sudah', '2024-11-15 15:35:48'),
(79, '2024-11-15', 3, 15, 'sudah', '2024-11-15 15:35:48'),
(80, '2024-11-15', 3, 16, 'sudah', '2024-11-15 15:35:56'),
(81, '2024-11-15', 1, 16, 'sudah', '2024-11-15 15:35:56'),
(82, '2024-11-15', 2, 16, 'sudah', '2024-11-15 15:35:56'),
(83, '2024-11-15', 2, 17, 'sudah', '2024-11-15 15:36:09'),
(84, '2024-11-15', 1, 17, 'sudah', '2024-11-15 15:36:09'),
(85, '2024-11-15', 3, 17, 'sudah', '2024-11-15 15:36:09'),
(86, '2024-11-15', 1, 18, 'sudah', '2024-11-15 15:36:18'),
(87, '2024-11-15', 2, 18, 'sudah', '2024-11-15 15:36:18'),
(88, '2024-11-15', 3, 18, 'sudah', '2024-11-15 15:36:18'),
(89, '2024-11-15', 1, 19, 'sudah', '2024-11-15 15:36:25'),
(90, '2024-11-15', 2, 19, 'sudah', '2024-11-15 15:36:25'),
(91, '2024-11-15', 3, 19, 'sudah', '2024-11-15 15:36:25'),
(92, '2024-11-15', 3, 20, 'sudah', '2024-11-15 15:36:34'),
(93, '2024-11-15', 1, 20, 'sudah', '2024-11-15 15:36:34'),
(94, '2024-11-15', 2, 20, 'sudah', '2024-11-15 15:36:34'),
(95, '2024-11-15', 2, 21, 'sudah', '2024-11-15 15:36:46'),
(96, '2024-11-15', 3, 21, 'sudah', '2024-11-15 15:36:46'),
(97, '2024-11-15', 1, 21, 'sudah', '2024-11-15 15:36:46'),
(98, '2024-11-15', 2, 22, 'sudah', '2024-11-15 15:37:00'),
(99, '2024-11-15', 1, 22, 'sudah', '2024-11-15 15:37:00'),
(100, '2024-11-15', 3, 22, 'sudah', '2024-11-15 15:37:00'),
(101, '2024-11-15', 2, 23, 'sudah', '2024-11-15 15:44:59'),
(102, '2024-11-15', 3, 23, 'sudah', '2024-11-15 15:44:59'),
(103, '2024-11-15', 1, 23, 'sudah', '2024-11-15 15:44:59'),
(104, '2024-11-15', 1, 24, 'sudah', '2024-11-15 15:48:05'),
(105, '2024-11-15', 3, 24, 'sudah', '2024-11-15 15:48:05'),
(106, '2024-11-15', 2, 24, 'sudah', '2024-11-15 15:48:05'),
(110, '2024-11-15', 1, 25, 'sudah', '2024-11-15 15:52:04'),
(111, '2024-11-15', 2, 25, 'sudah', '2024-11-15 15:52:04'),
(112, '2024-11-15', 3, 25, 'sudah', '2024-11-15 15:52:04'),
(113, '2024-11-15', 1, 26, 'sudah', '2024-11-15 15:59:25'),
(114, '2024-11-15', 3, 26, 'sudah', '2024-11-15 15:59:25'),
(115, '2024-11-15', 2, 26, 'sudah', '2024-11-15 15:59:25'),
(116, '2024-11-15', 2, 27, 'sudah', '2024-11-15 16:09:11'),
(117, '2024-11-15', 1, 27, 'sudah', '2024-11-15 16:09:11'),
(118, '2024-11-15', 3, 27, 'sudah', '2024-11-15 16:09:11'),
(119, '2024-11-15', 1, 28, 'sudah', '2024-11-15 16:09:20'),
(120, '2024-11-15', 3, 28, 'sudah', '2024-11-15 16:09:20'),
(121, '2024-11-15', 2, 28, 'sudah', '2024-11-15 16:09:20'),
(122, '2024-11-15', 3, 29, 'sudah', '2024-11-15 16:10:37'),
(123, '2024-11-15', 2, 29, 'sudah', '2024-11-15 16:10:37'),
(124, '2024-11-15', 1, 29, 'sudah', '2024-11-15 16:10:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
