-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2019 at 11:38 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sig_wonogiri`
--
CREATE DATABASE IF NOT EXISTS `sig_wonogiri` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sig_wonogiri`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `kategori` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marker` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `kategori`, `marker`, `id_user`, `created_at`, `updated_at`) VALUES
(2, 'Wisata Pantai', '1550379520.png', 1, '2019-02-16 20:58:40', '2019-02-16 20:58:40'),
(3, 'Wisata Pertunjukan', '1550379561.png', 1, '2019-02-16 20:59:21', '2019-02-16 20:59:21'),
(4, 'Wisata Kuliner', '1550379600.png', 1, '2019-02-16 20:59:45', '2019-02-16 21:00:00'),
(5, 'Wisata Religi', '1550379626.png', 1, '2019-02-16 21:00:26', '2019-02-16 21:00:26'),
(6, 'Wisata Buatan', '1550638332.png', 1, '2019-02-19 20:52:12', '2019-02-19 20:52:12'),
(7, 'Wisata Budaya', '1552535872.png', 1, '2019-03-13 19:57:53', '2019-03-13 19:57:53'),
(8, 'Wisata Pendidika', '1552536819.png', 1, '2019-03-13 20:13:39', '2019-11-24 01:12:15'),
(9, 'Wisata Ghaib', '1571933670.jpg', 3, '2019-10-24 08:14:30', '2019-10-24 08:14:30'),
(10, 'Wisata alam ghaib', '1571987204.jpg', 3, '2019-10-24 23:06:47', '2019-10-24 23:06:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2019_02_11_113637_create_categories_table', 1),
(12, '2019_02_11_113727_create_wisatas_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `username`, `email_verified_at`, `password`, `foto`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'rian bayu', 'rian@gmail.com', 'rianbayusaputra', NULL, '$2y$10$LmXiWU2Yy52tRCaTOX.T6OkPRinyuN2qhAYo1o9CBVrvoxAACN83W', '1550637678.png', 'admin', 'F0Yimda8GQ5Q84ASYrK3OQHhu5mazhFVPz3bH2g8sEj1quZg9NRYAuRUziA2', NULL, '2019-12-13 02:32:54', NULL),
(2, 'zahrul', 'zahrul@gmail.com', 'zahrulgunawan', NULL, 'zahrul gunawan', '1550637189.png', 'admin', 'ceDOWnWdxmkKZn701bJzgSy7vKF8JUV9vhmIbp1cg9rc2OuBpUoBCK0nvokd', NULL, '2019-02-19 20:33:09', NULL),
(3, 'admin', 'admin@admin', 'admin', '2019-10-24 16:03:01', '$2y$10$NS7n7IDtjmLGiW1IN3cmyeZpzJgzzhWAg2VxrxAsPCjcDvINjmyYC', NULL, 'admin', 'Pgt1AEHcRbtibFyF5z64tn8N2X2djpSHZGOxcMA6OnegIlgIuZy8EblePKkP', '2019-10-24 16:03:01', NULL, NULL),
(4, 'Super Admin', 'super@admin', 'Super Admin', '2019-10-30 05:47:23', '$2y$10$5ORAHxH6QaSvg8f9Ddixmex5VgZvGfoyJia1QmvC44oHQvSvELlz.', NULL, 'super-admin', 'GGqhn2HXmnAsNzKAfGltOPZRSVUuhO0TViYTX4RZuwwodxJKuDB9YWb5ECJx', '2019-10-30 05:47:23', NULL, NULL),
(5, 'rizky', 'rizky@gmail.com', 'rizky', NULL, '$2y$10$xp5znGaK5jA/HpNrvwo1UuomBRiEZtdhrBwtJGYPIjVvnRpdCmaum', 'X94UjDO8Ts71K2tQPr7b3lamRf6u88mbqKXkwg0L.png', 'admin', 'MqPE53fX40Zwwt3sGTf8uo93onvaNhSR1nM63zFWa6Kun0v6kfJ1BCzVvOaH', '2019-11-24 03:18:27', '2019-11-24 04:00:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wisatas`
--

CREATE TABLE `wisatas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wisatas`
--

INSERT INTO `wisatas` (`id`, `nama`, `alamat`, `no_telp`, `keterangan`, `lat`, `long`, `foto`, `id_user`, `id_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Pantai Sanur', 'JL. jalan', '089890', 'asdasdasdada', '-7.79732305778985', '110.89074027468268', '1552535053.jpg', 1, 2, '2019-02-16 22:31:49', '2019-03-13 19:44:13'),
(3, 'Pasar Krisak', 'Jl. Raya', '089', 'khkahskhfajhfs', '-7.799704090189563', '110.87258708406989', '1552535087.jpg', 1, 6, '2019-03-08 05:24:57', '2019-03-13 19:44:47'),
(4, 'Masjid', 'Jl. Raya', '089', 'test', '-7.79411', '110.883809', '1552535216.jpg', 1, 5, '2019-03-13 03:44:13', '2019-03-13 19:46:56'),
(6, 'Pantai Sembukan', 'Paranggupito, Kabupaten Wonogiri, Jawa Tengah', '089', 'pantai', '-8.2043399', '110.8422643', '1552535028.jpg', 1, 2, '2019-03-13 19:43:48', '2019-03-13 19:43:48'),
(7, 'pantai nampu', 'Gunturharjo, Paranggupito, Kabupaten Wonogiri, Jawa Tengah 57678', '089', 'tes', '-8.2104915', '110.9012978', '1552535191.jpg', 1, 2, '2019-03-13 19:46:31', '2019-03-13 19:46:31'),
(8, 'pantai prinjono', 'Gunturharjo, Paranggupito, Kabupaten Wonogiri, Jawa Tengah 57678', '089', 'tes', '-8.2111809', '110.8873702', '1552535295.jpg', 1, 2, '2019-03-13 19:48:15', '2019-03-13 19:48:15'),
(9, 'pantai waru', 'Petir, Gunturharjo, Paranggupito, Kabupaten Wonogiri, Jawa Tengah 57678', '089', 'tes', '-8.2111416', '110.8948209', '1552535401.jpg', 1, 2, '2019-03-13 19:50:01', '2019-03-13 19:50:01'),
(13, 'waduk jarak', 'Ladang,Hutan, Selopuro, Batuwarno, Kabupaten Wonogiri, Jawa Tengah', '089', 'test', '-7.9933331', '110.9745785', '1552535730.jpg', 1, 6, '2019-03-13 19:55:30', '2019-03-13 19:55:30'),
(14, 'kahyangan', 'Bangunsari, Dlepih, Tirtomoyo, Kabupaten Wonogiri, Jawa Tengah 57672', '089', 'test', '-7.9788191', '111.0760109', '1552535974.jpg', 1, 7, '2019-03-13 19:59:34', '2019-03-13 19:59:34'),
(15, 'masjid tiban', 'Wonokerso, Sendangrejo, Baturetno, Kabupaten Wonogiri, Jawa Tengah 57673', '089', 'test', '-7.882592', '110.9700323', '1552536053.jpg', 1, 5, '2019-03-13 20:00:53', '2019-03-13 20:00:53'),
(16, 'agrowisata setren', 'Ngerapah, Setren, Slogohimo, Kabupaten Wonogiri, Jawa Tengah 57694', '089', 'test', '-7.7265041', '111.1691531', '1552536133.jpg', 1, 6, '2019-03-13 20:02:13', '2019-03-13 20:02:13'),
(17, 'pesanggrahan raden mas sahid', 'Sikalas, Bubakan, Girimarto, Kabupaten Wonogiri, Jawa Tengah 57683', '089', 'test', '-7.7397006', '111.1243215', '1552536186.jpg', 1, 5, '2019-03-13 20:03:06', '2019-03-13 20:03:06'),
(18, 'waduk tandon', 'Tlogorejo, Pare, Selogiri, Kabupaten Wonogiri, Jawa Tengah 57652', '089', 'test', '-7.803903', '110.8947009', '1552536231.jpg', 1, 6, '2019-03-13 20:03:51', '2019-03-13 20:03:51'),
(20, 'tugu pusaka', 'Jl. Wonogiri - Sukoharjo, Gunungwijil, Kaliancar, Selogiri, Kabupaten Wonogiri, Jawa Tengah 57652', '089', 'test', '-7.7799829', '110.8890857', '1552536365.jpg', 1, 6, '2019-03-13 20:06:05', '2019-03-13 20:06:05'),
(21, 'monumen bedhol desa', 'Karang Talun, Pokohkidul, Kec. Wonogiri, Kabupaten Wonogiri, Jawa Tengah 57615', '089', 'test', '-7.8358382', '110.931535', '1552536420.jpg', 1, 7, '2019-03-13 20:07:00', '2019-03-13 20:07:00'),
(22, 'prasasti nglaroh', 'Nglaroh, Pule, Selogiri, Kabupaten Wonogiri, Jawa Tengah 57652', '089', 'test', '-7.778022', '110.8696471', '1552536498.jpg', 1, 7, '2019-03-13 20:08:18', '2019-03-13 20:08:18'),
(23, 'bendungan waduk gajah mungkur', 'Jl. Raya Pracimantoro-Wonogiri No.39, Godean, Sendang, Kec. Wonogiri, Kabupaten Wonogiri, Jawa Tengah 57615', '089', 'test', '-7.8554828', '110.9104553', '1552536574.jpg', 1, 7, '2019-03-13 20:09:34', '2019-03-13 20:09:34'),
(24, 'sendang asri', 'Jl. Raya Pracimantoro-Wonogiri No.39, Godean, Sendang, Kec. Wonogiri, Kabupaten Wonogiri, Jawa Tengah 57615', '089', 'test', '-7.8533854', '110.906683', '1552536634.jpg', 1, 3, '2019-03-13 20:10:34', '2019-03-13 20:10:34'),
(25, 'museum wayang', 'Jl. Raya Wuryantoro, Ngebel, Wuryantoro, Kabupaten Wonogiri, Jawa Tengah 57661', '089', 'test', '-7.9073696', '110.8630413', '1552536676.jpg', 1, 7, '2019-03-13 20:11:16', '2019-03-13 20:11:16'),
(27, 'Museum Kars', 'Karang Lo Wetan, Gebangharjo, Pracimantoro, Kabupaten Wonogiri, Jawa Tengah 57664', '089', 'test', '-8.0414635', '110.7810027', '1552536874.jpg', 1, 8, '2019-03-13 20:14:34', '2019-03-13 20:14:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_kategori_unique` (`kategori`),
  ADD KEY `categories_id_user_foreign` (`id_user`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `wisatas`
--
ALTER TABLE `wisatas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wisatas_id_user_foreign` (`id_user`),
  ADD KEY `wisatas_id_kategori_foreign` (`id_kategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wisatas`
--
ALTER TABLE `wisatas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wisatas`
--
ALTER TABLE `wisatas`
  ADD CONSTRAINT `wisatas_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wisatas_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
