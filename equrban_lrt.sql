-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2024 at 09:41 AM
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
  `is_active` int(1) NOT NULL DEFAULT 1,
  `created_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_auth`
--

INSERT INTO `tb_auth` (`id`, `nipp`, `nama`, `email`, `password`, `id_role`, `is_active`, `created_date`) VALUES
(1, 0, 'Admin LRT', 'adminlrt@kai.id', '$2y$10$g0fulKON2pultXJZFgTk4edxlPKDoLFI7IPpB9qK97hS6./SywMm6', 1, 1, '2024-03-27'),
(2, 76988, 'Hariyanto', '76988@kai.id', '$2y$10$sIL9sslXHJGxgJigmDtjHeQ3lFf9iuVH8DZmSXmWJHIJP.kelrYBS', 2, 1, '2024-03-27'),
(36, 76994, 'M Ganang Priyambodo', '76994@kai.id', '$2y$10$9VK9EJF86WCHbbyOYC1fTutbb/pRLLClaYX57bkRWNALu7/wVsVBG', 2, 0, '2024-03-28'),
(37, 76998, 'Mochamad Fathurizqon', '76998@kai.id', '$2y$10$kgIcfmpU5HvRfDwjaRN.5.gBizkjRex8ZfjJccGu9nCIAzdTEh8ae', 1, 1, '2024-03-28'),
(38, 76991, 'Jogja Tinna Anna S', '76991@kai.id', '$2y$10$TwfO7a41NNG5Yu7mq7gqIOBp4ToQr3PmL/XlsJu8zV5KaHlbjiPQ.', 2, 1, '2024-03-28'),
(42, 12345, 'Nafkah', '12345@kai.id', '$2y$10$5RjMsU4/G5B16YMWL9zobu7PuOxlOURy6jtgbo8/qtNTztZC8RInq', 2, 1, '2024-03-30'),
(48, 76181, 'Krisna Nur Bakti', '76181@kai.id', '$2y$10$KAEz7Rnq9ATiQkrQSybeCu3Sbv2jTSW6vaOjc5YHk0uF04PFN/lPy', 2, 1, '2024-04-01'),
(51, 123123, 'aawawd', 'awd@awd.co', '$2y$10$HGhgjwCVv5lpsHv1yrtHu.J2ZZ89Kd35eH7lSrExyo3Vd49jHgfOa', 2, 1, '2024-04-04');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keterangan`
--

CREATE TABLE `tb_keterangan` (
  `id_keterangan` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_keterangan`
--

INSERT INTO `tb_keterangan` (`id_keterangan`, `keterangan`) VALUES
(1, 'Setor'),
(2, 'Tarik');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penarikan_dana`
--

CREATE TABLE `tb_penarikan_dana` (
  `id_penarikan` int(3) NOT NULL,
  `nama_pengirim` varchar(255) NOT NULL,
  `rekening_pengirim` varchar(20) NOT NULL,
  `bank_pengirim` varchar(100) DEFAULT NULL,
  `nama_penerima` varchar(255) NOT NULL,
  `rekening_penerima` varchar(20) NOT NULL,
  `bank_penerima` varchar(100) DEFAULT NULL,
  `jumlah_penarikan` decimal(10,2) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL,
  `tanggal_pengajuan` date NOT NULL DEFAULT current_timestamp(),
  `tanggal_transfer` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_penarikan_dana`
--

INSERT INTO `tb_penarikan_dana` (`id_penarikan`, `nama_pengirim`, `rekening_pengirim`, `bank_pengirim`, `nama_penerima`, `rekening_penerima`, `bank_penerima`, `jumlah_penarikan`, `metode_pembayaran`, `bukti_transfer`, `tanggal_pengajuan`, `tanggal_transfer`) VALUES
(8, 'DKM LRT Jabodebek', '1234125', 'BANK OF CHINA (HONG KONG) LIMITED', 'Hariyanto', '11231293', 'BANGKOK BANK PCL', 100099.00, 'Transfer Bank', '1712241582_5b23e7d79bafa7dc840e.jpeg', '2024-04-04', '2024-04-04'),
(9, 'DKM LRT Jabodebek', '1234125', 'PT BANK BCA SYARIAH', 'Hariyanto', '11231293', 'PT BANK MANDIRI (PERSERO) Tbk', 200000.00, 'Transfer Bank', '1712244380_70daff8ecb051a430980.jpeg', '2024-04-04', '2024-04-04');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penyetoran_dana`
--

CREATE TABLE `tb_penyetoran_dana` (
  `id_penyetoran` int(3) NOT NULL,
  `nama_pengirim` varchar(255) NOT NULL,
  `rekening_pengirim` varchar(20) NOT NULL,
  `bank_pengirim` varchar(100) DEFAULT NULL,
  `nama_penerima` varchar(255) NOT NULL,
  `rekening_penerima` varchar(20) NOT NULL,
  `bank_penerima` varchar(100) DEFAULT NULL,
  `jumlah_setoran` decimal(10,2) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL,
  `tanggal_penyetoran` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_penyetoran_dana`
--

INSERT INTO `tb_penyetoran_dana` (`id_penyetoran`, `nama_pengirim`, `rekening_pengirim`, `bank_pengirim`, `nama_penerima`, `rekening_penerima`, `bank_penerima`, `jumlah_setoran`, `metode_pembayaran`, `bukti_transfer`, `tanggal_penyetoran`) VALUES
(23, 'Hariyanto', '12345', 'DEUTSCHE BANK AG', 'LRT Jabodebek', '67789', 'BANK OF AMERICA N.A', 1000000.00, 'Transfer Bank', '1712196574_419fc60a97d14a04b60b.jpeg', '2024-04-04'),
(24, 'Hariyanto', '1310012158509', 'PT BANK MANDIRI (PERSERO) Tbk', 'LRT Jabodebek', '8900172425', 'PT BANK CENTRAL ASIA Tbk', 500000.00, 'Transfer Bank', '1712241784_6de09ffac4c967ef878d.jpeg', '2024-04-04'),
(25, 'Jogja TS', '12345', 'PT BANK DBS INDONESIA', 'LRT Jabodebek', '8900172425', 'PT BANK DANAMON INDONESIA Tbk', 250000.00, 'Transfer Bank', '1712299894_99eac5665271b883782e.png', '2024-04-05');

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
-- Table structure for table `tb_status_transaksi`
--

CREATE TABLE `tb_status_transaksi` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_status_transaksi`
--

INSERT INTO `tb_status_transaksi` (`id`, `status`) VALUES
(1, 'Pending'),
(2, 'Approved'),
(3, 'Rejected'),
(4, 'In Progress'),
(5, 'Funds Sent');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tabungan`
--

CREATE TABLE `tb_tabungan` (
  `id_penabung` int(4) NOT NULL,
  `saldo` decimal(10,2) NOT NULL DEFAULT 0.00,
  `nipp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_tabungan`
--

INSERT INTO `tb_tabungan` (`id_penabung`, `saldo`, `nipp`) VALUES
(2, 300000.00, 76988),
(36, 0.00, 76994),
(38, 0.00, 76991),
(42, 0.00, 12345),
(48, 0.00, 76181),
(51, 0.00, 123123);

-- --------------------------------------------------------

--
-- Table structure for table `tb_trx_penabung`
--

CREATE TABLE `tb_trx_penabung` (
  `id_transaksi` int(3) NOT NULL,
  `id_penyetoran` int(3) DEFAULT NULL,
  `id_penarikan` int(3) DEFAULT NULL,
  `id_penabung` int(11) NOT NULL,
  `tanggal_transaksi` date DEFAULT curdate(),
  `nominal` decimal(10,2) DEFAULT NULL,
  `saldo` decimal(10,2) DEFAULT 0.00,
  `id_keterangan` int(11) DEFAULT NULL,
  `id_status` int(11) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_trx_penabung`
--

INSERT INTO `tb_trx_penabung` (`id_transaksi`, `id_penyetoran`, `id_penarikan`, `id_penabung`, `tanggal_transaksi`, `nominal`, `saldo`, `id_keterangan`, `id_status`, `id_admin`, `created_date`) VALUES
(44, 24, NULL, 2, '2024-04-04', 500000.00, 0.00, 1, 1, NULL, '2024-04-04 21:43:04'),
(46, NULL, 9, 2, '2024-04-04', 200000.00, 500000.00, 2, 1, NULL, '2024-04-04 22:25:19'),
(47, 24, NULL, 2, '2024-04-04', 500000.00, 500000.00, 1, 2, 1, '2024-04-04 22:25:52'),
(48, NULL, 9, 2, '2024-04-04', 200000.00, 500000.00, 2, 4, 1, '2024-04-04 22:25:57'),
(49, NULL, 9, 2, '2024-04-04', 200000.00, 300000.00, 2, 5, 1, '2024-04-04 22:26:20'),
(50, 25, NULL, 38, '2024-04-05', 250000.00, 0.00, 1, 1, NULL, '2024-04-05 13:51:34');

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
(0, 'Tidak Aktif'),
(1, 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_auth`
--
ALTER TABLE `tb_auth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `is_active` (`is_active`);

--
-- Indexes for table `tb_keterangan`
--
ALTER TABLE `tb_keterangan`
  ADD PRIMARY KEY (`id_keterangan`);

--
-- Indexes for table `tb_penarikan_dana`
--
ALTER TABLE `tb_penarikan_dana`
  ADD PRIMARY KEY (`id_penarikan`);

--
-- Indexes for table `tb_penyetoran_dana`
--
ALTER TABLE `tb_penyetoran_dana`
  ADD PRIMARY KEY (`id_penyetoran`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_status_transaksi`
--
ALTER TABLE `tb_status_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tabungan`
--
ALTER TABLE `tb_tabungan`
  ADD PRIMARY KEY (`id_penabung`),
  ADD UNIQUE KEY `id_penabung` (`id_penabung`),
  ADD KEY `nipp` (`nipp`);

--
-- Indexes for table `tb_trx_penabung`
--
ALTER TABLE `tb_trx_penabung`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_penabung` (`id_penabung`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `fk_id_status` (`id_status`),
  ADD KEY `tb_id_penyetoran` (`id_penyetoran`),
  ADD KEY `tb_id_penarikan` (`id_penarikan`),
  ADD KEY `tb_trx_penabung_FK` (`id_keterangan`);

--
-- Indexes for table `tb_user_status`
--
ALTER TABLE `tb_user_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_auth`
--
ALTER TABLE `tb_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tb_penarikan_dana`
--
ALTER TABLE `tb_penarikan_dana`
  MODIFY `id_penarikan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_penyetoran_dana`
--
ALTER TABLE `tb_penyetoran_dana`
  MODIFY `id_penyetoran` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_trx_penabung`
--
ALTER TABLE `tb_trx_penabung`
  MODIFY `id_transaksi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_auth`
--
ALTER TABLE `tb_auth`
  ADD CONSTRAINT `tb_auth_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `tb_role` (`id`),
  ADD CONSTRAINT `tb_auth_ibfk_2` FOREIGN KEY (`is_active`) REFERENCES `tb_user_status` (`id`);

--
-- Constraints for table `tb_tabungan`
--
ALTER TABLE `tb_tabungan`
  ADD CONSTRAINT `tb_tabungan_ibfk_1` FOREIGN KEY (`id_penabung`) REFERENCES `tb_auth` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_trx_penabung`
--
ALTER TABLE `tb_trx_penabung`
  ADD CONSTRAINT `fk_id_admin` FOREIGN KEY (`id_admin`) REFERENCES `tb_auth` (`id`),
  ADD CONSTRAINT `fk_id_penabung` FOREIGN KEY (`id_penabung`) REFERENCES `tb_auth` (`id`),
  ADD CONSTRAINT `fk_id_status` FOREIGN KEY (`id_status`) REFERENCES `tb_status_transaksi` (`id`),
  ADD CONSTRAINT `tb_id_penarikan` FOREIGN KEY (`id_penarikan`) REFERENCES `tb_penarikan_dana` (`id_penarikan`),
  ADD CONSTRAINT `tb_id_penyetoran` FOREIGN KEY (`id_penyetoran`) REFERENCES `tb_penyetoran_dana` (`id_penyetoran`),
  ADD CONSTRAINT `tb_trx_penabung_FK` FOREIGN KEY (`id_keterangan`) REFERENCES `tb_keterangan` (`id_keterangan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
