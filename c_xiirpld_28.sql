-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Nov 2024 pada 04.24
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `c_xiirpld_28`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `checkups`
--

CREATE TABLE `checkups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `checkup_date` date NOT NULL,
  `handling` enum('inpatient','outpatient') NOT NULL,
  `price` int(11) NOT NULL,
  `checkup_result` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `checkups`
--

INSERT INTO `checkups` (`id`, `patient_id`, `doctor_id`, `checkup_date`, `handling`, `price`, `checkup_result`, `created_at`, `updated_at`) VALUES
(2, 1, 2, '2024-11-06', 'inpatient', 5500000, 'This is for result', '2024-11-24 08:42:02', '2024-11-24 08:42:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `specialization`, `created_at`, `updated_at`) VALUES
(1, 'Jamaal Wintheiser', 'aspernatur', NULL, NULL),
(2, 'Kirstin Hickle', 'labore', NULL, NULL),
(3, 'Kamren Strosin', 'quam', NULL, NULL),
(4, 'Mr. Hector Nolan', 'provident', NULL, NULL),
(5, 'Dr. Naomi Kuphal', 'distinctio', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `enlistments`
--

CREATE TABLE `enlistments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `poly_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `enlistment_date` date NOT NULL,
  `complaint` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `checkup_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `enlistments`
--

INSERT INTO `enlistments` (`id`, `doctor_id`, `poly_id`, `user_id`, `patient_name`, `enlistment_date`, `complaint`, `attachment`, `checkup_date`, `created_at`, `updated_at`) VALUES
(1, 2, 13, 2, 'Rein', '2024-11-02', 'Tes Complaint', 'attachments/KhenENbPMykwikxCCCy71DWjqAedJoFsdnHazWz2.jpg', '2024-11-12', '2024-11-24 08:36:15', '2024-11-24 19:07:53'),
(2, 4, 15, 2, 'Vivy', '2024-11-12', 'Complaints', 'attachments/O6lPgbBWANhbYuHmFJGUHnTKxPkoqn4x8Bfq2GuF.jpg', '2024-11-19', '2024-11-24 19:06:06', '2024-11-24 19:06:06'),
(3, 1, 12, 3, 'Akbar', '2024-11-06', 'Testing Complaint', 'attachments/2sw6Z6JgtgSFhaq7OGDe3NRdHR0lgKhgpdJKhDx4.jpg', '2024-11-13', '2024-11-24 20:13:18', '2024-11-24 20:13:18');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_11_22_013423_create_doctors_table', 1),
(6, '2024_11_22_013707_create_patients_table', 1),
(7, '2024_11_22_013854_create_enlistments_table', 1),
(8, '2024_11_22_014103_create_polies_table', 1),
(9, '2024_11_22_030246_create_checkups_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `patients`
--

INSERT INTO `patients` (`id`, `name`, `address`, `phone`, `gender`, `created_at`, `updated_at`) VALUES
(1, 'Palma Gleichner', '816 Raheem Rapid\nKihnborough, AK 45930', '+1 (234) 692-7398', 'female', NULL, NULL),
(2, 'Talon Rath', '75512 Hermiston Mount\nPort Bethport, SC 70228', '+14798190688', 'female', NULL, NULL),
(3, 'Muriel Brekke', '974 Conroy Flat\nSouth Theodora, MN 02994-4898', '(501) 571-7266', 'male', NULL, NULL),
(4, 'Dr. Roberto Cronin I', '4908 Heller Ranch Suite 108\nWest Alessandra, WV 39741-3350', '+15595270405', 'male', NULL, NULL),
(5, 'Monique Toy III', '850 Steuber Meadow\nNitzscheport, OK 85513-1963', '231.794.5414', 'male', NULL, NULL),
(6, 'Deangelo Konopelski', '80997 Reinger Stream\nAvachester, AR 70729-8944', '989.684.7247', 'male', NULL, NULL),
(7, 'Earl VonRueden', '3609 Mandy Loop\nNorth Skye, PA 43254', '(678) 821-4625', 'female', NULL, NULL),
(8, 'Prof. Giovanna Wiza PhD', '5216 Tess Extension Apt. 090\nCorwinchester, SC 45002', '1-276-297-6994', 'male', NULL, NULL),
(9, 'Chet Jaskolski', '81557 Ashley Manors\nNew Leonardo, TN 08092-2753', '+1-347-918-8629', 'male', NULL, NULL),
(10, 'Monica Gutmann', '2002 Clinton Haven\nLake Rooseveltbury, VA 94798-8300', '718.842.9099', 'male', NULL, NULL);

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `polies`
--

CREATE TABLE `polies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `polies`
--

INSERT INTO `polies` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'general', NULL, NULL),
(2, 'dentist', NULL, NULL),
(3, 'otolaryngology', NULL, NULL),
(4, 'pediatrics', NULL, NULL),
(5, 'obgyn', NULL, NULL),
(6, 'surgery', NULL, NULL),
(7, 'cardiology', NULL, NULL),
(8, 'neurology', NULL, NULL),
(9, 'dermatology and venerology', NULL, NULL),
(10, 'ophthalmology', NULL, NULL),
(11, 'respiratory', NULL, NULL),
(12, 'nutrition', NULL, NULL),
(13, 'psychiatry', NULL, NULL),
(14, 'orthopedic', NULL, NULL),
(15, 'urology', NULL, NULL),
(16, 'internal medic', NULL, NULL),
(17, 'therapy', NULL, NULL),
(18, 'geriatrics', NULL, NULL),
(19, 'endocrinology', NULL, NULL),
(20, 'hemodialysis', NULL, NULL);

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
  `type` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$iJjVThom7jQkLqhN/WmF8.wj1wq8pH/HHOEz1Jh7DNNWvXsfnllFK', 1, NULL, NULL, NULL),
(2, 'User', 'user@gmail.com', NULL, '$2y$10$UzGQ4KFDb6HZF2AztQyo1u4WK8SlDpTTwFMxEdqMBE548TsmEmzuy', 2, NULL, NULL, NULL),
(3, 'akbar', 'akbar@gmail.com', NULL, '$2y$10$nQ2efMYd6LwdpOPAwFYXAuwb3fH1Lq/cS/ODinwdQsD3zcowLm2A2', 2, NULL, '2024-11-24 20:09:52', '2024-11-24 20:09:52');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `checkups`
--
ALTER TABLE `checkups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `enlistments`
--
ALTER TABLE `enlistments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `polies`
--
ALTER TABLE `polies`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `checkups`
--
ALTER TABLE `checkups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `enlistments`
--
ALTER TABLE `enlistments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `polies`
--
ALTER TABLE `polies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
