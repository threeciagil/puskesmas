-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2022 at 07:41 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testpuskesmas`
--

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `id` int(11) NOT NULL,
  `no_rm` varchar(255) NOT NULL,
  `id_pemeriksaan` int(11) NOT NULL,
  `total_pembayaran` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_anamnesa_rm`
--

CREATE TABLE `tbl_anamnesa_rm` (
  `id_anamnesa` int(11) NOT NULL,
  `id_pemeriksaan` int(11) NOT NULL,
  `rpd` varchar(225) NOT NULL,
  `rpk` varchar(255) NOT NULL,
  `rps` varchar(255) NOT NULL,
  `no_rm` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_anamnesa_rm`
--

INSERT INTO `tbl_anamnesa_rm` (`id_anamnesa`, `id_pemeriksaan`, `rpd`, `rpk`, `rps`, `no_rm`) VALUES
(60, 115, '-', '-', 'Demam', '03.A000001.1'),
(61, 116, '-', '-', 'Mual muntah', '03.S000001.3'),
(62, 117, '-', '-', 'Panas', '03.A000001.7');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_antrian_farmasi`
--

CREATE TABLE `tbl_antrian_farmasi` (
  `id_antrian` int(11) NOT NULL,
  `no_antrian` varchar(100) NOT NULL,
  `no_rm` varchar(50) NOT NULL,
  `waktu` varchar(25) NOT NULL,
  `status` varchar(255) NOT NULL,
  `poli_asal` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_antrian_kasir`
--

CREATE TABLE `tbl_antrian_kasir` (
  `id_antrian` int(11) NOT NULL,
  `no_antrian` varchar(100) NOT NULL,
  `no_rm` varchar(50) NOT NULL,
  `waktu` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL,
  `poli_asal` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `tanggal` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_antrian_kasir`
--

INSERT INTO `tbl_antrian_kasir` (`id_antrian`, `no_antrian`, `no_rm`, `waktu`, `status`, `poli_asal`, `urutan`, `tanggal`) VALUES
(100000034, 'A 00 3', '03.S000001.3', '09:20:24', 'pembayaran', 'Poli Umum', 1, '2022-07-17'),
(100000035, 'A 0 11', '03.A000001.7', '09:42:52', 'pembayaran', 'Poli Umum', 2, '2022-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_antrian_laboratorium`
--

CREATE TABLE `tbl_antrian_laboratorium` (
  `id_antrian` int(11) NOT NULL,
  `no_antrian` varchar(100) NOT NULL,
  `no_rm` varchar(25) NOT NULL,
  `waktu` varchar(25) NOT NULL,
  `status` varchar(255) NOT NULL,
  `poli_asal` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_antrian_laboratorium`
--

INSERT INTO `tbl_antrian_laboratorium` (`id_antrian`, `no_antrian`, `no_rm`, `waktu`, `status`, `poli_asal`, `urutan`, `tanggal`) VALUES
(100000019, 'A 00 2', '03.A000001.1', '09:03:04', 'permintaanlab', 'Poli Umum', 1, '2022-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_antrian_poli_umums`
--

CREATE TABLE `tbl_antrian_poli_umums` (
  `id_antrian` int(11) NOT NULL,
  `no_antrian` varchar(100) NOT NULL,
  `no_rm` varchar(25) NOT NULL,
  `waktu` varchar(25) NOT NULL,
  `status` varchar(255) NOT NULL,
  `poli_asal` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_antrian_poli_umums`
--

INSERT INTO `tbl_antrian_poli_umums` (`id_antrian`, `no_antrian`, `no_rm`, `waktu`, `status`, `poli_asal`, `urutan`, `created_at`, `updated_at`) VALUES
(100000095, 'A 00 2', '03.A000001.1', '2022-07-17 15:20:28', 'permintaanlab', 'Poli Umum', 1, '2022-07-17', '2022-07-17'),
(100000096, 'A 00 3', '03.S000001.3', '2022-07-17 15:20:52', 'pembayaran', 'Poli Umum', 2, '2022-07-17', '2022-07-17'),
(100000097, 'A 0 11', '03.A000001.7', '2022-07-17 15:21:14', 'pembayaran', 'Poli Umum', 3, '2022-07-17', '2022-07-17'),
(100000098, 'A 00 1', '10.S000001.3', '2022-07-17 15:21:47', 'Masuk', 'Poli Umum', 4, '2022-07-17', '2022-07-17'),
(100000099, 'A 00 4', '03.A000001.3', '2022-07-17 15:33:52', 'Masuk', 'Poli Umum', 5, '2022-07-17', '2022-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_antri_pendaftaran`
--

CREATE TABLE `tbl_antri_pendaftaran` (
  `id_antrian` int(8) NOT NULL,
  `no_antrian` varchar(255) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_antri_pendaftaran`
--

INSERT INTO `tbl_antri_pendaftaran` (`id_antrian`, `no_antrian`, `id_poli`, `tanggal_daftar`, `status`, `urutan`) VALUES
(100000278, '2', 1, '2022-07-17', 'hapus', 1),
(100000279, '3', 1, '2022-07-17', 'hapus', 2),
(100000280, '4', 1, '2022-07-17', 'hapus', 3),
(100000281, '1', 1, '2022-07-17', 'hapus', 4),
(100000282, '5', 1, '2022-07-17', 'masuk', 5),
(100000283, '6', 1, '2022-07-17', 'masuk', 6),
(100000284, '7', 1, '2022-07-17', 'masuk', 7),
(100000285, '8', 1, '2022-07-17', 'masuk', 8),
(100000286, '10', 1, '2022-07-17', 'masuk', 9),
(100000287, '12', 1, '2022-07-17', 'masuk', 10),
(100000289, '9', 1, '2022-07-17', 'lewati', 12),
(100000291, '11', 1, '2022-07-17', 'hapus', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_asuhan_keperawatan`
--

CREATE TABLE `tbl_asuhan_keperawatan` (
  `id_askep` int(11) NOT NULL,
  `id_pemeriksaan` int(11) NOT NULL,
  `no_rm` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` datetime NOT NULL,
  `jam_selesai` datetime NOT NULL,
  `rpd` text NOT NULL,
  `rpk` text NOT NULL,
  `rps` text NOT NULL,
  `nb_subjective` text NOT NULL,
  `tb` int(11) NOT NULL,
  `bb` int(11) NOT NULL,
  `imt` float NOT NULL,
  `suhu` float NOT NULL,
  `rr` int(11) NOT NULL,
  `sistol` int(11) NOT NULL,
  `diastol` int(11) NOT NULL,
  `nb_object` text NOT NULL,
  `nb_assessment` text NOT NULL,
  `nb_plan` text NOT NULL,
  `penanggungjawab` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_asuhan_keperawatan`
--

INSERT INTO `tbl_asuhan_keperawatan` (`id_askep`, `id_pemeriksaan`, `no_rm`, `tanggal`, `jam_mulai`, `jam_selesai`, `rpd`, `rpk`, `rps`, `nb_subjective`, `tb`, `bb`, `imt`, `suhu`, `rr`, `sistol`, `diastol`, `nb_object`, `nb_assessment`, `nb_plan`, `penanggungjawab`) VALUES
(85, 115, '03.A000001.1', '2022-07-17', '2022-07-17 15:34:42', '2022-07-17 15:36:08', '-', '-', 'Demam', 'Normal', 160, 50, 19.5, 37.5, 20, 110, 100, 'Normal', 'Normal', '-', 'Jean (perawat)'),
(86, 116, '03.S000001.3', '2022-07-17', '2022-07-17 21:14:55', '2022-07-17 21:15:22', '-', '-', 'Mual muntah', 'Normal', 160, 50, 19.5, 37.5, 20, 110, 100, 'Normal', 'Normal', '-', 'Jean (perawat)'),
(87, 117, '03.A000001.7', '2022-07-17', '2022-07-17 21:33:35', '2022-07-17 21:34:04', '-', '-', 'Panas', 'Normal', 160, 50, 19.5, 37.5, 20, 110, 100, 'Normal', 'Normal', '-', 'Jean (perawat)');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_asuransi`
--

CREATE TABLE `tbl_asuransi` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `tipe_asuransi` varchar(250) NOT NULL,
  `nomor_asuransi` int(11) NOT NULL,
  `faskes_1` varchar(225) NOT NULL,
  `nik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_asuransi`
--

INSERT INTO `tbl_asuransi` (`id`, `nama`, `tipe_asuransi`, `nomor_asuransi`, `faskes_1`, `nik`) VALUES
(1, 'Adi Purwanto', 'BPJS', 111111, 'Puskesmas Rejowinangun', '2147483647'),
(2, 'Wagian Ruliyatin', 'BPJS', 111112, 'Puskesmas Rejowinangun', '0767677'),
(3, 'Suliayandi', 'BPJS', 111113, 'Puskesmas Rejowinangun', '97866867'),
(4, 'Faro', 'BPJS', 111114, 'Puskesmas Rejowinangun', '978776677'),
(6, 'Nur Anisa', 'BPJS', 111115, 'Puskesmas Rejowinangun', '4665666');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_datapasiens`
--

CREATE TABLE `tbl_datapasiens` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `nama_kk` varchar(50) NOT NULL,
  `no_index` varchar(10) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `umur` int(5) NOT NULL,
  `jenis_asuransi` varchar(100) NOT NULL,
  `no_asuransi` varchar(10) DEFAULT NULL,
  `agama` varchar(10) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `silsilah` varchar(50) NOT NULL,
  `no_rm` varchar(50) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_at` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_datapasiens`
--

INSERT INTO `tbl_datapasiens` (`id`, `nama`, `jenis_kelamin`, `nama_kk`, `no_index`, `alamat`, `pekerjaan`, `tanggal_lahir`, `umur`, `jenis_asuransi`, `no_asuransi`, `agama`, `telp`, `silsilah`, `no_rm`, `updated_at`, `created_at`) VALUES
(46, 'Adi Purwanto', 'Laki-laki', 'Adi Purwanto', '03.A000001', 'RT 09 RW 04', 'POLRI', '1967-01-31', 55, 'BPJS', '111111', 'Islam', '081274168207', 'Kepala Keluarga', '03.A000001.1', '2022-05-22 09:59:59', '2022-05-22 09:59:59'),
(206, 'Wagian Ruliyatin', 'Perempuan', 'Adi Purwanto', '03.A000001', 'RT 09 RW 04', 'PNS', '1968-01-14', 54, 'BPJS', '111112', 'Islam', '081337712252', 'Ibu', '03.A000001.2', '2022-07-03 01:02:38', '2022-07-03 01:02:38'),
(48, 'Threecia Agil Regitasari', 'Perempuan', 'Adi Purwanto', '03.A000001', 'RT 09 RW 04', 'Mahasiswa', '1998-01-22', 24, 'Umum', NULL, 'Islam', '081337712253', 'Lainnya', '03.A000001.3', '2022-05-22 10:01:17', '2022-05-22 10:01:17'),
(49, 'Martharita Farindahsari Purwandita', 'Perempuan', 'Adi Purwanto', '03.A000001', 'RT 09 RW 04', 'Bidan', '1992-03-13', 30, 'Umum', NULL, 'Islam', '08568677098', 'Lainnya', '03.A000001.4', '2022-05-22 10:01:49', '2022-05-22 10:01:49'),
(213, 'Dhafa Maulana Alkanza Putra', 'Laki-laki', 'Adi Purwanto', '03.A000001', 'RT 09 RW 04', 'Pelajar', '2015-11-14', 6, 'Umum', NULL, 'Islam', '081337712252', 'Lainnya', '03.A000001.7', '2022-07-12 03:04:51', '2022-07-12 03:04:51'),
(215, 'Nanana', 'Perempuan', 'Nanana', '03.N000001', 'RT 09 RW 04', 'PNS', '1978-01-22', 44, 'Umum', NULL, 'Islam', '081337712252', 'Kepala Keluarga', '03.N000001.1', '2022-07-14 03:40:42', '2022-07-14 03:40:42'),
(52, 'Faro', 'Laki-laki', 'Suliyandi', '03.S000001', 'RT 09 RW 04', 'Pelajar', '2014-05-12', 8, 'Umum', NULL, 'Islam', '081337712252', 'Lainnya', '03.S000001.3', '2022-05-24 17:09:46', '2022-05-24 17:09:46'),
(53, 'Snowy', 'Laki-laki', 'Suliyandi', '03.S000001', 'RT 09 RW 04', '-', '2010-01-22', 12, 'Umum', NULL, 'Islam', '081337712252', 'Lainnya', '03.S000001.4', '2022-05-24 17:30:35', '2022-05-24 17:30:35'),
(54, 'Gembul', 'Laki-laki', 'Suliyandi', '03.S000001', 'RT 09 RW 04', '-', '2021-07-14', 0, 'Umum', NULL, 'Islam', '039539593052', 'Lainnya', '03.S000001.5', '2022-05-24 18:00:49', '2022-05-24 18:00:49'),
(214, 'Ali Muhammad', 'Laki-laki', 'Ali Muhammad', '04.A000001', 'RT 09 RW 04', 'PNS', '1967-01-22', 55, 'Umum', NULL, 'Islam', '087546321456', 'Kepala Keluarga', '04.A000001.1', '2022-07-14 03:06:40', '2022-07-14 03:06:40'),
(225, 'Adi Purwanto', 'Laki-laki', 'Adi Purwanto', '10.P000001', 'RT 09 RW 04', 'Polri', '1967-01-30', 55, 'Umum', '', 'Islam', '081337712252', 'Kepala Keluarga', '10.P000001.1', '2022-08-05 15:11:33', '2022-08-05 15:11:33'),
(226, 'Wagian Ruliyatin', 'Perempuan', 'Adi Purwanto', '10.P000001', 'RT 09 RW 04', 'PNS', '1968-07-14', 54, 'Umum', '', 'Islam', '081337712252', 'Ibu', '10.P000001.2', '2022-08-05 15:11:33', '2022-08-05 15:11:33'),
(227, 'Martharita Farindahsari P', 'Perempuan', 'Adi Purwanto', '10.P000001', 'RT 09 RW 04', 'Bidan', '1992-03-13', 30, 'Umum', '', 'Islam', '081337712252', 'Lainnya', '10.P000001.5', '2022-08-05 15:11:33', '2022-08-05 15:11:33'),
(50, 'Suyono', 'Laki-laki', 'Suyono', '10.S000001', 'RT 04 RW 06', 'petani', '1970-11-10', 51, 'Umum', NULL, 'Islam', '08973161256', 'Kepala Keluarga', '10.S000001.1', '2022-05-22 10:20:16', '2022-05-22 10:20:16'),
(51, 'Nur Anisa', 'Perempuan', 'Suyono', '10.S000001', 'RT 04 RW 06', 'Mahasiswa', '1999-04-09', 23, 'Umum', NULL, 'Islam', '08973161256', 'Lainnya', '10.S000001.3', '2022-05-22 10:20:54', '2022-05-22 10:20:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data_icdx`
--

CREATE TABLE `tbl_data_icdx` (
  `id` int(11) NOT NULL,
  `icd_x` varchar(50) NOT NULL,
  `nama_diagnosa` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_data_icdx`
--

INSERT INTO `tbl_data_icdx` (`id`, `icd_x`, `nama_diagnosa`, `status`) VALUES
(12, 'A01.0', 'Demam tifoid', ''),
(13, 'A05.9', 'Keracunan makanan akibat bakteri yang tidak spesifik', ''),
(14, 'A38', 'Demam berdarah', ''),
(5, 'J00', 'Nasopharyngitis akut [ flu biasa ]', 'hapus'),
(6, 'J01.0', 'Sinusitis maksilaris akut', ''),
(7, 'J06.8', 'Infeksi saluran pernapasan akut lainnya atas beberapa situs', ''),
(8, 'J10.0', 'Influenza dengan pneumonia , virus influenza diidentifikasi', ''),
(9, 'J10.1', 'Influenza dengan manifestasi pernapasan lainnya , virus influenza diidentifikasi', ''),
(10, 'J10.8', 'Influenza dengan manifestasi lain , virus influenza diidentifikasi', 'hapus'),
(11, 'J11.0', 'Influenza dengan pneumonia , virus tidak teridentifikasi', 'hapus'),
(15, 'ss', 'dsd', 'hapus');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data_laborat_dokter`
--

CREATE TABLE `tbl_data_laborat_dokter` (
  `id_data_laborat_dokter` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tarif` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_data_laborat_dokter`
--

INSERT INTO `tbl_data_laborat_dokter` (`id_data_laborat_dokter`, `nama`, `tarif`, `id_jenis`, `status`) VALUES
(22, 'HB', 15000, 4, 'tersedia'),
(23, 'Darah Lengkap', 50000, 4, 'tersedia'),
(26, 'coba', 15000, 4, 'hapus'),
(27, 'coba', 15000, 4, 'hapus'),
(28, 'coba', 50000, 4, 'hapus');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data_obat`
--

CREATE TABLE `tbl_data_obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(255) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_data_obat`
--

INSERT INTO `tbl_data_obat` (`id_obat`, `nama_obat`, `satuan`, `status`) VALUES
(11, 'Acyclovir tab. 400 mg', 'Tablet', 'tersedia'),
(12, 'Albendazol tablet 400 mg', 'Tablet', 'tersedia'),
(13, 'Ambroxol sirup 15mg/60ml', 'Botol', 'tersedia'),
(14, 'Ambroxol tablet', 'Tablet', 'tersedia'),
(15, 'Aminofilina tablet 200 mg', 'Tablet', 'tersedia'),
(16, 'Amoksisilin sir forte 250 mg/5 ml', 'Botol', 'hapus'),
(17, 'Amoksisilin Sirup Kering 125 mg/5ml', 'Botol', 'hapus'),
(18, 'decolgen', 'tablet', 'hapus'),
(19, 'Ambroxol tabletnb', 'gram/dl', 'hapus');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data_stock_obat`
--

CREATE TABLE `tbl_data_stock_obat` (
  `id` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jumlah_penerimaan` int(11) NOT NULL,
  `tanggal_kadaluarsa` date NOT NULL,
  `pemakaian` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_data_stock_obat`
--

INSERT INTO `tbl_data_stock_obat` (`id`, `id_obat`, `tanggal_masuk`, `jumlah_penerimaan`, `tanggal_kadaluarsa`, `pemakaian`, `sisa`, `status`) VALUES
(6, 11, '2022-05-29', 50, '2024-01-31', 13, 37, 'tersedia'),
(7, 12, '2022-05-29', 50, '2024-02-24', 0, 50, 'tersedia'),
(8, 13, '2022-05-29', 50, '2024-03-30', 0, 50, 'tersedia'),
(9, 14, '2022-05-29', 50, '2024-04-24', 0, 50, 'tersedia'),
(10, 15, '2022-05-29', 50, '2024-05-05', 0, 50, 'tersedia'),
(11, 19, '2022-07-16', 50, '2022-05-05', 0, 50, 'tersedia'),
(13, 11, '2022-07-16', 50, '2022-04-21', 0, 50, 'hapus'),
(14, 11, '2022-07-16', 100, '2025-01-22', 0, 100, 'hapus'),
(15, 16, '2022-07-16', 50, '2022-01-22', 0, 50, 'hapus');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data_tindakan`
--

CREATE TABLE `tbl_data_tindakan` (
  `id_datatindakan` int(11) NOT NULL,
  `nama_tindakan` varchar(255) NOT NULL,
  `tarif` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_data_tindakan`
--

INSERT INTO `tbl_data_tindakan` (`id_datatindakan`, `nama_tindakan`, `tarif`) VALUES
(10, 'Jahit luka 1 s/d 5 jahitan per lokasi', '15000'),
(11, 'Jahit luka lebih dari 6-10 jahitan per lokasi', '20000'),
(12, 'Jahit luka lebih dari lebih dari 10 jahitan per lokasi', '30000'),
(13, 'Angkat jahitan 1 s/d 5 jahitan', '5000'),
(14, 'Angkat jahitan 1 s/d 5 jahitan', '10000'),
(15, 'Insisi', '10000'),
(16, 'Tindik per daun teling', '5000'),
(17, 'Repair per daun teling', '25000'),
(19, 'Insisi infeksi pada mata', '25000'),
(21, 'Layanan rawat jalan poli umum', '10000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_diagnosa_rm`
--

CREATE TABLE `tbl_diagnosa_rm` (
  `id_diagnosa` int(11) NOT NULL,
  `id_pemeriksaan` int(11) NOT NULL,
  `icd_x` varchar(50) NOT NULL,
  `nama_diagnosa` varchar(255) NOT NULL,
  `no_rm` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_diagnosa_rm`
--

INSERT INTO `tbl_diagnosa_rm` (`id_diagnosa`, `id_pemeriksaan`, `icd_x`, `nama_diagnosa`, `no_rm`, `status`) VALUES
(56, 116, 'A05.9', 'Keracunan makanan akibat bakteri yang tidak spesifik', '03.S000001.3', 'tersedia'),
(57, 117, 'A38', 'Demam berdarah', '03.A000001.7', 'tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ffs`
--

CREATE TABLE `tbl_ffs` (
  `nama_kk` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `desa` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kabupaten` varchar(100) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `foto_KK` blob DEFAULT NULL,
  `no_index` varchar(10) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ffs`
--

INSERT INTO `tbl_ffs` (`nama_kk`, `alamat`, `desa`, `kecamatan`, `kabupaten`, `telp`, `foto_KK`, `no_index`, `updated_at`, `created_at`) VALUES
('Adi Purwanto', 'RT 09 RW 04', 'Parakan', 'Trenggalek', 'Trenggalek', '081337712252', 0x2f696d616765732f313635333231323137372e706e67, '03.A000001', '', ''),
('Adi', 'RT 09 RW 04', 'Parakan', 'Trenggalek', 'Trenggalek', '081337712252', 0x2f696d616765732f313635363434373731302e706e67, '03.A000002', '2022-06-28 20:21:50', '2022-06-28 20:21:50'),
('Ali', 'RT 09 RW 04', 'Parakan', 'Trenggalek', 'Trenggalek', '081337712222', 0x2f696d616765732f313635363434373734392e706e67, '03.A000003', '2022-06-28 20:22:29', '2022-06-28 20:22:29'),
('Adi', 'RT 09 RW 04', 'Parakan', 'Trenggalek', 'Trenggalek', '081337712252', 0x2f696d616765732f313635383034363139382e706e67, '03.A000004', '2022-07-17 08:23:18', '2022-07-17 08:23:18'),
('Bagus', 'RT 09 RW 04', 'Parakan', 'Trenggalek', 'Trenggalek', '02894928427', 0x2f696d616765732f313635363434373737382e706e67, '03.B000001', '2022-06-28 20:22:58', '2022-06-28 20:22:58'),
('Bagas', 'RT 09 RW 04', 'Parakan', 'Trenggalek', 'Trenggalek', '081337712252', 0x2f696d616765732f313635363434373830352e706e67, '03.B000002', '2022-06-28 20:23:25', '2022-06-28 20:23:25'),
('Bayu', 'RT 09 RW 04', 'Parakan', 'Trenggalek', 'Trenggalek', '081337712252', 0x2f696d616765732f313635363434383134382e706e67, '03.B000003', '2022-06-28 20:29:08', '2022-06-28 20:29:08'),
('Nanana', 'RT 09 RW 04', 'Parakan', 'Trenggalek', 'Trenggalek', '081337712252', 0x2f696d616765732f313635373734343739362e6a7067, '03.N000001', '2022-07-13 20:39:56', '2022-07-13 20:39:56'),
('PengujianTest', 'RT 09 RW 04', 'Parakan', 'Trenggalek', 'Trenggalek', '081337712252', 0x2f696d616765732f313635363539393537302e706e67, '03.P000001', '2022-06-30 14:32:50', '2022-06-30 14:32:50'),
('Suliyandi', 'RT 09 RW 04', 'Parakan', 'Trenggalek', 'Trenggalek', '02894928427', 0x2f696d616765732f313635333231353536302e706e67, '03.S000001', '2022-05-22 10:32:40', '2022-05-22 10:32:40'),
('Ali Muhammad', 'RT 09 RW 04', 'Rejowinangun', 'Trenggalek', 'Trenggalek', '081337712252', 0x2f696d616765732f313635373734323735332e6a7067, '04.A000001', '2022-07-13 20:05:53', '2022-07-13 20:05:53'),
('Pengujian Test bukan Trenggalek', 'RT 09 RW 04', 'Parakan', 'Pogalan', 'Trenggalek', '081337712252', 0x2f696d616765732f313635363630303634352e706e67, '09.P000001', '2022-06-30 14:50:45', '2022-06-30 14:50:45'),
('Siakad', 'RT 09 RW 04', 'Parakan', 'Parakan', 'Trenggalek', '087362822344', 0x2f696d616765732f313635363339303632312e706e67, '09.S000001', '2022-06-28 04:30:22', '2022-06-28 04:30:22'),
('Xavier', 'RT 09 RW 04', 'Rejowinangun', 'Pogalan', 'Trenggalek', '081337712252', 0x2f696d616765732f313635363539383839342e706e67, '09.X000001', '2022-06-30 14:21:34', '2022-06-30 14:21:34'),
('Xajiku', 'RT 09 RW 04', 'Ngares', 'Pule', 'Trenggalek', '081337712252', 0x2f696d616765732f313635363539393130312e706e67, '09.X000002', '2022-06-30 14:25:01', '2022-06-30 14:25:01'),
('Pengujian Bukan Kec Trenggalek', 'RT 09 RW 04', 'Dawuhan', 'Pagak', 'Malang', '081337712252', 0x2f696d616765732f313635363630313139342e706e67, '10.P000001', '2022-06-30 14:59:54', '2022-06-30 14:59:54'),
('Suyono', 'RT 04 RW 06', 'Bono', 'Boyolangu', 'Tulungagung', '08976342521', 0x2f696d616765732f313635333231343735322e706e67, '10.S000001', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hasil_lab`
--

CREATE TABLE `tbl_hasil_lab` (
  `id_pemeriksaan_lab` int(11) NOT NULL,
  `id_pemeriksaan` int(11) NOT NULL,
  `id_nama_pemeriksaan` int(11) NOT NULL,
  `id_jenis_pemeriksaan` int(11) NOT NULL,
  `hasil_pemeriksaan_lab` float NOT NULL,
  `penanggung_jawab` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jamkes`
--

CREATE TABLE `tbl_jamkes` (
  `id_jamkes` int(11) NOT NULL,
  `singkatan_jamkes` varchar(255) NOT NULL,
  `nama_jamkes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jamkes`
--

INSERT INTO `tbl_jamkes` (`id_jamkes`, `singkatan_jamkes`, `nama_jamkes`) VALUES
(1, 'Umum', 'Umum'),
(2, 'BPJS', 'Badan Penyelenggara Jaminan Sosial'),
(3, 'SKTM', 'Surat Keterangan Tidak Mampu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_dokter`
--

CREATE TABLE `tbl_jenis_dokter` (
  `id_jenis_dokter` int(11) NOT NULL,
  `jenis_dokter` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jenis_dokter`
--

INSERT INTO `tbl_jenis_dokter` (`id_jenis_dokter`, `jenis_dokter`, `status`) VALUES
(4, 'Hematologi', 'tersedia'),
(5, 'Kimia Klinik', 'tersedia'),
(6, 'Urin', 'tersedia'),
(7, 'Imunologi', 'tersedia'),
(8, 'Kimia Klinik', 'hapus'),
(9, 'Imunologi', 'hapus');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_pemeriksaan`
--

CREATE TABLE `tbl_jenis_pemeriksaan` (
  `id_jenis_pemeriksaan` int(11) NOT NULL,
  `jenis_pemeriksaan` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jenis_pemeriksaan`
--

INSERT INTO `tbl_jenis_pemeriksaan` (`id_jenis_pemeriksaan`, `jenis_pemeriksaan`, `status`) VALUES
(10, 'Hematologi', 'tersedia'),
(11, 'Hitung Jenis', 'tersedia'),
(12, 'a', 'hapus');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nama_pemeriksaan`
--

CREATE TABLE `tbl_nama_pemeriksaan` (
  `id_nama_pemeriksaan` int(11) NOT NULL,
  `id_jenis_pemeriksaan` int(11) NOT NULL,
  `nama_pemeriksaan` varchar(225) NOT NULL,
  `nilai_normal` varchar(225) DEFAULT NULL,
  `satuan` varchar(225) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_nama_pemeriksaan`
--

INSERT INTO `tbl_nama_pemeriksaan` (`id_nama_pemeriksaan`, `id_jenis_pemeriksaan`, `nama_pemeriksaan`, `nilai_normal`, `satuan`, `status`) VALUES
(34, 10, 'HB', 'L(12-18) || P(11-16)', 'gram/dl', 'tersedia'),
(35, 10, 'LECO', 'L(4000-10000) || P(4000-10000)', 'ml', 'tersedia'),
(36, 10, 'ERY', 'L(2-5) || P(2-5)', 'Jt/ml', 'tersedia'),
(37, 10, 'HTC', 'L(35-47) || P(35-45)', '%', 'tersedia'),
(38, 11, 'Basofil', '0-1', '-', 'tersedia'),
(41, 11, 'Eos', '1-3', '-', 'tersedia'),
(42, 10, 'HB', 'a', 'gram/dl', 'hapus');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemeriksaan_dokter`
--

CREATE TABLE `tbl_pemeriksaan_dokter` (
  `id` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_nama` int(11) NOT NULL,
  `id_data_laborat_dokter` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pemeriksaan_dokter`
--

INSERT INTO `tbl_pemeriksaan_dokter` (`id`, `id_jenis`, `id_nama`, `id_data_laborat_dokter`, `status`) VALUES
(34, 4, 34, 23, ''),
(35, 4, 35, 23, ''),
(36, 4, 36, 23, ''),
(41, 4, 34, 22, ''),
(42, 4, 37, 23, ''),
(45, 4, 34, 26, ''),
(46, 4, 35, 26, ''),
(47, 4, 36, 26, ''),
(49, 4, 34, 27, ''),
(50, 4, 35, 27, ''),
(51, 4, 36, 27, ''),
(52, 4, 37, 27, ''),
(53, 4, 38, 27, ''),
(54, 4, 41, 27, ''),
(55, 4, 34, 28, ''),
(56, 4, 35, 28, ''),
(57, 4, 36, 28, ''),
(58, 4, 37, 28, ''),
(59, 4, 38, 28, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemeriksaan_rm`
--

CREATE TABLE `tbl_pemeriksaan_rm` (
  `id_pemeriksaan_objek` int(11) NOT NULL,
  `id_pemeriksaan` int(11) NOT NULL,
  `tinggi_badan` int(11) NOT NULL,
  `berat_badan` int(11) NOT NULL,
  `imt` float NOT NULL,
  `suhu` float NOT NULL,
  `rr` int(11) NOT NULL,
  `sistol` int(11) NOT NULL,
  `diastol` int(11) NOT NULL,
  `no_rm` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pemeriksaan_rm`
--

INSERT INTO `tbl_pemeriksaan_rm` (`id_pemeriksaan_objek`, `id_pemeriksaan`, `tinggi_badan`, `berat_badan`, `imt`, `suhu`, `rr`, `sistol`, `diastol`, `no_rm`) VALUES
(56, 115, 160, 50, 19.5, 37.5, 20, 110, 100, '03.A000001.1'),
(57, 116, 160, 50, 19.5, 37.5, 20, 110, 100, '03.S000001.3'),
(58, 117, 160, 50, 19.5, 37.5, 20, 110, 100, '03.A000001.7');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendaftarans`
--

CREATE TABLE `tbl_pendaftarans` (
  `id` int(11) NOT NULL,
  `no_antrian` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_rm` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `tipe_kunjungan` varchar(50) NOT NULL,
  `poli_yang_dituju` varchar(50) NOT NULL,
  `waktu_pelayanan` time NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pendaftarans`
--

INSERT INTO `tbl_pendaftarans` (`id`, `no_antrian`, `nama`, `no_rm`, `tanggal`, `tipe_kunjungan`, `poli_yang_dituju`, `waktu_pelayanan`, `updated_at`, `created_at`) VALUES
(155, 'A 00 2', 'Adi Purwanto', '03.A000001.1', '2022-07-17', 'Baru', 'Poli Umum', '15:20:28', '2022-07-17 15:20:28', '2022-07-17 15:20:28'),
(156, 'A 00 3', 'Faro', '03.S000001.3', '2022-07-17', 'Baru', 'Poli Umum', '15:20:52', '2022-07-17 15:20:52', '2022-07-17 15:20:52'),
(157, 'A 0 11', 'Dhafa Maulana Alkanza Putra', '03.A000001.7', '2022-07-17', 'Baru', 'Poli Umum', '15:21:14', '2022-07-17 15:21:14', '2022-07-17 15:21:14'),
(158, 'A 00 1', 'Nur Anisa', '10.S000001.3', '2022-07-17', 'Baru', 'Poli Umum', '15:21:47', '2022-07-17 15:21:47', '2022-07-17 15:21:47'),
(159, 'A 00 4', 'Threecia Agil Regitasari', '03.A000001.3', '2022-07-17', 'Baru', 'Poli Umum', '15:33:52', '2022-07-17 15:33:52', '2022-07-17 15:33:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `no_hp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`id`, `full_name`, `username`, `password`, `email`, `role_id`, `no_hp`) VALUES
(1, 'Yulia (pendaftaran)', 'pendaftaran', '12345678', 'Yulia@gmail.com', 2, '081333444555'),
(3, 'nisa (dokter)', 'dokter1', '1234568', 'cian@gmail.com', 3, '089333344556'),
(5, 'martha (laborat)', 'laborat', '12345678', 'cianyyyyy@gmail.com', 5, '082343444755'),
(7, 'dima (kasir)', 'kasir', '12345678', 'cian@gmail.com', 6, '081396424455'),
(14, 'beuty (farmasi)', 'farmasi1', '12345678', 'nuranisa290@yahoo.com', 7, '082373449535'),
(17, 'Jean (perawat)', 'perawat1', '12345678', 'jeanr@gmail.com', 4, '089674345623'),
(56, 'Ifan(kasir)', 'kasir2', '12345678', 'ifan@gmail.com', 6, '081234575322'),
(58, 'Ifa(admin)', 'admin', '12345678', 'ifa@gmail.com', 1, '081345234789');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penyuluhan`
--

CREATE TABLE `tbl_penyuluhan` (
  `id_penyuluhan` int(11) NOT NULL,
  `isi_penyuluhan` varchar(250) DEFAULT NULL,
  `no_rm` varchar(250) NOT NULL,
  `id_pemeriksaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_penyuluhan`
--

INSERT INTO `tbl_penyuluhan` (`id_penyuluhan`, `isi_penyuluhan`, `no_rm`, `id_pemeriksaan`) VALUES
(55, NULL, '03.S000001.3', 116),
(56, NULL, '03.A000001.7', 117),
(57, NULL, '03.A000001.7', 117);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permintaanlab`
--

CREATE TABLE `tbl_permintaanlab` (
  `id_permintaan` int(11) NOT NULL,
  `id_pemeriksaan` int(11) NOT NULL,
  `id_data_laborat_dokter` int(11) NOT NULL,
  `status_permintaan` varchar(25) NOT NULL,
  `waktu` varchar(25) NOT NULL,
  `tanggal` varchar(25) NOT NULL,
  `dokter_penanggungjawab` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_permintaanlab`
--

INSERT INTO `tbl_permintaanlab` (`id_permintaan`, `id_pemeriksaan`, `id_data_laborat_dokter`, `status_permintaan`, `waktu`, `tanggal`, `dokter_penanggungjawab`) VALUES
(56, 115, 23, 'Baru', '09:03:04', '2022-07-17', 'nisa (dokter)');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_poli`
--

CREATE TABLE `tbl_poli` (
  `id` int(11) NOT NULL,
  `kode_poli` varchar(255) NOT NULL,
  `nama_poli` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_poli`
--

INSERT INTO `tbl_poli` (`id`, `kode_poli`, `nama_poli`) VALUES
(1, 'A', 'Poli Umum');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rekam_medis`
--

CREATE TABLE `tbl_rekam_medis` (
  `id_pemeriksaan` int(11) NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_selesai` datetime NOT NULL,
  `dokter_penanggung_jawab` varchar(255) DEFAULT NULL,
  `perawat_penanggung_jawab` varchar(255) DEFAULT NULL,
  `no_rm` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rekam_medis`
--

INSERT INTO `tbl_rekam_medis` (`id_pemeriksaan`, `tanggal_kunjungan`, `waktu_mulai`, `waktu_selesai`, `dokter_penanggung_jawab`, `perawat_penanggung_jawab`, `no_rm`) VALUES
(115, '2022-07-17', '2022-07-17 15:20:28', '2022-07-17 15:20:28', 'nisa (dokter)', 'Jean (perawat)', '03.A000001.1'),
(116, '2022-07-17', '2022-07-17 15:20:52', '2022-07-17 21:20:24', 'nisa (dokter)', 'Jean (perawat)', '03.S000001.3'),
(117, '2022-07-17', '2022-07-17 15:21:14', '2022-07-17 21:42:52', 'nisa (dokter)', 'Jean (perawat)', '03.A000001.7'),
(118, '2022-07-17', '2022-07-17 15:21:47', '2022-07-17 15:21:47', NULL, NULL, '10.S000001.3'),
(119, '2022-07-17', '2022-07-17 15:33:52', '2022-07-17 15:33:52', NULL, NULL, '03.A000001.3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resep_obat`
--

CREATE TABLE `tbl_resep_obat` (
  `id_resep` int(11) NOT NULL,
  `id_pemeriksaan` int(11) NOT NULL,
  `jenis_resep` varchar(50) NOT NULL,
  `signa` varchar(50) NOT NULL,
  `aturan_pakai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_resep_obat`
--

INSERT INTO `tbl_resep_obat` (`id_resep`, `id_pemeriksaan`, `jenis_resep`, `signa`, `aturan_pakai`) VALUES
(160, 116, 'Jadi', '3x1', 'Setelah makan'),
(161, 116, 'Racikan', '3x1', 'Setelah makan'),
(162, 117, 'Jadi', '3x1', 'Setelah makan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resep_obats`
--

CREATE TABLE `tbl_resep_obats` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_resep` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `id_obat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_resep_obats`
--

INSERT INTO `tbl_resep_obats` (`id`, `nama_obat`, `jumlah`, `id_resep`, `status`, `id_obat`) VALUES
(135, 'Acyclovir tab. 400 mg', 1, 160, 'tersedia', 11),
(136, 'Ambroxol tablet', 2, 161, 'tersedia', 11),
(137, 'Albendazol tablet 400 mg', 1, 161, 'tersedia', 12),
(138, 'Ambroxol sirup 15mg/60ml', 1, 162, 'tersedia', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tindakan_rm`
--

CREATE TABLE `tbl_tindakan_rm` (
  `id_tindakan` int(11) NOT NULL,
  `id_pemeriksaan` int(11) NOT NULL,
  `tindakan` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `waktu_tindakan` datetime NOT NULL,
  `status` varchar(225) NOT NULL,
  `penanggung_jawab` varchar(225) NOT NULL,
  `no_rm` varchar(50) NOT NULL,
  `perawat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tindakan_rm`
--

INSERT INTO `tbl_tindakan_rm` (`id_tindakan`, `id_pemeriksaan`, `tindakan`, `keterangan`, `waktu_tindakan`, `status`, `penanggung_jawab`, `no_rm`, `perawat`) VALUES
(34, 117, 'Layanan rawat jalan poli umum', '-', '2022-07-17 00:00:00', '', 'nisa (dokter)', '03.A000001.7', 'Jean (perawat)');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_role`
--

CREATE TABLE `tbl_user_role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`role_id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Pendaftaran'),
(3, 'Dokter'),
(4, 'Perawat'),
(5, 'Laboratorium'),
(6, 'Kasir'),
(7, 'Farmasi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_rm` (`no_rm`,`id_pemeriksaan`),
  ADD KEY `id_pemeriksaan` (`id_pemeriksaan`);

--
-- Indexes for table `tbl_anamnesa_rm`
--
ALTER TABLE `tbl_anamnesa_rm`
  ADD PRIMARY KEY (`id_anamnesa`),
  ADD KEY `id_pemeriksaan` (`id_pemeriksaan`);

--
-- Indexes for table `tbl_antrian_farmasi`
--
ALTER TABLE `tbl_antrian_farmasi`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `no_rm` (`no_rm`);

--
-- Indexes for table `tbl_antrian_kasir`
--
ALTER TABLE `tbl_antrian_kasir`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `no_rm` (`no_rm`);

--
-- Indexes for table `tbl_antrian_laboratorium`
--
ALTER TABLE `tbl_antrian_laboratorium`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `no_rm` (`no_rm`);

--
-- Indexes for table `tbl_antrian_poli_umums`
--
ALTER TABLE `tbl_antrian_poli_umums`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `no_rm` (`no_rm`);

--
-- Indexes for table `tbl_antri_pendaftaran`
--
ALTER TABLE `tbl_antri_pendaftaran`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `tbl_asuhan_keperawatan`
--
ALTER TABLE `tbl_asuhan_keperawatan`
  ADD PRIMARY KEY (`id_askep`),
  ADD KEY `id_pemeriksaan` (`id_pemeriksaan`);

--
-- Indexes for table `tbl_asuransi`
--
ALTER TABLE `tbl_asuransi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_datapasiens`
--
ALTER TABLE `tbl_datapasiens`
  ADD PRIMARY KEY (`no_rm`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `no_index` (`no_index`);

--
-- Indexes for table `tbl_data_icdx`
--
ALTER TABLE `tbl_data_icdx`
  ADD PRIMARY KEY (`icd_x`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tbl_data_laborat_dokter`
--
ALTER TABLE `tbl_data_laborat_dokter`
  ADD PRIMARY KEY (`id_data_laborat_dokter`),
  ADD KEY `tbl_data_laborat_dokter_ibfk_1` (`id_jenis`);

--
-- Indexes for table `tbl_data_obat`
--
ALTER TABLE `tbl_data_obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `tbl_data_stock_obat`
--
ALTER TABLE `tbl_data_stock_obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `tbl_data_tindakan`
--
ALTER TABLE `tbl_data_tindakan`
  ADD PRIMARY KEY (`id_datatindakan`);

--
-- Indexes for table `tbl_diagnosa_rm`
--
ALTER TABLE `tbl_diagnosa_rm`
  ADD PRIMARY KEY (`id_diagnosa`),
  ADD KEY `id_pemeriksaan` (`id_pemeriksaan`);

--
-- Indexes for table `tbl_ffs`
--
ALTER TABLE `tbl_ffs`
  ADD PRIMARY KEY (`no_index`);

--
-- Indexes for table `tbl_hasil_lab`
--
ALTER TABLE `tbl_hasil_lab`
  ADD PRIMARY KEY (`id_pemeriksaan_lab`),
  ADD KEY `id_pemeriksaan` (`id_pemeriksaan`),
  ADD KEY `id_nama_pemeriksaan` (`id_nama_pemeriksaan`),
  ADD KEY `id_jenis_pemeriksaan` (`id_jenis_pemeriksaan`);

--
-- Indexes for table `tbl_jamkes`
--
ALTER TABLE `tbl_jamkes`
  ADD PRIMARY KEY (`id_jamkes`);

--
-- Indexes for table `tbl_jenis_dokter`
--
ALTER TABLE `tbl_jenis_dokter`
  ADD PRIMARY KEY (`id_jenis_dokter`);

--
-- Indexes for table `tbl_jenis_pemeriksaan`
--
ALTER TABLE `tbl_jenis_pemeriksaan`
  ADD PRIMARY KEY (`id_jenis_pemeriksaan`);

--
-- Indexes for table `tbl_nama_pemeriksaan`
--
ALTER TABLE `tbl_nama_pemeriksaan`
  ADD PRIMARY KEY (`id_nama_pemeriksaan`),
  ADD KEY `id_jenis_pemeriksaan` (`id_jenis_pemeriksaan`);

--
-- Indexes for table `tbl_pemeriksaan_dokter`
--
ALTER TABLE `tbl_pemeriksaan_dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jenis` (`id_jenis`),
  ADD KEY `id_nama` (`id_nama`),
  ADD KEY `id_data_laborat_dokter` (`id_data_laborat_dokter`);

--
-- Indexes for table `tbl_pemeriksaan_rm`
--
ALTER TABLE `tbl_pemeriksaan_rm`
  ADD PRIMARY KEY (`id_pemeriksaan_objek`),
  ADD KEY `id_pemeriksaan` (`id_pemeriksaan`);

--
-- Indexes for table `tbl_pendaftarans`
--
ALTER TABLE `tbl_pendaftarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_rm` (`no_rm`);

--
-- Indexes for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `tbl_penyuluhan`
--
ALTER TABLE `tbl_penyuluhan`
  ADD PRIMARY KEY (`id_penyuluhan`),
  ADD KEY `no_rm` (`no_rm`),
  ADD KEY `id_pemeriksaan` (`id_pemeriksaan`);

--
-- Indexes for table `tbl_permintaanlab`
--
ALTER TABLE `tbl_permintaanlab`
  ADD PRIMARY KEY (`id_permintaan`),
  ADD KEY `id_pemeriksaan` (`id_pemeriksaan`),
  ADD KEY `id_data_laborat_dokter` (`id_data_laborat_dokter`);

--
-- Indexes for table `tbl_poli`
--
ALTER TABLE `tbl_poli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rekam_medis`
--
ALTER TABLE `tbl_rekam_medis`
  ADD PRIMARY KEY (`id_pemeriksaan`),
  ADD KEY `no_rm` (`no_rm`);

--
-- Indexes for table `tbl_resep_obat`
--
ALTER TABLE `tbl_resep_obat`
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `id_pemeriksaan` (`id_pemeriksaan`);

--
-- Indexes for table `tbl_resep_obats`
--
ALTER TABLE `tbl_resep_obats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_resep` (`id_resep`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `tbl_tindakan_rm`
--
ALTER TABLE `tbl_tindakan_rm`
  ADD PRIMARY KEY (`id_tindakan`),
  ADD KEY `id_pemeriksaan` (`id_pemeriksaan`);

--
-- Indexes for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kasir`
--
ALTER TABLE `kasir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_anamnesa_rm`
--
ALTER TABLE `tbl_anamnesa_rm`
  MODIFY `id_anamnesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tbl_antrian_farmasi`
--
ALTER TABLE `tbl_antrian_farmasi`
  MODIFY `id_antrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_antrian_kasir`
--
ALTER TABLE `tbl_antrian_kasir`
  MODIFY `id_antrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100000036;

--
-- AUTO_INCREMENT for table `tbl_antrian_laboratorium`
--
ALTER TABLE `tbl_antrian_laboratorium`
  MODIFY `id_antrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100000020;

--
-- AUTO_INCREMENT for table `tbl_antrian_poli_umums`
--
ALTER TABLE `tbl_antrian_poli_umums`
  MODIFY `id_antrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100000100;

--
-- AUTO_INCREMENT for table `tbl_antri_pendaftaran`
--
ALTER TABLE `tbl_antri_pendaftaran`
  MODIFY `id_antrian` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100000292;

--
-- AUTO_INCREMENT for table `tbl_asuhan_keperawatan`
--
ALTER TABLE `tbl_asuhan_keperawatan`
  MODIFY `id_askep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `tbl_asuransi`
--
ALTER TABLE `tbl_asuransi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_datapasiens`
--
ALTER TABLE `tbl_datapasiens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `tbl_data_icdx`
--
ALTER TABLE `tbl_data_icdx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_data_laborat_dokter`
--
ALTER TABLE `tbl_data_laborat_dokter`
  MODIFY `id_data_laborat_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_data_obat`
--
ALTER TABLE `tbl_data_obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_data_stock_obat`
--
ALTER TABLE `tbl_data_stock_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_data_tindakan`
--
ALTER TABLE `tbl_data_tindakan`
  MODIFY `id_datatindakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_diagnosa_rm`
--
ALTER TABLE `tbl_diagnosa_rm`
  MODIFY `id_diagnosa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_hasil_lab`
--
ALTER TABLE `tbl_hasil_lab`
  MODIFY `id_pemeriksaan_lab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tbl_jamkes`
--
ALTER TABLE `tbl_jamkes`
  MODIFY `id_jamkes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_jenis_dokter`
--
ALTER TABLE `tbl_jenis_dokter`
  MODIFY `id_jenis_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_jenis_pemeriksaan`
--
ALTER TABLE `tbl_jenis_pemeriksaan`
  MODIFY `id_jenis_pemeriksaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_nama_pemeriksaan`
--
ALTER TABLE `tbl_nama_pemeriksaan`
  MODIFY `id_nama_pemeriksaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_pemeriksaan_dokter`
--
ALTER TABLE `tbl_pemeriksaan_dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tbl_pemeriksaan_rm`
--
ALTER TABLE `tbl_pemeriksaan_rm`
  MODIFY `id_pemeriksaan_objek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_pendaftarans`
--
ALTER TABLE `tbl_pendaftarans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_penyuluhan`
--
ALTER TABLE `tbl_penyuluhan`
  MODIFY `id_penyuluhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_permintaanlab`
--
ALTER TABLE `tbl_permintaanlab`
  MODIFY `id_permintaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tbl_poli`
--
ALTER TABLE `tbl_poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_rekam_medis`
--
ALTER TABLE `tbl_rekam_medis`
  MODIFY `id_pemeriksaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `tbl_resep_obat`
--
ALTER TABLE `tbl_resep_obat`
  MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `tbl_resep_obats`
--
ALTER TABLE `tbl_resep_obats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `tbl_tindakan_rm`
--
ALTER TABLE `tbl_tindakan_rm`
  MODIFY `id_tindakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kasir`
--
ALTER TABLE `kasir`
  ADD CONSTRAINT `kasir_ibfk_1` FOREIGN KEY (`id_pemeriksaan`) REFERENCES `tbl_rekam_medis` (`id_pemeriksaan`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_anamnesa_rm`
--
ALTER TABLE `tbl_anamnesa_rm`
  ADD CONSTRAINT `tbl_anamnesa_rm_ibfk_1` FOREIGN KEY (`id_pemeriksaan`) REFERENCES `tbl_rekam_medis` (`id_pemeriksaan`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_asuhan_keperawatan`
--
ALTER TABLE `tbl_asuhan_keperawatan`
  ADD CONSTRAINT `tbl_asuhan_keperawatan_ibfk_1` FOREIGN KEY (`id_pemeriksaan`) REFERENCES `tbl_rekam_medis` (`id_pemeriksaan`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_datapasiens`
--
ALTER TABLE `tbl_datapasiens`
  ADD CONSTRAINT `tbl_datapasiens_ibfk_1` FOREIGN KEY (`no_index`) REFERENCES `tbl_ffs` (`no_index`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_data_laborat_dokter`
--
ALTER TABLE `tbl_data_laborat_dokter`
  ADD CONSTRAINT `tbl_data_laborat_dokter_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `tbl_jenis_dokter` (`id_jenis_dokter`);

--
-- Constraints for table `tbl_data_stock_obat`
--
ALTER TABLE `tbl_data_stock_obat`
  ADD CONSTRAINT `tbl_data_stock_obat_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `tbl_data_obat` (`id_obat`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_diagnosa_rm`
--
ALTER TABLE `tbl_diagnosa_rm`
  ADD CONSTRAINT `tbl_diagnosa_rm_ibfk_1` FOREIGN KEY (`id_pemeriksaan`) REFERENCES `tbl_rekam_medis` (`id_pemeriksaan`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_hasil_lab`
--
ALTER TABLE `tbl_hasil_lab`
  ADD CONSTRAINT `tbl_hasil_lab_ibfk_1` FOREIGN KEY (`id_pemeriksaan`) REFERENCES `tbl_rekam_medis` (`id_pemeriksaan`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_hasil_lab_ibfk_2` FOREIGN KEY (`id_jenis_pemeriksaan`) REFERENCES `tbl_jenis_dokter` (`id_jenis_dokter`),
  ADD CONSTRAINT `tbl_hasil_lab_ibfk_3` FOREIGN KEY (`id_nama_pemeriksaan`) REFERENCES `tbl_nama_pemeriksaan` (`id_nama_pemeriksaan`);

--
-- Constraints for table `tbl_nama_pemeriksaan`
--
ALTER TABLE `tbl_nama_pemeriksaan`
  ADD CONSTRAINT `tbl_nama_pemeriksaan_ibfk_1` FOREIGN KEY (`id_jenis_pemeriksaan`) REFERENCES `tbl_jenis_pemeriksaan` (`id_jenis_pemeriksaan`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_pemeriksaan_dokter`
--
ALTER TABLE `tbl_pemeriksaan_dokter`
  ADD CONSTRAINT `tbl_pemeriksaan_dokter_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `tbl_jenis_dokter` (`id_jenis_dokter`),
  ADD CONSTRAINT `tbl_pemeriksaan_dokter_ibfk_2` FOREIGN KEY (`id_nama`) REFERENCES `tbl_nama_pemeriksaan` (`id_nama_pemeriksaan`),
  ADD CONSTRAINT `tbl_pemeriksaan_dokter_ibfk_3` FOREIGN KEY (`id_data_laborat_dokter`) REFERENCES `tbl_data_laborat_dokter` (`id_data_laborat_dokter`);

--
-- Constraints for table `tbl_pemeriksaan_rm`
--
ALTER TABLE `tbl_pemeriksaan_rm`
  ADD CONSTRAINT `tbl_pemeriksaan_rm_ibfk_1` FOREIGN KEY (`id_pemeriksaan`) REFERENCES `tbl_rekam_medis` (`id_pemeriksaan`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD CONSTRAINT `tbl_pengguna_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tbl_user_role` (`role_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_penyuluhan`
--
ALTER TABLE `tbl_penyuluhan`
  ADD CONSTRAINT `tbl_penyuluhan_ibfk_1` FOREIGN KEY (`no_rm`) REFERENCES `tbl_datapasiens` (`no_rm`),
  ADD CONSTRAINT `tbl_penyuluhan_ibfk_2` FOREIGN KEY (`id_pemeriksaan`) REFERENCES `tbl_asuhan_keperawatan` (`id_pemeriksaan`);

--
-- Constraints for table `tbl_permintaanlab`
--
ALTER TABLE `tbl_permintaanlab`
  ADD CONSTRAINT `tbl_permintaanlab_ibfk_1` FOREIGN KEY (`id_pemeriksaan`) REFERENCES `tbl_rekam_medis` (`id_pemeriksaan`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_permintaanlab_ibfk_2` FOREIGN KEY (`id_data_laborat_dokter`) REFERENCES `tbl_data_laborat_dokter` (`id_data_laborat_dokter`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_resep_obat`
--
ALTER TABLE `tbl_resep_obat`
  ADD CONSTRAINT `tbl_resep_obat_ibfk_1` FOREIGN KEY (`id_pemeriksaan`) REFERENCES `tbl_rekam_medis` (`id_pemeriksaan`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_resep_obats`
--
ALTER TABLE `tbl_resep_obats`
  ADD CONSTRAINT `tbl_resep_obats_ibfk_1` FOREIGN KEY (`id_resep`) REFERENCES `tbl_resep_obat` (`id_resep`);

--
-- Constraints for table `tbl_tindakan_rm`
--
ALTER TABLE `tbl_tindakan_rm`
  ADD CONSTRAINT `tbl_tindakan_rm_ibfk_1` FOREIGN KEY (`id_pemeriksaan`) REFERENCES `tbl_rekam_medis` (`id_pemeriksaan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
