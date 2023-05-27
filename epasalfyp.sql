-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 08:31 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epasalfyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `confirm` enum('No','Yes') NOT NULL DEFAULT 'No',
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `type`, `vendor_id`, `mobile`, `email`, `password`, `image`, `confirm`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Rohan Shrestha', 'superadmin', 0, '9876543210', 'admin@admin.com', '$2y$10$5rFqtpk4Wcep.M1/NNJ/3uccrSS58xnrmX9VYMuJnIAlcnkSwJXk2', '71969.JPG', 'No', 1, NULL, '2023-03-07 05:30:10'),
(2, 'Rohan Shrestha', 'vendor', 1, '9876543210', 'john@admin.com', '$2a$12$ZF9RRjZR.64cHjCC9Ex8aeinPwXtf.b5kgS0XTNOdM8FMRuW6rXVK', '22295.JPG', 'No', 1, NULL, '2023-03-31 05:05:26'),
(3, 'Rojit Shrestha', 'vendor', 2, '9818252100', 'rojit@gmail.com', '$2y$10$59OkowJR52TsWquc7GNaoO1Gcyg2p7aVj.9NofeLsN/itH3bG3kxS', '', 'Yes', 1, '2023-03-31 11:39:28', '2023-03-31 05:57:57');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image`, `type`, `link`, `title`, `alt`, `status`, `created_at`, `updated_at`) VALUES
(1, 'banner-1.png', 'Slider', 'spring-collection', 'Spring Collection', 'Spring Collection', 1, NULL, '2023-03-08 12:59:41'),
(2, 'banner-2.png', 'Slider', 'overcoats', 'Overcoats', 'Overcoats', 1, NULL, '2023-03-08 13:23:00'),
(3, '77628.png', 'Fixed', 'test', 'test', 'test', 1, '2023-03-08 09:04:04', '2023-03-08 13:25:43'),
(4, '17935.png', 'Fixed', 'khalti', 'khalti', 'khalti', 1, '2023-03-08 13:25:22', '2023-03-08 13:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Puma', 1, NULL, '2023-03-06 01:11:08'),
(2, 'Champion', 1, NULL, '2023-03-10 10:38:02'),
(3, 'Under Armour', 1, NULL, '2023-03-11 02:30:59'),
(4, 'Samsung', 1, NULL, NULL),
(5, 'LG', 1, NULL, '2023-02-28 10:36:50'),
(6, 'Lenovo', 1, NULL, '2023-02-28 10:36:20'),
(7, 'MI', 1, NULL, '2023-02-28 10:36:49'),
(8, 'Others', 1, '2023-02-28 10:45:59', '2023-02-28 10:45:59'),
(9, 'Tommy Hilfiger', 1, '2023-03-15 05:18:34', '2023-03-15 05:18:34'),
(10, 'Linc', 1, '2023-05-01 15:58:38', '2023-05-01 15:58:38'),
(11, 'CG', 1, '2023-05-19 05:11:18', '2023-05-19 05:11:18');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `session_id`, `user_id`, `product_id`, `size`, `quantity`, `created_at`, `updated_at`) VALUES
(6, '76e6f75d235c3b1f18a34d0a670055f4', 0, 9, '128GB - 8GB', 7, '2023-04-07 04:20:44', '2023-04-07 04:21:18'),
(56, '5e66a8cf6faa9ee8623aef9ff16c6c6a', 1, 2, 'Large', 1, '2023-05-17 17:40:43', '2023-05-17 17:40:43'),
(60, '794f39b8805d62bdadb23c0ae70abd99', 2, 6, 'Medium', 1, '2023-05-22 11:56:51', '2023-05-22 11:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `category_discount` double(8,2) NOT NULL,
  `description` text DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `section_id`, `category_name`, `category_image`, `category_discount`, `description`, `url`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Men', '', 0.00, 'Welcome to the men\'s category of our online shopping website! Here, you can browse through our collection of high-quality clothing and accessories specifically designed for men. Our sellers have a wide range of stylish and comfortable options, including shirts, t-shirts, jeans, pants, shorts, jackets, shoes, and much more.', 'men', NULL, NULL, NULL, 1, NULL, '2023-03-14 07:24:15'),
(2, 0, 1, 'Women', '', 0.00, '', 'women', '', '', '', 1, NULL, '2023-02-27 05:24:04'),
(3, 0, 1, 'Kids', '', 0.00, '', 'kids', '', '', '', 1, NULL, '2023-03-07 07:11:30'),
(4, 0, 2, 'Mobiles', '', 0.00, NULL, 'mobiles', 'mobiles', 'mobiles', 'mobiles', 1, '2023-02-27 09:22:59', '2023-03-20 04:31:05'),
(5, 4, 2, 'Smartphones', '', 0.00, NULL, 'smartphones', 'smartphones', 'smartphones', 'smartphones', 1, '2023-02-28 03:49:14', '2023-03-20 04:30:44'),
(6, 1, 1, 'T-Shirts', '', 0.00, 'Welcome to the t-shirt subcategory of our online shopping website! Here, you can browse through our collection of stylish and comfortable t-shirts for men. We offer a wide range of designs and colors, from classic and simple styles to trendy and eye-catching prints. T-shirts from our sellers are made from high-quality materials, ensuring both comfort and durability.', 'tshirts', 'tshirts', 'tshirts', 'tshirts', 1, '2023-02-28 06:08:38', '2023-04-27 12:24:02'),
(7, 1, 1, 'Shirts', '', 0.00, NULL, 'shirts', NULL, NULL, NULL, 1, '2023-02-28 07:13:39', '2023-02-28 07:16:58'),
(8, 2, 1, 'Tops', '', 0.00, NULL, 'tops', 'tops', 'tops', 'tops', 1, '2023-02-28 07:18:33', '2023-02-28 07:18:33'),
(9, 0, 3, 'Refrigerators', '', 0.00, 'This is the refrigerators category.', 'refrigerators', 'Refrigerators', NULL, NULL, 1, '2023-03-07 07:27:40', '2023-03-07 07:27:40'),
(10, 0, 3, 'Office Supplies', '', 0.00, NULL, 'supplies', NULL, NULL, NULL, 1, '2023-05-01 15:57:16', '2023-05-04 11:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(2, 'AL', 'Albania', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(3, 'DZ', 'Algeria', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(4, 'DS', 'American Samoa', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(5, 'AD', 'Andorra', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(6, 'AO', 'Angola', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(7, 'AI', 'Anguilla', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(8, 'AQ', 'Antarctica', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(9, 'AG', 'Antigua and Barbuda', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(10, 'AR', 'Argentina', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(11, 'AM', 'Armenia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(12, 'AW', 'Aruba', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(13, 'AU', 'Australia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(14, 'AT', 'Austria', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(15, 'AZ', 'Azerbaijan', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(16, 'BS', 'Bahamas', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(17, 'BH', 'Bahrain', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(18, 'BD', 'Bangladesh', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(19, 'BB', 'Barbados', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(20, 'BY', 'Belarus', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(21, 'BE', 'Belgium', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(22, 'BZ', 'Belize', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(23, 'BJ', 'Benin', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(24, 'BM', 'Bermuda', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(25, 'BT', 'Bhutan', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(26, 'BO', 'Bolivia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(27, 'BA', 'Bosnia and Herzegovina', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(28, 'BW', 'Botswana', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(29, 'BV', 'Bouvet Island', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(30, 'BR', 'Brazil', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(31, 'IO', 'British Indian Ocean Territory', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(32, 'BN', 'Brunei Darussalam', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(33, 'BG', 'Bulgaria', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(34, 'BF', 'Burkina Faso', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(35, 'BI', 'Burundi', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(36, 'KH', 'Cambodia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(37, 'CM', 'Cameroon', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(38, 'CA', 'Canada', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(39, 'CV', 'Cape Verde', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(40, 'KY', 'Cayman Islands', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(41, 'CF', 'Central African Republic', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(42, 'TD', 'Chad', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(43, 'CL', 'Chile', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(44, 'CN', 'China', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(45, 'CX', 'Christmas Island', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(46, 'CC', 'Cocos (Keeling) Islands', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(47, 'CO', 'Colombia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(48, 'KM', 'Comoros', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(49, 'CD', 'Democratic Republic of the Congo', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(50, 'CG', 'Republic of Congo', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(51, 'CK', 'Cook Islands', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(52, 'CR', 'Costa Rica', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(53, 'HR', 'Croatia (Hrvatska)', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(54, 'CU', 'Cuba', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(55, 'CY', 'Cyprus', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(56, 'CZ', 'Czech Republic', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(57, 'DK', 'Denmark', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(58, 'DJ', 'Djibouti', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(59, 'DM', 'Dominica', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(60, 'DO', 'Dominican Republic', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(61, 'TP', 'East Timor', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(62, 'EC', 'Ecuador', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(63, 'EG', 'Egypt', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(64, 'SV', 'El Salvador', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(65, 'GQ', 'Equatorial Guinea', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(66, 'ER', 'Eritrea', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(67, 'EE', 'Estonia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(68, 'ET', 'Ethiopia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(69, 'FK', 'Falkland Islands (Malvinas)', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(70, 'FO', 'Faroe Islands', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(71, 'FJ', 'Fiji', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(72, 'FI', 'Finland', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(73, 'FR', 'France', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(74, 'FX', 'France, Metropolitan', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(75, 'GF', 'French Guiana', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(76, 'PF', 'French Polynesia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(77, 'TF', 'French Southern Territories', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(78, 'GA', 'Gabon', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(79, 'GM', 'Gambia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(80, 'GE', 'Georgia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(81, 'DE', 'Germany', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(82, 'GH', 'Ghana', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(83, 'GI', 'Gibraltar', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(84, 'GK', 'Guernsey', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(85, 'GR', 'Greece', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(86, 'GL', 'Greenland', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(87, 'GD', 'Grenada', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(88, 'GP', 'Guadeloupe', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(89, 'GU', 'Guam', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(90, 'GT', 'Guatemala', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(91, 'GN', 'Guinea', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(92, 'GW', 'Guinea-Bissau', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(93, 'GY', 'Guyana', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(94, 'HT', 'Haiti', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(95, 'HM', 'Heard and Mc Donald Islands', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(96, 'HN', 'Honduras', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(97, 'HK', 'Hong Kong', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(98, 'HU', 'Hungary', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(99, 'IS', 'Iceland', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(100, 'IN', 'India', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(101, 'IM', 'Isle of Man', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(102, 'ID', 'Indonesia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(103, 'IR', 'Iran (Islamic Republic of)', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(104, 'IQ', 'Iraq', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(105, 'IE', 'Ireland', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(106, 'IL', 'Israel', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(107, 'IT', 'Italy', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(108, 'CI', 'Ivory Coast', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(109, 'JE', 'Jersey', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(110, 'JM', 'Jamaica', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(111, 'JP', 'Japan', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(112, 'JO', 'Jordan', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(113, 'KZ', 'Kazakhstan', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(114, 'KE', 'Kenya', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(115, 'KI', 'Kiribati', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(116, 'KP', 'Korea, Democratic People\'s Republic of', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(117, 'KR', 'Korea, Republic of', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(118, 'XK', 'Kosovo', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(119, 'KW', 'Kuwait', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(120, 'KG', 'Kyrgyzstan', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(121, 'LA', 'Lao People\'s Democratic Republic', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(122, 'LV', 'Latvia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(123, 'LB', 'Lebanon', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(124, 'LS', 'Lesotho', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(125, 'LR', 'Liberia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(126, 'LY', 'Libyan Arab Jamahiriya', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(127, 'LI', 'Liechtenstein', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(128, 'LT', 'Lithuania', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(129, 'LU', 'Luxembourg', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(130, 'MO', 'Macau', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(131, 'MK', 'North Macedonia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(132, 'MG', 'Madagascar', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(133, 'MW', 'Malawi', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(134, 'MY', 'Malaysia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(135, 'MV', 'Maldives', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(136, 'ML', 'Mali', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(137, 'MT', 'Malta', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(138, 'MH', 'Marshall Islands', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(139, 'MQ', 'Martinique', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(140, 'MR', 'Mauritania', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(141, 'MU', 'Mauritius', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(142, 'TY', 'Mayotte', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(143, 'MX', 'Mexico', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(144, 'FM', 'Micronesia, Federated States of', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(145, 'MD', 'Moldova, Republic of', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(146, 'MC', 'Monaco', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(147, 'MN', 'Mongolia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(148, 'ME', 'Montenegro', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(149, 'MS', 'Montserrat', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(150, 'MA', 'Morocco', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(151, 'MZ', 'Mozambique', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(152, 'MM', 'Myanmar', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(153, 'NA', 'Namibia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(154, 'NR', 'Nauru', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(155, 'NP', 'Nepal', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(156, 'NL', 'Netherlands', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(157, 'AN', 'Netherlands Antilles', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(158, 'NC', 'New Caledonia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(159, 'NZ', 'New Zealand', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(160, 'NI', 'Nicaragua', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(161, 'NE', 'Niger', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(162, 'NG', 'Nigeria', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(163, 'NU', 'Niue', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(164, 'NF', 'Norfolk Island', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(165, 'MP', 'Northern Mariana Islands', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(166, 'NO', 'Norway', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(167, 'OM', 'Oman', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(168, 'PK', 'Pakistan', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(169, 'PW', 'Palau', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(170, 'PS', 'Palestine', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(171, 'PA', 'Panama', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(172, 'PG', 'Papua New Guinea', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(173, 'PY', 'Paraguay', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(174, 'PE', 'Peru', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(175, 'PH', 'Philippines', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(176, 'PN', 'Pitcairn', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(177, 'PL', 'Poland', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(178, 'PT', 'Portugal', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(179, 'PR', 'Puerto Rico', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(180, 'QA', 'Qatar', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(181, 'RE', 'Reunion', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(182, 'RO', 'Romania', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(183, 'RU', 'Russian Federation', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(184, 'RW', 'Rwanda', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(185, 'KN', 'Saint Kitts and Nevis', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(186, 'LC', 'Saint Lucia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(187, 'VC', 'Saint Vincent and the Grenadines', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(188, 'WS', 'Samoa', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(189, 'SM', 'San Marino', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(190, 'ST', 'Sao Tome and Principe', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(191, 'SA', 'Saudi Arabia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(192, 'SN', 'Senegal', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(193, 'RS', 'Serbia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(194, 'SC', 'Seychelles', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(195, 'SL', 'Sierra Leone', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(196, 'SG', 'Singapore', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(197, 'SK', 'Slovakia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(198, 'SI', 'Slovenia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(199, 'SB', 'Solomon Islands', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(200, 'SO', 'Somalia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(201, 'ZA', 'South Africa', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(202, 'GS', 'South Georgia South Sandwich Islands', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(203, 'SS', 'South Sudan', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(204, 'ES', 'Spain', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(205, 'LK', 'Sri Lanka', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(206, 'SH', 'St. Helena', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(207, 'PM', 'St. Pierre and Miquelon', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(208, 'SD', 'Sudan', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(209, 'SR', 'Suriname', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(210, 'SJ', 'Svalbard and Jan Mayen Islands', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(211, 'SZ', 'Eswatini', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(212, 'SE', 'Sweden', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(213, 'CH', 'Switzerland', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(214, 'SY', 'Syrian Arab Republic', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(215, 'TW', 'Taiwan', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(216, 'TJ', 'Tajikistan', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(217, 'TZ', 'Tanzania, United Republic of', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(218, 'TH', 'Thailand', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(219, 'TG', 'Togo', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(220, 'TK', 'Tokelau', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(221, 'TO', 'Tonga', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(222, 'TT', 'Trinidad and Tobago', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(223, 'TN', 'Tunisia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(224, 'TR', 'Turkey', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(225, 'TM', 'Turkmenistan', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(226, 'TC', 'Turks and Caicos Islands', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(227, 'TV', 'Tuvalu', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(228, 'UG', 'Uganda', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(229, 'UA', 'Ukraine', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(230, 'AE', 'United Arab Emirates', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(231, 'GB', 'United Kingdom', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(232, 'US', 'United States', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(233, 'UM', 'United States minor outlying islands', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(234, 'UY', 'Uruguay', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(235, 'UZ', 'Uzbekistan', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(236, 'VU', 'Vanuatu', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(237, 'VA', 'Vatican City State', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(238, 'VE', 'Venezuela', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(239, 'VN', 'Vietnam', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(240, 'VG', 'Virgin Islands (British)', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(241, 'VI', 'Virgin Islands (U.S.)', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(242, 'WF', 'Wallis and Futuna Islands', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(243, 'EH', 'Western Sahara', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(244, 'YE', 'Yemen', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(245, 'ZM', 'Zambia', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27'),
(246, 'ZW', 'Zimbabwe', 1, '2023-02-26 14:31:27', '2023-02-26 14:31:27');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `coupon_option` varchar(255) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `categories` text NOT NULL,
  `brands` text NOT NULL,
  `users` text NOT NULL,
  `coupon_type` varchar(255) NOT NULL,
  `amount_type` varchar(255) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `vendor_id`, `coupon_option`, `coupon_code`, `categories`, `brands`, `users`, `coupon_type`, `amount_type`, `amount`, `expiry_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Manual', 'test10', '1,6,7,2,8,3,4,5,9', '1,2,3,4,5,6,7,8,9', 'ramesh123@gmail.com,ankit@gmail.com,manish23@gmail.com,prajwal@gmail.com,saugat@gmail.com,rohanshrestha7007@gmail.com,ajay@gmail.com,manish@gmail.com,sangita@gmail.com,ratan@gmail.com', 'Single Time', 'Percentage', 8.00, '2023-05-22', 1, NULL, '2023-05-05 14:10:35'),
(2, 0, 'Manual', 'test20', '8', '1', 'sangita@gmail.com', 'Single Time', 'Percentage', 20.00, '2023-04-09', 1, NULL, '2023-04-08 13:36:28'),
(3, 0, 'Automatic', '0NUJHZZO', '1,6,7,2,8,3,4,5,9,10', '1,2,3,4,5,6,7,8,9,10', 'ramesh123@gmail.com,ankit@gmail.com,manish23@gmail.com,prajwal@gmail.com,saugat@gmail.com,rohanshrestha7007@gmail.com,ajay@gmail.com,manish@gmail.com,sangita@gmail.com,ratan@gmail.com', 'Multiple Times', 'Percentage', 10.00, '2023-05-31', 1, '2023-04-08 11:17:34', '2023-05-04 16:12:14'),
(4, 0, 'Manual', 'newyear', '1,6,7,2,8,3', '1,2,3,9', 'ankit@gmail.com,manish23@gmail.com,prajwal@gmail.com,saugat@gmail.com,rohanshrestha7007@gmail.com,sangita@gmail.com,ratan@gmail.com', 'Single Time', 'Percentage', 10.00, '2023-04-14', 1, '2023-04-08 11:19:38', '2023-04-13 03:03:03'),
(5, 0, 'Automatic', 'jodz2g24', '1,6,7', '1,2,3,4,5,6,7,8,9', 'ankit@gmail.com,manish23@gmail.com,prajwal@gmail.com,saugat@gmail.com,rohanshrestha7007@gmail.com,sangita@gmail.com,ratan@gmail.com', 'Single Time', 'Fixed', 100.00, '2023-04-30', 1, '2023-04-08 13:14:03', '2023-04-08 13:14:03'),
(6, 2, 'Manual', 'spring', '1,6,7,2,8,3', '1,2,3,9', '', 'Multiple Times', 'Percentage', 10.00, '2023-05-12', 1, '2023-04-12 08:39:10', '2023-04-12 08:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_addresses`
--

CREATE TABLE `delivery_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_addresses`
--

INSERT INTO `delivery_addresses` (`id`, `user_id`, `name`, `address`, `city`, `province`, `country`, `pincode`, `mobile`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ramesh Shrestha', 'Arjundhara-6', 'Birtamode', '1', 'Nepal', '57204', '9818253000', 1, NULL, '2023-04-15 03:20:23'),
(2, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', '2', 'Nepal', '44600', '9818253001', 1, NULL, '2023-05-05 14:02:30'),
(5, 2, 'Ankit Gupta', 'Ilam', 'Kanyam', '5', 'Nepal', '57300', '9818252200', 1, '2023-04-22 17:47:01', '2023-05-04 12:03:51'),
(7, 11, 'Netra Mahato', 'Nawalparasi', 'Kausutidanda', '7', 'Nepal', '45306', '9825259393', 1, '2023-05-18 09:12:45', '2023-05-19 06:30:53');

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
-- Table structure for table `khalti_payments`
--

CREATE TABLE `khalti_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `payer_id` varchar(255) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `khalti_payments`
--

INSERT INTO `khalti_payments` (`id`, `order_id`, `user_id`, `payment_id`, `payer_id`, `payer_email`, `amount`, `currency`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 21, 1, 'YUY4HCbnDYe6YuGemhZFEK', '1', 'Rohan Shrestha (9825934121)', 1000.00, 'Paisa', 'Completed', '2023-05-01 17:43:23', '2023-05-01 17:43:23'),
(2, 22, 1, 'spydRWDh9LS6oFAwVZcPiN', '1', 'Rohan Shrestha (9825934121)', 1000.00, 'Paisa', 'Completed', '2023-05-05 10:00:43', '2023-05-05 10:00:43'),
(3, 23, 1, 'demTacoUyT52wsPvrpUe5F', '1', 'Rohan Shrestha (9825934121)', 1000.00, 'Paisa', 'Completed', '2023-05-05 10:05:45', '2023-05-05 10:05:45'),
(4, 24, 1, 'kuuyD5b6zmZYvXwxTshQKn', '1', 'Rohan Shrestha (9825934121)', 1000.00, 'Paisa', 'Completed', '2023-05-05 10:18:57', '2023-05-05 10:18:57'),
(5, 24, 1, 'AQC2sNLicwEU2aQdJX4YXf', '1', 'Rohan Shrestha (9825934121)', 1000.00, 'Paisa', 'Completed', '2023-05-05 10:22:02', '2023-05-05 10:22:02'),
(6, 24, 1, '2WNxBA9oQyLNDF43qT9iLg', '1', 'Rohan Shrestha (9825934121)', 1000.00, 'Paisa', 'Completed', '2023-05-05 10:31:07', '2023-05-05 10:31:07'),
(7, 25, 1, 'oee2c8Nu4QMTAXZvDatEKg', '1', 'Rohan Shrestha (9825934121)', 1000.00, 'Paisa', 'Completed', '2023-05-05 10:37:02', '2023-05-05 10:37:02'),
(8, 27, 2, 'r9vKnSVdgQs83yA9VZ2CwQ', '2', 'Rohan Shrestha (9825934121)', 1000.00, 'Paisa', 'Completed', '2023-05-05 14:33:51', '2023-05-05 14:33:51'),
(9, 28, 2, 'ZXQaDHa8YUVnbTNMKQHWFZ', '2', 'Rohan Shrestha (9825934121)', 1000.00, 'Paisa', 'Completed', '2023-05-05 14:39:51', '2023-05-05 14:39:51'),
(10, 29, 2, 'VaAw9aQqfGjvW7ByZRXqxj', '2', 'Rohan Shrestha (9825934121)', 1000.00, 'Paisa', 'Completed', '2023-05-05 14:46:35', '2023-05-05 14:46:35'),
(11, 30, 1, 'FZu35oV2YR2giH2Fn3ahtf', '1', 'Rohan Shrestha (9825934121)', 1000.00, 'Paisa', 'Completed', '2023-05-05 17:13:21', '2023-05-05 17:13:21'),
(12, 31, 1, 'rZKoHNcM6RY9X3JwHKT7P2', '1', 'Rohan Shrestha (9825934121)', 1000.00, 'Paisa', 'Completed', '2023-05-05 18:08:25', '2023-05-05 18:08:25'),
(13, 32, 1, 'WEZrp87C3ZUpFSStSv5s8m', '1', 'Rohan Shrestha (9825934121)', 1000.00, 'Paisa', 'Completed', '2023-05-05 18:11:37', '2023-05-05 18:11:37'),
(14, 33, 1, 'qVokXrmZGQxzXWQhKLNKNc', '1', 'Rohan Shrestha (9825934121)', 1000.00, 'Paisa', 'Completed', '2023-05-05 18:13:06', '2023-05-05 18:13:06'),
(15, 34, 2, 'zPetm7WMnanF6j4exArXJW', '2', 'Rohan Shrestha (9825934121)', 1000.00, 'Paisa', 'Completed', '2023-05-05 18:20:46', '2023-05-05 18:20:46'),
(16, 35, 2, 'VgmMo4brXuJVn54XxmVd4D', '2', 'Rohan Shrestha (9825934121)', 1000.00, 'Paisa', 'Completed', '2023-05-05 18:27:07', '2023-05-05 18:27:07'),
(17, 37, 2, 'bsQS5ryQvnzXAvxRYepE4P', '2', 'Rohan Shrestha (9825934121)', 2000.00, 'Paisa', 'Completed', '2023-05-11 08:15:09', '2023-05-11 08:15:09'),
(18, 38, 2, 'ERCUAeqLNzv7zuiXQei5T9', '2', 'Rohan Shrestha (9825934121)', 2000.00, 'Paisa', 'Completed', '2023-05-11 09:21:18', '2023-05-11 09:21:18'),
(19, 39, 2, 'MZkYGWpTLfoUfvGDBnGXfC', '2', 'Rohan Shrestha (9825934121)', 2000.00, 'Paisa', 'Completed', '2023-05-11 09:27:51', '2023-05-11 09:27:51'),
(20, 40, 2, 'yJfijGXQaNkJYRe575cqYH', '2', 'Rohan Shrestha (9825934121)', 2000.00, 'Paisa', 'Completed', '2023-05-12 09:33:31', '2023-05-12 09:33:31'),
(21, 42, 1, 'YvhGGBSaxyiMjp7RtxRRXG', '1', 'Rohan Shrestha (9825934121)', 2000.00, 'Paisa', 'Completed', '2023-05-17 00:43:10', '2023-05-17 00:43:10'),
(22, 43, 11, 'Svb8MnEoNTqReERh4n3Q52', '11', 'Rohan Shrestha (9825934121)', 2000.00, 'Paisa', 'Completed', '2023-05-18 09:14:26', '2023-05-18 09:14:26'),
(23, 44, 11, 'MdJCHWywiHhkJ9MwQfHVWL', '11', 'Rohan Shrestha (9825934121)', 2000.00, 'Paisa', 'Completed', '2023-05-19 04:46:12', '2023-05-19 04:46:12'),
(24, 45, 11, 'Vt866UhkbZ6NpkJyzdxJwj', '11', 'Rohan Shrestha (9825934121)', 2000.00, 'Paisa', 'Completed', '2023-05-19 04:53:04', '2023-05-19 04:53:04'),
(25, 46, 11, 'TWMCPsPfUzJN59JJR2kTRQ', '11', 'Rohan Shrestha (9825934121)', 2000.00, 'Paisa', 'Completed', '2023-05-19 06:31:57', '2023-05-19 06:31:57');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_14_111920_create_vendors_table', 2),
(6, '2023_01_14_112900_create_admins_table', 3),
(7, '2023_01_25_092955_create_vendors_business_details_table', 4),
(8, '2023_01_27_064036_create_vendors_bank_details', 5),
(9, '2023_02_26_150601_create_sections_table', 6),
(10, '2023_02_27_075834_create_categories_table', 7),
(11, '2023_02_28_153233_create_brands_table', 8),
(12, '2023_03_01_103621_create_products_table', 9),
(13, '2023_03_06_092341_create_products_attributes_table', 10),
(14, '2023_03_07_065918_create_products_images_table', 11),
(15, '2023_03_07_134916_create_banners_table', 12),
(16, '2023_03_08_173816_update_banners_table', 13),
(17, '2023_03_12_164441_update_products_table', 14),
(18, '2023_03_15_165615_create_products_filters_table', 15),
(19, '2023_03_15_170028_create_products_filters_values_table', 16),
(20, '2023_03_20_154133_update_admins_table', 17),
(21, '2023_03_20_154818_update_vendors_table', 18),
(22, '2023_03_30_092917_create_recently_viewed_products_table', 19),
(23, '2023_03_30_151544_create_carts_table', 20),
(24, '2023_04_03_151728_add_columns_to_users', 21),
(25, '2023_04_08_075033_create_coupons_table', 22),
(26, '2023_04_08_161410_update_coupons_table', 23),
(27, '2023_04_13_120650_create_delivery_addresses_table', 24),
(28, '2023_04_18_081824_create_orders_table', 25),
(29, '2023_04_18_082737_create_orders_products_table', 26),
(30, '2023_04_20_101254_create_order_statuses_table', 27),
(31, '2023_04_20_121935_create_order_item_statuses_table', 28),
(32, '2023_04_20_123812_update_orders_products_table', 29),
(33, '2023_04_21_161512_create_orders_logs_table', 30),
(34, '2023_04_22_093132_update_orders_table', 31),
(35, '2023_04_22_105424_update_orders_products_table', 32),
(36, '2023_04_22_115848_update_orders_logs_table', 33),
(37, '2023_04_25_144115_create_payments_table', 34),
(38, '2023_05_01_210017_create_khalti_payments_table', 35);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `shipping_charges` double(8,2) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `coupon_amount` double(8,2) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_gateway` varchar(255) NOT NULL,
  `grand_total` double(8,2) NOT NULL,
  `courier_name` varchar(255) DEFAULT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `address`, `city`, `province`, `country`, `pincode`, `mobile`, `email`, `shipping_charges`, `coupon_code`, `coupon_amount`, `order_status`, `payment_method`, `payment_gateway`, `grand_total`, `courier_name`, `tracking_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ramesh Shrestha', 'Arjundhara-6', 'Birtamode', '1', 'Nepal', '57204', '9818253000', 'ramesh123@gmail.com', 0.00, 'test10', 272.00, 'Shipped', 'COD', 'COD', 3128.00, 'Fedex', '7878124', '2023-04-18 06:45:59', '2023-04-22 08:03:45'),
(2, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, 'test10', 3173.60, 'New', 'COD', 'COD', 36496.40, '', '', '2023-04-20 10:57:21', '2023-04-20 10:57:21'),
(3, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'New', 'COD', 'COD', 39670.00, '', '', '2023-04-20 11:02:52', '2023-04-20 11:02:52'),
(4, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, 'test10', 3188.00, 'New', 'COD', 'COD', 36662.00, '', '', '2023-04-20 11:07:46', '2023-04-20 11:07:46'),
(5, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, 'test10', 3080.00, 'New', 'COD', 'COD', 35420.00, NULL, NULL, '2023-04-22 17:20:54', '2023-04-22 17:20:54'),
(6, 2, 'Ankit Gupta', 'Ilam', 'Kanyam', 'Province 1', 'Nepal', '57300', '9818252200', 'ankit@gmail.com', 0.00, '0', 0.00, 'New', 'COD', 'COD', 1080.00, NULL, NULL, '2023-04-22 17:48:07', '2023-04-22 17:48:07'),
(7, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Pending', 'Prepaid', 'Paypal', 1170.00, NULL, NULL, '2023-04-24 16:23:09', '2023-04-24 16:23:09'),
(8, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Pending', 'Prepaid', 'Paypal', 1170.00, NULL, NULL, '2023-04-24 16:25:46', '2023-04-24 16:25:46'),
(9, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Pending', 'Prepaid', 'Paypal', 1170.00, NULL, NULL, '2023-04-24 16:27:29', '2023-04-24 16:27:29'),
(10, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Pending', 'Prepaid', 'Paypal', 1170.00, NULL, NULL, '2023-04-24 16:34:19', '2023-04-24 16:34:19'),
(11, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Pending', 'Prepaid', 'Paypal', 1170.00, NULL, NULL, '2023-04-25 10:40:13', '2023-04-25 10:40:13'),
(12, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Paid', 'Prepaid', 'Paypal', 1170.00, NULL, NULL, '2023-04-25 11:30:43', '2023-04-25 11:31:23'),
(13, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'New', 'COD', 'COD', 3780.00, NULL, NULL, '2023-04-26 11:22:03', '2023-04-26 11:22:03'),
(14, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'In Process', 'COD', 'COD', 1170.00, NULL, NULL, '2023-04-28 10:33:33', '2023-04-28 10:37:42'),
(15, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Pending', 'PayPal', 'Paypal', 1600.00, NULL, NULL, '2023-05-01 06:20:08', '2023-05-01 06:20:08'),
(16, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Pending', 'Khalti', 'Khalti', 1600.00, NULL, NULL, '2023-05-01 07:03:28', '2023-05-01 07:03:28'),
(17, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Pending', 'Khalti', 'Khalti', 1600.00, NULL, NULL, '2023-05-01 07:20:11', '2023-05-01 07:20:11'),
(18, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Pending', 'Khalti', 'Khalti', 10.00, NULL, NULL, '2023-05-01 16:15:01', '2023-05-01 16:15:01'),
(19, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Pending', 'Khalti', 'Khalti', 10.00, NULL, NULL, '2023-05-01 16:20:14', '2023-05-01 16:20:14'),
(20, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Pending', 'Khalti', 'Khalti', 10.00, NULL, NULL, '2023-05-01 16:35:00', '2023-05-01 16:35:00'),
(21, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 10.00, NULL, NULL, '2023-05-01 16:48:47', '2023-05-01 17:43:23'),
(22, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 10.00, NULL, NULL, '2023-05-05 09:59:55', '2023-05-05 10:00:43'),
(23, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 10.00, NULL, NULL, '2023-05-05 10:04:48', '2023-05-05 10:05:45'),
(24, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 10.00, NULL, NULL, '2023-05-05 10:18:10', '2023-05-05 10:31:07'),
(25, 1, 'Ramesh Shrestha', 'Arjundhara-6', 'Birtamode', '1', 'Nepal', '57204', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 10.00, NULL, NULL, '2023-05-05 10:36:06', '2023-05-05 10:37:02'),
(26, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', '2', 'Nepal', '44600', '9818253001', 'ramesh123@gmail.com', 0.00, '0NUJHZZO', 8.00, 'In Process', 'COD', 'COD', 72.00, NULL, NULL, '2023-05-05 14:03:07', '2023-05-05 14:06:04'),
(27, 2, 'Ankit Gupta', 'Ilam', 'Kanyam', '5', 'Nepal', '57300', '9818252200', 'ankit@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 60.00, NULL, NULL, '2023-05-05 14:32:42', '2023-05-05 14:33:51'),
(28, 2, 'Ankit Gupta', 'Ilam', 'Kanyam', '5', 'Nepal', '57300', '9818252200', 'ankit@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 30.00, NULL, NULL, '2023-05-05 14:38:26', '2023-05-05 14:39:51'),
(29, 2, 'Ankit Gupta', 'Ilam', 'Kanyam', '5', 'Nepal', '57300', '9818252200', 'ankit@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 60.00, NULL, NULL, '2023-05-05 14:45:56', '2023-05-05 14:46:35'),
(30, 1, 'Ramesh Shrestha', 'Arjundhara-6', 'Birtamode', '1', 'Nepal', '57204', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 50.00, NULL, NULL, '2023-05-05 17:12:41', '2023-05-05 17:13:21'),
(31, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', '2', 'Nepal', '44600', '9818253001', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 50.00, NULL, NULL, '2023-05-05 18:07:59', '2023-05-05 18:08:25'),
(32, 1, 'Ramesh Shrestha', 'Arjundhara-6', 'Birtamode', '1', 'Nepal', '57204', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 10.00, NULL, NULL, '2023-05-05 18:11:06', '2023-05-05 18:11:37'),
(33, 1, 'Ramesh Shrestha', 'Dillibazaar', 'Kathmandu', '2', 'Nepal', '44600', '9818253001', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 10.00, NULL, NULL, '2023-05-05 18:12:39', '2023-05-05 18:13:06'),
(34, 2, 'Ankit Gupta', 'Ilam', 'Kanyam', '5', 'Nepal', '57300', '9818252200', 'ankit@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 10.00, NULL, NULL, '2023-05-05 18:19:37', '2023-05-05 18:20:46'),
(35, 2, 'Ankit Gupta', 'Ilam', 'Kanyam', '5', 'Nepal', '57300', '9818252200', 'ankit@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 10.00, NULL, NULL, '2023-05-05 18:26:37', '2023-05-05 18:27:07'),
(36, 2, 'Ankit Gupta', 'Ilam', 'Kanyam', '5', 'Nepal', '57300', '9818252200', 'ankit@gmail.com', 0.00, '0', 0.00, 'Pending', 'Khalti', 'Khalti', 1350.00, NULL, NULL, '2023-05-11 08:10:34', '2023-05-11 08:10:34'),
(37, 2, 'Ankit Gupta', 'Ilam', 'Kanyam', '5', 'Nepal', '57300', '9818252200', 'ankit@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 20.00, NULL, NULL, '2023-05-11 08:14:39', '2023-05-11 08:15:09'),
(38, 2, 'Ankit Gupta', 'Ilam', 'Kanyam', '5', 'Nepal', '57300', '9818252200', 'ankit@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 20.00, NULL, NULL, '2023-05-11 09:20:50', '2023-05-11 09:21:18'),
(39, 2, 'Ankit Gupta', 'Ilam', 'Kanyam', '5', 'Nepal', '57300', '9818252200', 'ankit@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 20.00, NULL, NULL, '2023-05-11 09:27:22', '2023-05-11 09:27:51'),
(40, 2, 'Ankit Gupta', 'Ilam', 'Kanyam', '5', 'Nepal', '57300', '9818252200', 'ankit@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 20.00, NULL, NULL, '2023-05-12 09:32:52', '2023-05-12 09:33:31'),
(41, 1, 'Ramesh Shrestha', 'Arjundhara-6', 'Birtamode', '1', 'Nepal', '57204', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'New', 'COD', 'COD', 20.00, NULL, NULL, '2023-05-17 00:17:25', '2023-05-17 00:17:25'),
(42, 1, 'Ramesh Shrestha', 'Arjundhara-6', 'Birtamode', '1', 'Nepal', '57204', '9818253000', 'ramesh123@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 20.00, NULL, NULL, '2023-05-17 00:37:21', '2023-05-17 00:43:10'),
(43, 11, 'Netra Ram Mahato', 'Nawalparasi', 'Kausutidanda', 'Gandaki Province', 'Nepal', '45306', '9825259393', 'netramahato@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 20.00, NULL, NULL, '2023-05-18 09:13:15', '2023-05-18 09:14:26'),
(44, 11, 'Netra Ram Mahato', 'Nawalparasi', 'Kausutidanda', 'Gandaki Province', 'Nepal', '45306', '9825259393', 'netramahato@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 20.00, NULL, NULL, '2023-05-19 04:45:27', '2023-05-19 04:46:12'),
(45, 11, 'Netra Ram Mahato', 'Nawalparasi', 'Kausutidanda', 'Gandaki Province', 'Nepal', '45306', '9825259393', 'netramahato@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 20.00, NULL, NULL, '2023-05-19 04:52:35', '2023-05-19 04:53:04'),
(46, 11, 'Netra Mahato', 'Nawalparasi', 'Kausutidanda', '7', 'Nepal', '45306', '9825259393', 'netramahato@gmail.com', 0.00, '0', 0.00, 'Paid', 'Khalti', 'Khalti', 20.00, NULL, NULL, '2023-05-19 06:31:24', '2023-05-19 06:31:57');

-- --------------------------------------------------------

--
-- Table structure for table `orders_logs`
--

CREATE TABLE `orders_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_item_id` int(11) DEFAULT NULL,
  `order_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_logs`
--

INSERT INTO `orders_logs` (`id`, `order_id`, `order_item_id`, `order_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Shipped', '2023-04-22 06:55:06', '2023-04-22 06:55:06'),
(2, 1, NULL, 'Shipped', '2023-04-22 07:39:28', '2023-04-22 07:39:28'),
(3, 1, NULL, 'Shipped', '2023-04-22 08:03:45', '2023-04-22 08:03:45'),
(4, 1, 2, 'Shipped', '2023-04-22 08:10:30', '2023-04-22 08:10:30'),
(5, 1, 2, 'Shipped', '2023-04-22 12:28:11', '2023-04-22 12:28:11'),
(6, 14, NULL, 'In Process', '2023-04-28 10:37:42', '2023-04-28 10:37:42'),
(7, 26, NULL, 'In Process', '2023-05-05 14:06:04', '2023-05-05 14:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_price` double(8,2) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `item_status` varchar(255) DEFAULT NULL,
  `courier_name` varchar(255) DEFAULT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `user_id`, `vendor_id`, `admin_id`, `product_id`, `product_code`, `product_name`, `product_color`, `product_size`, `product_price`, `product_qty`, `item_status`, `courier_name`, `tracking_number`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 1, 6, 'SBS001', 'Sky Blue Shirt', 'Sky Blue', 'Medium', 1800.00, 1, 'Shipped', 'Fedex', '7878002', '2023-04-18 06:45:59', '2023-04-22 06:55:06'),
(2, 1, 1, 2, 3, 10, 'BPS001', 'Black Pocket Shirt', 'Black', 'Large', 1600.00, 1, 'Shipped', 'Aramex', '7878004', '2023-04-18 06:45:59', '2023-04-22 12:28:11'),
(3, 2, 1, 0, 1, 9, 'RN11P', 'Redmi Note Eleven Pro', 'Atlantic Blue', '128GB - 8GB', 38500.00, 1, NULL, '', '', '2023-04-20 10:57:21', '2023-04-20 10:57:21'),
(4, 2, 1, 0, 1, 2, 'RP001', 'Black Puma TShirt', 'Black', 'Large', 1170.00, 1, NULL, '', '', '2023-04-20 10:57:21', '2023-04-20 10:57:21'),
(5, 3, 1, 0, 1, 9, 'RN11P', 'Redmi Note Eleven Pro', 'Atlantic Blue', '128GB - 8GB', 38500.00, 1, NULL, '', '', '2023-04-20 11:02:52', '2023-04-20 11:02:52'),
(6, 3, 1, 0, 1, 2, 'RP001', 'Black Puma TShirt', 'Black', 'Large', 1170.00, 1, NULL, '', '', '2023-04-20 11:02:52', '2023-04-20 11:02:52'),
(7, 4, 1, 0, 1, 9, 'RN11P', 'Redmi Note Eleven Pro', 'Atlantic Blue', '128GB - 8GB', 38500.00, 1, NULL, '', '', '2023-04-20 11:07:46', '2023-04-20 11:07:46'),
(8, 4, 1, 0, 1, 3, 'CBT001', 'Champion Black TShirt', 'Black', 'Small', 1350.00, 1, NULL, '', '', '2023-04-20 11:07:46', '2023-04-20 11:07:46'),
(9, 5, 1, 0, 1, 9, 'RN11P', 'Redmi Note Eleven Pro', 'Atlantic Blue', '128GB - 8GB', 38500.00, 1, NULL, NULL, NULL, '2023-04-22 17:20:54', '2023-04-22 17:20:54'),
(10, 6, 2, 0, 1, 2, 'RP001', 'Black Puma TShirt', 'Black', 'Medium', 1080.00, 1, NULL, NULL, NULL, '2023-04-22 17:48:07', '2023-04-22 17:48:07'),
(11, 7, 1, 0, 1, 2, 'RP001', 'Black Puma TShirt', 'Black', 'Large', 1170.00, 1, NULL, NULL, NULL, '2023-04-24 16:23:09', '2023-04-24 16:23:09'),
(12, 8, 1, 0, 1, 2, 'RP001', 'Black Puma TShirt', 'Black', 'Large', 1170.00, 1, NULL, NULL, NULL, '2023-04-24 16:25:46', '2023-04-24 16:25:46'),
(13, 9, 1, 0, 1, 2, 'RP001', 'Black Puma TShirt', 'Black', 'Large', 1170.00, 1, NULL, NULL, NULL, '2023-04-24 16:27:29', '2023-04-24 16:27:29'),
(14, 10, 1, 0, 1, 2, 'RP001', 'Black Puma TShirt', 'Black', 'Large', 1170.00, 1, NULL, NULL, NULL, '2023-04-24 16:34:19', '2023-04-24 16:34:19'),
(15, 11, 1, 0, 1, 2, 'RP001', 'Black Puma TShirt', 'Black', 'Large', 1170.00, 1, NULL, NULL, NULL, '2023-04-25 10:40:13', '2023-04-25 10:40:13'),
(16, 12, 1, 0, 1, 2, 'RP001', 'Black Puma TShirt', 'Black', 'Large', 1170.00, 1, NULL, NULL, NULL, '2023-04-25 11:30:43', '2023-04-25 11:30:43'),
(17, 13, 1, 0, 1, 6, 'SBS001', 'Sky Blue Shirt', 'Sky Blue', 'Medium', 1800.00, 1, NULL, NULL, NULL, '2023-04-26 11:22:03', '2023-04-26 11:22:03'),
(18, 13, 1, 0, 1, 2, 'RP001', 'Black Puma TShirt', 'Black', 'Small', 990.00, 2, NULL, NULL, NULL, '2023-04-26 11:22:03', '2023-04-26 11:22:03'),
(19, 14, 1, 0, 1, 2, 'RP001', 'Black Puma TShirt', 'Black', 'Large', 1170.00, 1, NULL, NULL, NULL, '2023-04-28 10:33:33', '2023-04-28 10:33:33'),
(20, 15, 1, 2, 3, 10, 'BPS001', 'Black Pocket Shirt', 'Black', 'Large', 1600.00, 1, NULL, NULL, NULL, '2023-05-01 06:20:08', '2023-05-01 06:20:08'),
(21, 16, 1, 2, 3, 10, 'BPS001', 'Black Pocket Shirt', 'Black', 'Large', 1600.00, 1, NULL, NULL, NULL, '2023-05-01 07:03:28', '2023-05-01 07:03:28'),
(22, 17, 1, 2, 3, 10, 'BPS001', 'Black Pocket Shirt', 'Black', 'Large', 1600.00, 1, NULL, NULL, NULL, '2023-05-01 07:20:11', '2023-05-01 07:20:11'),
(23, 18, 1, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 10.00, 1, NULL, NULL, NULL, '2023-05-01 16:15:01', '2023-05-01 16:15:01'),
(24, 19, 1, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 10.00, 1, NULL, NULL, NULL, '2023-05-01 16:20:14', '2023-05-01 16:20:14'),
(25, 20, 1, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 10.00, 1, NULL, NULL, NULL, '2023-05-01 16:35:00', '2023-05-01 16:35:00'),
(26, 21, 1, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 10.00, 1, NULL, NULL, NULL, '2023-05-01 16:48:47', '2023-05-01 16:48:47'),
(27, 22, 1, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 10.00, 1, NULL, NULL, NULL, '2023-05-05 09:59:55', '2023-05-05 09:59:55'),
(28, 23, 1, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 10.00, 1, NULL, NULL, NULL, '2023-05-05 10:04:48', '2023-05-05 10:04:48'),
(29, 24, 1, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 10.00, 1, NULL, NULL, NULL, '2023-05-05 10:18:10', '2023-05-05 10:18:10'),
(30, 25, 1, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 10.00, 1, NULL, NULL, NULL, '2023-05-05 10:36:06', '2023-05-05 10:36:06'),
(31, 26, 1, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 10.00, 8, NULL, NULL, NULL, '2023-05-05 14:03:08', '2023-05-05 14:03:08'),
(32, 27, 2, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 10.00, 6, NULL, NULL, NULL, '2023-05-05 14:32:42', '2023-05-05 14:32:42'),
(33, 28, 2, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 10.00, 3, NULL, NULL, NULL, '2023-05-05 14:38:26', '2023-05-05 14:38:26'),
(34, 29, 2, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 10.00, 6, NULL, NULL, NULL, '2023-05-05 14:45:56', '2023-05-05 14:45:56'),
(35, 30, 1, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 10.00, 5, NULL, NULL, NULL, '2023-05-05 17:12:41', '2023-05-05 17:12:41'),
(36, 31, 1, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 10.00, 5, NULL, NULL, NULL, '2023-05-05 18:07:59', '2023-05-05 18:07:59'),
(37, 32, 1, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 10.00, 1, NULL, NULL, NULL, '2023-05-05 18:11:06', '2023-05-05 18:11:06'),
(38, 33, 1, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 10.00, 1, NULL, NULL, NULL, '2023-05-05 18:12:39', '2023-05-05 18:12:39'),
(39, 34, 2, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 10.00, 1, NULL, NULL, NULL, '2023-05-05 18:19:37', '2023-05-05 18:19:37'),
(40, 35, 2, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 10.00, 1, NULL, NULL, NULL, '2023-05-05 18:26:37', '2023-05-05 18:26:37'),
(41, 36, 2, 0, 1, 5, 'PBT001', 'Puma Blue TShirt', 'Blue', 'Medium', 1350.00, 1, NULL, NULL, NULL, '2023-05-11 08:10:34', '2023-05-11 08:10:34'),
(42, 37, 2, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 20.00, 1, NULL, NULL, NULL, '2023-05-11 08:14:39', '2023-05-11 08:14:39'),
(43, 38, 2, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 20.00, 1, NULL, NULL, NULL, '2023-05-11 09:20:50', '2023-05-11 09:20:50'),
(44, 39, 2, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 20.00, 1, NULL, NULL, NULL, '2023-05-11 09:27:22', '2023-05-11 09:27:22'),
(45, 40, 2, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 20.00, 1, NULL, NULL, NULL, '2023-05-12 09:32:52', '2023-05-12 09:32:52'),
(46, 41, 1, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 20.00, 1, NULL, NULL, NULL, '2023-05-17 00:17:25', '2023-05-17 00:17:25'),
(47, 42, 1, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 20.00, 1, NULL, NULL, NULL, '2023-05-17 00:37:21', '2023-05-17 00:37:21'),
(48, 43, 11, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 20.00, 1, NULL, NULL, NULL, '2023-05-18 09:13:15', '2023-05-18 09:13:15'),
(49, 44, 11, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 20.00, 1, NULL, NULL, NULL, '2023-05-19 04:45:27', '2023-05-19 04:45:27'),
(50, 45, 11, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 20.00, 1, NULL, NULL, NULL, '2023-05-19 04:52:35', '2023-05-19 04:52:35'),
(51, 46, 11, 0, 1, 11, 'PLBPP001', 'Pentonic Linc Ball Point Pen', 'Black', 'Regular', 20.00, 1, NULL, NULL, NULL, '2023-05-19 06:31:24', '2023-05-19 06:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `order_item_statuses`
--

CREATE TABLE `order_item_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_item_statuses`
--

INSERT INTO `order_item_statuses` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pending', 1, NULL, NULL),
(2, 'In Process', 1, NULL, NULL),
(3, 'Shipped', 1, NULL, NULL),
(4, 'Delivered', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'New', 1, NULL, NULL),
(2, 'Pending', 1, NULL, NULL),
(3, 'Cancelled', 1, NULL, NULL),
(4, 'In Process', 1, NULL, NULL),
(5, 'Shipped', 1, NULL, NULL),
(6, 'Partially Shipped', 1, NULL, NULL),
(7, 'Delivered', 1, NULL, NULL),
(8, 'Partially Delivered', 1, NULL, NULL),
(9, 'Paid', 1, NULL, NULL);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `payer_id` varchar(255) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `user_id`, `payment_id`, `payer_id`, `payer_email`, `amount`, `currency`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 11, 1, 'PAYID-MRD27PY58L19581YT046811A', 'KTGYHJEAB227L', 'sb-95g5y25746394@personal.example.com', 8.89, 'USD', 'approved', '2023-04-25 10:50:22', '2023-04-25 10:50:22'),
(2, 12, 1, 'PAYID-MRD3TYY6U3809951K2446723', 'KTGYHJEAB227L', 'sb-95g5y25746394@personal.example.com', 8.89, 'USD', 'approved', '2023-04-25 11:31:23', '2023-04-25 11:31:23');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_type` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `product_discount` float NOT NULL,
  `product_weight` int(11) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_video` varchar(255) DEFAULT NULL,
  `group_code` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `storage` varchar(255) DEFAULT NULL,
  `operating_system` varchar(255) DEFAULT NULL,
  `screen_size` varchar(255) DEFAULT NULL,
  `occasion` varchar(255) DEFAULT NULL,
  `fit_type` varchar(255) DEFAULT NULL,
  `pattern` varchar(255) DEFAULT NULL,
  `sleeve` varchar(255) DEFAULT NULL,
  `ram` varchar(255) DEFAULT NULL,
  `fabric` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `is_featured` enum('No','Yes') NOT NULL,
  `is_bestseller` enum('No','Yes') NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `section_id`, `category_id`, `brand_id`, `vendor_id`, `admin_id`, `admin_type`, `product_name`, `product_code`, `product_color`, `product_price`, `product_discount`, `product_weight`, `product_image`, `product_video`, `group_code`, `description`, `storage`, `operating_system`, `screen_size`, `occasion`, `fit_type`, `pattern`, `sleeve`, `ram`, `fabric`, `meta_title`, `meta_description`, `meta_keywords`, `is_featured`, `is_bestseller`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 5, 7, 0, 1, 'superadmin', 'Redmi Note Twelve', 'RN12', 'Matte Black', 30000, 10, 500, '88921.png', '', '', 'Introducing the Redmi Note 12 smartphone, the latest addition to our mobile phone collection! With advanced features and sleek design, this smartphone is perfect for both personal and professional use. Equipped with a powerful processor and ample storage, the Redmi Note 12 allows for smooth and efficient performance. The camera quality is outstanding, with high-resolution lenses capturing stunning photos and videos.', NULL, 'Android', '6.6 to 7 in', NULL, NULL, NULL, NULL, '8 GB', NULL, 'Redmi Note 12', 'Redmi Flagship Phone in Matte Black', 'smartphone, gaming, camera', 'Yes', 'Yes', 1, NULL, '2023-03-18 09:26:53'),
(2, 1, 6, 1, 0, 1, 'superadmin', 'Black Puma TShirt', 'RP001', 'Black', 1100, 10, 0, '30195.jpg', '35242.mp4', '100', 'Brand: Puma,\r\nStyle: Athletic T-shirt,\r\nColor: Red,\r\nMaterial: 100% cotton,\r\nFit: Regular fit,\r\nSleeve length: Short sleeve,\r\nNeckline: Crew neck,\r\nPrint/Logo: Puma logo on the chest,\r\nCare instructions: Machine wash cold, tumble dry low,\r\nAvailable sizes: Small, Medium, Large, X-Large, XX-Large', NULL, NULL, NULL, NULL, NULL, NULL, 'Half Sleeve', NULL, 'cotton', 'tshirt', 'Pure Cotton tshirt', 'cotton tshirt, red', 'Yes', 'Yes', 1, '2023-03-06 01:14:55', '2023-04-27 05:02:54'),
(3, 1, 6, 2, 0, 1, 'superadmin', 'Champion Black TShirt', 'CBT001', 'Black', 1500, 10, 0, '89479.jpg', NULL, '100', 'Style: Classic T-shirt,\r\nColor: Black,\r\nMaterial: 100% cotton,\r\nFit: Regular fit,\r\nSleeve length: Short sleeve,\r\nNeckline: Crew neck,\r\nPrint/Logo: Champion logo on the chest,\r\nCare instructions: Machine wash cold, tumble dry low\r\nAvailable sizes: Small, Medium, Large, X-Large, XX-Large', NULL, NULL, NULL, NULL, NULL, NULL, 'Half Sleeve', NULL, 'cotton', 'Champion\'s Black Tshirt', 'Champion\'s New Black Tshirt', 'tshirt, champion, black, pure cotton', 'Yes', 'Yes', 1, '2023-03-11 02:35:16', '2023-03-30 06:11:44'),
(4, 1, 6, 3, 0, 1, 'superadmin', 'Red Polo TShirt', 'UAP001', 'Red', 3000, 0, 0, '8675.png', NULL, '100', 'This is the new Under Armour\'s Red Polo TShirt.\r\nStyle: Polo T-shirt\r\nColor: Red\r\nMaterial: 100% cotton\r\nFit: Classic fit\r\nSleeve length: Short sleeve\r\nCollar type: Polo collar with two-button placket\r\nHemline: Straight hemline\r\nEmbroidery/Logo: Ralph Lauren Polo player logo on the left chest\r\nCare instructions: Machine wash cold, tumble dry low\r\nAvailable sizes: Small, Medium, Large, X-Large, XX-Large', NULL, NULL, NULL, NULL, NULL, NULL, 'Half Sleeve', NULL, 'Wool', 'Under Armour\'s Red Polo TShirt', 'New Under Armour\'s Red Polo TShirt', 'polo, tshirt, under armour, red', 'Yes', 'Yes', 1, '2023-03-11 02:39:33', '2023-03-30 06:11:54'),
(5, 1, 6, 1, 0, 1, 'superadmin', 'Puma Blue TShirt', 'PBT001', 'Blue', 1500, 10, 0, '18651.jpg', NULL, '', 'Style: Graphic T-shirt\r\nColor: Blue\r\nMaterial: 100% cotton\r\nFit: Regular fit\r\nSleeve length: Short sleeve\r\nNeckline: Crew neck\r\nPrint/Logo: Puma graphic logo on the chest\r\nCare instructions: Machine wash cold, tumble dry low\r\nAvailable sizes: Small, Medium, Large, X-Large, XX-Large', NULL, NULL, NULL, NULL, NULL, NULL, 'Half Sleeve', NULL, 'cotton', 'Puma\'s Blue Tshirt', 'New Puma\'s Blue Tshirt', 'tshirt, blue, puma, cotton', 'No', 'Yes', 1, '2023-03-11 02:52:14', '2023-03-18 09:25:31'),
(6, 1, 7, 3, 0, 1, 'superadmin', 'Sky Blue Shirt', 'SBS001', 'Sky Blue', 2000, 10, 100, '76200.jpg', NULL, '', 'This sky blue shirt is perfect for any casual occasion. It is made of pure cotton, which is a lightweight and breathable material that will keep you comfortable all day long. The shirt features a regular fit and short sleeves, making it easy to wear and move around in. The button-down collar and curved hemline give the shirt a classic look, while the chest pocket adds a touch of functionality. This shirt is available in a range of sizes from Small to XX-Large and can be machine washed and tumble dried for easy care.', NULL, NULL, NULL, NULL, NULL, NULL, 'Full Sleeve', NULL, 'Wool', 'Sky Blue Shirt', 'Casual Sky Blue Shirt', 'shirt, blue, sky blue, casual shirt', 'Yes', 'Yes', 1, '2023-03-13 10:10:09', '2023-03-18 09:25:46'),
(7, 1, 7, 9, 0, 1, 'superadmin', 'Green Casual Shirt', 'GCS001', 'Green', 3200, 0, 120, '5544.jpg', NULL, '', 'Style: Men\'s Faded Green Shirt,\r\nColor: Faded Green,\r\nMaterial: 60% Cotton, 40% Polyester,\r\nFit: Regular fit,\r\nSleeve length: Long sleeve,\r\nNeckline: Spread Collar,\r\nPrint/Logo: Solid color, no print or logo,\r\nCare instructions: Machine wash cold, tumble dry low,\r\nAvailable sizes: Small, Medium, Large, X-Large, XX-Large', NULL, NULL, NULL, NULL, NULL, NULL, 'Full Sleeve', NULL, 'Polyster', 'Men\'s Faded Green Shirt', 'Get comfortable and stylish with this Tommy Hilfiger faded green shirt. Made of a soft cotton-polyester blend, it features a regular fit, short sleeves, and spread collar. Available in sizes from Small to XX-Large. Machine washable. Shop now for Rs.2700..', 'shirt, green, tommy, Hilfiger', 'Yes', 'No', 1, '2023-03-15 05:30:35', '2023-03-18 09:26:02'),
(8, 1, 8, 1, 0, 1, 'superadmin', 'Blue Polo Top', 'BPT001', 'Blue', 2400, 0, 120, '80536.jpg', NULL, '', 'Product Name: Women\'s Blue Polo Top\r\nColor: Blue\r\nMaterial: 100% cotton\r\nSizes Available: XS, S, M, L, XL\r\nFit: Regular fit\r\nSleeve Type: Short sleeves\r\nNeckline: Polo collar with chain placket\r\nDesign Details: Ribbed cuffs, vented hem, embroidered logo on chest\r\nCare Instructions: Machine washable, do not bleach, tumble dry low, iron on low heat', NULL, NULL, NULL, NULL, NULL, NULL, 'Half Sleeve', NULL, 'Wool', 'Women\'s Blue Polo Top', 'Stay comfortable and stylish in our Women\'s Blue Polo Top, made from 100% pure cotton. Features a classic polo collar, short sleeves, ribbed cuffs, and vented hem. Available in XS to XL sizes, machine washable.', 'tops, polo, women, blue', 'Yes', 'Yes', 1, '2023-03-15 11:08:11', '2023-03-28 06:04:15'),
(9, 2, 5, 7, 0, 1, 'superadmin', 'Redmi Note Eleven Pro', 'RN11P', 'Atlantic Blue', 38500, 0, 202, '16113.jpg', NULL, '', NULL, NULL, 'Android', '6.6 to 7 in', NULL, NULL, NULL, NULL, '6 GB', NULL, NULL, NULL, NULL, 'Yes', 'No', 1, '2023-03-18 07:44:25', '2023-03-18 07:44:25'),
(10, 1, 7, 9, 2, 3, 'vendor', 'Black Pocket Shirt', 'BPS001', 'Black', 1500, 0, 100, '79968.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Half Sleeve', NULL, 'Wool', NULL, NULL, NULL, 'Yes', 'No', 1, '2023-03-31 07:32:20', '2023-03-31 07:32:20'),
(11, 3, 10, 10, 0, 1, 'superadmin', 'Pentonic Linc Ball Point Pen', 'PLBPP001', 'Black', 20, 0, 0, '51849.png', NULL, NULL, 'This is a Pentonic Linc Ball Point Pen for smooth and clear writing.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', 'No', 1, '2023-05-01 16:11:14', '2023-05-11 08:13:32'),
(12, 1, 1, 9, 0, 1, 'superadmin', 'Maroon Shirt Half', 'MS001', 'Maroon', 1100, 0, 50, '62627.jpg', NULL, NULL, 'The is new cotton Maroon shirt', NULL, NULL, NULL, NULL, NULL, NULL, 'Half Sleeve', NULL, 'cotton', NULL, NULL, NULL, 'Yes', 'No', 1, '2023-05-16 09:30:33', '2023-05-16 09:43:56'),
(13, 3, 9, 11, 0, 1, 'superadmin', 'CG Refrigerators One Seventy Liters', 'CGR170', 'Golden', 29000, 0, 35, '42468.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 'Yes', 1, '2023-05-19 05:15:49', '2023-05-19 05:15:49'),
(14, 3, 9, 4, 0, 1, 'superadmin', 'Samsung Refrigerator Double Door', 'SRDD001', 'Grey', 45000, 0, 35, '79502.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 'Yes', 1, '2023-05-19 05:24:33', '2023-05-19 05:24:33');

-- --------------------------------------------------------

--
-- Table structure for table `products_attributes`
--

CREATE TABLE `products_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `price` double(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_attributes`
--

INSERT INTO `products_attributes` (`id`, `product_id`, `size`, `price`, `stock`, `sku`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Small', 1100.00, 13, 'RP001-S', 1, '2023-03-06 08:47:55', '2023-04-27 05:47:19'),
(2, 2, 'Medium', 1200.00, 20, 'RP001-M', 1, '2023-03-06 08:47:55', '2023-04-27 05:47:19'),
(3, 2, 'Large', 1300.00, 14, 'RP001-L', 1, '2023-03-06 08:47:55', '2023-04-28 10:33:38'),
(4, 1, '64GB - 4GB', 30000.00, 100, 'RN12064', 1, '2023-03-19 08:20:35', '2023-03-19 08:20:35'),
(5, 1, '128GB - 8GB', 34000.00, 150, 'RN12128', 1, '2023-03-19 08:20:56', '2023-03-19 08:20:56'),
(6, 9, '128GB - 8GB', 38500.00, 100, 'RN11P1288', 1, '2023-03-19 09:45:54', '2023-03-28 05:31:53'),
(7, 3, 'Small', 1500.00, 50, 'CBT001-S', 1, '2023-03-19 10:33:55', '2023-03-19 10:33:55'),
(8, 4, 'Small', 3000.00, 100, 'UAP001-S', 1, '2023-03-19 10:34:52', '2023-03-19 10:34:52'),
(9, 4, 'Medium', 3000.00, 100, 'UAP001-M', 1, '2023-03-19 10:34:52', '2023-03-19 10:34:52'),
(10, 5, 'Small', 1500.00, 100, 'PBT001-S', 1, '2023-03-19 10:37:04', '2023-04-01 08:49:45'),
(11, 5, 'Medium', 1500.00, 100, 'PBT001-M', 1, '2023-03-19 10:37:04', '2023-04-01 08:49:45'),
(12, 5, 'Large', 1500.00, 3, 'PBT001-L', 1, '2023-03-19 10:37:04', '2023-04-01 08:50:28'),
(13, 6, 'Medium', 2000.00, 99, 'SBS001-M', 1, '2023-03-19 10:38:01', '2023-04-26 11:22:11'),
(14, 7, 'Medium', 3200.00, 100, 'GCS001-M', 1, '2023-03-19 10:38:23', '2023-03-19 10:38:23'),
(15, 8, 'Small', 2400.00, 50, 'BPT001-S', 1, '2023-03-28 06:03:42', '2023-03-28 06:03:42'),
(16, 8, 'Medium', 2500.00, 50, 'BPT001-M', 1, '2023-03-28 06:03:42', '2023-03-28 06:03:42'),
(17, 8, 'Large', 2600.00, 50, 'BPT001-L', 1, '2023-03-28 06:03:42', '2023-03-28 06:03:42'),
(18, 10, 'Small', 1500.00, 50, 'BPS001-S', 1, '2023-03-28 06:06:05', '2023-03-28 06:06:05'),
(19, 10, 'Medium', 1550.00, 50, 'BPS001-M', 1, '2023-03-28 06:06:05', '2023-03-28 06:06:05'),
(20, 10, 'Large', 1600.00, 50, 'BPS001-L', 1, '2023-03-28 06:06:05', '2023-03-28 06:06:05'),
(21, 11, 'Regular', 20.00, 71, 'PLBPP001-R', 1, '2023-05-01 16:13:58', '2023-05-19 06:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `products_filters`
--

CREATE TABLE `products_filters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_ids` varchar(255) NOT NULL,
  `filter_name` varchar(255) NOT NULL,
  `filter_column` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_filters`
--

INSERT INTO `products_filters` (`id`, `cat_ids`, `filter_name`, `filter_column`, `status`, `created_at`, `updated_at`) VALUES
(1, '1,6,7,2,8,3', 'Fabric', 'fabric', 1, '2023-03-18 00:53:30', '2023-03-18 00:53:30'),
(2, '4,5', 'RAM', 'ram', 1, '2023-03-18 00:54:20', '2023-03-18 00:54:20'),
(3, '1,6,7,2,8,3', 'Sleeve', 'sleeve', 1, '2023-03-18 01:02:27', '2023-03-18 01:02:27'),
(4, '1,6,7,2,8,3', 'Pattern', 'pattern', 1, '2023-03-18 01:02:40', '2023-03-18 01:02:40'),
(5, '1,6,7,2,8,3', 'Fit Type', 'fit_type', 1, '2023-03-18 01:07:50', '2023-03-18 01:07:50'),
(6, '1,6,7,2,8,3', 'Occasion', 'occasion', 1, '2023-03-18 01:08:49', '2023-03-18 01:08:49'),
(7, '4,5', 'Screen Size', 'screen_size', 1, '2023-03-18 01:42:35', '2023-03-18 01:42:35'),
(8, '4,5', 'Operating System', 'operating_system', 1, '2023-03-18 01:45:35', '2023-03-18 01:45:35'),
(9, '5', 'Storage', 'storage', 1, '2023-04-07 04:39:48', '2023-04-07 04:39:48'),
(10, '4,5', 'Storage', 'storage', 1, '2023-04-07 04:45:32', '2023-04-07 04:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `products_filters_values`
--

CREATE TABLE `products_filters_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filter_id` int(11) NOT NULL,
  `filter_value` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_filters_values`
--

INSERT INTO `products_filters_values` (`id`, `filter_id`, `filter_value`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'cotton', 1, '2023-03-18 01:38:17', '2023-03-18 01:38:24'),
(2, 1, 'Polyster', 1, '2023-03-18 01:38:59', '2023-03-18 01:38:59'),
(3, 1, 'Wool', 1, '2023-03-18 01:39:20', '2023-03-18 01:39:20'),
(4, 3, 'Full Sleeve', 1, '2023-03-18 01:40:09', '2023-03-18 01:40:09'),
(5, 3, 'Half Sleeve', 1, '2023-03-18 01:40:36', '2023-03-18 01:40:36'),
(6, 2, '4 GB', 1, '2023-03-18 01:41:21', '2023-03-18 01:41:21'),
(7, 2, '8 GB', 1, '2023-03-18 01:41:46', '2023-03-18 01:41:46'),
(8, 7, 'Up to 3.9 in', 1, '2023-03-18 01:43:31', '2023-03-18 01:43:31'),
(9, 7, '4 to 4.4 in', 1, '2023-03-18 01:44:08', '2023-03-18 01:44:08'),
(10, 8, 'Android', 1, '2023-03-18 01:45:51', '2023-03-18 01:45:51'),
(11, 8, 'iOS', 1, '2023-03-18 01:46:07', '2023-03-18 01:46:07'),
(12, 7, '4.5 to 4.9 in', 1, '2023-03-18 06:10:42', '2023-03-18 06:10:42'),
(13, 7, '5 to 5.4 in', 1, '2023-03-18 06:11:10', '2023-03-18 06:11:10'),
(14, 7, '5.5 to 6 in', 1, '2023-03-18 06:12:15', '2023-03-18 06:12:15'),
(15, 7, '6.1 to 6.5 in', 1, '2023-03-18 06:12:46', '2023-03-18 06:12:46'),
(16, 7, '6.6 to 7 in', 1, '2023-03-18 06:13:29', '2023-03-18 06:13:29'),
(17, 2, '6 GB', 1, '2023-03-18 06:14:20', '2023-03-18 06:14:20'),
(18, 2, '12 GB', 1, '2023-03-18 06:14:53', '2023-03-18 06:14:53'),
(19, 9, '64', 1, '2023-04-07 04:40:24', '2023-04-07 04:40:24'),
(20, 9, '128 GB', 1, '2023-04-07 04:40:50', '2023-04-07 04:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE `products_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`id`, `product_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'vansShirt1.jpg59403.jpg', 1, '2023-03-24 05:55:54', '2023-03-24 05:55:54'),
(2, 2, 'vansShirtBack.jpg43387.jpg', 1, '2023-03-24 05:55:55', '2023-03-24 05:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `recently_viewed_products`
--

CREATE TABLE `recently_viewed_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recently_viewed_products`
--

INSERT INTO `recently_viewed_products` (`id`, `product_id`, `session_id`, `created_at`, `updated_at`) VALUES
(1, 10, '4dac9ed764064bb2d4cdd867a842160e', NULL, NULL),
(2, 6, '4dac9ed764064bb2d4cdd867a842160e', NULL, NULL),
(3, 2, '4dac9ed764064bb2d4cdd867a842160e', NULL, NULL),
(4, 4, '4dac9ed764064bb2d4cdd867a842160e', NULL, NULL),
(5, 3, '4dac9ed764064bb2d4cdd867a842160e', NULL, NULL),
(6, 2, 'cad13c0059ad0799deef6827490fc2cb', NULL, NULL),
(7, 10, 'cad13c0059ad0799deef6827490fc2cb', NULL, NULL),
(8, 3, 'cad13c0059ad0799deef6827490fc2cb', NULL, NULL),
(9, 2, '032514d83f11ad592bb82a3518099cf9', NULL, NULL),
(10, 3, '032514d83f11ad592bb82a3518099cf9', NULL, NULL),
(11, 4, '33a27801fc118d86fe3d0de1d17811a6', NULL, NULL),
(12, 5, '33a27801fc118d86fe3d0de1d17811a6', NULL, NULL),
(13, 5, '0272997579c28f3b5e6dfff1ea190696', NULL, NULL),
(14, 6, '0272997579c28f3b5e6dfff1ea190696', NULL, NULL),
(15, 10, '0272997579c28f3b5e6dfff1ea190696', NULL, NULL),
(16, 10, '5b1a5257f19513beccd259ea09890457', NULL, NULL),
(17, 2, '64dc8a70d920a62d0aef07e8dc700d6b', NULL, NULL),
(18, 2, 'e141cb09ff8c9df7d1c123933eedea7d', NULL, NULL),
(19, 2, '57affb4b0b7866a58fddacd8f9832e82', NULL, NULL),
(20, 3, '57affb4b0b7866a58fddacd8f9832e82', NULL, NULL),
(21, 3, '0a362522a56ed55097b364e41cc0807c', NULL, NULL),
(22, 2, '0a362522a56ed55097b364e41cc0807c', NULL, NULL),
(23, 4, '0a362522a56ed55097b364e41cc0807c', NULL, NULL),
(24, 1, '76e6f75d235c3b1f18a34d0a670055f4', NULL, NULL),
(25, 9, '76e6f75d235c3b1f18a34d0a670055f4', NULL, NULL),
(26, 6, '89d0e5066fa94e6a2703fda6841b2169', NULL, NULL),
(27, 7, '89d0e5066fa94e6a2703fda6841b2169', NULL, NULL),
(28, 2, 'ea388ffa8aed7157a3649c329df15003', NULL, NULL),
(29, 2, '8f76d729640c3ae6215ab1706764b9e1', NULL, NULL),
(30, 6, '463f64997a6432c64b90da9c5468113a', NULL, NULL),
(31, 7, 'a848f40b9778f8735742e26cd620ba6f', NULL, NULL),
(32, 6, 'a848f40b9778f8735742e26cd620ba6f', NULL, NULL),
(33, 10, 'a848f40b9778f8735742e26cd620ba6f', NULL, NULL),
(34, 6, '2dcefdfbd66bc78ca8d9297b84c27023', NULL, NULL),
(35, 10, '2dcefdfbd66bc78ca8d9297b84c27023', NULL, NULL),
(36, 9, 'cdfd3b3c9d3a459b2545d9e12cada332', NULL, NULL),
(37, 2, 'cdfd3b3c9d3a459b2545d9e12cada332', NULL, NULL),
(38, 3, 'cdfd3b3c9d3a459b2545d9e12cada332', NULL, NULL),
(39, 9, '07afb0099690a5644aa7736db821b55b', NULL, NULL),
(40, 8, '07afb0099690a5644aa7736db821b55b', NULL, NULL),
(41, 2, '572800c7798c9a5c960753ffcd6b7599', NULL, NULL),
(42, 2, '4e644a672ad2d36674930c96b2afbe9e', NULL, NULL),
(43, 6, '4e644a672ad2d36674930c96b2afbe9e', NULL, NULL),
(44, 2, '50cc13092b08d3b51a0ef1835a64bf25', NULL, NULL),
(45, 2, '8ea873209bba08f3eadd160dc41f0b55', NULL, NULL),
(46, 8, '8ea873209bba08f3eadd160dc41f0b55', NULL, NULL),
(47, 5, '2125e0277fa85f53382e3f120a7e2aa9', NULL, NULL),
(48, 9, '2125e0277fa85f53382e3f120a7e2aa9', NULL, NULL),
(49, 2, 'e5a49a5ad8c7e2c7cc23e392f5a99659', NULL, NULL),
(50, 2, 'e5824be5f80301fc11b35386f2888f5b', NULL, NULL),
(51, 4, 'e5824be5f80301fc11b35386f2888f5b', NULL, NULL),
(52, 10, 'c9f2b54679b1dc1648f6e7ba7f2b23d7', NULL, NULL),
(53, 10, '9ecafde7f9e578ea9f1691c5db8d14be', NULL, NULL),
(54, 10, '04a6909bba9026f375185564741df080', NULL, NULL),
(55, 11, '23ca996f6576602cbdd7ea3a45e1dfd9', NULL, NULL),
(56, 11, '25c53b428ac32bd2c122094d1578b519', NULL, NULL),
(57, 8, 'e796cabf1610a278e3f369d34d7f47a7', NULL, NULL),
(58, 11, '58ea9bce4ef090ab1a73a806a515142e', NULL, NULL),
(59, 11, '828ced3ff441c8b17c56df969cdfa43f', NULL, NULL),
(60, 11, 'b6888c59b2b3503c811741e93b51fc44', NULL, NULL),
(61, 2, 'e1f90c1ec6113046425ca42037387f0e', NULL, NULL),
(62, 11, '5baac9282dcdf5ab7cdde833730140f7', NULL, NULL),
(63, 11, '35deb3f2123e544b90bb51c06131bbee', NULL, NULL),
(64, 11, 'ff31d36c4c19c01eafa7844ec5ac9540', NULL, NULL),
(65, 5, 'b65bc62cedfffc3544b8c7a119505656', NULL, NULL),
(66, 11, 'b65bc62cedfffc3544b8c7a119505656', NULL, NULL),
(67, 11, '6b894a5f8ff47c8b194fa74243745899', NULL, NULL),
(68, 12, '5714c2cc51378f8f1a914cd76202954d', NULL, NULL),
(69, 11, '5714c2cc51378f8f1a914cd76202954d', NULL, NULL),
(70, 11, '5b8c5a578bc0212777c88bbb057d8389', NULL, NULL),
(71, 3, '5e66a8cf6faa9ee8623aef9ff16c6c6a', NULL, NULL),
(72, 2, '5e66a8cf6faa9ee8623aef9ff16c6c6a', NULL, NULL),
(73, 11, '4faff831eb79ff7d5656d2a92a1e4c8a', NULL, NULL),
(74, 11, '0f6871dac5a2b23fb50d6d9ee7a43a07', NULL, NULL),
(75, 1, '359d07de91eca8196163f3db4068fe3b', NULL, NULL),
(76, 11, '359d07de91eca8196163f3db4068fe3b', NULL, NULL),
(77, 6, '794f39b8805d62bdadb23c0ae70abd99', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Clothing', 1, NULL, '2023-02-26 11:09:13'),
(2, 'Electronics', 1, NULL, '2023-02-26 11:09:13'),
(3, 'Appliances', 1, NULL, '2023-03-07 07:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `city`, `province`, `country`, `pincode`, `mobile`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ramesh Shrestha', 'Arjundhara-6', 'Jhapa', 'Province 1', 'Nepal', '57204', '9818253000', 'ramesh123@gmail.com', NULL, '$2y$10$/fWmdDLRMKyRyc4TCjUcLuhgVk/TYJgbEla2vDuY7AjCWWZmt672u', 1, NULL, '2023-01-21 05:32:33', '2023-05-05 14:15:07'),
(2, 'Ankit Gupta', 'Ilam', 'Kanyam', 'Province 1', 'Nepal', '57300', '9818252200', 'ankit@gmail.com', NULL, '$2y$10$gOaShYFRAwEnrIwoZEtsW.sr7.4qxkeIW5Rr35JeR6OwsVYnLE5GC', 1, NULL, '2023-04-03 10:26:11', '2023-04-06 07:45:13'),
(3, 'Manish Limbu', NULL, NULL, NULL, NULL, NULL, '9818252300', 'manish23@gmail.com', NULL, '$2y$10$QmiApqgN3hnwFNXzhtkBvek/xYfWNx368JbF.p0PsHsAe2sj2RvFC', 1, NULL, '2023-04-03 10:32:03', '2023-04-03 10:32:03'),
(4, 'Prajwal Tamang', NULL, NULL, NULL, NULL, NULL, '9818252400', 'prajwal@gmail.com', NULL, '$2y$10$lcC.TZusHTws96EsQI36/ufaQChzghqtZwTGazc.ZxyJtSag3thSy', 1, NULL, '2023-04-04 03:36:06', '2023-04-04 03:36:06'),
(5, 'Saugat Shrestha', NULL, NULL, NULL, NULL, NULL, '9818252500', 'saugat@gmail.com', NULL, '$2y$10$HYKD/7XSo4xKY4ZJKkW9DOR6VWiBKbHatuiV.y6ZGV1uGYOEC7l7a', 1, NULL, '2023-04-04 04:37:57', '2023-04-04 04:37:57'),
(6, 'Roman Shrestha', NULL, NULL, NULL, NULL, NULL, '9818252600', 'rohanshrestha7007@gmail.com', NULL, '$2y$10$2qY/GK9juOlRGjgupi0ade2bCuyPfOfPkfxmq0jCC0vPfwqYjr5Gm', 1, NULL, '2023-04-04 05:10:21', '2023-04-04 05:10:21'),
(7, 'Ajay Khanal', NULL, NULL, NULL, NULL, NULL, '9818252700', 'ajay@gmail.com', NULL, '$2y$10$Ufk9wVSgxXTCyC4MDh0t2../bN2PVLh6QhwdrzYGJh4RHc7h3wKCi', 1, NULL, '2023-04-04 10:10:43', '2023-04-13 06:10:01'),
(8, 'Manish Karki', NULL, NULL, NULL, NULL, NULL, '9818252800', 'manish@gmail.com', NULL, '$2y$10$BO.swmy60bhsrnPMcsntROxLPaSwjJuX4/Tz0r.E1BIQWaxaKIU6e', 1, NULL, '2023-04-04 10:19:35', '2023-04-13 06:09:59'),
(9, 'Sangita Shrestha', NULL, NULL, NULL, NULL, NULL, '9818252900', 'sangita@gmail.com', NULL, '$2y$10$Wz7mCb0/CzJF/E/3y7OJLO1Sx5UG4rLeR7CQfxttDBaZ/D0jYWffC', 1, NULL, '2023-04-04 11:17:43', '2023-04-04 11:18:03'),
(10, 'Ratan Bhandari', NULL, NULL, NULL, NULL, NULL, '9818253000', 'ratan@gmail.com', NULL, '$2y$10$PuveAgEErLCoNztDPIkbk.8Jn.63Ppg8qcXr8DUs4p2gsO.5oUv0K', 1, NULL, '2023-04-05 08:44:57', '2023-04-06 07:01:15'),
(11, 'Netra Ram Mahato', NULL, NULL, NULL, NULL, NULL, '9825259393', 'netramahato@gmail.com', NULL, '$2y$10$po9tLdnAKJb2ItjcR/8z.e5WS23rM.2rWSuRlvuBgeICAf2ix1EY2', 1, NULL, '2023-05-18 09:09:01', '2023-05-18 09:09:29'),
(12, 'Aayush Kandel', NULL, NULL, NULL, NULL, NULL, '9825593333', 'aayush@gmail.com', NULL, '$2y$10$d3Wn4TV6BJs3QndkSH.UL.bE/7Z/UySynIRVU/vee.XWfRC/X/I6G', 0, NULL, '2023-05-19 06:27:01', '2023-05-19 06:27:01'),
(13, 'Aayush Kandel', NULL, NULL, NULL, NULL, NULL, '9825259399', 'aayushkandel@gmail.com', NULL, '$2y$10$HVRWBR5jWTMUJ/VeS5nzd.QSALutldCCdVCVWG8JKcTsG.x84Gkpm', 0, NULL, '2023-05-19 06:28:42', '2023-05-19 06:28:42'),
(14, 'Aayush Kandel', NULL, NULL, NULL, NULL, NULL, '9888226666', 'aayush123@gmail.com', NULL, '$2y$10$OqJtSvpyqE.sC6NYO5SSOOYrrnVb2nm5.OZomvmFMIw7v.haGGcdS', 0, NULL, '2023-05-19 06:29:53', '2023-05-19 06:29:53'),
(15, 'Milan Shrestha', NULL, NULL, NULL, NULL, NULL, '9825936644', 'milan@gmail.com', NULL, '$2y$10$ijJxhvR8Zh8P21022HGx7O91R0cl3OWfjftnWma9jLwcYL0H.aUgy', 0, NULL, '2023-05-19 06:45:55', '2023-05-19 06:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `confirm` enum('No','Yes') NOT NULL DEFAULT 'No',
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `address`, `city`, `province`, `country`, `pincode`, `mobile`, `email`, `confirm`, `status`, `created_at`, `updated_at`) VALUES
(1, 'John Shrestha', 'New Road', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9700000123', 'john@admin.com', 'No', 1, NULL, '2023-03-31 05:05:26'),
(2, 'Rojit Shrestha', 'Birtamode, Jhapa', 'Birtamode', 'Province 1', 'Nepal', '57204', '9818252100', 'rojit@gmail.com', 'Yes', 1, '2023-03-31 11:39:28', '2023-03-31 05:57:57');

-- --------------------------------------------------------

--
-- Table structure for table `vendors_bank_details`
--

CREATE TABLE `vendors_bank_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `account_holder_name` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `bank_swift_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors_bank_details`
--

INSERT INTO `vendors_bank_details` (`id`, `vendor_id`, `account_holder_name`, `bank_name`, `account_number`, `bank_swift_code`, `created_at`, `updated_at`) VALUES
(1, 1, 'John Shrestha', 'Nabil Bank Ltd.', '0123450001234567', 'NARBNPKA001', NULL, '2023-02-09 02:11:36'),
(2, 2, 'Rojit Shrestha', 'Sunrise Bank Ltd.', '0123456700012345', 'SRBLNPKA001', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendors_business_details`
--

CREATE TABLE `vendors_business_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `shop_name` varchar(255) DEFAULT NULL,
  `shop_address` varchar(255) DEFAULT NULL,
  `shop_city` varchar(255) DEFAULT NULL,
  `shop_province` varchar(255) DEFAULT NULL,
  `shop_country` varchar(255) DEFAULT NULL,
  `shop_pincode` varchar(255) DEFAULT NULL,
  `shop_mobile` varchar(255) DEFAULT NULL,
  `shop_website` varchar(255) DEFAULT NULL,
  `shop_email` varchar(255) DEFAULT NULL,
  `address_proof` varchar(255) DEFAULT NULL,
  `address_proof_image` varchar(255) DEFAULT NULL,
  `business_license_number` varchar(255) DEFAULT NULL,
  `vat_number` varchar(255) DEFAULT NULL,
  `pan_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors_business_details`
--

INSERT INTO `vendors_business_details` (`id`, `vendor_id`, `shop_name`, `shop_address`, `shop_city`, `shop_province`, `shop_country`, `shop_pincode`, `shop_mobile`, `shop_website`, `shop_email`, `address_proof`, `address_proof_image`, `business_license_number`, `vat_number`, `pan_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'John Electronics World', 'Putalisadak', 'Kathmandu', 'Bagmati', 'Nepal', '44600', '9700000001', 'newegg.com', 'john@admin.com', 'PAN', '52101.jpg', '122334455', '234345456', '456567678', NULL, '2023-02-26 09:08:40'),
(2, 2, 'Rojit Clothing', 'Birtamode, Jhapa', 'Birtamode', 'Province 1', 'Nepal', '57204', '9818252100', NULL, NULL, 'Passport', '', '12341234', '2468000011', '12341234', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_addresses`
--
ALTER TABLE `delivery_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `khalti_payments`
--
ALTER TABLE `khalti_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_logs`
--
ALTER TABLE `orders_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item_statuses`
--
ALTER TABLE `order_item_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_attributes`
--
ALTER TABLE `products_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_filters`
--
ALTER TABLE `products_filters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_filters_values`
--
ALTER TABLE `products_filters_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recently_viewed_products`
--
ALTER TABLE `recently_viewed_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`);

--
-- Indexes for table `vendors_bank_details`
--
ALTER TABLE `vendors_bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors_business_details`
--
ALTER TABLE `vendors_business_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `delivery_addresses`
--
ALTER TABLE `delivery_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khalti_payments`
--
ALTER TABLE `khalti_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `orders_logs`
--
ALTER TABLE `orders_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `order_item_statuses`
--
ALTER TABLE `order_item_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products_attributes`
--
ALTER TABLE `products_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products_filters`
--
ALTER TABLE `products_filters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products_filters_values`
--
ALTER TABLE `products_filters_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recently_viewed_products`
--
ALTER TABLE `recently_viewed_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendors_bank_details`
--
ALTER TABLE `vendors_bank_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendors_business_details`
--
ALTER TABLE `vendors_business_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
