-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 31, 2021 at 05:39 AM
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
-- Database: `laraUvers`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `title` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `dlt` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `check_lists`
--

CREATE TABLE `check_lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dlt` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `check_list_details`
--

CREATE TABLE `check_list_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `checklist_id` int(11) NOT NULL,
  `reference` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `question` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `special_note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `audit` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `dlt` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clock`
--

CREATE TABLE `clock` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clock`
--

INSERT INTO `clock` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, '07:00', '2021-07-18 19:50:04', '2021-07-18 19:50:04'),
(2, '08:00', '2021-07-18 19:50:04', '2021-07-18 19:50:04'),
(3, '09:00', '2021-07-18 19:50:04', '2021-07-18 19:50:04'),
(4, '10:00', '2021-07-18 19:50:04', '2021-07-18 19:50:04'),
(5, '11:00', '2021-07-18 19:50:04', '2021-07-18 19:50:04'),
(6, '12:00', '2021-07-18 19:50:04', '2021-07-18 19:50:04'),
(7, '13:00', '2021-07-18 19:50:04', '2021-07-18 19:50:04'),
(8, '14:00', '2021-07-18 19:50:04', '2021-07-18 19:50:04'),
(9, '15:00', '2021-07-18 19:50:04', '2021-07-18 19:50:04'),
(10, '16:00', '2021-07-18 19:50:04', '2021-07-18 19:50:04'),
(11, '17:00', '2021-07-18 19:50:04', '2021-07-18 19:50:04'),
(12, '18:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `dlt` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `parent_id`, `dlt`, `title`, `created_at`, `updated_at`) VALUES
(1, NULL, '0', 'Universitas Universal', '2021-07-18 15:00:34', '2021-07-18 15:02:03'),
(2, 1, '0', 'Fakultas Bisnis', '2021-07-18 15:01:02', '2021-07-18 15:01:02'),
(3, 1, '0', 'Fakultas Komputer', '2021-07-18 15:02:42', '2021-07-18 15:02:42'),
(4, 1, '0', 'Fakultas Pendidikan, Bahasa dan Budaya', NULL, NULL),
(5, 1, '0', 'Fakultas Seni', NULL, NULL),
(6, 1, '0', 'Fakultas Teknik', NULL, NULL),
(7, 2, '0', 'Program Studi Manajemen', NULL, NULL),
(8, 2, '0', 'Program Studi Akuntansi', NULL, NULL),
(9, 3, '0', 'Program Studi Sistem Informasi', NULL, NULL),
(10, 3, '0', 'Program Studi Teknik Informatika', NULL, NULL),
(11, 3, '0', 'Program Studi Teknik Perangkat Lunak', NULL, NULL),
(12, 4, '0', 'Program Studi Pendidikan Bahasa Mandarin', NULL, NULL),
(13, 5, '0', 'Program Studi Seni Musik', NULL, NULL),
(14, 5, '0', 'Program Studi Seni Tari', NULL, NULL),
(15, 6, '0', 'Program Studi Teknik Industri', NULL, NULL),
(16, 6, '0', 'Program Studi Teknik Lingkungan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dlt` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_details`
--

CREATE TABLE `document_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `document_id` int(11) DEFAULT NULL,
  `document` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `document_file` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `dlt` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `findings`
--

CREATE TABLE `findings` (
  `id` int(10) UNSIGNED NOT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dlt` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finding_details`
--

CREATE TABLE `finding_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `finding_id` int(11) DEFAULT NULL,
  `category` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `statement` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `reason` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `findings_location` int(11) DEFAULT NULL,
  `findings_evidence` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `dlt` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `respon` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `verification` enum('1','2') COLLATE utf8_unicode_ci DEFAULT '2',
  `notes` text COLLATE utf8_unicode_ci DEFAULT NULL
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
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `upc_ean_isbn` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_name` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no-foto.png',
  `cost_price` decimal(9,2) DEFAULT NULL,
  `selling_price` decimal(9,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `type` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `auditor_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dlt` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `model_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(2, 'App\\User', 3),
(2, 'App\\User', 4),
(2, 'App\\User', 5),
(2, 'App\\User', 6),
(4, 'App\\User', 7);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `nama`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Proses Bisnis Uvers', '<div class=\"content row\">\r\n<div class=\"col-list row\">\r\n<div class=\"col-md-12 pad-r-md res-m-bttm\">\r\n<p><img alt=\"\" src=\"/file/images/proses.jpg\" style=\"height:534px; width:846px\" /></p>\r\n\r\n<p>Bagan Proses Bisnis Universitas Universal menggambarkan alur proses yang berlangsung di dalam Universitas Universal dalam menjalankan aktivitas tridharma perguruan tinggi. Bagan ini menjadi landasan bagi tim LPM dalam menyusun dan merancang Standar Universitas Universal yang mengacu kepada Standar Nasional Pendidikan Tinggi sebagaimana yang diamanahkan dalam Permenristekdikti Nomor 44 Tahun 2015</p>\r\n\r\n<p>Secara umum proses bisnis terbagi ke dalam tiga proses utama, yaitu&nbsp;<strong>Proses Inti, Proses Pendukung</strong>, dan&nbsp;<strong>Manajemen Mutu</strong></p>\r\n\r\n<p><strong>PROSES INTI</strong></p>\r\n\r\n<p>Bagian ini berisi proses-proses utama yang terkait dengan pelaksanaan tridharma perguruan tinggi menyangkut aktivitas di bidang pendidikan dan pengajaran, penelitian, dan pengabdian kepada masyarakat. Lebih spesifik lagi bagian ini memperlihatkan apa yang dilakukan oleh Universitas Universal sebagai mulai dari calon mahasiswa masuk ke dalam sistem hingga lulus sebagai wisudawan</p>\r\n\r\n<p><strong>PROSES PENDUKUNG</strong></p>\r\n\r\n<p>Bagian ini berisi proses-proses yang mendukung terlaksananya proses inti melalui aktivitas dukungan dalam administrasi umum, keuangan, dan operasional</p>\r\n\r\n<p><strong>MANAJEMEN MUTU</strong></p>\r\n\r\n<p>LPM memainkan peran penting dalam bagian ini sebagai pengelola yang melakukan penjaminan terhadap pelaksanaan standar mutu pada proses inti maupun proses pendukung</p>\r\n</div>\r\n</div>\r\n</div>', NULL, '2021-07-18 12:51:27'),
(2, 'Kebijakan dan Standar SPMI', '<div class=\"content row\">\r\n				<div class=\"col-list row\">\r\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\r\n						<p class=\"alignjustify\"><strong>Kebijakan SPMI</strong> merupakan dokumen induk yang berisi landasan dasar pengelolaan dan pelaksanaan SPMI di Universitas Universal</p>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"content row\">\r\n				<div class=\"col-list row\">\r\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\r\n						<div class=\"box-s2 bg-white\">\r\n							<p><a href=\"dokumen/KS/KS-UVERS.pdf\" target=\"_blank\">KS-UVERS Kebijakan SPMI Universitas Universal</a></p>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"content row\">\r\n				<div class=\"col-list row\">\r\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\r\n						<p class=\"alignjustify\">Secara garis besar, susunan <strong>Standar SPMI</strong> yang berlaku di Universitas Universal mengacu kepada 24 Standar Nasional Pendidikan Tinggi (SN Dikti) sebagaimana yang diamanahkan dalam Permenristekdikti Nomor 44 tahun 2015 dan tersaji pada tabel berikut ini</p>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"content row\" style=\"padding-top: 15px;\">\r\n				<div class=\"col-list row\">\r\n					<div class=\"col-md-4 res-m-bttm pad-r-md\">\r\n						<p class=\"alignjustify\"><strong>Standar Pendidikan Universitas Universal</strong></p>\r\n					</div>\r\n					\r\n					<div class=\"col-md-8\">\r\n						<ol>\r\n							<li><a href=\"dokumen/PD1/STD-PD-1 Standar Kompetensi Lulusan.pdf\" target=\"_blank\">STD-PD-1 Standar Kompetensi Lulusan</a></li>\r\n							<li><a href=\"dokumen/PD2/STD-PD-2 Standar Isi Pembelajaran.pdf\" target=\"_blank\">STD-PD-2 Standar Isi Pembelajaran</a></li>\r\n							<li><a href=\"dokumen/PD3/STD-PD-3 Standar Proses Pembelajaran.pdf\" target=\"_blank\">STD-PD-3 Standar Proses Pembelajaran</a></li>\r\n							<li><a href=\"dokumen/PD4/STD-PD-4 Standar Penilaian Pembelajaran.pdf\" target=\"_blank\">STD-PD-4 Standar Penilaian Pembelajaran</a></li>\r\n							<li><a href=\"dokumen/PD5/STD-PD-5 Standar Dosen - Tenaga Kependidikan.pdf\" target=\"_blank\">STD-PD-5 Standar Dosen dan Tenaga Kependidikan</a></li>\r\n							<li><a href=\"dokumen/PD6/STD-PD-6 Standar Sarana Prasarana Pembelajaran.pdf\" target=\"_blank\">STD-PD-6 Standar Sarana Prasarana Pembelajaran</a></li>\r\n							<li><a href=\"dokumen/PD7/STD-PD-7 Standar Pengelolaan Pembelajaran.pdf\" target=\"_blank\">STD-PD-7 Standar Pengelolaan Pembelajaran</a></li>\r\n							<li><a href=\"dokumen/PD8/STD-PD-8 Standar Pembiayaan Pembelajaran.pdf\" target=\"_blank\">STD-PD-8 Standar Pembiayaan Pembelajaran</a></li>\r\n						</ol>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"content row\" style=\"padding-top: 15px;\">\r\n				<div class=\"col-list row\">\r\n					<div class=\"col-md-4 res-m-bttm pad-r-md\">\r\n						<p class=\"alignjustify\"><strong>Standar Penelitian Universitas Universal</strong></p>\r\n					</div>\r\n					\r\n					<div class=\"col-md-8\">\r\n						<ol>\r\n							<li><a href=\"std-pl-1.php\">Standar Hasil Penelitian</a></li>\r\n							<li><a href=\"std-pl-2.php\">Standar Isi Penelitian</a></li>\r\n							<li><a href=\"std-pl-3.php\">Standar Proses Penelitian</a></li>\r\n							<li><a href=\"std-pl-4.php\">Standar Penilaian Penelitian</a></li>\r\n							<li><a href=\"std-pl-5.php\">Standar Peneliti</a></li>\r\n							<li><a href=\"std-pl-6.php\">Standar Sarana Prasarana Penelitian</a></li>\r\n							<li><a href=\"std-pl-7.php\">Standar Pengelolaan Penelitian</a></li>\r\n							<li><a href=\"std-pl-8.php\">Standar Pendanaan dan Pembiayaan Penelitian</a></li>\r\n						</ol>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"content row\" style=\"padding-top: 15px;\">\r\n				<div class=\"col-list row\">\r\n					<div class=\"col-md-4 res-m-bttm pad-r-md\">\r\n						<p class=\"alignjustify\"><strong>Standar Pengabdian kepada Masyarakat Universitas Universal</strong></p>\r\n					</div>\r\n					\r\n					<div class=\"col-md-8\">\r\n						<ol>\r\n							<li><a href=\"std-pm-1.php\">Standar Hasil Pengabdian kepada Masyarakat</a></li>\r\n							<li><a href=\"std-pm-2.php\">Standar Isi Pengabdia kepada Masyarakat</a>n</li>\r\n							<li><a href=\"std-pm-3.php\">Standar Proses Pengabdian kepada Masyarakat</a></li>\r\n							<li><a href=\"std-pm-4.php\">Standar Penilaian Pengabdian kepada Masyarakat</a></li>\r\n							<li><a href=\"std-pm-5.php\">Standar Pelaksana Pengabdian kepada Masyarakat</a></li>\r\n							<li><a href=\"std-pm-6.php\">Standar Sarana Prasarana Pengabdian kepada Masyarakat</a></li>\r\n							<li><a href=\"std-pm-7.php\">Standar Pengelolaan Pengabdian kepada Masyarakat</a></li>\r\n							<li><a href=\"std-pm-8.php\">Standar Pendanaan dan Pembiayaan Pengabdian kepada Masyarakat</a></li>\r\n						</ol>\r\n					</div>\r\n				</div>\r\n			</div>\r\n			<div class=\"content row\">\r\n				<div class=\"col-list row\">\r\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\r\n						<div class=\"box-s2 bg-white\">\r\n							<p><a href=\"STD/STD-UVERS.pdf\">STD-UVERS Standar SPMI Universitas Universal</a></p>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>', NULL, '2021-07-17 16:36:18'),
(3, 'Standar Pendidikan - Standar Kompetensi Lulusan', '<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong>STD-PD-1 STANDAR KOMPETENSI LULUSAN</strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD1/M1.STD-PD-1 Manual Penetapan Standar Kompetensi Lulusan.pdf\">M1.STD-PD-1 Manual Penetapan Standar Kompetensi Lulusan</a></li>\n							<li><a href=\"PD1/F-M1.STD-PD-1.1 Template Standar Kompetensi Lulusan.docx\">F-M1.STD-PD-1.1 Template Standar Kompetensi Lulusan</a></li>\n							<li><a href=\"PD1/F-M1.STD-PD-1.2 Formulir Uji Publik Standar Kompetensi Lulusan.docx\">F-M1.STD-PD-1.2 Formulir Uji Publik Standar Kompetensi Lulusan</a></li>\n							<li><a href=\"PD1/F-M1.STD-PD-1.3 Template SOP Standar Kompetensi Lulusan.docx\">F-M1.STD-PD-1.3 Template SOP Standar Kompetensi Lulusan</a></li>\n							<li><a href=\"PD1/F-M1.STD-PD-1.4 Template Formulir Standar Kompetensi Lulusan.docx\">F-M1.STD-PD-1.4 Template Formulir Standar Kompetensi Lulusan</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD1/M2.STD-PD-1 Manual Pelaksanaan Standar Kompetensi Lulusan.pdf\">M2.STD-PD-1 Manual Pelaksanaan Standar Kompetensi Lulusan</a></li>\n							<li><a href=\"PD1/P-M2.STD-PD-1.1 Pedoman Penyusunan dan Evaluasi Kurikulum.pdf\">P-M2.STD-PD-1.1 Pedoman Penyusunan dan Evaluasi Kurikulum</a></li>\n							<li><a href=\"PD1/P-M2.STD-PD-1.2 Pedoman Kesetaraan Jenjang KKNI.pdf\">P-M2.STD-PD-1.2 Pedoman Kesetaraan Jenjang KKNI</a></li>\n							<li><a href=\"PD1/P-M2.STD-PD-1.3 Pedoman Rumusan Sikap dan Keterampilan Umum.pdf\">P-M2.STD-PD-1.3 Pedoman Rumusan Sikap dan Keterampilan Umum</a></li>\n							<li><a href=\"PD1/F-M2.STD-PD-1.1 Tim Penyusun Kurikulum dan Rencana Kegiatan.docx\">F-M2.STD-PD-1.1 Tim Penyusun Kurikulum dan Rencana Kegiatan</a></li>\n							<li><a href=\"PD1/F-M2.STD-PD-1.2 Daftar Pemangku Kepentingan.docx\">F-M2.STD-PD-1.2 Daftar Pemangku Kepentingan</a></li>\n							<li><a href=\"PD1/F-M2.STD-PD-1.3 Matriks Profil dan Capaian Pembelajaran Lulusan.docx\">F-M2.STD-PD-1.3 Matriks Profil dan Capaian Pembelajaran Lulusan</a></li>\n							<li><a href=\"PD1/F-M2.STD-PD-1.4 Formulir Uji Publik Kurikulum.docx\">F-M2.STD-PD-1.4 Formulir Uji Publik Kurikulum</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD1/M3.STD-PD-1 Manual Evaluasi Standar Kompetensi Lulusan.pdf\">M3.STD-PD-1 Manual Evaluasi Standar Kompetensi Lulusan</a></li>\n							<li><a href=\"PD1/P-M3.STD-PD-1.1 Prosedur Audit Mutu Internal.pdf\">P-M3.STD-PD-1.1 Prosedur Audit Mutu Internal</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.1 Formulir Monitoring Evaluasi Profil dan CPL Prodi.docx\">F-M3.STD-PD-1.1 Formulir Monitoring Evaluasi Profil dan CPL Prodi</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.2 Rekapitulasi Hasil Monitoring Evaluasi Profil dan CPL Prodi.docx\">F-M3.STD-PD-1.2 Rekapitulasi Hasil Monitoring Evaluasi Profil dan CPL Prodi</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.3 Formulir Perencanaan Audit Mutu Internal.docx\">F-M3.STD-PD-1.3 Formulir Perencanaan Audit Mutu Internal</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.4 Catatan Pelaksanaan Audit Mutu Internal.xlsx\">F-M3.STD-PD-1.4 Catatan Pelaksanaan Audit Mutu Internal</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.5 Laporan Hasil Audit Mutu Internal.docx\">F-M3.STD-PD-1.5 Laporan Hasil Audit Mutu Internal</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD1/M4.STD-PD-1 Manual Pengendalian Standar Kompetensi Lulusan.pdf\">M4.STD-PD-1 Manual Pengendalian Standar Kompetensi Lulusan</a></li>\n							<li><a href=\"PD1/F-M4.STD-PD-1.1 Formulir Rapat Tinjauan Manajemen.docx\">F-M4.STD-PD-1.1 Formulir Rapat Tinjauan Manajemen</a></li>\n							<li><a href=\"PD1/F-M4.STD-PD-1.2 Formulir Catatan Tindak Lanjut Hasil Rapat Tinjauan Manajemen.docx\">F-M4.STD-PD-1.2 Formulir Catatan Tindak Lanjut Hasil Rapat Tinjauan Manajemen</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD1/M5.STD-PD-1 Manual Peningkatan Standar Kompetensi Lulusan.pdf\">M5.STD-PD-1 Manual Peningkatan Standar Kompetensi Lulusan</a></li>\n							<li><a href=\"PD1/F-M5.STD-PD-1.1 Formulir Rekomendasi Standar Kompetensi Lulusan.docx\">F-M5.STD-PD-1.1 Formulir Rekomendasi Standar Kompetensi Lulusan</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			', NULL, NULL),
(4, 'Standar Pendidikan - Standar Isi Pembelajaran', '<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong>STD-PD-2 STANDAR ISI PEMBELAJARAN</strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD2/M1.STD-PD-2 Manual Penetapan Standar Isi Pembelajaran.pdf\">M1.STD-PD-2 Manual Penetapan Standar Isi Pembelajaran</a></li>\n							<li><a href=\"PD2/F-M1.STD-PD-2.1 Template Standar Isi Pembelajaran.docx\">F-M1.STD-PD-2.1 Template Standar Isi Pembelajaran</a></li>\n							<li><a href=\"PD2/F-M1.STD-PD-2.2 Formulir Uji Publik Standar Isi Pembelajaran.docx\">F-M1.STD-PD-2.2 Formulir Uji Publik Standar Isi Pembelajaran</a></li>\n							<li><a href=\"PD2/F-M1.STD-PD-2.3 Template SOP Standar Isi Pembelajaran.docx\">F-M1.STD-PD-2.3 Template SOP Standar Isi Pembelajaran</a></li>\n							<li><a href=\"PD2/F-M1.STD-PD-2.4 Template Formulir Standar Isi Pembelajaran.docx\">F-M1.STD-PD-2.4 Template Formulir Standar Isi Pembelajaran</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD2/M2.STD-PD-2 Manual Pelaksanaan Standar Isi Pembelajaran.pdf\">M2.STD-PD-2 Manual Pelaksanaan Standar Isi Pembelajaran</a></li>\n							<li><a href=\"PD2/P-M2.STD-PD-2.1 Pedoman Capaian Pembelajaran Lulusan KKNI.pdf\">P-M2.STD-PD-2.1 Pedoman Capaian Pembelajaran Lulusan KKNI</a></li>\n							<li><a href=\"PD2/F-M2.STD-PD-2.1 Matriks Bahan Kajian dan Capaian Pembelajaran.docx\">F-M2.STD-PD-2.1 Matriks Bahan Kajian dan Capaian Pembelajaran</a></li>\n							<li><a href=\"PD2/F-M2.STD-PD-2.2 Daftar Mata Kuliah.docx\">F-M2.STD-PD-2.2 Daftar Mata Kuliah</a></li>\n							<li><a href=\"PD2/F-M2.STD-PD-2.3 Pemetaan Mata Kuliah.docx\">F-M2.STD-PD-2.3 Pemetaan Mata Kuliah</a></li>\n							<li><a href=\"PD2/F-M2.STD-PD-2.4 Deskripsi Mata Kuliah.docx\">F-M2.STD-PD-2.4 Deskripsi Mata Kuliah</a></li>\n							<li><a href=\"PD2/F-M2.STD-PD-2.5 Template Buku Kurikulum.docx\">F-M2.STD-PD-2.5 Template Buku Kurikulum</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD1/M3.STD-PD-1 Manual Evaluasi Standar Kompetensi Lulusan.pdf\">M3.STD-PD-1 Manual Evaluasi Standar Kompetensi Lulusan</a></li>\n							<li><a href=\"PD1/P-M3.STD-PD-1.1 Prosedur Audit Mutu Internal.pdf\">P-M3.STD-PD-1.1 Prosedur Audit Mutu Internal</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.1 Formulir Monitoring Evaluasi Profil dan CPL Prodi.docx\">F-M3.STD-PD-1.1 Formulir Monitoring Evaluasi Profil dan CPL Prodi</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.2 Rekapitulasi Hasil Monitoring Evaluasi Profil dan CPL Prodi.docx\">F-M3.STD-PD-1.2 Rekapitulasi Hasil Monitoring Evaluasi Profil dan CPL Prodi</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.3 Formulir Perencanaan Audit Mutu Internal.docx\">F-M3.STD-PD-1.3 Formulir Perencanaan Audit Mutu Internal</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.4 Catatan Pelaksanaan Audit Mutu Internal.xlsx\">F-M3.STD-PD-1.4 Catatan Pelaksanaan Audit Mutu Internal</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.5 Laporan Hasil Audit Mutu Internal.docx\">F-M3.STD-PD-1.5 Laporan Hasil Audit Mutu Internal</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD2/M4.STD-PD-2 Manual Pengendalian Standar Isi Pembelajaran.pdf\">M4.STD-PD-2 Manual Pengendalian Standar Isi Pembelajaran</a></li>\n							<li><a href=\"PD1/F-M4.STD-PD-1.1 Formulir Rapat Tinjauan Manajemen.docx\">F-M4.STD-PD-1.1 Formulir Rapat Tinjauan Manajemen</a></li>\n							<li><a href=\"PD1/F-M4.STD-PD-1.2 Formulir Catatan Tindak Lanjut Hasil Rapat Tinjauan Manajemen.docx\">F-M4.STD-PD-1.2 Formulir Catatan Tindak Lanjut Hasil Rapat Tinjauan Manajemen</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD2/M5.STD-PD-2 Manual Peningkatan Standar Isi Pembelajaran.pdf\">M5.STD-PD-2 Manual Peningkatan Standar Isi Pembelajaran</a></li>\n							<li><a href=\"PD2/F-M5.STD-PD-2.1 Formulir Rekomendasi Standar Isi Pembelajaran.docx\">F-M5.STD-PD-2.1 Formulir Rekomendasi Standar Isi Pembelajaran</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>', NULL, NULL),
(5, 'Standar Pendidikan - Standar Proses Pembelajaran', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong>STD-PD-3 STANDAR PROSES PEMBELAJARAN</strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD3/M1.STD-PD-3 Manual Penetapan Standar Proses Pembelajaran.pdf\">M1.STD-PD-3 Manual Penetapan Standar Proses Pembelajaran</a></li>\n							<li><a href=\"PD3/F-M1.STD-PD-3.1 Template Standar Proses Pembelajaran.docx\">F-M1.STD-PD-3.1 Template Standar Proses Pembelajaran</a></li>\n							<li><a href=\"PD3/F-M1.STD-PD-3.2 Formulir Uji Publik Standar Proses Pembelajaran.docx\">F-M1.STD-PD-3.2 Formulir Uji Publik Standar Proses Pembelajaran</a></li>\n							<li><a href=\"PD3/F-M1.STD-PD-3.3 Template SOP Standar Proses Pembelajaran.docx\">F-M1.STD-PD-3.3 Template SOP Standar Proses Pembelajaran</a></li>\n							<li><a href=\"PD3/F-M1.STD-PD-3.4 Template Formulir Standar Proses Pembelajaran.docx\">F-M1.STD-PD-3.4 Template Formulir Standar Proses Pembelajaran</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD3/M2.STD-PD-3 Manual Pelaksanaan Standar Proses Pembelajaran.pdf\">M2.STD-PD-3 Manual Pelaksanaan Standar Proses Pembelajaran</a></li>\n							<li><a href=\"PD3/P-M2.STD-PD-3.1 Pedoman Pembuatan Perangkat Pembelajaran.pdf\">P-M2.STD-PD-3.1 Pedoman Pembuatan Perangkat Pembelajaran</a></li>\n							<li><a href=\"PD3/P-M2.STD-PD-3.2 Pedoman Kehadiran Perkuliahan.pdf\">P-M2.STD-PD-3.2 Pedoman Kehadiran Perkuliahan</a></li>\n							<li><a href=\"PD3/F-M2.STD-PD-3.1 Formulir Perencanaan dan Persiapan Perkuliahan.xlsx\">F-M2.STD-PD-3.1 Formulir Perencanaan dan Persiapan Perkuliahan</a></li>\n							<li><a href=\"PD3/F-M2.STD-PD-3.2 Rekapitulasi Perencanaan dan Persiapan Perkuliahan.xlsx\">F-M2.STD-PD-3.2 Rekapitulasi Perencanaan dan Persiapan Perkuliahan</a></li>\n							<li><a href=\"PD3/F-M2.STD-PD-3.3 Jadwal Perkuliahan.xlsx\">F-M2.STD-PD-3.3 Jadwal Perkuliahan</a></li>\n							<li><a href=\"PD3/F-M2.STD-PD-3.4 Surat Penugasan Dosen Mengajar.docx\">F-M2.STD-PD-3.4 Surat Penugasan Dosen Mengajar</a></li>\n							<li><a href=\"PD3/F-M2.STD-PD-3.5 Tanda Terima Surat Penugasan Dosen Mengajar.docx\">F-M2.STD-PD-3.5 Tanda Terima Surat Penugasan Dosen Mengajar</a></li>\n							<li><a href=\"PD3/F-M2.STD-PD-3.6 Template Rencana Pembelajaran Semester.docx\">F-M2.STD-PD-3.6 Template Rencana Pembelajaran Semester</a></li>\n							<li><a href=\"PD3/F-M2.STD-PD-3.7 Template Materi Perkuliahan.pptx\">F-M2.STD-PD-3.7 Template Materi Perkuliahan</a></li>\n							<li><a href=\"PD3/F-M2.STD-PD-3.8 Surat Tugas Pembuatan Perangkat Pembelajaran.docx\">F-M2.STD-PD-3.8 Surat Tugas Pembuatan Perangkat Pembelajaran</a></li>\n							<li><a href=\"PD3/F-M2.STD-PD-3.9 Tanda Terima Surat Tugas Pembuatan Perangkat Pembelajaran.docx\">F-M2.STD-PD-3.9 Tanda Terima Surat Tugas Pembuatan Perangkat Pembelajaran</a></li>\n							<li><a href=\"PD3/F-M2.STD-PD-3.10 Rekapitulasi Pengumpulan Perangkat Pembelajaran.docx\">F-M2.STD-PD-3.10 Rekapitulasi Pengumpulan Perangkat Pembelajaran</a></li>\n							<li><a href=\"PD3/F-M2.STD-PD-3.11 Berita Acara Perkuliahan.docx\">F-M2.STD-PD-3.11 Berita Acara Perkuliahan</a></li>\n							<li><a href=\"PD3/F-M2.STD-PD-3.12 Daftar Hadir Perkuliahan.docx\">F-M2.STD-PD-3.12 Daftar Hadir Perkuliahan</a></li>\n							<li><a href=\"PD3/F-M2.STD-PD-3.13 Laporan Evaluasi Hasil Pembelajaran.docx\">F-M2.STD-PD-3.13 Laporan Evaluasi Hasil Pembelajaran</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD3/M3.STD-PD-3 Manual Evaluasi Standar Proses Pembelajaran.pdf\">M3.STD-PD-3 Manual Evaluasi Standar Proses Pembelajaran</a></li>\n							<li><a href=\"PD1/P-M3.STD-PD-1.1 Prosedur Audit Mutu Internal.pdf\">P-M3.STD-PD-1.1 Prosedur Audit Mutu Internal</a></li>\n							<li><a href=\"PD3/F-M3.STD-PD-3.1 Formulir Monitoring Standar Proses Pembelajaran.docx\">F-M3.STD-PD-3.1 Formulir Monitoring Standar Proses Pembelajaran</a></li>\n							<li><a href=\"PD3/F-M3.STD-PD-3.2 Rekapitulasi Hasil Monitoring Evaluasi Standar Proses Pembelajaran.docx\">F-M3.STD-PD-3.2 Rekapitulasi Hasil Monitoring Evaluasi Standar Proses Pembelajaran</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.3 Formulir Perencanaan Audit Mutu Internal.docx\">F-M3.STD-PD-1.3 Formulir Perencanaan Audit Mutu Internal</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.4 Catatan Pelaksanaan Audit Mutu Internal.xlsx\">F-M3.STD-PD-1.4 Catatan Pelaksanaan Audit Mutu Internal</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.5 Laporan Hasil Audit Mutu Internal.docx\">F-M3.STD-PD-1.5 Laporan Hasil Audit Mutu Internal</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD3/M4.STD-PD-3 Manual Pengendalian Standar Proses Pembelajaran.pdf\">M4.STD-PD-3 Manual Pengendalian Standar Proses Pembelajaran</a></li>\n							<li><a href=\"PD1/F-M4.STD-PD-1.1 Formulir Rapat Tinjauan Manajemen.docx\">F-M4.STD-PD-1.1 Formulir Rapat Tinjauan Manajemen</a></li>\n							<li><a href=\"PD1/F-M4.STD-PD-1.2 Formulir Catatan Tindak Lanjut Hasil Rapat Tinjauan Manajemen.docx\">F-M4.STD-PD-1.2 Formulir Catatan Tindak Lanjut Hasil Rapat Tinjauan Manajemen</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD3/M5.STD-PD-3 Manual Peningkatan Standar Proses Pembelajaran.pdf\">M5.STD-PD-3 Manual Peningkatan Standar Proses Pembelajaran</a></li>\n							<li><a href=\"PD3/F-M5.STD-PD-3.1 Formulir Rekomendasi Standar Proses Pembelajaran.docx\">F-M5.STD-PD-3.1 Formulir Rekomendasi Standar Proses Pembelajaran</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>', NULL, NULL),
(6, 'Standar Pendidikan - Standar Penilaian Pembelajaran', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong>STD-PD-4 STANDAR PENILAIAN PEMBELAJARAN</strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD4/M1.STD-PD-4 Manual Penetapan Standar Penilaian Pembelajaran.pdf\">M1.STD-PD-4 Manual Penetapan Standar Penilaian Pembelajaran</a></li>\n							<li><a href=\"PD4/F-M1.STD-PD-4.1 Template Standar Penilaian Pembelajaran.docx\">F-M1.STD-PD-4.1 Template Standar Penilaian Pembelajaran</a></li>\n							<li><a href=\"PD4/F-M1.STD-PD-4.2 Formulir Uji Publik Standar Penilaian Pembelajaran.docx\">F-M1.STD-PD-4.2 Formulir Uji Publik Standar Penilaian Pembelajaran</a></li>\n							<li><a href=\"PD4/F-M1.STD-PD-4.3 Template SOP Standar Penilaian Pembelajaran.docx\">F-M1.STD-PD-4.3 Template SOP Standar Penilaian Pembelajaran</a></li>\n							<li><a href=\"PD4/F-M1.STD-PD-4.4 Template Formulir Standar Penilaian Pembelajaran.docx\">F-M1.STD-PD-4.4 Template Formulir Standar Penilaian Pembelajaran</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD4/M2.STD-PD-4 Manual Pelaksanaan Standar Penilaian Pembelajaran.pdf\">M2.STD-PD-4 Manual Pelaksanaan Standar Penilaian Pembelajaran</a></li>\n							<li><a href=\"PD4/P-M2.STD-PD-4.1 Pedoman Pembuatan Soal Ujian.pdf\">P-M2.STD-PD-4.1 Pedoman Pembuatan Soal Ujian</a></li>\n							<li><a href=\"PD4/P-M2.STD-PD-4.2 Pedoman Ujian.pdf\">P-M2.STD-PD-4.2 Pedoman Ujian</a></li>\n							<li><a href=\"PD4/P-M2.STD-PD-4.3 Tata Tertib Ujian.pdf\">P-M2.STD-PD-4.3 Tata Tertib Ujian</a></li>\n							<li><a href=\"PD4/P-M2.STD-PD-4.4 Sanksi Pelanggaran Ujian.pdf\">P-M2.STD-PD-4.4 Sanksi Pelanggaran Ujian</a></li>\n							<li><a href=\"PD4/F-M2.STD-PD-4.1 Template Soal Ujian.docx\">F-M2.STD-PD-4.1 Template Soal Ujian</a></li>\n							<li><a href=\"PD4/F-M2.STD-PD-4.2 Rekapitulasi Pengumpulan Soal Ujian.docx\">F-M2.STD-PD-4.2 Rekapitulasi Pengumpulan Soal Ujian</a></li>\n							<li><a href=\"PD4/F-M2.STD-PD-4.3 Jadwal Ujian.xlsx\">F-M2.STD-PD-4.3 Jadwal Ujian</a></li>\n							<li><a href=\"PD4/F-M2.STD-PD-4.4 Template Label Amplop Berkas Ujian.docx\">F-M2.STD-PD-4.4 Template Label Amplop Berkas Ujian</a></li>\n							<li><a href=\"PD4/F-M2.STD-PD-4.5 Daftar Hadir Ujian.xlsx\">F-M2.STD-PD-4.5 Daftar Hadir Ujian</a></li>\n							<li><a href=\"PD4/F-M2.STD-PD-4.6 Berita Acara Ujian.docx\">F-M2.STD-PD-4.6 Berita Acara Ujian</a></li>\n							<li><a href=\"PD4/F-M2.STD-PD-4.7 Daftar Pengambilan Pengembalian Berkas Ujian.xlsx\">F-M2.STD-PD-4.7 Daftar Pengambilan Pengembalian Berkas Ujian</a></li>\n							<li><a href=\"PD4/F-M2.STD-PD-4.8 Daftar Serah Terima Berkas Jawaban Ujian.xlsx\">F-M2.STD-PD-4.8 Daftar Serah Terima Berkas Jawaban Ujian</a></li>\n							<li><a href=\"PD4/F-M2.STD-PD-4.9 Daftar Penilaian Mata Kuliah.xlsx\">F-M2.STD-PD-4.9 Daftar Penilaian Mata Kuliah</a></li>\n							<li><a href=\"PD4/F-M2.STD-PD-4.10 Daftar Nilai Mahasiswa.xlsx\">F-M2.STD-PD-4.10 Daftar Nilai Mahasiswa</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD4/M3.STD-PD-4 Manual Evaluasi Standar Penilaian Pembelajaran.pdf\">M3.STD-PD-4 Manual Evaluasi Standar Penilaian Pembelajaran</a></li>\n							<li><a href=\"PD1/P-M3.STD-PD-1.1 Prosedur Audit Mutu Internal.pdf\">P-M3.STD-PD-1.1 Prosedur Audit Mutu Internal</a></li>\n							<li><a href=\"PD4/F-M3.STD-PD-4.1 Formulir Monitoring Standar Penilaian Pembelajaran.docx\">F-M3.STD-PD-4.1 Formulir Monitoring Standar Penilaian Pembelajaran</a></li>\n							<li><a href=\"PD4/F-M3.STD-PD-4.2 Rekapitulasi Hasil Monitoring Evaluasi Standar Penilaian Pembelajaran.docx\">F-M3.STD-PD-4.2 Rekapitulasi Hasil Monitoring Evaluasi Standar Penilaian Pembelajaran</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.3 Formulir Perencanaan Audit Mutu Internal.docx\">F-M3.STD-PD-1.3 Formulir Perencanaan Audit Mutu Internal</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.4 Catatan Pelaksanaan Audit Mutu Internal.xlsx\">F-M3.STD-PD-1.4 Catatan Pelaksanaan Audit Mutu Internal</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.5 Laporan Hasil Audit Mutu Internal.docx\">F-M3.STD-PD-1.5 Laporan Hasil Audit Mutu Internal</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD4/M4.STD-PD-4 Manual Pengendalian Standar Penilaian Pembelajaran.pdf\">M4.STD-PD-4 Manual Pengendalian Standar Penilaian Pembelajaran</a></li>\n							<li><a href=\"PD1/F-M4.STD-PD-1.1 Formulir Rapat Tinjauan Manajemen.docx\">F-M4.STD-PD-1.1 Formulir Rapat Tinjauan Manajemen</a></li>\n							<li><a href=\"PD1/F-M4.STD-PD-1.2 Formulir Catatan Tindak Lanjut Hasil Rapat Tinjauan Manajemen.docx\">F-M4.STD-PD-1.2 Formulir Catatan Tindak Lanjut Hasil Rapat Tinjauan Manajemen</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD4/M5.STD-PD-4 Manual Peningkatan Standar Penilaian Pembelajaran.pdf\">M5.STD-PD-4 Manual Peningkatan Standar Penilaian Pembelajaran</a></li>\n							<li><a href=\"PD4/F-M5.STD-PD-4.1 Formulir Rekomendasi Standar Penilaian Pembelajaran.docx\">F-M5.STD-PD-4.1 Formulir Rekomendasi Standar Penilaian Pembelajaran</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>', NULL, NULL),
(7, 'Standar Pendidikan - Standar Dosen dan Tenaga Kependidikan', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong>STD-PD-5 STANDAR DOSEN DAN TENAGA KEPENDIDIKAN</strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n<ol><font face=\"verdana\" size=\"2\">\n<li><a href=\"PD5/M1.STD-PD-5 Manual Penetapan Standar Dosen - Tenaga Kependidikan.pdf\">M1.STD-PD-5 Manual Penetapan Standar Dosen - Tenaga Kependidikan</a></li>\n<li><a href=\"PD5/F-M1.STD-PD-5.1 Template Standar Dosen - Tenaga Kependidikan.docx\">F-M1.STD-PD-5.1 Template Standar Dosen - Tenaga Kependidikan</a></li>\n<li><a href=\"PD5/F-M1.STD-PD-5.2 Formulir Uji Publik Standar Dosen - Tenaga Kependidikan.docx\">F-M1.STD-PD-5.2 Formulir Uji Publik Standar Dosen - Tenaga Kependidikan</a></li>\n<li><a href=\"PD5/F-M1.STD-PD-5.3 Template SOP Standar Dosen - Tenaga Kependidikan.docx\">F-M1.STD-PD-5.3 Template SOP Standar Dosen - Tenaga Kependidikan</a></li>\n<li><a href=\"PD5/F-M1.STD-PD-5.4 Template Formulir Standar Dosen - Tenaga Kependidikan.docx\">F-M1.STD-PD-5.4 Template Formulir Standar Dosen - Tenaga Kependidikan</a></li>\n</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n<li><a href=\"PD5/M2.STD-PD-5 Manual Pelaksanaan Standar Dosen - Tenaga Kependidikan.pdf\">M2.STD-PD-5 Manual Pelaksanaan Standar Dosen - Tenaga Kependidikan</a></li>\n<li><a href=\"PD5/F-M2.STD-PD-5.1 Form Permintaan Dosen.docx\">F-M2.STD-PD-5.1 Form Permintaan Dosen</a></li>\n<li><a href=\"PD5/F-M2.STD-PD-5.2 Kuesioner Umpan Balik Dosen.docx\">F-M2.STD-PD-5.2 Kuesioner Umpan Balik Dosen</a></li>\n<li><a href=\"PD5/F-M2.STD-PD-5.3 Kuesioner Umpan Balik Dosen Tamu.docx\">F-M2.STD-PD-5.3 Kuesioner Umpan Balik Dosen Tamu</a></li>\n<li><a href=\"PD5/F-M2.STD-PD-5.4 Laporan Pengolahan Umpan Balik Dosen.xlsx\">F-M2.STD-PD-5.4 Laporan Pengolahan Umpan Balik Dosen</a></li>\n<li><a href=\"PD5/F-M2.STD-PD-5.5 Laporan Pengolahan Umpan Balik Dosen Tamu.xlsx\">F-M2.STD-PD-5.5 Laporan Pengolahan Umpan Balik Dosen Tamu</a></li>\n</font></ol>\n					</div>\n				</div>\n			</div>\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n<li><a href=\"PD5/M3.STD-PD-5 Manual Evaluasi Standar Dosen - Tenaga Kependidikan.pdf\">M3.STD-PD-5 Manual Evaluasi Standar Dosen - Tenaga Kependidikan</a></li>\n<li><a href=\"PD1/P-M3.STD-PD-1.1 Prosedur Audit Mutu Internal.pdf\">P-M3.STD-PD-1.1 Prosedur Audit Mutu Internal</a></li>\n<li><a href=\"PD5/F-M3.STD-PD-5.1 Formulir Monitoring Standar Dosen - Tenaga Kependidikan.docx\">F-M3.STD-PD-5.1 Formulir Monitoring Standar Dosen - Tenaga Kependidikan</a></li>\n<li><a href=\"PD5/F-M3.STD-PD-5.2 Rekapitulasi Hasil Monitoring Evaluasi Standar Dosen - Tenaga Kependidikan.docx\">F-M3.STD-PD-5.2 Rekapitulasi Hasil Monitoring Evaluasi Standar Dosen - Tenaga Kependidikan</a></li>\n<li><a href=\"PD1/F-M3.STD-PD-1.3 Formulir Perencanaan Audit Mutu Internal.docx\">F-M3.STD-PD-1.3 Formulir Perencanaan Audit Mutu Internal</a></li>\n<li><a href=\"PD1/F-M3.STD-PD-1.4 Catatan Pelaksanaan Audit Mutu Internal.xlsx\">F-M3.STD-PD-1.4 Catatan Pelaksanaan Audit Mutu Internal</a></li>\n<li><a href=\"PD1/F-M3.STD-PD-1.5 Laporan Hasil Audit Mutu Internal.docx\">F-M3.STD-PD-1.5 Laporan Hasil Audit Mutu Internal</a></li>\n</font></ol>\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n<ol><font face=\"verdana\" size=\"2\">\n<li><a href=\"PD5/M4.STD-PD-5 Manual Pengendalian Standar Dosen - Tenaga Kependidikan.pdf\">M4.STD-PD-5 Manual Pengendalian Standar Dosen - Tenaga Kependidikan</a></li>\n<li><a href=\"PD1/F-M4.STD-PD-1.1 Formulir Rapat Tinjauan Manajemen.docx\">F-M4.STD-PD-1.1 Formulir Rapat Tinjauan Manajemen</a></li>\n<li><a href=\"PD1/F-M4.STD-PD-1.2 Formulir Catatan Tindak Lanjut Hasil Rapat Tinjauan Manajemen.docx\">F-M4.STD-PD-1.2 Formulir Catatan Tindak Lanjut Hasil Rapat Tinjauan Manajemen</a></li>\n</font></ol>\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n<ol><font face=\"verdana\" size=\"2\">\n<li><a href=\"PD5/M5.STD-PD-5 Manual Peningkatan Standar Dosen - Tenaga Kependidikan.pdf\">M5.STD-PD-5 Manual Peningkatan Standar Dosen - Tenaga Kependidikan</a></li>\n<li><a href=\"PD5/F-M5.STD-PD-5.1 Formulir Rekomendasi Standar Dosen - Tenaga Kependidikan.docx\">F-M5.STD-PD-5.1 Formulir Rekomendasi Standar Dosen - Tenaga Kependidikan</a></li>\n</font></ol>\n					</div>\n				</div>\n			</div>\n\n\n\n\n', NULL, NULL),
(8, 'Standar Pendidikan - Standar Sarana Prasarana Pembelajaran', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong>STD-PD-6 STANDAR SARANA PRASARANA PEMBELAJARAN</strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD6/M1.STD-PD-6 Manual Penetapan Standar Sarana Prasarana Pembelajaran.pdf\">M1.STD-PD-6 Manual Penetapan Standar Sarana Prasarana Pembelajaran</a></li>\n							<li><a href=\"PD6/F-M1.STD-PD-6.1 Template Standar Sarana Prasarana Pembelajaran.docx\">F-M1.STD-PD-6.1 Template Standar Sarana Prasarana Pembelajaran</a></li>\n							<li><a href=\"PD6/F-M1.STD-PD-6.2 Formulir Uji Publik Standar Sarana Prasarana Pembelajaran.docx\">F-M1.STD-PD-6.2 Formulir Uji Publik Standar Sarana Prasarana Pembelajaran</a></li>\n							<li><a href=\"PD6/F-M1.STD-PD-6.3 Template SOP Standar Sarana Prasarana Pembelajaran.docx\">F-M1.STD-PD-6.3 Template SOP Standar Sarana Prasarana Pembelajaran</a></li>\n							<li><a href=\"PD6/F-M1.STD-PD-6.4 Template Formulir Standar Sarana Prasarana Pembelajaran.docx\">F-M1.STD-PD-6.4 Template Formulir Standar Sarana Prasarana Pembelajaran</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD6/M2.STD-PD-6 Manual Pelaksanaan Standar Sarana Prasarana Pembelajaran.pdf\">M2.STD-PD-6 Manual Pelaksanaan Standar Sarana Prasarana Pembelajaran</a></li>\n							<li><a href=\"PD6/F-M2.STD-PD-6.1 Form Pengajuan Pustaka.docx\">F-M2.STD-PD-6.1 Form Pengajuan Pustaka</a></li>\n							<li><a href=\"PD6/F-M2.STD-PD-6.2 Form Pengadaan Sarana Prasarana Pembelajaran.docx\">F-M2.STD-PD-6.2 Form Pengadaan Sarana Prasarana Pembelajaran</a></li>\n							<li><a href=\"PD6/F-M2.STD-PD-6.3 Kuesioner Umpan Balik Layanan Sarana Prasarana.docx\">F-M2.STD-PD-6.3 Kuesioner Umpan Balik Layanan Sarana Prasarana</a></li>\n							<li><a href=\"PD6/F-M2.STD-PD-6.4 Laporan Pengolahan Umpan Balik Layanan Sarana Prasarana.xlsx\">F-M2.STD-PD-6.4 Laporan Pengolahan Umpan Balik Layanan Sarana Prasarana</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD6/M3.STD-PD-6 Manual Evaluasi Standar Sarana Prasarana Pembelajaran.pdf\">M3.STD-PD-6 Manual Evaluasi Standar Sarana Prasarana Pembelajaran</a></li>\n							<li><a href=\"PD1/P-M3.STD-PD-1.1 Prosedur Audit Mutu Internal.pdf\">P-M3.STD-PD-1.1 Prosedur Audit Mutu Internal</a></li>\n							<li><a href=\"PD6/F-M3.STD-PD-6.1 Formulir Monitoring Standar Sarana Prasarana Pembelajaran.docx\">F-M3.STD-PD-6.1 Formulir Monitoring Standar Sarana Prasarana Pembelajaran</a></li>\n							<li><a href=\"PD6/F-M3.STD-PD-6.2 Rekapitulasi Hasil Monitoring Evaluasi Standar Sarana Prasarana Pembelajaran.docx\">F-M3.STD-PD-6.2 Rekapitulasi Hasil Monitoring Evaluasi Standar Sarana Prasarana Pembelajaran</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.3 Formulir Perencanaan Audit Mutu Internal.docx\">F-M3.STD-PD-1.3 Formulir Perencanaan Audit Mutu Internal</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.4 Catatan Pelaksanaan Audit Mutu Internal.xlsx\">F-M3.STD-PD-1.4 Catatan Pelaksanaan Audit Mutu Internal</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.5 Laporan Hasil Audit Mutu Internal.docx\">F-M3.STD-PD-1.5 Laporan Hasil Audit Mutu Internal</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD6/M4.STD-PD-6 Manual Pengendalian Standar Sarana Prasarana Pembelajaran.pdf\">M4.STD-PD-6 Manual Pengendalian Standar Sarana Prasarana Pembelajaran</a></li>\n							<li><a href=\"PD1/F-M4.STD-PD-1.1 Formulir Rapat Tinjauan Manajemen.docx\">F-M4.STD-PD-1.1 Formulir Rapat Tinjauan Manajemen</a></li>\n							<li><a href=\"PD1/F-M4.STD-PD-1.2 Formulir Catatan Tindak Lanjut Hasil Rapat Tinjauan Manajemen.docx\">F-M4.STD-PD-1.2 Formulir Catatan Tindak Lanjut Hasil Rapat Tinjauan Manajemen</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD6/M5.STD-PD-6 Manual Peningkatan Standar Sarana Prasarana Pembelajaran.pdf\">M5.STD-PD-6 Manual Peningkatan Standar Sarana Prasarana Pembelajaran</a></li>\n							<li><a href=\"PD6/F-M5.STD-PD-6.1 Formulir Rekomendasi Standar Sarana Prasarana Pembelajaran.docx\">F-M5.STD-PD-6.1 Formulir Rekomendasi Standar Sarana Prasarana Pembelajaran</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>', NULL, NULL);
INSERT INTO `pages` (`id`, `nama`, `content`, `created_at`, `updated_at`) VALUES
(9, 'Standar Pendidikan - Standar Pengelolaan Pembelajaran', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong>STD-PD-7 STANDAR PENGELOLAAN PEMBELAJARAN</strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD7/M1.STD-PD-7 Manual Penetapan Standar Pengelolaan Pembelajaran.pdf\">M1.STD-PD-7 Manual Penetapan Standar Pengelolaan Pembelajaran</a></li>\n							<li><a href=\"PD7/F-M1.STD-PD-7.1 Template Standar Pengelolaan Pembelajaran.docx\">F-M1.STD-PD-7.1 Template Standar Pengelolaan Pembelajaran</a></li>\n							<li><a href=\"PD7/F-M1.STD-PD-7.2 Formulir Uji Publik Standar Pengelolaan Pembelajaran.docx\">F-M1.STD-PD-7.2 Formulir Uji Publik Standar Pengelolaan Pembelajaran</a></li>\n							<li><a href=\"PD7/F-M1.STD-PD-7.3 Template SOP Standar Pengelolaan Pembelajaran.docx\">F-M1.STD-PD-7.3 Template SOP Standar Pengelolaan Pembelajaran</a></li>\n							<li><a href=\"PD7/F-M1.STD-PD-7.4 Template Formulir Standar Pengelolaan Pembelajaran.docx\">F-M1.STD-PD-7.4 Template Formulir Standar Pengelolaan Pembelajaran</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD7/M2.STD-PD-7 Manual Pelaksanaan Standar Pengelolaan Pembelajaran.pdf\">M2.STD-PD-7 Manual Pelaksanaan Standar Pengelolaan Pembelajaran</a></li>\n							<li><a href=\"PD7/P-M2.STD-PD-7.1 Pedoman Standar Kehadiran Perkuliahan.pdf\">P-M2.STD-PD-7.1 Pedoman Standar Kehadiran Perkuliahan</a></li>\n							<li><a href=\"PD7/P-M2.STD-PD-7.2 Petunjuk Teknis Status Ketidakhadiran Perkuliahan.pdf\">P-M2.STD-PD-7.2 Petunjuk Teknis Status Ketidakhadiran Perkuliahan</a></li>\n							<li><a href=\"PD7/F-M2.STD-PD-7.1 Template Kalender Akademik.xlsx\">F-M2.STD-PD-7.1 Template Kalender Akademik</a></li>\n							<li><a href=\"PD7/F-M2.STD-PD-7.2 Rekapitulasi Pelaksanaan Perkuliahan.docx\">F-M2.STD-PD-7.2 Rekapitulasi Pelaksanaan Perkuliahan</a></li>\n							<li><a href=\"PD7/F-M2.STD-PD-7.3 Rekapitulasi Kehadiran Perkuliahan.xlsx\">F-M2.STD-PD-7.3 Rekapitulasi Kehadiran Perkuliahan</a></li>\n							<li><a href=\"PD7/F-M2.STD-PD-7.4 Daftar Mahasiswa Tidak Berhak Mengikuti UAS.xlsx\">F-M2.STD-PD-7.4 Daftar Mahasiswa Tidak Berhak Mengikuti UAS</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD7/M3.STD-PD-7 Manual Evaluasi Standar Pengelolaan Pembelajaran.pdf\">M3.STD-PD-7 Manual Evaluasi Standar Pengelolaan Pembelajaran</a></li>\n							<li><a href=\"PD1/P-M3.STD-PD-1.1 Prosedur Audit Mutu Internal.pdf\">P-M3.STD-PD-1.1 Prosedur Audit Mutu Internal</a></li>\n							<li><a href=\"PD7/F-M3.STD-PD-7.1 Formulir Monitoring Standar Pengelolaan Pembelajaran.docx\">F-M3.STD-PD-7.1 Formulir Monitoring Standar Pengelolaan Pembelajaran</a></li>\n							<li><a href=\"PD7/F-M3.STD-PD-7.2 Rekapitulasi Hasil Monitoring Evaluasi Standar Pengelolaan Pembelajaran.docx\">F-M3.STD-PD-7.2 Rekapitulasi Hasil Monitoring Evaluasi Standar Pengelolaan Pembelajaran</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.3 Formulir Perencanaan Audit Mutu Internal.docx\">F-M3.STD-PD-1.3 Formulir Perencanaan Audit Mutu Internal</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.4 Catatan Pelaksanaan Audit Mutu Internal.xlsx\">F-M3.STD-PD-1.4 Catatan Pelaksanaan Audit Mutu Internal</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.5 Laporan Hasil Audit Mutu Internal.docx\">F-M3.STD-PD-1.5 Laporan Hasil Audit Mutu Internal</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD7/M4.STD-PD-7 Manual Pengendalian Standar Pengelolaan Pembelajaran.pdf\">M4.STD-PD-7 Manual Pengendalian Standar Pengelolaan Pembelajaran</a></li>\n							<li><a href=\"PD1/F-M4.STD-PD-1.1 Formulir Rapat Tinjauan Manajemen.docx\">F-M4.STD-PD-1.1 Formulir Rapat Tinjauan Manajemen</a></li>\n							<li><a href=\"PD1/F-M4.STD-PD-1.2 Formulir Catatan Tindak Lanjut Hasil Rapat Tinjauan Manajemen.docx\">F-M4.STD-PD-1.2 Formulir Catatan Tindak Lanjut Hasil Rapat Tinjauan Manajemen</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD7/M5.STD-PD-7 Manual Peningkatan Standar Pengelolaan Pembelajaran.pdf\">M5.STD-PD-7 Manual Peningkatan Standar Pengelolaan Pembelajaran</a></li>\n							<li><a href=\"PD7/F-M5.STD-PD-7.1 Formulir Rekomendasi Standar Pengelolaan Pembelajaran.docx\">F-M5.STD-PD-7.1 Formulir Rekomendasi Standar Pengelolaan Pembelajaran</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>', NULL, NULL),
(10, 'Standar Pendidikan - Standar Pembiayaan Pembelajaran', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong>STD-PD-8 STANDAR PEMBIAYAAN PEMBELAJARAN</strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD8/M1.STD-PD-8 Manual Penetapan Standar Pembiayaan Pembelajaran.pdf\">M1.STD-PD-8 Manual Penetapan Standar Pembiayaan Pembelajaran</a></li>\n							<li><a href=\"PD8/F-M1.STD-PD-8.1 Template Standar Pembiayaan Pembelajaran.docx\">F-M1.STD-PD-8.1 Template Standar Pembiayaan Pembelajaran</a></li>\n							<li><a href=\"PD8/F-M1.STD-PD-8.2 Formulir Uji Publik Standar Pembiayaan Pembelajaran.docx\">F-M1.STD-PD-8.2 Formulir Uji Publik Standar Pembiayaan Pembelajaran</a></li>\n							<li><a href=\"PD8/F-M1.STD-PD-8.3 Template SOP Standar Pembiayaan Pembelajaran.docx\">F-M1.STD-PD-8.3 Template SOP Standar Pembiayaan Pembelajaran</a></li>\n							<li><a href=\"PD8/F-M1.STD-PD-8.4 Template Formulir Standar Pembiayaan Pembelajaran.docx\">F-M1.STD-PD-8.4 Template Formulir Standar Pembiayaan Pembelajaran</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD8/M2.STD-PD-8 Manual Pelaksanaan Standar Pembiayaan Pembelajaran.pdf\">M2.STD-PD-8 Manual Pelaksanaan Standar Pembiayaan Pembelajaran</a></li>\n							<li><a href=\"PD8/F-M2.STD-PD-8.1 Template Rencana Kegiatan dan Anggaran Tahunan.xlsx\">F-M2.STD-PD-8.1 Template Rencana Kegiatan dan Anggaran Tahunan</a></li>\n							<li><a href=\"PD8/F-M2.STD-PD-8.2 Proposal Kegiatan Akademik.docx\">F-M2.STD-PD-8.2 Proposal Kegiatan Akademik</a></li>\n							<li><a href=\"PD8/F-M2.STD-PD-8.3 Laporan Pertanggungjawaban Kegiatan Akademik.docx\">F-M2.STD-PD-8.3 Laporan Pertanggungjawaban Kegiatan Akademik</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD8/M3.STD-PD-8 Manual Evaluasi Standar Pembiayaan Pembelajaran.pdf\">M3.STD-PD-8 Manual Evaluasi Standar Pembiayaan Pembelajaran</a></li>\n							<li><a href=\"PD1/P-M3.STD-PD-1.1 Prosedur Audit Mutu Internal.pdf\">P-M3.STD-PD-1.1 Prosedur Audit Mutu Internal</a></li>\n							<li><a href=\"PD8/F-M3.STD-PD-8.1 Formulir Monitoring Standar Pembiayaan Pembelajaran.docx\">F-M3.STD-PD-8.1 Formulir Monitoring Standar Pembiayaan Pembelajaran</a></li>\n							<li><a href=\"PD8/F-M3.STD-PD-8.2 Rekapitulasi Hasil Monitoring Evaluasi Standar Pembiayaan Pembelajaran.docx\">F-M3.STD-PD-8.2 Rekapitulasi Hasil Monitoring Evaluasi Standar Pembiayaan Pembelajaran</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.3 Formulir Perencanaan Audit Mutu Internal.docx\">F-M3.STD-PD-1.3 Formulir Perencanaan Audit Mutu Internal</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.4 Catatan Pelaksanaan Audit Mutu Internal.xlsx\">F-M3.STD-PD-1.4 Catatan Pelaksanaan Audit Mutu Internal</a></li>\n							<li><a href=\"PD1/F-M3.STD-PD-1.5 Laporan Hasil Audit Mutu Internal.docx\">F-M3.STD-PD-1.5 Laporan Hasil Audit Mutu Internal</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD8/M4.STD-PD-8 Manual Pengendalian Standar Pembiayaan Pembelajaran.pdf\">M4.STD-PD-8 Manual Pengendalian Standar Pembiayaan Pembelajaran</a></li>\n							<li><a href=\"PD1/F-M4.STD-PD-1.1 Formulir Rapat Tinjauan Manajemen.docx\">F-M4.STD-PD-1.1 Formulir Rapat Tinjauan Manajemen</a></li>\n							<li><a href=\"PD1/F-M4.STD-PD-1.2 Formulir Catatan Tindak Lanjut Hasil Rapat Tinjauan Manajemen.docx\">F-M4.STD-PD-1.2 Formulir Catatan Tindak Lanjut Hasil Rapat Tinjauan Manajemen</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<ol><font face=\"verdana\" size=\"2\">\n							<li><a href=\"PD8/M5.STD-PD-8 Manual Peningkatan Standar Pembiayaan Pembelajaran.pdf\">M5.STD-PD-8 Manual Peningkatan Standar Pembiayaan Pembelajaran</a></li>\n							<li><a href=\"PD8/F-M5.STD-PD-8.1 Formulir Rekomendasi Standar Pembiayaan Pembelajaran.docx\">F-M5.STD-PD-8.1 Formulir Rekomendasi Standar Pembiayaan Pembelajaran</a></li>\n						</font></ol>\n					</div>\n				</div>\n			</div>', NULL, NULL),
(11, 'Standar Penelitian - Standar Hasil Penelitian', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> STD-PL-1 STANDAR HASIL PENELITIAN </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM1 -->\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM2 -->\n					</div>\n				</div>\n			</div>\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM3 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n					<!-- FORM4 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM5 -->\n					</div>\n				</div>\n			</div>', NULL, NULL),
(12, 'Standar Penelitian - Standar Isi Penelitian', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> STD-PL-2 STANDAR ISI PENELITIAN </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM1 -->\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM2 -->\n					</div>\n				</div>\n			</div>\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM3 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n					<!-- FORM4 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM5 -->\n					</div>\n				</div>\n			</div>', NULL, NULL),
(13, 'Standar Penelitian - Standar Proses Penelitian', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> STD-PL-3 STANDAR PROSES PENELITIAN </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM1 -->\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM2 -->\n					</div>\n				</div>\n			</div>\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM3 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n					<!-- FORM4 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM5 -->\n					</div>\n				</div>\n			</div>', NULL, NULL),
(14, 'Standar Penelitian - Standar Penilaian Penelitian', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> STD-PL-4 STANDAR PENILAIAN PENELITIAN </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM1 -->\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM2 -->\n					</div>\n				</div>\n			</div>\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM3 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n					<!-- FORM4 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM5 -->\n					</div>\n				</div>\n			</div>', NULL, NULL),
(15, 'Standar Penelitian - Standar Peneliti', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> STD-PL-5 STANDAR PENELITI </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM1 -->\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM2 -->\n					</div>\n				</div>\n			</div>\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM3 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n					<!-- FORM4 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM5 -->\n					</div>\n				</div>\n			</div>', NULL, NULL),
(16, 'Standar Penelitian - Standar Sarana Prasarana Penelitian', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> STD-PL-6 STANDAR SARANA PRASARANA PENELITIAN </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM1 -->\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM2 -->\n					</div>\n				</div>\n			</div>\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM3 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n					<!-- FORM4 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM5 -->\n					</div>\n				</div>\n			</div>', NULL, NULL),
(17, 'Standar Penelitian - Standar Pengelolaan Penelitian', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> STD-PL-7 STANDAR PENGELOLAAN PENELITIAN </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM1 -->\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM2 -->\n					</div>\n				</div>\n			</div>\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM3 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n					<!-- FORM4 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM5 -->\n					</div>\n				</div>\n			</div>', NULL, NULL),
(18, 'Standar Penelitian - Standar Pendanaan Penelitian', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> STD-PL-8 STANDAR PENDANAAN PENELITIAN </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM1 -->\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM2 -->\n					</div>\n				</div>\n			</div>\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM3 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n					<!-- FORM4 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM5 -->\n					</div>\n				</div>\n			</div>', NULL, NULL),
(19, 'Standar Pengabdian - Standar Hasil Pengabdian', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> STD-PL-1 STANDAR HASIL PENELITIAN </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM1 -->\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM2 -->\n					</div>\n				</div>\n			</div>\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM3 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n					<!-- FORM4 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM5 -->\n					</div>\n				</div>\n			</div>', NULL, NULL),
(20, 'Standar Pengabdian - Standar Isi Pengabdian', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> STD-PL-1 STANDAR HASIL PENELITIAN </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM1 -->\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM2 -->\n					</div>\n				</div>\n			</div>\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM3 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n					<!-- FORM4 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM5 -->\n					</div>\n				</div>\n			</div>', NULL, NULL),
(21, 'Standar Pengabdian - Standar Proses Pengabdian', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> STD-PL-1 STANDAR HASIL PENELITIAN </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM1 -->\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM2 -->\n					</div>\n				</div>\n			</div>\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM3 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n					<!-- FORM4 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM5 -->\n					</div>\n				</div>\n			</div>', NULL, NULL),
(22, 'Standar Pengabdian - Standar Penilaian Pengabdian', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> STD-PL-1 STANDAR HASIL PENELITIAN </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM1 -->\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM2 -->\n					</div>\n				</div>\n			</div>\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM3 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n					<!-- FORM4 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM5 -->\n					</div>\n				</div>\n			</div>', NULL, NULL),
(23, 'Standar Pengabdian - Standar Pelaksana Pengabdian', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> STD-PL-1 STANDAR HASIL PENELITIAN </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM1 -->\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM2 -->\n					</div>\n				</div>\n			</div>\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM3 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n					<!-- FORM4 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM5 -->\n					</div>\n				</div>\n			</div>', NULL, NULL),
(24, 'Standar Pengabdian - Standar Sarana Prasarana Pengabdian', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> STD-PL-1 STANDAR HASIL PENELITIAN </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM1 -->\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM2 -->\n					</div>\n				</div>\n			</div>\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM3 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n					<!-- FORM4 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM5 -->\n					</div>\n				</div>\n			</div>\n', NULL, NULL);
INSERT INTO `pages` (`id`, `nama`, `content`, `created_at`, `updated_at`) VALUES
(25, 'Standar Pengabdian - Standar Pengelolaan Pengabdian', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> STD-PL-1 STANDAR HASIL PENELITIAN </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM1 -->\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM2 -->\n					</div>\n				</div>\n			</div>\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM3 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n					<!-- FORM4 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM5 -->\n					</div>\n				</div>\n			</div>', NULL, NULL),
(26, 'Standar Pengabdian - Standar Pendanaan Pengabdian', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> STD-PL-1 STANDAR HASIL PENELITIAN </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Penetapan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM1 -->\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pelaksanaan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM2 -->\n					</div>\n				</div>\n			</div>\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Evaluasi Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM3 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Pengendalian Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n					<!-- FORM4 -->\n					</div>\n				</div>\n			</div>\n\n\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>Manual Peningkatan Standar</strong></p>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row bg-white\" style=\"padding: 25px;\">\n				<div class=\"col-list row\">\n					\n					<div class=\"col-md-12 \">\n						<!-- FORM5 -->\n					</div>\n				</div>\n			</div>', NULL, NULL),
(27, 'Daftar SOP Uvers - SOP Admisi', '\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> SOP BAGIAN ADMISI </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>segera menyusul..</strong></p>\n					</div>\n				</div>\n			</div>', NULL, NULL),
(28, 'Daftar SOP Uvers - OP Akademik dan Kemahasiswaan', '			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> SOP BAGIAN AKADEMIK DAN KEMAHASISWAAN </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>segera menyusul..</strong></p>\n					</div>\n				</div>\n			</div>', NULL, NULL),
(29, 'Daftar SOP Uvers - SOP Administrasi Umum', '			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<div class=\"box-s2 bg-white text-center\">\n							<p><strong> SOP BAGIAN ADMINISTRASI UMUM </strong></p>\n						</div>\n					</div>\n				</div>\n			</div>\n			<div class=\"content row\">\n				<div class=\"col-list row\">\n					<div class=\"col-md-12 res-m-bttm pad-r-md\">\n						<p class=\"alignjustify\"><strong>segera menyusul..</strong></p>\n					</div>\n				</div>\n			</div>', NULL, NULL),
(30, 'Dashboard Landing', '<!-- Content -->\r\n<div class=\"bg-light section section-content section-pad\">\r\n<div class=\"container\">\r\n<div class=\"content row\">\r\n<div class=\"reverses row row-vm\">\r\n<div class=\"col-sm-6 pad-r res-s-bttm\"><img alt=\"\" src=\"/file/images/mutu.jpg\" /></div>\r\n\r\n<div class=\"col-sm-6 pad-l\">\r\n<h2>Lembaga Penjamin Mutu<br />\r\nUniversitas Universal</h2>\r\n\r\n<p>Salam dunia satu keluarga..</p>\r\n\r\n<p>Selamat datang di portal Sistem Penjaminan Mutu Internal (SPMI) Lembaga Penjamin Mutu (LPM) Universitas Universal</p>\r\n\r\n<p>Portal ini dimaksudkan sebagai sarana informasi terkait dengan standar mutu yang telah disusun untuk diterapkan dalam proses dan aktivitas tridharma perguruan tinggi di Universitas Universal</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- End Content --><!-- Content -->\r\n\r\n<div class=\"bg-light section section-contents\">\r\n<div class=\"container\">\r\n<div class=\"content row\">\r\n<div class=\"col-list row\">\r\n<div class=\"col-md-12\">\r\n<h3>Portal ini berisikan:</h3>\r\n\r\n<ul>\r\n	<li>Bagan Proses Bisnis Universitas Universal, yang menjadi landasan dalam memetakan aktivitas utama pendidikan tinggi</li>\r\n	<li>Dokumen Kebijakan SPMI, yang menjadi dokumen induk peta SPMI Universitas Universal</li>\r\n	<li>Dokumen Manual SPMI, yang menjadi landasan pelaksanaan siklus SPMI yaitu Penetapan, Pelaksanaan, Evaluasi, Pengendalian dan Peningkatan (PPEPP)</li>\r\n	<li>Dokumen Standar SPMI, yang berisikan standar, pedoman dan formulir kerja yang dapat diunduh dalam melaksanakan standar tersebut</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"container\" style=\"padding-bottom:15px; padding-top:15px\">\r\n<div class=\"content row\">\r\n<div class=\"reverses row row-vm\">\r\n<div class=\"col-sm-12 pad-l\">\r\n<p>Portal ini akan selalu diupdate secara berkala setiap kali terdapat penambahan maupun perubahan dokumen SPMI. Untuk itu kami mohon agar portal SPMI ini dapat secara rutin diakses oleh pihak-pihak yang berkepentingan dengan pelaksanaan SPMI di Universitas Universal. Terima kasih atas kerja sama yang diberikan</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- End Content -->', NULL, '2021-07-18 12:10:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE `periods` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `dlt` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `semester` enum('Gasal','Genap') COLLATE utf8_unicode_ci DEFAULT 'Gasal',
  `date` date DEFAULT NULL,
  `time` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `participant` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `agenda` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `pejabat1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jabatan1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pejabat2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jabatan2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`id`, `title`, `status`, `dlt`, `created_at`, `updated_at`, `semester`, `date`, `time`, `location`, `participant`, `agenda`, `pejabat1`, `jabatan1`, `pejabat2`, `jabatan2`) VALUES
(1, '2020/2021', '1', '0', '2021-07-21 17:44:22', '2021-07-21 19:23:47', 'Gasal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '2020/2021', '0', '0', '2021-07-21 17:44:22', '2021-07-21 19:23:57', 'Genap', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '2021/2022', '0', '0', '2021-07-21 17:44:22', '2021-07-26 09:40:26', 'Gasal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '2021/2022', '0', '0', '2021-07-21 17:44:22', '2021-07-21 17:32:08', 'Genap', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(163, 'List Scheduling Audit', 'schedulingaudit.index', 'web', '2021-07-30 19:33:52', '2021-07-30 19:33:52'),
(164, 'List Members', 'members.index', 'web', '2021-07-30 19:33:52', '2021-07-30 19:33:52'),
(165, 'Create Members', 'members.create', 'web', '2021-07-30 19:33:52', '2021-07-30 19:33:52'),
(166, 'Store Members', 'members.store', 'web', '2021-07-30 19:33:52', '2021-07-30 19:33:52'),
(167, 'View Members', 'members.show', 'web', '2021-07-30 19:33:52', '2021-07-30 19:33:52'),
(168, 'Delete Members', 'members.destroy', 'web', '2021-07-30 19:33:52', '2021-07-30 19:33:52'),
(169, 'Update Members', 'members.update', 'web', '2021-07-30 19:33:52', '2021-07-30 19:33:52'),
(170, 'Edit Members', 'members.edit', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(171, 'List Schedules', 'schedules.index', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(172, 'Create Schedules', 'schedules.create', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(173, 'Store Schedules', 'schedules.store', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(174, 'View Schedules', 'schedules.show', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(175, 'Delete Schedules', 'schedules.destroy', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(176, 'Update Schedules', 'schedules.update', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(177, 'Edit Schedules', 'schedules.edit', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(178, 'List Audit', 'audit.index', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(179, 'List Documents', 'documents.index', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(180, 'Create Documents', 'documents.create', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(181, 'Store Documents', 'documents.store', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(182, 'View Documents', 'documents.show', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(183, 'Delete Documents', 'documents.destroy', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(184, 'Update Documents', 'documents.update', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(185, 'Edit Documents', 'documents.edit', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(186, 'Print Documents', 'documents.print', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(187, 'List Check Lists', 'checklists.index', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(188, 'Create Check Lists', 'checklists.create', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(189, 'Store Check Lists', 'checklists.store', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(190, 'View Check Lists', 'checklists.show', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(191, 'Delete Check Lists', 'checklists.destroy', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(192, 'Update Check Lists', 'checklists.update', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(193, 'Edit Check Lists', 'checklists.edit', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(194, 'Print Check Lists', 'checklists.print', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(195, 'List Findings', 'findings.index', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(196, 'Create Findings', 'findings.create', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(197, 'Store Findings', 'findings.store', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(198, 'View Findings', 'findings.show', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(199, 'Delete Findings', 'findings.destroy', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(200, 'Update Findings', 'findings.update', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(201, 'Edit Findings', 'findings.edit', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(202, 'Print Findings', 'findings.print', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(203, 'List Reports', 'reports.index', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(204, 'Create Reports', 'reports.create', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(205, 'Store Reports', 'reports.store', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(206, 'View Reports', 'reports.show', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(207, 'Delete Reports', 'reports.destroy', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(208, 'Update Reports', 'reports.update', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(209, 'Edit Reports', 'reports.edit', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(210, 'Print Reports', 'reports.print', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(211, 'List Upload Documents', 'uploaddocuments.index', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(212, 'Create Upload Documents', 'uploaddocuments.create', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(213, 'Store Upload Documents', 'uploaddocuments.store', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(214, 'View Upload Documents', 'uploaddocuments.show', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(215, 'Delete Upload Documents', 'uploaddocuments.destroy', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(216, 'Update Upload Documents', 'uploaddocuments.update', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(217, 'Edit Upload Documents', 'uploaddocuments.edit', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(218, 'List Report All', 'reportalls.index', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(219, 'Create Report All', 'reportalls.create', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(220, 'Store Report All', 'reportalls.store', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(221, 'View Report All', 'reportalls.show', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(222, 'Delete Report All', 'reportalls.destroy', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(223, 'Update Report All', 'reportalls.update', 'web', '2021-07-30 19:33:53', '2021-07-30 19:33:53'),
(224, 'Edit Report All', 'reportalls.edit', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(225, 'Print Report All', 'reportalls.print', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(226, 'List Data Master', 'datamaster.index', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(227, 'Konfigurasi Website', 'settingweb.index', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(228, 'List Standars', 'standards.index', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(229, 'Create Standars', 'standards.create', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(230, 'Store Standars', 'standards.store', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(231, 'View Standars', 'standards.show', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(232, 'Delete Standars', 'standards.destroy', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(233, 'Update Standars', 'standards.update', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(234, 'Edit Standars', 'standards.edit', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(235, 'List Standar Details', 'standarddetails.index', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(236, 'Create Standar Details', 'standarddetails.create', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(237, 'Store Standar Details', 'standarddetails.store', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(238, 'View Standar Details', 'standarddetails.show', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(239, 'Delete Standar Details', 'standarddetails.destroy', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(240, 'Update Standar Details', 'standarddetails.update', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(241, 'Edit Standar Details', 'standarddetails.edit', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(242, 'List Employees', 'employees.index', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(243, 'Create Employees', 'employees.create', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(244, 'Store Employees', 'employees.store', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(245, 'View Employees', 'employees.show', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(246, 'Delete Employees', 'employees.destroy', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(247, 'Update Employees', 'employees.update', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(248, 'Edit Employees', 'employees.edit', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(249, 'List Articles', 'articles.index', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(250, 'Create Articles', 'articles.create', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(251, 'Store Articles', 'articles.store', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(252, 'View Articles', 'articles.show', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(253, 'Delete Articles', 'articles.destroy', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(254, 'Update Articles', 'articles.update', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(255, 'Edit Articles', 'articles.edit', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(256, 'List Permissions', 'permissions.list', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(257, 'Assaign Roles', 'assaign.roles', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(258, 'Create Roles', 'employeerole.create', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(259, 'Create Permission Role', 'permissionrole.create', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(260, 'Create Permissions', 'permissions.create', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(261, 'List Sliders', 'sliders.index', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(262, 'Create Sliders', 'sliders.create', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(263, 'Store Sliders', 'sliders.store', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(264, 'View Sliders', 'sliders.show', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(265, 'Delete Sliders', 'sliders.destroy', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(266, 'Update Sliders', 'sliders.update', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54'),
(267, 'Edit Sliders', 'sliders.edit', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(268, 'List Pages', 'pages.index', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(269, 'Create Pages', 'pages.create', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(270, 'Store Pages', 'pages.store', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(271, 'View Pages', 'pages.show', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(272, 'Delete Pages', 'pages.destroy', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(273, 'Update Pages', 'pages.update', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(274, 'Edit Pages', 'pages.edit', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(275, 'List Identitas', 'identity.index', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(276, 'Create Identitas', 'identity.create', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(277, 'Store Identitas', 'identity.store', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(278, 'View Identitas', 'identity.show', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(279, 'Delete Identitas', 'identity.destroy', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(280, 'Update Identitas', 'identity.update', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(281, 'Edit Identitas', 'identity.edit', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(282, 'List Divisi', 'division.index', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(283, 'Create Divisi', 'division.create', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(284, 'Store Divisi', 'division.store', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(285, 'View Divisi', 'division.show', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(286, 'Delete Divisi', 'division.destroy', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(287, 'Update Divisi', 'division.update', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(288, 'Edit Divisi', 'division.edit', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(289, 'List Periode', 'period.index', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(290, 'Create Periode', 'period.create', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(291, 'Store Periode', 'period.store', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(292, 'View Periode', 'period.show', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(293, 'Delete Periode', 'period.destroy', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(294, 'Update Periode', 'period.update', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(295, 'Edit Periode', 'period.edit', 'web', '2021-07-30 19:33:55', '2021-07-30 19:33:55'),
(296, 'List Berita Acara', 'agenda.index', 'web', '2021-07-30 20:04:25', '2021-07-30 20:04:25'),
(297, 'Create Berita Acara', 'agenda.create', 'web', '2021-07-30 20:04:25', '2021-07-30 20:04:25'),
(298, 'Store Berita Acara', 'agenda.store', 'web', '2021-07-30 20:04:25', '2021-07-30 20:04:25'),
(299, 'View Berita Acara', 'agenda.show', 'web', '2021-07-30 20:04:25', '2021-07-30 20:04:25'),
(300, 'Delete Berita Acara', 'agenda.destroy', 'web', '2021-07-30 20:04:25', '2021-07-30 20:04:25'),
(301, 'Update Berita Acara', 'agenda.update', 'web', '2021-07-30 20:04:25', '2021-07-30 20:04:25'),
(302, 'Edit Berita Acara', 'agenda.edit', 'web', '2021-07-30 20:04:25', '2021-07-30 20:04:25'),
(303, 'List Verikasi Tindak Lanjut', 'verification.index', 'web', '2021-07-30 20:04:25', '2021-07-30 20:04:25'),
(304, 'Create Verikasi Tindak Lanjut', 'verification.create', 'web', '2021-07-30 20:04:25', '2021-07-30 20:04:25'),
(305, 'Store Verikasi Tindak Lanjut', 'verification.store', 'web', '2021-07-30 20:04:25', '2021-07-30 20:04:25'),
(306, 'View Verikasi Tindak Lanjut', 'verification.show', 'web', '2021-07-30 20:04:25', '2021-07-30 20:04:25'),
(307, 'Delete Verikasi Tindak Lanjut', 'verification.destroy', 'web', '2021-07-30 20:04:25', '2021-07-30 20:04:25'),
(308, 'Update Verikasi Tindak Lanjut', 'verification.update', 'web', '2021-07-30 20:04:25', '2021-07-30 20:04:25'),
(309, 'Edit Verikasi Tindak Lanjut', 'verification.edit', 'web', '2021-07-30 20:04:25', '2021-07-30 20:04:25'),
(310, 'List RTM', 'rtm.index', 'web', '2021-07-30 20:04:26', '2021-07-30 20:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `dlt` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(1, 'admin', 'web', '2021-07-13 05:58:16', '2021-07-13 05:58:16'),
(2, 'member', 'web', '2021-07-13 13:18:50', '2021-07-13 13:18:50'),
(4, 'pimpinan', 'web', '2021-07-30 19:35:16', '2021-07-30 19:35:16');

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
(163, 1),
(163, 2),
(164, 1),
(165, 1),
(166, 1),
(167, 1),
(168, 1),
(169, 1),
(170, 1),
(171, 1),
(171, 2),
(172, 1),
(173, 1),
(174, 1),
(174, 2),
(175, 1),
(176, 1),
(176, 2),
(177, 1),
(177, 2),
(178, 1),
(178, 2),
(179, 1),
(179, 2),
(180, 1),
(180, 2),
(181, 1),
(181, 2),
(182, 1),
(182, 2),
(183, 1),
(183, 2),
(184, 1),
(184, 2),
(185, 1),
(185, 2),
(186, 1),
(186, 2),
(187, 1),
(187, 2),
(188, 1),
(188, 2),
(189, 1),
(189, 2),
(190, 1),
(190, 2),
(191, 1),
(191, 2),
(192, 1),
(192, 2),
(193, 1),
(193, 2),
(194, 1),
(194, 2),
(195, 1),
(195, 2),
(196, 1),
(196, 2),
(197, 1),
(197, 2),
(198, 1),
(198, 2),
(199, 1),
(199, 2),
(200, 1),
(200, 2),
(201, 1),
(201, 2),
(202, 1),
(202, 2),
(203, 1),
(203, 2),
(204, 1),
(204, 2),
(205, 1),
(205, 2),
(206, 1),
(206, 2),
(207, 1),
(207, 2),
(208, 1),
(208, 2),
(209, 1),
(209, 2),
(210, 1),
(210, 2),
(211, 1),
(211, 2),
(212, 1),
(212, 2),
(213, 1),
(213, 2),
(214, 1),
(214, 2),
(215, 1),
(215, 2),
(216, 1),
(216, 2),
(217, 1),
(217, 2),
(218, 1),
(218, 4),
(219, 1),
(220, 1),
(221, 1),
(221, 4),
(222, 1),
(223, 1),
(224, 1),
(225, 1),
(225, 4),
(226, 1),
(227, 1),
(228, 1),
(229, 1),
(230, 1),
(231, 1),
(232, 1),
(233, 1),
(234, 1),
(235, 1),
(236, 1),
(237, 1),
(238, 1),
(239, 1),
(240, 1),
(241, 1),
(242, 1),
(243, 1),
(244, 1),
(245, 1),
(246, 1),
(247, 1),
(248, 1),
(249, 1),
(250, 1),
(251, 1),
(252, 1),
(253, 1),
(254, 1),
(255, 1),
(256, 1),
(257, 1),
(258, 1),
(259, 1),
(260, 1),
(261, 1),
(262, 1),
(263, 1),
(264, 1),
(265, 1),
(266, 1),
(267, 1),
(268, 1),
(269, 1),
(270, 1),
(271, 1),
(272, 1),
(273, 1),
(274, 1),
(275, 1),
(276, 1),
(277, 1),
(278, 1),
(279, 1),
(280, 1),
(281, 1),
(282, 1),
(283, 1),
(284, 1),
(285, 1),
(286, 1),
(287, 1),
(288, 1),
(289, 1),
(290, 1),
(291, 1),
(292, 1),
(293, 1),
(294, 1),
(295, 1),
(296, 1),
(297, 1),
(298, 1),
(299, 1),
(300, 1),
(301, 1),
(302, 1),
(303, 1),
(304, 1),
(305, 1),
(306, 1),
(307, 1),
(308, 1),
(309, 1),
(310, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `period_id` int(11) DEFAULT NULL,
  `schedule_date` date DEFAULT NULL,
  `clock_start_id` int(11) DEFAULT NULL,
  `clock_finish_id` int(11) DEFAULT NULL,
  `auditor_id` int(11) DEFAULT NULL,
  `auditee_id` int(11) DEFAULT NULL,
  `standard_id` int(11) DEFAULT NULL,
  `standard_detail_id` int(11) DEFAULT NULL,
  `member_one` int(11) DEFAULT NULL,
  `member_two` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `dlt` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `division_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dlt` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `thumbnail`, `status`, `created_at`, `updated_at`, `dlt`) VALUES
(1, '11', 'slider-a.jpg', '1', NULL, '2021-07-18 12:51:44', '0');

-- --------------------------------------------------------

--
-- Table structure for table `standards`
--

CREATE TABLE `standards` (
  `id` int(10) UNSIGNED NOT NULL,
  `standard` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dlt` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `standards`
--

INSERT INTO `standards` (`id`, `standard`, `dlt`, `created_at`, `updated_at`) VALUES
(1, 'Standar Pendidikan', '0', '2021-07-13 05:58:26', '2021-07-18 12:57:44'),
(2, 'Standar Penelitian', '0', '2021-07-13 05:58:26', '2021-07-13 05:58:26'),
(3, 'Standar Pengabdian', '0', '2021-07-13 05:58:26', '2021-07-13 05:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `standard_details`
--

CREATE TABLE `standard_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `standard_id` int(11) DEFAULT NULL,
  `standard_details` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_document` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dlt` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `standard_details`
--

INSERT INTO `standard_details` (`id`, `standard_id`, `standard_details`, `no_document`, `dlt`, `created_at`, `updated_at`) VALUES
(1, 1, 'Standar Kompetensi Lulusan', 'Standar Kompetensi Lulusan', '0', '2021-07-13 05:58:26', '2021-07-13 05:58:26'),
(2, 1, 'Standar Isi Pembelajaran', 'Standar Isi Pembelajaran', '0', '2021-07-13 05:58:26', '2021-07-13 05:58:26'),
(3, 1, 'Standar Proses Pembelajaran', 'Standar Proses Pembelajaran', '0', '2021-07-13 05:58:27', '2021-07-13 05:58:27'),
(4, 1, 'Standar Penilaian Pembelajaran', 'Standar Penilaian Pembelajaran', '0', '2021-07-13 05:58:27', '2021-07-13 05:58:27'),
(5, 1, 'Standar Dosen dan Tenaga Kependidikan', 'Standar Dosen dan Tenaga Kependidikan', '0', '2021-07-13 05:58:27', '2021-07-13 05:58:27'),
(6, 1, 'Standar Sarana Prasarana Pembelajaran', 'Standar Sarana Prasarana Pembelajaran', '0', '2021-07-13 05:58:27', '2021-07-13 05:58:27'),
(7, 1, 'Standar Pengelolaan Pembelajaran', 'Standar Pengelolaan Pembelajaran', '0', '2021-07-13 05:58:27', '2021-07-13 05:58:27'),
(8, 1, 'Standar Pembiayaan Pembelajaran', 'Standar Pembiayaan Pembelajaran', '0', '2021-07-13 05:58:27', '2021-07-13 05:58:27'),
(9, 2, 'Standar Hasil Penelitian', 'Standar Hasil Penelitian', '0', '2021-07-13 05:58:27', '2021-07-13 05:58:27'),
(10, 2, 'Standar Isi Penelitian', 'Standar Isi Penelitian', '0', '2021-07-13 05:58:27', '2021-07-13 05:58:27'),
(11, 2, 'Standar Proses Penelitian', 'Standar Proses Penelitian', '0', '2021-07-13 05:58:27', '2021-07-13 05:58:27'),
(12, 2, 'Standar Penilaian Penelitian', 'Standar Penilaian Penelitian', '0', '2021-07-13 05:58:27', '2021-07-13 05:58:27'),
(13, 2, 'Standar Peneliti', 'Standar Peneliti', '0', '2021-07-13 05:58:27', '2021-07-13 05:58:27'),
(14, 2, 'Standar Sarana Prasarana Penelitian', 'Standar Sarana Prasarana Penelitian', '0', '2021-07-13 05:58:27', '2021-07-13 05:58:27'),
(15, 2, 'Standar Pengelolaan Penelitian', 'Standar Pengelolaan Penelitian', '0', '2021-07-13 05:58:27', '2021-07-13 05:58:27'),
(16, 2, 'Standar Pendanaan Penelitian', 'Standar Pendanaan Penelitian', '0', '2021-07-13 05:58:27', '2021-07-13 05:58:27'),
(17, 3, 'Standar Hasil Pengabdian', 'Standar Hasil Pengabdian', '0', '2021-07-13 05:58:27', '2021-07-13 05:58:27'),
(18, 3, 'Standar Isi Pengabdian', 'Standar Isi Pengabdian', '0', '2021-07-13 05:58:28', '2021-07-13 05:58:28'),
(19, 3, 'Standar Proses Pengabdian', 'Standar Proses Pengabdian', '0', '2021-07-13 05:58:28', '2021-07-13 05:58:28'),
(20, 3, 'Standar Penilaian Pengabdian', 'Standar Penilaian Pengabdian', '0', '2021-07-13 05:58:28', '2021-07-13 05:58:28'),
(21, 3, 'Standar Pelaksana Pengabdian', 'Standar Pelaksana Pengabdian', '0', '2021-07-13 05:58:28', '2021-07-13 05:58:28'),
(22, 3, 'Standar Sarana Prasarana Pengabdian', 'Standar Sarana Prasarana Pengabdian', '0', '2021-07-13 05:58:28', '2021-07-13 05:58:28'),
(23, 3, 'Standar Pengelolaan Pengabdian', 'Standar Pengelolaan Pengabdian', '0', '2021-07-13 05:58:28', '2021-07-13 05:58:28'),
(24, 3, 'Standar Pendanaan Pengabdian', 'Standar Pendanaan Pengabdian', '0', '2021-07-13 05:58:28', '2021-07-13 05:58:28');

-- --------------------------------------------------------

--
-- Table structure for table `standard_documents`
--

CREATE TABLE `standard_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `standard_detail_id` int(11) DEFAULT NULL,
  `no_document` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dlt` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `upload_documents`
--

CREATE TABLE `upload_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dlt` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `upload_documents`
--

INSERT INTO `upload_documents` (`id`, `schedule_id`, `status`, `dlt`, `created_at`, `updated_at`) VALUES
(1, 1, '0', '0', '2021-07-30 18:54:59', '2021-07-30 18:54:59'),
(2, 2, '0', '0', '2021-07-30 18:55:41', '2021-07-30 18:55:41'),
(3, 3, '0', '0', '2021-07-31 01:30:32', '2021-07-31 01:30:32'),
(4, 4, '0', '0', '2021-07-31 01:37:34', '2021-07-31 01:37:34');

-- --------------------------------------------------------

--
-- Table structure for table `upload_document_details`
--

CREATE TABLE `upload_document_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `upload_document_id` int(11) NOT NULL,
  `document_detail_id` int(11) NOT NULL,
  `document_upload` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `document_file_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `dlt` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@uvers.ac.id', '$2y$10$7BMEXHdMnm2mFnpYFtmsQ.FdiZ/7Dob8HilfbIQ.orZX6j9nS4TPC', 'admin', NULL, '2021-07-21 16:41:53', '2021-07-21 16:41:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_lists`
--
ALTER TABLE `check_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_list_details`
--
ALTER TABLE `check_list_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clock`
--
ALTER TABLE `clock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_details`
--
ALTER TABLE `document_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `findings`
--
ALTER TABLE `findings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finding_details`
--
ALTER TABLE `finding_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `identities`
--
ALTER TABLE `identities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_key_index` (`key`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `standards`
--
ALTER TABLE `standards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `standard_details`
--
ALTER TABLE `standard_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `standard_documents`
--
ALTER TABLE `standard_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_documents`
--
ALTER TABLE `upload_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_document_details`
--
ALTER TABLE `upload_document_details`
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
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `check_lists`
--
ALTER TABLE `check_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `check_list_details`
--
ALTER TABLE `check_list_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clock`
--
ALTER TABLE `clock`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_details`
--
ALTER TABLE `document_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `findings`
--
ALTER TABLE `findings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finding_details`
--
ALTER TABLE `finding_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `identities`
--
ALTER TABLE `identities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `standards`
--
ALTER TABLE `standards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `standard_details`
--
ALTER TABLE `standard_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `standard_documents`
--
ALTER TABLE `standard_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `upload_documents`
--
ALTER TABLE `upload_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `upload_document_details`
--
ALTER TABLE `upload_document_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
