-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 15, 2020 at 06:04 PM
-- Server version: 5.7.24-log
-- PHP Version: 7.2.10

SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mb_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `short_description` text,
  `address` varchar(191) NOT NULL,
  `contact_person` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active,2=InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `title`, `short_description`, `address`, `contact_person`, `phone`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Main Branch', NULL, 'Your Branch Address', 'Admin', '12345678', 1, '2019-12-25 01:13:25', '2019-12-25 02:13:07', NULL),
(2, 'Branch Two', 'This is Test Branch', 'Jhenaidha', 'Ali Reza', '12345678', 1, '2019-12-25 02:12:50', '2019-12-25 02:12:50', NULL),
(3, 'Branch Three', 'This Is Test', 'Dhaka Bangladesh', 'Ali Reza', '1212121', 1, '2019-12-26 02:05:36', '2019-12-26 02:05:36', NULL),
(4, 'testuy', NULL, 'jfghf', 'conttest', '55556666777888', 1, '2020-02-01 22:48:40', '2020-02-01 22:48:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active,2=InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Eloctronic', 1, '2019-12-25 01:25:31', '2020-02-05 02:02:32', NULL),
(2, 'Furniture', 1, '2019-12-25 01:27:20', '2020-02-05 02:02:53', NULL),
(3, 'Handi craft', 1, '2019-12-25 01:28:19', '2020-02-05 02:04:09', NULL),
(4, 'Side Orders', 1, '2019-12-25 01:33:09', '2020-02-06 01:24:56', '2020-02-06 01:24:56'),
(5, 'Fashion', 1, '2019-12-25 01:34:33', '2020-02-05 02:03:26', NULL),
(6, 'yry', 1, '2020-01-10 04:43:29', '2020-02-02 21:00:17', '2020-02-02 21:00:17'),
(7, 'Chicken Burgers', 1, '2020-02-02 16:39:59', '2020-02-04 20:36:34', NULL),
(8, 'gggggggggg', 1, '2020-02-02 16:40:06', '2020-02-02 21:00:09', '2020-02-02 21:00:09'),
(9, 'test6', 1, '2020-02-05 16:43:25', '2020-02-05 21:46:58', NULL),
(10, 'gfd', 1, '2020-02-05 10:12:38', '2020-02-05 10:12:38', NULL),
(11, 'gffd', 1, '2020-02-09 13:27:57', '2020-02-09 13:27:57', NULL),
(12, 'test', 1, '2020-02-13 12:13:43', '2020-02-13 12:13:43', NULL),
(13, 'fddg', 1, '2020-02-13 14:15:05', '2020-02-13 14:15:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active,2=InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `email`, `address`, `photo`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'John Doe', '123 456 789', 'johndoe@example.com', 'Customer Address', NULL, 1, '2019-12-25 01:13:25', '2019-12-25 01:13:25', NULL),
(2, 'Fatema Jannat', '12345678', 'fatema@example.com', 'Dhaka Bangladesh', NULL, 1, '2019-12-25 02:37:28', '2019-12-26 10:39:06', NULL),
(3, 'Md Rakib Uddin', '121212 21212', 'rakib@example.com', 'Dhaka Bangladesh', 'uploads/customer\\GG8vGqBwi0otrIYZq5Bz.jpeg', 1, '2019-12-26 10:38:12', '2019-12-26 10:39:18', NULL),
(4, 'Ali Reza', '01913041366', 'reza@example.com', 'Dhaka Bangladesh', NULL, 1, '2019-12-26 10:38:42', '2019-12-26 10:39:24', NULL),
(5, 'Ugi', '080xxxxxxxx', 'box@box.com', NULL, 'uploads/customer/EnNTgx4b4AcQMOwcvVEl.c', 1, '2020-01-30 23:08:19', '2020-01-31 15:20:10', NULL),
(6, 'Nguyễn Đình Thái', '0944181777', 'dinhthaicx@gmail.com', '40', 'uploads/customer/O0YhvkW7e7nhaK7enmUZ.', 1, '2020-01-31 01:32:09', '2020-01-31 15:22:26', NULL),
(7, 'Jahid', '978', NULL, NULL, NULL, 1, '2020-01-31 14:10:27', '2020-01-31 14:10:27', NULL),
(8, 'mekha', '111111111111', NULL, NULL, NULL, 1, '2020-02-02 16:14:09', '2020-02-02 16:14:09', NULL),
(9, 'neha chavan', '8698488149', 'chavanneha804@gmail.com', 'ganesh colony,pune', NULL, 1, '2020-02-05 17:49:25', '2020-02-05 17:49:25', NULL),
(10, 'sdf', 'sdfsfsd', 'dffsd@dsf.com', 'sdf', NULL, 1, '2020-02-07 14:23:23', '2020-02-07 14:23:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrative', '2019-12-25 01:13:25', '2019-12-25 01:13:25', NULL),
(2, 'IT', '2019-12-26 10:18:24', '2019-12-26 10:18:24', NULL),
(3, 'Accounts', '2019-12-26 10:18:32', '2019-12-26 10:18:32', NULL),
(4, 'Support Center', '2019-12-26 10:22:10', '2019-12-26 10:22:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', '2019-12-25 01:13:25', '2019-12-25 01:13:25', NULL),
(2, 'Branch Manager', '2019-12-26 02:29:12', '2019-12-26 02:29:12', NULL),
(3, 'Sales Executive', '2019-12-26 10:19:20', '2019-12-26 10:19:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drafts`
--

CREATE TABLE `drafts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inquiry_id` varchar(191) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `sub_total` double NOT NULL,
  `discount` double NOT NULL,
  `grand_total_price` double NOT NULL,
  `archive_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `drafts`
--

INSERT INTO `drafts` (`id`, `inquiry_id`, `customer_id`, `branch_id`, `sub_total`, `discount`, `grand_total_price`, `archive_date`, `created_at`, `updated_at`) VALUES
(24, '05-02-2020-165', 1, 2, 13200, 0, 13200, '2020-02-05', '2020-02-05 15:31:16', '2020-02-05 15:31:16'),
(25, '05-02-2020-257', 2, 2, 26320, 0, 26320, '2020-02-05', '2020-02-05 16:03:24', '2020-02-05 16:03:24'),
(26, '05-02-2020-101', 1, 2, 25700, 0, 25700, '2020-02-05', '2020-02-05 16:03:36', '2020-02-05 16:03:36'),
(27, '05-02-2020-659', 1, 2, 21000, 0, 21000, '2020-02-05', '2020-02-05 16:03:41', '2020-02-05 16:03:41'),
(28, '05-02-2020-720', 1, 2, 88000, 0, 88000, '2020-02-05', '2020-02-05 16:03:46', '2020-02-05 16:03:46'),
(31, '05-02-2020-224', 1, 1, 40, 0, 40, '2020-02-05', '2020-02-05 21:29:55', '2020-02-05 21:29:55'),
(32, '05-02-2020-143', 2, 1, 11520, 0, 11520, '2020-02-05', '2020-02-05 21:56:07', '2020-02-05 21:56:07');

-- --------------------------------------------------------

--
-- Table structure for table `draft_products`
--

CREATE TABLE `draft_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `draft_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_price` double NOT NULL,
  `sell_price` double NOT NULL,
  `tax_percentage` double NOT NULL,
  `tax_amount` double NOT NULL,
  `quantity` double NOT NULL,
  `total_price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `draft_products`
--

INSERT INTO `draft_products` (`id`, `draft_id`, `product_id`, `purchase_price`, `sell_price`, `tax_percentage`, `tax_amount`, `quantity`, `total_price`, `created_at`, `updated_at`) VALUES
(77, 24, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-02-05 15:31:16', '2020-02-05 15:31:16'),
(78, 25, 10, 20000, 25000, 0, 0, 1, 25000, '2020-02-05 16:03:24', '2020-02-05 16:03:24'),
(79, 25, 1, 1000, 1200, 10, 120, 1, 1320, '2020-02-05 16:03:24', '2020-02-05 16:03:24'),
(80, 26, 20, 2000, 2500, 0, 0, 5, 12500, '2020-02-05 16:03:36', '2020-02-05 16:03:36'),
(81, 26, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-02-05 16:03:36', '2020-02-05 16:03:36'),
(82, 27, 15, 2000, 3000, 0, 0, 7, 21000, '2020-02-05 16:03:41', '2020-02-05 16:03:41'),
(83, 28, 9, 10000, 11000, 0, 0, 8, 88000, '2020-02-05 16:03:46', '2020-02-05 16:03:46'),
(86, 31, 44, 30, 40, 0, 0, 1, 40, '2020-02-05 21:29:55', '2020-02-05 21:29:55'),
(87, 32, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-05 21:56:07', '2020-02-05 21:56:07'),
(88, 32, 3, 5000, 6000, 10, 600, 1, 6600, '2020-02-05 21:56:07', '2020-02-05 21:56:07'),
(89, 32, 2, 500, 600, 0, 0, 1, 600, '2020-02-05 21:56:07', '2020-02-05 21:56:07'),
(90, 32, 1, 1000, 1200, 10, 120, 1, 1320, '2020-02-05 21:56:07', '2020-02-05 21:56:07');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `department_id` bigint(20) NOT NULL,
  `designation_id` bigint(20) NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `id_number` varchar(100) DEFAULT NULL,
  `blood_group` varchar(15) DEFAULT NULL,
  `gender` varchar(25) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `phone_number` varchar(100) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `educational_background` mediumtext,
  `profile_picture` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `department_id`, `designation_id`, `branch_id`, `id_number`, `blood_group`, `gender`, `date_of_birth`, `address`, `phone_number`, `joining_date`, `educational_background`, `profile_picture`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, NULL, 'B+', 'Male', '2019-12-25', 'Dhaka Bangladesh', '+8801913041366', NULL, NULL, 'uploads/user\\VkqyOLOnFt6giUntLnFP.png', 1, '2019-12-25 01:13:25', '2020-02-07 07:34:31'),
(2, 2, 1, 2, 2, 'admin@example.com', NULL, 'Male', '2019-11-25', '8130 Madison Lakes Cir N', '9543832504', '2019-12-31', 'BSC In CSE', 'uploads/employee\\vOx5ZPc1Q8aRqIsfL5FXEx3pjFidPpzHrdiIbjk5.jpeg', 1, '2019-12-25 04:30:53', '2020-02-13 08:16:32'),
(3, 3, 1, 2, 3, '#ddd', 'A+', 'Male', '2019-12-03', '5411 N UNIVERSITY DR STE 101', '9543412777', '2019-12-17', NULL, 'uploads/employee\\4cAV7LLd9PvkBNl1lo3w0S8sptqo2pGW8OM1Biqv.jpeg', 1, '2019-12-26 02:08:13', '2020-02-13 08:16:18'),
(4, 4, 1, 3, 2, 'admin@example.com', 'A+', 'Male', '2020-01-15', '5411 N UNIVERSITY DR STE 101', '9543412777', NULL, 'BSC In CSE', 'uploads/employee\\eFoYTx0b6Q8iBzKp48JXg4XhEqjrZhsFvdGTK3fH.jpeg', 1, '2019-12-26 02:50:21', '2020-02-13 08:16:12'),
(5, 5, 1, 2, 3, 'sdfsd', 'A-', 'Male', '2019-12-11', 'Address Line 1, Address Line 2', '9545585175', '2019-12-22', NULL, 'uploads/employee\\X6sXl412wDnYuW65O08xwfybhsTf09X2SpUn7VVz.png', 1, '2019-12-26 02:58:20', '2020-02-13 08:16:02'),
(6, 6, 2, 2, 2, 'admin@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/employee\\KNuK5Din8p3cE0XbEeVQUEgjtRxL5HU30REalmBg.png', 1, '2020-01-15 11:00:53', '2020-02-13 08:15:52');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_id` varchar(191) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `expense_category_id` int(11) NOT NULL,
  `expense_date` date NOT NULL,
  `amount` double NOT NULL,
  `note` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_id`, `branch_id`, `expense_category_id`, `expense_date`, `amount`, `note`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'E-000001', 1, 1, '2019-10-01', 100, 'This Is test date', '2019-12-26 10:08:05', '2019-12-26 10:08:05', NULL),
(2, 'E-000002', 1, 2, '2019-12-01', 50, 'This Is test date', '2019-12-26 10:08:16', '2019-12-26 10:08:16', NULL),
(3, 'E-000003', 1, 3, '2019-12-05', 15, 'This Is test date', '2019-12-26 10:08:24', '2019-12-26 10:08:24', NULL),
(4, 'E-000004', 1, 4, '2019-12-16', 50, 'This Is test date', '2019-12-26 10:08:31', '2019-12-26 10:08:31', NULL),
(5, 'E-000005', 1, 5, '2019-12-13', 60, 'This Is test date', '2019-12-26 10:08:52', '2019-12-26 10:08:52', NULL),
(6, 'E-000006', 1, 5, '2019-12-15', 20, 'This Is test date', '2019-12-26 10:09:03', '2019-12-26 10:09:03', NULL),
(7, 'E-000007', 1, 6, '2019-12-23', 500, 'This Is test date', '2019-12-26 10:09:12', '2019-12-26 10:09:12', NULL),
(8, 'E-000008', 1, 4, '2019-12-12', 20, NULL, '2019-12-26 10:09:27', '2019-12-26 10:09:27', NULL),
(9, 'E-000009', 1, 3, '2019-12-25', 15, NULL, '2019-12-26 10:09:35', '2019-12-26 10:09:35', NULL),
(10, 'E-000010', 1, 2, '2020-01-29', 10, '10', '2020-01-29 12:16:14', '2020-01-29 12:16:14', NULL),
(11, 'E-000011', 1, 8, '2020-01-31', 56000, NULL, '2020-01-31 14:59:52', '2020-01-31 14:59:52', NULL),
(12, 'E-000012', 1, 1, '2020-02-02', 20, NULL, '2020-02-02 23:54:17', '2020-02-02 23:54:17', NULL),
(13, 'E-000013', 1, 8, '2020-02-05', 250, 'LAPIS', '2020-02-05 16:55:41', '2020-02-05 16:55:41', NULL),
(14, 'E-000014', 1, 1, '2020-02-05', 699, '123', '2020-02-05 21:01:43', '2020-02-05 21:01:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Office Rent', '2019-12-25 11:03:48', '2019-12-25 11:03:48', NULL),
(2, 'Entertainment', '2019-12-25 11:05:32', '2019-12-25 11:05:32', NULL),
(3, 'Restaurants/Dining', '2019-12-25 11:05:59', '2019-12-25 11:05:59', NULL),
(4, 'Office Stationery', '2019-12-25 11:06:14', '2019-12-25 11:08:25', NULL),
(5, 'Phone Bill', '2019-12-25 11:07:00', '2019-12-25 11:08:10', NULL),
(6, 'Employee Salary', '2019-12-25 11:07:58', '2019-12-25 11:07:58', NULL),
(7, 'dd', '2020-01-29 12:16:01', '2020-01-29 12:16:04', '2020-01-29 12:16:04'),
(8, 'IT Equipment', '2020-01-31 14:58:24', '2020-01-31 14:58:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language` varchar(191) NOT NULL,
  `iso_code` varchar(191) NOT NULL,
  `flag` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active,2=InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`, `iso_code`, `flag`, `status`, `created_at`, `updated_at`) VALUES
(1, 'EN ( English )', 'en', 'uploads/flag\\70T4PSRXTRGuWu2Qwv8J.png', 1, '2020-02-07 14:55:29', '2020-02-07 15:06:21'),
(2, 'HI ( हिंदी- Hindi )', 'hi', 'uploads/flag\\DRWwejuyVAgo4cpDHgHZ.png', 1, '2020-02-07 14:57:09', '2020-02-07 15:06:35'),
(3, 'BN ( বাংলা- Bangla )', 'bn', 'uploads/flag\\a3sEp7KLlItOzMGSI01t.gif', 1, '2020-02-07 14:57:21', '2020-02-07 15:06:46'),
(13, 'German', 'de', 'uploads/flag\\MyhO3qPyqiX1ufjvBIkI.jpeg', 1, '2020-02-08 17:58:08', '2020-02-08 18:00:53'),
(14, 'dsfsdfsdfsd', 'dd', 'uploads/flag\\nKlEDUZeQ0c4KQG4IpZV.gif', 1, '2020-02-09 13:56:27', '2020-02-09 13:56:27'),
(15, 'dfd', 'df', 'uploads/flag\\HkrR3lxFg3x6DG91kpKm.jpeg', 1, '2020-02-14 05:32:00', '2020-02-14 05:32:00'),
(16, 'sdfsdf', 'yy', 'uploads/flag\\kbh5mvZLvL6M9Iknx7aZ.png', 1, '2020-02-15 10:37:15', '2020-02-15 10:37:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_07_19_062040_create_categories_table', 1),
(4, '2019_07_19_062520_create_suppliers_table', 1),
(5, '2019_07_24_160645_create_branches_table', 1),
(6, '2019_07_24_161212_create_customers_table', 1),
(7, '2019_07_25_065748_create_products_table', 1),
(8, '2019_08_04_130649_create_purchases_table', 1),
(9, '2019_08_18_151245_create_purchase_products_table', 1),
(10, '2019_08_27_105602_create_sells_table', 1),
(11, '2019_08_27_105929_create_sell_products_table', 1),
(12, '2019_08_27_132708_create_departments_table', 1),
(13, '2019_08_27_132730_create_designations_table', 1),
(14, '2019_08_27_133028_create_employees_table', 1),
(15, '2019_09_11_143943_create_requisitions_table', 1),
(16, '2019_09_11_152617_create_requisition_products_table', 1),
(17, '2019_09_13_043346_create_sells_targets_table', 1),
(18, '2019_09_13_140609_create_taxes_table', 1),
(19, '2019_09_14_162002_create_settings_table', 1),
(20, '2019_09_20_152155_create_drafts_table', 1),
(21, '2019_09_20_152338_create_draft_products_table', 1),
(22, '2019_10_07_232902_create_permission_tables', 1),
(23, '2019_10_10_191350_create_expense_categories_table', 1),
(24, '2019_10_10_203423_create_expenses_table', 1),
(25, '2019_10_23_205324_create_payment_to_suppliers_table', 1),
(26, '2019_10_24_124904_create_payment_from_customers_table', 1),
(27, '2019_12_25_124451_create_notifications_table', 1),
(29, '2020_02_07_194237_create_languages_table', 2),
(30, '2020_02_13_112438_create_notices_table', 3),
(32, '2020_02_13_191539_create_todos_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(2, 'App\\User', 3),
(3, 'App\\User', 4),
(3, 'App\\User', 5),
(2, 'App\\User', 6);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` longtext NOT NULL,
  `notify_date` date NOT NULL,
  `notify_time` time NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `description`, `notify_date`, `notify_time`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 'test', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,', '2020-02-13', '00:00:00', 1, '2020-02-13 08:34:59', '2020-02-13 10:03:50', NULL),
(12, 'Branch 2', 'test from branch 2', '2020-02-13', '09:00:00', 2, '2020-02-13 10:12:00', '2020-02-13 10:12:00', NULL),
(13, 'dsfdsf dsfds fds', 'fds fsdf dsf dsfdsfds', '2020-02-13', '02:00:00', 2, '2020-02-13 10:25:41', '2020-02-13 10:25:41', NULL),
(14, 'sdfsd', 'sdfsdfds', '2020-02-13', '00:00:00', 2, '2020-02-13 10:27:13', '2020-02-13 10:27:13', NULL),
(15, 'df gd f', 'sdfsdfdsdf sdg d', '2020-02-13', '00:00:00', 2, '2020-02-13 10:27:20', '2020-02-13 10:27:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message_to` int(11) NOT NULL,
  `message_from` int(11) NOT NULL,
  `message` varchar(191) NOT NULL,
  `target_url` varchar(191) NOT NULL,
  `is_click` tinyint(4) NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL COMMENT '1=Requisition 2=Notice',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `message_to`, `message_from`, `message`, `target_url`, `is_click`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(91, 2, 1, 'test', '8', 0, 2, '2020-02-13 10:04:16', '2020-02-13 10:04:26', '2020-02-13 10:04:26'),
(92, 3, 1, 'test', '8', 0, 2, '2020-02-13 10:04:16', '2020-02-13 10:04:26', '2020-02-13 10:04:26'),
(93, 4, 1, 'test', '8', 0, 2, '2020-02-13 10:04:16', '2020-02-13 10:04:26', '2020-02-13 10:04:26'),
(94, 5, 1, 'test', '8', 0, 2, '2020-02-13 10:04:16', '2020-02-13 10:04:26', '2020-02-13 10:04:26'),
(95, 6, 1, 'test', '8', 0, 2, '2020-02-13 10:04:16', '2020-02-13 10:04:26', '2020-02-13 10:04:26'),
(96, 1, 1, 'test', '8', 1, 2, '2020-02-13 10:04:26', '2020-02-13 10:06:49', '2020-02-13 10:06:49'),
(97, 1, 1, 'test', '8', 0, 2, '2020-02-13 10:06:49', '2020-02-13 10:06:49', NULL),
(98, 1, 2, 'Branch 2', '12', 0, 2, '2020-02-13 10:12:01', '2020-02-13 10:12:01', NULL),
(99, 3, 2, 'Branch 2', '12', 0, 2, '2020-02-13 10:12:01', '2020-02-13 10:12:01', NULL),
(100, 4, 2, 'Branch 2', '12', 0, 2, '2020-02-13 10:12:01', '2020-02-13 10:12:01', NULL),
(101, 5, 2, 'Branch 2', '12', 0, 2, '2020-02-13 10:12:01', '2020-02-13 10:12:01', NULL),
(102, 6, 2, 'Branch 2', '12', 0, 2, '2020-02-13 10:12:01', '2020-02-13 10:12:01', NULL),
(103, 1, 2, 'dsfdsf dsfds fds', '13', 1, 2, '2020-02-13 10:25:42', '2020-02-13 12:17:50', NULL),
(104, 4, 2, 'sdfsd', '14', 0, 2, '2020-02-13 10:27:13', '2020-02-13 10:27:13', NULL),
(105, 4, 2, 'df gd f', '15', 0, 2, '2020-02-13 10:27:20', '2020-02-13 10:40:12', '2020-02-13 10:40:12'),
(106, 1, 2, 'df gd f', '15', 0, 2, '2020-02-13 10:40:12', '2020-02-13 10:40:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_from_customers`
--

CREATE TABLE `payment_from_customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `amount` double NOT NULL,
  `note` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_to_suppliers`
--

CREATE TABLE `payment_to_suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `amount` double NOT NULL,
  `note` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `payment_to_suppliers`
--

INSERT INTO `payment_to_suppliers` (`id`, `branch_id`, `purchase_id`, `supplier_id`, `payment_date`, `amount`, `note`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 2, '2019-12-25', 50000, NULL, '2019-12-25 03:33:39', '2019-12-25 03:36:39'),
(3, 1, 2, 1, '2019-09-26', 20000, NULL, '2019-12-25 11:32:23', '2019-12-25 11:32:23'),
(4, 1, 3, 1, '2019-09-26', 2000, NULL, '2019-12-25 11:33:44', '2019-12-25 11:33:44'),
(5, 1, 4, 1, '2019-09-30', 102000, NULL, '2019-12-25 11:36:33', '2019-12-25 11:36:33'),
(6, 1, 5, 2, '2019-09-30', 6000, NULL, '2019-12-25 11:37:06', '2019-12-25 11:37:06'),
(7, 1, 9, 2, '2019-10-16', 600, NULL, '2019-12-25 11:38:57', '2019-12-25 11:38:57'),
(8, 1, 13, 1, '2019-10-31', 40000, NULL, '2019-12-25 11:43:08', '2019-12-25 11:43:08'),
(9, 1, 14, 2, '2019-11-05', 287490, NULL, '2019-12-25 11:44:24', '2019-12-25 11:44:24'),
(10, 1, 42, 1, '2019-12-21', 40900, NULL, '2019-12-25 12:09:01', '2019-12-25 12:09:01'),
(11, 1, 48, 2, '2019-12-26', 30000, NULL, '2019-12-26 10:12:30', '2019-12-26 10:12:30'),
(12, 1, 51, 1, '2020-01-14', 10000, NULL, '2020-01-14 16:24:04', '2020-01-14 16:24:04'),
(13, 2, 60, 1, '2020-01-30', 50, NULL, '2020-01-31 02:55:08', '2020-01-31 02:55:08'),
(14, 2, 61, 1, '2020-01-30', 500, NULL, '2020-01-31 02:56:07', '2020-01-31 02:56:07'),
(15, 1, 69, 1, '2020-01-31', 100, NULL, '2020-01-31 18:37:05', '2020-01-31 18:37:05'),
(16, 1, 71, 1, '2020-01-31', 1000, NULL, '2020-02-01 04:03:05', '2020-02-01 04:03:05'),
(17, 1, 72, 2, '2020-02-01', 500, NULL, '2020-02-01 15:30:10', '2020-02-01 15:30:10'),
(18, 1, 73, 2, '2020-02-01', 500, NULL, '2020-02-01 15:30:15', '2020-02-01 19:48:25'),
(19, 1, 76, 1, '2020-02-02', 1500, NULL, '2020-02-02 13:20:03', '2020-02-02 13:20:03'),
(20, 1, 0, 1, '2020-02-02', 5, 'payment on Feb', '2020-02-02 14:18:42', '2020-02-02 14:18:42'),
(21, 1, 0, 1, '2020-02-03', 1500, 'bhjk', '2020-02-03 07:56:58', '2020-02-03 07:56:58'),
(22, 1, 92, 2, '2020-02-04', 9998, NULL, '2020-02-04 21:00:48', '2020-02-04 21:00:48'),
(23, 1, 94, 2, '2020-02-05', 100, NULL, '2020-02-05 16:50:15', '2020-02-05 16:50:15'),
(24, 1, 0, 1, '2020-02-05', 35000, 'due', '2020-02-05 17:57:54', '2020-02-05 17:57:54');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage_category', 'web', '2019-12-25 01:13:22', '2019-12-25 01:13:22'),
(2, 'manage_tax', 'web', '2019-12-25 01:13:22', '2019-12-25 01:13:22'),
(3, 'manage_product', 'web', '2019-12-25 01:13:22', '2019-12-25 01:13:22'),
(4, 'create_sell_invoice', 'web', '2019-12-25 01:13:22', '2019-12-25 01:13:22'),
(5, 'manage_sell_invoice', 'web', '2019-12-25 01:13:22', '2019-12-25 01:13:22'),
(6, 'create_purchase_invoice', 'web', '2019-12-25 01:13:22', '2019-12-25 01:13:22'),
(7, 'manage_supplier_payment', 'web', '2019-12-25 01:13:22', '2019-12-25 01:13:22'),
(8, 'manage_customer_payment', 'web', '2019-12-25 01:13:22', '2019-12-25 01:13:22'),
(9, 'manage_requisition', 'web', '2019-12-25 01:13:22', '2019-12-25 01:13:22'),
(10, 'manage_department', 'web', '2019-12-25 01:13:22', '2019-12-25 01:13:22'),
(11, 'manage_designation', 'web', '2019-12-25 01:13:22', '2019-12-25 01:13:22'),
(12, 'manage_employee', 'web', '2019-12-25 01:13:23', '2019-12-25 01:13:23'),
(13, 'manage_branch', 'web', '2019-12-25 01:13:23', '2019-12-25 01:13:23'),
(14, 'manage_sells_target', 'web', '2019-12-25 01:13:23', '2019-12-25 01:13:23'),
(15, 'manage_customer', 'web', '2019-12-25 01:13:23', '2019-12-25 01:13:23'),
(16, 'manage_supplier', 'web', '2019-12-25 01:13:23', '2019-12-25 01:13:23'),
(17, 'manage_expense', 'web', '2019-12-25 01:13:23', '2019-12-25 01:13:23'),
(18, 'manage_expense_category', 'web', '2019-12-25 01:13:23', '2019-12-25 01:13:23'),
(19, 'view_sells_report', 'web', '2019-12-25 01:13:23', '2019-12-25 01:13:23'),
(20, 'view_purchase_report', 'web', '2019-12-25 01:13:23', '2019-12-25 01:13:23'),
(21, 'view_stock', 'web', '2019-12-25 01:13:23', '2019-12-25 01:13:23'),
(22, 'application_setting', 'web', '2019-12-25 01:13:23', '2019-12-25 01:13:23'),
(23, 'manage_user', 'web', '2019-12-25 01:13:23', '2019-12-25 01:13:23'),
(24, 'access_to_all_branch', 'web', '2019-12-25 01:13:23', '2019-12-25 01:13:23'),
(25, 'manage_purchase_invoice', 'web', NULL, NULL),
(26, 'manage_trash', 'web', NULL, NULL),
(27, 'manage_notice', 'web', NULL, NULL),
(28, 'manage_todo', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `sku` varchar(191) NOT NULL,
  `category_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `price_type` int(11) NOT NULL DEFAULT '1',
  `purchase_price` double NOT NULL,
  `sell_price` double NOT NULL,
  `short_description` varchar(191) DEFAULT NULL,
  `thumbnail` varchar(191) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `total_price` double NOT NULL DEFAULT '0',
  `tax_percentage` double NOT NULL DEFAULT '0',
  `tax_amount` double NOT NULL DEFAULT '0',
  `created_by` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active,2=InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `sku`, `category_id`, `branch_id`, `tax_id`, `price_type`, `purchase_price`, `sell_price`, `short_description`, `thumbnail`, `quantity`, `total_price`, `tax_percentage`, `tax_amount`, `created_by`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Apple iPhone Xs', 'P-000001', 1, 1, 3, 2, 1000, 1200, 'Test', 'uploads/product\\zOCGJ7Rzp3awup8pm9toGuHGgavZJUdjMSyamyXE.jpeg', 0, 0, 0, 0, '1', 1, '2019-08-06 02:10:42', '2019-12-26 10:32:35', NULL),
(2, 'Vivo Y11', 'P-000002', 1, 1, 1, 1, 500, 600, NULL, 'uploads/product\\W5UilTGEAnLZMemmkXkbs2QAOtVFwe8rHZaqdNrb.jpeg', 0, 0, 0, 0, '1', 1, '2019-08-06 12:00:00', '2019-12-25 02:18:22', NULL),
(3, 'I Pad', 'P-000003', 1, 1, 3, 1, 5000, 6000, NULL, 'uploads/product\\mnMmbEjDTzMo55KpBScy8MEN3dnKNz9uH1QxAOi8.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 05:06:53', '2019-12-25 05:06:53', NULL),
(4, 'HP Probook', 'P-000004', 1, 1, 1, 2, 4000, 5000, NULL, 'uploads/product\\p9kAVUM3mPoLgNjUVLbDB5PgiGuiz0IhQ6SULjqt.png', 0, 0, 0, 0, '1', 0, '2019-09-26 05:08:43', '2020-02-03 07:57:04', NULL),
(5, 'ASUS VivoBook Flip', 'P-000005', 1, 1, 1, 2, 4000, 3000, NULL, 'uploads/product\\R9b7Wmqa1qHIE5wBaeqfiPGfDOyIXcsaYCZe9FGu.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 05:10:42', '2019-12-25 05:10:42', NULL),
(6, 'Desktop (Dual Core)', 'P-000006', 1, 1, 1, 1, 1500, 2000, NULL, 'uploads/product\\9cRKg1Dnfuy9weWGyIU9kcQM04TkInXpghcV0GR0.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 05:13:03', '2019-12-25 05:13:03', NULL),
(7, 'PUBG Controller Triggers', 'P-000007', 1, 1, 1, 2, 700, 500, NULL, 'uploads/product\\zAvLzl1TYcxEgFaoLgnl1IH3SyKBtlSugV0g5QML.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 05:15:33', '2019-12-25 05:16:29', NULL),
(8, 'Canon', 'P-000008', 1, 1, 3, 1, 10000, 12000, NULL, 'uploads/product\\XQ5s61v3aL1Zl8sPUNpxR6MeHFDbxaucxMHk4zq2.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 05:18:07', '2019-12-25 05:18:07', NULL),
(9, 'Nikon Camera', 'P-000009', 1, 1, 1, 1, 10000, 11000, NULL, 'uploads/product\\DYlZd0TjZXdjYAMM51aoCSbuqnop34JvaPLr12eC.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 05:18:29', '2019-12-25 05:20:20', NULL),
(10, 'Refrigerator', 'P-000010', 1, 1, 1, 1, 20000, 25000, NULL, 'uploads/product\\40aXkSUgpMVDxF2LEgTquYoj95nzbasK2vkHlEny.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 05:19:49', '2019-12-25 05:20:41', NULL),
(11, 'Stylish Bed', 'P-000011', 2, 1, 1, 1, 2000, 2500, NULL, 'uploads/product\\X9rcLziKzoSx7PynnntWIgiL2wAfiSmG5u92GRB8.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 05:30:14', '2019-12-25 05:30:14', NULL),
(12, 'Gamdias Achilles', 'P-000012', 2, 1, 1, 1, 1000, 500, NULL, 'uploads/product\\7oyqmY9nbGZ9Gf1Jrnxq7z5LrdTA8lVl9FaHAOqx.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 05:40:27', '2019-12-25 05:44:22', NULL),
(13, 'Almari', 'P-000013', 2, 1, 1, 2, 1500, 2000, NULL, 'uploads/product\\bWec3mm3H0zQNMT4HEQoFesDq90br0Zsv5AqVTfV.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 05:42:29', '2019-12-25 05:45:34', NULL),
(14, 'Dressing Table', 'P-000014', 2, 1, 1, 2, 500, 1000, NULL, 'uploads/product\\FIiOCZx4Qo77xMbGLw4UIasDvbeajEQvyLENlg25.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 05:43:14', '2019-12-25 05:45:26', NULL),
(15, 'Bed side Table', 'P-000015', 2, 1, 1, 2, 2000, 3000, NULL, 'uploads/product\\HeBHa7LVVclcgcbxiTPjDEnonHsl00dTijL2oJAL.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 05:43:45', '2019-12-25 05:45:15', NULL),
(16, '3 Part Almari-AA 199', 'P-000016', 2, 1, 2, 1, 2500, 3000, NULL, 'uploads/product\\6Gs1SGPIJgCVP93z3ZdpYBvkcAEIPzIyIuZFJnMn.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 05:55:20', '2019-12-25 05:55:20', NULL),
(17, 'Bed side Table', 'P-000017', 2, 1, 1, 1, 1000, 1500, NULL, 'uploads/product\\IS5JHImpxNXDZ5qutRD585WgHpi1UIMPuM29Ulvt.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 05:57:32', '2019-12-25 05:57:32', NULL),
(18, 'Steel Almirah', 'P-000018', 2, 1, 3, 2, 2000, 3000, NULL, 'uploads/product\\GYNksvIm6F9Wavr6l85CffM9bDW138ElhYgvzhaf.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 05:59:36', '2019-12-25 05:59:36', NULL),
(19, 'Portable Folding Wardrobe', 'P-000019', 2, 1, 2, 1, 3000, 3500, NULL, 'uploads/product\\WjzWVR5lSSw6k8VEvhperbnJt4C2dCa1g2atv9c6.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 06:00:47', '2019-12-25 06:00:47', NULL),
(20, 'Wood Dressing Table - Chocolate', 'P-000020', 2, 1, 1, 1, 2000, 2500, NULL, 'uploads/product\\XucwdlG0i2PMhVTci0pX2E93GGIeUbns1Mm6yKh8.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 06:01:57', '2019-12-25 06:01:57', NULL),
(21, 'Wood Almirah - Chocolate', 'P-000021', 2, 1, 2, 1, 2000, 3000, NULL, 'uploads/product\\uXRbhTQPDxLstLNxIht28SVXstMaxLqQOMc1M29u.png', 0, 0, 0, 0, '1', 1, '2019-09-26 06:04:12', '2019-12-25 06:04:12', NULL),
(22, 'Stylish Bed B - 15', 'P-000022', 2, 1, 1, 1, 2000, 3000, NULL, 'uploads/product\\dmZXMiYkxEE6k0KgyqnTtn1EELgVEx1shiCweh4S.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 06:05:18', '2019-12-25 06:05:18', NULL),
(23, 'Oven Rack', 'P-000023', 2, 1, 3, 2, 1000, 1500, NULL, 'uploads/product\\tUTnjKB8dIJeJx4o4dnhYwafJwjwVfXyuU1vleb0.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 06:06:38', '2019-12-25 06:06:38', NULL),
(24, 'Reading Table', 'P-000024', 2, 1, 1, 1, 500, 1000, NULL, 'uploads/product\\OGuBXd3AJV3kihIoYvgV2887EDyxZI8pvg9X4ZaT.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 06:07:54', '2019-12-25 06:07:54', NULL),
(25, 'Wooden Dinning Chair-HCFD-307', 'P-000025', 2, 1, 2, 1, 500, 1000, NULL, 'uploads/product\\NfgTckaKhFwBmXsLmJA2WPUuemlRE4EOFKaSS0oM.png', 0, 0, 0, 0, '1', 1, '2019-09-26 06:08:54', '2019-12-25 06:08:54', NULL),
(26, 'Genuine Leather Wallet', 'P-000026', 3, 1, 2, 1, 500, 800, NULL, 'uploads/product\\LiiGRAYW76SggTNDiW08zCZxc2htyueGC5urGCnC.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 06:13:28', '2019-12-25 06:31:52', NULL),
(27, 'Handy Marker Case', 'P-000027', 3, 1, 2, 2, 500, 1000, NULL, 'uploads/product\\GCzSpgLDuZLGjdHefHTn8yYLjBGZCOMGiLwG8Tsc.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 06:14:28', '2019-12-25 06:29:55', NULL),
(28, 'Designer Money Bag', 'P-000028', 3, 1, 2, 2, 1000, 1500, NULL, 'uploads/product\\Sb9ZKDm2GTDDz4TZ4IL3YytbeXBs1wFPI9WsO1y6.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 06:16:09', '2019-12-25 06:31:13', NULL),
(29, 'Bamboo Cup', 'P-000029', 3, 1, 1, 1, 1000, 1500, NULL, 'uploads/product\\U4a96FC9KgXmjuTXYQ7XTX7wWjwWySsLGMwnm79P.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 06:16:54', '2019-12-25 06:32:52', NULL),
(30, 'Phone Holder', 'P-000030', 3, 1, 2, 2, 1000, 1500, NULL, 'uploads/product\\M7iZYwhEoX6ncKuoCBtn13LUBWiu5DOBvB2kbm4n.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 06:18:55', '2019-12-25 06:36:08', NULL),
(31, 'Phone Holder', 'P-000031', 3, 1, 2, 1, 1500, 2000, NULL, 'uploads/product\\XLKsN4trGhOL1o4fCUuqjJDLAQOs6IccTTpC7gvy.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 06:19:37', '2019-12-25 06:35:06', NULL),
(32, 'Pen Holder', 'P-000032', 3, 1, 2, 1, 500, 800, NULL, 'uploads/product\\T0dOaSx2vr2NtErgg5pr9H3oAKAETtS3piv8Jl4r.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 06:21:15', '2019-12-25 06:33:29', NULL),
(33, 'Round Salt Box', 'P-000033', 3, 1, 2, 1, 1000, 1200, NULL, 'uploads/product\\FCIN7kFfUTInQPvml8bVjq9apq7PxuUuhMUGiTxT.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 06:22:17', '2019-12-25 06:33:10', NULL),
(34, 'Bamboo Planter', 'P-000034', 3, 1, 2, 1, 500, 1000, NULL, 'uploads/product\\b7ybQqe1Y0TMW8guH40LAAZfhpMM5osBq6dCo3re.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 06:23:24', '2019-12-25 06:34:12', NULL),
(35, 'Apple Watch Edition', 'P-000035', 5, 1, 1, 1, 150, 200, NULL, 'uploads/product\\jaYiLlFVXHupsGUqG7vfSMwxKwPhkch0jLjfGWd6.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 06:48:05', '2019-12-25 06:50:17', NULL),
(36, 'Samsung Galaxy Watch', 'P-000036', 5, 1, 1, 1, 150, 200, NULL, 'uploads/product\\TlKooeK5W27fk3UxXt2q7K1tRGZTQBL3fH3V4oQY.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 06:49:02', '2019-12-25 06:49:02', NULL),
(37, 'Redux Analogue Blue', 'P-000037', 5, 1, 1, 2, 100, 150, NULL, 'uploads/product\\S0Ab4LBY7x62Q0DamsU0zOrKwcVntsE1NjiRnDjW.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 06:49:28', '2019-12-25 06:50:21', NULL),
(38, 'Rado Watches', 'P-000038', 5, 1, 1, 1, 120, 150, NULL, 'uploads/product\\gj1wXjoF29GippglCDXZAn93USaFxvgOaJ1NEHs1.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 06:51:20', '2019-12-25 06:51:20', NULL),
(39, 'Laptop Backpack', 'P-000039', 5, 1, 1, 2, 40, 50, NULL, 'uploads/product\\nzyRQ71iCiUxf8e0ZhH0vm9m1s9GUusbsTuxh8BZ.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 10:42:27', '2019-12-25 10:42:27', NULL),
(40, 'Anti-Theft backpack', 'P-000040', 5, 1, 1, 1, 95, 100, NULL, 'uploads/product\\kLGy2bZ1zYEWEZ8Q8fcBWaK1j2OJFaypbkmk0itI.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 10:43:47', '2019-12-25 10:43:47', NULL),
(41, 'BRAVE Backpack', 'P-000041', 5, 1, 1, 1, 95, 100, NULL, 'uploads/product\\wyThfBY3IamOIPs00O4yyx9vifABC1fUR7abq5Kc.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 10:45:34', '2019-12-25 10:45:46', NULL),
(42, 'Ladies Watch', 'P-000042', 5, 1, 1, 1, 40, 50, NULL, 'uploads/product\\5PFF0E0bNDIw9dVEEUWpk8Sjqoumm5Fwun7dLfyW.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 10:46:13', '2019-12-25 10:46:13', NULL),
(43, 'Watch Women', 'P-000043', 5, 1, 1, 1, 45, 50, NULL, 'uploads/product\\xbjWeQOTnhWzgIkIRpvALstxNAMjW24GK380rn7v.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 10:48:12', '2019-12-25 10:48:12', NULL),
(44, 'Temple Jewellery', 'P-000044', 5, 1, 1, 1, 30, 40, NULL, 'uploads/product/ZwXK2UnBZV98ObmCIxC0qLlriGyQFiZt8PA846yr.jpeg', 0, 0, 0, 0, '1', 1, '2019-09-26 10:49:10', '2020-02-02 13:40:30', NULL),
(45, 'Chandelier Earrings', 'P-000045', 5, 1, 1, 1, 40, 60, NULL, 'uploads/product\\Ajyfhdtm3gPW1vIcOIVSJzkYEF5ZDHBnMXQL6Spb.jpeg', 0, 0, 0, 0, '1', 0, '2019-09-26 10:50:35', '2020-01-31 13:05:55', NULL),
(46, 'Dolorem nulla et eos', 'P-Doloremque te', 3, 1, 1, 2, 241, 943, 'Ex deserunt velit l', 'uploads/product/gHx13mRrWcX4hvTok7X8ojnhlheYQehyftkq5yNS.jpeg', 0, 0, 0, 0, '1', 1, '2020-01-31 14:33:02', '2020-02-02 13:40:14', NULL),
(47, 'Iranet', 'P-000047', 7, 1, 5, 1, 2000, 2000, NULL, NULL, 0, 0, 0, 0, '1', 1, '2020-02-02 20:11:12', '2020-02-02 20:11:12', NULL),
(48, 'TESTING', 'P-000048', 9, 1, 7, 2, 100, 120, 'OK', 'uploads/product/su88YMfGpU9Jom4Lxf0JAX4PGA9Szmqcqy3oJFg9.jpeg', 0, 0, 0, 0, '1', 1, '2020-02-05 16:46:12', '2020-02-05 16:46:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` varchar(191) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `total_amount` double NOT NULL,
  `paid_amount` double NOT NULL,
  `due_amount` double NOT NULL,
  `created_by` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `invoice_id`, `branch_id`, `supplier_id`, `total_amount`, `paid_amount`, `due_amount`, `created_by`, `purchase_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'P-000001', 1, 2, 150000, 50000, 100000, 1, '2019-09-02', '2019-12-25 02:29:05', '2019-12-25 03:36:39', NULL),
(2, 'P-000002', 1, 1, 44200, 20000, 24200, 1, '2019-09-26', '2019-12-25 11:32:23', '2019-12-25 11:32:23', NULL),
(3, 'P-000003', 1, 1, 2140, 2000, 140, 1, '2019-09-26', '2019-12-25 11:33:43', '2019-12-25 11:33:43', NULL),
(4, 'P-000004', 1, 1, 102000, 102000, 0, 1, '2019-09-30', '2019-12-25 11:36:32', '2019-12-25 11:36:32', NULL),
(5, 'P-000005', 1, 2, 46000, 6000, 40000, 1, '2019-09-30', '2019-12-25 11:37:06', '2019-12-25 11:37:06', NULL),
(6, 'P-000006', 1, 2, 306700, 0, 306700, 1, '2019-10-06', '2019-12-25 11:37:42', '2019-12-25 11:37:42', NULL),
(7, 'P-000007', 1, 2, 262500, 0, 262500, 1, '2019-10-06', '2019-12-25 11:37:57', '2019-12-25 11:37:57', NULL),
(8, 'P-000008', 1, 1, 20000, 0, 20000, 1, '2019-10-11', '2019-12-25 11:38:27', '2019-12-25 11:38:27', NULL),
(9, 'P-000009', 1, 2, 800, 600, 200, 1, '2019-10-16', '2019-12-25 11:38:57', '2019-12-25 11:38:57', NULL),
(10, 'P-000010', 1, 1, 60000, 0, 60000, 1, '2019-10-12', '2019-12-25 11:41:05', '2019-12-25 11:41:05', NULL),
(11, 'P-000011', 1, 1, 19000, 0, 19000, 1, '2019-10-12', '2019-12-25 11:41:26', '2019-12-25 11:41:26', NULL),
(12, 'P-000012', 1, 1, 53000, 0, 53000, 1, '2019-10-26', '2019-12-25 11:42:08', '2019-12-25 11:42:08', NULL),
(13, 'P-000013', 1, 1, 40000, 40000, 0, 1, '2019-10-31', '2019-12-25 11:43:08', '2019-12-25 11:43:08', NULL),
(14, 'P-000014', 1, 2, 287490, 287490, 0, 1, '2019-11-05', '2019-12-25 11:44:23', '2019-12-25 11:44:23', NULL),
(15, 'P-000015', 1, 2, 150000, 0, 150000, 1, '2019-11-15', '2019-12-25 11:50:52', '2019-12-25 11:50:52', NULL),
(16, 'P-000016', 1, 2, 88400, 0, 88400, 1, '2019-11-21', '2019-12-25 11:51:24', '2019-12-25 11:51:24', NULL),
(17, 'P-000017', 1, 1, 95000, 0, 95000, 1, '2019-11-23', '2019-12-25 11:52:16', '2019-12-25 11:52:16', NULL),
(18, 'P-000018', 1, 1, 48000, 0, 48000, 1, '2019-11-25', '2019-12-25 11:53:18', '2019-12-25 11:53:18', NULL),
(19, 'P-000019', 1, 2, 35500, 0, 35500, 1, '2019-11-26', '2019-12-25 11:54:05', '2019-12-25 11:54:05', NULL),
(20, 'P-000020', 1, 2, 32500, 0, 32500, 1, '2019-11-28', '2019-12-25 11:54:48', '2019-12-25 11:54:48', NULL),
(21, 'P-000021', 1, 1, 45000, 0, 45000, 1, '2019-11-28', '2019-12-25 11:55:04', '2019-12-25 11:55:04', NULL),
(22, 'P-000022', 1, 1, 80000, 0, 80000, 1, '2019-11-29', '2019-12-25 11:56:42', '2019-12-25 11:56:42', NULL),
(23, 'P-000023', 1, 1, 42500, 0, 42500, 1, '2019-12-02', '2019-12-25 11:58:07', '2019-12-25 11:58:07', NULL),
(24, 'P-000024', 1, 2, 13500, 0, 13500, 1, '2019-12-02', '2019-12-25 11:58:24', '2019-12-25 11:58:24', NULL),
(25, 'P-000025', 1, 2, 110000, 0, 110000, 1, '2019-12-03', '2019-12-25 11:59:12', '2019-12-25 11:59:12', NULL),
(26, 'P-000026', 1, 1, 126500, 0, 126500, 1, '2019-12-06', '2019-12-25 12:00:02', '2019-12-25 12:00:02', NULL),
(27, 'P-000027', 1, 2, 171000, 0, 171000, 1, '2019-12-08', '2019-12-25 12:01:04', '2019-12-25 12:01:04', NULL),
(28, 'P-000028', 1, 1, 58400, 0, 58400, 1, '2019-12-08', '2019-12-25 12:01:27', '2019-12-25 12:01:27', NULL),
(29, 'P-000029', 1, 2, 140000, 0, 140000, 1, '2019-12-11', '2019-12-25 12:02:12', '2019-12-25 12:02:12', NULL),
(30, 'P-000030', 1, 1, 37500, 0, 37500, 1, '2019-12-11', '2019-12-25 12:03:23', '2019-12-25 12:03:23', NULL),
(31, 'P-000031', 1, 2, 3595, 0, 3595, 1, '2019-12-17', '2019-12-25 12:04:21', '2019-12-25 12:04:21', NULL),
(32, 'P-000032', 1, 2, 8000, 0, 8000, 1, '2019-12-17', '2019-12-25 12:04:32', '2019-12-25 12:04:32', NULL),
(33, 'P-000033', 1, 2, 2040, 0, 2040, 1, '2019-12-17', '2019-12-25 12:04:42', '2019-12-25 12:04:42', NULL),
(34, 'P-000034', 1, 1, 1680, 0, 1680, 1, '2019-12-17', '2019-12-25 12:04:53', '2019-12-25 12:04:53', NULL),
(35, 'P-000035', 1, 2, 122500, 0, 122500, 1, '2019-12-17', '2019-12-25 12:05:34', '2019-12-25 12:05:34', NULL),
(36, 'P-000036', 1, 2, 25200, 0, 25200, 1, '2019-12-18', '2019-12-25 12:06:10', '2019-12-25 12:06:10', NULL),
(37, 'P-000037', 1, 1, 75000, 0, 75000, 1, '2019-12-18', '2019-12-25 12:06:23', '2019-12-25 12:06:23', NULL),
(38, 'P-000038', 1, 1, 122500, 0, 122500, 1, '2019-12-19', '2019-12-25 12:06:51', '2019-12-25 12:06:51', NULL),
(39, 'P-000039', 1, 2, 37500, 0, 37500, 1, '2019-12-19', '2019-12-25 12:07:05', '2019-12-25 12:07:05', NULL),
(40, 'P-000040', 1, 2, 8875, 0, 8875, 1, '2019-12-20', '2019-12-25 12:07:35', '2019-12-25 12:07:35', NULL),
(41, 'P-000041', 1, 2, 169000, 0, 169000, 1, '2019-12-20', '2019-12-25 12:08:14', '2019-12-25 12:08:14', NULL),
(42, 'P-000042', 1, 1, 40900, 40900, 0, 1, '2019-12-21', '2019-12-25 12:09:01', '2019-12-25 12:09:01', NULL),
(43, 'P-000043', 1, 2, 153000, 0, 153000, 1, '2019-12-22', '2019-12-25 12:09:29', '2019-12-25 12:09:29', NULL),
(44, 'P-000044', 1, 2, 16350, 0, 16350, 1, '2019-12-25', '2019-12-25 12:09:54', '2019-12-25 12:09:54', NULL),
(45, 'P-000045', 1, 2, 22500, 0, 22500, 1, '2019-12-26', '2019-12-25 12:10:11', '2019-12-25 12:10:11', NULL),
(46, 'P-000046', 1, 2, 72000, 0, 72000, 1, '2019-12-26', '2019-12-26 02:03:21', '2019-12-26 02:03:21', NULL),
(47, 'P-000047', 1, 1, 1000, 0, 1000, 1, '2019-12-26', '2019-12-26 02:03:54', '2019-12-26 02:03:54', NULL),
(48, 'P-000048', 1, 2, 40000, 30000, 10000, 1, '2019-12-26', '2019-12-26 10:12:30', '2019-12-26 10:12:30', NULL),
(49, 'P-000049', 1, 3, 224000, 0, 224000, 1, '2019-12-26', '2019-12-26 11:56:59', '2019-12-26 11:56:59', NULL),
(50, 'P-000050', 1, 3, 10000, 0, 10000, 1, '2020-01-10', '2020-01-10 04:46:05', '2020-01-10 04:46:05', NULL),
(51, 'P-000051', 1, 1, 10000, 10000, 0, 1, '2020-01-14', '2020-01-14 16:24:04', '2020-01-14 16:24:04', NULL),
(52, 'P-000052', 1, 1, 315000, 0, 315000, 1, '2020-01-27', '2020-01-27 14:01:00', '2020-01-27 14:01:00', NULL),
(53, 'P-000053', 1, 2, 875000, 0, 875000, 1, '2020-01-29', '2020-01-29 12:15:32', '2020-01-29 12:15:32', NULL),
(54, 'P-000054', 1, 1, 4500, 0, 4500, 1, '2020-01-30', '2020-01-30 22:54:12', '2020-01-30 22:54:12', NULL),
(55, 'P-000055', 1, 1, 1500, 0, 1500, 1, '2020-01-30', '2020-01-30 23:21:07', '2020-01-30 23:21:07', NULL),
(56, 'P-000056', 1, 3, 900, 0, 900, 1, '2020-01-30', '2020-01-31 02:51:38', '2020-01-31 02:51:38', NULL),
(57, 'P-000057', 2, 3, 555000, 0, 555000, 2, '2020-01-30', '2020-01-31 02:52:36', '2020-01-31 02:52:36', NULL),
(58, 'P-000058', 2, 1, 226290, 0, 226290, 2, '2020-01-30', '2020-01-31 02:53:14', '2020-01-31 02:53:14', NULL),
(59, 'P-000059', 2, 3, 980000, 0, 980000, 2, '2020-01-30', '2020-01-31 02:54:04', '2020-01-31 02:54:04', NULL),
(60, 'P-000060', 2, 1, 2046000, 50, 2045950, 2, '2020-01-30', '2020-01-31 02:55:08', '2020-01-31 02:55:08', NULL),
(61, 'P-000061', 2, 1, 385000, 500, 384500, 2, '2020-01-30', '2020-01-31 02:56:07', '2020-01-31 02:56:07', NULL),
(62, 'P-000062', 2, 2, 88000, 0, 88000, 2, '2020-01-31', '2020-01-31 07:58:30', '2020-01-31 07:58:30', NULL),
(63, 'P-000063', 2, 2, 5570, 0, 5570, 2, '2020-01-31', '2020-01-31 07:59:18', '2020-01-31 07:59:18', NULL),
(64, 'P-000064', 1, 1, 30000, 0, 30000, 1, '2020-01-31', '2020-01-31 08:13:07', '2020-01-31 08:13:07', NULL),
(65, 'P-000065', 1, 2, 0, 0, 0, 1, '2020-01-31', '2020-01-31 10:37:13', '2020-01-31 10:37:13', NULL),
(66, 'P-000066', 1, 1, 100000, 0, 100000, 1, '2020-01-31', '2020-01-31 10:57:21', '2020-01-31 10:57:21', NULL),
(67, 'P-000067', 1, 1, 20500, 0, 20500, 1, '2020-01-31', '2020-01-31 13:01:36', '2020-01-31 13:01:36', NULL),
(68, 'P-000068', 1, 2, 97400, 0, 97400, 1, '2020-01-31', '2020-01-31 13:09:25', '2020-01-31 13:09:25', NULL),
(69, 'P-000069', 1, 1, 190, 100, 90, 1, '2020-01-31', '2020-01-31 18:37:05', '2020-01-31 18:37:05', NULL),
(70, 'P-000070', 1, 3, 3000, 0, 3000, 1, '2020-01-31', '2020-01-31 19:37:07', '2020-01-31 19:37:07', NULL),
(71, 'P-000071', 1, 1, 1000, 1000, 0, 1, '2020-01-31', '2020-02-01 04:03:05', '2020-02-01 04:03:05', NULL),
(72, 'P-000072', 1, 2, 500, 500, 0, 1, '2020-02-01', '2020-02-01 15:30:10', '2020-02-01 15:30:10', NULL),
(73, 'P-000073', 1, 2, 500, 500, 0, 1, '2020-02-01', '2020-02-01 15:30:15', '2020-02-01 19:48:25', NULL),
(74, 'P-000074', 1, 1, 12200, 0, 12200, 1, '2020-02-01', '2020-02-02 03:10:17', '2020-02-02 03:10:17', NULL),
(75, 'P-000075', 1, 1, 70000, 0, 70000, 1, '2020-02-02', '2020-02-02 12:23:24', '2020-02-02 12:23:24', NULL),
(76, 'P-000076', 1, 1, 2000, 1500, 500, 1, '2020-02-02', '2020-02-02 13:20:03', '2020-02-02 13:20:03', NULL),
(77, 'P-000077', 1, 1, 6000, 0, 6000, 1, '2020-02-02', '2020-02-02 16:17:15', '2020-02-02 16:17:15', NULL),
(78, 'P-000078', 1, 1, 6000, 0, 6000, 1, '2020-02-02', '2020-02-02 16:17:19', '2020-02-02 16:17:19', NULL),
(79, 'P-000079', 1, 1, 6000, 0, 6000, 1, '2020-02-02', '2020-02-02 16:17:24', '2020-02-02 16:17:24', NULL),
(80, 'P-000080', 1, 1, 6000, 0, 6000, 1, '2020-02-02', '2020-02-02 16:17:25', '2020-02-02 16:17:25', NULL),
(81, 'P-000081', 1, 1, 6000, 0, 6000, 1, '2020-02-02', '2020-02-02 16:17:25', '2020-02-02 16:17:25', NULL),
(82, 'P-000082', 1, 1, 20000, 0, 20000, 1, '2020-02-02', '2020-02-02 21:04:28', '2020-02-02 21:04:28', NULL),
(83, 'P-000083', 1, 2, 1425, 0, 1425, 1, '2020-02-02', '2020-02-02 21:29:50', '2020-02-02 21:29:50', NULL),
(84, 'P-000084', 1, 3, 0, 0, 0, 1, '2020-02-03', '2020-02-03 10:53:32', '2020-02-03 10:53:32', NULL),
(85, 'P-000085', 2, 2, 400000, 0, 400000, 2, '2020-02-03', '2020-02-03 11:59:58', '2020-02-03 11:59:58', NULL),
(86, 'P-000086', 1, 2, 2000, 0, 2000, 1, '2020-02-03', '2020-02-03 14:42:09', '2020-02-03 14:42:09', NULL),
(87, 'P-000087', 1, 2, 0, 0, 0, 1, '2020-02-03', '2020-02-03 21:43:17', '2020-02-03 21:43:17', NULL),
(88, 'P-000088', 1, 1, 2000, 0, 2000, 1, '2020-02-03', '2020-02-04 01:50:50', '2020-02-04 01:50:50', NULL),
(89, 'P-000089', 1, 1, 500000, 0, 500000, 1, '2020-02-04', '2020-02-04 20:52:58', '2020-02-04 20:52:58', NULL),
(90, 'P-000090', 1, 1, 0, 0, 0, 1, '2020-02-04', '2020-02-04 20:57:16', '2020-02-04 20:57:16', NULL),
(91, 'P-000091', 1, 1, 1000, 0, 1000, 1, '2020-02-04', '2020-02-04 20:57:54', '2020-02-04 20:57:54', NULL),
(92, 'P-000092', 1, 2, 10500, 9998, 502, 1, '2020-02-04', '2020-02-04 21:00:48', '2020-02-04 21:00:48', NULL),
(93, 'P-000093', 1, 1, 76000, 0, 76000, 1, '2020-02-04', '2020-02-05 01:22:20', '2020-02-05 01:22:20', NULL),
(94, 'P-000094', 1, 2, 200, 100, 100, 1, '2020-02-05', '2020-02-05 16:50:15', '2020-02-05 16:50:15', NULL),
(95, 'P-000095', 1, 2, 220000, 0, 220000, 1, '2020-02-05', '2020-02-05 10:13:45', '2020-02-05 10:13:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_products`
--

CREATE TABLE `purchase_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_price` double NOT NULL,
  `quantity` double NOT NULL,
  `total_price` double NOT NULL,
  `purchase_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `purchase_products`
--

INSERT INTO `purchase_products` (`id`, `branch_id`, `purchase_id`, `product_id`, `purchase_price`, `quantity`, `total_price`, `purchase_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 02:29:05', '2019-12-25 02:53:04', '2019-12-25 02:53:04'),
(2, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 02:29:05', '2019-12-25 02:53:04', '2019-12-25 02:53:04'),
(3, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 02:53:05', '2019-12-25 02:54:18', '2019-12-25 02:54:18'),
(4, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 02:53:05', '2019-12-25 02:54:18', '2019-12-25 02:54:18'),
(5, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 02:54:18', '2019-12-25 02:54:24', '2019-12-25 02:54:24'),
(6, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 02:54:19', '2019-12-25 02:54:24', '2019-12-25 02:54:24'),
(7, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 02:54:24', '2019-12-25 02:54:36', '2019-12-25 02:54:36'),
(8, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 02:54:24', '2019-12-25 02:54:36', '2019-12-25 02:54:36'),
(9, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 02:54:36', '2019-12-25 02:56:20', '2019-12-25 02:56:20'),
(10, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 02:54:36', '2019-12-25 02:56:20', '2019-12-25 02:56:20'),
(11, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 02:56:20', '2019-12-25 02:56:58', '2019-12-25 02:56:58'),
(12, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 02:56:20', '2019-12-25 02:56:58', '2019-12-25 02:56:58'),
(13, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 02:56:58', '2019-12-25 02:57:43', '2019-12-25 02:57:43'),
(14, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 02:56:58', '2019-12-25 02:57:43', '2019-12-25 02:57:43'),
(15, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 02:57:43', '2019-12-25 02:59:10', '2019-12-25 02:59:10'),
(16, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 02:57:43', '2019-12-25 02:59:10', '2019-12-25 02:59:10'),
(17, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 02:59:10', '2019-12-25 02:59:22', '2019-12-25 02:59:22'),
(18, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 02:59:10', '2019-12-25 02:59:22', '2019-12-25 02:59:22'),
(19, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 02:59:22', '2019-12-25 03:00:06', '2019-12-25 03:00:06'),
(20, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 02:59:22', '2019-12-25 03:00:06', '2019-12-25 03:00:06'),
(21, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:00:06', '2019-12-25 03:00:26', '2019-12-25 03:00:26'),
(22, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:00:06', '2019-12-25 03:00:26', '2019-12-25 03:00:26'),
(23, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:00:26', '2019-12-25 03:00:37', '2019-12-25 03:00:37'),
(24, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:00:26', '2019-12-25 03:00:37', '2019-12-25 03:00:37'),
(25, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:00:37', '2019-12-25 03:03:37', '2019-12-25 03:03:37'),
(26, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:00:37', '2019-12-25 03:03:37', '2019-12-25 03:03:37'),
(27, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:03:37', '2019-12-25 03:04:25', '2019-12-25 03:04:25'),
(28, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:03:37', '2019-12-25 03:04:25', '2019-12-25 03:04:25'),
(29, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:04:25', '2019-12-25 03:04:42', '2019-12-25 03:04:42'),
(30, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:04:25', '2019-12-25 03:04:42', '2019-12-25 03:04:42'),
(31, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:04:43', '2019-12-25 03:05:26', '2019-12-25 03:05:26'),
(32, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:04:43', '2019-12-25 03:05:26', '2019-12-25 03:05:26'),
(33, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:05:26', '2019-12-25 03:06:26', '2019-12-25 03:06:26'),
(34, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:05:27', '2019-12-25 03:06:26', '2019-12-25 03:06:26'),
(35, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:06:26', '2019-12-25 03:06:44', '2019-12-25 03:06:44'),
(36, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:06:26', '2019-12-25 03:06:44', '2019-12-25 03:06:44'),
(37, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:06:44', '2019-12-25 03:07:21', '2019-12-25 03:07:21'),
(38, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:06:44', '2019-12-25 03:07:21', '2019-12-25 03:07:21'),
(39, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:07:21', '2019-12-25 03:13:22', '2019-12-25 03:13:22'),
(40, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:07:21', '2019-12-25 03:13:22', '2019-12-25 03:13:22'),
(41, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:13:22', '2019-12-25 03:14:26', '2019-12-25 03:14:26'),
(42, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:13:23', '2019-12-25 03:14:26', '2019-12-25 03:14:26'),
(43, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:14:26', '2019-12-25 03:15:13', '2019-12-25 03:15:13'),
(44, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:14:26', '2019-12-25 03:15:13', '2019-12-25 03:15:13'),
(45, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:15:13', '2019-12-25 03:16:41', '2019-12-25 03:16:41'),
(46, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:15:13', '2019-12-25 03:16:41', '2019-12-25 03:16:41'),
(47, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:16:41', '2019-12-25 03:17:10', '2019-12-25 03:17:10'),
(48, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:16:41', '2019-12-25 03:17:10', '2019-12-25 03:17:10'),
(49, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:17:10', '2019-12-25 03:17:41', '2019-12-25 03:17:41'),
(50, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:17:10', '2019-12-25 03:17:41', '2019-12-25 03:17:41'),
(51, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:17:41', '2019-12-25 03:17:46', '2019-12-25 03:17:46'),
(52, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:17:41', '2019-12-25 03:17:46', '2019-12-25 03:17:46'),
(53, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:17:46', '2019-12-25 03:19:01', '2019-12-25 03:19:01'),
(54, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:17:46', '2019-12-25 03:19:01', '2019-12-25 03:19:01'),
(55, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:19:01', '2019-12-25 03:30:58', '2019-12-25 03:30:58'),
(56, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:19:01', '2019-12-25 03:30:58', '2019-12-25 03:30:58'),
(57, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:30:58', '2019-12-25 03:31:08', '2019-12-25 03:31:08'),
(58, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:30:58', '2019-12-25 03:31:08', '2019-12-25 03:31:08'),
(59, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:31:08', '2019-12-25 03:33:39', '2019-12-25 03:33:39'),
(60, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:31:08', '2019-12-25 03:33:39', '2019-12-25 03:33:39'),
(61, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:33:39', '2019-12-25 03:34:10', '2019-12-25 03:34:10'),
(62, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:33:39', '2019-12-25 03:34:10', '2019-12-25 03:34:10'),
(63, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:34:10', '2019-12-25 03:34:23', '2019-12-25 03:34:23'),
(64, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:34:10', '2019-12-25 03:34:23', '2019-12-25 03:34:23'),
(65, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:34:23', '2019-12-25 03:35:57', '2019-12-25 03:35:57'),
(66, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:34:23', '2019-12-25 03:35:57', '2019-12-25 03:35:57'),
(67, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:35:57', '2019-12-25 03:36:28', '2019-12-25 03:36:28'),
(68, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:35:57', '2019-12-25 03:36:28', '2019-12-25 03:36:28'),
(69, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:36:28', '2019-12-25 03:36:39', '2019-12-25 03:36:39'),
(70, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:36:29', '2019-12-25 03:36:39', '2019-12-25 03:36:39'),
(71, 1, 1, 2, 500, 100, 50000, '2019-12-25', '2019-12-25 03:36:39', '2019-12-25 03:36:39', NULL),
(72, 1, 1, 1, 1000, 100, 100000, '2019-12-25', '2019-12-25 03:36:39', '2019-12-25 03:36:39', NULL),
(73, 1, 2, 40, 95, 60, 5700, '2019-09-26', '2019-12-25 11:32:23', '2019-12-25 11:32:23', NULL),
(74, 1, 2, 39, 40, 50, 2000, '2019-09-26', '2019-12-25 11:32:23', '2019-12-25 11:32:23', NULL),
(75, 1, 2, 38, 120, 100, 12000, '2019-09-26', '2019-12-25 11:32:23', '2019-12-25 11:32:23', NULL),
(76, 1, 2, 37, 100, 20, 2000, '2019-09-26', '2019-12-25 11:32:23', '2019-12-25 11:32:23', NULL),
(77, 1, 2, 36, 150, 50, 7500, '2019-09-26', '2019-12-25 11:32:23', '2019-12-25 11:32:23', NULL),
(78, 1, 2, 35, 150, 100, 15000, '2019-09-26', '2019-12-25 11:32:23', '2019-12-25 11:32:23', NULL),
(79, 1, 3, 41, 95, 6, 570, '2019-09-26', '2019-12-25 11:33:44', '2019-12-25 11:33:44', NULL),
(80, 1, 3, 42, 40, 5, 200, '2019-09-26', '2019-12-25 11:33:44', '2019-12-25 11:33:44', NULL),
(81, 1, 3, 45, 40, 20, 800, '2019-09-26', '2019-12-25 11:33:44', '2019-12-25 11:33:44', NULL),
(82, 1, 3, 44, 30, 19, 570, '2019-09-26', '2019-12-25 11:33:44', '2019-12-25 11:33:44', NULL),
(83, 1, 4, 34, 500, 18, 9000, '2019-09-30', '2019-12-25 11:36:32', '2019-12-25 11:36:32', NULL),
(84, 1, 4, 33, 1000, 15, 15000, '2019-09-30', '2019-12-25 11:36:32', '2019-12-25 11:36:32', NULL),
(85, 1, 4, 30, 1000, 15, 15000, '2019-09-30', '2019-12-25 11:36:32', '2019-12-25 11:36:32', NULL),
(86, 1, 4, 29, 1000, 29, 29000, '2019-09-30', '2019-12-25 11:36:33', '2019-12-25 11:36:33', NULL),
(87, 1, 4, 27, 500, 38, 19000, '2019-09-30', '2019-12-25 11:36:33', '2019-12-25 11:36:33', NULL),
(88, 1, 4, 26, 500, 30, 15000, '2019-09-30', '2019-12-25 11:36:33', '2019-12-25 11:36:33', NULL),
(89, 1, 5, 18, 2000, 5, 10000, '2019-09-30', '2019-12-25 11:37:06', '2019-12-25 11:37:06', NULL),
(90, 1, 5, 17, 1000, 5, 5000, '2019-09-30', '2019-12-25 11:37:06', '2019-12-25 11:37:06', NULL),
(91, 1, 5, 15, 2000, 5, 10000, '2019-09-30', '2019-12-25 11:37:06', '2019-12-25 11:37:06', NULL),
(92, 1, 5, 13, 1500, 6, 9000, '2019-09-30', '2019-12-25 11:37:06', '2019-12-25 11:37:06', NULL),
(93, 1, 5, 11, 2000, 6, 12000, '2019-09-30', '2019-12-25 11:37:06', '2019-12-25 11:37:06', NULL),
(94, 1, 6, 2, 500, 5, 2500, '2019-10-06', '2019-12-25 11:37:42', '2019-12-25 11:37:42', NULL),
(95, 1, 6, 5, 4000, 8, 32000, '2019-10-06', '2019-12-25 11:37:42', '2019-12-25 11:37:42', NULL),
(96, 1, 6, 9, 10000, 8, 80000, '2019-10-06', '2019-12-25 11:37:42', '2019-12-25 11:37:42', NULL),
(97, 1, 6, 7, 700, 6, 4200, '2019-10-06', '2019-12-25 11:37:42', '2019-12-25 11:37:42', NULL),
(98, 1, 6, 4, 4000, 7, 28000, '2019-10-06', '2019-12-25 11:37:42', '2019-12-25 11:37:42', NULL),
(99, 1, 6, 10, 20000, 8, 160000, '2019-10-06', '2019-12-25 11:37:42', '2019-12-25 11:37:42', NULL),
(100, 1, 7, 3, 5000, 8, 40000, '2019-10-06', '2019-12-25 11:37:57', '2019-12-25 11:37:57', NULL),
(101, 1, 7, 4, 4000, 7, 28000, '2019-10-06', '2019-12-25 11:37:57', '2019-12-25 11:37:57', NULL),
(102, 1, 7, 2, 500, 5, 2500, '2019-10-06', '2019-12-25 11:37:57', '2019-12-25 11:37:57', NULL),
(103, 1, 7, 5, 4000, 8, 32000, '2019-10-06', '2019-12-25 11:37:57', '2019-12-25 11:37:57', NULL),
(104, 1, 7, 10, 20000, 8, 160000, '2019-10-06', '2019-12-25 11:37:57', '2019-12-25 11:37:57', NULL),
(105, 1, 8, 34, 500, 6, 3000, '2019-10-11', '2019-12-25 11:38:28', '2019-12-25 11:38:28', NULL),
(106, 1, 8, 32, 500, 6, 3000, '2019-10-11', '2019-12-25 11:38:29', '2019-12-25 11:38:29', NULL),
(107, 1, 8, 29, 1000, 7, 7000, '2019-10-11', '2019-12-25 11:38:29', '2019-12-25 11:38:29', NULL),
(108, 1, 8, 33, 1000, 7, 7000, '2019-10-11', '2019-12-25 11:38:29', '2019-12-25 11:38:29', NULL),
(109, 1, 9, 42, 40, 20, 800, '2019-10-16', '2019-12-25 11:38:57', '2019-12-25 11:38:57', NULL),
(110, 1, 10, 19, 3000, 4, 12000, '2019-10-12', '2019-12-25 11:41:05', '2019-12-25 11:41:05', NULL),
(111, 1, 10, 18, 2000, 9, 18000, '2019-10-12', '2019-12-25 11:41:05', '2019-12-25 11:41:05', NULL),
(112, 1, 10, 14, 500, 4, 2000, '2019-10-12', '2019-12-25 11:41:05', '2019-12-25 11:41:05', NULL),
(113, 1, 10, 13, 1500, 8, 12000, '2019-10-12', '2019-12-25 11:41:05', '2019-12-25 11:41:05', NULL),
(114, 1, 10, 11, 2000, 8, 16000, '2019-10-12', '2019-12-25 11:41:05', '2019-12-25 11:41:05', NULL),
(115, 1, 11, 21, 2000, 8, 16000, '2019-10-12', '2019-12-25 11:41:26', '2019-12-25 11:41:26', NULL),
(116, 1, 11, 23, 1000, 3, 3000, '2019-10-12', '2019-12-25 11:41:26', '2019-12-25 11:41:26', NULL),
(117, 1, 12, 23, 1000, 3, 3000, '2019-10-26', '2019-12-25 11:42:08', '2019-12-25 11:42:08', NULL),
(118, 1, 12, 17, 1000, 17, 17000, '2019-10-26', '2019-12-25 11:42:08', '2019-12-25 11:42:08', NULL),
(119, 1, 12, 20, 2000, 8, 16000, '2019-10-26', '2019-12-25 11:42:08', '2019-12-25 11:42:08', NULL),
(120, 1, 12, 24, 500, 34, 17000, '2019-10-26', '2019-12-25 11:42:08', '2019-12-25 11:42:08', NULL),
(121, 1, 13, 13, 1500, 5, 7500, '2019-10-31', '2019-12-25 11:43:08', '2019-12-25 11:43:08', NULL),
(122, 1, 13, 17, 1000, 5, 5000, '2019-10-31', '2019-12-25 11:43:08', '2019-12-25 11:43:08', NULL),
(123, 1, 13, 22, 2000, 5, 10000, '2019-10-31', '2019-12-25 11:43:08', '2019-12-25 11:43:08', NULL),
(124, 1, 13, 21, 2000, 5, 10000, '2019-10-31', '2019-12-25 11:43:08', '2019-12-25 11:43:08', NULL),
(125, 1, 13, 12, 1000, 5, 5000, '2019-10-31', '2019-12-25 11:43:08', '2019-12-25 11:43:08', NULL),
(126, 1, 13, 24, 500, 5, 2500, '2019-10-31', '2019-12-25 11:43:08', '2019-12-25 11:43:08', NULL),
(127, 1, 14, 45, 40, 7, 280, '2019-11-05', '2019-12-25 11:44:23', '2019-12-25 11:44:23', NULL),
(128, 1, 14, 44, 30, 7, 210, '2019-11-05', '2019-12-25 11:44:23', '2019-12-25 11:44:23', NULL),
(129, 1, 14, 27, 500, 7, 3500, '2019-11-05', '2019-12-25 11:44:24', '2019-12-25 11:44:24', NULL),
(130, 1, 14, 14, 500, 7, 3500, '2019-11-05', '2019-12-25 11:44:24', '2019-12-25 11:44:24', NULL),
(131, 1, 14, 10, 20000, 7, 140000, '2019-11-05', '2019-12-25 11:44:24', '2019-12-25 11:44:24', NULL),
(132, 1, 14, 9, 10000, 7, 70000, '2019-11-05', '2019-12-25 11:44:24', '2019-12-25 11:44:24', NULL),
(133, 1, 14, 8, 10000, 7, 70000, '2019-11-05', '2019-12-25 11:44:24', '2019-12-25 11:44:24', NULL),
(134, 1, 15, 13, 1500, 10, 15000, '2019-11-15', '2019-12-25 11:50:52', '2019-12-25 11:50:52', NULL),
(135, 1, 15, 16, 2500, 6, 15000, '2019-11-15', '2019-12-25 11:50:52', '2019-12-25 11:50:52', NULL),
(136, 1, 15, 9, 10000, 6, 60000, '2019-11-15', '2019-12-25 11:50:52', '2019-12-25 11:50:52', NULL),
(137, 1, 15, 8, 10000, 6, 60000, '2019-11-15', '2019-12-25 11:50:53', '2019-12-25 11:50:53', NULL),
(138, 1, 16, 31, 1500, 5, 7500, '2019-11-21', '2019-12-25 11:51:24', '2019-12-25 11:51:24', NULL),
(139, 1, 16, 45, 40, 5, 200, '2019-11-21', '2019-12-25 11:51:24', '2019-12-25 11:51:24', NULL),
(140, 1, 16, 37, 100, 5, 500, '2019-11-21', '2019-12-25 11:51:24', '2019-12-25 11:51:24', NULL),
(141, 1, 16, 39, 40, 5, 200, '2019-11-21', '2019-12-25 11:51:24', '2019-12-25 11:51:24', NULL),
(142, 1, 16, 33, 1000, 5, 5000, '2019-11-21', '2019-12-25 11:51:24', '2019-12-25 11:51:24', NULL),
(143, 1, 16, 16, 2500, 6, 15000, '2019-11-21', '2019-12-25 11:51:24', '2019-12-25 11:51:24', NULL),
(144, 1, 16, 8, 10000, 6, 60000, '2019-11-21', '2019-12-25 11:51:24', '2019-12-25 11:51:24', NULL),
(145, 1, 17, 22, 2000, 8, 16000, '2019-11-23', '2019-12-25 11:52:16', '2019-12-25 11:52:16', NULL),
(146, 1, 17, 21, 2000, 8, 16000, '2019-11-23', '2019-12-25 11:52:16', '2019-12-25 11:52:16', NULL),
(147, 1, 17, 25, 500, 8, 4000, '2019-11-23', '2019-12-25 11:52:16', '2019-12-25 11:52:16', NULL),
(148, 1, 17, 24, 500, 8, 4000, '2019-11-23', '2019-12-25 11:52:16', '2019-12-25 11:52:16', NULL),
(149, 1, 17, 17, 1000, 8, 8000, '2019-11-23', '2019-12-25 11:52:16', '2019-12-25 11:52:16', NULL),
(150, 1, 17, 20, 2000, 8, 16000, '2019-11-23', '2019-12-25 11:52:16', '2019-12-25 11:52:16', NULL),
(151, 1, 17, 13, 1500, 10, 15000, '2019-11-23', '2019-12-25 11:52:16', '2019-12-25 11:52:16', NULL),
(152, 1, 17, 11, 2000, 8, 16000, '2019-11-23', '2019-12-25 11:52:16', '2019-12-25 11:52:16', NULL),
(153, 1, 18, 18, 2000, 5, 10000, '2019-11-25', '2019-12-25 11:53:18', '2019-12-25 11:53:18', NULL),
(154, 1, 18, 20, 2000, 5, 10000, '2019-11-25', '2019-12-25 11:53:18', '2019-12-25 11:53:18', NULL),
(155, 1, 18, 22, 2000, 5, 10000, '2019-11-25', '2019-12-25 11:53:18', '2019-12-25 11:53:18', NULL),
(156, 1, 18, 17, 1000, 5, 5000, '2019-11-25', '2019-12-25 11:53:18', '2019-12-25 11:53:18', NULL),
(157, 1, 18, 23, 1000, 5, 5000, '2019-11-25', '2019-12-25 11:53:18', '2019-12-25 11:53:18', NULL),
(158, 1, 18, 24, 500, 8, 4000, '2019-11-25', '2019-12-25 11:53:18', '2019-12-25 11:53:18', NULL),
(159, 1, 18, 25, 500, 8, 4000, '2019-11-25', '2019-12-25 11:53:19', '2019-12-25 11:53:19', NULL),
(160, 1, 19, 17, 1000, 5, 5000, '2019-11-26', '2019-12-25 11:54:05', '2019-12-25 11:54:05', NULL),
(161, 1, 19, 14, 500, 5, 2500, '2019-11-26', '2019-12-25 11:54:05', '2019-12-25 11:54:05', NULL),
(162, 1, 19, 13, 1500, 8, 12000, '2019-11-26', '2019-12-25 11:54:05', '2019-12-25 11:54:05', NULL),
(163, 1, 19, 11, 2000, 8, 16000, '2019-11-26', '2019-12-25 11:54:05', '2019-12-25 11:54:05', NULL),
(164, 1, 20, 14, 500, 5, 2500, '2019-11-28', '2019-12-25 11:54:48', '2019-12-25 11:54:48', NULL),
(165, 1, 20, 13, 1500, 12, 18000, '2019-11-28', '2019-12-25 11:54:48', '2019-12-25 11:54:48', NULL),
(166, 1, 20, 12, 1000, 12, 12000, '2019-11-28', '2019-12-25 11:54:48', '2019-12-25 11:54:48', NULL),
(167, 1, 21, 17, 1000, 5, 5000, '2019-11-28', '2019-12-25 11:55:04', '2019-12-25 11:55:04', NULL),
(168, 1, 21, 15, 2000, 15, 30000, '2019-11-28', '2019-12-25 11:55:04', '2019-12-25 11:55:04', NULL),
(169, 1, 21, 20, 2000, 5, 10000, '2019-11-28', '2019-12-25 11:55:04', '2019-12-25 11:55:04', NULL),
(170, 1, 22, 18, 2000, 5, 10000, '2019-11-29', '2019-12-25 11:56:42', '2019-12-25 11:56:42', NULL),
(171, 1, 22, 23, 1000, 20, 20000, '2019-11-29', '2019-12-25 11:56:42', '2019-12-25 11:56:42', NULL),
(172, 1, 22, 16, 2500, 20, 50000, '2019-11-29', '2019-12-25 11:56:42', '2019-12-25 11:56:42', NULL),
(173, 1, 23, 34, 500, 13, 6500, '2019-12-02', '2019-12-25 11:58:07', '2019-12-25 11:58:07', NULL),
(174, 1, 23, 33, 1000, 12, 12000, '2019-12-02', '2019-12-25 11:58:07', '2019-12-25 11:58:07', NULL),
(175, 1, 23, 29, 1000, 12, 12000, '2019-12-02', '2019-12-25 11:58:07', '2019-12-25 11:58:07', NULL),
(176, 1, 23, 28, 1000, 12, 12000, '2019-12-02', '2019-12-25 11:58:07', '2019-12-25 11:58:07', NULL),
(177, 1, 24, 26, 500, 1, 500, '2019-12-02', '2019-12-25 11:58:24', '2019-12-25 11:58:24', NULL),
(178, 1, 24, 30, 1000, 1, 1000, '2019-12-02', '2019-12-25 11:58:24', '2019-12-25 11:58:24', NULL),
(179, 1, 24, 33, 1000, 12, 12000, '2019-12-02', '2019-12-25 11:58:24', '2019-12-25 11:58:24', NULL),
(180, 1, 25, 31, 1500, 40, 60000, '2019-12-03', '2019-12-25 11:59:12', '2019-12-25 11:59:12', NULL),
(181, 1, 25, 30, 1000, 50, 50000, '2019-12-03', '2019-12-25 11:59:12', '2019-12-25 11:59:12', NULL),
(182, 1, 26, 5, 4000, 12, 48000, '2019-12-06', '2019-12-25 12:00:02', '2019-12-25 12:00:02', NULL),
(183, 1, 26, 4, 4000, 12, 48000, '2019-12-06', '2019-12-25 12:00:02', '2019-12-25 12:00:02', NULL),
(184, 1, 26, 1, 1000, 12, 12000, '2019-12-06', '2019-12-25 12:00:02', '2019-12-25 12:00:02', NULL),
(185, 1, 26, 28, 1000, 12, 12000, '2019-12-06', '2019-12-25 12:00:02', '2019-12-25 12:00:02', NULL),
(186, 1, 26, 34, 500, 13, 6500, '2019-12-06', '2019-12-25 12:00:02', '2019-12-25 12:00:02', NULL),
(187, 1, 27, 1, 1000, 12, 12000, '2019-12-08', '2019-12-25 12:01:04', '2019-12-25 12:01:04', NULL),
(188, 1, 27, 7, 700, 5, 3500, '2019-12-08', '2019-12-25 12:01:04', '2019-12-25 12:01:04', NULL),
(189, 1, 27, 6, 1500, 5, 7500, '2019-12-08', '2019-12-25 12:01:04', '2019-12-25 12:01:04', NULL),
(190, 1, 27, 4, 4000, 12, 48000, '2019-12-08', '2019-12-25 12:01:04', '2019-12-25 12:01:04', NULL),
(191, 1, 27, 10, 20000, 5, 100000, '2019-12-08', '2019-12-25 12:01:04', '2019-12-25 12:01:04', NULL),
(192, 1, 28, 8, 10000, 5, 50000, '2019-12-08', '2019-12-25 12:01:27', '2019-12-25 12:01:27', NULL),
(193, 1, 28, 7, 700, 12, 8400, '2019-12-08', '2019-12-25 12:01:27', '2019-12-25 12:01:27', NULL),
(194, 1, 29, 16, 2500, 8, 20000, '2019-12-11', '2019-12-25 12:02:12', '2019-12-25 12:02:12', NULL),
(195, 1, 29, 9, 10000, 8, 80000, '2019-12-11', '2019-12-25 12:02:12', '2019-12-25 12:02:12', NULL),
(196, 1, 29, 3, 5000, 8, 40000, '2019-12-11', '2019-12-25 12:02:12', '2019-12-25 12:02:12', NULL),
(197, 1, 30, 19, 3000, 1, 3000, '2019-12-11', '2019-12-25 12:03:23', '2019-12-25 12:03:23', NULL),
(198, 1, 30, 15, 2000, 1, 2000, '2019-12-11', '2019-12-25 12:03:23', '2019-12-25 12:03:23', NULL),
(199, 1, 30, 16, 2500, 1, 2500, '2019-12-11', '2019-12-25 12:03:24', '2019-12-25 12:03:24', NULL),
(200, 1, 30, 10, 20000, 1, 20000, '2019-12-11', '2019-12-25 12:03:24', '2019-12-25 12:03:24', NULL),
(201, 1, 30, 8, 10000, 1, 10000, '2019-12-11', '2019-12-25 12:03:24', '2019-12-25 12:03:24', NULL),
(202, 1, 31, 41, 95, 1, 95, '2019-12-17', '2019-12-25 12:04:21', '2019-12-25 12:04:21', NULL),
(203, 1, 31, 27, 500, 1, 500, '2019-12-17', '2019-12-25 12:04:21', '2019-12-25 12:04:21', NULL),
(204, 1, 31, 23, 1000, 1, 1000, '2019-12-17', '2019-12-25 12:04:21', '2019-12-25 12:04:21', NULL),
(205, 1, 31, 15, 2000, 1, 2000, '2019-12-17', '2019-12-25 12:04:21', '2019-12-25 12:04:21', NULL),
(206, 1, 32, 19, 3000, 1, 3000, '2019-12-17', '2019-12-25 12:04:32', '2019-12-25 12:04:32', NULL),
(207, 1, 32, 15, 2000, 1, 2000, '2019-12-17', '2019-12-25 12:04:32', '2019-12-25 12:04:32', NULL),
(208, 1, 32, 23, 1000, 1, 1000, '2019-12-17', '2019-12-25 12:04:32', '2019-12-25 12:04:32', NULL),
(209, 1, 32, 21, 2000, 1, 2000, '2019-12-17', '2019-12-25 12:04:32', '2019-12-25 12:04:32', NULL),
(210, 1, 33, 39, 40, 1, 40, '2019-12-17', '2019-12-25 12:04:42', '2019-12-25 12:04:42', NULL),
(211, 1, 33, 29, 1000, 1, 1000, '2019-12-17', '2019-12-25 12:04:42', '2019-12-25 12:04:42', NULL),
(212, 1, 33, 23, 1000, 1, 1000, '2019-12-17', '2019-12-25 12:04:42', '2019-12-25 12:04:42', NULL),
(213, 1, 34, 26, 500, 1, 500, '2019-12-17', '2019-12-25 12:04:53', '2019-12-25 12:04:53', NULL),
(214, 1, 34, 30, 1000, 1, 1000, '2019-12-17', '2019-12-25 12:04:53', '2019-12-25 12:04:53', NULL),
(215, 1, 34, 35, 150, 1, 150, '2019-12-17', '2019-12-25 12:04:53', '2019-12-25 12:04:53', NULL),
(216, 1, 34, 44, 30, 1, 30, '2019-12-17', '2019-12-25 12:04:53', '2019-12-25 12:04:53', NULL),
(217, 1, 35, 11, 2000, 5, 10000, '2019-12-17', '2019-12-25 12:05:34', '2019-12-25 12:05:34', NULL),
(218, 1, 35, 22, 2000, 5, 10000, '2019-12-17', '2019-12-25 12:05:34', '2019-12-25 12:05:34', NULL),
(219, 1, 35, 14, 500, 5, 2500, '2019-12-17', '2019-12-25 12:05:34', '2019-12-25 12:05:34', NULL),
(220, 1, 35, 10, 20000, 5, 100000, '2019-12-17', '2019-12-25 12:05:34', '2019-12-25 12:05:34', NULL),
(221, 1, 36, 27, 500, 5, 2500, '2019-12-18', '2019-12-25 12:06:10', '2019-12-25 12:06:10', NULL),
(222, 1, 36, 31, 1500, 5, 7500, '2019-12-18', '2019-12-25 12:06:10', '2019-12-25 12:06:10', NULL),
(223, 1, 36, 45, 40, 5, 200, '2019-12-18', '2019-12-25 12:06:10', '2019-12-25 12:06:10', NULL),
(224, 1, 36, 34, 500, 5, 2500, '2019-12-18', '2019-12-25 12:06:10', '2019-12-25 12:06:10', NULL),
(225, 1, 36, 15, 2000, 5, 10000, '2019-12-18', '2019-12-25 12:06:11', '2019-12-25 12:06:11', NULL),
(226, 1, 36, 2, 500, 5, 2500, '2019-12-18', '2019-12-25 12:06:11', '2019-12-25 12:06:11', NULL),
(227, 1, 37, 9, 10000, 5, 50000, '2019-12-18', '2019-12-25 12:06:23', '2019-12-25 12:06:23', NULL),
(228, 1, 37, 5, 4000, 5, 20000, '2019-12-18', '2019-12-25 12:06:23', '2019-12-25 12:06:23', NULL),
(229, 1, 37, 1, 1000, 5, 5000, '2019-12-18', '2019-12-25 12:06:23', '2019-12-25 12:06:23', NULL),
(230, 1, 38, 13, 1500, 5, 7500, '2019-12-19', '2019-12-25 12:06:51', '2019-12-25 12:06:51', NULL),
(231, 1, 38, 17, 1000, 5, 5000, '2019-12-19', '2019-12-25 12:06:51', '2019-12-25 12:06:51', NULL),
(232, 1, 38, 11, 2000, 5, 10000, '2019-12-19', '2019-12-25 12:06:51', '2019-12-25 12:06:51', NULL),
(233, 1, 38, 10, 20000, 5, 100000, '2019-12-19', '2019-12-25 12:06:51', '2019-12-25 12:06:51', NULL),
(234, 1, 39, 32, 500, 5, 2500, '2019-12-19', '2019-12-25 12:07:05', '2019-12-25 12:07:05', NULL),
(235, 1, 39, 31, 1500, 5, 7500, '2019-12-19', '2019-12-25 12:07:05', '2019-12-25 12:07:05', NULL),
(236, 1, 39, 25, 500, 5, 2500, '2019-12-19', '2019-12-25 12:07:05', '2019-12-25 12:07:05', NULL),
(237, 1, 39, 26, 500, 5, 2500, '2019-12-19', '2019-12-25 12:07:05', '2019-12-25 12:07:05', NULL),
(238, 1, 39, 30, 1000, 5, 5000, '2019-12-19', '2019-12-25 12:07:05', '2019-12-25 12:07:05', NULL),
(239, 1, 39, 29, 1000, 5, 5000, '2019-12-19', '2019-12-25 12:07:05', '2019-12-25 12:07:05', NULL),
(240, 1, 39, 34, 500, 5, 2500, '2019-12-19', '2019-12-25 12:07:05', '2019-12-25 12:07:05', NULL),
(241, 1, 39, 15, 2000, 5, 10000, '2019-12-19', '2019-12-25 12:07:05', '2019-12-25 12:07:05', NULL),
(242, 1, 40, 45, 40, 5, 200, '2019-12-20', '2019-12-25 12:07:36', '2019-12-25 12:07:36', NULL),
(243, 1, 40, 43, 45, 5, 225, '2019-12-20', '2019-12-25 12:07:36', '2019-12-25 12:07:36', NULL),
(244, 1, 40, 31, 1500, 5, 7500, '2019-12-20', '2019-12-25 12:07:36', '2019-12-25 12:07:36', NULL),
(245, 1, 40, 41, 95, 5, 475, '2019-12-20', '2019-12-25 12:07:36', '2019-12-25 12:07:36', NULL),
(246, 1, 40, 40, 95, 5, 475, '2019-12-20', '2019-12-25 12:07:36', '2019-12-25 12:07:36', NULL),
(247, 1, 41, 1, 1000, 5, 5000, '2019-12-20', '2019-12-25 12:08:14', '2019-12-25 12:08:14', NULL),
(248, 1, 41, 3, 5000, 5, 25000, '2019-12-20', '2019-12-25 12:08:14', '2019-12-25 12:08:14', NULL),
(249, 1, 41, 4, 4000, 5, 20000, '2019-12-20', '2019-12-25 12:08:14', '2019-12-25 12:08:14', NULL),
(250, 1, 41, 10, 20000, 5, 100000, '2019-12-20', '2019-12-25 12:08:14', '2019-12-25 12:08:14', NULL),
(251, 1, 41, 22, 2000, 5, 10000, '2019-12-20', '2019-12-25 12:08:14', '2019-12-25 12:08:14', NULL),
(252, 1, 41, 29, 1000, 5, 5000, '2019-12-20', '2019-12-25 12:08:14', '2019-12-25 12:08:14', NULL),
(253, 1, 41, 35, 150, 5, 750, '2019-12-20', '2019-12-25 12:08:14', '2019-12-25 12:08:14', NULL),
(254, 1, 41, 36, 150, 5, 750, '2019-12-20', '2019-12-25 12:08:14', '2019-12-25 12:08:14', NULL),
(255, 1, 41, 34, 500, 5, 2500, '2019-12-20', '2019-12-25 12:08:14', '2019-12-25 12:08:14', NULL),
(256, 1, 42, 37, 100, 5, 500, '2019-12-21', '2019-12-25 12:09:01', '2019-12-25 12:09:01', NULL),
(257, 1, 42, 45, 40, 5, 200, '2019-12-21', '2019-12-25 12:09:01', '2019-12-25 12:09:01', NULL),
(258, 1, 42, 39, 40, 5, 200, '2019-12-21', '2019-12-25 12:09:01', '2019-12-25 12:09:01', NULL),
(259, 1, 42, 31, 1500, 5, 7500, '2019-12-21', '2019-12-25 12:09:01', '2019-12-25 12:09:01', NULL),
(260, 1, 42, 34, 500, 5, 2500, '2019-12-21', '2019-12-25 12:09:01', '2019-12-25 12:09:01', NULL),
(261, 1, 42, 18, 2000, 5, 10000, '2019-12-21', '2019-12-25 12:09:01', '2019-12-25 12:09:01', NULL),
(262, 1, 42, 13, 1500, 5, 7500, '2019-12-21', '2019-12-25 12:09:01', '2019-12-25 12:09:01', NULL),
(263, 1, 42, 16, 2500, 5, 12500, '2019-12-21', '2019-12-25 12:09:01', '2019-12-25 12:09:01', NULL),
(264, 1, 43, 34, 500, 5, 2500, '2019-12-22', '2019-12-25 12:09:29', '2019-12-25 12:09:29', NULL),
(265, 1, 43, 17, 1000, 5, 5000, '2019-12-22', '2019-12-25 12:09:29', '2019-12-25 12:09:29', NULL),
(266, 1, 43, 6, 1500, 5, 7500, '2019-12-22', '2019-12-25 12:09:29', '2019-12-25 12:09:29', NULL),
(267, 1, 43, 13, 1500, 5, 7500, '2019-12-22', '2019-12-25 12:09:29', '2019-12-25 12:09:29', NULL),
(268, 1, 43, 1, 1000, 5, 5000, '2019-12-22', '2019-12-25 12:09:29', '2019-12-25 12:09:29', NULL),
(269, 1, 43, 2, 500, 5, 2500, '2019-12-22', '2019-12-25 12:09:29', '2019-12-25 12:09:29', NULL),
(270, 1, 43, 5, 4000, 5, 20000, '2019-12-22', '2019-12-25 12:09:29', '2019-12-25 12:09:29', NULL),
(271, 1, 43, 10, 20000, 5, 100000, '2019-12-22', '2019-12-25 12:09:29', '2019-12-25 12:09:29', NULL),
(272, 1, 43, 37, 100, 5, 500, '2019-12-22', '2019-12-25 12:09:29', '2019-12-25 12:09:29', NULL),
(273, 1, 43, 32, 500, 5, 2500, '2019-12-22', '2019-12-25 12:09:29', '2019-12-25 12:09:29', NULL),
(274, 1, 44, 36, 150, 5, 750, '2019-12-25', '2019-12-25 12:09:54', '2019-12-25 12:09:54', NULL),
(275, 1, 44, 14, 500, 5, 2500, '2019-12-25', '2019-12-25 12:09:54', '2019-12-25 12:09:54', NULL),
(276, 1, 44, 13, 1500, 5, 7500, '2019-12-25', '2019-12-25 12:09:54', '2019-12-25 12:09:54', NULL),
(277, 1, 44, 17, 1000, 5, 5000, '2019-12-25', '2019-12-25 12:09:54', '2019-12-25 12:09:54', NULL),
(278, 1, 44, 38, 120, 5, 600, '2019-12-25', '2019-12-25 12:09:54', '2019-12-25 12:09:54', NULL),
(279, 1, 45, 25, 500, 5, 2500, '2019-12-26', '2019-12-25 12:10:11', '2019-12-25 12:10:11', NULL),
(280, 1, 45, 28, 1000, 5, 5000, '2019-12-26', '2019-12-25 12:10:11', '2019-12-25 12:10:11', NULL),
(281, 1, 45, 23, 1000, 5, 5000, '2019-12-26', '2019-12-25 12:10:11', '2019-12-25 12:10:11', NULL),
(282, 1, 45, 15, 2000, 5, 10000, '2019-12-26', '2019-12-25 12:10:11', '2019-12-25 12:10:11', NULL),
(283, 1, 46, 5, 4000, 18, 72000, '2019-12-26', '2019-12-26 02:03:21', '2019-12-26 02:03:21', NULL),
(284, 1, 47, 1, 1000, 1, 1000, '2019-12-26', '2019-12-26 02:03:55', '2019-12-26 02:03:55', NULL),
(285, 1, 48, 4, 4000, 10, 40000, '2019-12-26', '2019-12-26 10:12:30', '2019-12-26 10:12:30', NULL),
(286, 1, 49, 2, 500, 20, 10000, '2019-12-26', '2019-12-26 11:56:59', '2019-12-26 11:56:59', NULL),
(287, 1, 49, 8, 10000, 20, 200000, '2019-12-26', '2019-12-26 11:56:59', '2019-12-26 11:56:59', NULL),
(288, 1, 49, 7, 700, 20, 14000, '2019-12-26', '2019-12-26 11:56:59', '2019-12-26 11:56:59', NULL),
(289, 1, 50, 1, 1000, 10, 10000, '2020-01-10', '2020-01-10 04:46:05', '2020-01-10 04:46:05', NULL),
(290, 1, 51, 1, 1000, 10, 10000, '2020-01-14', '2020-01-14 16:24:04', '2020-01-14 16:24:04', NULL),
(291, 1, 52, 19, 3000, 50, 150000, '2020-01-27', '2020-01-27 14:01:01', '2020-01-27 14:01:01', NULL),
(292, 1, 52, 17, 1000, 30, 30000, '2020-01-27', '2020-01-27 14:01:01', '2020-01-27 14:01:01', NULL),
(293, 1, 52, 6, 1500, 50, 75000, '2020-01-27', '2020-01-27 14:01:01', '2020-01-27 14:01:01', NULL),
(294, 1, 52, 11, 2000, 30, 60000, '2020-01-27', '2020-01-27 14:01:01', '2020-01-27 14:01:01', NULL),
(295, 1, 53, 16, 2500, 50, 125000, '2020-01-29', '2020-01-29 12:15:32', '2020-01-29 12:15:32', NULL),
(296, 1, 53, 9, 10000, 50, 500000, '2020-01-29', '2020-01-29 12:15:32', '2020-01-29 12:15:32', NULL),
(297, 1, 53, 3, 5000, 50, 250000, '2020-01-29', '2020-01-29 12:15:32', '2020-01-29 12:15:32', NULL),
(298, 1, 54, 4, 4000, 1, 4000, '2020-01-30', '2020-01-30 22:54:12', '2020-01-30 22:54:12', NULL),
(299, 1, 54, 2, 500, 1, 500, '2020-01-30', '2020-01-30 22:54:12', '2020-01-30 22:54:12', NULL),
(300, 1, 55, 12, 1000, 1, 1000, '2020-01-30', '2020-01-30 23:21:07', '2020-01-30 23:21:07', NULL),
(301, 1, 55, 2, 500, 1, 500, '2020-01-30', '2020-01-30 23:21:07', '2020-01-30 23:21:07', NULL),
(302, 1, 56, 43, 45, 20, 900, '2020-01-30', '2020-01-31 02:51:38', '2020-01-31 02:51:38', NULL),
(303, 2, 57, 5, 4000, 50, 200000, '2020-01-30', '2020-01-31 02:52:36', '2020-01-31 02:52:36', NULL),
(304, 2, 57, 4, 4000, 40, 160000, '2020-01-30', '2020-01-31 02:52:36', '2020-01-31 02:52:36', NULL),
(305, 2, 57, 3, 5000, 30, 150000, '2020-01-30', '2020-01-31 02:52:36', '2020-01-31 02:52:36', NULL),
(306, 2, 57, 2, 500, 30, 15000, '2020-01-30', '2020-01-31 02:52:36', '2020-01-31 02:52:36', NULL),
(307, 2, 57, 1, 1000, 30, 30000, '2020-01-30', '2020-01-31 02:52:36', '2020-01-31 02:52:36', NULL),
(308, 2, 58, 17, 1000, 50, 50000, '2020-01-30', '2020-01-31 02:53:14', '2020-01-31 02:53:14', NULL),
(309, 2, 58, 42, 40, 60, 2400, '2020-01-30', '2020-01-31 02:53:14', '2020-01-31 02:53:14', NULL),
(310, 2, 58, 41, 95, 52, 4940, '2020-01-30', '2020-01-31 02:53:14', '2020-01-31 02:53:14', NULL),
(311, 2, 58, 29, 1000, 18, 18000, '2020-01-30', '2020-01-31 02:53:14', '2020-01-31 02:53:14', NULL),
(312, 2, 58, 40, 95, 10, 950, '2020-01-30', '2020-01-31 02:53:14', '2020-01-31 02:53:14', NULL),
(313, 2, 58, 25, 500, 20, 10000, '2020-01-30', '2020-01-31 02:53:14', '2020-01-31 02:53:14', NULL),
(314, 2, 58, 22, 2000, 40, 80000, '2020-01-30', '2020-01-31 02:53:14', '2020-01-31 02:53:14', NULL),
(315, 2, 58, 15, 2000, 30, 60000, '2020-01-30', '2020-01-31 02:53:14', '2020-01-31 02:53:14', NULL),
(316, 2, 59, 14, 500, 55, 27500, '2020-01-30', '2020-01-31 02:54:04', '2020-01-31 02:54:04', NULL),
(317, 2, 59, 12, 1000, 30, 30000, '2020-01-30', '2020-01-31 02:54:04', '2020-01-31 02:54:04', NULL),
(318, 2, 59, 9, 10000, 50, 500000, '2020-01-30', '2020-01-31 02:54:04', '2020-01-31 02:54:04', NULL),
(319, 2, 59, 11, 2000, 56, 112000, '2020-01-30', '2020-01-31 02:54:04', '2020-01-31 02:54:04', NULL),
(320, 2, 59, 8, 10000, 10, 100000, '2020-01-30', '2020-01-31 02:54:04', '2020-01-31 02:54:04', NULL),
(321, 2, 59, 7, 700, 15, 10500, '2020-01-30', '2020-01-31 02:54:04', '2020-01-31 02:54:04', NULL),
(322, 2, 59, 5, 4000, 50, 200000, '2020-01-30', '2020-01-31 02:54:04', '2020-01-31 02:54:04', NULL),
(323, 2, 60, 21, 2000, 52, 104000, '2020-01-30', '2020-01-31 02:55:08', '2020-01-31 02:55:08', NULL),
(324, 2, 60, 20, 2000, 50, 100000, '2020-01-30', '2020-01-31 02:55:08', '2020-01-31 02:55:08', NULL),
(325, 2, 60, 19, 3000, 100, 300000, '2020-01-30', '2020-01-31 02:55:08', '2020-01-31 02:55:08', NULL),
(326, 2, 60, 18, 2000, 36, 72000, '2020-01-30', '2020-01-31 02:55:08', '2020-01-31 02:55:08', NULL),
(327, 2, 60, 16, 2500, 89, 222500, '2020-01-30', '2020-01-31 02:55:08', '2020-01-31 02:55:08', NULL),
(328, 2, 60, 13, 1500, 25, 37500, '2020-01-30', '2020-01-31 02:55:08', '2020-01-31 02:55:08', NULL),
(329, 2, 60, 10, 20000, 56, 1120000, '2020-01-30', '2020-01-31 02:55:08', '2020-01-31 02:55:08', NULL),
(330, 2, 60, 6, 1500, 60, 90000, '2020-01-30', '2020-01-31 02:55:08', '2020-01-31 02:55:08', NULL),
(331, 2, 61, 36, 150, 50, 7500, '2020-01-30', '2020-01-31 02:56:07', '2020-01-31 02:56:07', NULL),
(332, 2, 61, 35, 150, 50, 7500, '2020-01-30', '2020-01-31 02:56:07', '2020-01-31 02:56:07', NULL),
(333, 2, 61, 34, 500, 50, 25000, '2020-01-30', '2020-01-31 02:56:07', '2020-01-31 02:56:07', NULL),
(334, 2, 61, 33, 1000, 50, 50000, '2020-01-30', '2020-01-31 02:56:07', '2020-01-31 02:56:07', NULL),
(335, 2, 61, 32, 500, 50, 25000, '2020-01-30', '2020-01-31 02:56:07', '2020-01-31 02:56:07', NULL),
(336, 2, 61, 31, 1500, 50, 75000, '2020-01-30', '2020-01-31 02:56:07', '2020-01-31 02:56:07', NULL),
(337, 2, 61, 30, 1000, 50, 50000, '2020-01-30', '2020-01-31 02:56:07', '2020-01-31 02:56:07', NULL),
(338, 2, 61, 29, 1000, 50, 50000, '2020-01-30', '2020-01-31 02:56:07', '2020-01-31 02:56:07', NULL),
(339, 2, 61, 28, 1000, 50, 50000, '2020-01-30', '2020-01-31 02:56:07', '2020-01-31 02:56:07', NULL),
(340, 2, 61, 27, 500, 50, 25000, '2020-01-30', '2020-01-31 02:56:07', '2020-01-31 02:56:07', NULL),
(341, 2, 61, 26, 500, 40, 20000, '2020-01-30', '2020-01-31 02:56:07', '2020-01-31 02:56:07', NULL),
(342, 2, 62, 39, 40, 50, 2000, '2020-01-31', '2020-01-31 07:58:30', '2020-01-31 07:58:30', NULL),
(343, 2, 62, 38, 120, 50, 6000, '2020-01-31', '2020-01-31 07:58:30', '2020-01-31 07:58:30', NULL),
(344, 2, 62, 37, 100, 50, 5000, '2020-01-31', '2020-01-31 07:58:30', '2020-01-31 07:58:30', NULL),
(345, 2, 62, 24, 500, 50, 25000, '2020-01-31', '2020-01-31 07:58:30', '2020-01-31 07:58:30', NULL),
(346, 2, 62, 23, 1000, 50, 50000, '2020-01-31', '2020-01-31 07:58:30', '2020-01-31 07:58:30', NULL),
(347, 2, 63, 45, 40, 50, 2000, '2020-01-31', '2020-01-31 07:59:18', '2020-01-31 07:59:18', NULL),
(348, 2, 63, 44, 30, 44, 1320, '2020-01-31', '2020-01-31 07:59:18', '2020-01-31 07:59:18', NULL),
(349, 2, 63, 43, 45, 50, 2250, '2020-01-31', '2020-01-31 07:59:18', '2020-01-31 07:59:18', NULL),
(350, 1, 64, 10, 20000, 1, 20000, '2020-01-31', '2020-01-31 08:13:07', '2020-01-31 08:13:07', NULL),
(351, 1, 64, 8, 10000, 1, 10000, '2020-01-31', '2020-01-31 08:13:07', '2020-01-31 08:13:07', NULL),
(352, 1, 65, 38, 120, 0, 0, '2020-01-31', '2020-01-31 10:37:13', '2020-01-31 10:37:13', NULL),
(353, 1, 65, 7, 700, 0, 0, '2020-01-31', '2020-01-31 10:37:13', '2020-01-31 10:37:13', NULL),
(354, 1, 65, 8, 10000, 0, 0, '2020-01-31', '2020-01-31 10:37:13', '2020-01-31 10:37:13', NULL),
(355, 1, 65, 9, 10000, 0, 0, '2020-01-31', '2020-01-31 10:37:13', '2020-01-31 10:37:13', NULL),
(356, 1, 66, 1, 1000, 100, 100000, '2020-01-31', '2020-01-31 10:57:21', '2020-01-31 10:57:21', NULL),
(357, 1, 67, 9, 10000, 2, 20000, '2020-01-31', '2020-01-31 13:01:36', '2020-01-31 13:01:36', NULL),
(358, 1, 67, 2, 500, 1, 500, '2020-01-31', '2020-01-31 13:01:36', '2020-01-31 13:01:36', NULL),
(359, 1, 68, 31, 1500, 30, 45000, '2020-01-31', '2020-01-31 13:09:25', '2020-01-31 13:09:25', NULL),
(360, 1, 68, 38, 120, 20, 2400, '2020-01-31', '2020-01-31 13:09:25', '2020-01-31 13:09:25', NULL),
(361, 1, 68, 27, 500, 100, 50000, '2020-01-31', '2020-01-31 13:09:25', '2020-01-31 13:09:25', NULL),
(362, 1, 69, 35, 150, 1, 150, '2020-01-31', '2020-01-31 18:37:05', '2020-01-31 18:37:05', NULL),
(363, 1, 69, 42, 40, 1, 40, '2020-01-31', '2020-01-31 18:37:05', '2020-01-31 18:37:05', NULL),
(364, 1, 70, 13, 1500, 2, 3000, '2020-01-31', '2020-01-31 19:37:07', '2020-01-31 19:37:07', NULL),
(365, 1, 71, 1, 1000, 1, 1000, '2020-01-31', '2020-02-01 04:03:05', '2020-02-01 04:03:05', NULL),
(366, 1, 72, 2, 500, 1, 500, '2020-02-01', '2020-02-01 15:30:10', '2020-02-01 15:30:10', NULL),
(367, 1, 73, 2, 500, 1, 500, '2020-02-01', '2020-02-01 15:30:15', '2020-02-01 19:48:17', '2020-02-01 19:48:17'),
(368, 1, 73, 2, 500, 1, 500, '2020-02-01', '2020-02-01 19:48:17', '2020-02-01 19:48:25', '2020-02-01 19:48:25'),
(369, 1, 73, 2, 500, 1, 500, '2020-02-01', '2020-02-01 19:48:25', '2020-02-01 19:48:25', NULL),
(370, 1, 74, 8, 10000, 1, 10000, '2020-02-01', '2020-02-02 03:10:17', '2020-02-02 03:10:17', NULL),
(371, 1, 74, 7, 700, 1, 700, '2020-02-01', '2020-02-02 03:10:17', '2020-02-02 03:10:17', NULL),
(372, 1, 74, 2, 500, 1, 500, '2020-02-01', '2020-02-02 03:10:17', '2020-02-02 03:10:17', NULL),
(373, 1, 74, 1, 1000, 1, 1000, '2020-02-01', '2020-02-02 03:10:17', '2020-02-02 03:10:17', NULL),
(374, 1, 75, 1, 1000, 70, 70000, '2020-02-02', '2020-02-02 12:23:24', '2020-02-02 12:23:24', NULL),
(375, 1, 76, 1, 1000, 2, 2000, '2020-02-02', '2020-02-02 13:20:03', '2020-02-02 13:20:03', NULL),
(376, 1, 77, 3, 5000, 1, 5000, '2020-02-02', '2020-02-02 16:17:15', '2020-02-02 16:17:15', NULL),
(377, 1, 77, 2, 500, 2, 1000, '2020-02-02', '2020-02-02 16:17:15', '2020-02-02 16:17:15', NULL),
(378, 1, 78, 3, 5000, 1, 5000, '2020-02-02', '2020-02-02 16:17:19', '2020-02-02 16:17:19', NULL),
(379, 1, 78, 2, 500, 2, 1000, '2020-02-02', '2020-02-02 16:17:19', '2020-02-02 16:17:19', NULL),
(380, 1, 79, 3, 5000, 1, 5000, '2020-02-02', '2020-02-02 16:17:24', '2020-02-02 16:17:24', NULL),
(381, 1, 79, 2, 500, 2, 1000, '2020-02-02', '2020-02-02 16:17:25', '2020-02-02 16:17:25', NULL),
(382, 1, 80, 3, 5000, 1, 5000, '2020-02-02', '2020-02-02 16:17:25', '2020-02-02 16:17:25', NULL),
(383, 1, 80, 2, 500, 2, 1000, '2020-02-02', '2020-02-02 16:17:25', '2020-02-02 16:17:25', NULL),
(384, 1, 81, 3, 5000, 1, 5000, '2020-02-02', '2020-02-02 16:17:25', '2020-02-02 16:17:25', NULL),
(385, 1, 81, 2, 500, 2, 1000, '2020-02-02', '2020-02-02 16:17:25', '2020-02-02 16:17:25', NULL),
(386, 1, 82, 47, 2000, 10, 20000, '2020-02-02', '2020-02-02 21:04:28', '2020-02-02 21:04:28', NULL),
(387, 1, 83, 41, 95, 15, 1425, '2020-02-02', '2020-02-02 21:29:50', '2020-02-02 21:29:50', NULL),
(388, 1, 84, 5, 4000, 0, 0, '2020-02-03', '2020-02-03 10:53:32', '2020-02-03 10:53:32', NULL),
(389, 1, 84, 8, 10000, 0, 0, '2020-02-03', '2020-02-03 10:53:32', '2020-02-03 10:53:32', NULL),
(390, 1, 84, 9, 10000, 0, 0, '2020-02-03', '2020-02-03 10:53:32', '2020-02-03 10:53:32', NULL),
(391, 2, 85, 5, 4000, 100, 400000, '2020-02-03', '2020-02-03 11:59:58', '2020-02-03 11:59:58', NULL),
(392, 1, 86, 2, 500, 2, 1000, '2020-02-03', '2020-02-03 14:42:09', '2020-02-03 14:42:09', NULL),
(393, 1, 86, 1, 1000, 1, 1000, '2020-02-03', '2020-02-03 14:42:09', '2020-02-03 14:42:09', NULL),
(394, 1, 87, 10, 20000, 0, 0, '2020-02-03', '2020-02-03 21:43:17', '2020-02-03 21:43:17', NULL),
(395, 1, 87, 5, 4000, 0, 0, '2020-02-03', '2020-02-03 21:43:17', '2020-02-03 21:43:17', NULL),
(396, 1, 87, 9, 10000, 0, 0, '2020-02-03', '2020-02-03 21:43:17', '2020-02-03 21:43:17', NULL),
(397, 1, 88, 28, 1000, 2, 2000, '2020-02-03', '2020-02-04 01:50:50', '2020-02-04 01:50:50', NULL),
(398, 1, 89, 8, 10000, 50, 500000, '2020-02-04', '2020-02-04 20:52:58', '2020-02-04 20:52:58', NULL),
(399, 1, 90, 1, 1000, 0, 0, '2020-02-04', '2020-02-04 20:57:16', '2020-02-04 20:57:16', NULL),
(400, 1, 91, 17, 1000, 1, 1000, '2020-02-04', '2020-02-04 20:57:54', '2020-02-04 20:57:54', NULL),
(401, 1, 92, 13, 1500, 6, 9000, '2020-02-04', '2020-02-04 21:00:48', '2020-02-04 21:00:48', NULL),
(402, 1, 92, 2, 500, 2, 1000, '2020-02-04', '2020-02-04 21:00:48', '2020-02-04 21:00:48', NULL),
(403, 1, 92, 14, 500, 1, 500, '2020-02-04', '2020-02-04 21:00:48', '2020-02-04 21:00:48', NULL),
(404, 1, 93, 5, 4000, 19, 76000, '2020-02-04', '2020-02-05 01:22:20', '2020-02-05 01:22:20', NULL),
(405, 1, 94, 48, 100, 2, 200, '2020-02-05', '2020-02-05 16:50:15', '2020-02-05 16:50:15', NULL),
(406, 1, 95, 11, 2000, 10, 20000, '2020-02-05', '2020-02-05 10:13:45', '2020-02-05 10:13:45', NULL),
(407, 1, 95, 10, 20000, 10, 200000, '2020-02-05', '2020-02-05 10:13:45', '2020-02-05 10:13:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

CREATE TABLE `requisitions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requisition_id` varchar(191) NOT NULL,
  `requisition_from` int(11) NOT NULL,
  `requisition_to` int(11) NOT NULL,
  `requisition_date` date NOT NULL,
  `complete_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Send, 2=Received, 3=Canceled',
  `is_click` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `requisitions`
--

INSERT INTO `requisitions` (`id`, `requisition_id`, `requisition_from`, `requisition_to`, `requisition_date`, `complete_date`, `status`, `is_click`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'R-000001', 2, 1, '2019-12-25', '2019-12-25', 2, 0, 2, '2019-12-25 04:33:43', '2019-12-25 04:35:01'),
(2, 'R-000002', 1, 2, '2019-12-25', '2019-12-25', 2, 0, 1, '2019-12-25 04:48:19', '2019-12-25 04:56:29'),
(3, 'R-000003', 1, 2, '2019-12-25', NULL, 1, 0, 1, '2019-12-25 04:56:51', '2020-01-31 00:54:06'),
(4, 'R-000004', 3, 1, '2019-12-26', '2019-12-26', 2, 0, 3, '2019-12-26 03:06:33', '2019-12-26 03:06:59'),
(5, 'R-000005', 1, 3, '2019-12-26', NULL, 4, 0, 1, '2019-12-26 03:08:21', '2019-12-26 03:11:06'),
(6, 'R-000006', 1, 3, '2019-12-26', '2019-12-26', 2, 0, 1, '2019-12-26 03:08:22', '2019-12-26 03:09:36'),
(7, 'R-000007', 1, 2, '2019-12-26', NULL, 4, 0, 1, '2019-12-26 03:08:31', '2020-01-15 12:06:13'),
(8, 'R-000008', 1, 3, '2019-12-26', '2019-12-26', 2, 0, 1, '2019-12-26 03:10:37', '2019-12-26 03:10:59'),
(9, 'R-000009', 1, 3, '2019-12-26', NULL, 1, 0, 1, '2019-12-26 03:50:43', '2019-12-26 03:55:02'),
(10, 'R-000010', 1, 2, '2020-01-25', NULL, 1, 0, 1, '2020-01-25 14:03:21', '2020-01-25 14:08:09'),
(11, 'R-000011', 2, 1, '2020-01-30', NULL, 4, 0, 4, '2020-01-31 00:51:35', '2020-01-31 00:53:11'),
(12, 'R-000012', 2, 1, '2020-01-30', NULL, 1, 0, 4, '2020-01-31 02:02:00', '2020-01-31 14:55:29'),
(13, 'R-000013', 1, 2, '2020-01-31', NULL, 3, 0, 1, '2020-01-31 13:10:09', '2020-01-31 14:56:31'),
(14, 'R-000014', 1, 3, '2020-01-31', NULL, 0, 0, 1, '2020-01-31 14:15:39', '2020-01-31 14:15:39'),
(16, 'R-000015', 1, 3, '2020-02-01', NULL, 0, 0, 1, '2020-02-02 03:07:34', '2020-02-02 03:07:34'),
(17, 'R-000016', 1, 2, '2020-02-02', NULL, 0, 0, 1, '2020-02-02 16:41:31', '2020-02-02 16:41:31'),
(18, 'R-000017', 1, 2, '2020-02-02', NULL, 4, 0, 1, '2020-02-02 16:41:55', '2020-02-05 16:54:41'),
(19, 'R-000018', 2, 3, '2020-02-03', NULL, 1, 0, 4, '2020-02-03 11:56:56', '2020-02-05 16:54:18'),
(20, 'R-000019', 1, 2, '2020-02-03', NULL, 0, 0, 1, '2020-02-03 17:57:25', '2020-02-03 17:57:25'),
(21, 'R-000020', 1, 3, '2020-02-05', NULL, 0, 0, 1, '2020-02-05 21:10:04', '2020-02-05 21:10:04'),
(22, 'R-000021', 1, 2, '2020-02-05', NULL, 0, 0, 1, '2020-02-05 21:23:42', '2020-02-05 21:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `requisition_products`
--

CREATE TABLE `requisition_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requisition_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `requisition_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `requisition_products`
--

INSERT INTO `requisition_products` (`id`, `requisition_id`, `product_id`, `quantity`, `requisition_date`, `created_at`, `updated_at`) VALUES
(3, 1, 2, 25, '2019-12-25', '2019-12-25 04:34:11', '2019-12-25 04:34:11'),
(4, 1, 1, 20, '2019-12-25', '2019-12-25 04:34:11', '2019-12-25 04:34:11'),
(7, 2, 2, 1, '2019-12-25', '2019-12-25 04:48:29', '2019-12-25 04:48:29'),
(8, 2, 1, 1, '2019-12-25', '2019-12-25 04:48:29', '2019-12-25 04:48:29'),
(14, 4, 1, 20, '2019-12-26', '2019-12-26 03:06:47', '2019-12-26 03:06:47'),
(17, 7, 1, 110, '2019-12-26', '2019-12-26 03:08:31', '2019-12-26 03:08:31'),
(18, 6, 1, 10, '2019-12-26', '2019-12-26 03:09:25', '2019-12-26 03:09:25'),
(19, 5, 1, 410, '2019-12-26', '2019-12-26 03:10:08', '2019-12-26 03:10:08'),
(21, 8, 1, 4, '2019-12-26', '2019-12-26 03:10:48', '2019-12-26 03:10:48'),
(27, 9, 10, 10, '2019-12-26', '2019-12-26 03:55:02', '2019-12-26 03:55:02'),
(28, 9, 8, 1, '2019-12-26', '2019-12-26 03:55:02', '2019-12-26 03:55:02'),
(29, 9, 9, 15, '2019-12-26', '2019-12-26 03:55:03', '2019-12-26 03:55:03'),
(30, 9, 3, 1, '2019-12-26', '2019-12-26 03:55:03', '2019-12-26 03:55:03'),
(31, 9, 2, 1, '2019-12-26', '2019-12-26 03:55:03', '2019-12-26 03:55:03'),
(37, 10, 5, 1, '2020-01-25', '2020-01-25 14:08:09', '2020-01-25 14:08:09'),
(38, 10, 4, 1, '2020-01-25', '2020-01-25 14:08:09', '2020-01-25 14:08:09'),
(39, 10, 3, 1, '2020-01-25', '2020-01-25 14:08:09', '2020-01-25 14:08:09'),
(40, 10, 2, 1, '2020-01-25', '2020-01-25 14:08:09', '2020-01-25 14:08:09'),
(41, 10, 1, 1, '2020-01-25', '2020-01-25 14:08:09', '2020-01-25 14:08:09'),
(47, 11, 12, 2, '2020-01-30', '2020-01-31 00:51:35', '2020-01-31 00:51:35'),
(48, 11, 10, 3, '2020-01-30', '2020-01-31 00:51:35', '2020-01-31 00:51:35'),
(49, 11, 8, 4, '2020-01-30', '2020-01-31 00:51:35', '2020-01-31 00:51:35'),
(50, 11, 4, 3, '2020-01-30', '2020-01-31 00:51:35', '2020-01-31 00:51:35'),
(51, 3, 7, 1, '2019-12-25', '2020-01-31 00:54:06', '2020-01-31 00:54:06'),
(52, 3, 14, 1, '2019-12-25', '2020-01-31 00:54:06', '2020-01-31 00:54:06'),
(53, 3, 16, 1, '2019-12-25', '2020-01-31 00:54:06', '2020-01-31 00:54:06'),
(54, 3, 2, 1, '2019-12-25', '2020-01-31 00:54:06', '2020-01-31 00:54:06'),
(55, 3, 1, 1, '2019-12-25', '2020-01-31 00:54:06', '2020-01-31 00:54:06'),
(69, 12, 1, 1, '2020-01-30', '2020-01-31 14:55:29', '2020-01-31 14:55:29'),
(70, 12, 2, 1, '2020-01-30', '2020-01-31 14:55:29', '2020-01-31 14:55:29'),
(71, 12, 8, 2, '2020-01-30', '2020-01-31 14:55:29', '2020-01-31 14:55:29'),
(72, 13, 3, 1, '2020-01-31', '2020-01-31 14:55:45', '2020-01-31 14:55:45'),
(73, 13, 2, 1, '2020-01-31', '2020-01-31 14:55:45', '2020-01-31 14:55:45'),
(74, 13, 1, 1, '2020-01-31', '2020-01-31 14:55:45', '2020-01-31 14:55:45'),
(78, 14, 1, 1, '2020-01-31', '2020-02-01 04:04:43', '2020-02-01 04:04:43'),
(79, 14, 2, 1, '2020-01-31', '2020-02-01 04:04:43', '2020-02-01 04:04:43'),
(88, 16, 7, 1, '2020-02-01', '2020-02-02 03:11:35', '2020-02-02 03:11:35'),
(89, 16, 2, 1, '2020-02-01', '2020-02-02 03:11:35', '2020-02-02 03:11:35'),
(90, 16, 1, 1, '2020-02-01', '2020-02-02 03:11:35', '2020-02-02 03:11:35'),
(91, 17, 3, 1, '2020-02-02', '2020-02-02 16:41:31', '2020-02-02 16:41:31'),
(92, 17, 2, 1, '2020-02-02', '2020-02-02 16:41:31', '2020-02-02 16:41:31'),
(93, 17, 1, 1, '2020-02-02', '2020-02-02 16:41:31', '2020-02-02 16:41:31'),
(101, 18, 7, 1, '2020-02-02', '2020-02-03 11:56:42', '2020-02-03 11:56:42'),
(102, 18, 8, 1, '2020-02-02', '2020-02-03 11:56:42', '2020-02-03 11:56:42'),
(103, 18, 10, 1, '2020-02-02', '2020-02-03 11:56:42', '2020-02-03 11:56:42'),
(104, 18, 5, 1, '2020-02-02', '2020-02-03 11:56:42', '2020-02-03 11:56:42'),
(105, 18, 4, 1, '2020-02-02', '2020-02-03 11:56:42', '2020-02-03 11:56:42'),
(106, 18, 2, 1, '2020-02-02', '2020-02-03 11:56:42', '2020-02-03 11:56:42'),
(107, 18, 1, 1, '2020-02-02', '2020-02-03 11:56:42', '2020-02-03 11:56:42'),
(110, 20, 7, 15, '2020-02-03', '2020-02-03 18:03:01', '2020-02-03 18:03:01'),
(111, 20, 6, 1, '2020-02-03', '2020-02-03 18:03:01', '2020-02-03 18:03:01'),
(112, 20, 5, 9, '2020-02-03', '2020-02-03 18:03:01', '2020-02-03 18:03:01'),
(113, 20, 3, 11111, '2020-02-03', '2020-02-03 18:03:01', '2020-02-03 18:03:01'),
(114, 19, 2, 7, '2020-02-03', '2020-02-05 16:54:18', '2020-02-05 16:54:18'),
(115, 21, 2, 1, '2020-02-05', '2020-02-05 21:10:04', '2020-02-05 21:10:04'),
(116, 22, 17, 1, '2020-02-05', '2020-02-05 21:23:42', '2020-02-05 21:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2019-12-25 01:13:22', '2019-12-25 01:13:22'),
(2, 'Branch Manager', 'web', '2019-12-25 01:13:22', '2019-12-25 01:13:22'),
(3, 'Sell Executive', 'web', '2019-12-25 01:13:22', '2019-12-25 01:13:22'),
(4, 'Super Admin i', 'web', '2020-02-04 17:22:54', '2020-02-04 17:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ;

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
(15, 1),
(16, 1),
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
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(9, 3),
(19, 3),
(21, 3),
(26, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` varchar(191) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `sub_total` double NOT NULL,
  `discount` double NOT NULL DEFAULT '0',
  `grand_total_price` double NOT NULL,
  `paid_amount` double NOT NULL,
  `due_amount` double NOT NULL,
  `sell_date` date NOT NULL,
  `payment_type` tinyint(4) NOT NULL DEFAULT '1',
  `card_information` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `sells`
--

INSERT INTO `sells` (`id`, `invoice_id`, `customer_id`, `branch_id`, `created_by`, `sub_total`, `discount`, `grand_total_price`, `paid_amount`, `due_amount`, `sell_date`, `payment_type`, `card_information`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'S-000001', 1, 1, 1, 17920, 0, 17920, 17920, 0, '2019-09-22', 1, NULL, '2019-12-26 03:16:20', '2019-12-26 03:16:20', NULL),
(2, 'S-000002', 2, 1, 1, 40965, 0, 40965, 40965, 0, '2019-09-22', 1, NULL, '2019-12-26 03:16:35', '2019-12-26 03:16:35', NULL),
(3, 'S-000003', 1, 1, 1, 1890, 0, 1890, 1890, 0, '2019-09-22', 1, NULL, '2019-12-26 03:16:44', '2019-12-26 03:16:44', NULL),
(4, 'S-000004', 2, 1, 1, 18700, 0, 18700, 18700, 0, '2019-09-27', 1, NULL, '2019-12-26 03:16:58', '2019-12-26 03:16:58', NULL),
(5, 'S-000005', 1, 1, 1, 2625, 0, 2625, 2625, 0, '2019-09-27', 1, NULL, '2019-12-26 03:17:04', '2019-12-26 03:17:04', NULL),
(6, 'S-000006', 1, 1, 1, 2410, 0, 2410, 2410, 0, '2019-09-27', 1, NULL, '2019-12-26 03:17:10', '2019-12-26 03:17:10', NULL),
(7, 'S-000007', 1, 1, 1, 3450, 0, 3450, 3450, 0, '2019-10-02', 1, NULL, '2019-12-26 03:17:24', '2019-12-26 03:17:24', NULL),
(8, 'S-000008', 1, 1, 1, 9150, 0, 9150, 9150, 0, '2019-10-02', 1, NULL, '2019-12-26 03:17:30', '2019-12-26 03:17:30', NULL),
(9, 'S-000009', 1, 1, 1, 6920, 0, 6920, 6920, 0, '2019-10-02', 1, NULL, '2019-12-26 03:17:36', '2019-12-26 03:17:36', NULL),
(10, 'S-000010', 1, 1, 1, 1500, 0, 1500, 1500, 0, '2019-10-02', 1, NULL, '2019-12-26 03:17:43', '2019-12-26 03:17:43', NULL),
(11, 'S-000011', 1, 1, 1, 43150, 0, 43150, 43150, 0, '2019-10-07', 1, NULL, '2019-12-26 03:17:58', '2019-12-26 03:17:58', NULL),
(12, 'S-000012', 1, 1, 1, 13920, 0, 13920, 13920, 0, '2019-11-06', 1, NULL, '2019-12-26 03:18:17', '2019-12-26 03:18:17', NULL),
(13, 'S-000013', 1, 1, 1, 30800, 0, 30800, 30800, 0, '2019-11-06', 1, NULL, '2019-12-26 03:18:21', '2019-12-26 03:18:21', NULL),
(14, 'S-000014', 1, 1, 1, 8850, 0, 8850, 8850, 0, '2019-11-06', 1, NULL, '2019-12-26 03:18:29', '2019-12-26 03:18:29', NULL),
(15, 'S-000015', 1, 1, 1, 5920, 0, 5920, 5920, 0, '2019-11-06', 1, NULL, '2019-12-26 03:18:54', '2019-12-26 03:18:54', NULL),
(16, 'S-000016', 1, 1, 1, 39465, 0, 39465, 39465, 0, '2019-11-16', 1, NULL, '2019-12-26 03:19:07', '2019-12-26 03:19:07', NULL),
(17, 'S-000017', 1, 1, 1, 19520, 0, 19520, 19520, 0, '2019-11-16', 1, NULL, '2019-12-26 03:19:17', '2019-12-26 03:19:17', NULL),
(18, 'S-000018', 1, 1, 1, 4240, 0, 4240, 4240, 0, '2019-11-16', 1, NULL, '2019-12-26 03:19:24', '2019-12-26 03:19:24', NULL),
(19, 'S-000019', 1, 1, 1, 23020, 0, 23020, 23020, 0, '2019-11-21', 1, NULL, '2019-12-26 03:19:41', '2019-12-26 03:19:41', NULL),
(20, 'S-000020', 1, 1, 1, 49600, 0, 49600, 49600, 0, '2019-11-26', 1, NULL, '2019-12-26 03:20:06', '2019-12-26 03:20:06', NULL),
(21, 'S-000021', 1, 1, 1, 14020, 0, 14020, 14020, 0, '2019-11-28', 1, NULL, '2019-12-26 03:20:54', '2019-12-26 03:20:54', NULL),
(22, 'S-000022', 1, 1, 1, 14500, 0, 14500, 14500, 0, '2019-11-28', 1, NULL, '2019-12-26 03:21:06', '2019-12-26 03:21:06', NULL),
(23, 'S-000023', 1, 1, 1, 1500, 0, 1500, 1500, 0, '2019-11-28', 1, NULL, '2019-12-26 03:21:11', '2019-12-26 03:21:11', NULL),
(24, 'S-000024', 1, 1, 1, 840, 0, 840, 840, 0, '2019-11-28', 1, NULL, '2019-12-26 03:21:16', '2019-12-26 03:21:16', NULL),
(25, 'S-000025', 1, 1, 1, 41520, 0, 41520, 41520, 0, '2019-12-01', 1, NULL, '2019-12-26 03:21:40', '2019-12-26 03:21:40', NULL),
(26, 'S-000026', 1, 1, 1, 3340, 0, 3340, 3340, 0, '2019-12-01', 1, NULL, '2019-12-26 03:21:47', '2019-12-26 03:21:47', NULL),
(27, 'S-000027', 1, 1, 1, 3490, 0, 3490, 3490, 0, '2019-12-01', 1, NULL, '2019-12-26 03:21:54', '2019-12-26 03:21:54', NULL),
(28, 'S-000028', 1, 1, 1, 39100, 0, 39100, 39100, 0, '2019-12-01', 1, NULL, '2019-12-26 03:22:02', '2019-12-26 03:22:02', NULL),
(29, 'S-000029', 1, 1, 1, 59015, 0, 59015, 59015, 0, '2019-12-02', 1, NULL, '2019-12-26 03:22:17', '2019-12-26 03:22:17', NULL),
(30, 'S-000030', 1, 1, 1, 6600, 0, 6600, 6600, 0, '2019-12-02', 1, NULL, '2019-12-26 03:22:42', '2019-12-26 03:22:42', NULL),
(31, 'S-000031', 1, 1, 1, 12600, 0, 12600, 12600, 0, '2019-12-02', 1, NULL, '2019-12-26 03:23:34', '2019-12-26 03:23:34', NULL),
(32, 'S-000032', 1, 1, 1, 28615, 0, 28615, 28615, 0, '2019-12-04', 1, NULL, '2019-12-26 03:23:51', '2019-12-26 03:23:51', NULL),
(33, 'S-000033', 1, 1, 1, 5390, 90, 5300, 5300, 0, '2019-12-04', 1, NULL, '2019-12-26 03:24:07', '2019-12-26 03:24:07', NULL),
(34, 'S-000034', 1, 1, 1, 28100, 0, 28100, 28100, 0, '2019-12-04', 1, NULL, '2019-12-26 03:24:17', '2019-12-26 03:24:17', NULL),
(35, 'S-000035', 1, 1, 1, 39820, 820, 39000, 39000, 0, '2019-12-11', 1, NULL, '2019-12-26 03:24:56', '2019-12-26 03:24:56', NULL),
(36, 'S-000036', 1, 1, 1, 44950, 0, 44950, 44950, 0, '2019-12-11', 1, NULL, '2019-12-26 03:25:01', '2019-12-26 03:25:01', NULL),
(37, 'S-000037', 1, 1, 1, 23100, 0, 23100, 23100, 0, '2019-12-11', 1, NULL, '2019-12-26 03:25:07', '2019-12-26 03:25:07', NULL),
(38, 'S-000038', 1, 1, 1, 7200, 0, 7200, 7200, 0, '2019-12-16', 1, NULL, '2019-12-26 03:25:17', '2019-12-26 03:25:17', NULL),
(39, 'S-000039', 1, 1, 1, 17150, 0, 17150, 17150, 0, '2019-12-16', 1, NULL, '2019-12-26 03:25:47', '2019-12-26 03:25:47', NULL),
(40, 'S-000040', 1, 1, 1, 4400, 0, 4400, 4400, 0, '2019-12-16', 1, NULL, '2019-12-26 03:25:53', '2019-12-26 03:25:53', NULL),
(41, 'S-000041', 1, 1, 1, 33550, 0, 33550, 33550, 0, '2019-12-16', 1, NULL, '2019-12-26 03:26:03', '2019-12-26 03:26:03', NULL),
(42, 'S-000042', 1, 1, 1, 39620, 0, 39620, 39620, 0, '2019-12-19', 1, NULL, '2019-12-26 03:26:18', '2019-12-26 03:26:18', NULL),
(43, 'S-000043', 1, 1, 1, 63845, 0, 63845, 63845, 0, '2019-12-19', 1, NULL, '2019-12-26 03:26:32', '2019-12-26 03:26:32', NULL),
(44, 'S-000044', 1, 1, 1, 34020, 0, 34020, 34020, 0, '2019-12-19', 1, NULL, '2019-12-26 03:26:41', '2019-12-26 03:26:41', NULL),
(45, 'S-000045', 1, 1, 1, 93200, 0, 93200, 93200, 0, '2019-12-23', 1, NULL, '2019-12-26 03:27:09', '2019-12-26 03:27:09', NULL),
(46, 'S-000046', 1, 1, 1, 25080, 0, 25080, 25080, 0, '2019-12-26', 1, NULL, '2019-12-26 03:27:31', '2019-12-26 03:27:31', NULL),
(47, 'S-000047', 1, 1, 1, 7200, 0, 7200, 7200, 0, '2019-12-26', 1, NULL, '2019-12-26 10:15:40', '2020-01-31 09:24:12', NULL),
(48, 'S-000048', 1, 1, 1, 4650, 0, 4650, 4650, 0, '2019-12-26', 1, NULL, '2019-12-26 10:15:48', '2020-01-31 21:29:22', NULL),
(49, 'S-000049', 2, 1, 1, 1650, 0, 1650, 1650, 0, '2019-12-26', 1, NULL, '2019-12-26 10:15:58', '2020-02-02 14:19:27', NULL),
(50, 'S-000050', 1, 1, 1, 200, 0, 200, 100, 100, '2019-12-26', 1, NULL, '2019-12-26 10:16:19', '2019-12-26 10:16:19', NULL),
(51, 'S-000051', 2, 1, 1, 100, 0, 100, 50, 50, '2019-12-26', 1, NULL, '2019-12-26 10:16:29', '2019-12-26 10:16:29', NULL),
(52, 'S-000052', 1, 1, 1, 350, 0, 350, 350, 0, '2019-12-26', 1, NULL, '2019-12-26 10:16:43', '2020-02-01 01:37:31', NULL),
(53, 'S-000053', 1, 1, 1, 27500, 500, 27000, 27000, 0, '2019-12-26', 1, NULL, '2019-12-26 10:16:54', '2019-12-26 12:18:34', NULL),
(54, 'S-000054', 1, 3, 3, 56400, 0, 56400, 4400, 52000, '2019-12-26', 1, NULL, '2019-12-26 10:33:17', '2019-12-26 12:30:54', NULL),
(55, 'S-000055', 1, 2, 2, 2200, 0, 2200, 2200, 0, '2019-12-26', 1, NULL, '2019-12-26 10:34:37', '2019-12-26 10:34:37', NULL),
(56, 'S-000056', 1, 1, 1, 16000, 0, 16000, 16000, 0, '2019-12-26', 1, NULL, '2019-12-26 11:57:45', '2019-12-26 11:57:45', NULL),
(57, 'S-000057', 1, 1, 1, 12225, 0, 12225, 12225, 0, '2019-12-26', 1, NULL, '2019-12-26 11:59:04', '2019-12-26 11:59:04', NULL),
(58, 'S-000058', 1, 1, 1, 180, 0, 180, 180, 0, '2019-12-27', 1, NULL, '2019-12-26 12:31:42', '2019-12-26 12:32:01', NULL),
(59, 'S-000059', 1, 1, 1, 51320, 0, 51320, 51320, 0, '2020-01-10', 1, NULL, '2020-01-10 03:47:21', '2020-01-10 03:47:21', NULL),
(60, 'S-000060', 1, 1, 1, 32920, 0, 32920, 32920, 0, '2020-01-10', 2, NULL, '2020-01-10 04:48:02', '2020-01-10 04:48:02', NULL),
(61, 'S-000061', 1, 1, 1, 38200, 0, 38200, 38200, 0, '2020-01-24', 1, NULL, '2020-01-24 13:41:55', '2020-01-24 13:41:55', NULL),
(62, 'S-000062', 1, 1, 1, 4150, 0, 4150, 4150, 0, '2020-01-25', 1, NULL, '2020-01-24 19:45:01', '2020-01-24 19:45:01', NULL),
(63, 'S-000063', 3, 1, 1, 6320, 0, 6320, 6320, 0, '2019-12-30', 1, NULL, '2020-01-24 13:48:58', '2020-01-24 13:48:58', NULL),
(64, 'S-000064', 1, 1, 1, 121000, 0, 121000, 121000, 0, '2019-12-30', 1, NULL, '2020-01-24 13:49:16', '2020-01-24 13:49:16', NULL),
(65, 'S-000065', 1, 1, 1, 87000, 0, 87000, 87000, 0, '2019-12-31', 1, NULL, '2020-01-24 13:49:54', '2020-01-24 13:49:54', NULL),
(66, 'S-000066', 1, 1, 1, 85000, 0, 85000, 85000, 0, '2020-01-01', 1, NULL, '2020-01-24 13:50:19', '2020-01-24 13:50:19', NULL),
(67, 'S-000067', 1, 1, 1, 126000, 0, 126000, 126000, 0, '2020-01-02', 1, NULL, '2020-01-24 13:50:39', '2020-01-24 13:50:39', NULL),
(68, 'S-000068', 1, 1, 1, 50000, 0, 50000, 50000, 0, '2020-01-02', 1, NULL, '2020-01-24 13:51:03', '2020-01-24 13:51:03', NULL),
(69, 'S-000069', 1, 1, 1, 150000, 0, 150000, 150000, 0, '2020-01-06', 1, NULL, '2020-01-24 13:51:27', '2020-01-24 13:51:27', NULL),
(70, 'S-000070', 1, 1, 1, 150000, 0, 150000, 150000, 0, '2020-01-14', 1, NULL, '2020-01-24 13:51:52', '2020-01-24 13:51:52', NULL),
(71, 'S-000071', 1, 1, 1, 100500, 0, 100500, 100500, 0, '2020-01-20', 1, NULL, '2020-01-24 13:52:25', '2020-01-24 13:52:25', NULL),
(72, 'S-000072', 1, 1, 1, 120000, 0, 120000, 120000, 0, '2020-01-24', 1, NULL, '2020-01-24 13:52:57', '2020-01-24 13:52:57', NULL),
(73, 'S-000073', 1, 1, 1, 14200, 0, 14200, 14200, 0, '2020-01-27', 1, NULL, '2020-01-26 19:12:57', '2020-01-26 19:12:57', NULL),
(74, 'S-000074', 1, 1, 1, 16200, 0, 16200, 16200, 0, '2020-01-26', 1, NULL, '2020-01-26 04:14:05', '2020-01-26 04:14:05', NULL),
(75, 'S-000075', 1, 1, 1, 11600, 0, 11600, 11600, 0, '2020-01-29', 1, NULL, '2020-01-29 12:14:36', '2020-01-29 12:14:36', NULL),
(76, 'S-000076', 1, 1, 1, 10000, 0, 10000, 10000, 0, '2020-01-30', 2, NULL, '2020-01-30 22:55:22', '2020-01-30 22:55:22', NULL),
(77, 'S-000077', 2, 2, 4, 3240, 0, 3240, 3240, 0, '2020-01-30', 1, NULL, '2020-01-31 00:45:05', '2020-01-31 00:45:05', NULL),
(78, 'S-000078', 1, 1, 1, 45750, 0, 45750, 45750, 0, '2020-01-30', 1, NULL, '2020-01-31 00:59:48', '2020-01-31 00:59:48', NULL),
(79, 'S-000079', 1, 2, 2, 1920, 0, 1920, 1920, 0, '2020-01-30', 1, NULL, '2020-01-31 01:32:50', '2020-01-31 01:32:50', NULL),
(80, 'S-000080', 1, 1, 1, 8520, 0, 8520, 8520, 0, '2020-01-30', 1, NULL, '2020-01-31 02:12:22', '2020-01-31 02:12:22', NULL),
(81, 'S-000081', 1, 2, 2, 11600, 0, 11600, 11600, 0, '2020-01-31', 1, NULL, '2020-01-31 07:59:46', '2020-01-31 07:59:46', NULL),
(82, 'S-000082', 1, 2, 4, 49200, 0, 49200, 5000, 44200, '2020-01-31', 1, NULL, '2020-01-31 08:01:42', '2020-01-31 08:01:42', NULL),
(83, 'S-000083', 1, 2, 4, 121425, 0, 121425, 600, 120825, '2020-01-31', 1, NULL, '2020-01-31 08:01:56', '2020-01-31 10:23:36', NULL),
(84, 'S-000084', 3, 1, 1, 36630, 0, 36630, 1000, 35630, '2020-01-31', 2, NULL, '2020-01-31 10:48:53', '2020-01-31 10:48:53', NULL),
(85, 'S-000085', 1, 2, 4, 86740, 0, 86740, 86740, 0, '2020-01-31', 1, NULL, '2020-01-31 10:59:20', '2020-01-31 10:59:20', NULL),
(86, 'S-000086', 2, 2, 4, 7060, 0, 7060, 7060, 0, '2020-01-31', 1, NULL, '2020-01-31 12:06:55', '2020-01-31 12:06:55', NULL),
(87, 'S-000087', 1, 1, 1, 17600, 600, 17000, 12000, 5000, '2020-01-31', 1, NULL, '2020-01-31 13:08:35', '2020-01-31 13:08:35', NULL),
(88, 'S-000088', 2, 2, 4, 24200, 0, 24200, 24200, 0, '2020-01-31', 2, NULL, '2020-01-31 13:41:54', '2020-01-31 13:41:54', NULL),
(89, 'S-000089', 7, 1, 1, 13520, 0, 13520, 13520, 0, '2020-01-31', 1, NULL, '2020-01-31 14:10:39', '2020-01-31 14:10:39', NULL),
(90, 'S-000090', 3, 1, 1, 7200, 0, 7200, 7200, 0, '2020-01-31', 1, NULL, '2020-01-31 14:11:13', '2020-01-31 14:11:13', NULL),
(91, 'S-000091', 1, 1, 1, 1820, 1, 1819, 1819, 0, '2020-01-31', 2, NULL, '2020-01-31 14:27:19', '2020-01-31 14:27:19', NULL),
(92, 'S-000092', 1, 1, 1, 44800, 44800, 0, 0, 0, '2020-01-31', 1, NULL, '2020-01-31 15:07:23', '2020-02-01 04:04:29', NULL),
(93, 'S-000093', 1, 2, 4, 5050, 0, 5050, 5050, 0, '2020-01-31', 1, NULL, '2020-01-31 16:10:57', '2020-01-31 16:10:57', NULL),
(94, 'S-000094', 1, 1, 1, 46170, 70, 46100, 46100, 0, '2020-01-31', 1, NULL, '2020-01-31 21:23:49', '2020-01-31 21:23:49', NULL),
(95, 'S-000095', 3, 1, 1, 600, 0, 600, 600, 0, '2020-02-01', 1, NULL, '2020-02-01 08:14:27', '2020-02-01 08:14:27', NULL),
(96, 'S-000096', 1, 1, 1, 300, 0, 300, 300, 0, '2020-02-01', 1, NULL, '2020-02-01 11:29:37', '2020-02-01 14:09:32', NULL),
(97, 'S-000097', 1, 1, 1, 15300, 0, 15300, 15300, 0, '2020-02-01', 1, NULL, '2020-02-01 15:32:10', '2020-02-01 15:32:10', NULL),
(98, 'S-000098', 2, 1, 1, 33250, 0, 33250, 28600, 4650, '2020-02-01', 1, NULL, '2020-02-01 16:46:48', '2020-02-01 17:57:58', NULL),
(99, 'S-000099', 3, 2, 4, 8520, 0, 8520, 8520, 0, '2020-02-01', 1, NULL, '2020-02-01 18:14:13', '2020-02-01 18:14:13', NULL),
(100, 'S-000100', 1, 1, 1, 39600, 0, 39600, 39600, 0, '2020-02-01', 1, NULL, '2020-02-01 20:39:48', '2020-02-01 20:39:48', NULL),
(101, 'S-000101', 5, 1, 1, 2500, 0, 2500, 2500, 0, '2020-02-01', 2, NULL, '2020-02-01 22:49:46', '2020-02-01 22:49:46', NULL),
(102, 'S-000102', 1, 1, 1, 15120, 0, 15120, 15120, 0, '2020-02-01', 1, NULL, '2020-02-01 23:25:17', '2020-02-01 23:25:17', NULL),
(103, 'S-000103', 2, 1, 1, 16350, 0, 16350, 16350, 0, '2020-02-01', 2, NULL, '2020-02-01 23:49:27', '2020-02-01 23:49:27', NULL),
(104, 'S-000104', 1, 1, 1, 39000, 0, 39000, 39000, 0, '2020-02-01', 1, NULL, '2020-02-02 01:41:41', '2020-02-02 01:41:41', NULL),
(105, 'S-000105', 1, 1, 1, 2000, 0, 2000, 2000, 0, '2020-02-01', 1, NULL, '2020-02-02 03:05:00', '2020-02-02 03:06:14', NULL),
(106, 'S-000106', 5, 1, 1, 9325, 0, 9325, 9325, 0, '2020-02-01', 1, NULL, '2020-02-02 03:16:09', '2020-02-02 03:16:09', NULL),
(107, 'S-000107', 5, 1, 1, 9325, 0, 9325, 9325, 0, '2020-02-01', 1, NULL, '2020-02-02 03:16:09', '2020-02-02 03:16:09', NULL),
(108, 'S-000108', 1, 1, 1, 51700, 0, 51700, 51700, 0, '2020-02-02', 2, '68768769876987', '2020-02-02 09:10:46', '2020-02-02 09:10:46', NULL),
(109, 'S-000109', 2, 1, 1, 7500, 0, 7500, 7500, 0, '2020-02-02', 1, NULL, '2020-02-02 12:20:55', '2020-02-02 12:20:55', NULL),
(110, 'S-000110', 1, 1, 1, 7200, 0, 7200, 7200, 0, '2020-02-02', 1, NULL, '2020-02-02 12:21:49', '2020-02-02 12:21:49', NULL),
(111, 'S-000111', 1, 1, 1, 1200, 0, 1200, 1200, 0, '2020-02-02', 1, NULL, '2020-02-02 12:54:44', '2020-02-02 12:54:44', NULL),
(112, 'S-000112', 2, 1, 1, 18100, 0, 18100, 18100, 0, '2020-02-02', 2, '0', '2020-02-02 16:13:05', '2020-02-02 16:13:05', NULL),
(113, 'S-000113', 8, 1, 1, 42350, 0, 42350, 42350, 0, '2020-02-02', 2, 'Late', '2020-02-02 16:14:20', '2020-02-02 16:14:20', NULL),
(114, 'S-000114', 1, 1, 1, 121460, 0, 121460, 121460, 0, '2020-02-02', 1, NULL, '2020-02-02 20:12:49', '2020-02-02 20:12:49', NULL),
(115, 'S-000115', 1, 1, 1, 2440, 0, 2440, 2440, 0, '2020-02-02', 1, NULL, '2020-02-02 21:04:51', '2020-02-02 21:04:51', NULL),
(116, 'S-000116', 4, 1, 1, 19670, 0, 19670, 19670, 0, '2020-02-02', 2, NULL, '2020-02-02 21:32:54', '2020-02-02 21:32:54', NULL),
(117, 'S-000117', 1, 1, 1, 28520, 0, 28520, 28520, 0, '2020-02-02', 1, NULL, '2020-02-02 22:03:20', '2020-02-02 22:03:20', NULL),
(118, 'S-000118', 1, 1, 1, 28520, 0, 28520, 28520, 0, '2020-02-02', 1, NULL, '2020-02-02 22:03:20', '2020-02-02 22:03:20', NULL),
(119, 'S-000119', 6, 1, 1, 1320, 0, 1320, 1320, 0, '2020-02-02', 1, NULL, '2020-02-02 22:55:47', '2020-02-02 22:55:47', NULL),
(120, 'S-000120', 1, 1, 1, 1320, 0, 1320, 1320, 0, '2020-02-02', 1, NULL, '2020-02-02 23:55:32', '2020-02-02 23:55:32', NULL),
(121, 'S-000121', 3, 2, 4, 1320, 0, 1320, 1320, 0, '2020-02-02', 1, NULL, '2020-02-02 23:56:31', '2020-02-02 23:56:31', NULL),
(122, 'S-000122', 1, 1, 1, 1320, 0, 1320, 1320, 0, '2020-02-03', 1, NULL, '2020-02-03 07:09:22', '2020-02-03 07:09:22', NULL),
(123, 'S-000123', 1, 2, 4, 21175, 175, 21000, 21000, 0, '2020-02-03', 1, NULL, '2020-02-03 11:54:18', '2020-02-03 11:54:18', NULL),
(124, 'S-000124', 2, 1, 1, 25300, 0, 25300, 25300, 0, '2020-02-03', 1, NULL, '2020-02-03 14:43:13', '2020-02-03 14:43:13', NULL),
(125, 'S-000125', 2, 1, 1, 25300, 0, 25300, 25300, 0, '2020-02-03', 1, NULL, '2020-02-03 14:43:14', '2020-02-03 14:43:14', NULL),
(126, 'S-000126', 2, 1, 1, 25300, 0, 25300, 25300, 0, '2020-02-03', 1, NULL, '2020-02-03 14:43:14', '2020-02-03 14:43:14', NULL),
(127, 'S-000127', 4, 1, 1, 15100, 0, 15100, 15100, 0, '2020-02-03', 1, NULL, '2020-02-03 14:47:25', '2020-02-03 14:47:25', NULL),
(128, 'S-000128', 4, 1, 1, 15100, 0, 15100, 15100, 0, '2020-02-03', 1, NULL, '2020-02-03 14:47:31', '2020-02-03 14:47:31', NULL),
(129, 'S-000129', 4, 1, 1, 15100, 0, 15100, 15100, 0, '2020-02-03', 1, NULL, '2020-02-03 14:47:44', '2020-02-03 14:47:44', NULL),
(130, 'S-000130', 4, 1, 1, 15100, 0, 15100, 15100, 0, '2020-02-03', 1, NULL, '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(131, 'S-000131', 4, 1, 1, 15100, 0, 15100, 15100, 0, '2020-02-03', 1, NULL, '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(132, 'S-000132', 4, 1, 1, 15100, 0, 15100, 15100, 0, '2020-02-03', 1, NULL, '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(133, 'S-000133', 4, 1, 1, 15100, 0, 15100, 15100, 0, '2020-02-03', 1, NULL, '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(134, 'S-000134', 4, 1, 1, 15100, 0, 15100, 15100, 0, '2020-02-03', 1, NULL, '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(135, 'S-000135', 4, 1, 1, 15100, 0, 15100, 15100, 0, '2020-02-03', 1, NULL, '2020-02-03 14:47:46', '2020-02-03 14:47:46', NULL),
(136, 'S-000136', 1, 1, 1, 10920, 0, 10920, 10920, 0, '2020-02-03', 2, NULL, '2020-02-04 01:18:58', '2020-02-04 01:18:58', NULL),
(137, 'S-000137', 1, 1, 1, 16200, 0, 16200, 16200, 0, '2020-02-03', 1, NULL, '2020-02-04 03:27:15', '2020-02-04 03:27:15', NULL),
(138, 'S-000138', 4, 1, 1, 54000, 0, 54000, 54000, 0, '2020-02-03', 1, NULL, '2020-02-04 04:24:11', '2020-02-04 04:24:11', NULL),
(139, 'S-000139', 1, 1, 1, 8600, 0, 8600, 8600, 0, '2020-02-04', 1, NULL, '2020-02-04 05:57:48', '2020-02-04 05:57:48', NULL),
(140, 'S-000140', 1, 1, 1, 10600, 0, 10600, 10600, 0, '2020-02-04', 1, NULL, '2020-02-04 17:18:03', '2020-02-04 17:18:03', NULL),
(141, 'S-000141', 1, 1, 1, 181945, 0, 181945, 181945, 0, '2020-02-04', 1, NULL, '2020-02-04 19:24:08', '2020-02-04 19:24:08', NULL),
(142, 'S-000142', 1, 2, 2, 39520, 234, 39286, 39286, 0, '2020-02-04', 1, NULL, '2020-02-04 20:31:05', '2020-02-04 20:31:05', NULL),
(143, 'S-000143', 1, 1, 1, 600, 36, 564, 564, 0, '2020-02-04', 1, NULL, '2020-02-04 21:56:22', '2020-02-04 21:56:22', NULL),
(144, 'S-000144', 1, 1, 1, 17560, 0, 17560, 17560, 0, '2020-02-04', 1, NULL, '2020-02-05 00:10:04', '2020-02-05 00:10:04', NULL),
(145, 'S-000145', 1, 1, 1, 1800, 0, 1800, 1800, 0, '2020-02-04', 1, NULL, '2020-02-05 01:54:13', '2020-02-05 01:54:13', NULL),
(146, 'S-000146', 1, 1, 1, 1800, 0, 1800, 1800, 0, '2020-02-04', 1, NULL, '2020-02-05 01:54:18', '2020-02-05 01:54:18', NULL),
(147, 'S-000147', 1, 2, 4, 5175, 5, 5170, 5170, 0, '2020-02-04', 1, NULL, '2020-02-05 03:47:37', '2020-02-05 03:47:37', NULL),
(148, 'S-000148', 1, 1, 1, 9600, 0, 9600, 9600, 0, '2020-02-05', 1, NULL, '2020-02-05 05:52:06', '2020-02-05 05:52:06', NULL),
(149, 'S-000149', 1, 1, 1, 43570, 0, 43570, 43570, 0, '2020-02-05', 1, NULL, '2020-02-05 13:54:40', '2020-02-05 13:54:40', NULL),
(150, 'S-000150', 1, 2, 4, 3840, 0, 3840, 3840, 0, '2020-02-05', 1, NULL, '2020-02-05 15:23:37', '2020-02-05 15:23:37', NULL),
(151, 'S-000151', 1, 1, 1, 600, 200, 400, 400, 0, '2020-02-05', 1, NULL, '2020-02-05 16:52:23', '2020-02-05 16:52:23', NULL),
(152, 'S-000152', 9, 1, 1, 1088, 0, 1088, 1088, 0, '2020-02-05', 1, NULL, '2020-02-05 17:51:01', '2020-02-05 17:51:01', NULL),
(153, 'S-000153', 1, 1, 1, 13200, 0, 13200, 13200, 0, '2020-02-05', 1, NULL, '2020-02-05 21:56:28', '2020-02-05 21:56:28', NULL),
(154, 'S-000154', 2, 1, 1, 1260, 100, 1160, 1160, 0, '2020-02-05', 1, NULL, '2020-02-05 22:18:52', '2020-02-05 22:18:52', NULL),
(155, 'S-000155', 1, 1, 1, 11600, 0, 11600, 11600, 0, '2020-02-05', 1, NULL, '2020-02-05 10:13:01', '2020-02-05 10:13:01', NULL),
(156, 'S-000156', 1, 1, 1, 10200, 0, 10200, 10200, 0, '2020-02-09', 1, NULL, '2020-02-09 13:28:05', '2020-02-09 13:28:05', NULL),
(157, 'S-000157', 1, 1, 1, 7200, 0, 7200, 7200, 0, '2020-02-13', 1, NULL, '2020-02-13 14:14:52', '2020-02-13 14:14:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sells_targets`
--

CREATE TABLE `sells_targets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `month` varchar(191) NOT NULL,
  `target_amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `sells_targets`
--

INSERT INTO `sells_targets` (`id`, `branch_id`, `month`, `target_amount`, `created_at`, `updated_at`) VALUES
(15, 1, '2019-10', 100000, '2019-12-26 10:30:27', '2019-12-26 10:30:27'),
(16, 2, '2019-10', 50000, '2019-12-26 10:30:27', '2019-12-26 10:30:27'),
(17, 3, '2019-10', 50000, '2019-12-26 10:30:27', '2019-12-26 10:30:27'),
(18, 1, '2019-11', 500000, '2019-12-26 10:30:49', '2019-12-26 10:30:49'),
(19, 2, '2019-11', 15000, '2019-12-26 10:30:50', '2019-12-26 10:30:50'),
(20, 3, '2019-11', 20000, '2019-12-26 10:30:50', '2019-12-26 10:30:50'),
(69, 1, '2019-12', 1000000, '2020-01-25 14:19:50', '2020-01-25 14:19:50'),
(70, 2, '2019-12', 11000, '2020-01-25 14:19:50', '2020-01-25 14:19:50'),
(71, 3, '2019-12', 500000, '2020-01-25 14:19:50', '2020-01-25 14:19:50'),
(72, 1, '2020-01', 3000000, '2020-01-31 02:50:47', '2020-01-31 02:50:47'),
(73, 2, '2020-01', 1000000, '2020-01-31 02:50:47', '2020-01-31 02:50:47'),
(74, 3, '2020-01', 10000000, '2020-01-31 02:50:47', '2020-01-31 02:50:47'),
(88, 1, '2020-02', 3000000, '2020-02-04 15:29:23', '2020-02-04 15:29:23'),
(89, 2, '2020-02', 1000000, '2020-02-04 15:29:23', '2020-02-04 15:29:23'),
(90, 3, '2020-02', 100000, '2020-02-04 15:29:23', '2020-02-04 15:29:23'),
(91, 4, '2020-02', 100000, '2020-02-04 15:29:23', '2020-02-04 15:29:23');

-- --------------------------------------------------------

--
-- Table structure for table `sell_products`
--

CREATE TABLE `sell_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `sell_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_price` double NOT NULL,
  `sell_price` double NOT NULL,
  `tax_percentage` double NOT NULL,
  `tax_amount` double NOT NULL,
  `quantity` double NOT NULL,
  `total_price` double NOT NULL,
  `sell_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `sell_products`
--

INSERT INTO `sell_products` (`id`, `branch_id`, `sell_id`, `product_id`, `purchase_price`, `sell_price`, `tax_percentage`, `tax_amount`, `quantity`, `total_price`, `sell_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 4, 4000, 5000, 0, 0, 1, 5000, '2019-09-22', '2019-12-26 03:16:21', '2019-12-26 03:16:21', NULL),
(2, 1, 1, 9, 10000, 11000, 0, 0, 1, 11000, '2019-09-22', '2019-12-26 03:16:21', '2019-12-26 03:16:21', NULL),
(3, 1, 1, 2, 500, 600, 0, 0, 1, 600, '2019-09-22', '2019-12-26 03:16:21', '2019-12-26 03:16:21', NULL),
(4, 1, 1, 1, 1000, 1200, 10, 120, 1, 1320, '2019-09-22', '2019-12-26 03:16:21', '2019-12-26 03:16:21', NULL),
(5, 1, 2, 26, 500, 800, 5, 40, 1, 840, '2019-09-22', '2019-12-26 03:16:35', '2019-12-26 03:16:35', NULL),
(6, 1, 2, 27, 500, 1000, 5, 50, 1, 1050, '2019-09-22', '2019-12-26 03:16:35', '2019-12-26 03:16:35', NULL),
(7, 1, 2, 28, 1000, 1500, 5, 75, 1, 1575, '2019-09-22', '2019-12-26 03:16:35', '2019-12-26 03:16:35', NULL),
(8, 1, 2, 17, 1000, 1500, 0, 0, 1, 1500, '2019-09-22', '2019-12-26 03:16:35', '2019-12-26 03:16:35', NULL),
(9, 1, 2, 10, 20000, 25000, 0, 0, 1, 25000, '2019-09-22', '2019-12-26 03:16:35', '2019-12-26 03:16:35', NULL),
(10, 1, 2, 9, 10000, 11000, 0, 0, 1, 11000, '2019-09-22', '2019-12-26 03:16:35', '2019-12-26 03:16:35', NULL),
(11, 1, 3, 27, 500, 1000, 5, 50, 1, 1050, '2019-09-22', '2019-12-26 03:16:44', '2019-12-26 03:16:44', NULL),
(12, 1, 3, 26, 500, 800, 5, 40, 1, 840, '2019-09-22', '2019-12-26 03:16:44', '2019-12-26 03:16:44', NULL),
(13, 1, 4, 7, 700, 500, 0, 0, 1, 500, '2019-09-27', '2019-12-26 03:16:59', '2019-12-26 03:16:59', NULL),
(14, 1, 4, 9, 10000, 11000, 0, 0, 1, 11000, '2019-09-27', '2019-12-26 03:16:59', '2019-12-26 03:16:59', NULL),
(15, 1, 4, 3, 5000, 6000, 10, 600, 1, 6600, '2019-09-27', '2019-12-26 03:16:59', '2019-12-26 03:16:59', NULL),
(16, 1, 4, 2, 500, 600, 0, 0, 1, 600, '2019-09-27', '2019-12-26 03:16:59', '2019-12-26 03:16:59', NULL),
(17, 1, 5, 28, 1000, 1500, 5, 75, 1, 1575, '2019-09-27', '2019-12-26 03:17:04', '2019-12-26 03:17:04', NULL),
(18, 1, 5, 27, 500, 1000, 5, 50, 1, 1050, '2019-09-27', '2019-12-26 03:17:04', '2019-12-26 03:17:04', NULL),
(19, 1, 6, 38, 120, 150, 0, 0, 1, 150, '2019-09-27', '2019-12-26 03:17:10', '2019-12-26 03:17:10', NULL),
(20, 1, 6, 33, 1000, 1200, 5, 60, 1, 1260, '2019-09-27', '2019-12-26 03:17:10', '2019-12-26 03:17:10', NULL),
(21, 1, 6, 14, 500, 1000, 0, 0, 1, 1000, '2019-09-27', '2019-12-26 03:17:10', '2019-12-26 03:17:10', NULL),
(22, 1, 7, 38, 120, 150, 0, 0, 1, 150, '2019-10-02', '2019-12-26 03:17:24', '2019-12-26 03:17:24', NULL),
(23, 1, 7, 43, 45, 50, 0, 0, 1, 50, '2019-10-02', '2019-12-26 03:17:24', '2019-12-26 03:17:24', NULL),
(24, 1, 7, 44, 30, 40, 0, 0, 1, 40, '2019-10-02', '2019-12-26 03:17:24', '2019-12-26 03:17:24', NULL),
(25, 1, 7, 45, 40, 60, 0, 0, 1, 60, '2019-10-02', '2019-12-26 03:17:24', '2019-12-26 03:17:24', NULL),
(26, 1, 7, 21, 2000, 3000, 5, 150, 1, 3150, '2019-10-02', '2019-12-26 03:17:24', '2019-12-26 03:17:24', NULL),
(27, 1, 8, 15, 2000, 3000, 0, 0, 1, 3000, '2019-10-02', '2019-12-26 03:17:30', '2019-12-26 03:17:30', NULL),
(28, 1, 8, 16, 2500, 3000, 5, 150, 1, 3150, '2019-10-02', '2019-12-26 03:17:31', '2019-12-26 03:17:31', NULL),
(29, 1, 8, 17, 1000, 1500, 0, 0, 2, 3000, '2019-10-02', '2019-12-26 03:17:31', '2019-12-26 03:17:31', NULL),
(30, 1, 9, 1, 1000, 1200, 10, 120, 1, 1320, '2019-10-02', '2019-12-26 03:17:36', '2019-12-26 03:17:36', NULL),
(31, 1, 9, 2, 500, 600, 0, 0, 1, 600, '2019-10-02', '2019-12-26 03:17:36', '2019-12-26 03:17:36', NULL),
(32, 1, 9, 4, 4000, 5000, 0, 0, 1, 5000, '2019-10-02', '2019-12-26 03:17:37', '2019-12-26 03:17:37', NULL),
(33, 1, 10, 29, 1000, 1500, 0, 0, 1, 1500, '2019-10-02', '2019-12-26 03:17:43', '2019-12-26 03:17:43', NULL),
(34, 1, 11, 14, 500, 1000, 0, 0, 1, 1000, '2019-10-07', '2019-12-26 03:17:58', '2019-12-26 03:17:58', NULL),
(35, 1, 11, 15, 2000, 3000, 0, 0, 1, 3000, '2019-10-07', '2019-12-26 03:17:58', '2019-12-26 03:17:58', NULL),
(36, 1, 11, 16, 2500, 3000, 5, 150, 1, 3150, '2019-10-07', '2019-12-26 03:17:58', '2019-12-26 03:17:58', NULL),
(37, 1, 11, 10, 20000, 25000, 0, 0, 1, 25000, '2019-10-07', '2019-12-26 03:17:58', '2019-12-26 03:17:58', NULL),
(38, 1, 11, 9, 10000, 11000, 0, 0, 1, 11000, '2019-10-07', '2019-12-26 03:17:58', '2019-12-26 03:17:58', NULL),
(39, 1, 12, 2, 500, 600, 0, 0, 1, 600, '2019-11-06', '2019-12-26 03:18:17', '2019-12-26 03:18:17', NULL),
(40, 1, 12, 1, 1000, 1200, 10, 120, 1, 1320, '2019-11-06', '2019-12-26 03:18:17', '2019-12-26 03:18:17', NULL),
(41, 1, 12, 7, 700, 500, 0, 0, 2, 1000, '2019-11-06', '2019-12-26 03:18:17', '2019-12-26 03:18:17', NULL),
(42, 1, 12, 9, 10000, 11000, 0, 0, 1, 11000, '2019-11-06', '2019-12-26 03:18:17', '2019-12-26 03:18:17', NULL),
(43, 1, 13, 8, 10000, 12000, 10, 1200, 1, 13200, '2019-11-06', '2019-12-26 03:18:22', '2019-12-26 03:18:22', NULL),
(44, 1, 13, 9, 10000, 11000, 0, 0, 1, 11000, '2019-11-06', '2019-12-26 03:18:22', '2019-12-26 03:18:22', NULL),
(45, 1, 13, 3, 5000, 6000, 10, 600, 1, 6600, '2019-11-06', '2019-12-26 03:18:22', '2019-12-26 03:18:22', NULL),
(46, 1, 14, 19, 3000, 3500, 5, 175, 1, 3675, '2019-11-06', '2019-12-26 03:18:29', '2019-12-26 03:18:29', NULL),
(47, 1, 14, 26, 500, 800, 5, 40, 1, 840, '2019-11-06', '2019-12-26 03:18:29', '2019-12-26 03:18:29', NULL),
(48, 1, 14, 33, 1000, 1200, 5, 60, 1, 1260, '2019-11-06', '2019-12-26 03:18:29', '2019-12-26 03:18:29', NULL),
(49, 1, 14, 29, 1000, 1500, 0, 0, 1, 1500, '2019-11-06', '2019-12-26 03:18:29', '2019-12-26 03:18:29', NULL),
(50, 1, 14, 28, 1000, 1500, 5, 75, 1, 1575, '2019-11-06', '2019-12-26 03:18:29', '2019-12-26 03:18:29', NULL),
(51, 1, 15, 44, 30, 40, 0, 0, 1, 40, '2019-11-06', '2019-12-26 03:18:55', '2019-12-26 03:18:55', NULL),
(52, 1, 15, 34, 500, 1000, 5, 50, 1, 1050, '2019-11-06', '2019-12-26 03:18:55', '2019-12-26 03:18:55', NULL),
(53, 1, 15, 31, 1500, 2000, 5, 100, 1, 2100, '2019-11-06', '2019-12-26 03:18:55', '2019-12-26 03:18:55', NULL),
(54, 1, 15, 32, 500, 800, 5, 40, 1, 840, '2019-11-06', '2019-12-26 03:18:55', '2019-12-26 03:18:55', NULL),
(55, 1, 15, 26, 500, 800, 5, 40, 1, 840, '2019-11-06', '2019-12-26 03:18:55', '2019-12-26 03:18:55', NULL),
(56, 1, 15, 25, 500, 1000, 5, 50, 1, 1050, '2019-11-06', '2019-12-26 03:18:55', '2019-12-26 03:18:55', NULL),
(57, 1, 16, 25, 500, 1000, 5, 50, 1, 1050, '2019-11-16', '2019-12-26 03:19:07', '2019-12-26 03:19:07', NULL),
(58, 1, 16, 26, 500, 800, 5, 40, 1, 840, '2019-11-16', '2019-12-26 03:19:08', '2019-12-26 03:19:08', NULL),
(59, 1, 16, 30, 1000, 1500, 5, 75, 1, 1575, '2019-11-16', '2019-12-26 03:19:08', '2019-12-26 03:19:08', NULL),
(60, 1, 16, 10, 20000, 25000, 0, 0, 1, 25000, '2019-11-16', '2019-12-26 03:19:08', '2019-12-26 03:19:08', NULL),
(61, 1, 16, 9, 10000, 11000, 0, 0, 1, 11000, '2019-11-16', '2019-12-26 03:19:08', '2019-12-26 03:19:08', NULL),
(62, 1, 17, 15, 2000, 3000, 0, 0, 1, 3000, '2019-11-16', '2019-12-26 03:19:17', '2019-12-26 03:19:17', NULL),
(63, 1, 17, 5, 4000, 3000, 0, 0, 1, 3000, '2019-11-16', '2019-12-26 03:19:17', '2019-12-26 03:19:17', NULL),
(64, 1, 17, 4, 4000, 5000, 0, 0, 1, 5000, '2019-11-16', '2019-12-26 03:19:17', '2019-12-26 03:19:17', NULL),
(65, 1, 17, 3, 5000, 6000, 10, 600, 1, 6600, '2019-11-16', '2019-12-26 03:19:17', '2019-12-26 03:19:17', NULL),
(66, 1, 17, 2, 500, 600, 0, 0, 1, 600, '2019-11-16', '2019-12-26 03:19:17', '2019-12-26 03:19:17', NULL),
(67, 1, 17, 1, 1000, 1200, 10, 120, 1, 1320, '2019-11-16', '2019-12-26 03:19:17', '2019-12-26 03:19:17', NULL),
(68, 1, 18, 34, 500, 1000, 5, 50, 1, 1050, '2019-11-16', '2019-12-26 03:19:24', '2019-12-26 03:19:24', NULL),
(69, 1, 18, 32, 500, 800, 5, 40, 1, 840, '2019-11-16', '2019-12-26 03:19:24', '2019-12-26 03:19:24', NULL),
(70, 1, 18, 31, 1500, 2000, 5, 100, 1, 2100, '2019-11-16', '2019-12-26 03:19:24', '2019-12-26 03:19:24', NULL),
(71, 1, 18, 38, 120, 150, 0, 0, 1, 150, '2019-11-16', '2019-12-26 03:19:24', '2019-12-26 03:19:24', NULL),
(72, 1, 18, 39, 40, 50, 0, 0, 1, 50, '2019-11-16', '2019-12-26 03:19:25', '2019-12-26 03:19:25', NULL),
(73, 1, 18, 43, 45, 50, 0, 0, 1, 50, '2019-11-16', '2019-12-26 03:19:25', '2019-12-26 03:19:25', NULL),
(74, 1, 19, 14, 500, 1000, 0, 0, 1, 1000, '2019-11-21', '2019-12-26 03:19:41', '2019-12-26 03:19:41', NULL),
(75, 1, 19, 13, 1500, 2000, 0, 0, 1, 2000, '2019-11-21', '2019-12-26 03:19:41', '2019-12-26 03:19:41', NULL),
(76, 1, 19, 7, 700, 500, 0, 0, 2, 1000, '2019-11-21', '2019-12-26 03:19:41', '2019-12-26 03:19:41', NULL),
(77, 1, 19, 11, 2000, 2500, 0, 0, 1, 2500, '2019-11-21', '2019-12-26 03:19:41', '2019-12-26 03:19:41', NULL),
(78, 1, 19, 5, 4000, 3000, 0, 0, 1, 3000, '2019-11-21', '2019-12-26 03:19:41', '2019-12-26 03:19:41', NULL),
(79, 1, 19, 4, 4000, 5000, 0, 0, 1, 5000, '2019-11-21', '2019-12-26 03:19:41', '2019-12-26 03:19:41', NULL),
(80, 1, 19, 3, 5000, 6000, 10, 600, 1, 6600, '2019-11-21', '2019-12-26 03:19:41', '2019-12-26 03:19:41', NULL),
(81, 1, 19, 2, 500, 600, 0, 0, 1, 600, '2019-11-21', '2019-12-26 03:19:41', '2019-12-26 03:19:41', NULL),
(82, 1, 19, 1, 1000, 1200, 10, 120, 1, 1320, '2019-11-21', '2019-12-26 03:19:41', '2019-12-26 03:19:41', NULL),
(83, 1, 20, 15, 2000, 3000, 0, 0, 1, 3000, '2019-11-26', '2019-12-26 03:20:06', '2019-12-26 03:20:06', NULL),
(84, 1, 20, 13, 1500, 2000, 0, 0, 1, 2000, '2019-11-26', '2019-12-26 03:20:06', '2019-12-26 03:20:06', NULL),
(85, 1, 20, 8, 10000, 12000, 10, 1200, 1, 13200, '2019-11-26', '2019-12-26 03:20:06', '2019-12-26 03:20:06', NULL),
(86, 1, 20, 9, 10000, 11000, 0, 0, 1, 11000, '2019-11-26', '2019-12-26 03:20:06', '2019-12-26 03:20:06', NULL),
(87, 1, 20, 3, 5000, 6000, 10, 600, 1, 6600, '2019-11-26', '2019-12-26 03:20:07', '2019-12-26 03:20:07', NULL),
(88, 1, 20, 2, 500, 600, 0, 0, 1, 600, '2019-11-26', '2019-12-26 03:20:07', '2019-12-26 03:20:07', NULL),
(89, 1, 20, 1, 1000, 1200, 10, 120, 10, 13200, '2019-11-26', '2019-12-26 03:20:07', '2019-12-26 03:20:07', NULL),
(90, 1, 21, 1, 1000, 1200, 10, 120, 6, 7920, '2019-11-28', '2019-12-26 03:20:54', '2019-12-26 03:20:54', NULL),
(91, 1, 21, 4, 4000, 5000, 0, 0, 1, 5000, '2019-11-28', '2019-12-26 03:20:54', '2019-12-26 03:20:54', NULL),
(92, 1, 21, 2, 500, 600, 0, 0, 1, 600, '2019-11-28', '2019-12-26 03:20:54', '2019-12-26 03:20:54', NULL),
(93, 1, 21, 7, 700, 500, 0, 0, 1, 500, '2019-11-28', '2019-12-26 03:20:54', '2019-12-26 03:20:54', NULL),
(94, 1, 22, 7, 700, 500, 0, 0, 2, 1000, '2019-11-28', '2019-12-26 03:21:06', '2019-12-26 03:21:06', NULL),
(95, 1, 22, 9, 10000, 11000, 0, 0, 1, 11000, '2019-11-28', '2019-12-26 03:21:06', '2019-12-26 03:21:06', NULL),
(96, 1, 22, 17, 1000, 1500, 0, 0, 1, 1500, '2019-11-28', '2019-12-26 03:21:06', '2019-12-26 03:21:06', NULL),
(97, 1, 22, 14, 500, 1000, 0, 0, 1, 1000, '2019-11-28', '2019-12-26 03:21:06', '2019-12-26 03:21:06', NULL),
(98, 1, 23, 17, 1000, 1500, 0, 0, 1, 1500, '2019-11-28', '2019-12-26 03:21:11', '2019-12-26 03:21:11', NULL),
(99, 1, 24, 26, 500, 800, 5, 40, 1, 840, '2019-11-28', '2019-12-26 03:21:16', '2019-12-26 03:21:16', NULL),
(100, 1, 25, 3, 5000, 6000, 10, 600, 6, 39600, '2019-12-01', '2019-12-26 03:21:41', '2019-12-26 03:21:41', NULL),
(101, 1, 25, 2, 500, 600, 0, 0, 1, 600, '2019-12-01', '2019-12-26 03:21:41', '2019-12-26 03:21:41', NULL),
(102, 1, 25, 1, 1000, 1200, 10, 120, 1, 1320, '2019-12-01', '2019-12-26 03:21:41', '2019-12-26 03:21:41', NULL),
(103, 1, 26, 26, 500, 800, 5, 40, 1, 840, '2019-12-01', '2019-12-26 03:21:47', '2019-12-26 03:21:47', NULL),
(104, 1, 26, 25, 500, 1000, 5, 50, 1, 1050, '2019-12-01', '2019-12-26 03:21:47', '2019-12-26 03:21:47', NULL),
(105, 1, 26, 34, 500, 1000, 5, 50, 1, 1050, '2019-12-01', '2019-12-26 03:21:47', '2019-12-26 03:21:47', NULL),
(106, 1, 26, 35, 150, 200, 0, 0, 1, 200, '2019-12-01', '2019-12-26 03:21:47', '2019-12-26 03:21:47', NULL),
(107, 1, 26, 36, 150, 200, 0, 0, 1, 200, '2019-12-01', '2019-12-26 03:21:48', '2019-12-26 03:21:48', NULL),
(108, 1, 27, 32, 500, 800, 5, 40, 1, 840, '2019-12-01', '2019-12-26 03:21:54', '2019-12-26 03:21:54', NULL),
(109, 1, 27, 31, 1500, 2000, 5, 100, 1, 2100, '2019-12-01', '2019-12-26 03:21:54', '2019-12-26 03:21:54', NULL),
(110, 1, 27, 37, 100, 150, 0, 0, 1, 150, '2019-12-01', '2019-12-26 03:21:54', '2019-12-26 03:21:54', NULL),
(111, 1, 27, 38, 120, 150, 0, 0, 1, 150, '2019-12-01', '2019-12-26 03:21:54', '2019-12-26 03:21:54', NULL),
(112, 1, 27, 40, 95, 100, 0, 0, 1, 100, '2019-12-01', '2019-12-26 03:21:54', '2019-12-26 03:21:54', NULL),
(113, 1, 27, 45, 40, 60, 0, 0, 1, 60, '2019-12-01', '2019-12-26 03:21:54', '2019-12-26 03:21:54', NULL),
(114, 1, 27, 43, 45, 50, 0, 0, 1, 50, '2019-12-01', '2019-12-26 03:21:54', '2019-12-26 03:21:54', NULL),
(115, 1, 27, 44, 30, 40, 0, 0, 1, 40, '2019-12-01', '2019-12-26 03:21:55', '2019-12-26 03:21:55', NULL),
(116, 1, 28, 8, 10000, 12000, 10, 1200, 2, 26400, '2019-12-01', '2019-12-26 03:22:02', '2019-12-26 03:22:02', NULL),
(117, 1, 28, 7, 700, 500, 0, 0, 1, 500, '2019-12-01', '2019-12-26 03:22:02', '2019-12-26 03:22:02', NULL),
(118, 1, 28, 2, 500, 600, 0, 0, 1, 600, '2019-12-01', '2019-12-26 03:22:02', '2019-12-26 03:22:02', NULL),
(119, 1, 28, 3, 5000, 6000, 10, 600, 1, 6600, '2019-12-01', '2019-12-26 03:22:03', '2019-12-26 03:22:03', NULL),
(120, 1, 28, 5, 4000, 3000, 0, 0, 1, 3000, '2019-12-01', '2019-12-26 03:22:03', '2019-12-26 03:22:03', NULL),
(121, 1, 28, 6, 1500, 2000, 0, 0, 1, 2000, '2019-12-01', '2019-12-26 03:22:03', '2019-12-26 03:22:03', NULL),
(122, 1, 29, 27, 500, 1000, 5, 50, 1, 1050, '2019-12-02', '2019-12-26 03:22:17', '2019-12-26 03:22:17', NULL),
(123, 1, 29, 21, 2000, 3000, 5, 150, 1, 3150, '2019-12-02', '2019-12-26 03:22:17', '2019-12-26 03:22:17', NULL),
(124, 1, 29, 20, 2000, 2500, 0, 0, 1, 2500, '2019-12-02', '2019-12-26 03:22:17', '2019-12-26 03:22:17', NULL),
(125, 1, 29, 26, 500, 800, 5, 40, 1, 840, '2019-12-02', '2019-12-26 03:22:18', '2019-12-26 03:22:18', NULL),
(126, 1, 29, 25, 500, 1000, 5, 50, 1, 1050, '2019-12-02', '2019-12-26 03:22:18', '2019-12-26 03:22:18', NULL),
(127, 1, 29, 19, 3000, 3500, 5, 175, 1, 3675, '2019-12-02', '2019-12-26 03:22:18', '2019-12-26 03:22:18', NULL),
(128, 1, 29, 14, 500, 1000, 0, 0, 1, 1000, '2019-12-02', '2019-12-26 03:22:18', '2019-12-26 03:22:18', NULL),
(129, 1, 29, 16, 2500, 3000, 5, 150, 1, 3150, '2019-12-02', '2019-12-26 03:22:18', '2019-12-26 03:22:18', NULL),
(130, 1, 29, 10, 20000, 25000, 0, 0, 1, 25000, '2019-12-02', '2019-12-26 03:22:18', '2019-12-26 03:22:18', NULL),
(131, 1, 29, 9, 10000, 11000, 0, 0, 1, 11000, '2019-12-02', '2019-12-26 03:22:18', '2019-12-26 03:22:18', NULL),
(132, 1, 29, 3, 5000, 6000, 10, 600, 1, 6600, '2019-12-02', '2019-12-26 03:22:18', '2019-12-26 03:22:18', NULL),
(133, 1, 30, 1, 1000, 1200, 10, 120, 5, 6600, '2019-12-02', '2019-12-26 03:22:42', '2019-12-26 03:22:42', NULL),
(134, 1, 31, 7, 700, 500, 0, 0, 2, 1000, '2019-12-02', '2019-12-26 03:23:34', '2019-12-26 03:23:34', NULL),
(135, 1, 31, 9, 10000, 11000, 0, 0, 1, 11000, '2019-12-02', '2019-12-26 03:23:34', '2019-12-26 03:23:34', NULL),
(136, 1, 31, 2, 500, 600, 0, 0, 1, 600, '2019-12-02', '2019-12-26 03:23:34', '2019-12-26 03:23:34', NULL),
(137, 1, 32, 25, 500, 1000, 5, 50, 1, 1050, '2019-12-04', '2019-12-26 03:23:51', '2019-12-26 03:23:51', NULL),
(138, 1, 32, 26, 500, 800, 5, 40, 1, 840, '2019-12-04', '2019-12-26 03:23:51', '2019-12-26 03:23:51', NULL),
(139, 1, 32, 27, 500, 1000, 5, 50, 2, 2100, '2019-12-04', '2019-12-26 03:23:51', '2019-12-26 03:23:51', NULL),
(140, 1, 32, 21, 2000, 3000, 5, 150, 1, 3150, '2019-12-04', '2019-12-26 03:23:51', '2019-12-26 03:23:51', NULL),
(141, 1, 32, 19, 3000, 3500, 5, 175, 1, 3675, '2019-12-04', '2019-12-26 03:23:51', '2019-12-26 03:23:51', NULL),
(142, 1, 32, 13, 1500, 2000, 0, 0, 1, 2000, '2019-12-04', '2019-12-26 03:23:51', '2019-12-26 03:23:51', NULL),
(143, 1, 32, 14, 500, 1000, 0, 0, 2, 2000, '2019-12-04', '2019-12-26 03:23:51', '2019-12-26 03:23:51', NULL),
(144, 1, 32, 8, 10000, 12000, 10, 1200, 1, 13200, '2019-12-04', '2019-12-26 03:23:52', '2019-12-26 03:23:52', NULL),
(145, 1, 32, 2, 500, 600, 0, 0, 1, 600, '2019-12-04', '2019-12-26 03:23:52', '2019-12-26 03:23:52', NULL),
(146, 1, 33, 33, 1000, 1200, 5, 60, 1, 1260, '2019-12-04', '2019-12-26 03:24:07', '2019-12-26 03:24:07', NULL),
(147, 1, 33, 34, 500, 1000, 5, 50, 1, 1050, '2019-12-04', '2019-12-26 03:24:07', '2019-12-26 03:24:07', NULL),
(148, 1, 33, 27, 500, 1000, 5, 50, 1, 1050, '2019-12-04', '2019-12-26 03:24:07', '2019-12-26 03:24:07', NULL),
(149, 1, 33, 26, 500, 800, 5, 40, 1, 840, '2019-12-04', '2019-12-26 03:24:07', '2019-12-26 03:24:07', NULL),
(150, 1, 33, 32, 500, 800, 5, 40, 1, 840, '2019-12-04', '2019-12-26 03:24:07', '2019-12-26 03:24:07', NULL),
(151, 1, 33, 37, 100, 150, 0, 0, 1, 150, '2019-12-04', '2019-12-26 03:24:07', '2019-12-26 03:24:07', NULL),
(152, 1, 33, 38, 120, 150, 0, 0, 1, 150, '2019-12-04', '2019-12-26 03:24:08', '2019-12-26 03:24:08', NULL),
(153, 1, 33, 39, 40, 50, 0, 0, 1, 50, '2019-12-04', '2019-12-26 03:24:08', '2019-12-26 03:24:08', NULL),
(154, 1, 34, 11, 2000, 2500, 0, 0, 1, 2500, '2019-12-04', '2019-12-26 03:24:17', '2019-12-26 03:24:17', NULL),
(155, 1, 34, 5, 4000, 3000, 0, 0, 1, 3000, '2019-12-04', '2019-12-26 03:24:17', '2019-12-26 03:24:17', NULL),
(156, 1, 34, 4, 4000, 5000, 0, 0, 1, 5000, '2019-12-04', '2019-12-26 03:24:17', '2019-12-26 03:24:17', NULL),
(157, 1, 34, 3, 5000, 6000, 10, 600, 1, 6600, '2019-12-04', '2019-12-26 03:24:17', '2019-12-26 03:24:17', NULL),
(158, 1, 34, 9, 10000, 11000, 0, 0, 1, 11000, '2019-12-04', '2019-12-26 03:24:17', '2019-12-26 03:24:17', NULL),
(159, 1, 35, 3, 5000, 6000, 10, 600, 1, 6600, '2019-12-11', '2019-12-26 03:24:56', '2019-12-26 03:24:56', NULL),
(160, 1, 35, 2, 500, 600, 0, 0, 1, 600, '2019-12-11', '2019-12-26 03:24:56', '2019-12-26 03:24:56', NULL),
(161, 1, 35, 1, 1000, 1200, 10, 120, 6, 7920, '2019-12-11', '2019-12-26 03:24:56', '2019-12-26 03:24:56', NULL),
(162, 1, 35, 9, 10000, 11000, 0, 0, 1, 11000, '2019-12-11', '2019-12-26 03:24:56', '2019-12-26 03:24:56', NULL),
(163, 1, 35, 8, 10000, 12000, 10, 1200, 1, 13200, '2019-12-11', '2019-12-26 03:24:56', '2019-12-26 03:24:56', NULL),
(164, 1, 35, 7, 700, 500, 0, 0, 1, 500, '2019-12-11', '2019-12-26 03:24:56', '2019-12-26 03:24:56', NULL),
(165, 1, 36, 9, 10000, 11000, 0, 0, 1, 11000, '2019-12-11', '2019-12-26 03:25:02', '2019-12-26 03:25:02', NULL),
(166, 1, 36, 10, 20000, 25000, 0, 0, 1, 25000, '2019-12-11', '2019-12-26 03:25:02', '2019-12-26 03:25:02', NULL),
(167, 1, 36, 11, 2000, 2500, 0, 0, 1, 2500, '2019-12-11', '2019-12-26 03:25:02', '2019-12-26 03:25:02', NULL),
(168, 1, 36, 18, 2000, 3000, 10, 300, 1, 3300, '2019-12-11', '2019-12-26 03:25:02', '2019-12-26 03:25:02', NULL),
(169, 1, 36, 17, 1000, 1500, 0, 0, 1, 1500, '2019-12-11', '2019-12-26 03:25:02', '2019-12-26 03:25:02', NULL),
(170, 1, 36, 23, 1000, 1500, 10, 150, 1, 1650, '2019-12-11', '2019-12-26 03:25:02', '2019-12-26 03:25:02', NULL),
(171, 1, 37, 9, 10000, 11000, 0, 0, 1, 11000, '2019-12-11', '2019-12-26 03:25:07', '2019-12-26 03:25:07', NULL),
(172, 1, 37, 11, 2000, 2500, 0, 0, 1, 2500, '2019-12-11', '2019-12-26 03:25:07', '2019-12-26 03:25:07', NULL),
(173, 1, 37, 5, 4000, 3000, 0, 0, 1, 3000, '2019-12-11', '2019-12-26 03:25:07', '2019-12-26 03:25:07', NULL),
(174, 1, 37, 3, 5000, 6000, 10, 600, 1, 6600, '2019-12-11', '2019-12-26 03:25:07', '2019-12-26 03:25:07', NULL),
(175, 1, 38, 3, 5000, 6000, 10, 600, 1, 6600, '2019-12-16', '2019-12-26 03:25:17', '2019-12-26 03:25:17', NULL),
(176, 1, 38, 2, 500, 600, 0, 0, 1, 600, '2019-12-16', '2019-12-26 03:25:17', '2019-12-26 03:25:17', NULL),
(177, 1, 39, 16, 2500, 3000, 5, 150, 1, 3150, '2019-12-16', '2019-12-26 03:25:47', '2019-12-26 03:25:47', NULL),
(178, 1, 39, 15, 2000, 3000, 0, 0, 1, 3000, '2019-12-16', '2019-12-26 03:25:47', '2019-12-26 03:25:47', NULL),
(179, 1, 39, 9, 10000, 11000, 0, 0, 1, 11000, '2019-12-16', '2019-12-26 03:25:47', '2019-12-26 03:25:47', NULL),
(180, 1, 40, 33, 1000, 1200, 5, 60, 1, 1260, '2019-12-16', '2019-12-26 03:25:53', '2019-12-26 03:25:53', NULL),
(181, 1, 40, 32, 500, 800, 5, 40, 1, 840, '2019-12-16', '2019-12-26 03:25:53', '2019-12-26 03:25:53', NULL),
(182, 1, 40, 31, 1500, 2000, 5, 100, 1, 2100, '2019-12-16', '2019-12-26 03:25:54', '2019-12-26 03:25:54', NULL),
(183, 1, 40, 38, 120, 150, 0, 0, 1, 150, '2019-12-16', '2019-12-26 03:25:54', '2019-12-26 03:25:54', NULL),
(184, 1, 40, 39, 40, 50, 0, 0, 1, 50, '2019-12-16', '2019-12-26 03:25:54', '2019-12-26 03:25:54', NULL),
(185, 1, 41, 12, 1000, 500, 0, 0, 1, 500, '2019-12-16', '2019-12-26 03:26:03', '2019-12-26 03:26:03', NULL),
(186, 1, 41, 11, 2000, 2500, 0, 0, 1, 2500, '2019-12-16', '2019-12-26 03:26:03', '2019-12-26 03:26:03', NULL),
(187, 1, 41, 10, 20000, 25000, 0, 0, 1, 25000, '2019-12-16', '2019-12-26 03:26:03', '2019-12-26 03:26:03', NULL),
(188, 1, 41, 15, 2000, 3000, 0, 0, 1, 3000, '2019-12-16', '2019-12-26 03:26:03', '2019-12-26 03:26:03', NULL),
(189, 1, 41, 32, 500, 800, 5, 40, 1, 840, '2019-12-16', '2019-12-26 03:26:03', '2019-12-26 03:26:03', NULL),
(190, 1, 41, 33, 1000, 1200, 5, 60, 1, 1260, '2019-12-16', '2019-12-26 03:26:03', '2019-12-26 03:26:03', NULL),
(191, 1, 41, 35, 150, 200, 0, 0, 1, 200, '2019-12-16', '2019-12-26 03:26:03', '2019-12-26 03:26:03', NULL),
(192, 1, 41, 36, 150, 200, 0, 0, 1, 200, '2019-12-16', '2019-12-26 03:26:03', '2019-12-26 03:26:03', NULL),
(193, 1, 41, 42, 40, 50, 0, 0, 1, 50, '2019-12-16', '2019-12-26 03:26:03', '2019-12-26 03:26:03', NULL),
(194, 1, 42, 1, 1000, 1200, 10, 120, 1, 1320, '2019-12-19', '2019-12-26 03:26:18', '2019-12-26 03:26:18', NULL),
(195, 1, 42, 6, 1500, 2000, 0, 0, 1, 2000, '2019-12-19', '2019-12-26 03:26:18', '2019-12-26 03:26:18', NULL),
(196, 1, 42, 5, 4000, 3000, 0, 0, 1, 3000, '2019-12-19', '2019-12-26 03:26:18', '2019-12-26 03:26:18', NULL),
(197, 1, 42, 4, 4000, 5000, 0, 0, 1, 5000, '2019-12-19', '2019-12-26 03:26:18', '2019-12-26 03:26:18', NULL),
(198, 1, 42, 2, 500, 600, 0, 0, 1, 600, '2019-12-19', '2019-12-26 03:26:18', '2019-12-26 03:26:18', NULL),
(199, 1, 42, 9, 10000, 11000, 0, 0, 1, 11000, '2019-12-19', '2019-12-26 03:26:18', '2019-12-26 03:26:18', NULL),
(200, 1, 42, 8, 10000, 12000, 10, 1200, 1, 13200, '2019-12-19', '2019-12-26 03:26:18', '2019-12-26 03:26:18', NULL),
(201, 1, 42, 20, 2000, 2500, 0, 0, 1, 2500, '2019-12-19', '2019-12-26 03:26:18', '2019-12-26 03:26:18', NULL),
(202, 1, 42, 14, 500, 1000, 0, 0, 1, 1000, '2019-12-19', '2019-12-26 03:26:18', '2019-12-26 03:26:18', NULL),
(203, 1, 43, 28, 1000, 1500, 5, 75, 1, 1575, '2019-12-19', '2019-12-26 03:26:32', '2019-12-26 03:26:32', NULL),
(204, 1, 43, 25, 500, 1000, 5, 50, 1, 1050, '2019-12-19', '2019-12-26 03:26:32', '2019-12-26 03:26:32', NULL),
(205, 1, 43, 7, 700, 500, 0, 0, 1, 500, '2019-12-19', '2019-12-26 03:26:32', '2019-12-26 03:26:32', NULL),
(206, 1, 43, 8, 10000, 12000, 10, 1200, 1, 13200, '2019-12-19', '2019-12-26 03:26:32', '2019-12-26 03:26:32', NULL),
(207, 1, 43, 9, 10000, 11000, 0, 0, 1, 11000, '2019-12-19', '2019-12-26 03:26:32', '2019-12-26 03:26:32', NULL),
(208, 1, 43, 10, 20000, 25000, 0, 0, 1, 25000, '2019-12-19', '2019-12-26 03:26:32', '2019-12-26 03:26:32', NULL),
(209, 1, 43, 5, 4000, 3000, 0, 0, 1, 3000, '2019-12-19', '2019-12-26 03:26:32', '2019-12-26 03:26:32', NULL),
(210, 1, 43, 3, 5000, 6000, 10, 600, 1, 6600, '2019-12-19', '2019-12-26 03:26:32', '2019-12-26 03:26:32', NULL),
(211, 1, 43, 2, 500, 600, 0, 0, 1, 600, '2019-12-19', '2019-12-26 03:26:32', '2019-12-26 03:26:32', NULL),
(212, 1, 43, 1, 1000, 1200, 10, 120, 1, 1320, '2019-12-19', '2019-12-26 03:26:32', '2019-12-26 03:26:32', NULL),
(213, 1, 44, 10, 20000, 25000, 0, 0, 1, 25000, '2019-12-19', '2019-12-26 03:26:41', '2019-12-26 03:26:41', NULL),
(214, 1, 44, 7, 700, 500, 0, 0, 1, 500, '2019-12-19', '2019-12-26 03:26:41', '2019-12-26 03:26:41', NULL),
(215, 1, 44, 1, 1000, 1200, 10, 120, 1, 1320, '2019-12-19', '2019-12-26 03:26:41', '2019-12-26 03:26:41', NULL),
(216, 1, 44, 2, 500, 600, 0, 0, 1, 600, '2019-12-19', '2019-12-26 03:26:41', '2019-12-26 03:26:41', NULL),
(217, 1, 44, 3, 5000, 6000, 10, 600, 1, 6600, '2019-12-19', '2019-12-26 03:26:41', '2019-12-26 03:26:41', NULL),
(218, 1, 45, 9, 10000, 11000, 0, 0, 5, 55000, '2019-12-23', '2019-12-26 03:27:09', '2019-12-26 03:27:09', NULL),
(219, 1, 45, 10, 20000, 25000, 0, 0, 1, 25000, '2019-12-23', '2019-12-26 03:27:09', '2019-12-26 03:27:09', NULL),
(220, 1, 45, 8, 10000, 12000, 10, 1200, 1, 13200, '2019-12-23', '2019-12-26 03:27:09', '2019-12-26 03:27:09', NULL),
(221, 1, 46, 1, 1000, 1200, 10, 120, 19, 25080, '2019-12-26', '2019-12-26 03:27:32', '2019-12-26 03:27:32', NULL),
(222, 1, 47, 3, 5000, 6000, 10, 600, 1, 6600, '2019-12-26', '2019-12-26 10:15:40', '2019-12-26 10:15:40', NULL),
(223, 1, 47, 2, 500, 600, 0, 0, 1, 600, '2019-12-26', '2019-12-26 10:15:40', '2019-12-26 10:15:40', NULL),
(224, 1, 48, 17, 1000, 1500, 0, 0, 1, 1500, '2019-12-26', '2019-12-26 10:15:48', '2019-12-26 10:15:48', NULL),
(225, 1, 48, 16, 2500, 3000, 5, 150, 1, 3150, '2019-12-26', '2019-12-26 10:15:48', '2019-12-26 10:15:48', NULL),
(226, 1, 49, 23, 1000, 1500, 10, 150, 1, 1650, '2019-12-26', '2019-12-26 10:15:58', '2019-12-26 10:15:58', NULL),
(227, 1, 50, 35, 150, 200, 0, 0, 1, 200, '2019-12-26', '2019-12-26 10:16:19', '2019-12-26 10:16:19', NULL),
(228, 1, 51, 44, 30, 40, 0, 0, 1, 40, '2019-12-26', '2019-12-26 10:16:29', '2019-12-26 10:16:29', NULL),
(229, 1, 51, 45, 40, 60, 0, 0, 1, 60, '2019-12-26', '2019-12-26 10:16:29', '2019-12-26 10:16:29', NULL),
(230, 1, 52, 37, 100, 150, 0, 0, 1, 150, '2019-12-26', '2019-12-26 10:16:43', '2019-12-26 10:16:43', NULL),
(231, 1, 52, 36, 150, 200, 0, 0, 1, 200, '2019-12-26', '2019-12-26 10:16:43', '2019-12-26 10:16:43', NULL),
(232, 1, 53, 11, 2000, 2500, 0, 0, 1, 2500, '2019-12-26', '2019-12-26 10:16:54', '2019-12-26 12:10:23', '2019-12-26 12:10:23'),
(233, 1, 53, 10, 20000, 25000, 0, 0, 1, 25000, '2019-12-26', '2019-12-26 10:16:54', '2019-12-26 12:10:23', '2019-12-26 12:10:23'),
(234, 3, 54, 1, 1000, 2000, 10, 200, 2, 4400, '2019-12-26', '2019-12-26 10:33:17', '2019-12-26 12:24:33', '2019-12-26 12:24:33'),
(235, 2, 55, 1, 1000, 2000, 10, 200, 1, 2200, '2019-12-26', '2019-12-26 10:34:38', '2019-12-26 10:34:38', NULL),
(236, 1, 56, 6, 1500, 2000, 0, 0, 8, 16000, '2019-12-26', '2019-12-26 11:57:46', '2019-12-26 11:57:46', NULL),
(237, 1, 57, 41, 95, 100, 0, 0, 12, 1200, '2019-12-26', '2019-12-26 11:59:04', '2019-12-26 11:59:04', NULL),
(238, 1, 57, 19, 3000, 3500, 5, 175, 3, 11025, '2019-12-26', '2019-12-26 11:59:04', '2019-12-26 11:59:04', NULL),
(239, 1, 53, 3, 5000, 6000, 10, 600, 0, 0, '2019-12-26', '2019-12-26 12:10:23', '2019-12-26 12:16:46', '2019-12-26 12:16:46'),
(240, 1, 53, 11, 2000, 2500, 0, 0, 1, 2500, '2019-12-26', '2019-12-26 12:10:23', '2019-12-26 12:16:46', '2019-12-26 12:16:46'),
(241, 1, 53, 10, 20000, 25000, 0, 0, 1, 25000, '2019-12-26', '2019-12-26 12:10:23', '2019-12-26 12:16:46', '2019-12-26 12:16:46'),
(242, 1, 53, 2, 500, 600, 0, 0, 0, 0, '2019-12-26', '2019-12-26 12:16:46', '2019-12-26 12:18:34', '2019-12-26 12:18:34'),
(243, 1, 53, 5, 4000, 3000, 0, 0, 0, 0, '2019-12-26', '2019-12-26 12:16:46', '2019-12-26 12:18:34', '2019-12-26 12:18:34'),
(244, 1, 53, 3, 5000, 6000, 10, 600, 1, 6600, '2019-12-26', '2019-12-26 12:16:46', '2019-12-26 12:18:34', '2019-12-26 12:18:34'),
(245, 1, 53, 11, 2000, 2500, 0, 0, 1, 2500, '2019-12-26', '2019-12-26 12:16:46', '2019-12-26 12:18:34', '2019-12-26 12:18:34'),
(246, 1, 53, 10, 20000, 25000, 0, 0, 1, 25000, '2019-12-26', '2019-12-26 12:16:46', '2019-12-26 12:18:34', '2019-12-26 12:18:34'),
(247, 1, 53, 11, 2000, 2500, 0, 0, 1, 2500, '2019-12-26', '2019-12-26 12:18:34', '2019-12-26 12:18:34', NULL),
(248, 1, 53, 10, 20000, 25000, 0, 0, 1, 25000, '2019-12-26', '2019-12-26 12:18:34', '2019-12-26 12:18:34', NULL),
(249, 3, 54, 8, 10000, 12000, 10, 1200, 1, 13200, '2019-12-26', '2019-12-26 12:24:33', '2019-12-26 12:25:47', '2019-12-26 12:25:47'),
(250, 3, 54, 1, 1000, 2000, 10, 200, 2, 4400, '2019-12-26', '2019-12-26 12:24:33', '2019-12-26 12:25:47', '2019-12-26 12:25:47'),
(251, 3, 54, 8, 10000, 12000, 10, 1200, 1, 13200, '2019-12-26', '2019-12-26 12:25:47', '2019-12-26 12:26:36', '2019-12-26 12:26:36'),
(252, 3, 54, 1, 1000, 2000, 10, 200, 2, 4400, '2019-12-26', '2019-12-26 12:25:47', '2019-12-26 12:26:36', '2019-12-26 12:26:36'),
(253, 3, 54, 8, 10000, 12000, 10, 1200, 1, 13200, '2019-12-26', '2019-12-26 12:26:36', '2019-12-26 12:27:48', '2019-12-26 12:27:48'),
(254, 3, 54, 1, 1000, 2000, 10, 200, 2, 4400, '2019-12-26', '2019-12-26 12:26:36', '2019-12-26 12:27:48', '2019-12-26 12:27:48'),
(255, 3, 54, 8, 10000, 12000, 10, 1200, 1, 13200, '2019-12-26', '2019-12-26 12:27:48', '2019-12-26 12:28:49', '2019-12-26 12:28:49'),
(256, 3, 54, 1, 1000, 2000, 10, 200, 2, 4400, '2019-12-26', '2019-12-26 12:27:48', '2019-12-26 12:28:49', '2019-12-26 12:28:49'),
(257, 3, 54, 2, 500, 600, 0, 0, 1, 600, '2019-12-26', '2019-12-26 12:28:49', '2019-12-26 12:30:54', '2019-12-26 12:30:54'),
(258, 3, 54, 8, 10000, 12000, 10, 1200, 1, 13200, '2019-12-26', '2019-12-26 12:28:49', '2019-12-26 12:30:54', '2019-12-26 12:30:54'),
(259, 3, 54, 1, 1000, 2000, 10, 200, 2, 4400, '2019-12-26', '2019-12-26 12:28:49', '2019-12-26 12:30:54', '2019-12-26 12:30:54'),
(260, 3, 54, 10, 20000, 25000, 0, 0, 1, 25000, '2019-12-26', '2019-12-26 12:30:54', '2019-12-26 12:30:54', NULL),
(261, 3, 54, 2, 500, 600, 0, 0, 1, 600, '2019-12-26', '2019-12-26 12:30:54', '2019-12-26 12:30:54', NULL),
(262, 3, 54, 8, 10000, 12000, 10, 1200, 2, 26400, '2019-12-26', '2019-12-26 12:30:54', '2019-12-26 12:30:54', NULL),
(263, 3, 54, 1, 1000, 2000, 10, 200, 2, 4400, '2019-12-26', '2019-12-26 12:30:54', '2019-12-26 12:30:54', NULL),
(264, 1, 58, 45, 40, 60, 0, 0, 4, 240, '2019-12-27', '2019-12-26 12:31:42', '2019-12-26 12:32:01', '2019-12-26 12:32:01'),
(265, 1, 58, 45, 40, 60, 0, 0, 3, 180, '2019-12-27', '2019-12-26 12:32:01', '2019-12-26 12:32:01', NULL),
(266, 1, 59, 7, 700, 50000, 0, 0, 1, 50000, '2020-01-10', '2020-01-10 03:47:21', '2020-01-10 03:47:21', NULL),
(267, 1, 59, 1, 1000, 1200, 10, 120, 1, 1320, '2020-01-10', '2020-01-10 03:47:22', '2020-01-10 03:47:22', NULL),
(268, 1, 60, 10, 20000, 25000, 0, 0, 1, 25000, '2020-01-10', '2020-01-10 04:48:02', '2020-01-10 04:48:02', NULL),
(269, 1, 60, 3, 5000, 6000, 10, 600, 1, 6600, '2020-01-10', '2020-01-10 04:48:02', '2020-01-10 04:48:02', NULL),
(270, 1, 60, 1, 1000, 1200, 10, 120, 1, 1320, '2020-01-10', '2020-01-10 04:48:02', '2020-01-10 04:48:02', NULL),
(271, 1, 61, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-01-24', '2020-01-24 13:41:55', '2020-01-24 13:41:55', NULL),
(272, 1, 61, 10, 20000, 25000, 0, 0, 1, 25000, '2020-01-24', '2020-01-24 13:41:56', '2020-01-24 13:41:56', NULL),
(273, 1, 62, 14, 500, 1000, 0, 0, 1, 1000, '2020-01-25', '2020-01-24 19:45:01', '2020-01-24 19:45:01', NULL),
(274, 1, 62, 16, 2500, 3000, 5, 150, 1, 3150, '2020-01-25', '2020-01-24 19:45:01', '2020-01-24 19:45:01', NULL),
(275, 1, 63, 4, 4000, 5000, 0, 0, 1, 5000, '2019-12-30', '2020-01-24 13:48:58', '2020-01-24 13:48:58', NULL),
(276, 1, 63, 1, 1000, 1200, 10, 120, 1, 1320, '2019-12-30', '2020-01-24 13:48:58', '2020-01-24 13:48:58', NULL),
(277, 1, 64, 9, 10000, 11000, 0, 0, 11, 121000, '2019-12-30', '2020-01-24 13:49:16', '2020-01-24 13:49:16', NULL),
(278, 1, 65, 17, 1000, 1500, 0, 0, 58, 87000, '2019-12-31', '2020-01-24 13:49:54', '2020-01-24 13:49:54', NULL),
(279, 1, 66, 11, 2000, 2500, 0, 0, 34, 85000, '2020-01-01', '2020-01-24 13:50:19', '2020-01-24 13:50:19', NULL),
(280, 1, 67, 16, 2500, 3000, 5, 150, 40, 126000, '2020-01-02', '2020-01-24 13:50:39', '2020-01-24 13:50:39', NULL),
(281, 1, 68, 5, 4000, 50000, 0, 0, 1, 50000, '2020-01-02', '2020-01-24 13:51:03', '2020-01-24 13:51:03', NULL),
(282, 1, 69, 15, 2000, 150000, 0, 0, 1, 150000, '2020-01-06', '2020-01-24 13:51:27', '2020-01-24 13:51:27', NULL),
(283, 1, 70, 15, 2000, 150000, 0, 0, 1, 150000, '2020-01-14', '2020-01-24 13:51:52', '2020-01-24 13:51:52', NULL),
(284, 1, 71, 7, 700, 100500, 0, 0, 1, 100500, '2020-01-20', '2020-01-24 13:52:25', '2020-01-24 13:52:25', NULL),
(285, 1, 72, 13, 1500, 120000, 0, 0, 1, 120000, '2020-01-24', '2020-01-24 13:52:57', '2020-01-24 13:52:57', NULL),
(286, 1, 73, 7, 700, 500, 0, 0, 2, 1000, '2020-01-27', '2020-01-26 19:12:58', '2020-01-26 19:12:58', NULL),
(287, 1, 73, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-01-27', '2020-01-26 19:12:58', '2020-01-26 19:12:58', NULL),
(288, 1, 74, 13, 1500, 2000, 0, 0, 1, 2000, '2020-01-26', '2020-01-26 04:14:05', '2020-01-26 04:14:05', NULL),
(289, 1, 74, 14, 500, 1000, 0, 0, 1, 1000, '2020-01-26', '2020-01-26 04:14:05', '2020-01-26 04:14:05', NULL),
(290, 1, 74, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-01-26', '2020-01-26 04:14:05', '2020-01-26 04:14:05', NULL),
(291, 1, 75, 4, 4000, 5000, 0, 0, 1, 5000, '2020-01-29', '2020-01-29 12:14:36', '2020-01-29 12:14:36', NULL),
(292, 1, 75, 3, 5000, 6000, 10, 600, 1, 6600, '2020-01-29', '2020-01-29 12:14:36', '2020-01-29 12:14:36', NULL),
(293, 1, 76, 4, 4000, 5000, 0, 0, 2, 10000, '2020-01-30', '2020-01-30 22:55:22', '2020-01-30 22:55:22', NULL),
(294, 2, 77, 2, 500, 600, 0, 0, 1, 600, '2020-01-30', '2020-01-31 00:45:05', '2020-01-31 00:45:05', NULL),
(295, 2, 77, 1, 1000, 1200, 10, 120, 2, 2640, '2020-01-30', '2020-01-31 00:45:05', '2020-01-31 00:45:05', NULL),
(296, 1, 78, 13, 1500, 2000, 0, 0, 1, 2000, '2020-01-30', '2020-01-31 00:59:48', '2020-01-31 00:59:48', NULL),
(297, 1, 78, 7, 700, 500, 0, 0, 1, 500, '2020-01-30', '2020-01-31 00:59:48', '2020-01-31 00:59:48', NULL),
(298, 1, 78, 14, 500, 1000, 0, 0, 1, 1000, '2020-01-30', '2020-01-31 00:59:48', '2020-01-31 00:59:48', NULL),
(299, 1, 78, 20, 2000, 2500, 0, 0, 1, 2500, '2020-01-30', '2020-01-31 00:59:48', '2020-01-31 00:59:48', NULL),
(300, 1, 78, 21, 2000, 3000, 5, 150, 1, 3150, '2020-01-30', '2020-01-31 00:59:48', '2020-01-31 00:59:48', NULL),
(301, 1, 78, 15, 2000, 3000, 0, 0, 1, 3000, '2020-01-30', '2020-01-31 00:59:48', '2020-01-31 00:59:48', NULL),
(302, 1, 78, 3, 5000, 6000, 10, 600, 1, 6600, '2020-01-30', '2020-01-31 00:59:48', '2020-01-31 00:59:48', NULL),
(303, 1, 78, 8, 10000, 12000, 10, 1200, 2, 26400, '2020-01-30', '2020-01-31 00:59:48', '2020-01-31 00:59:48', NULL),
(304, 1, 78, 2, 500, 600, 0, 0, 1, 600, '2020-01-30', '2020-01-31 00:59:48', '2020-01-31 00:59:48', NULL),
(305, 2, 79, 1, 1000, 1200, 10, 120, 1, 1320, '2020-01-30', '2020-01-31 01:32:50', '2020-01-31 01:32:50', NULL),
(306, 2, 79, 2, 500, 600, 0, 0, 1, 600, '2020-01-30', '2020-01-31 01:32:50', '2020-01-31 01:32:50', NULL),
(307, 1, 80, 3, 5000, 6000, 10, 600, 1, 6600, '2020-01-30', '2020-01-31 02:12:22', '2020-01-31 02:12:22', NULL),
(308, 1, 80, 2, 500, 600, 0, 0, 1, 600, '2020-01-30', '2020-01-31 02:12:22', '2020-01-31 02:12:22', NULL),
(309, 1, 80, 1, 1000, 1200, 10, 120, 1, 1320, '2020-01-30', '2020-01-31 02:12:22', '2020-01-31 02:12:22', NULL),
(310, 2, 81, 4, 4000, 5000, 0, 0, 1, 5000, '2020-01-31', '2020-01-31 07:59:46', '2020-01-31 07:59:46', NULL),
(311, 2, 81, 3, 5000, 6000, 10, 600, 1, 6600, '2020-01-31', '2020-01-31 07:59:46', '2020-01-31 07:59:46', NULL),
(312, 2, 82, 10, 20000, 25000, 0, 0, 1, 25000, '2020-01-31', '2020-01-31 08:01:42', '2020-01-31 08:01:42', NULL),
(313, 2, 82, 9, 10000, 11000, 0, 0, 1, 11000, '2020-01-31', '2020-01-31 08:01:42', '2020-01-31 08:01:42', NULL),
(314, 2, 82, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-01-31', '2020-01-31 08:01:42', '2020-01-31 08:01:42', NULL),
(315, 2, 83, 2, 500, 600, 0, 0, 1, 600, '2020-01-31', '2020-01-31 08:01:56', '2020-01-31 10:23:36', '2020-01-31 10:23:36'),
(316, 2, 83, 6, 1500, 2000, 0, 0, 4, 8000, '2020-01-31', '2020-01-31 10:23:36', '2020-01-31 10:23:36', NULL),
(317, 2, 83, 12, 1000, 500, 0, 0, 3, 1500, '2020-01-31', '2020-01-31 10:23:36', '2020-01-31 10:23:36', NULL),
(318, 2, 83, 18, 2000, 3000, 10, 300, 7, 23100, '2020-01-31', '2020-01-31 10:23:36', '2020-01-31 10:23:36', NULL),
(319, 2, 83, 19, 3000, 3500, 5, 175, 9, 33075, '2020-01-31', '2020-01-31 10:23:36', '2020-01-31 10:23:36', NULL),
(320, 2, 83, 20, 2000, 2500, 0, 0, 1, 2500, '2020-01-31', '2020-01-31 10:23:36', '2020-01-31 10:23:36', NULL),
(321, 2, 83, 21, 2000, 3000, 5, 150, 1, 3150, '2020-01-31', '2020-01-31 10:23:36', '2020-01-31 10:23:36', NULL),
(322, 2, 83, 11, 2000, 2500, 0, 0, 1, 2500, '2020-01-31', '2020-01-31 10:23:36', '2020-01-31 10:23:36', NULL),
(323, 2, 83, 10, 20000, 25000, 0, 0, 1, 25000, '2020-01-31', '2020-01-31 10:23:36', '2020-01-31 10:23:36', NULL),
(324, 2, 83, 4, 4000, 5000, 0, 0, 1, 5000, '2020-01-31', '2020-01-31 10:23:36', '2020-01-31 10:23:36', NULL),
(325, 2, 83, 3, 5000, 6000, 10, 600, 1, 6600, '2020-01-31', '2020-01-31 10:23:36', '2020-01-31 10:23:36', NULL),
(326, 2, 83, 9, 10000, 11000, 0, 0, 1, 11000, '2020-01-31', '2020-01-31 10:23:36', '2020-01-31 10:23:36', NULL),
(327, 1, 84, 27, 500, 1000, 5, 50, 1, 1050, '2020-01-31', '2020-01-31 10:48:53', '2020-01-31 10:48:53', NULL),
(328, 1, 84, 33, 1000, 1200, 5, 60, 1, 1260, '2020-01-31', '2020-01-31 10:48:53', '2020-01-31 10:48:53', NULL),
(329, 1, 84, 9, 10000, 11000, 0, 0, 3, 33000, '2020-01-31', '2020-01-31 10:48:53', '2020-01-31 10:48:53', NULL),
(330, 1, 84, 1, 1000, 1200, 10, 120, 1, 1320, '2020-01-31', '2020-01-31 10:48:53', '2020-01-31 10:48:53', NULL),
(331, 2, 85, 4, 4000, 5000, 0, 0, 1, 5000, '2020-01-31', '2020-01-31 10:59:20', '2020-01-31 10:59:20', NULL),
(332, 2, 85, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-01-31', '2020-01-31 10:59:20', '2020-01-31 10:59:20', NULL),
(333, 2, 85, 1, 1000, 1200, 10, 120, 2, 2640, '2020-01-31', '2020-01-31 10:59:20', '2020-01-31 10:59:20', NULL),
(334, 2, 85, 13, 1500, 2000, 0, 0, 1, 2000, '2020-01-31', '2020-01-31 10:59:20', '2020-01-31 10:59:20', NULL),
(335, 2, 85, 7, 700, 500, 0, 0, 2, 1000, '2020-01-31', '2020-01-31 10:59:20', '2020-01-31 10:59:20', NULL),
(336, 2, 85, 17, 1000, 1500, 0, 0, 1, 1500, '2020-01-31', '2020-01-31 10:59:20', '2020-01-31 10:59:20', NULL),
(337, 2, 85, 23, 1000, 1500, 10, 150, 1, 1650, '2020-01-31', '2020-01-31 10:59:20', '2020-01-31 10:59:20', NULL),
(338, 2, 85, 22, 2000, 3000, 0, 0, 1, 3000, '2020-01-31', '2020-01-31 10:59:20', '2020-01-31 10:59:20', NULL),
(339, 2, 85, 21, 2000, 3000, 5, 150, 1, 3150, '2020-01-31', '2020-01-31 10:59:20', '2020-01-31 10:59:20', NULL),
(340, 2, 85, 15, 2000, 3000, 0, 0, 1, 3000, '2020-01-31', '2020-01-31 10:59:20', '2020-01-31 10:59:20', NULL),
(341, 2, 85, 9, 10000, 11000, 0, 0, 4, 44000, '2020-01-31', '2020-01-31 10:59:20', '2020-01-31 10:59:20', NULL),
(342, 2, 85, 3, 5000, 6000, 10, 600, 1, 6600, '2020-01-31', '2020-01-31 10:59:20', '2020-01-31 10:59:20', NULL),
(343, 2, 86, 36, 150, 200, 0, 0, 1, 200, '2020-01-31', '2020-01-31 12:06:55', '2020-01-31 12:06:55', NULL),
(344, 2, 86, 33, 1000, 1200, 5, 60, 1, 1260, '2020-01-31', '2020-01-31 12:06:55', '2020-01-31 12:06:55', NULL),
(345, 2, 86, 4, 4000, 5000, 0, 0, 1, 5000, '2020-01-31', '2020-01-31 12:06:55', '2020-01-31 12:06:55', NULL),
(346, 2, 86, 2, 500, 600, 0, 0, 1, 600, '2020-01-31', '2020-01-31 12:06:55', '2020-01-31 12:06:55', NULL),
(347, 1, 87, 9, 10000, 11000, 0, 0, 1, 11000, '2020-01-31', '2020-01-31 13:08:35', '2020-01-31 13:08:35', NULL),
(348, 1, 87, 3, 5000, 6000, 10, 600, 1, 6600, '2020-01-31', '2020-01-31 13:08:35', '2020-01-31 13:08:35', NULL),
(349, 2, 88, 9, 10000, 11000, 0, 0, 1, 11000, '2020-01-31', '2020-01-31 13:41:54', '2020-01-31 13:41:54', NULL),
(350, 2, 88, 3, 5000, 6000, 10, 600, 2, 13200, '2020-01-31', '2020-01-31 13:41:54', '2020-01-31 13:41:54', NULL),
(351, 1, 89, 4, 4000, 5000, 0, 0, 1, 5000, '2020-01-31', '2020-01-31 14:10:39', '2020-01-31 14:10:39', NULL),
(352, 1, 89, 3, 5000, 6000, 10, 600, 1, 6600, '2020-01-31', '2020-01-31 14:10:39', '2020-01-31 14:10:39', NULL),
(353, 1, 89, 2, 500, 600, 0, 0, 1, 600, '2020-01-31', '2020-01-31 14:10:39', '2020-01-31 14:10:39', NULL),
(354, 1, 89, 1, 1000, 1200, 10, 120, 1, 1320, '2020-01-31', '2020-01-31 14:10:39', '2020-01-31 14:10:39', NULL),
(355, 1, 90, 3, 5000, 6000, 10, 600, 1, 6600, '2020-01-31', '2020-01-31 14:11:13', '2020-01-31 14:11:13', NULL),
(356, 1, 90, 2, 500, 600, 0, 0, 1, 600, '2020-01-31', '2020-01-31 14:11:13', '2020-01-31 14:11:13', NULL),
(357, 1, 91, 7, 700, 500, 0, 0, 1, 500, '2020-01-31', '2020-01-31 14:27:19', '2020-01-31 14:27:19', NULL),
(358, 1, 91, 1, 1000, 1200, 10, 120, 1, 1320, '2020-01-31', '2020-01-31 14:27:19', '2020-01-31 14:27:19', NULL),
(359, 1, 92, 3, 5000, 6000, 10, 600, 1, 6600, '2020-01-31', '2020-01-31 15:07:23', '2020-02-01 04:04:29', '2020-02-01 04:04:29'),
(360, 1, 92, 10, 20000, 25000, 0, 0, 1, 25000, '2020-01-31', '2020-01-31 15:07:23', '2020-02-01 04:04:29', '2020-02-01 04:04:29'),
(361, 1, 92, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-01-31', '2020-01-31 15:07:23', '2020-02-01 04:04:29', '2020-02-01 04:04:29'),
(362, 2, 93, 39, 40, 50, 0, 0, 1, 50, '2020-01-31', '2020-01-31 16:10:57', '2020-01-31 16:10:57', NULL),
(363, 2, 93, 4, 4000, 5000, 0, 0, 1, 5000, '2020-01-31', '2020-01-31 16:10:57', '2020-01-31 16:10:57', NULL),
(364, 1, 94, 5, 4000, 3000, 0, 0, 1, 3000, '2020-01-31', '2020-01-31 21:23:49', '2020-01-31 21:23:49', NULL),
(365, 1, 94, 11, 2000, 2500, 0, 0, 1, 2500, '2020-01-31', '2020-01-31 21:23:49', '2020-01-31 21:23:49', NULL),
(366, 1, 94, 10, 20000, 25000, 0, 0, 1, 25000, '2020-01-31', '2020-01-31 21:23:49', '2020-01-31 21:23:49', NULL),
(367, 1, 94, 16, 2500, 3000, 5, 150, 1, 3150, '2020-01-31', '2020-01-31 21:23:49', '2020-01-31 21:23:49', NULL),
(368, 1, 94, 15, 2000, 3000, 0, 0, 1, 3000, '2020-01-31', '2020-01-31 21:23:49', '2020-01-31 21:23:49', NULL),
(369, 1, 94, 14, 500, 1000, 0, 0, 1, 1000, '2020-01-31', '2020-01-31 21:23:49', '2020-01-31 21:23:49', NULL),
(370, 1, 94, 3, 5000, 6000, 10, 600, 1, 6600, '2020-01-31', '2020-01-31 21:23:49', '2020-01-31 21:23:49', NULL),
(371, 1, 94, 2, 500, 600, 0, 0, 1, 600, '2020-01-31', '2020-01-31 21:23:49', '2020-01-31 21:23:49', NULL),
(372, 1, 94, 1, 1000, 1200, 10, 120, 1, 1320, '2020-01-31', '2020-01-31 21:23:49', '2020-01-31 21:23:49', NULL),
(373, 1, 92, 3, 5000, 6000, 10, 600, 1, 6600, '2020-01-31', '2020-02-01 04:04:29', '2020-02-01 04:04:29', NULL),
(374, 1, 92, 10, 20000, 25000, 0, 0, 1, 25000, '2020-01-31', '2020-02-01 04:04:29', '2020-02-01 04:04:29', NULL),
(375, 1, 92, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-01-31', '2020-02-01 04:04:29', '2020-02-01 04:04:29', NULL),
(376, 1, 95, 2, 500, 600, 0, 0, 1, 600, '2020-02-01', '2020-02-01 08:14:27', '2020-02-01 08:14:27', NULL),
(377, 1, 96, 8, 10000, 12000, 10, 1200, 31, 409200, '2020-02-01', '2020-02-01 11:29:37', '2020-02-01 12:32:56', '2020-02-01 12:32:56'),
(378, 1, 96, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-02-01', '2020-02-01 12:32:56', '2020-02-01 12:32:56', '2020-02-01 12:32:56'),
(379, 1, 96, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-02-01', '2020-02-01 12:32:56', '2020-02-01 12:32:56', '2020-02-01 12:32:56'),
(380, 1, 96, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-02-01', '2020-02-01 12:32:56', '2020-02-01 12:32:56', '2020-02-01 12:32:56'),
(381, 1, 96, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-02-01', '2020-02-01 12:32:56', '2020-02-01 14:09:32', '2020-02-01 14:09:32'),
(382, 1, 96, 39, 40, 50, 0, 0, 1, 50, '2020-02-01', '2020-02-01 14:09:32', '2020-02-01 14:09:32', NULL),
(383, 1, 96, 43, 45, 50, 0, 0, 1, 50, '2020-02-01', '2020-02-01 14:09:32', '2020-02-01 14:09:32', NULL),
(384, 1, 96, 36, 150, 200, 0, 0, 1, 200, '2020-02-01', '2020-02-01 14:09:32', '2020-02-01 14:09:32', NULL),
(385, 1, 97, 17, 1000, 1500, 0, 0, 1, 1500, '2020-02-01', '2020-02-01 15:32:10', '2020-02-01 15:32:10', NULL),
(386, 1, 97, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-02-01', '2020-02-01 15:32:10', '2020-02-01 15:32:10', NULL),
(387, 1, 97, 2, 500, 600, 0, 0, 1, 600, '2020-02-01', '2020-02-01 15:32:10', '2020-02-01 15:32:10', NULL),
(388, 1, 98, 10, 20000, 25000, 0, 0, 1, 25000, '2020-02-01', '2020-02-01 16:46:48', '2020-02-01 17:57:58', '2020-02-01 17:57:58'),
(389, 1, 98, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-01', '2020-02-01 16:46:48', '2020-02-01 17:57:58', '2020-02-01 17:57:58'),
(390, 1, 98, 2, 500, 600, 0, 0, 1, 600, '2020-02-01', '2020-02-01 16:46:48', '2020-02-01 17:57:58', '2020-02-01 17:57:58'),
(391, 1, 98, 17, 1000, 1500, 0, 0, 1, 1500, '2020-02-01', '2020-02-01 17:57:58', '2020-02-01 17:57:58', NULL),
(392, 1, 98, 21, 2000, 3000, 5, 150, 1, 3150, '2020-02-01', '2020-02-01 17:57:58', '2020-02-01 17:57:58', NULL),
(393, 1, 98, 10, 20000, 25000, 0, 0, 1, 25000, '2020-02-01', '2020-02-01 17:57:58', '2020-02-01 17:57:58', NULL),
(394, 1, 98, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-01', '2020-02-01 17:57:58', '2020-02-01 17:57:58', NULL),
(395, 1, 98, 2, 500, 600, 0, 0, 1, 600, '2020-02-01', '2020-02-01 17:57:58', '2020-02-01 17:57:58', NULL),
(396, 2, 99, 3, 5000, 6000, 10, 600, 1, 6600, '2020-02-01', '2020-02-01 18:14:13', '2020-02-01 18:14:13', NULL),
(397, 2, 99, 2, 500, 600, 0, 0, 1, 600, '2020-02-01', '2020-02-01 18:14:13', '2020-02-01 18:14:13', NULL),
(398, 2, 99, 1, 1000, 1200, 10, 120, 1, 1320, '2020-02-01', '2020-02-01 18:14:13', '2020-02-01 18:14:13', NULL),
(399, 1, 100, 8, 10000, 12000, 10, 1200, 2, 26400, '2020-02-01', '2020-02-01 20:39:48', '2020-02-01 20:39:48', NULL),
(400, 1, 100, 3, 5000, 6000, 10, 600, 2, 13200, '2020-02-01', '2020-02-01 20:39:48', '2020-02-01 20:39:48', NULL),
(401, 1, 101, 17, 1000, 1500, 0, 0, 1, 1500, '2020-02-01', '2020-02-01 22:49:46', '2020-02-01 22:49:46', NULL),
(402, 1, 101, 14, 500, 1000, 0, 0, 1, 1000, '2020-02-01', '2020-02-01 22:49:46', '2020-02-01 22:49:46', NULL),
(403, 1, 102, 1, 1000, 1200, 10, 120, 1, 1320, '2020-02-01', '2020-02-01 23:25:17', '2020-02-01 23:25:17', NULL),
(404, 1, 102, 2, 500, 600, 0, 0, 1, 600, '2020-02-01', '2020-02-01 23:25:17', '2020-02-01 23:25:17', NULL),
(405, 1, 102, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-02-01', '2020-02-01 23:25:17', '2020-02-01 23:25:17', NULL),
(406, 1, 103, 21, 2000, 3000, 5, 150, 1, 3150, '2020-02-01', '2020-02-01 23:49:27', '2020-02-01 23:49:27', NULL),
(407, 1, 103, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-02-01', '2020-02-01 23:49:27', '2020-02-01 23:49:27', NULL),
(408, 1, 104, 7, 700, 500, 0, 0, 1, 500, '2020-02-01', '2020-02-02 01:41:41', '2020-02-02 01:41:41', NULL),
(409, 1, 104, 11, 2000, 2500, 0, 0, 1, 2500, '2020-02-01', '2020-02-02 01:41:41', '2020-02-02 01:41:41', NULL),
(410, 1, 104, 10, 20000, 25000, 0, 0, 1, 25000, '2020-02-01', '2020-02-02 01:41:41', '2020-02-02 01:41:41', NULL),
(411, 1, 104, 9, 10000, 11000, 0, 0, 1, 11000, '2020-02-01', '2020-02-02 01:41:41', '2020-02-02 01:41:41', NULL),
(412, 1, 105, 13, 1500, 2000, 0, 0, 1, 2000, '2020-02-01', '2020-02-02 03:05:00', '2020-02-02 03:06:14', '2020-02-02 03:06:14'),
(413, 1, 105, 13, 1500, 2000, 0, 0, 1, 2000, '2020-02-01', '2020-02-02 03:06:14', '2020-02-02 03:06:14', NULL),
(414, 1, 106, 19, 3000, 3500, 5, 175, 1, 3675, '2020-02-01', '2020-02-02 03:16:09', '2020-02-02 03:16:09', NULL),
(415, 1, 107, 19, 3000, 3500, 5, 175, 1, 3675, '2020-02-01', '2020-02-02 03:16:09', '2020-02-02 03:16:09', NULL),
(416, 1, 107, 20, 2000, 2500, 0, 0, 1, 2500, '2020-02-01', '2020-02-02 03:16:10', '2020-02-02 03:16:10', NULL),
(417, 1, 106, 20, 2000, 2500, 0, 0, 1, 2500, '2020-02-01', '2020-02-02 03:16:10', '2020-02-02 03:16:10', NULL),
(418, 1, 107, 21, 2000, 3000, 5, 150, 1, 3150, '2020-02-01', '2020-02-02 03:16:10', '2020-02-02 03:16:10', NULL),
(419, 1, 106, 21, 2000, 3000, 5, 150, 1, 3150, '2020-02-01', '2020-02-02 03:16:10', '2020-02-02 03:16:10', NULL),
(420, 1, 108, 11, 2000, 2500, 0, 0, 1, 2500, '2020-02-02', '2020-02-02 09:10:46', '2020-02-02 09:10:46', NULL),
(421, 1, 108, 10, 20000, 25000, 0, 0, 1, 25000, '2020-02-02', '2020-02-02 09:10:46', '2020-02-02 09:10:46', NULL),
(422, 1, 108, 9, 10000, 11000, 0, 0, 1, 11000, '2020-02-02', '2020-02-02 09:10:46', '2020-02-02 09:10:46', NULL),
(423, 1, 108, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-02-02', '2020-02-02 09:10:46', '2020-02-02 09:10:46', NULL),
(424, 1, 109, 11, 2000, 2500, 0, 0, 1, 2500, '2020-02-02', '2020-02-02 12:20:55', '2020-02-02 12:20:55', NULL),
(425, 1, 109, 4, 4000, 5000, 0, 0, 1, 5000, '2020-02-02', '2020-02-02 12:20:55', '2020-02-02 12:20:55', NULL),
(426, 1, 110, 3, 5000, 6000, 10, 600, 1, 6600, '2020-02-02', '2020-02-02 12:21:49', '2020-02-02 12:21:49', NULL),
(427, 1, 110, 2, 500, 600, 0, 0, 1, 600, '2020-02-02', '2020-02-02 12:21:49', '2020-02-02 12:21:49', NULL),
(428, 1, 111, 2, 500, 600, 0, 0, 2, 1200, '2020-02-02', '2020-02-02 12:54:44', '2020-02-02 12:54:44', NULL),
(429, 1, 112, 7, 700, 500, 0, 0, 1, 500, '2020-02-02', '2020-02-02 16:13:05', '2020-02-02 16:13:05', NULL),
(430, 1, 112, 9, 10000, 11000, 0, 0, 1, 11000, '2020-02-02', '2020-02-02 16:13:05', '2020-02-02 16:13:05', NULL),
(431, 1, 112, 3, 5000, 6000, 10, 600, 1, 6600, '2020-02-02', '2020-02-02 16:13:05', '2020-02-02 16:13:05', NULL),
(432, 1, 113, 36, 150, 200, 0, 0, 1, 200, '2020-02-02', '2020-02-02 16:14:20', '2020-02-02 16:14:20', NULL),
(433, 1, 113, 15, 2000, 3000, 0, 0, 1, 3000, '2020-02-02', '2020-02-02 16:14:20', '2020-02-02 16:14:20', NULL),
(434, 1, 113, 16, 2500, 3000, 5, 150, 1, 3150, '2020-02-02', '2020-02-02 16:14:20', '2020-02-02 16:14:20', NULL),
(435, 1, 113, 10, 20000, 25000, 0, 0, 1, 25000, '2020-02-02', '2020-02-02 16:14:20', '2020-02-02 16:14:20', NULL),
(436, 1, 113, 9, 10000, 11000, 0, 0, 1, 11000, '2020-02-02', '2020-02-02 16:14:20', '2020-02-02 16:14:20', NULL),
(437, 1, 114, 33, 1000, 1200, 5, 60, 1, 1260, '2020-02-02', '2020-02-02 20:12:49', '2020-02-02 20:12:49', NULL),
(438, 1, 114, 9, 10000, 11000, 0, 0, 1, 11000, '2020-02-02', '2020-02-02 20:12:49', '2020-02-02 20:12:49', NULL),
(439, 1, 114, 10, 20000, 25000, 0, 0, 1, 25000, '2020-02-02', '2020-02-02 20:12:49', '2020-02-02 20:12:49', NULL),
(440, 1, 114, 4, 4000, 5000, 0, 0, 1, 5000, '2020-02-02', '2020-02-02 20:12:49', '2020-02-02 20:12:49', NULL),
(441, 1, 114, 3, 5000, 6000, 10, 600, 12, 79200, '2020-02-02', '2020-02-02 20:12:49', '2020-02-02 20:12:49', NULL),
(442, 1, 115, 47, 2000, 2000, 22, 440, 1, 2440, '2020-02-02', '2020-02-02 21:04:51', '2020-02-02 21:04:51', NULL),
(443, 1, 116, 30, 1000, 1500, 5, 75, 1, 1575, '2020-02-02', '2020-02-02 21:32:54', '2020-02-02 21:32:54', NULL),
(444, 1, 116, 29, 1000, 1500, 0, 0, 1, 1500, '2020-02-02', '2020-02-02 21:32:54', '2020-02-02 21:32:54', NULL),
(445, 1, 116, 35, 150, 200, 0, 0, 1, 200, '2020-02-02', '2020-02-02 21:32:54', '2020-02-02 21:32:54', NULL),
(446, 1, 116, 20, 2000, 2500, 0, 0, 1, 2500, '2020-02-02', '2020-02-02 21:32:54', '2020-02-02 21:32:54', NULL),
(447, 1, 116, 19, 3000, 3500, 5, 175, 1, 3675, '2020-02-02', '2020-02-02 21:32:54', '2020-02-02 21:32:54', NULL),
(448, 1, 116, 31, 1500, 2000, 5, 100, 1, 2100, '2020-02-02', '2020-02-02 21:32:54', '2020-02-02 21:32:54', NULL),
(449, 1, 116, 32, 500, 800, 5, 40, 2, 1680, '2020-02-02', '2020-02-02 21:32:54', '2020-02-02 21:32:54', NULL),
(450, 1, 116, 26, 500, 800, 5, 40, 3, 2520, '2020-02-02', '2020-02-02 21:32:54', '2020-02-02 21:32:54', NULL);
INSERT INTO `sell_products` (`id`, `branch_id`, `sell_id`, `product_id`, `purchase_price`, `sell_price`, `tax_percentage`, `tax_amount`, `quantity`, `total_price`, `sell_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(451, 1, 116, 25, 500, 1000, 5, 50, 2, 2100, '2020-02-02', '2020-02-02 21:32:54', '2020-02-02 21:32:54', NULL),
(452, 1, 116, 7, 700, 500, 0, 0, 1, 500, '2020-02-02', '2020-02-02 21:32:54', '2020-02-02 21:32:54', NULL),
(453, 1, 116, 1, 1000, 1200, 10, 120, 1, 1320, '2020-02-02', '2020-02-02 21:32:54', '2020-02-02 21:32:54', NULL),
(454, 1, 117, 4, 4000, 5000, 0, 0, 4, 20000, '2020-02-02', '2020-02-02 22:03:20', '2020-02-02 22:03:20', NULL),
(455, 1, 118, 4, 4000, 5000, 0, 0, 4, 20000, '2020-02-02', '2020-02-02 22:03:20', '2020-02-02 22:03:20', NULL),
(456, 1, 118, 3, 5000, 6000, 10, 600, 1, 6600, '2020-02-02', '2020-02-02 22:03:20', '2020-02-02 22:03:20', NULL),
(457, 1, 117, 3, 5000, 6000, 10, 600, 1, 6600, '2020-02-02', '2020-02-02 22:03:20', '2020-02-02 22:03:20', NULL),
(458, 1, 118, 2, 500, 600, 0, 0, 1, 600, '2020-02-02', '2020-02-02 22:03:20', '2020-02-02 22:03:20', NULL),
(459, 1, 117, 2, 500, 600, 0, 0, 1, 600, '2020-02-02', '2020-02-02 22:03:20', '2020-02-02 22:03:20', NULL),
(460, 1, 118, 1, 1000, 1200, 10, 120, 1, 1320, '2020-02-02', '2020-02-02 22:03:20', '2020-02-02 22:03:20', NULL),
(461, 1, 117, 1, 1000, 1200, 10, 120, 1, 1320, '2020-02-02', '2020-02-02 22:03:20', '2020-02-02 22:03:20', NULL),
(462, 1, 119, 1, 1000, 1200, 10, 120, 1, 1320, '2020-02-02', '2020-02-02 22:55:47', '2020-02-02 22:55:47', NULL),
(463, 1, 120, 1, 1000, 1200, 10, 120, 1, 1320, '2020-02-02', '2020-02-02 23:55:32', '2020-02-02 23:55:32', NULL),
(464, 2, 121, 1, 1000, 1200, 10, 120, 1, 1320, '2020-02-02', '2020-02-02 23:56:31', '2020-02-02 23:56:31', NULL),
(465, 1, 122, 1, 1000, 1200, 10, 120, 1, 1320, '2020-02-03', '2020-02-03 07:09:22', '2020-02-03 07:09:22', NULL),
(466, 2, 123, 19, 3000, 3500, 5, 175, 1, 3675, '2020-02-03', '2020-02-03 11:54:18', '2020-02-03 11:54:18', NULL),
(467, 2, 123, 18, 2000, 3000, 10, 300, 1, 3300, '2020-02-03', '2020-02-03 11:54:18', '2020-02-03 11:54:18', NULL),
(468, 2, 123, 17, 1000, 1500, 0, 0, 1, 1500, '2020-02-03', '2020-02-03 11:54:18', '2020-02-03 11:54:18', NULL),
(469, 2, 123, 13, 1500, 2000, 0, 0, 1, 2000, '2020-02-03', '2020-02-03 11:54:18', '2020-02-03 11:54:18', NULL),
(470, 2, 123, 12, 1000, 500, 0, 0, 1, 500, '2020-02-03', '2020-02-03 11:54:18', '2020-02-03 11:54:18', NULL),
(471, 2, 123, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-03', '2020-02-03 11:54:18', '2020-02-03 11:54:18', NULL),
(472, 2, 123, 3, 5000, 6000, 10, 600, 1, 6600, '2020-02-03', '2020-02-03 11:54:18', '2020-02-03 11:54:18', NULL),
(473, 2, 123, 2, 500, 600, 0, 0, 1, 600, '2020-02-03', '2020-02-03 11:54:18', '2020-02-03 11:54:18', NULL),
(474, 1, 124, 9, 10000, 11000, 0, 0, 1, 11000, '2020-02-03', '2020-02-03 14:43:13', '2020-02-03 14:43:13', NULL),
(475, 1, 124, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-02-03', '2020-02-03 14:43:13', '2020-02-03 14:43:13', NULL),
(476, 1, 124, 7, 700, 500, 0, 0, 1, 500, '2020-02-03', '2020-02-03 14:43:13', '2020-02-03 14:43:13', NULL),
(477, 1, 124, 2, 500, 600, 0, 0, 1, 600, '2020-02-03', '2020-02-03 14:43:13', '2020-02-03 14:43:13', NULL),
(478, 1, 125, 9, 10000, 11000, 0, 0, 1, 11000, '2020-02-03', '2020-02-03 14:43:14', '2020-02-03 14:43:14', NULL),
(479, 1, 125, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-02-03', '2020-02-03 14:43:14', '2020-02-03 14:43:14', NULL),
(480, 1, 125, 7, 700, 500, 0, 0, 1, 500, '2020-02-03', '2020-02-03 14:43:14', '2020-02-03 14:43:14', NULL),
(481, 1, 125, 2, 500, 600, 0, 0, 1, 600, '2020-02-03', '2020-02-03 14:43:14', '2020-02-03 14:43:14', NULL),
(482, 1, 126, 9, 10000, 11000, 0, 0, 1, 11000, '2020-02-03', '2020-02-03 14:43:14', '2020-02-03 14:43:14', NULL),
(483, 1, 126, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-02-03', '2020-02-03 14:43:14', '2020-02-03 14:43:14', NULL),
(484, 1, 126, 7, 700, 500, 0, 0, 1, 500, '2020-02-03', '2020-02-03 14:43:14', '2020-02-03 14:43:14', NULL),
(485, 1, 126, 2, 500, 600, 0, 0, 1, 600, '2020-02-03', '2020-02-03 14:43:14', '2020-02-03 14:43:14', NULL),
(486, 1, 127, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-03', '2020-02-03 14:47:25', '2020-02-03 14:47:25', NULL),
(487, 1, 127, 12, 1000, 500, 0, 0, 1, 500, '2020-02-03', '2020-02-03 14:47:25', '2020-02-03 14:47:25', NULL),
(488, 1, 127, 9, 10000, 11000, 0, 0, 1, 11000, '2020-02-03', '2020-02-03 14:47:25', '2020-02-03 14:47:25', NULL),
(489, 1, 127, 2, 500, 600, 0, 0, 1, 600, '2020-02-03', '2020-02-03 14:47:25', '2020-02-03 14:47:25', NULL),
(490, 1, 128, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-03', '2020-02-03 14:47:31', '2020-02-03 14:47:31', NULL),
(491, 1, 128, 12, 1000, 500, 0, 0, 1, 500, '2020-02-03', '2020-02-03 14:47:31', '2020-02-03 14:47:31', NULL),
(492, 1, 128, 9, 10000, 11000, 0, 0, 1, 11000, '2020-02-03', '2020-02-03 14:47:31', '2020-02-03 14:47:31', NULL),
(493, 1, 128, 2, 500, 600, 0, 0, 1, 600, '2020-02-03', '2020-02-03 14:47:31', '2020-02-03 14:47:31', NULL),
(494, 1, 129, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-03', '2020-02-03 14:47:44', '2020-02-03 14:47:44', NULL),
(495, 1, 129, 12, 1000, 500, 0, 0, 1, 500, '2020-02-03', '2020-02-03 14:47:44', '2020-02-03 14:47:44', NULL),
(496, 1, 129, 9, 10000, 11000, 0, 0, 1, 11000, '2020-02-03', '2020-02-03 14:47:44', '2020-02-03 14:47:44', NULL),
(497, 1, 129, 2, 500, 600, 0, 0, 1, 600, '2020-02-03', '2020-02-03 14:47:44', '2020-02-03 14:47:44', NULL),
(498, 1, 130, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(499, 1, 130, 12, 1000, 500, 0, 0, 1, 500, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(500, 1, 130, 9, 10000, 11000, 0, 0, 1, 11000, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(501, 1, 130, 2, 500, 600, 0, 0, 1, 600, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(502, 1, 131, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(503, 1, 131, 12, 1000, 500, 0, 0, 1, 500, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(504, 1, 131, 9, 10000, 11000, 0, 0, 1, 11000, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(505, 1, 131, 2, 500, 600, 0, 0, 1, 600, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(506, 1, 132, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(507, 1, 132, 12, 1000, 500, 0, 0, 1, 500, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(508, 1, 132, 9, 10000, 11000, 0, 0, 1, 11000, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(509, 1, 132, 2, 500, 600, 0, 0, 1, 600, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(510, 1, 133, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(511, 1, 134, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(512, 1, 134, 12, 1000, 500, 0, 0, 1, 500, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(513, 1, 133, 12, 1000, 500, 0, 0, 1, 500, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(514, 1, 134, 9, 10000, 11000, 0, 0, 1, 11000, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(515, 1, 133, 9, 10000, 11000, 0, 0, 1, 11000, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(516, 1, 134, 2, 500, 600, 0, 0, 1, 600, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(517, 1, 133, 2, 500, 600, 0, 0, 1, 600, '2020-02-03', '2020-02-03 14:47:45', '2020-02-03 14:47:45', NULL),
(518, 1, 135, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-03', '2020-02-03 14:47:46', '2020-02-03 14:47:46', NULL),
(519, 1, 135, 12, 1000, 500, 0, 0, 1, 500, '2020-02-03', '2020-02-03 14:47:46', '2020-02-03 14:47:46', NULL),
(520, 1, 135, 9, 10000, 11000, 0, 0, 1, 11000, '2020-02-03', '2020-02-03 14:47:46', '2020-02-03 14:47:46', NULL),
(521, 1, 135, 2, 500, 600, 0, 0, 1, 600, '2020-02-03', '2020-02-03 14:47:46', '2020-02-03 14:47:46', NULL),
(522, 1, 136, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-03', '2020-02-04 01:18:58', '2020-02-04 01:18:58', NULL),
(523, 1, 136, 1, 1000, 1200, 10, 120, 6, 7920, '2020-02-03', '2020-02-04 01:18:58', '2020-02-04 01:18:58', NULL),
(524, 1, 137, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-03', '2020-02-04 03:27:15', '2020-02-04 03:27:15', NULL),
(525, 1, 137, 3, 5000, 6000, 10, 600, 2, 13200, '2020-02-03', '2020-02-04 03:27:15', '2020-02-04 03:27:15', NULL),
(526, 1, 138, 14, 500, 1000, 0, 0, 1, 1000, '2020-02-03', '2020-02-04 04:24:11', '2020-02-04 04:24:11', NULL),
(527, 1, 138, 15, 2000, 3000, 0, 0, 1, 3000, '2020-02-03', '2020-02-04 04:24:11', '2020-02-04 04:24:11', NULL),
(528, 1, 138, 10, 20000, 25000, 0, 0, 2, 50000, '2020-02-03', '2020-02-04 04:24:11', '2020-02-04 04:24:11', NULL),
(529, 1, 139, 3, 5000, 6000, 10, 600, 1, 6600, '2020-02-04', '2020-02-04 05:57:48', '2020-02-04 05:57:48', NULL),
(530, 1, 139, 6, 1500, 2000, 0, 0, 1, 2000, '2020-02-04', '2020-02-04 05:57:48', '2020-02-04 05:57:48', NULL),
(531, 1, 140, 17, 1000, 1500, 0, 0, 1, 1500, '2020-02-04', '2020-02-04 17:18:03', '2020-02-04 17:18:03', NULL),
(532, 1, 140, 11, 2000, 2500, 0, 0, 1, 2500, '2020-02-04', '2020-02-04 17:18:03', '2020-02-04 17:18:03', NULL),
(533, 1, 140, 3, 5000, 6000, 10, 600, 1, 6600, '2020-02-04', '2020-02-04 17:18:03', '2020-02-04 17:18:03', NULL),
(534, 1, 141, 14, 500, 1000, 0, 0, 1, 1000, '2020-02-04', '2020-02-04 19:24:08', '2020-02-04 19:24:08', NULL),
(535, 1, 141, 15, 2000, 3000, 0, 0, 1, 3000, '2020-02-04', '2020-02-04 19:24:08', '2020-02-04 19:24:08', NULL),
(536, 1, 141, 16, 2500, 3000, 5, 150, 1, 3150, '2020-02-04', '2020-02-04 19:24:08', '2020-02-04 19:24:08', NULL),
(537, 1, 141, 17, 1000, 1500, 0, 0, 1, 1500, '2020-02-04', '2020-02-04 19:24:08', '2020-02-04 19:24:08', NULL),
(538, 1, 141, 19, 3000, 3500, 5, 175, 1, 3675, '2020-02-04', '2020-02-04 19:24:08', '2020-02-04 19:24:08', NULL),
(539, 1, 141, 18, 2000, 6000, 10, 600, 1, 6600, '2020-02-04', '2020-02-04 19:24:08', '2020-02-04 19:24:08', NULL),
(540, 1, 141, 13, 1500, 8000, 0, 0, 1, 8000, '2020-02-04', '2020-02-04 19:24:08', '2020-02-04 19:24:08', NULL),
(541, 1, 141, 12, 1000, 500, 0, 0, 8, 4000, '2020-02-04', '2020-02-04 19:24:08', '2020-02-04 19:24:08', NULL),
(542, 1, 141, 11, 2000, 2500, 0, 0, 5, 12500, '2020-02-04', '2020-02-04 19:24:08', '2020-02-04 19:24:08', NULL),
(543, 1, 141, 7, 700, 500, 0, 0, 10, 5000, '2020-02-04', '2020-02-04 19:24:08', '2020-02-04 19:24:08', NULL),
(544, 1, 141, 6, 1500, 2000, 0, 0, 10, 20000, '2020-02-04', '2020-02-04 19:24:08', '2020-02-04 19:24:08', NULL),
(545, 1, 141, 5, 4000, 3000, 0, 0, 35, 105000, '2020-02-04', '2020-02-04 19:24:08', '2020-02-04 19:24:08', NULL),
(546, 1, 141, 3, 5000, 6000, 10, 600, 1, 6600, '2020-02-04', '2020-02-04 19:24:08', '2020-02-04 19:24:08', NULL),
(547, 1, 141, 2, 500, 600, 0, 0, 1, 600, '2020-02-04', '2020-02-04 19:24:09', '2020-02-04 19:24:09', NULL),
(548, 1, 141, 1, 1000, 1200, 10, 120, 1, 1320, '2020-02-04', '2020-02-04 19:24:09', '2020-02-04 19:24:09', NULL),
(549, 2, 142, 11, 2000, 2500, 0, 0, 1, 2500, '2020-02-04', '2020-02-04 20:31:05', '2020-02-04 20:31:05', NULL),
(550, 2, 142, 12, 1000, 500, 0, 0, 1, 500, '2020-02-04', '2020-02-04 20:31:05', '2020-02-04 20:31:05', NULL),
(551, 2, 142, 10, 20000, 25000, 0, 0, 1, 25000, '2020-02-04', '2020-02-04 20:31:05', '2020-02-04 20:31:05', NULL),
(552, 2, 142, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-04', '2020-02-04 20:31:05', '2020-02-04 20:31:05', NULL),
(553, 2, 142, 2, 500, 600, 0, 0, 1, 600, '2020-02-04', '2020-02-04 20:31:05', '2020-02-04 20:31:05', NULL),
(554, 2, 142, 3, 5000, 6000, 10, 600, 1, 6600, '2020-02-04', '2020-02-04 20:31:05', '2020-02-04 20:31:05', NULL),
(555, 2, 142, 1, 1000, 1200, 10, 120, 1, 1320, '2020-02-04', '2020-02-04 20:31:05', '2020-02-04 20:31:05', NULL),
(556, 1, 143, 2, 500, 600, 0, 0, 1, 600, '2020-02-04', '2020-02-04 21:56:22', '2020-02-04 21:56:22', NULL),
(557, 1, 144, 47, 2000, 2000, 22, 440, 1, 2440, '2020-02-04', '2020-02-05 00:10:04', '2020-02-05 00:10:04', NULL),
(558, 1, 144, 3, 5000, 6000, 10, 600, 2, 13200, '2020-02-04', '2020-02-05 00:10:04', '2020-02-05 00:10:04', NULL),
(559, 1, 144, 2, 500, 600, 0, 0, 1, 600, '2020-02-04', '2020-02-05 00:10:04', '2020-02-05 00:10:04', NULL),
(560, 1, 144, 1, 1000, 1200, 10, 120, 1, 1320, '2020-02-04', '2020-02-05 00:10:04', '2020-02-05 00:10:04', NULL),
(561, 1, 145, 2, 500, 600, 0, 0, 3, 1800, '2020-02-04', '2020-02-05 01:54:13', '2020-02-05 01:54:13', NULL),
(562, 1, 146, 2, 500, 600, 0, 0, 3, 1800, '2020-02-04', '2020-02-05 01:54:18', '2020-02-05 01:54:18', NULL),
(563, 2, 147, 19, 3000, 3500, 5, 175, 1, 3675, '2020-02-04', '2020-02-05 03:47:37', '2020-02-05 03:47:37', NULL),
(564, 2, 147, 17, 1000, 1500, 0, 0, 1, 1500, '2020-02-04', '2020-02-05 03:47:37', '2020-02-05 03:47:37', NULL),
(565, 1, 148, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-05', '2020-02-05 05:52:06', '2020-02-05 05:52:06', NULL),
(566, 1, 148, 3, 5000, 6000, 10, 600, 1, 6600, '2020-02-05', '2020-02-05 05:52:06', '2020-02-05 05:52:06', NULL),
(567, 1, 149, 21, 2000, 3000, 5, 150, 1, 3150, '2020-02-05', '2020-02-05 13:54:40', '2020-02-05 13:54:40', NULL),
(568, 1, 149, 11, 2000, 2500, 0, 0, 1, 2500, '2020-02-05', '2020-02-05 13:54:40', '2020-02-05 13:54:40', NULL),
(569, 1, 149, 10, 20000, 25000, 0, 0, 1, 25000, '2020-02-05', '2020-02-05 13:54:40', '2020-02-05 13:54:40', NULL),
(570, 1, 149, 9, 10000, 11000, 0, 0, 1, 11000, '2020-02-05', '2020-02-05 13:54:40', '2020-02-05 13:54:40', NULL),
(571, 1, 149, 2, 500, 600, 0, 0, 1, 600, '2020-02-05', '2020-02-05 13:54:40', '2020-02-05 13:54:40', NULL),
(572, 1, 149, 1, 1000, 1200, 10, 120, 1, 1320, '2020-02-05', '2020-02-05 13:54:40', '2020-02-05 13:54:40', NULL),
(573, 2, 150, 2, 500, 600, 0, 0, 2, 1200, '2020-02-05', '2020-02-05 15:23:37', '2020-02-05 15:23:37', NULL),
(574, 2, 150, 1, 1000, 1200, 10, 120, 2, 2640, '2020-02-05', '2020-02-05 15:23:37', '2020-02-05 15:23:37', NULL),
(575, 1, 151, 2, 500, 600, 0, 0, 1, 600, '2020-02-05', '2020-02-05 16:52:23', '2020-02-05 16:52:23', NULL),
(576, 1, 152, 48, 100, 120, 15, 18, 1, 138, '2020-02-05', '2020-02-05 17:51:01', '2020-02-05 17:51:01', NULL),
(577, 1, 152, 37, 100, 150, 0, 0, 2, 300, '2020-02-05', '2020-02-05 17:51:01', '2020-02-05 17:51:01', NULL),
(578, 1, 152, 39, 40, 50, 0, 0, 1, 50, '2020-02-05', '2020-02-05 17:51:01', '2020-02-05 17:51:01', NULL),
(579, 1, 152, 2, 500, 600, 0, 0, 1, 600, '2020-02-05', '2020-02-05 17:51:01', '2020-02-05 17:51:01', NULL),
(580, 1, 153, 8, 10000, 12000, 10, 1200, 1, 13200, '2020-02-05', '2020-02-05 21:56:28', '2020-02-05 21:56:28', NULL),
(581, 1, 154, 33, 1000, 1200, 5, 60, 1, 1260, '2020-02-05', '2020-02-05 22:18:52', '2020-02-05 22:18:52', NULL),
(582, 1, 155, 6, 1500, 2000, 0, 0, 1, 2000, '2020-02-05', '2020-02-05 10:13:01', '2020-02-05 10:13:01', NULL),
(583, 1, 155, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-05', '2020-02-05 10:13:01', '2020-02-05 10:13:01', NULL),
(584, 1, 155, 3, 5000, 6000, 10, 600, 1, 6600, '2020-02-05', '2020-02-05 10:13:01', '2020-02-05 10:13:01', NULL),
(585, 1, 156, 2, 500, 600, 0, 0, 1, 600, '2020-02-09', '2020-02-09 13:28:05', '2020-02-09 13:28:05', NULL),
(586, 1, 156, 3, 5000, 6000, 10, 600, 1, 6600, '2020-02-09', '2020-02-09 13:28:05', '2020-02-09 13:28:05', NULL),
(587, 1, 156, 5, 4000, 3000, 0, 0, 1, 3000, '2020-02-09', '2020-02-09 13:28:05', '2020-02-09 13:28:05', NULL),
(588, 1, 157, 2, 500, 600, 0, 0, 1, 600, '2020-02-13', '2020-02-13 14:14:52', '2020-02-13 14:14:52', NULL),
(589, 1, 157, 3, 5000, 6000, 10, 600, 1, 6600, '2020-02-13', '2020-02-13 14:14:52', '2020-02-13 14:14:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_key` varchar(191) NOT NULL,
  `option_value` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `option_key`, `option_value`, `created_at`, `updated_at`) VALUES
(1, 'app_name', 'ডেভ ইন টাইম', '2019-12-25 01:13:25', '2020-02-15 18:00:07'),
(2, 'app_language', 'en', '2019-12-25 01:13:25', '2020-02-13 05:13:01'),
(3, 'app_date_format', 'Y F, d', '2019-12-25 01:13:25', '2019-12-25 02:34:25'),
(4, 'app_timezone', 'Asia/Dhaka', '2019-12-25 01:13:25', '2020-02-03 01:08:16'),
(5, 'app_currency', '$', '2019-12-25 01:13:25', '2020-01-29 08:06:40'),
(6, 'product_sku_prefix', 'P-', '2019-12-25 01:13:25', '2019-12-25 01:13:25'),
(7, 'purchase_invoice_prefix', 'P-', '2019-12-25 01:13:25', '2019-12-25 01:13:25'),
(8, 'sell_invoice_prefix', 'S-', '2019-12-25 01:13:25', '2019-12-25 01:13:25'),
(9, 'requisition_id_prefix', 'R-', '2019-12-25 01:13:25', '2019-12-25 01:13:25'),
(10, 'expense_id_prefix', 'E-', '2019-12-25 01:13:25', '2019-12-25 01:13:25'),
(11, 'invoice_length', '6', '2019-12-25 01:13:25', '2019-12-25 01:13:25'),
(12, 'address', 'Your Company Address', '2019-12-25 01:13:25', '2019-12-25 01:13:25'),
(13, 'vat_reg_no', 'VAT-123 456 789', '2019-12-25 01:13:25', '2019-12-25 01:13:25'),
(14, 'default_customer', '1', '2019-12-25 01:13:26', '2019-12-25 01:13:26'),
(15, 'phone', '0123 456 789', '2019-12-25 01:13:26', '2019-12-25 01:13:26'),
(16, 'login_banner', 'uploads/settings\\CHY8g6KJjwZ53E5Lo67k.png', '2020-01-10 03:46:18', '2020-02-07 07:34:57'),
(17, 'app_fav_icon', 'uploads/settings\\v1jEIVGoDRB35WHHjizt.png', '2020-01-14 14:00:40', '2020-02-07 07:34:57'),
(18, 'app_logo', 'uploads/settings\\QCTRbEXWckyrHNF5IzVf.png', '2020-01-14 14:25:51', '2020-02-07 07:34:57');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_person` varchar(191) DEFAULT NULL,
  `company_name` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active,2=InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `contact_person`, `company_name`, `phone`, `email`, `address`, `logo`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ana Serrano', 'Supplier One', '6464729233', 'sakib@test.com', '5237 Red Cedar Rd', 'uploads/supplier\\IWd17eNreeZopz4wacuM.png', 1, '2019-12-25 02:23:51', '2019-12-26 10:42:08', NULL),
(2, 'ABC DEF', 'Supplier Two', '12326454', 'rakibuddin101@yandex.com', 'Address 1, Address 2', 'uploads/supplier\\l1E31ByWZhBbnUEbLeBg.png', 1, '2019-12-25 02:25:45', '2019-12-26 10:41:57', NULL),
(3, 'Rakib Uddin', 'Supplier Three', '9543412777', 'r@m.com', 'Address Line 1, Address Line 2', 'uploads/supplier\\EXqCRveR39d9HbYNXlJk.jpeg', 1, '2019-12-26 10:41:40', '2020-01-16 10:49:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `value` double NOT NULL COMMENT 'Percentage',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `title`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Zero  Tax', 0, '2019-12-25 01:40:33', '2019-12-25 01:40:33', NULL),
(2, 'Tax 5 %', 5, '2019-12-25 01:40:47', '2019-12-25 01:40:47', NULL),
(3, 'Tax 10 %', 10, '2019-12-25 01:41:00', '2019-12-25 01:41:00', NULL),
(4, 'Tax 15%', 15, '2019-12-25 11:09:01', '2019-12-25 11:09:01', NULL),
(5, '22', 22, '2020-01-31 13:43:22', '2020-02-02 21:04:01', '2020-02-02 21:04:01'),
(6, 'erere', 1, '2020-02-02 16:39:47', '2020-02-02 21:03:02', '2020-02-02 21:03:02'),
(7, 'GST', 15, '2020-02-05 16:44:39', '2020-02-05 16:44:39', NULL),
(8, 'dfgdffd', 10, '2020-02-05 10:12:48', '2020-02-05 10:12:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `completed_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=Pending 1=Complete 2=Cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `title`, `user_id`, `date`, `completed_date`, `status`, `created_at`, `updated_at`) VALUES
(20, 'sdfsdf3', 1, '2020-02-13', '2020-02-13', 1, '2020-02-13 14:04:53', '2020-02-13 14:12:32'),
(22, '800', 1, '2020-02-13', '2020-02-13', 1, '2020-02-13 14:05:51', '2020-02-13 14:13:24'),
(23, 'dfsdfsd', 1, '2020-02-13', '2020-02-13', 1, '2020-02-13 14:06:30', '2020-02-13 14:13:26'),
(25, 'fs', 1, '2020-02-13', '2020-02-13', 1, '2020-02-13 14:06:33', '2020-02-13 14:14:03'),
(27, 'dfgdf', 1, '2020-02-13', '2020-02-13', 1, '2020-02-13 14:14:08', '2020-02-13 14:15:23'),
(37, 'f', 1, '2020-02-13', '2020-02-13', 1, '2020-02-13 14:15:37', '2020-02-13 14:16:48'),
(52, 'f', 1, '2020-02-13', '2020-02-13', 1, '2020-02-13 14:15:43', '2020-02-13 14:16:49'),
(53, 'fsd', 1, '2020-02-13', '2020-02-14', 1, '2020-02-13 14:15:43', '2020-02-14 04:38:56'),
(54, 'fsdfs', 1, '2020-02-13', '2020-02-14', 1, '2020-02-13 14:15:43', '2020-02-14 04:38:57'),
(60, 'sdfdsf', 1, '2020-02-14', '2020-02-14', 1, '2020-02-14 04:56:20', '2020-02-14 05:00:09'),
(62, 'sf', 1, '2020-02-14', '2020-02-14', 1, '2020-02-14 04:56:21', '2020-02-14 05:00:11'),
(68, 'gdfg', 1, '2020-02-14', '2020-02-14', 1, '2020-02-14 05:27:30', '2020-02-14 05:28:13'),
(69, 'dfgdf', 1, '2020-02-14', '2020-02-14', 1, '2020-02-14 05:27:32', '2020-02-14 05:27:39'),
(70, 'dfgdf', 1, '2020-02-14', '2020-02-14', 1, '2020-02-14 05:27:33', '2020-02-14 05:27:39'),
(71, 'fdgdf', 1, '2020-02-14', '2020-02-14', 1, '2020-02-14 05:27:34', '2020-02-14 05:27:42'),
(72, 'fdgfd', 1, '2020-02-14', '2020-02-14', 1, '2020-02-14 05:27:35', '2020-02-14 05:27:45'),
(73, 'fdg', 1, '2020-02-14', '2020-02-14', 1, '2020-02-14 05:27:36', '2020-02-14 05:28:05'),
(74, 'gdfg', 1, '2020-02-14', '2020-02-14', 1, '2020-02-14 05:27:36', '2020-02-14 05:28:11'),
(75, 'gfd', 1, '2020-02-14', '2020-02-14', 1, '2020-02-14 05:27:37', '2020-02-14 05:28:09'),
(76, 'gfdgdf', 1, '2020-02-14', '2020-02-14', 1, '2020-02-14 05:27:37', '2020-02-14 05:28:10'),
(77, 'sdfsd', 1, '2020-02-14', '2020-02-15', 1, '2020-02-14 05:28:22', '2020-02-15 10:39:08'),
(78, 'dfgffdgfd', 1, '2020-02-14', '2020-02-15', 1, '2020-02-14 05:28:32', '2020-02-15 10:39:04'),
(79, 'dfgffdgfdgdf', 1, '2020-02-14', NULL, 0, '2020-02-14 05:28:33', '2020-02-14 05:28:33'),
(80, 'g', 1, '2020-02-14', '2020-02-15', 1, '2020-02-14 05:28:33', '2020-02-15 10:39:05'),
(81, 'gdf', 1, '2020-02-14', '2020-02-15', 1, '2020-02-14 05:28:33', '2020-02-15 10:39:05'),
(82, 'gdfg', 1, '2020-02-14', NULL, 0, '2020-02-14 05:28:34', '2020-02-14 05:28:34'),
(83, 'g', 1, '2020-02-14', NULL, 0, '2020-02-14 05:28:34', '2020-02-14 05:28:34'),
(84, 'g', 1, '2020-02-14', NULL, 0, '2020-02-14 05:28:34', '2020-02-14 05:28:34'),
(85, 'dg', 1, '2020-02-14', NULL, 0, '2020-02-14 05:28:34', '2020-02-14 05:28:34'),
(86, 'f', 1, '2020-02-14', NULL, 0, '2020-02-14 05:28:35', '2020-02-14 05:28:35'),
(87, 'fgfd', 1, '2020-02-14', NULL, 0, '2020-02-14 05:28:35', '2020-02-14 05:28:35'),
(88, 'fd', 1, '2020-02-14', NULL, 0, '2020-02-14 05:28:35', '2020-02-14 05:28:35'),
(89, 'gfd', 1, '2020-02-14', NULL, 0, '2020-02-14 05:28:36', '2020-02-14 05:28:36'),
(90, 'fd', 1, '2020-02-14', NULL, 0, '2020-02-14 05:28:36', '2020-02-14 05:28:36'),
(91, 'fdgfd', 1, '2020-02-14', NULL, 0, '2020-02-14 05:28:36', '2020-02-14 05:28:36'),
(92, 'g', 1, '2020-02-14', NULL, 0, '2020-02-14 05:28:37', '2020-02-14 05:28:37'),
(93, 'gdf', 1, '2020-02-14', NULL, 0, '2020-02-14 05:28:37', '2020-02-14 05:28:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `role` varchar(191) NOT NULL DEFAULT '1',
  `active_status` varchar(191) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `branch_id`, `name`, `email`, `role`, `active_status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'Admin', 'admin@example.com', '1', '1', NULL, '$2y$10$nrvO0C/iMqJlYz66GdeyIedpVCWfwH0cUzx6STJHnJJ9tJ6DG/v0C', NULL, '2019-12-25 01:13:25', '2020-02-02 21:06:17', NULL),
(2, 0, 'Branch Two', 'branch2@example.com', '1', '1', NULL, '$2y$10$24rNBDtYnb4D4WPl/lR.Tegzccz/rROb.v0A5tBNnfrfMNwSWz1WO', NULL, '2019-12-25 04:30:53', '2020-02-13 08:16:32', NULL),
(3, 0, 'Branch Three', 'branch3@example.com', '1', '1', NULL, '', NULL, '2019-12-26 02:08:12', '2020-02-13 08:16:18', NULL),
(4, 0, 'Md Ali Reza', 'sales@example.com', '1', '1', NULL, '$2y$10$C9mF9G.dD3w3YSN3LO4Zruafo3QoenR6p.aBB4Yd7BtII2jSIRYN6', NULL, '2019-12-26 02:50:21', '2020-02-13 08:16:12', NULL),
(5, 0, 'Fatema Jannat', 'fatema@test.com', '1', '1', NULL, '', NULL, '2019-12-26 02:58:19', '2020-02-13 08:16:02', NULL),
(6, 0, 'Rea', 'admin@exampdddle.com', '1', '0', NULL, '$2y$10$BuG9M4mIWnk7HvfvMGn87u6E0UyLXsC4wC11FD3xs2lyjHXfU2Fs2', NULL, '2020-01-15 11:00:53', '2020-02-13 08:15:53', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_phone_unique` (`phone`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_title_unique` (`title`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `designations_title_unique` (`title`);

--
-- Indexes for table `drafts`
--
ALTER TABLE `drafts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `draft_products`
--
ALTER TABLE `draft_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `expense_categories_name_unique` (`name`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_language_unique` (`language`),
  ADD UNIQUE KEY `languages_iso_code_unique` (`iso_code`);

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
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `payment_from_customers`
--
ALTER TABLE `payment_from_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_to_suppliers`
--
ALTER TABLE `payment_to_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisition_products`
--
ALTER TABLE `requisition_products`
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
-- Indexes for table `sells`
--
ALTER TABLE `sells`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sells_targets`
--
ALTER TABLE `sells_targets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell_products`
--
ALTER TABLE `sell_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_phone_unique` (`phone`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
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
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `drafts`
--
ALTER TABLE `drafts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `draft_products`
--
ALTER TABLE `draft_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_from_customers`
--
ALTER TABLE `payment_from_customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_to_suppliers`
--
ALTER TABLE `payment_to_suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_products`
--
ALTER TABLE `purchase_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requisitions`
--
ALTER TABLE `requisitions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requisition_products`
--
ALTER TABLE `requisition_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sells`
--
ALTER TABLE `sells`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sells_targets`
--
ALTER TABLE `sells_targets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sell_products`
--
ALTER TABLE `sell_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
