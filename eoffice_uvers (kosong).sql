-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 15, 2021 at 05:38 AM
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
(1, 'Disposisi', 'Disposisi', '2021-09-28 20:06:17', '2021-09-28 20:06:17', '0'),
(2, 'Diterima', 'Diterima', '2021-09-28 20:06:17', '2021-09-28 20:06:17', '0'),
(3, 'Ditolak', 'Ditolak', '2021-09-28 20:06:17', '2021-09-28 20:06:17', '0'),
(4, 'Selesai', 'Selesai', '2021-09-28 20:06:17', '2021-09-28 20:06:17', '0');

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
(258, 'Create Roles', 'employeerole.create', 'web', '2021-07-30 19:33:54', '2021-07-30 19:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `permissions_copy1`
--

CREATE TABLE `permissions_copy1` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions_copy1`
--

INSERT INTO `permissions_copy1` (`id`, `label`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
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
(258, 1);

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
  `laporan` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `status_laporan_id` int(11) DEFAULT NULL,
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
(2, 'Rektorat', NULL, '', 'Rektor', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0'),
(3, 'Direktorat Akademik', NULL, '', 'Kepala Bagian', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0'),
(4, 'Direktorat Kepegawaian', NULL, '', 'Kepala Bagian', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0'),
(5, 'Direktorat Umum', NULL, '', 'Kepala Bagian', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0'),
(6, 'UPT TIK', NULL, '', 'Kepala Bagian', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0'),
(7, 'LPPM', NULL, '', 'Kepala Bagian', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0'),
(8, 'Fakultas Bisnis', NULL, '', 'Dekan', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0'),
(9, 'Fakultas Komputer', NULL, '', 'Dekan', '2021-11-04 22:45:14', '2021-11-04 22:45:14', '0'),
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
-- Indexes for table `permissions_copy1`
--
ALTER TABLE `permissions_copy1`
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
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT for table `permissions_copy1`
--
ALTER TABLE `permissions_copy1`
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
