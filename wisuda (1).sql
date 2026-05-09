-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2026 at 02:59 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wisuda`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catatan`
--

CREATE TABLE `catatan` (
  `id_catatan` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `id_mhs` int NOT NULL,
  `catatan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_accounts`
--

CREATE TABLE `email_accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `app_password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `informasi_wisuda`
--

CREATE TABLE `informasi_wisuda` (
  `id_info` int NOT NULL,
  `jadwal_undangan` date DEFAULT NULL,
  `lokasi` varchar(255) NOT NULL,
  `jumlah_wisudawan` int NOT NULL,
  `mahasiswa_aktif` int DEFAULT NULL,
  `calon_lulusan` int DEFAULT NULL,
  `informasi_baak` text,
  `foto_gallery` varchar(255) DEFAULT NULL,
  `foto_gallery_2` varchar(255) DEFAULT NULL,
  `foto_gallery_3` varchar(255) DEFAULT NULL,
  `foto_gallery_4` varchar(255) DEFAULT NULL,
  `info_lulusan` text,
  `jadwal_wisuda` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `informasi_wisuda`
--

INSERT INTO `informasi_wisuda` (`id_info`, `jadwal_undangan`, `lokasi`, `jumlah_wisudawan`, `mahasiswa_aktif`, `calon_lulusan`, `informasi_baak`, `foto_gallery`, `foto_gallery_2`, `foto_gallery_3`, `foto_gallery_4`, `info_lulusan`, `jadwal_wisuda`, `created_at`, `updated_at`, `status`) VALUES
(22, NULL, 'Tokyo', 2, 22, 2, ',wfkkjf ekdfnvjkfr', 'uploads/gallery/1774884405_foto_gallery_WhatsApp Image 2026-03-30 at 08.41.18.jpeg', 'uploads/gallery/1774884405_foto_gallery_2_ERD Noise Safe.jpeg', 'uploads/gallery/1774884405_foto_gallery_3_WhatsApp Image 2026-03-30 at 08.41.18.jpeg', 'uploads/gallery/1774884405_foto_gallery_4_ERD Noise Safe.jpeg', NULL, '2026-03-30', '2026-03-30 08:26:45', '2026-03-30 08:26:45', NULL),
(23, NULL, 'yapyap', 123, 456, 789, 'lkenfjaergjbisergh', 'uploads/gallery/1775126577_foto_gallery_WhatsApp Image 2026-03-30 at 08.41.18.jpeg', 'uploads/gallery/1775126577_foto_gallery_2_ERD Noise Safe.jpeg', 'uploads/gallery/1775126577_foto_gallery_3_WhatsApp Image 2026-03-30 at 08.41.18.jpeg', 'uploads/gallery/1775126577_foto_gallery_4_ERD Noise Safe.jpeg', NULL, '2026-04-02', '2026-04-02 03:42:57', '2026-04-02 20:57:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kesan`
--

CREATE TABLE `kesan` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kesan` text,
  `tanggal` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kesan`
--

INSERT INTO `kesan` (`id`, `nama`, `kesan`, `tanggal`, `status`) VALUES
(11, 'Liana Syifa Fauzia', 'Sangat Memuaskan,Wisuda dilaksanakan dengan baik, dan dosen dosen pun mengajar dengan sangat baik.', '2026-03-14', 1),
(13, 'Ririn Dwi Ariyanti', 'Semua berjalan lancar, dan juga meriah. Semuanya teratur dan dosennya mengajar dengan baik, juga ramah ramah.', '2026-03-14', 1),
(14, 'Hani Ayu Fadila', 'bagus lah ya', '2026-03-29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `nim` varchar(30) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `tahun` year NOT NULL,
  `fakultas` varchar(100) DEFAULT NULL,
  `jenjang` varchar(50) DEFAULT NULL,
  `no_telp` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `nim`, `prodi`, `foto_profil`, `tahun`, `fakultas`, `jenjang`, `no_telp`, `email`, `alamat`, `tempat_lahir`, `tanggal_lahir`) VALUES
(29, 'Liana Syifa Fauzia', '4337855201230112', 'S1 Informatika', 'profil_mahasiswa/4337855201230112.jpeg', 2027, 'FICT', 'S1', '085891595147', 'liana.fauzia.fict@gmail.com', 'Rengasdengklok', 'Jakarta', '2005-05-04'),
(30, 'Ririn Dwi Ariyanti', '4337855201230045', 'S1 Keperawatan', 'profil_mahasiswa/4337855201230045.jpg', 2027, 'FHS', 'D3', '085891595147', 'ririn.ariyanti.fict@gmail.com', 'Bolang', 'Solo, Jawa', '2006-01-21'),
(31, 'Hani Ayu Fadila', '4337855201230046', 'S1 Akuntansi', 'profil_mahasiswa/4337855201230046.jpg', 2023, 'FMB', 'S1', '085891595147', 'hani@gmail.com', 'Johar', 'Karawang', '2005-06-07'),
(32, 'Wulan', '4337855201230047', 'S1 Gizi', 'profil_mahasiswa/4337855201230047.jpg', 2023, 'FHS', 'D3', '085891595147', 'wulani@gmail.com', 'Johar', 'Karawang', '2005-06-07'),
(33, 'Fauzia', '4337855201230113', 'S1 Informatika', 'profil_mahasiswa/4337855201230113.jpeg', 2024, 'FICT', 'S1', '085891595147', 'liana.fauzia.fict@krw.horizon.ac.id', 'Rengasdengklok', 'Jakarta', '2005-05-04'),
(38, 'Liana', '4337855201230114', 'S1 Informatika', NULL, 2024, 'FICT', 'D3', '085891595147', 'lianasyifafauzia@gmail.com', 'Rengasdengklok', 'Jakarta', '2005-05-04'),
(39, 'Gita Rizky', '9999000000000001', 'S1 Informatika', NULL, 2024, 'FICT', 'S1', '081111111111', 'budi.test@gmail.com', 'Bandung', 'Bandung', '2003-05-20'),
(40, 'Najwa Alya', '9999000000000002', 'S1 Manajemen', NULL, 2024, 'FMB', 'S1', '082222222222', 'siti.test@krw.horizon.ac.id', 'Jakarta', 'Jakarta', '2003-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `media_wisuda`
--

CREATE TABLE `media_wisuda` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_wisuda`
--

INSERT INTO `media_wisuda` (`id`, `judul`, `gambar`, `deskripsi`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 'wisuda', 'media-wisuda/nU4fesISjOVDs8IGvGzYj8pCSf0hOPizp6GlBmY1.jpg', 'kjbsbcjsb', 1, '2025-12-27 18:12:05', '2025-12-27 18:12:05'),
(2, 'vf', 'media-wisuda/DHJC2dmYiP9wxGFuQFSkgKvYNCfQbqfGQsRXY7QG.png', 'advf', 2, '2025-12-27 18:25:42', '2025-12-27 18:25:42');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_27_135504_create_media_wisuda_table', 1),
(5, '2025_12_27_135505_create_testimoni_table', 1),
(6, '2025_12_27_135506_create_statistik_table', 1),
(7, '2025_12_28_003415_add_username_to_users_table', 2),
(8, '2025_12_28_004804_add_username_and_role_to_users_table', 3),
(9, '2026_03_05_124426_add_kode_pen_to_togas_table', 4),
(11, '2026_03_12_042342_add_foto_gallery_234_to_informasi_wisuda', 6),
(12, '2026_03_29_035625_add_nama_kaprodi_dekan_to_pendaftaran_wisuda', 7),
(13, '2026_04_02_103449_add_notif_last_seen_to_users', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_otps`
--

CREATE TABLE `password_otps` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `otp_code` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('liana.fauzia.fict@krw.horizon.ac.id', '668128', '2026-04-17 02:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_wisuda`
--

CREATE TABLE `pendaftaran_wisuda` (
  `id_pendaftaran` int NOT NULL,
  `id_mahasiswa` int NOT NULL,
  `tgl_pendaftaran` date NOT NULL,
  `status_pendaftaran` enum('pending','disetujui','ditolak') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_valid_finance` tinyint(1) DEFAULT '0',
  `is_valid_perpus` tinyint(1) DEFAULT '0',
  `is_valid_csdl` tinyint(1) DEFAULT '0',
  `is_valid_fakultas` tinyint(1) DEFAULT '0',
  `is_valid_baak` tinyint(1) DEFAULT '0',
  `catatan_baak` varchar(200) DEFAULT NULL,
  `nama_kaprodi` varchar(255) DEFAULT NULL,
  `nama_dekan` varchar(255) DEFAULT NULL,
  `catatan_finance` varchar(200) DEFAULT NULL,
  `catatan_csdl` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `catatan_perpus` varchar(200) DEFAULT NULL,
  `catatan_facultas` varchar(200) DEFAULT NULL,
  `judul_deskriptif` int DEFAULT NULL,
  `tanggal_perkiraan_wisuda` date DEFAULT NULL,
  `ipk` int DEFAULT NULL,
  `judul_skripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `catatan_fakultas` text,
  `is_read` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pendaftaran_wisuda`
--

INSERT INTO `pendaftaran_wisuda` (`id_pendaftaran`, `id_mahasiswa`, `tgl_pendaftaran`, `status_pendaftaran`, `created_at`, `updated_at`, `is_valid_finance`, `is_valid_perpus`, `is_valid_csdl`, `is_valid_fakultas`, `is_valid_baak`, `catatan_baak`, `nama_kaprodi`, `nama_dekan`, `catatan_finance`, `catatan_csdl`, `catatan_perpus`, `catatan_facultas`, `judul_deskriptif`, `tanggal_perkiraan_wisuda`, `ipk`, `judul_skripsi`, `catatan_fakultas`, `is_read`) VALUES
(37, 29, '2026-03-14', 'pending', '2026-03-13 20:59:18', '2026-04-02 04:11:12', 1, 1, 1, 1, 1, 'Baik', 'Dr. siapa aja', 'Bu Lila', NULL, 'sama', NULL, NULL, NULL, NULL, 4, 'Aplikasi Bagi Hasil untuk Lahan Petani', 'belum ini belum', 1),
(38, 30, '2026-03-14', 'pending', '2026-03-13 21:21:06', '2026-03-13 23:03:49', 1, 1, 1, 1, 1, 'Baik', NULL, NULL, 'baik banget', 'belum ini', 'oke deh', NULL, NULL, NULL, 4, 'Aplikasi Bagi Hasil untuk Lahan Petani', 'nice', 0),
(41, 32, '2026-03-29', 'pending', '2026-03-28 22:50:40', '2026-04-03 02:58:54', 1, 1, 1, 1, 1, NULL, NULL, NULL, 'sioppp', 'cukup bagus', 'wahhh', NULL, NULL, NULL, 2, 'ehrrt', 'okeokeokeoeoke', 0),
(42, 31, '2026-03-29', 'pending', '2026-03-28 22:54:17', '2026-04-03 02:16:38', 1, 1, 1, 1, 1, NULL, 'oke oke', 'aman ya', 'siapp', 'kjbjkbj', 'yakk', NULL, NULL, NULL, 4, 'errrrrhgryfnrf', 'bbbedv', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengambilan`
--

CREATE TABLE `pengambilan` (
  `id_pengambilan` int NOT NULL,
  `id_pendaftaran` int NOT NULL,
  `ukuran` varchar(10) DEFAULT NULL,
  `catatan` text,
  `kode_pen` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_list` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengambilan`
--

INSERT INTO `pengambilan` (`id_pengambilan`, `id_pendaftaran`, `ukuran`, `catatan`, `kode_pen`, `created_at`, `updated_at`, `status_list`) VALUES
(29, 37, 'All Size', NULL, 'SKR0001', '2026-03-13 20:59:18', '2026-04-02 04:11:21', 1),
(30, 38, 'All Size', 'Buat lebih kecil ya', 'SKR0002', '2026-03-13 21:21:06', '2026-03-13 23:04:22', 1),
(33, 41, 'All Size', NULL, NULL, '2026-03-28 22:50:40', '2026-03-28 22:50:40', 0),
(34, 42, 'All Size', 'huaa', NULL, '2026-03-28 22:54:17', '2026-04-03 02:19:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `qna`
--

CREATE TABLE `qna` (
  `id_qna` int NOT NULL,
  `pertanyaan` text NOT NULL,
  `jawaban` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `qna`
--

INSERT INTO `qna` (`id_qna`, `pertanyaan`, `jawaban`, `created_at`, `updated_at`) VALUES
(9, 'boleh bawa orang tua?', 'Ya bolehy', '2026-03-13 22:37:59', '2026-04-02 20:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skpi`
--

CREATE TABLE `skpi` (
  `id_skpi` int NOT NULL,
  `id_mahasiswa` int NOT NULL,
  `tgl_pengajuan_mahasiswa` date NOT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tahun_lulus` year DEFAULT NULL,
  `no_ijazah` varchar(100) DEFAULT NULL,
  `gelar` varchar(100) DEFAULT NULL,
  `sk_pendirian_perti` varchar(255) DEFAULT NULL,
  `persyaratan_penerimaan` text,
  `nama_perti` varchar(255) DEFAULT NULL,
  `bahasa_pengantar_kuliah` varchar(100) DEFAULT NULL,
  `sistem_penilaian` text,
  `kelas` varchar(50) DEFAULT NULL,
  `lama_studi_rg` varchar(50) DEFAULT NULL,
  `jenjang_pd_lanjutan` varchar(100) DEFAULT NULL,
  `jenjang_kualif_kkn1` varchar(100) DEFAULT NULL,
  `status_profesi` varchar(100) DEFAULT NULL,
  `penguasaan_pengetahuan` text,
  `aktiv_pres_penghargaan` text,
  `magang` text,
  `jenjangpend_syaratbelajar` varchar(100) DEFAULT NULL,
  `sks_lamastudi` int DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `tanggal_skpi` date DEFAULT NULL,
  `nama_dekan` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT (now()),
  `file_pdf` varchar(255) DEFAULT NULL,
  `kemampuan_kerja` varchar(255) DEFAULT NULL,
  `info_kkni` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `skpi`
--

INSERT INTO `skpi` (`id_skpi`, `id_mahasiswa`, `tgl_pengajuan_mahasiswa`, `tempat_lahir`, `tahun_lulus`, `no_ijazah`, `gelar`, `sk_pendirian_perti`, `persyaratan_penerimaan`, `nama_perti`, `bahasa_pengantar_kuliah`, `sistem_penilaian`, `kelas`, `lama_studi_rg`, `jenjang_pd_lanjutan`, `jenjang_kualif_kkn1`, `status_profesi`, `penguasaan_pengetahuan`, `aktiv_pres_penghargaan`, `magang`, `jenjangpend_syaratbelajar`, `sks_lamastudi`, `kota`, `tanggal_skpi`, `nama_dekan`, `updated_at`, `created_at`, `file_pdf`, `kemampuan_kerja`, `info_kkni`) VALUES
(24, 29, '2026-03-14', 'jakarta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Penghargaan dengan Presentasi Terbaik', 'DI Perusahaan Terbaik di Jakarta', NULL, NULL, NULL, NULL, NULL, '2026-03-13 21:08:38', '2026-03-13 21:08:38', '1773461318_format skpi baak.pdf', NULL, NULL),
(25, 30, '2026-03-14', 'Solo', 2026, '947985679584', 'Sarjana', 'kv sk nv', 'kndfa', NULL, 'indonesia', 'Aman', 'pagi', 'lknvslkn', 'kjsvdnkjn', 'level 6', 'n kn', 'ty', 'Penghargaan Desain Terbaik', 'Di Perusahaan Terbaik di Jakarta', 'kjenkjesn', 8, 'tnjye', '2026-04-03', 'tye', '2026-04-02 20:53:50', '2026-03-13 21:21:39', '1773462099_format skpi baak.pdf', 'gdc', 'mgdt'),
(27, 32, '2026-03-29', 'Karawang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'zhrs', 'jrts', NULL, NULL, NULL, NULL, NULL, '2026-03-28 22:50:55', '2026-03-28 22:50:55', '1774763455_format daftar wisuda baak.pdf', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `statistik`
--

CREATE TABLE `statistik` (
  `id` bigint UNSIGNED NOT NULL,
  `total_lulusan` int NOT NULL DEFAULT '0',
  `mahasiswa_aktif` int NOT NULL DEFAULT '0',
  `calon_lulusan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `syarat_ketentuan`
--

CREATE TABLE `syarat_ketentuan` (
  `id` int NOT NULL,
  `deskripsi_1` text NOT NULL,
  `deskripsi_2` text NOT NULL,
  `deskripsi_3` text NOT NULL,
  `foto_1` varchar(255) NOT NULL,
  `foto_2` varchar(255) NOT NULL,
  `foto_3` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_lulus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimoni` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('mahasiswa','baak','finance','perpustakaan','fakultas','csdl') COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hint_last_char` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notif_last_seen` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `role`, `foto`, `email_verified_at`, `password`, `password_hint_last_char`, `remember_token`, `created_at`, `updated_at`, `notif_last_seen`) VALUES
(1, '4337855201230000', NULL, NULL, 'baak', 'uploads/profil/1775188721_formal.jpeg', NULL, '$2y$12$Fe7HTJt0x92g5vlKO1dm6eof/cTF3sMlmVrakLJcMNOEsCrx4Caa2', '!', NULL, '2025-12-27 17:53:14', '2026-04-02 20:58:41', NULL),
(3, '4337855201230001', NULL, NULL, 'finance', 'uploads/profil/1773284221_formal.jpeg', NULL, '$2y$12$xwcb38YNSGfRYF/wTxRS9OTnBixjvKrWZk6qdVjwVIg/Kowf/Y0g.', '6', NULL, '2025-12-27 18:54:15', '2026-03-11 19:58:01', NULL),
(4, '4337855201230002', NULL, NULL, 'perpustakaan', NULL, NULL, '$2y$12$haaqN3ldrAtFbXiIdfKlNODj1L20CxIpw6RnLAHYkJygx4l5Bhraq', NULL, NULL, '2025-12-27 18:55:13', '2025-12-27 18:55:13', NULL),
(5, '4337855201230003', NULL, NULL, 'fakultas', NULL, NULL, '$2y$12$iFw6w/NU2EtBVpE0VQZ69ukERux8GrQfn9h7F5OVILTa8rRKmEIGi', NULL, NULL, '2025-12-27 18:56:30', '2025-12-27 18:56:30', NULL),
(7, '4337855201230004', NULL, NULL, 'csdl', NULL, NULL, '$2y$12$hhFRWvck1kY.gpF/yiBenO6b9BVVBZYFIFp2yM1ce9rfRbkq64q8S', NULL, NULL, '2026-02-24 02:58:43', '2026-02-24 02:58:43', NULL),
(15, '4337855201230112', NULL, NULL, 'mahasiswa', NULL, NULL, '$2y$12$2zWxkRTDy9lwMUOczAOEX.7zvec6TCReoGC7peua7519TeY5oHaKq', NULL, NULL, '2026-03-11 20:27:45', '2026-04-02 03:43:27', '2026-04-02 03:43:27'),
(16, '4337855201230045', NULL, NULL, 'mahasiswa', NULL, NULL, '$2y$12$vh3w0zvKArfGQuf58gYzYemQdoLEQWYUPVHr6XilWx81UAmUkf0o6', NULL, NULL, '2026-03-11 20:28:45', '2026-04-02 03:43:58', '2026-04-02 03:43:58'),
(17, '4337855201230046', NULL, NULL, 'mahasiswa', NULL, NULL, '$2y$12$vTwp9h1cjUVREOouqoFhdefYPwTG2gcm0fXxo5btJc9llsWlF/DTq', NULL, NULL, '2026-03-28 21:51:22', '2026-04-03 02:15:07', '2026-04-03 02:15:07'),
(18, '4337855201230047', NULL, NULL, 'mahasiswa', NULL, NULL, '$2y$12$/OZW7tJEVHTVXnHS74iPOeHealXotqdCD5Xo49pKVzfPQDLeoHxfG', NULL, NULL, '2026-03-28 22:49:28', '2026-04-02 03:46:24', '2026-04-02 03:46:24'),
(19, '4337855201230113', NULL, NULL, 'mahasiswa', NULL, NULL, '$2y$12$14W3z.H71pEy3rPqYAGPxeM26iASr.TcwSKOQIobsn340qzeZKsBe', NULL, NULL, '2026-04-02 03:55:29', '2026-04-17 01:40:03', '2026-04-02 03:56:07'),
(20, '4337855201230114', NULL, NULL, 'mahasiswa', NULL, NULL, '$2y$12$VcEhmeICU.RjtcuJ/r33XuWzpI7JYIKPlB09CyWbImB5JJ7aFyReu', NULL, NULL, '2026-04-17 01:14:42', '2026-04-17 01:32:10', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id_catatan`),
  ADD KEY `fk_catatan_user` (`user_id`);

--
-- Indexes for table `email_accounts`
--
ALTER TABLE `email_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `informasi_wisuda`
--
ALTER TABLE `informasi_wisuda`
  ADD PRIMARY KEY (`id_info`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kesan`
--
ALTER TABLE `kesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indexes for table `media_wisuda`
--
ALTER TABLE `media_wisuda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_otps`
--
ALTER TABLE `password_otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pendaftaran_wisuda`
--
ALTER TABLE `pendaftaran_wisuda`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indexes for table `pengambilan`
--
ALTER TABLE `pengambilan`
  ADD PRIMARY KEY (`id_pengambilan`),
  ADD KEY `id_pendaftaran` (`id_pendaftaran`);

--
-- Indexes for table `qna`
--
ALTER TABLE `qna`
  ADD PRIMARY KEY (`id_qna`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `skpi`
--
ALTER TABLE `skpi`
  ADD PRIMARY KEY (`id_skpi`),
  ADD KEY `fk_mahasiswa_skpi` (`id_mahasiswa`);

--
-- Indexes for table `statistik`
--
ALTER TABLE `statistik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `syarat_ketentuan`
--
ALTER TABLE `syarat_ketentuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id_catatan` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_accounts`
--
ALTER TABLE `email_accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `informasi_wisuda`
--
ALTER TABLE `informasi_wisuda`
  MODIFY `id_info` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kesan`
--
ALTER TABLE `kesan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `media_wisuda`
--
ALTER TABLE `media_wisuda`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `password_otps`
--
ALTER TABLE `password_otps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendaftaran_wisuda`
--
ALTER TABLE `pendaftaran_wisuda`
  MODIFY `id_pendaftaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `pengambilan`
--
ALTER TABLE `pengambilan`
  MODIFY `id_pengambilan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `qna`
--
ALTER TABLE `qna`
  MODIFY `id_qna` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `skpi`
--
ALTER TABLE `skpi`
  MODIFY `id_skpi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `statistik`
--
ALTER TABLE `statistik`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `syarat_ketentuan`
--
ALTER TABLE `syarat_ketentuan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `catatan`
--
ALTER TABLE `catatan`
  ADD CONSTRAINT `fk_catatan_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pendaftaran_wisuda`
--
ALTER TABLE `pendaftaran_wisuda`
  ADD CONSTRAINT `pendaftaran_wisuda_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE;

--
-- Constraints for table `pengambilan`
--
ALTER TABLE `pengambilan`
  ADD CONSTRAINT `pengambilan_ibfk_1` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran_wisuda` (`id_pendaftaran`);

--
-- Constraints for table `skpi`
--
ALTER TABLE `skpi`
  ADD CONSTRAINT `fk_mahasiswa_skpi` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
