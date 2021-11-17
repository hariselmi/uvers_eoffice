-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2021 at 04:41 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eoffice_uvers`
--

-- --------------------------------------------------------

--
-- Table structure for table `disposisi_model`
--

CREATE TABLE `disposisi_model` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disposisi_model`
--

INSERT INTO `disposisi_model` (`id`, `nama`) VALUES
(1, '#F0F8FF'),
(2, '#FAEBD7'),
(3, '#00FFFF'),
(4, '#7FFFD4'),
(5, '#F0FFFF'),
(6, '#F5F5DC'),
(7, '#FFE4C4'),
(8, '#000000'),
(9, '#FFEBCD'),
(10, '#0000FF'),
(11, '#8A2BE2'),
(12, '#A52A2A'),
(13, '#DEB887'),
(14, '#5F9EA0'),
(15, '#7FFF00'),
(16, '#D2691E'),
(17, '#FF7F50'),
(18, '#6495ED'),
(19, '#FFF8DC'),
(20, '#DC143C'),
(21, '#00FFFF'),
(22, '#00008B'),
(23, '#008B8B'),
(24, '#B8860B'),
(25, '#A9A9A9'),
(26, '#006400'),
(27, '#BDB76B'),
(28, '#8B008B'),
(29, '#556B2F'),
(30, '#FF8C00'),
(31, '#9932CC'),
(32, '#8B0000'),
(33, '#E9967A'),
(34, '#8FBC8F'),
(35, '#483D8B'),
(36, '#2F4F4F'),
(37, '#00CED1'),
(38, '#9400D3'),
(39, '#FF1493'),
(40, '#00BFFF'),
(41, '#696969'),
(42, '#1E90FF'),
(43, '#B22222'),
(44, '#FFFAF0'),
(45, '#228B22'),
(46, '#FF00FF'),
(47, '#DCDCDC'),
(48, '#F8F8FF'),
(49, '#FFD700'),
(50, '#DAA520'),
(51, '#808080'),
(52, '#008000'),
(53, '#ADFF2F'),
(54, '#F0FFF0'),
(55, '#FF69B4'),
(56, '#CD5C5C'),
(57, '#4B0082'),
(58, '#FFFFF0'),
(59, '#F0E68C'),
(60, '#E6E6FA'),
(61, '#FFF0F5'),
(62, '#7CFC00'),
(63, '#FFFACD'),
(64, '#ADD8E6'),
(65, '#F08080'),
(66, '#E0FFFF'),
(67, '#FAFAD2'),
(68, '#D3D3D3'),
(69, '#90EE90'),
(70, '#FFB6C1'),
(71, '#FFA07A'),
(72, '#20B2AA'),
(73, '#87CEFA'),
(74, '#778899'),
(75, '#B0C4DE'),
(76, '#FFFFE0'),
(77, '#00FF00'),
(78, '#32CD32'),
(79, '#FAF0E6'),
(80, '#FF00FF'),
(81, '#800000'),
(82, '#66CDAA'),
(83, '#0000CD'),
(84, '#BA55D3'),
(85, '#9370DB'),
(86, '#3CB371'),
(87, '#7B68EE'),
(88, '#00FA9A'),
(89, '#48D1CC'),
(90, '#C71585'),
(91, '#191970'),
(92, '#F5FFFA'),
(93, '#FFE4E1'),
(94, '#FFE4B5'),
(95, '#FFDEAD'),
(96, '#000080'),
(97, '#FDF5E6'),
(98, '#808000'),
(99, '#6B8E23'),
(100, '#FFA500'),
(101, '#FF4500'),
(102, '#DA70D6'),
(103, '#EEE8AA'),
(104, '#98FB98'),
(105, '#AFEEEE'),
(106, '#DB7093'),
(107, '#FFEFD5'),
(108, '#FFDAB9'),
(109, '#CD853F'),
(110, '#FFC0CB'),
(111, '#DDA0DD'),
(112, '#B0E0E6'),
(113, '#800080'),
(114, '#663399'),
(115, '#FF0000'),
(116, '#BC8F8F'),
(117, '#4169E1'),
(118, '#8B4513'),
(119, '#FA8072'),
(120, '#F4A460'),
(121, '#2E8B57'),
(122, '#FFF5EE'),
(123, '#A0522D'),
(124, '#C0C0C0'),
(125, '#87CEEB'),
(126, '#6A5ACD'),
(127, '#708090'),
(128, '#FFFAFA'),
(129, '#00FF7F'),
(130, '#4682B4'),
(131, '#D2B48C'),
(132, '#008080'),
(133, '#D8BFD8'),
(134, '#FF6347'),
(135, '#40E0D0'),
(136, '#EE82EE'),
(137, '#F5DEB3'),
(138, '#FFFFFF'),
(139, '#F5F5F5'),
(140, '#FFFF00'),
(141, '#9ACD32');

-- --------------------------------------------------------

--
-- Table structure for table `history_surat_keluar`
--

CREATE TABLE `history_surat_keluar` (
  `id` int(10) UNSIGNED NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `surat_keluar_id` int(11) DEFAULT NULL,
  `surat_keluar_model` int(11) DEFAULT NULL,
  `asal_surat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tujuan_surat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tanggal_proses` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `file_surat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `catatan_penting` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `dlt` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_surat_masuk`
--

CREATE TABLE `history_surat_masuk` (
  `id` int(10) UNSIGNED NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `surat_masuk_id` int(11) DEFAULT NULL,
  `surat_masuk_model` int(11) DEFAULT NULL,
  `asal_surat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tujuan_surat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tanggal_proses` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `file_surat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `catatan_penting` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `dlt` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `identities`
--

CREATE TABLE `identities` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `identities`
--

INSERT INTO `identities` (`id`, `nama`, `facebook`, `whatsapp`, `instagram`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Lembaga Penjamin Mutu - Universitas Universal', 'uversbatam', '6285272161218', 'uvers_batam', 'info@uvers.ac.id', '+62778473399', NULL, '2021-07-30 19:38:18');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `atasan_id` int(11) DEFAULT NULL,
  `hak_approval` enum('0','1') DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `softdelete` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama`, `keterangan`, `atasan_id`, `hak_approval`, `created_at`, `updated_at`, `softdelete`) VALUES
(1, 'Administrator', 'Administrator', 0, '0', '2021-11-04 22:45:25', '2021-11-04 22:45:25', '0'),
(2, 'Rektor', 'Rektor', 0, '0', '2021-11-04 22:45:25', '2021-11-04 22:45:25', '0'),
(3, 'Wakil Rektor', 'Wakil Rektor', 0, '0', '2021-11-04 22:45:25', '2021-11-04 22:45:25', '0'),
(4, 'Dekan', 'Dekan', 0, '0', '2021-11-04 22:45:25', '2021-11-04 22:45:25', '0'),
(5, 'Sekretaris Dekan', 'Sekretaris Dekan', 0, '0', '2021-11-04 22:45:25', '2021-11-04 22:45:25', '0'),
(6, 'Koordinator Program Studi', 'Koordinator Program Studi', 0, '0', '2021-11-04 22:45:25', '2021-11-04 22:45:25', '0'),
(7, 'Dosen', 'Dosen', 0, '0', '2021-11-04 22:45:25', '2021-11-04 22:45:25', '0'),
(8, 'Staff Rektorat', 'Staff Rektorat', 0, '0', '2021-11-04 22:45:25', '2021-11-04 22:45:25', '0'),
(9, 'Kepala Bagian', 'Kepala Bagian', 0, '0', '2021-11-04 22:45:25', '2021-11-04 22:45:25', '0');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `softdelete` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`, `softdelete`) VALUES
(1, 'Surat Permohonan', 'Surat Permohonan', '2021-11-15 11:24:08', '2021-11-15 11:24:08', '0'),
(2, 'Surat Keputusan', 'Surat Keputusan', '2021-11-15 11:24:08', '2021-11-15 11:24:08', '0'),
(3, 'Surat Kuasa', 'Surat Kuasa', '2021-11-15 11:24:08', '2021-11-15 11:24:08', '0'),
(4, 'Surat Perintah', 'Surat Perintah', '2021-11-15 11:24:08', '2021-11-15 11:24:08', '0'),
(5, 'Surat Dinas', 'Surat Dinas', '2021-11-15 11:24:08', '2021-11-15 11:24:08', '0'),
(6, 'Surat Edaran', 'Surat Edaran', '2021-11-15 11:24:08', '2021-11-15 11:24:08', '0'),
(7, 'Surat Undangan', 'Surat Undangan', '2021-11-15 11:24:08', '2021-11-15 11:24:08', '0'),
(8, 'Surat Tugas', 'Surat Tugas', '2021-11-15 11:24:08', '2021-11-15 11:24:08', '0'),
(9, 'Surat Peringatan', 'Surat Peringatan', '2021-11-15 11:24:08', '2021-11-15 11:24:08', '0');

-- --------------------------------------------------------

--
-- Table structure for table `kepala_unit`
--

CREATE TABLE `kepala_unit` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kepala_unit`
--

INSERT INTO `kepala_unit` (`id`, `nama`) VALUES
(1, 'Tidak'),
(2, 'Iya');

-- --------------------------------------------------------

--
-- Table structure for table `media_surat`
--

CREATE TABLE `media_surat` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `softdelete` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media_surat`
--

INSERT INTO `media_surat` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`, `softdelete`) VALUES
(1, 'Website', 'Website', '2021-09-28 19:57:41', '2021-09-28 19:57:41', '0'),
(2, 'Email', 'Email', '2021-09-28 19:57:41', '2021-09-28 19:57:41', '0'),
(3, 'Kurir', 'Kurir', '2021-09-28 19:57:41', '2021-09-28 19:57:41', '0'),
(4, 'Whatsapp', 'Whatsapp', '2021-09-28 19:57:41', '2021-09-28 19:57:41', '0'),
(5, 'Lainnya', 'Lainnya', '2021-09-28 19:57:41', '2021-09-28 19:57:41', '0');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `batch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `unit_kerja_id` int(11) DEFAULT NULL,
  `kepala_unit` enum('1','2') DEFAULT '1',
  `jabatan_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `softdelete` enum('0','1') DEFAULT '0',
  `status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama`, `email`, `telepon`, `unit_kerja_id`, `kepala_unit`, `jabatan_id`, `created_at`, `updated_at`, `softdelete`, `status`) VALUES
(1, 'Administrator', 'eoffice@uvers.ac.id', '0812345678', 1, '2', 1, '2021-11-04 22:46:26', '2021-11-09 19:36:23', '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `perintah_disposisi`
--

CREATE TABLE `perintah_disposisi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `softdelete` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perintah_disposisi`
--

INSERT INTO `perintah_disposisi` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`, `softdelete`) VALUES
(1, 'Menunggu Pimpinan', 'Menunggu Pimpinan', '2021-09-28 20:06:17', '2021-09-28 20:06:17', '0'),
(2, 'Disposisi', 'Disposisi', '2021-09-28 20:06:17', '2021-09-28 20:06:17', '0'),
(3, 'Diterima', 'Diterima', '2021-09-28 20:06:17', '2021-09-28 20:06:17', '0'),
(4, 'Ditolak', 'Ditolak', '2021-09-28 20:06:17', '2021-09-28 20:06:17', '0'),
(5, 'Selesai', 'Selesai', '2021-09-28 20:06:17', '2021-09-28 20:06:17', '0');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `label`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(242, 'List Employees', 'employees.index', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(243, 'Create Employees', 'employees.create', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(244, 'Store Employees', 'employees.store', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(245, 'View Employees', 'employees.show', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(246, 'Delete Employees', 'employees.destroy', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(247, 'Update Employees', 'employees.update', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(248, 'Edit Employees', 'employees.edit', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(256, 'List Permissions', 'permissions.list', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(258, 'Create Roles', 'employeerole.create', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(259, 'Create Permission Role', 'permissionrole.create', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(260, 'Create Permissions', 'permissions.create', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `prioritas_surat`
--

CREATE TABLE `prioritas_surat` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `softdelete` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prioritas_surat`
--

INSERT INTO `prioritas_surat` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`, `softdelete`) VALUES
(1, 'Biasa', 'Biasa', '2021-09-28 19:30:45', '2021-09-28 19:31:09', '0'),
(2, 'Segera', 'Segera', '2021-09-28 19:30:53', '2021-09-28 19:37:34', '0'),
(3, 'Sangat Segera', 'Sangat Segera', '2021-09-28 19:37:19', '2021-09-28 19:37:19', '0');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2021-07-13 05:58:16', '2021-07-13 05:58:16'),
(2, 'Member', 'web', '2021-07-13 13:18:50', '2021-07-13 13:18:50'),
(3, 'Staff', 'web', '2021-07-30 19:35:16', '2021-07-30 19:35:16');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(242, 1),
(243, 1),
(244, 1),
(245, 1),
(246, 1),
(247, 1),
(247, 2),
(247, 3),
(248, 1),
(248, 2),
(248, 3),
(258, 1),
(259, 1),
(260, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sifat_surat`
--

CREATE TABLE `sifat_surat` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `softdelete` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status_keluar`
--

CREATE TABLE `status_keluar` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `softdelete` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_keluar`
--

INSERT INTO `status_keluar` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`, `softdelete`) VALUES
(1, 'Menunggu Persetujuan', 'Menunggu Persetujuan', '2021-11-15 11:21:37', '2021-11-15 11:21:37', '0'),
(2, 'Disposisi', 'Disposisi', '2021-11-15 11:21:37', '2021-11-15 11:21:37', '0'),
(3, 'Diterima', 'Diterima', '2021-11-15 11:21:37', '2021-11-15 11:21:37', '0'),
(4, 'Ditolak', 'Ditolak', '2021-11-15 11:21:37', '2021-11-15 11:21:37', '0'),
(5, 'Selesai', 'Selesai', '2021-11-15 11:21:37', '2021-11-15 11:21:37', '0');

-- --------------------------------------------------------

--
-- Table structure for table `status_laporan`
--

CREATE TABLE `status_laporan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `softdelete` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_laporan`
--

INSERT INTO `status_laporan` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`, `softdelete`) VALUES
(1, 'Menunggu Laporan', 'Menunggu Laporan', '2021-09-28 20:06:17', '2021-09-28 20:06:17', '0'),
(2, 'Menunggu Persetujuan', 'Menunggu Persetujuan', '2021-09-28 20:06:17', '2021-09-28 20:06:17', '0'),
(3, 'Laporan di Tolak', 'Laporan di Tolak', '2021-09-28 20:06:17', '2021-09-28 20:06:17', '0'),
(4, 'Laporan di Terima', 'Laporan di Terima', '2021-09-28 20:06:17', '2021-09-28 20:06:17', '0');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(10) UNSIGNED NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `unit_kerja_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `no_surat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `perihal` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `asal_surat` int(11) DEFAULT NULL,
  `tujuan_surat` int(11) DEFAULT NULL,
  `isi_ringkasan` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `jenis_id` int(11) DEFAULT NULL,
  `file_surat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `laporan` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `status_laporan_id` int(11) DEFAULT NULL,
  `tanggal_laporan` date DEFAULT NULL,
  `laporan_pegawai_id` int(11) DEFAULT NULL,
  `laporan_unit_kerja_id` int(11) DEFAULT NULL,
  `laporan_pegawai_approval_id` int(11) DEFAULT NULL,
  `laporan_catatan` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `laporan_file` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dlt` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(10) UNSIGNED NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `no_surat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `perihal` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `asal_surat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tujuan_surat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `isi_ringkasan` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `jenis_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `file_surat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dlt` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk_laporan`
--

CREATE TABLE `surat_masuk_laporan` (
  `id` int(10) UNSIGNED NOT NULL,
  `surat_masuk_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `no_surat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `perihal` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `asal_surat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tujuan_surat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `isi_ringkasan` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `jenis_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `file_surat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `laporan` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `status_laporan_id` int(11) DEFAULT NULL,
  `tanggal_laporan` date DEFAULT NULL,
  `laporan_pegawai_id` int(11) DEFAULT NULL,
  `laporan_unit_kerja_id` int(11) DEFAULT NULL,
  `laporan_pegawai_approval_id` int(11) DEFAULT NULL,
  `laporan_catatan` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `laporan_file` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dlt` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `kepala_unit` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `softdelete` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_kerja`
--

INSERT INTO `unit_kerja` (`id`, `nama`, `pegawai_id`, `kepala_unit`, `keterangan`, `created_at`, `updated_at`, `softdelete`) VALUES
(1, 'Administrator', NULL, '', 'Administrator', '2021-11-04 22:45:14', '2021-11-15 09:06:42', '0'),
(2, 'Rektorat', 16, '', 'Rektor', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0'),
(3, 'Direktorat Akademik', NULL, '', 'Kepala Bagian', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0'),
(4, 'Direktorat Kepegawaian', NULL, '', 'Kepala Bagian', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0'),
(5, 'Direktorat Umum', NULL, '', 'Kepala Bagian', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0'),
(6, 'UPT TIK', NULL, '', 'Kepala Bagian', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0'),
(7, 'LPPM', NULL, '', 'Kepala Bagian', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0'),
(8, 'Fakultas Bisnis', 18, '', 'Dekan', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0'),
(9, 'Fakultas Komputer', 20, '', 'Dekan', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0'),
(10, 'Fakultas Pendidikan bahasa dan Budaya', NULL, '', 'Dekan', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0'),
(11, 'Fakultas Seni', NULL, '', 'Dekan', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0'),
(12, 'Fakultas Teknik', NULL, '', 'Dekan', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `pegawai_id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Administrator', 'eoffice@uvers.ac.id', '$2y$10$6nvTM03kZVQmX1M97dw/4.9dfw7UM19K3DadFdD.1hybeR9ezysJ6', 'Admin', NULL, '2021-11-04 22:47:26', '2021-11-09 10:45:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposisi_model`
--
ALTER TABLE `disposisi_model`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `history_surat_keluar`
--
ALTER TABLE `history_surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_surat_masuk`
--
ALTER TABLE `history_surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `identities`
--
ALTER TABLE `identities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kepala_unit`
--
ALTER TABLE `kepala_unit`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `media_surat`
--
ALTER TABLE `media_surat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `perintah_disposisi`
--
ALTER TABLE `perintah_disposisi`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prioritas_surat`
--
ALTER TABLE `prioritas_surat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_key_index` (`key`);

--
-- Indexes for table `sifat_surat`
--
ALTER TABLE `sifat_surat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `status_keluar`
--
ALTER TABLE `status_keluar`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `status_laporan`
--
ALTER TABLE `status_laporan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `surat_masuk_laporan`
--
ALTER TABLE `surat_masuk_laporan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD PRIMARY KEY (`id`) USING BTREE;

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
-- AUTO_INCREMENT for table `disposisi_model`
--
ALTER TABLE `disposisi_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `history_surat_keluar`
--
ALTER TABLE `history_surat_keluar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_surat_masuk`
--
ALTER TABLE `history_surat_masuk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `identities`
--
ALTER TABLE `identities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kepala_unit`
--
ALTER TABLE `kepala_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `media_surat`
--
ALTER TABLE `media_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `perintah_disposisi`
--
ALTER TABLE `perintah_disposisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT for table `prioritas_surat`
--
ALTER TABLE `prioritas_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sifat_surat`
--
ALTER TABLE `sifat_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_keluar`
--
ALTER TABLE `status_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status_laporan`
--
ALTER TABLE `status_laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_masuk_laporan`
--
ALTER TABLE `surat_masuk_laporan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
