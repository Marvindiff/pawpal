-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2026 at 03:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pawpal`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `schedule` datetime NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_refunded` tinyint(1) NOT NULL DEFAULT 0,
  `reject_reason` text DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `payment_method` varchar(255) DEFAULT NULL,
  `gcash_proof` varchar(255) DEFAULT NULL,
  `payment_verified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `provider_id`, `schedule`, `status`, `created_at`, `updated_at`, `price`, `is_refunded`, `reject_reason`, `payment_status`, `payment_method`, `gcash_proof`, `payment_verified_at`) VALUES
(1, 1, 2, '2026-04-10 07:55:00', 'approved', '2026-04-06 22:53:38', '2026-04-09 18:31:15', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(2, 1, 3, '2026-04-10 02:54:00', 'approved', '2026-04-06 22:54:03', '2026-04-06 22:55:19', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(3, 1, 3, '2026-04-10 03:52:00', 'pending', '2026-04-06 23:52:08', '2026-04-06 23:52:08', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(4, 19, 29, '2026-04-08 10:38:00', 'rejected', '2026-04-20 18:38:04', '2026-05-03 18:58:59', 100.00, 0, 'Walker rejected', 'unpaid', NULL, NULL, NULL),
(5, 19, 29, '2026-04-21 10:43:00', 'rejected', '2026-04-20 18:43:19', '2026-05-03 19:05:16', 100.00, 0, 'Walker rejected', 'unpaid', NULL, NULL, NULL),
(6, 19, 29, '2026-04-21 10:50:00', 'rejected', '2026-04-20 18:51:07', '2026-05-03 19:05:23', 100.00, 0, 'Walker rejected', 'unpaid', NULL, NULL, NULL),
(7, 19, 29, '2026-04-21 10:51:00', 'paid', '2026-04-20 18:51:15', '2026-04-20 18:57:55', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(8, 19, 29, '2026-04-21 11:00:00', 'rejected', '2026-04-20 19:00:22', '2026-04-20 19:15:35', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(9, 19, 29, '2026-04-21 11:01:00', 'rejected', '2026-04-20 19:01:18', '2026-04-20 19:05:19', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(10, 19, 29, '2026-04-21 11:02:00', 'paid', '2026-04-20 19:04:12', '2026-04-20 19:04:20', 10000000.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(11, 19, 29, '2026-04-21 11:17:00', 'paid', '2026-04-20 19:17:54', '2026-04-20 19:18:04', 500.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(12, 19, 29, '2026-04-21 11:20:00', 'paid', '2026-04-20 19:20:21', '2026-04-20 19:20:30', 500.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(13, 19, 29, '2026-04-09 11:22:00', 'paid', '2026-04-20 19:22:14', '2026-04-20 19:22:23', 500.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(14, 19, 29, '2026-04-21 14:22:00', 'paid', '2026-04-20 22:22:10', '2026-04-20 22:22:16', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(15, 19, 29, '2026-04-21 14:23:00', 'paid', '2026-04-20 22:23:40', '2026-04-20 22:24:17', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(16, 19, 29, '2026-04-22 14:26:00', 'pending', '2026-04-20 22:26:33', '2026-04-20 22:26:33', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(17, 19, 29, '2026-04-21 14:29:00', 'paid', '2026-04-20 22:29:59', '2026-04-20 22:30:21', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(18, 19, 29, '2026-04-01 14:33:00', 'paid', '2026-04-20 22:33:52', '2026-04-20 22:34:09', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(19, 19, 29, '2026-04-03 14:38:00', 'paid', '2026-04-20 22:39:01', '2026-04-20 22:39:24', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(20, 19, 29, '2026-04-16 14:42:00', 'paid', '2026-04-20 22:42:16', '2026-04-20 22:42:42', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(21, 19, 29, '2026-04-10 14:43:00', 'paid', '2026-04-20 22:43:43', '2026-04-20 22:44:00', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(22, 19, 29, '2026-04-30 14:45:00', 'rejected', '2026-04-20 22:45:49', '2026-04-20 22:52:29', 100.00, 0, NULL, 'paid', NULL, NULL, NULL),
(23, 19, 29, '2026-04-21 04:51:00', 'rejected', '2026-04-20 22:50:30', '2026-04-20 22:52:13', 100.00, 0, NULL, 'paid', NULL, NULL, NULL),
(24, 19, 29, '2026-04-24 02:55:00', 'rejected', '2026-04-20 22:55:08', '2026-04-20 22:56:10', 100.00, 0, NULL, 'paid', NULL, NULL, NULL),
(25, 19, 29, '2026-04-24 14:56:00', 'rejected', '2026-04-20 22:56:33', '2026-04-20 22:57:24', 100.00, 0, NULL, 'paid', NULL, NULL, NULL),
(26, 19, 29, '2026-04-16 15:02:00', 'rejected', '2026-04-20 23:00:20', '2026-04-20 23:03:33', 100.00, 1, 'Walker rejected', 'paid', NULL, NULL, NULL),
(27, 19, 29, '2026-04-30 09:06:00', 'rejected', '2026-04-20 23:01:16', '2026-04-20 23:03:11', 100.00, 1, 'Walker rejected', 'paid', NULL, NULL, NULL),
(28, 19, 29, '2026-04-30 15:06:00', 'pending', '2026-04-20 23:06:15', '2026-04-20 23:06:15', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(29, 19, 29, '2026-04-03 09:01:00', 'completed', '2026-04-21 17:01:03', '2026-04-21 17:02:20', 100.00, 0, NULL, 'paid', NULL, NULL, NULL),
(30, 19, 29, '2026-04-22 13:38:00', 'completed', '2026-04-21 21:38:51', '2026-04-21 21:42:12', 100.00, 0, NULL, 'paid', NULL, NULL, NULL),
(31, 19, 32, '2026-04-03 13:44:00', 'completed', '2026-04-21 21:44:23', '2026-04-21 21:47:52', 1000.00, 0, NULL, 'paid', NULL, NULL, NULL),
(32, 19, 32, '2026-04-03 13:47:00', 'approved', '2026-04-21 21:47:31', '2026-04-21 21:47:47', 1000.00, 0, NULL, 'paid', NULL, NULL, NULL),
(33, 19, 29, '2026-04-03 13:34:00', 'approved', '2026-04-26 21:34:05', '2026-04-26 21:34:38', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(34, 19, 32, '2026-04-29 13:30:00', 'completed', '2026-04-27 21:30:05', '2026-04-27 21:31:52', 1000.00, 0, NULL, 'paid', NULL, NULL, NULL),
(35, 19, 29, '2026-05-05 10:43:00', 'rejected', '2026-05-03 18:43:43', '2026-05-03 18:52:36', 100.00, 0, 'Walker rejected', 'unpaid', NULL, NULL, NULL),
(36, 19, 29, '2026-05-29 10:51:00', 'completed', '2026-05-03 18:51:23', '2026-05-03 18:52:25', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(37, 19, 29, '2026-05-08 10:53:00', 'paid', '2026-05-03 18:53:41', '2026-05-03 18:57:40', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(38, 19, 29, '2026-05-15 10:59:00', 'rejected', '2026-05-03 18:59:42', '2026-05-03 19:00:52', 100.00, 0, 'Walker rejected', 'unpaid', NULL, NULL, NULL),
(39, 19, 29, '2026-05-08 11:03:00', 'rejected', '2026-05-03 19:03:49', '2026-05-03 19:04:20', 100.00, 0, 'Walker rejected', 'unpaid', NULL, NULL, NULL),
(40, 19, 29, '2026-05-07 11:06:00', 'rejected', '2026-05-03 19:06:17', '2026-05-03 19:06:49', 100.00, 0, 'Walker rejected', 'unpaid', NULL, NULL, NULL),
(41, 19, 29, '2026-05-08 11:15:00', 'rejected', '2026-05-03 19:14:36', '2026-05-03 19:15:06', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(42, 19, 29, '2026-05-22 11:15:00', 'rejected', '2026-05-03 19:16:02', '2026-05-03 19:16:41', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(43, 19, 29, '2026-05-04 23:16:00', 'rejected', '2026-05-03 19:17:02', '2026-05-03 19:17:48', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(44, 19, 29, '2026-05-15 11:18:00', 'rejected', '2026-05-03 19:18:50', '2026-05-03 19:19:16', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(45, 19, 29, '2026-05-01 11:19:00', 'rejected', '2026-05-03 19:20:05', '2026-05-03 19:20:49', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(46, 19, 29, '2026-05-08 23:24:00', 'completed', '2026-05-03 19:24:04', '2026-05-03 19:24:30', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(47, 19, 29, '2026-05-01 11:25:00', 'approved', '2026-05-03 19:25:53', '2026-05-03 19:26:03', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(48, 19, 29, '2026-05-07 14:14:00', 'rejected', '2026-05-04 22:14:41', '2026-05-04 22:15:17', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(49, 19, 29, '2026-05-22 14:17:00', 'approved', '2026-05-04 22:17:43', '2026-05-04 22:34:07', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(50, 19, 29, '2026-05-05 14:19:00', 'pending_payment', '2026-05-04 22:19:29', '2026-05-04 22:20:33', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(51, 19, 29, '2026-05-22 09:12:00', 'approved', '2026-05-05 17:12:16', '2026-05-05 17:12:35', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(52, 19, 29, '2026-05-15 09:15:00', 'rejected', '2026-05-05 17:15:14', '2026-05-05 17:28:26', 100.00, 1, 'Walker rejected', 'paid', 'gcash', 'gcash_proofs/4fUYM6YIMDWn8WGTeMPi09pVXsdeNpCYJWfwt84t.png', '2026-05-05 17:27:13'),
(53, 19, 29, '2026-05-08 09:33:00', 'pending', '2026-05-05 17:33:40', '2026-05-05 17:33:40', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(54, 19, 29, '2026-05-29 09:33:00', 'approved', '2026-05-05 17:34:02', '2026-05-05 17:38:36', 100.00, 0, NULL, 'paid', 'gcash', 'gcash_proofs/ss5XMxIFcNL4QuWPR61hphb8vUIn3tQCsPn13EoD.png', '2026-05-05 17:38:36'),
(55, 19, 29, '2026-05-22 14:15:00', 'approved', '2026-05-06 22:15:46', '2026-05-06 22:20:34', 100.00, 0, NULL, 'pending', 'gcash', 'gcash_proofs/ROZQRxZy2ntMCHqqgyh2ODRqvzmA3wixpiqBYlT1.png', NULL),
(56, 19, 29, '2026-05-01 09:56:00', 'approved', '2026-05-07 17:56:08', '2026-05-07 17:58:15', 100.00, 0, NULL, 'Approved', 'wallet', NULL, NULL),
(57, 19, 29, '2026-05-22 10:00:00', 'completed', '2026-05-07 18:00:53', '2026-05-07 18:05:04', 100.00, 0, NULL, 'paid', 'wallet', NULL, NULL),
(58, 19, 29, '2026-05-29 10:33:00', 'pending', '2026-05-07 18:33:34', '2026-05-07 18:33:34', 100.00, 0, NULL, 'unpaid', NULL, NULL, NULL),
(59, 19, 32, '2026-05-08 10:39:00', 'approved', '2026-05-07 18:39:15', '2026-05-07 18:39:36', 1000.00, 0, NULL, 'unpaid', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_replied` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `is_replied`, `created_at`, `updated_at`) VALUES
(1, 'asd', 'aissiecruz00@gmail.com', '123123123', 0, '2026-04-07 23:13:13', '2026-04-07 23:13:13'),
(2, 'asd', 'aissiecruz00@gmail.com', 'hello', 0, '2026-04-07 23:36:35', '2026-04-07 23:36:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `is_seen` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `created_at`, `updated_at`, `seen`, `is_read`, `is_seen`) VALUES
(20, 19, 29, 'hello', '2026-04-20 18:26:13', '2026-04-21 16:57:20', 0, 1, 1),
(21, 19, 29, 'hiiii', '2026-04-20 18:39:20', '2026-04-21 16:57:20', 0, 1, 1),
(22, 29, 19, 'hi', '2026-04-20 18:40:21', '2026-04-21 17:00:47', 0, 1, 1),
(23, 29, 19, 'what kind of dog?', '2026-04-20 23:09:11', '2026-04-21 17:00:47', 0, 1, 1),
(24, 19, 29, 'hi', '2026-04-21 16:51:10', '2026-04-21 16:57:20', 0, 1, 1),
(25, 29, 19, 'hi', '2026-04-21 16:51:47', '2026-04-21 17:00:47', 0, 1, 1),
(26, 19, 32, 'hi po', '2026-04-21 21:52:38', '2026-04-21 21:52:45', 0, 1, 1),
(27, 33, 29, 'hello po haha', '2026-05-06 22:13:31', '2026-05-06 22:14:35', 0, 1, 1),
(28, 29, 33, 'hihi', '2026-05-06 22:14:20', '2026-05-06 22:15:09', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2026_03_23_072554_create_bookings_table', 1),
(7, '2026_03_26_013702_create_sitter_verifications_table', 1),
(8, '2026_03_30_023542_create_walks_table', 1),
(9, '2026_04_07_054614_create_reviews_table', 2),
(10, '2026_04_07_054739_create_messages_table', 2),
(11, '2026_04_07_072612_add_price_to_bookings', 3),
(12, '2026_04_07_080830_add_last_seen_to_users', 4),
(13, '2026_04_07_081214_add_seen_to_messages', 5),
(14, '2026_04_07_081401_add_is_read_to_messages_table', 5),
(15, '2026_04_08_011107_create_services_table', 6),
(16, '2026_04_08_012921_add_bio_location_to_users_table', 7),
(17, '2026_04_08_014016_add_bio_location_to_users_table', 8),
(18, '2026_04_08_063753_add_is_admin_to_users_table', 9),
(19, '2026_04_08_064047_create_contact_messages_table', 10),
(20, '2026_04_10_060541_add_is_approved_to_users_table', 11),
(21, '2026_04_16_063424_add_certificate_to_users_table', 12),
(22, '2026_04_16_071400_add_penalty_to_users_table', 13),
(23, '2026_04_21_015127_add_wallet_to_users_table', 14),
(24, '2026_04_21_020327_create_wallet_transactions_table', 15),
(25, '2026_04_21_023653_add_price_to_users_table', 16),
(26, '2026_04_21_030251_update_price_column_in_bookings_table', 17),
(27, '2026_04_21_061737_add_refund_fields_to_bookings_table', 18),
(28, '2026_04_21_063315_add_payment_status_to_bookings_table', 19),
(29, '2026_04_21_065328_add_payment_fields_to_bookings', 20),
(30, '2026_04_22_004646_add_is_seen_to_messages', 21),
(31, '2026_04_27_053114_create_reports_table', 22),
(32, '2026_04_28_055158_add_severity_to_reports_table', 23),
(33, '2026_04_28_055306_add_admin_note_to_reports_table', 24),
(34, '2026_04_28_055851_create_notifications_table', 25),
(35, '2026_05_06_010941_add_payment_columns_to_bookings_table', 26),
(36, '2026_05_08_032820_add_is_replied_to_contact_messages_table', 27);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('aissiecruz00@gmail.com', '$2y$12$wTFJF2Kd7vVIePG1rBUfPOrHAI6orkz7c2FS.QowpWcOBBZmLlKVy', '2026-04-19 22:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reported_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `severity` enum('low','medium','high') NOT NULL DEFAULT 'medium',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `reported_id`, `type`, `reason`, `status`, `severity`, `created_at`, `updated_at`, `admin_note`) VALUES
(1, 19, 29, 'provider', 'not going to the meeting point', 'pending', 'medium', '2026-04-26 21:55:02', '2026-04-26 21:55:02', NULL),
(2, 19, 29, 'provider', 'ulol', 'pending', 'medium', '2026-04-26 21:59:09', '2026-04-26 21:59:09', NULL),
(3, 19, 32, 'provider', 'not replying', 'investigating', 'low', '2026-04-27 21:31:23', '2026-04-27 22:07:33', 'i will send it');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `created_at`, `updated_at`, `user_id`, `provider_id`, `rating`, `comment`) VALUES
(1, '2026-04-21 17:18:18', '2026-04-21 17:18:18', 19, 29, 3, 'nice'),
(2, '2026-04-21 17:18:30', '2026-04-21 17:18:30', 19, 29, 5, 'nice'),
(3, '2026-04-21 17:51:00', '2026-04-21 17:51:00', 19, 29, 1, 'di marunong'),
(4, '2026-04-21 21:48:25', '2026-04-21 21:48:25', 19, 32, 5, 'nice');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `provider_id`, `title`, `description`, `price`, `created_at`, `updated_at`) VALUES
(4, 32, 'sit', 'sitting', 1000.00, '2026-04-21 21:43:49', '2026-04-21 21:43:49');

-- --------------------------------------------------------

--
-- Table structure for table `sitter_verifications`
--

CREATE TABLE `sitter_verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `service_type` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `certificate` varchar(255) DEFAULT NULL,
  `penalty` int(11) NOT NULL DEFAULT 0,
  `wallet_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `service_type`, `is_available`, `status`, `created_at`, `updated_at`, `last_seen`, `bio`, `location`, `is_admin`, `remember_token`, `is_approved`, `certificate`, `penalty`, `wallet_balance`, `price`) VALUES
(19, 'asd', 'aissiecruz00@gmail.com', '$2y$12$i8vNFITnguB9wyKsfqnhnOyEvAi7uhIAodg663YduuYXmYj9u/C8G', 'user', NULL, 0, 'approved', '2026-04-13 18:40:12', '2026-05-07 18:04:35', NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 9995400.00, NULL),
(20, 'Admin', 'admin@gmail.com', '$2y$12$XJX1DqMlqBhqMiY/.R6O0uR8tEnXGenhgoJ2HeT/akPFFwCkimy92', 'admin', NULL, 0, 'approved', '2026-04-13 18:41:32', '2026-04-13 18:41:32', NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 0.00, NULL),
(29, 'walking', 'Walking2@gmail.com', '$2y$12$yvaN0nvpIsnWmfjWrBRuMOxVGU4GBjk278xpW2fkPFrqr8.8r3gTO', 'provider', 'walker', 1, 'approved', '2026-04-15 22:21:42', '2026-05-07 18:14:26', NULL, 'hello', 'sanfernando pampanga', 0, NULL, 1, NULL, 2, 10003000.00, 100.00),
(32, 'sitter', 'sittir@gmail.com', '$2y$12$yHZvQNTcuodDT/dxkD1wmuwuUj.UeRsuHpWex0a77Nz57Kyib1WCK', 'provider', 'sitter', 1, 'approved', '2026-04-15 23:27:49', '2026-05-07 18:21:00', NULL, 'sf', 'sf', 0, NULL, 0, 'certificates/teVGuUD0KDS650oWEPtolQWYoQa8nUiNKk6IB3Bu.png', 2, 3000.00, 1000.00),
(33, 'calipot', 'calipot@gmail.com', '$2y$12$JF0/ckCgtHgnijkvynikEuqBuBf/ymnVL8.RAqx.eId2efbvqNaaS', 'user', NULL, 0, 'approved', '2026-05-06 22:11:46', '2026-05-06 22:11:46', NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 0.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `walks`
--

CREATE TABLE `walks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `walker_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `scheduled_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet_transactions`
--

INSERT INTO `wallet_transactions` (`id`, `user_id`, `amount`, `type`, `description`, `created_at`, `updated_at`) VALUES
(1, 19, 100.00, 'credit', 'Admin added funds', '2026-04-20 18:04:22', '2026-04-20 18:04:22'),
(2, 19, 100.00, 'credit', 'Admin added funds', '2026-04-20 18:04:26', '2026-04-20 18:04:26'),
(3, 19, 10000000.00, 'credit', 'Admin added funds', '2026-04-20 18:06:26', '2026-04-20 18:06:26'),
(4, 19, 1000.00, 'credit', 'Admin added funds', '2026-04-20 18:06:52', '2026-04-20 18:06:52'),
(5, 19, 1000.00, 'credit', 'Admin added funds', '2026-04-20 18:08:21', '2026-04-20 18:08:21'),
(6, 19, 100.00, 'debit', 'Payment for booking #4', '2026-04-20 18:56:26', '2026-04-20 18:56:26'),
(7, 29, 100.00, 'credit', 'Earning from booking #4', '2026-04-20 18:56:26', '2026-04-20 18:56:26'),
(8, 19, 100.00, 'debit', 'Payment for booking #5', '2026-04-20 18:56:36', '2026-04-20 18:56:36'),
(9, 29, 100.00, 'credit', 'Earning from booking #5', '2026-04-20 18:56:36', '2026-04-20 18:56:36'),
(10, 19, 100.00, 'debit', 'Payment for booking #6', '2026-04-20 18:57:49', '2026-04-20 18:57:49'),
(11, 29, 100.00, 'credit', 'Earning from booking #6', '2026-04-20 18:57:49', '2026-04-20 18:57:49'),
(12, 19, 100.00, 'debit', 'Payment for booking #7', '2026-04-20 18:57:55', '2026-04-20 18:57:55'),
(13, 29, 100.00, 'credit', 'Earning from booking #7', '2026-04-20 18:57:55', '2026-04-20 18:57:55'),
(14, 19, 10000000.00, 'debit', 'Payment for booking #10', '2026-04-20 19:04:20', '2026-04-20 19:04:20'),
(15, 29, 10000000.00, 'credit', 'Earning from booking #10', '2026-04-20 19:04:20', '2026-04-20 19:04:20'),
(16, 19, 500.00, 'debit', 'Payment for booking #11', '2026-04-20 19:18:04', '2026-04-20 19:18:04'),
(17, 29, 500.00, 'credit', 'Earning from booking #11', '2026-04-20 19:18:04', '2026-04-20 19:18:04'),
(18, 19, 500.00, 'debit', 'Payment for booking #12', '2026-04-20 19:20:30', '2026-04-20 19:20:30'),
(19, 29, 500.00, 'credit', 'Earning from booking #12', '2026-04-20 19:20:30', '2026-04-20 19:20:30'),
(20, 19, 500.00, 'debit', 'Payment for booking #13', '2026-04-20 19:22:23', '2026-04-20 19:22:23'),
(21, 29, 500.00, 'credit', 'Earning from booking #13', '2026-04-20 19:22:23', '2026-04-20 19:22:23'),
(22, 19, 100.00, 'debit', 'Payment for booking #14', '2026-04-20 22:22:16', '2026-04-20 22:22:16'),
(23, 29, 100.00, 'credit', 'Earning from booking #14', '2026-04-20 22:22:16', '2026-04-20 22:22:16'),
(24, 19, 100.00, 'debit', 'Payment for booking #17', '2026-04-20 22:30:20', '2026-04-20 22:30:20'),
(25, 29, 100.00, 'credit', 'Earning from booking #17', '2026-04-20 22:30:20', '2026-04-20 22:30:20'),
(26, 19, 100.00, 'debit', 'Payment for booking #18', '2026-04-20 22:34:09', '2026-04-20 22:34:09'),
(27, 29, 100.00, 'credit', 'Earning from booking #18', '2026-04-20 22:34:09', '2026-04-20 22:34:09'),
(28, 19, 100.00, 'debit', 'Payment for booking #19', '2026-04-20 22:39:24', '2026-04-20 22:39:24'),
(29, 29, 100.00, 'credit', 'Earning from booking #19', '2026-04-20 22:39:24', '2026-04-20 22:39:24'),
(30, 19, 100.00, 'debit', 'Payment for booking #20', '2026-04-20 22:42:42', '2026-04-20 22:42:42'),
(31, 29, 100.00, 'credit', 'Earning from booking #20', '2026-04-20 22:42:42', '2026-04-20 22:42:42'),
(32, 19, 100.00, 'debit', 'Payment for booking #21', '2026-04-20 22:44:00', '2026-04-20 22:44:00'),
(33, 29, 100.00, 'credit', 'Earning from booking #21', '2026-04-20 22:44:00', '2026-04-20 22:44:00'),
(34, 19, 100.00, 'debit', 'Payment for booking #22', '2026-04-20 22:46:18', '2026-04-20 22:46:18'),
(35, 29, 100.00, 'credit', 'Earning from booking #22', '2026-04-20 22:46:18', '2026-04-20 22:46:18'),
(36, 19, 100.00, 'debit', 'Payment for booking #23', '2026-04-20 22:51:06', '2026-04-20 22:51:06'),
(37, 29, 100.00, 'credit', 'Earning from booking #23', '2026-04-20 22:51:06', '2026-04-20 22:51:06'),
(38, 19, 100.00, 'debit', 'Payment for booking #24', '2026-04-20 22:55:44', '2026-04-20 22:55:44'),
(39, 29, 100.00, 'credit', 'Earning from booking #24', '2026-04-20 22:55:44', '2026-04-20 22:55:44'),
(40, 19, 100.00, 'debit', 'Payment for booking #25', '2026-04-20 22:56:50', '2026-04-20 22:56:50'),
(41, 29, 100.00, 'credit', 'Earning from booking #25', '2026-04-20 22:56:50', '2026-04-20 22:56:50'),
(42, 19, 100.00, 'debit', 'Payment for booking #26', '2026-04-20 23:00:35', '2026-04-20 23:00:35'),
(43, 29, 100.00, 'credit', 'Earning from booking #26', '2026-04-20 23:00:35', '2026-04-20 23:00:35'),
(44, 19, 100.00, 'debit', 'Payment for booking #27', '2026-04-20 23:01:37', '2026-04-20 23:01:37'),
(45, 29, 100.00, 'credit', 'Earning from booking #27', '2026-04-20 23:01:37', '2026-04-20 23:01:37'),
(46, 29, 100.00, 'debit', 'Refund deduction for booking #27', '2026-04-20 23:03:11', '2026-04-20 23:03:11'),
(47, 19, 100.00, 'credit', 'Refund for rejected booking #27', '2026-04-20 23:03:11', '2026-04-20 23:03:11'),
(48, 29, 100.00, 'debit', 'Refund deduction for booking #26', '2026-04-20 23:03:33', '2026-04-20 23:03:33'),
(49, 19, 100.00, 'credit', 'Refund for rejected booking #26', '2026-04-20 23:03:33', '2026-04-20 23:03:33'),
(50, 19, 100.00, 'debit', 'Payment for booking #29', '2026-04-21 17:01:59', '2026-04-21 17:01:59'),
(51, 29, 100.00, 'credit', 'Earning from booking #29', '2026-04-21 17:01:59', '2026-04-21 17:01:59'),
(52, 19, 100.00, 'debit', 'Payment for booking #30', '2026-04-21 21:39:14', '2026-04-21 21:39:14'),
(53, 29, 100.00, 'credit', 'Earning from booking #30', '2026-04-21 21:39:14', '2026-04-21 21:39:14'),
(54, 19, 1000.00, 'debit', 'Payment for booking #31', '2026-04-21 21:44:54', '2026-04-21 21:44:54'),
(55, 32, 1000.00, 'credit', 'Earning from booking #31', '2026-04-21 21:44:54', '2026-04-21 21:44:54'),
(56, 19, 1000.00, 'debit', 'Payment for booking #32', '2026-04-21 21:47:47', '2026-04-21 21:47:47'),
(57, 32, 1000.00, 'credit', 'Earning from booking #32', '2026-04-21 21:47:47', '2026-04-21 21:47:47'),
(58, 19, 1000.00, 'debit', 'Payment for booking #34', '2026-04-27 21:31:38', '2026-04-27 21:31:38'),
(59, 32, 1000.00, 'credit', 'Earning from booking #34', '2026-04-27 21:31:38', '2026-04-27 21:31:38'),
(60, 29, 100.00, 'debit', 'Refund deduction #52', '2026-05-05 17:28:26', '2026-05-05 17:28:26'),
(61, 19, 100.00, 'credit', 'Refund #52', '2026-05-05 17:28:26', '2026-05-05 17:28:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_provider_id_foreign` (`provider_id`);

--
-- Indexes for table `sitter_verifications`
--
ALTER TABLE `sitter_verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sitter_verifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `walks`
--
ALTER TABLE `walks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `walks_walker_id_foreign` (`walker_id`),
  ADD KEY `walks_user_id_foreign` (`user_id`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_transactions_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sitter_verifications`
--
ALTER TABLE `sitter_verifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `walks`
--
ALTER TABLE `walks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sitter_verifications`
--
ALTER TABLE `sitter_verifications`
  ADD CONSTRAINT `sitter_verifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `walks`
--
ALTER TABLE `walks`
  ADD CONSTRAINT `walks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `walks_walker_id_foreign` FOREIGN KEY (`walker_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD CONSTRAINT `wallet_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
