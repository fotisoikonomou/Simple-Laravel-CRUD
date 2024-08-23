-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 18 Αυγ 2024 στις 21:33:54
-- Έκδοση διακομιστή: 8.4.0
-- Έκδοση PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `user-roles`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `dv_users`
--

CREATE TABLE `dv_users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wp_users_ID` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `dv_users`
--

INSERT INTO `dv_users` (`id`, `name`, `username`, `password`, `email`, `is_active`, `date_created`, `last_changed`, `wp_users_ID`) VALUES
(1, 'Fotis Oikonomou', 'fotis', '$2y$10$zxvkdvii4xiRFcGI0ScaGOu6XQFEKZtcxm94QeZsTbXQFcZ2pETAe', 'fo@gmail.com', 1, '2024-08-15 20:18:52', '2024-08-18 19:27:16', 1),
(3, 'Dimitris Oikonomou', 'dim', '$2y$10$yb6kC3aHwH9xtweQ9cN/yO5i6RsJQ.REL2rp90ERTXP2nd3Whg5Qe', 'dim@gmail.com', 1, '2024-08-17 19:11:05', '2024-08-18 19:27:11', 3),
(5, 'nick', 'nick', '$2y$10$c35mo8VaOjOfzqMt3YswP.OGoeIdGlVvtJqPd43yjCt9zKqsRxMna', 'nick@gmail.com', 1, '2024-08-17 19:43:54', '2024-08-18 19:19:16', 6);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `dv_users_roles`
--

CREATE TABLE `dv_users_roles` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `dv_users_roles`
--

INSERT INTO `dv_users_roles` (`id`, `name`, `is_active`, `is_deleted`, `date_created`, `last_changed`) VALUES
(1, 'Admin', 1, 0, '2024-08-18 12:48:42', '2024-08-18 19:13:00'),
(2, 'Manager', 0, 0, '2024-08-18 12:49:02', '2024-08-18 19:04:36'),
(3, 'Supervisor', 1, 0, '2024-08-18 12:49:13', '2024-08-18 19:19:02'),
(4, 'Super Supervisor', 1, 0, '2024-08-18 13:21:36', '2024-08-18 19:18:57');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `dv_users_roles_has_dv_users`
--

CREATE TABLE `dv_users_roles_has_dv_users` (
  `dv_users_roles_id` int UNSIGNED NOT NULL,
  `dv_users_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `dv_users_roles_has_dv_users`
--

INSERT INTO `dv_users_roles_has_dv_users` (`dv_users_roles_id`, `dv_users_id`) VALUES
(1, 1),
(2, 1),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(2, 5);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `failed_jobs`
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
-- Δομή πίνακα για τον πίνακα `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_08_14_125451_create_dv_users_table', 1),
(6, '2024_08_14_130415_create_dv_user_roles_table', 1),
(7, '2024_08_14_135422_create_dv_users_roles_has_dv_users_table', 1),
(8, '2024_08_15_192102_create_wp_users_table', 1),
(9, '2024_08_18_122358_modify_foreign_keys_in_dv_users_roles_has_dv_users', 2),
(10, '2024_08_18_124548_modify_dv_users_roles', 3);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `wp_users`
--

CREATE TABLE `wp_users` (
  `ID` bigint UNSIGNED NOT NULL,
  `user_login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_nicename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_status` int NOT NULL DEFAULT '0',
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `wp_users`
--

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_email`, `user_nicename`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'fo', '123456', 'fo@gmail.com', NULL, NULL, '2024-08-15 20:17:27', NULL, 0, NULL, NULL, NULL),
(2, 'steven', '$2y$10$H7EpZ.XKIIBaP8vFQ0tBn.IG7d18./X/8k.EnAmZ8ywfrO0ndHZSS', 'st@gmail.com', NULL, NULL, '2024-08-17 19:10:01', NULL, 0, NULL, NULL, NULL),
(3, 'dim', '$2y$10$mY4Gp6.FzIv9XImG61z64uwchQxyM7Vz86Ldu97V5WN.NCwW.eHtG', 'dim@gmail.com', NULL, NULL, '2024-08-17 19:11:05', NULL, 0, NULL, NULL, NULL),
(4, 'lefk', '$2y$10$LR.CaQV3F6bQmw523AWWJe9GfzrD28bw0VpUUA/1h.uXPPJyR3Rki', 'lef@gmail.com', NULL, NULL, '2024-08-17 19:21:16', NULL, 0, NULL, NULL, NULL),
(5, 'lefkia', '$2y$10$.A6003PGb8S2XSpCb3KAU./ZtQoAUm/nlaLUdqfvgl9SpRvPwIjwu', 'lefkia@gmail.com', NULL, NULL, '2024-08-17 19:22:11', NULL, 0, NULL, NULL, NULL),
(6, 'nick', '$2y$10$1Mp25SgTE2s8I7kEAVFS0.Wd2BVR.5bnG6t2YdBxDf723TmMe2pmu', 'nick@gmail.com', NULL, NULL, '2024-08-17 19:43:54', NULL, 0, NULL, NULL, NULL),
(7, 'stefanos', '$2y$10$CZ1K6.dglJTcPVZkYVvfkuGtrnHa1tQvs83zknqm8pb6C1XkD2A4K', 'steve@gmail.com', NULL, NULL, '2024-08-18 12:25:21', NULL, 0, NULL, NULL, NULL),
(8, 'alex', '$2y$10$8UsQI4JU59tg1vd/DTAIGOfop93Q121qTi5K1I5k9VCXjN/L5VP3C', 'al@gmail.com', NULL, NULL, '2024-08-18 13:18:46', NULL, 0, NULL, NULL, NULL),
(9, 'fotios', '$2y$10$XWQEklWEuSC.BezsAfhP4u1339G07t1S8ebwzGIjCRCTTyFzvr9v6', 'fotaras@gmail.com', NULL, NULL, '2024-08-18 13:59:30', NULL, 0, NULL, NULL, NULL);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `dv_users`
--
ALTER TABLE `dv_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dv_users_username_unique` (`username`),
  ADD KEY `fk_dv_users_wp_users1_idx` (`wp_users_ID`);

--
-- Ευρετήρια για πίνακα `dv_users_roles`
--
ALTER TABLE `dv_users_roles`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `dv_users_roles_has_dv_users`
--
ALTER TABLE `dv_users_roles_has_dv_users`
  ADD PRIMARY KEY (`dv_users_roles_id`,`dv_users_id`),
  ADD KEY `fk_dv_users_roles_has_dv_users_dv_users1_idx` (`dv_users_id`),
  ADD KEY `fk_dv_users_roles_has_dv_users_dv_users_roles1_idx` (`dv_users_roles_id`);

--
-- Ευρετήρια για πίνακα `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Ευρετήρια για πίνακα `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Ευρετήρια για πίνακα `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Ευρετήρια για πίνακα `wp_users`
--
ALTER TABLE `wp_users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `wp_users_user_login_unique` (`user_login`),
  ADD UNIQUE KEY `wp_users_user_email_unique` (`user_email`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `dv_users`
--
ALTER TABLE `dv_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT για πίνακα `dv_users_roles`
--
ALTER TABLE `dv_users_roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT για πίνακα `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT για πίνακα `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `wp_users`
--
ALTER TABLE `wp_users`
  MODIFY `ID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `dv_users`
--
ALTER TABLE `dv_users`
  ADD CONSTRAINT `dv_users_wp_users_id_foreign` FOREIGN KEY (`wp_users_ID`) REFERENCES `wp_users` (`ID`);

--
-- Περιορισμοί για πίνακα `dv_users_roles_has_dv_users`
--
ALTER TABLE `dv_users_roles_has_dv_users`
  ADD CONSTRAINT `fk_dv_users_roles_has_dv_users_dv_users1` FOREIGN KEY (`dv_users_id`) REFERENCES `dv_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_dv_users_roles_has_dv_users_dv_users_roles1` FOREIGN KEY (`dv_users_roles_id`) REFERENCES `dv_users_roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
