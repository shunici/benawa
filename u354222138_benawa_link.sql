-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 01, 2023 at 01:59 PM
-- Server version: 10.5.16-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u354222138_benawa_link`
--

-- --------------------------------------------------------

--
-- Table structure for table `agendas`
--

CREATE TABLE `agendas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warna` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `papan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posisi` int(11) DEFAULT NULL,
  `estimasi` timestamp NULL DEFAULT NULL,
  `foto` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user1` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user2` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voiceText` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_detail` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detil` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bgColor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posisi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimasi` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bahans`
--

CREATE TABLE `bahans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_alias` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `panjang` smallint(6) DEFAULT NULL,
  `lebar` smallint(6) DEFAULT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cm',
  `uk_alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_bahan` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahans`
--

INSERT INTO `bahans` (`id`, `nama_alias`, `nama`, `panjang`, `lebar`, `satuan`, `uk_alias`, `kategori`, `keterangan`, `info_bahan`, `created_at`, `updated_at`) VALUES
(8, 'spanduk', 'fr280', NULL, NULL, 'cm', NULL, 'outdoor', NULL, '<p>spanduk bisa pake bahan fr280 atau bahan korcin</p><ul data-checked=\"false\"><li>bahan korcin</li><li>bahan korcin</li><li>bahan korcin</li></ul><ul><li>bahan korcin</li><li>bahan korcin</li><li>bahan korcin</li></ul>', NULL, '2023-01-16 05:08:49'),
(10, 'ap260', 'ap260', NULL, NULL, 'cm', 'A3', 'offset', NULL, NULL, NULL, NULL),
(11, 'korcin', 'korcin', NULL, NULL, 'cm', NULL, 'outdoor', NULL, NULL, NULL, NULL),
(12, 'ap tebal', 'ap260', NULL, NULL, 'cm', 'A3', 'offset', NULL, NULL, NULL, '2022-08-17 00:46:33'),
(13, 'vynil bening', 'Transparan', NULL, NULL, 'cm', 'A3', 'offset', NULL, NULL, NULL, NULL),
(14, 'mug', '-mug', 20, 7, 'cm', NULL, 'offset', NULL, NULL, NULL, '2022-08-18 08:15:34'),
(15, 'krcin', 'korcin', NULL, NULL, 'cm', NULL, 'outdoor', NULL, NULL, NULL, NULL),
(16, 'korea', 'korcin', NULL, NULL, 'cm', NULL, 'outdoor', NULL, NULL, NULL, NULL),
(17, 'graptak', 'graptak', NULL, NULL, 'cm', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'graftact', 'graptak', NULL, NULL, 'cm', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'graftack', 'graptak', NULL, NULL, 'cm', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'ap 260', 'ap260', NULL, NULL, 'cm', 'A3+', 'offset', NULL, NULL, NULL, NULL),
(21, 'art paper', '-', NULL, NULL, 'cm', 'a3+', 'offset', NULL, NULL, NULL, NULL),
(22, 'ap150', 'ap150', NULL, NULL, 'cm', 'A3+', 'offset', NULL, NULL, NULL, NULL),
(23, 'ap 150', 'AP150', NULL, NULL, 'cm', 'A3+', 'offset', NULL, NULL, NULL, NULL),
(24, 'AP260g', 'AP260', NULL, NULL, 'cm', 'A3+', 'offset', NULL, NULL, NULL, NULL),
(25, 'albatros', 'ALBATROS', NULL, NULL, 'cm', NULL, 'indoor', NULL, NULL, NULL, NULL),
(26, 'ALBTROS', 'ALBATROS', NULL, NULL, 'cm', NULL, 'indoor', NULL, NULL, NULL, NULL),
(27, 'bontak', 'BONTAK', NULL, NULL, 'cm', 'A3+', 'offset', NULL, NULL, NULL, NULL),
(28, 'bontaks', 'BONTAK', NULL, NULL, 'cm', 'A3+', NULL, NULL, NULL, NULL, NULL),
(29, 'bontax', 'BONTAK', NULL, NULL, 'cm', 'A3+', 'offset', NULL, NULL, NULL, NULL),
(30, 'id card', 'pvc id card', NULL, NULL, 'cm', '9 x 6 cm', NULL, '2 sisi', NULL, NULL, NULL),
(31, 'print only', 'print only', NULL, NULL, 'cm', 'A3+', 'offset', NULL, NULL, NULL, '2023-01-16 05:10:25'),
(32, 'backlite', 'BACKLITE', NULL, NULL, 'cm', NULL, 'outdoor', NULL, NULL, NULL, NULL),
(33, NULL, 'BACKLITE', NULL, NULL, 'cm', NULL, 'outdoor', NULL, NULL, NULL, NULL),
(34, 'vinil', 'VYNIL', NULL, NULL, 'cm', 'A3+', 'offset', NULL, NULL, NULL, NULL),
(35, 'vinyl', 'VINYL', NULL, NULL, 'cm', 'A3+', 'offset', NULL, NULL, NULL, NULL),
(36, 'albtros', 'ALBATROS', NULL, NULL, 'cm', NULL, 'indoor', NULL, NULL, NULL, '2023-01-20 01:16:45'),
(37, 'albatros', 'ALBATROS', NULL, NULL, 'cm', NULL, 'indoor', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `data_spks`
--

CREATE TABLE `data_spks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_brg` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bahan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ukuranP` int(11) DEFAULT NULL,
  `ukuranL` int(11) DEFAULT NULL,
  `uk_alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `satuan` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fns` tinyint(1) DEFAULT 0,
  `ls` tinyint(1) DEFAULT 0,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_spks`
--

INSERT INTO `data_spks` (`id`, `nama_brg`, `bahan`, `ukuranP`, `ukuranL`, `uk_alias`, `qty`, `satuan`, `fns`, `ls`, `kategori`, `ket`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, 'spanduks', 'FR280', NULL, NULL, NULL, 1, 'cm', 1, 0, 'outdoor', 'MA', NULL, NULL, '2022-08-18 09:45:45'),
(3, 'spanduk Korcin', 'Korcin', NULL, NULL, NULL, 1, 'cm', 1, 0, 'outdoor', 'Finishing MA', NULL, NULL, NULL),
(7, 'GRAPTAK IND', 'GRAPTAK IND', NULL, NULL, NULL, 1, NULL, 0, 0, 'indoor', NULL, NULL, NULL, '2023-01-23 04:27:31'),
(8, 'mug', NULL, 20, 8, NULL, NULL, NULL, 0, 0, 'merchandise', 'mug', NULL, NULL, NULL),
(9, 'cetak', 'ap260', NULL, NULL, 'a3', NULL, NULL, 0, 0, 'offset', NULL, NULL, NULL, '2023-01-17 03:41:11'),
(10, 'cetak satin', 'satin', NULL, NULL, NULL, NULL, 'cm', 1, 0, 'outdoor', NULL, NULL, NULL, '2023-01-16 01:29:51'),
(11, 'stiker skotilte', 'skotlite', NULL, NULL, NULL, NULL, NULL, 0, 0, 'indoor', NULL, NULL, NULL, NULL),
(12, 'hologram', 'hologram', NULL, NULL, NULL, NULL, NULL, 0, 0, 'indoor', NULL, NULL, NULL, NULL),
(13, 'oracel', 'Oracel', NULL, NULL, NULL, NULL, NULL, 0, 0, 'indoor', NULL, NULL, NULL, NULL),
(14, 'graptak out', 'GRAPTAK OUT', NULL, NULL, NULL, NULL, NULL, 0, 0, 'outdoor', NULL, NULL, NULL, NULL),
(15, 'SP LS', 'FR280', NULL, NULL, NULL, NULL, NULL, 0, 1, 'outdoor', NULL, NULL, NULL, NULL),
(16, 'AP150', 'AP150', NULL, NULL, 'A3+', NULL, NULL, 0, 0, 'offset', NULL, NULL, NULL, NULL),
(17, 'BONTAK', 'BONTAK', NULL, NULL, NULL, NULL, NULL, 0, 0, 'offset', NULL, NULL, NULL, NULL),
(18, 'vinil', 'VINYL', NULL, NULL, 'A3+', NULL, NULL, 0, 0, 'offset', NULL, NULL, NULL, NULL),
(19, 'cetak oneway', 'ONEWAY', NULL, NULL, NULL, NULL, NULL, 0, 0, 'outdoor', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `infos`
--

CREATE TABLE `infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `infos`
--

INSERT INTO `infos` (`id`, `deskripsi`, `created_at`, `updated_at`) VALUES
(11, '<p>mlm tadi, aku bermimpi dengan wanita sementara blacky menganggu jalannya situasi dan aku sangat kesal sekali, tadi malam aku bermimpi ketemu messi dan ronaldo, aku meminta banyak tanda tangan kepada messi sampai dia agak merasa kep apa gitu.. sedangkan ronaldo cuma 1 aja. aku pikir untung messi agak kalem orangnya</p>', '2023-02-14 06:18:21', '2023-02-24 09:10:59');

-- --------------------------------------------------------

--
-- Table structure for table `karyawans`
--

CREATE TABLE `karyawans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posisi` int(11) NOT NULL,
  `jabatan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawans`
--

INSERT INTO `karyawans` (`id`, `nama`, `posisi`, `jabatan`, `created_at`, `updated_at`) VALUES
(1, 'madhan', 3, 'desainer', '2022-11-07 06:49:54', '2023-01-14 03:11:07'),
(2, 'Ewi', 1, 'admin', '2022-11-20 04:58:31', '2023-01-14 01:29:59'),
(3, 'aef', 3, 'operator', '2022-11-20 06:48:06', '2022-11-20 06:48:06'),
(4, 'melita', 4, 'admin', '2022-11-20 06:48:17', '2022-11-27 05:49:17'),
(5, 'shunici', 1, 'desainer', '2022-11-20 06:51:59', '2022-11-27 05:49:06'),
(6, 'Gina', 1, 'admin', '2023-01-14 01:30:17', '2023-01-14 01:30:34'),
(7, 'manda', 1, 'admin', '2023-01-14 01:30:52', '2023-01-14 01:30:52'),
(8, 'magang', 2, 'desainer', '2023-01-14 03:10:41', '2023-01-14 03:10:41');

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE `labels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posisi` int(11) NOT NULL,
  `warna` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `labels`
--

INSERT INTO `labels` (`id`, `nama`, `posisi`, `warna`, `created_at`, `updated_at`) VALUES
(3, 'urgent', 2, '#d20000', '2022-11-03 09:12:41', '2022-11-11 09:08:05'),
(4, 'ditunggu', 1, '#790000', '2022-11-03 10:05:06', '2022-11-11 08:49:45'),
(5, 'Konfirmasikan Kostumer', 3, '#800080', '2022-11-11 07:36:17', '2023-01-20 01:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2021_02_19_161329_create_produks_table', 1),
(4, '2021_04_13_155248_create_bahans_table', 2),
(5, '2021_04_16_161456_create_data_spks_table', 3),
(6, '2021_04_17_190320_create_pemesans_table', 4),
(7, '2021_05_16_123124_create_spks_table', 5),
(8, '2022_11_03_152045_create_labels_table', 6),
(9, '2022_11_03_184216_create_alerts_table', 7),
(10, '2022_11_07_141903_create_karyawans_table', 8),
(11, '2022_11_16_182339_create_agendas_table', 9),
(12, '2022_12_14_144437_create_infos_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `pemesans`
--

CREATE TABLE `pemesans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inisial` varchar(3000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telpon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'percetakan',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesans`
--

INSERT INTO `pemesans` (`id`, `nama`, `inisial`, `telpon`, `kategori`, `created_at`, `updated_at`) VALUES
(43, 'ADDI PERCETAKAN', '[{\"nama_asli\":\"ADDI PERCETAKAN\",\"nama\":\"addi\",\"telpon\":\"6285753176046\"},{\"nama_asli\":\"ADDI PERCETAKAN\",\"nama\":\"percetakan\",\"telpon\":\"6285753176046\"}]', '6285753176046', 'percetakan', '2021-06-03 10:57:18', '2022-11-16 09:09:27'),
(44, 'INTAN C. CREATIVE', '[{\"nama_asli\":\"INTAN C. CREATIVE\",\"nama\":\"ICC\",\"telpon\":\"6285753176046\"},{\"nama_asli\":\"INTAN C. CREATIVE\",\"nama\":\"Intan Cempaka\",\"telpon\":\"6285753176046\"}]', '6285753176046', 'percetakan', '2021-06-03 10:58:16', '2022-11-16 09:09:21'),
(45, 'KAOS BAGOES', '[{\"nama_asli\":\"KAOS BAGOES\",\"nama\":\"bagoes\",\"telpon\":\"6285753176046\"}]', '6285753176046', 'percetakan', '2021-06-03 10:59:06', '2022-11-16 09:09:33'),
(86, 'intan puji astuti', '[{\"nama_asli\":\"intan puji astuti\",\"nama\":\"intan pea\",\"telpon\":\"62656565\"}]', '62656565', 'umum', '2022-12-04 06:09:14', '2022-12-04 06:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `panjang` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lebar` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satuan` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cm',
  `uk_alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bahan` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_produk` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produks`
--

INSERT INTO `produks` (`id`, `nama`, `panjang`, `lebar`, `satuan`, `uk_alias`, `bahan`, `kategori`, `ket`, `info_produk`, `foto`, `created_at`, `updated_at`) VALUES
(107, 'x banner', '60', '160', 'cm', 'null', '[{\"id\":8,\"nama\":\"fr280\",\"panjang\":null,\"lebar\":null,\"uk_alias\":null,\"kategori\":\"outdoor\"},{\"id\":11,\"nama\":\"korcin\",\"panjang\":null,\"lebar\":null,\"uk_alias\":null,\"kategori\":\"outdoor\"}]', 'Indoor', '[\"mata ayam\",\"plus kaki\"]', '<p>bahan x banner ini bisa memakai mesin outdoor maupun indoor.</p><ul><li>kualitas bagus</li><li>kualitas bagus</li><li>kualitas bagus</li><li>kualitas bagus</li></ul><p>bahan x banner ini bisa memakai mesin outdoor maupun indoor.</p>', 'foto1677174840.jpg', '2022-12-04 07:13:43', '2023-02-23 17:54:00'),
(108, 'spanduk', '30', '30', 'cm', 'null', '[]', 'Outdoor', '[]', '<p>sfsdf</p>', 'foto1677174852.jpg', '2022-12-11 06:47:27', '2023-02-23 17:54:12'),
(109, 'majalah', NULL, NULL, 'cm', 'A3', '[]', 'Merchandise', '[]', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia fuga, in dolor modi maxime suscipit odio quibusdam aspernatur rem vel blanditiis rerum molestiae nemo nesciunt facilis aliquid ipsum asperiores reprehenderit ad explicabo accusantium dolores. Ad praesentium enim voluptates quae atque.</p>', 'foto1677175673.jpg', '2023-02-23 18:07:53', '2023-02-23 18:07:53'),
(110, 'mug cangkir', '20', '8', 'cm', NULL, '[]', 'Versant', '[]', '<p>mugg</p>', 'foto1677178027.jpg', '2023-02-23 18:47:07', '2023-02-23 18:47:07');

-- --------------------------------------------------------

--
-- Table structure for table `spks`
--

CREATE TABLE `spks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_nota` bigint(20) DEFAULT 0,
  `nama_pemesan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` date DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'CM',
  `data` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimasi` timestamp NULL DEFAULT NULL,
  `warna` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desainer` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_wa` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posisi` bigint(20) DEFAULT NULL,
  `text` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_voice` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spk_id` (`spk_id`);

--
-- Indexes for table `bahans`
--
ALTER TABLE `bahans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_spks`
--
ALTER TABLE `data_spks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesans`
--
ALTER TABLE `pemesans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spks`
--
ALTER TABLE `spks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `bahans`
--
ALTER TABLE `bahans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `data_spks`
--
ALTER TABLE `data_spks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `infos`
--
ALTER TABLE `infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pemesans`
--
ALTER TABLE `pemesans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `spks`
--
ALTER TABLE `spks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2393;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alerts`
--
ALTER TABLE `alerts`
  ADD CONSTRAINT `alerts_ibfk_1` FOREIGN KEY (`spk_id`) REFERENCES `spks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
