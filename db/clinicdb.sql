-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 16, 2021 at 12:51 PM
-- Server version: 10.5.4-MariaDB-log
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinicdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `constants`
--

CREATE TABLE `constants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `constants`
--

INSERT INTO `constants` (`id`, `name`, `enabled`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '{\"ar\":\"ذكر\",\"en\":\"Male\"}', 1, '2021-02-16 12:46:18', '2021-02-16 12:46:18', NULL),
(2, '{\"ar\":\"أنثى\",\"en\":\"Female\"}', 1, '2021-02-16 12:46:18', '2021-02-16 12:46:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `readable` int(11) NOT NULL DEFAULT 0,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_01_25_112741_create_permission_tables', 1),
(5, '2021_01_25_141717_create_patients_table', 1),
(6, '2021_01_25_142632_create_settings_table', 1),
(7, '2021_01_25_142648_create_contacts_table', 1),
(8, '2021_01_25_142703_create_notifications_table', 1),
(9, '2021_01_25_143142_create_appointments_table', 1),
(10, '2021_01_25_143446_create_constants_table', 1),
(11, '2021_01_25_144611_create_receipts_table', 1),
(12, '2021_01_25_144622_create_transactions_table', 1),
(13, '2021_01_25_144815_create_services_table', 1),
(14, '2021_01_27_164724_create_countries_table', 1),
(15, '2021_01_27_164757_create_cities_table', 1),
(16, '2021_01_27_164809_create_states_table', 1),
(17, '2021_02_13_204113_create_invoices_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` int(11) NOT NULL,
  `constant_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create_appointments', 'web', '2021-02-16 12:46:13', '2021-02-16 12:46:13'),
(2, 'read_appointments', 'web', '2021-02-16 12:46:13', '2021-02-16 12:46:13'),
(3, 'update_appointments', 'web', '2021-02-16 12:46:13', '2021-02-16 12:46:13'),
(4, 'delete_appointments', 'web', '2021-02-16 12:46:13', '2021-02-16 12:46:13'),
(5, 'print_appointments', 'web', '2021-02-16 12:46:13', '2021-02-16 12:46:13'),
(6, 'del_all_appointments', 'web', '2021-02-16 12:46:13', '2021-02-16 12:46:13'),
(7, 'create_patients', 'web', '2021-02-16 12:46:13', '2021-02-16 12:46:13'),
(8, 'read_patients', 'web', '2021-02-16 12:46:13', '2021-02-16 12:46:13'),
(9, 'update_patients', 'web', '2021-02-16 12:46:13', '2021-02-16 12:46:13'),
(10, 'delete_patients', 'web', '2021-02-16 12:46:13', '2021-02-16 12:46:13'),
(11, 'print_patients', 'web', '2021-02-16 12:46:13', '2021-02-16 12:46:13'),
(12, 'del_all_patients', 'web', '2021-02-16 12:46:13', '2021-02-16 12:46:13'),
(13, 'create_services', 'web', '2021-02-16 12:46:13', '2021-02-16 12:46:13'),
(14, 'read_services', 'web', '2021-02-16 12:46:13', '2021-02-16 12:46:13'),
(15, 'update_services', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(16, 'delete_services', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(17, 'print_services', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(18, 'del_all_services', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(19, 'create_invoices', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(20, 'read_invoices', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(21, 'update_invoices', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(22, 'delete_invoices', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(23, 'print_invoices', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(24, 'del_all_invoices', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(25, 'create_contacts', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(26, 'read_contacts', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(27, 'update_contacts', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(28, 'delete_contacts', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(29, 'print_contacts', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(30, 'del_all_contacts', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(31, 'create_countries', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(32, 'read_countries', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(33, 'update_countries', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(34, 'delete_countries', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(35, 'print_countries', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(36, 'del_all_countries', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(37, 'create_cities', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(38, 'read_cities', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(39, 'update_cities', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(40, 'delete_cities', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(41, 'print_cities', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(42, 'del_all_cities', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(43, 'create_states', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(44, 'read_states', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(45, 'update_states', 'web', '2021-02-16 12:46:14', '2021-02-16 12:46:14'),
(46, 'delete_states', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(47, 'print_states', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(48, 'del_all_states', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(49, 'create_receipts', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(50, 'read_receipts', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(51, 'update_receipts', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(52, 'delete_receipts', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(53, 'print_receipts', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(54, 'del_all_receipts', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(55, 'create_transactions', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(56, 'read_transactions', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(57, 'update_transactions', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(58, 'delete_transactions', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(59, 'print_transactions', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(60, 'del_all_transactions', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(61, 'create_users', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(62, 'read_users', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(63, 'update_users', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(64, 'delete_users', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(65, 'print_users', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(66, 'del_all_users', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(67, 'create_roles', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(68, 'read_roles', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(69, 'update_roles', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(70, 'delete_roles', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(71, 'print_roles', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(72, 'del_all_roles', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(73, 'create_settings', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(74, 'read_settings', 'web', '2021-02-16 12:46:15', '2021-02-16 12:46:15'),
(75, 'update_settings', 'web', '2021-02-16 12:46:16', '2021-02-16 12:46:16'),
(76, 'delete_settings', 'web', '2021-02-16 12:46:16', '2021-02-16 12:46:16'),
(77, 'print_settings', 'web', '2021-02-16 12:46:16', '2021-02-16 12:46:16'),
(78, 'del_all_settings', 'web', '2021-02-16 12:46:16', '2021-02-16 12:46:16');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rec_serial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'web', '2021-02-16 12:46:13', '2021-02-16 12:46:13'),
(2, 'doctor', 'web', '2021-02-16 12:46:18', '2021-02-16 12:46:31'),
(3, 'secretary', 'web', '2021-02-16 12:46:18', '2021-02-16 12:46:18');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(61, 2),
(61, 3),
(62, 1),
(62, 2),
(62, 3),
(63, 1),
(63, 2),
(63, 3),
(64, 1),
(64, 2),
(64, 3),
(65, 1),
(65, 2),
(65, 3),
(66, 1),
(66, 2),
(66, 3),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `price`, `enabled`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '{\"ar\":\"جلسة أولى\",\"en\":\"First Session\"}', '15.00', 1, '2021-02-16 12:46:19', '2021-02-16 12:46:19', NULL),
(2, '{\"ar\":\"جلسة ثانية\",\"en\":\"Second Session\"}', '20.00', 1, '2021-02-16 12:46:19', '2021-02-16 12:46:19', NULL),
(3, '{\"ar\":\"جلسة ثالثة\",\"en\":\"Third Session\"}', '25.00', 1, '2021-02-16 12:46:19', '2021-02-16 12:46:19', NULL),
(4, '{\"ar\":\"فحص عام\",\"en\":\"General Examination\"}', '30.00', 1, '2021-02-16 12:46:19', '2021-02-16 12:46:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `transactions_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `enabled` int(11) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `image`, `enabled`, `email_verified_at`, `password`, `remember_token`, `last_login_at`, `last_login_ip`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'super', 'admin', 'super_admin', 'super@admin.com', 'default.png', 1, NULL, '$2y$10$R2gjbZlrzWrX5VvsHd0HsuEpSxVVfZ9W/6aaaCbLQqYwCHCaESZTW', NULL, '2021-02-16 12:46:19', NULL, '2021-02-15 22:00:00', '2021-02-15 22:00:00', NULL),
(2, 'Mustafa', 'Al-Swaisi', 'mostfaswaisi93', 'mostfaswaisi93@doctor.com', 'default.png', 1, NULL, '$2y$10$Ms2mzF41.S80d2XmWHLSFu5iPhidWVVV8Tmu/r.nkIxugJAOJZp/e', NULL, '2021-02-16 12:46:19', NULL, '2021-02-15 22:00:00', '2021-02-15 22:00:00', NULL),
(3, 'Ahmad', 'Ali', 'ahmadali', 'ahmadali@secretary.com', 'default.png', 1, NULL, '$2y$10$Nt1aMwbC5rYfCJyrMN4Tc.FTwJ5KmDIDCeZJwblYuaoVU4CWgGzja', NULL, '2021-02-16 12:46:19', NULL, '2021-02-15 22:00:00', '2021-02-15 22:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `constants`
--
ALTER TABLE `constants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patients_id_number_unique` (`id_number`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `receipts_rec_serial_unique` (`rec_serial`);

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
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `constants`
--
ALTER TABLE `constants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
