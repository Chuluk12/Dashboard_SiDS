-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2022 at 12:26 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sids`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses_dok`
--

CREATE TABLE `akses_dok` (
  `id` int(11) NOT NULL,
  `nm_user` varchar(30) NOT NULL,
  `nm_dokumen` varchar(150) NOT NULL,
  `tgl_unduh` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_apd`
--

CREATE TABLE `tb_apd` (
  `id` int(11) NOT NULL,
  `no_apd` varchar(60) NOT NULL,
  `jenis_apd` varchar(100) NOT NULL,
  `area_apd` varchar(60) NOT NULL,
  `user_apd` varchar(100) NOT NULL,
  `nm_apd` varchar(100) NOT NULL,
  `foto_apd` varchar(150) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokizin`
--

CREATE TABLE `tb_dokizin` (
  `id` int(11) NOT NULL,
  `no_izin` varchar(50) NOT NULL,
  `nm_izin` varchar(200) NOT NULL,
  `rilis_izin` varchar(100) NOT NULL,
  `kt_izin` varchar(20) NOT NULL,
  `tgl_izin` date NOT NULL,
  `masa_berlaku` date NOT NULL,
  `dokumen` varchar(100) NOT NULL,
  `nm_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokumen`
--

CREATE TABLE `tb_dokumen` (
  `id` int(11) NOT NULL,
  `kd_dokumen` varchar(50) NOT NULL,
  `nm_dokumen` varchar(100) NOT NULL,
  `revisi_dokumen` int(11) NOT NULL,
  `tgl_update` date NOT NULL,
  `kt_dokumen` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `tgl_distribusi` date DEFAULT NULL,
  `dokumen` varchar(150) NOT NULL,
  `nm_user` varchar(30) DEFAULT NULL,
  `pemilik` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_insiden`
--

CREATE TABLE `tb_insiden` (
  `id` int(11) NOT NULL,
  `no_insiden` varchar(20) NOT NULL,
  `tgl_insiden` datetime NOT NULL,
  `jenis_insiden` varchar(20) NOT NULL,
  `uraian` varchar(300) NOT NULL,
  `nm_pelapor` varchar(50) NOT NULL,
  `nm_terlapor` varchar(50) NOT NULL,
  `lokasi` varchar(40) NOT NULL,
  `status` varchar(10) NOT NULL,
  `foto_insiden` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `id` int(11) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `kegiatan` varchar(100) DEFAULT NULL,
  `mulai` timestamp NULL DEFAULT NULL,
  `selesai` timestamp NULL DEFAULT NULL,
  `status` varchar(30) NOT NULL,
  `no_reg` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_patrol`
--

CREATE TABLE `tb_patrol` (
  `id` int(11) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `tgl_patrol` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tgl_target` datetime NOT NULL,
  `lokasi` varchar(20) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `deskripsi_bahaya` varchar(500) NOT NULL,
  `jenis_bahaya` varchar(10) NOT NULL,
  `tindak_lanjut` varchar(500) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `foto_awal` varchar(50) NOT NULL,
  `foto_akhir` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_program`
--

CREATE TABLE `tb_program` (
  `id` int(11) NOT NULL,
  `no_reg` varchar(20) NOT NULL,
  `nm_reg` varchar(150) NOT NULL,
  `tipe_peserta` varchar(30) NOT NULL,
  `lama_pelaksanaan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_program`
--

INSERT INTO `tb_program` (`id`, `no_reg`, `nm_reg`, `tipe_peserta`, `lama_pelaksanaan`) VALUES
(1, 'P.2022-01', 'Pelatihan Sistem Easy Accounting 6', 'Umum', '30'),
(2, 'P.2022-02', 'Pelatihan Pengukuran EJF', 'Umum', '3'),
(3, 'P.2022-03', 'Pelatihan Ahli K3 Umum', 'Umum', '14');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rekaman`
--

CREATE TABLE `tb_rekaman` (
  `id` int(11) NOT NULL,
  `no_dok` varchar(50) NOT NULL,
  `nm_dok` varchar(150) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `lokasi` varchar(20) NOT NULL,
  `lama_simpan` varchar(20) NOT NULL,
  `cara_musnah` varchar(15) NOT NULL,
  `status` varchar(20) NOT NULL,
  `dokumen` varchar(300) NOT NULL,
  `pemilik` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(50) NOT NULL,
  `username` varchar(40) NOT NULL,
  `id_karyawan` varchar(50) NOT NULL,
  `nm_user` varchar(50) NOT NULL,
  `tmp_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `divisi` varchar(25) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `foto` varchar(225) NOT NULL,
  `kt_user` varchar(15) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `alamat` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `id_karyawan`, `nm_user`, `tmp_lahir`, `tgl_lahir`, `email`, `no_telp`, `divisi`, `jabatan`, `foto`, `kt_user`, `pass`, `alamat`) VALUES
(1, 'irfan', 'G10048', 'Muhammad Irfan Dadi', 'Bekasi', '1986-08-24', 'ifan.dadi@gmail.com', '0887123123', 'HSE-QA', 'Supervisor', '', 'Admin', 'irfan1234', 'Grand Residence'),
(2, 'rendi', 'G21108', 'Rendi Ismail', 'Jakarta', '1986-07-01', 'rendi@gmail.com', '0887123123', 'HSE-QA', 'Staff', 'rendi.png', 'User', 'rendi1234', 'Grand Residence'),
(39, 'adinda', 'G20980', 'Adinda Yustika Seftiani', 'Cirebon', '1998-01-09', 'dinda@gmail.com', '088712345678', 'HSE-QA', 'Staff', 'dinda.jpeg', 'Admin', 'adinda123', 'jl. provinsi jabar jatim');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses_dok`
--
ALTER TABLE `akses_dok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_apd`
--
ALTER TABLE `tb_apd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_dokizin`
--
ALTER TABLE `tb_dokizin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_insiden`
--
ALTER TABLE `tb_insiden`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_patrol`
--
ALTER TABLE `tb_patrol`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_program`
--
ALTER TABLE `tb_program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_rekaman`
--
ALTER TABLE `tb_rekaman`
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
-- AUTO_INCREMENT for table `akses_dok`
--
ALTER TABLE `akses_dok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_apd`
--
ALTER TABLE `tb_apd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_dokizin`
--
ALTER TABLE `tb_dokizin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `tb_insiden`
--
ALTER TABLE `tb_insiden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_patrol`
--
ALTER TABLE `tb_patrol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_program`
--
ALTER TABLE `tb_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_rekaman`
--
ALTER TABLE `tb_rekaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
