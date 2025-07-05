-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jul 2025 pada 08.12
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sakupaleza`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `beritas`
--

CREATE TABLE `beritas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `gambar` text NOT NULL,
  `konten` text NOT NULL,
  `link` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `beritas`
--

INSERT INTO `beritas` (`id`, `judul`, `gambar`, `konten`, `link`, `created_at`, `updated_at`) VALUES
(1, 'PRJ', 'berita/P6njvPR5MoxbIBo5cIOruEEBC2BQ8cvTAVamf48T.jpg', 'sdfa', 'https://youtu.be/MYz5m-59zVM?si=nPRJHDsclk4GKaJp', '2025-07-01 01:02:07', '2025-07-01 01:02:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeris`
--

CREATE TABLE `galeris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `galeris`
--

INSERT INTO `galeris` (`id`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'galeri/qecohNSsdqgVxaX7dCOkxH3ibGUcTPjpIeRKCsar.jpg', '2025-07-01 01:11:26', '2025-07-01 01:11:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` int(11) NOT NULL,
  `id_kecamatan` int(6) NOT NULL,
  `nama_kecamatan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `id_kecamatan`, `nama_kecamatan`) VALUES
(1, 327606, 'Beji'),
(2, 327611, 'Bojongsari'),
(3, 327608, 'Cilodong'),
(4, 327602, 'Cimanggis'),
(5, 327609, 'Cinere'),
(6, 327607, 'Cipayung'),
(7, 327604, 'Limo'),
(8, 327601, 'Pancoran Mas'),
(9, 327603, 'Sawangan'),
(10, 327605, 'Sukmajaya'),
(11, 327610, 'Tapos');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelurahan`
--

CREATE TABLE `kelurahan` (
  `id` int(11) NOT NULL,
  `id_kelurahan` int(11) NOT NULL,
  `id_kecamatan` int(6) NOT NULL,
  `nama_kelurahan` varchar(25) NOT NULL,
  `jarak` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelurahan`
--

INSERT INTO `kelurahan` (`id`, `id_kelurahan`, `id_kecamatan`, `nama_kelurahan`, `jarak`) VALUES
(5, 16421, 327606, 'Beji', '6'),
(6, 16422, 327606, 'Beji Timur', '4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontaks`
--

CREATE TABLE `kontaks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kontaks`
--

INSERT INTO `kontaks` (`id`, `email`, `telepon`, `lokasi`, `created_at`, `updated_at`) VALUES
(1, 'sakupaleza@gmail.com', '081234567890', 'bekasi', '2025-07-01 01:16:30', '2025-07-01 01:46:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'pirel', 'member1@member.com', '$2y$10$tiJ16kS7vco1kJXAAh1ekuupKmgaFamdc78hQ.kKW/hi0QvhzoAHG', '2025-06-30 13:19:52', '2025-06-30 13:19:52'),
(2, 'janu', 'member2@member.com', '$2y$10$gtMPLeZ3xo4qoeH2bvV/0eGeTh.yuGLMR4.bifUCEjasmFA.ixwt2', '2025-07-01 01:45:47', '2025-07-01 01:45:47'),
(3, 'arfian', 'dion@gmail.com', '$2y$10$3nR0w0HRqGa4PjFng2mHvOVuIcFdmTVWLgiQbmF3zt/GZ8xzfh786', '2025-07-02 04:56:03', '2025-07-02 04:56:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(10,2) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'dimsum', 'blablabla', 30000.00, 'menu/tIsglENvHsN9iucuPum72AbunqyYHgsoQqGokWUX.jpg', '2025-06-30 19:56:52', '2025-06-30 20:07:31'),
(2, 'esteh', 'lslasa', 10000.00, 'menu/B4sQlLwNni9jbBiZ1w7EjvDA9zxVjGDzQ0y9COxD.jpg', '2025-06-30 20:51:17', '2025-06-30 20:51:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(61, '2014_10_12_000000_create_users_table', 1),
(62, '2014_10_12_100000_create_password_resets_table', 1),
(63, '2019_08_19_000000_create_failed_jobs_table', 1),
(64, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(65, '2025_06_26_125834_create_members_table', 1),
(66, '2025_06_26_151422_create_orders_table', 1),
(67, '2025_06_26_153739_add_is_admin_to_users_table', 1),
(68, '2025_06_27_181846_create_beritas_table', 1),
(69, '2025_06_27_181909_create_galeris_table', 1),
(70, '2025_06_27_181923_create_kontaks_table', 1),
(71, '2025_07_01_024854_create_menus_table', 2),
(72, '2025_07_01_110238_add_ongkir_to_orders_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_pemesan` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `id_kecamatan` int(6) NOT NULL,
  `id_kelurahan` int(11) NOT NULL,
  `produk` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `status` enum('pending','proses','selesai','dibatalkan') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ongkir` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `member_id`, `nama_pemesan`, `telepon`, `alamat`, `id_kecamatan`, `id_kelurahan`, `produk`, `jumlah`, `total_harga`, `status`, `created_at`, `updated_at`, `ongkir`) VALUES
(1, 1, 'pirel', '081234567890', 'jl. in aja', 0, 0, 'Produk 2 x 1, Produk 1 x 1', 2, 40000.00, 'selesai', '2025-06-30 13:51:26', '2025-06-30 13:52:42', 0),
(2, 1, 'pirel', '081234567890', 'dimana aja', 0, 0, 'Produk 1 x 2, Produk 2 x 1', 3, 60000.00, 'dibatalkan', '2025-06-30 13:57:45', '2025-06-30 14:02:40', 0),
(3, 1, 'pirel', '081234567890', 'jl. in aja', 0, 0, 'Produk 1 x 1', 1, 20000.00, 'proses', '2025-06-30 13:58:29', '2025-06-30 14:02:51', 0),
(4, 1, 'pirel', '081234567890', 'jl. in aja', 0, 0, 'Produk 3 x 1', 1, 20000.00, 'selesai', '2025-06-30 14:00:46', '2025-06-30 14:02:45', 0),
(5, 1, 'pirel', '081234567890', 'jl. in aja', 0, 0, 'Produk 3 x 1', 1, 20000.00, 'proses', '2025-06-30 14:01:11', '2025-06-30 14:02:47', 0),
(6, 1, 'pirel', '081234567890', 'jl. in aja', 0, 0, 'Produk 3 x 1', 1, 20000.00, 'selesai', '2025-06-30 14:07:05', '2025-06-30 19:38:28', 0),
(7, 1, 'pirel', '081234567890', 'jl. in aja', 0, 0, 'Produk 3 x 1', 1, 20000.00, 'selesai', '2025-06-30 14:09:06', '2025-06-30 19:38:30', 0),
(8, 1, 'pirel', '081234567891', 'dimana aja', 0, 0, 'Produk 3 x 1', 1, 20000.00, 'selesai', '2025-06-30 19:31:27', '2025-06-30 19:38:26', 0),
(9, 1, 'lala', '081234567890', 'jl. in aja', 0, 0, 'Produk 2 x 1', 1, 20000.00, 'selesai', '2025-06-30 19:33:44', '2025-06-30 19:38:23', 0),
(10, 1, 'lala', '081234567890', 'jl. in aja', 0, 0, 'Produk 1 x 1', 1, 0.00, 'selesai', '2025-06-30 19:41:43', '2025-06-30 20:43:24', 0),
(11, 1, 'lala', '081234567890', 'jl. in aja', 0, 0, 'Produk 1 x 1', 1, 0.00, 'selesai', '2025-06-30 19:43:01', '2025-06-30 20:43:22', 0),
(12, 1, 'lala', '081234567890', 'jl. in aja', 0, 0, 'dimsum x 8, esteh x 1', 9, 170000.00, 'selesai', '2025-06-30 20:53:35', '2025-06-30 20:56:51', 0),
(13, 1, 'danu', '098765432123', 'jl. in aja', 0, 0, 'dimsum x 2, esteh x 1', 3, 70000.00, 'selesai', '2025-06-30 21:36:43', '2025-06-30 21:36:59', 0),
(14, 1, 'adit', '123456789012', 'jl. in aja', 0, 0, 'dimsum x 1, esteh x 1', 2, 40000.00, 'selesai', '2025-06-30 21:57:20', '2025-06-30 22:00:15', 0),
(15, 1, 'janu', '081234567890', 'jl. in aja', 0, 0, 'dimsum x 2, esteh x 1', 3, 70000.00, 'selesai', '2025-06-30 21:58:39', '2025-06-30 22:00:23', 0),
(16, 1, 'nisa', '081234567890', 'jl. in aja', 0, 0, 'dimsum x 1', 1, 30000.00, 'selesai', '2025-06-30 22:23:20', '2025-06-30 22:23:31', 0),
(17, 1, 'rel', '081234567890', 'jl. in aja', 0, 0, ' x 1, dimsum x 2', 3, 60000.00, 'selesai', '2025-07-01 00:46:05', '2025-07-01 00:47:17', 0),
(18, 1, 'janu', '081234567890', 'jl. in aja', 0, 0, 'dimsum x 1, esteh x 1', 2, 40000.00, 'selesai', '2025-07-01 00:56:10', '2025-07-01 00:56:40', 0),
(19, 1, 'muji', '081234567890', 'jl. in aja', 0, 0, 'dimsum x 1, esteh x 1', 2, 40000.00, 'selesai', '2025-07-01 01:21:54', '2025-07-01 01:25:48', 0),
(20, 1, 'muji', '081234567890', 'jl. in aja', 0, 0, 'dimsum x 1, esteh x 1', 2, 40000.00, 'selesai', '2025-07-01 01:22:36', '2025-07-01 01:25:46', 0),
(21, 1, 'muji', '081234567890', 'jl. in aja', 0, 0, 'dimsum x 1, esteh x 1', 2, 40000.00, 'selesai', '2025-07-01 01:23:27', '2025-07-01 01:25:41', 0),
(22, 1, 'muji', '081234567890', 'jl. in aja', 0, 0, 'dimsum x 1, esteh x 1', 2, 40000.00, 'selesai', '2025-07-01 01:23:32', '2025-07-01 01:25:43', 0),
(23, 1, 'danu', '091234567890', 'jl. in aja', 0, 0, 'dimsum x 1', 1, 30000.00, 'selesai', '2025-07-01 01:25:30', '2025-07-01 01:25:39', 0),
(24, 1, 'danu', '081234567890', 'jl. in aja', 0, 0, 'dimsum x 2', 2, 60000.00, 'selesai', '2025-07-01 01:40:07', '2025-07-01 01:40:26', 0),
(25, 1, 'danu', '081234567890', 'jl. in aja', 0, 0, 'dimsum x 1', 1, 30000.00, 'selesai', '2025-07-01 01:43:39', '2025-07-01 01:43:46', 0),
(26, 2, 'lala', '081234567890', 'jl. in aja', 0, 0, 'dimsum x 2', 2, 60000.00, 'selesai', '2025-07-01 01:47:37', '2025-07-01 03:29:21', 0),
(27, 1, 'danu', '081234567890', 'jl. in aja', 0, 0, 'dimsum x 2, esteh x 1', 3, 70000.00, 'selesai', '2025-07-01 02:59:34', '2025-07-01 03:29:19', 0),
(28, 1, 'adit', '123456789012', 'jl. in aja', 0, 0, 'dimsum x 1, esteh x 1', 2, 40000.00, 'selesai', '2025-07-01 03:30:24', '2025-07-01 04:11:16', 0),
(29, 1, 'pirelllllll', '091234567890', 'jl. in aja', 0, 0, 'dimsum x 1', 1, 30000.00, 'selesai', '2025-07-01 03:52:27', '2025-07-01 04:11:19', 0),
(30, 1, 'anjoyyyyy', '081234567890', 'jl. in aja', 0, 0, 'dimsum x 1', 1, 30000.00, 'selesai', '2025-07-01 04:04:23', '2025-07-01 04:11:14', 0),
(31, 1, 'adit', '098765432123', 'jl. in aja', 0, 0, 'dimsum x 1', 1, 30000.00, 'selesai', '2025-07-01 04:18:37', '2025-07-01 04:22:17', 0),
(32, 1, 'lala', '081234567890', 'jl. in aja', 0, 0, 'esteh x 1', 1, 10000.00, 'selesai', '2025-07-01 04:18:58', '2025-07-01 04:22:14', 0),
(33, NULL, 'abc', '081234567890', 'jl. in aja', 0, 0, 'dimsum', 1, 30000.00, 'selesai', '2025-07-01 04:40:21', '2025-07-01 05:29:13', 0),
(34, NULL, 'bcd', '081234567890', 'jl. in aja', 0, 0, 'dimsum', 1, 30000.00, 'selesai', '2025-07-01 04:40:53', '2025-07-01 05:29:15', 0),
(35, 1, 'rel', '08123456', 'jl. in aja', 0, 0, 'dimsum x 1', 1, 30000.00, 'proses', '2025-07-01 05:01:30', '2025-07-01 05:29:11', 0),
(36, 1, 'janu', '123456789012', 'jl. in aja', 0, 0, 'dimsum x 2', 2, 60000.00, 'pending', '2025-07-01 09:37:39', '2025-07-01 09:37:39', 0),
(37, 3, 'arfian', '089680355861', 'pondok sukmajaya permai blok G3 nomor 11', 0, 0, 'dimsum x 1', 1, 30000.00, 'pending', '2025-07-02 05:00:57', '2025-07-02 05:00:57', 0),
(38, 3, 'arfian', '089680355861', 'pondok sukmajaya permai blok G3 nomor 11', 327606, 16421, 'esteh x 1, dimsum x 1', 2, 40000.00, 'pending', '2025-07-02 07:07:33', '2025-07-02 07:07:33', 6000),
(39, 3, 'arfian', '089680355861', 'pondok sukmajaya permai blok G3 nomor 11', 327606, 16421, 'dimsum x 1', 1, 36000.00, 'pending', '2025-07-02 07:23:51', '2025-07-02 07:23:51', 6000),
(40, 3, 'arfian3', '089680355861', 'pondok sukmajaya permai blok G3 nomor 11', 327606, 16421, 'dimsum x 1', 1, 36000.00, 'pending', '2025-07-04 06:15:48', '2025-07-04 06:15:48', 6000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$Noxy5QK41iFg6hFOo5zpsumZhm/IYpu01OLzHcJ6LSzrGmzwVtGKG', NULL, '2025-06-30 12:46:55', '2025-06-30 12:46:55', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `beritas`
--
ALTER TABLE `beritas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `galeris`
--
ALTER TABLE `galeris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kontaks`
--
ALTER TABLE `kontaks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_email_unique` (`email`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_member_id_foreign` (`member_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `beritas`
--
ALTER TABLE `beritas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `galeris`
--
ALTER TABLE `galeris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `kelurahan`
--
ALTER TABLE `kelurahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kontaks`
--
ALTER TABLE `kontaks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
