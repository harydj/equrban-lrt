-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 07:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `equrban_lrt`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_auth`
--

CREATE TABLE `tb_auth` (
  `id` int(11) NOT NULL,
  `nipp` int(6) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_role` int(1) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_auth`
--

INSERT INTO `tb_auth` (`id`, `nipp`, `nama`, `email`, `password`, `id_role`, `is_active`, `created_date`) VALUES
(1, 0, 'Admin LRT', 'adminlrt@kai.id', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '2024-03-27'),
(2, 76988, 'Hariyanto', '76988@kai.id', '6a00ac1e69471049e71eb82cbe6a3619', 2, 1, '2024-03-27'),
(3, 76988, 'Hariyanto', '76988@kai.id', '6a00ac1e69471049e71eb82cbe6a3619', 2, 1, '2024-03-27'),
(4, 0, 'Admin LRT', 'adminlrt@kai.id', '21232f297a57a5a743894a0e4a801fc3', 1, 0, '2024-03-27'),
(5, 76988, 'Hariyanto', '76988@kai.id', '6a00ac1e69471049e71eb82cbe6a3619', 2, 0, '2024-03-27'),
(6, 76988, 'Hariyanto', '76988@kai.id', '6a00ac1e69471049e71eb82cbe6a3619', 2, 1, '2024-03-27'),
(7, 0, 'Admin LRT', 'adminlrt@kai.id', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '2024-03-27'),
(8, 76988, 'Hariyanto', '76988@kai.id', '6a00ac1e69471049e71eb82cbe6a3619', 2, 1, '2024-03-27'),
(9, 76988, 'Hariyanto', '76988@kai.id', '6a00ac1e69471049e71eb82cbe6a3619', 2, 1, '2024-03-27'),
(10, 0, 'Admin LRT', 'adminlrt@kai.id', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '2024-03-27'),
(11, 76988, 'Hariyanto', '76988@kai.id', '6a00ac1e69471049e71eb82cbe6a3619', 2, 1, '2024-03-27'),
(12, 76988, 'Hariyanto', '76988@kai.id', '6a00ac1e69471049e71eb82cbe6a3619', 2, 1, '2024-03-27'),
(13, 0, 'Admin LRT', 'adminlrt@kai.id', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '2024-03-27'),
(14, 76988, 'Hariyanto', '76988@kai.id', '6a00ac1e69471049e71eb82cbe6a3619', 2, 1, '2024-03-27'),
(15, 76988, 'Hariyanto', '76988@kai.id', '6a00ac1e69471049e71eb82cbe6a3619', 2, 1, '2024-03-27'),
(16, 0, 'Admin LRT', 'adminlrt@kai.id', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '2024-03-27'),
(17, 76988, 'Hariyanto', '76988@kai.id', '6a00ac1e69471049e71eb82cbe6a3619', 2, 1, '2024-03-27'),
(18, 76988, 'Hariyanto', '76988@kai.id', '6a00ac1e69471049e71eb82cbe6a3619', 2, 1, '2024-03-27'),
(19, 0, 'Admin LRT', 'adminlrt@kai.id', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '2024-03-27'),
(20, 76988, 'Hariyanto', '76988@kai.id', '6a00ac1e69471049e71eb82cbe6a3619', 2, 1, '2024-03-27'),
(21, 76988, 'Hariyanto', '76988@kai.id', '6a00ac1e69471049e71eb82cbe6a3619', 2, 1, '2024-03-27'),
(22, 0, 'Admin LRT', 'adminlrt@kai.id', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '2024-03-27'),
(23, 76988, 'Hariyanto', '76988@kai.id', '6a00ac1e69471049e71eb82cbe6a3619', 2, 1, '2024-03-27'),
(24, 76988, 'Hariyanto', '76988@kai.id', '6a00ac1e69471049e71eb82cbe6a3619', 2, 1, '2024-03-27');

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `id` int(1) NOT NULL,
  `Role` varchar(100) NOT NULL,
  `Description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`id`, `Role`, `Description`) VALUES
(1, 'Admin', 'Hak Akses Admin'),
(2, 'Penabung', 'Hak Akses Penabung');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_status`
--

CREATE TABLE `tb_user_status` (
  `id` int(1) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_user_status`
--

INSERT INTO `tb_user_status` (`id`, `description`) VALUES
(1, 'Aktif'),
(0, 'Tidak Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_auth`
--
ALTER TABLE `tb_auth`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_auth`
--
ALTER TABLE `tb_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
