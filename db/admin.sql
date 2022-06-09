-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 02, 2020 at 03:58 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `frontend_menus`
--

DROP TABLE IF EXISTS `frontend_menus`;
CREATE TABLE IF NOT EXISTS `frontend_menus` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rand_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_bn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `url_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_link_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `parent_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontend_menus`
--

INSERT INTO `frontend_menus` (`id`, `rand_id`, `title_en`, `title_bn`, `sort_order`, `url_link`, `url_link_type`, `status`, `parent_id`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, '23v2DezVGF', 'About', '', 0, '', '', 1, '0', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(2, 'FjednMFjyw', 'About Us', '', 0, 'about', '1', 1, '23v2DezVGF', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(3, 'pXWqLbVKOZ', 'Why EEE', '', 1, '', '', 1, '23v2DezVGF', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(4, 'ZQvEGiyrkq', 'Achievements', '', 2, '', '', 1, '23v2DezVGF', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(5, 'sENkrwz8f6', 'Gallery', '', 3, 'more/gallery', '1', 1, '23v2DezVGF', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(6, '1mhj0Y774N', 'People', '', 1, '', '', 1, '0', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(7, 'zhPMRj5tqD', 'Faculty Present', '', 0, 'faculty', '1', 1, '1mhj0Y774N', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(8, '4jZZmxigyf', 'Faculty On Leave', '', 1, 'faculty/onleave', '1', 1, '1mhj0Y774N', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(9, 'n3ysMKgKHu', 'Academics', '', 2, '', '', 1, '0', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(10, 'oeOn46ywZi', 'Undergraduate', '', 0, '', '', 1, 'n3ysMKgKHu', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(11, 'xXxD0kEmuf', 'Admission', '', 0, 'http://ugadmission.buet.ac.bd/', '3', 1, 'oeOn46ywZi', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(12, 'cxeiU38JLi', 'Program', '', 1, 'undergraduateprogram', '2', 1, 'oeOn46ywZi', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(13, 'wrSEdqV6Zm', 'Rules & Regulations', '', 0, '202003090812_RULES AND REGULATIONS FOR UNDERGRADUATE PROGRAMME UNDER COURSE SYSTEM (1).pdf', '4', 1, 'cxeiU38JLi', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(14, 'VuKLxm1CX6', 'All Courses', '', 1, '202003090813_COURSES FOR UNDERGRADUATE ELECTRICAL AND ELECTRONIC ENGINEERING PROGRAMME (1).pdf', '4', 1, 'cxeiU38JLi', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(15, '19g3cCi3sx', 'Level-1/Term-1', '', 2, '202003090816_L1-T1.pdf', '4', 1, 'cxeiU38JLi', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(16, 'DZSWrKxnaB', 'Level-1/Term-2', '', 3, '202003090817_L1-T2.pdf', '4', 1, 'cxeiU38JLi', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(17, 'K6kEUgMkEf', 'Level-2/Term-1', '', 4, '202003090819_L2-T1.pdf', '4', 1, 'cxeiU38JLi', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(18, 'cLYjPmCxss', 'Level-2/Term-2', '', 5, '202003090819_L2-T2.pdf', '4', 1, 'cxeiU38JLi', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(19, 'UPeV2joQQL', 'Level-3/Term-1', '', 6, '202003090822_L3-T1.pdf', '4', 1, 'cxeiU38JLi', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(20, '4qoeTyGXpl', 'Level-3/Term-2', '', 7, '202003090823_L3-T2.pdf', '4', 1, 'cxeiU38JLi', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(21, 'QWC5Y0EoIL', 'Level-4', '', 8, '202003090824_Level 4.pdf', '4', 1, 'cxeiU38JLi', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(22, 'CTjEpxKmRb', 'Class Routine', '', 2, 'https://eeebuet.edupage.org/timetable/', '3', 1, 'oeOn46ywZi', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(23, 'edtMBX3lDy', 'Academic Calendar', '', 3, '202002240724_Undergraduate_Academic_Calendar_January_2020 (1).pdf', '4', 1, 'oeOn46ywZi', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(24, '8stkSWomOY', 'Postgraduate', '', 1, '', '', 1, 'n3ysMKgKHu', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(25, 'HeCFktWYlx', 'Admission', '', 0, '', '', 1, '8stkSWomOY', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(26, 'h0mAfk0NAO', 'Ordinance', '', 1, '', '', 1, '8stkSWomOY', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(27, 'zNIiTfrjZT', 'M.Sc./M.Engg.', '', 0, 'https://www.buet.ac.bd/web/AcademicInformation/OrdinanceMastersDegreeProgram', '3', 1, 'h0mAfk0NAO', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(28, 'c4Vojqcri1', 'Ph.D.', '', 1, 'https://www.buet.ac.bd/web/AcademicInformation/OrdinanceDegreeDocPhil', '3', 1, 'h0mAfk0NAO', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(29, 'x2OU2C0YMg', 'Class Routine', '', 2, 'postgraduate-class-routine', '2', 1, '8stkSWomOY', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(30, '290KlimprY', 'Academic Calendar', '', 3, '202002240717_Postgraduate_Academic_Calendar_October_2019 (1).pdf', '4', 1, '8stkSWomOY', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(31, 'zrescvjJi7', 'Courses', '', 4, 'postgraduatecourse', '2', 1, '8stkSWomOY', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(32, 'V0eLDLPHAk', 'Research', '', 3, 'cm91dGV0YW5qaW5zYXJrZXJtb3JlL3Jlc2VhcmNo', '', 1, '0', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(33, 'M0GWhkwkby', 'Research Areas', '', 0, 'more/research', '1', 1, 'V0eLDLPHAk', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(34, 'XXSS7UtKbo', 'Publications', '', 1, '', '5', 1, 'V0eLDLPHAk', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(35, 'mfYZBM9dpT', 'Journal Papers', '', 0, '', '', 1, 'XXSS7UtKbo', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(36, 'UZIWzpaVZt', 'Conference Papers', '', 1, '', '', 1, 'XXSS7UtKbo', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(37, 'SzHMkez2ql', 'Research Papers', '', 2, 'research-papers', '2', 1, 'XXSS7UtKbo', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(38, 'KiIcWK9qyx', 'Thesis', '', 2, 'more/research', '1', 1, 'V0eLDLPHAk', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(39, 'gZUuNssH9u', 'M.Sc. Thesis', '', 0, 'msc-eng-thesis', '2', 1, 'KiIcWK9qyx', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(40, 'KIr0g6bpWA', 'Ph.D. Thesis', '', 1, 'phd-thesis', '2', 1, 'KiIcWK9qyx', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(41, 'ENPj2vhO2D', 'BRTC', '', 4, '', '5', 1, '0', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(42, 'TbEkyGBYxC', 'General Information', '', 0, 'general-information', '2', 1, 'ENPj2vhO2D', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(43, '3a5FwNHiwm', 'Testing', '', 1, '', '', 1, 'ENPj2vhO2D', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(44, 'qN1pnaprX9', 'Services', '', 0, 'testing-services', '2', 1, '3a5FwNHiwm', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(45, 'S0lrOdCL6R', 'Getting Services', '', 1, 'getting-testing-services', '2', 1, '3a5FwNHiwm', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(46, 'WwI5g5X0Gg', 'Consultation', '', 2, '', '', 1, 'ENPj2vhO2D', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(47, 'dt153MXegt', 'Announcement', '', 5, '', '', 1, '0', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(48, 'jDbsD7rCXm', 'News and Events', '', 0, 'more/news/event', '1', 1, 'dt153MXegt', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(49, 'eF2hSogvbe', 'Notice Board', '', 1, 'all/notice', '1', 1, 'dt153MXegt', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03'),
(50, 'r3f8qo21w1', 'Contact', '', 6, 'contact_us', '1', 1, '0', NULL, NULL, '2020-03-16 08:42:03', '2020-03-16 08:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `home_links`
--

DROP TABLE IF EXISTS `home_links`;
CREATE TABLE IF NOT EXISTS `home_links` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_links`
--

INSERT INTO `home_links` (`id`, `name`, `url_link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Welcome to EEE', 'about', 1, NULL, NULL),
(2, 'Head of Department', 'more/message', 1, NULL, NULL),
(3, 'Faculty', 'faculty', 1, NULL, NULL),
(4, 'News', 'more/news/event', 1, NULL, NULL),
(5, 'Notice', 'all/notice', 1, NULL, NULL),
(6, 'Gallery', 'more/gallery', 1, NULL, NULL),
(7, 'Contact', 'contact_us', 1, NULL, NULL),
(8, 'Research', 'more/research', 1, NULL, NULL),
(9, 'Faculty On leave', 'faculty/onleave', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `icons`
--

DROP TABLE IF EXISTS `icons`;
CREATE TABLE IF NOT EXISTS `icons` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `icons`
--

INSERT INTO `icons` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'fa-copy', NULL, '2018-06-07 08:58:42', '2018-06-10 05:36:58'),
(2, 'ion-social-twitter', NULL, '2018-06-25 09:52:14', '2018-10-21 03:04:51'),
(12, 'ion-ionic', NULL, '2018-10-21 03:04:18', '2018-10-21 03:04:18'),
(13, 'ion-settings', NULL, '2018-11-15 01:00:22', '2018-11-15 01:00:22'),
(14, 'ion-person-stalker', NULL, '2018-11-15 05:08:11', '2018-11-15 05:08:11'),
(15, 'ion-cash', NULL, '2018-11-28 06:16:02', '2018-11-28 06:16:02'),
(16, 'ion-model-s', NULL, '2019-02-04 07:03:00', '2019-02-04 07:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `parent`, `route`, `sort`, `status`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Menu Management', 0, 'menu', 1, 1, '', '2018-05-16 03:20:43', '2018-12-31 21:16:50'),
(2, 'Menu List', 1, 'menu', 11, 1, '', '2018-05-16 04:03:04', '2018-05-16 04:03:04'),
(3, 'Menu Icon', 1, 'menu.icon', 12, 1, '', '2018-06-06 04:35:13', '2018-06-06 08:31:29'),
(4, 'Use Management', 0, 'user', 2, 1, '', '2018-06-09 04:29:53', '2019-08-05 04:54:46'),
(5, 'User Role', 4, 'user.role', 21, 1, '', '2018-06-09 04:57:27', '2019-08-05 04:55:35'),
(6, 'Menu Permission', 4, 'user.permission', 22, 1, '', '2018-06-05 06:59:51', '2019-08-05 04:56:15'),
(7, 'Profile Management', 0, 'project-management', 3, 1, '', NULL, NULL),
(23, 'Change Password', 7, 'profile-management.change.password', 15, 1, NULL, '2019-11-16 09:08:24', '2019-11-16 09:08:24'),
(35, 'Frontend Menu', 0, 'frontend-menu', 5, 1, NULL, '2019-12-01 05:34:46', '2019-12-01 05:34:46'),
(36, 'View Post', 35, 'frontend-menu.post.view', 1, 1, NULL, '2019-12-01 05:34:46', '2019-12-01 05:34:46'),
(37, 'View menu', 35, 'frontend-menu.menu.view', 2, 1, NULL, '2019-12-01 05:34:46', '2019-12-01 05:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `menu_permissions`
--

DROP TABLE IF EXISTS `menu_permissions`;
CREATE TABLE IF NOT EXISTS `menu_permissions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permitted_route` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_from` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=436 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_permissions`
--

INSERT INTO `menu_permissions` (`id`, `menu_id`, `role_id`, `permitted_route`, `menu_from`, `created_at`, `updated_at`) VALUES
(9, 5, 5, 'user.role', 'menu', '2019-11-05 22:51:45', '2019-11-05 22:51:45'),
(10, 4, 5, 'user', 'menu', '2019-11-05 22:51:45', '2019-11-05 22:51:45'),
(11, 6, 5, 'user.permission', 'menu', '2019-11-05 22:51:45', '2019-11-05 22:51:45'),
(432, 35, 19, 'frontend-menu', 'menu', '2020-01-21 05:55:34', '2020-01-21 05:55:34'),
(433, 36, 19, 'frontend-menu.post.view', 'menu', '2020-01-21 05:55:34', '2020-01-21 05:55:34'),
(434, 37, 19, 'frontend-menu.menu.view', 'menu', '2020-01-21 05:55:34', '2020-01-21 05:55:34');

-- --------------------------------------------------------

--
-- Table structure for table `menu_posts`
--

DROP TABLE IF EXISTS `menu_posts`;
CREATE TABLE IF NOT EXISTS `menu_posts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_routes`
--

DROP TABLE IF EXISTS `menu_routes`;
CREATE TABLE IF NOT EXISTS `menu_routes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(17, '2019_10_26_132331_create_roles_table', 20),
(58, '2019_12_02_062512_create_menu_posts_table', 34),
(57, '2019_12_02_062605_create_frontend_menus_table', 33),
(85, '2019_08_01_090751_create_site_settings_table', 35);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `role_slug` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `role_slug`, `status`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`) VALUES
(19, 'Developer', NULL, 'pIAuxT', 1, NULL, NULL, NULL, NULL, '2019-11-12 00:55:21', '2019-11-12 00:55:21'),
(18, 'Project Manager', NULL, 'WTle2y', 1, NULL, NULL, NULL, NULL, '2019-11-11 23:37:38', '2019-11-16 23:15:50'),
(21, 'Admin', NULL, 'U1BTEj', 1, NULL, NULL, NULL, NULL, '2019-11-14 05:32:17', '2019-11-14 05:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_name` text COLLATE utf8mb4_unicode_ci,
  `site_title` text COLLATE utf8mb4_unicode_ci,
  `site_title_bn` text COLLATE utf8mb4_unicode_ci,
  `site_short_description` text COLLATE utf8mb4_unicode_ci,
  `site_short_description_bn` text COLLATE utf8mb4_unicode_ci,
  `site_header_logo` text COLLATE utf8mb4_unicode_ci,
  `site_footer_logo` text COLLATE utf8mb4_unicode_ci,
  `site_favicon` text COLLATE utf8mb4_unicode_ci,
  `site_banner_image` text COLLATE utf8mb4_unicode_ci,
  `site_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_phone_primary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_phone_secondary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_address` text COLLATE utf8mb4_unicode_ci,
  `mail_driver` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_host` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_port` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_encryption` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` text COLLATE utf8mb4_unicode_ci,
  `twitter_url` text COLLATE utf8mb4_unicode_ci,
  `google_plus_url` text COLLATE utf8mb4_unicode_ci,
  `linkedin_url` text COLLATE utf8mb4_unicode_ci,
  `youtube_url` text COLLATE utf8mb4_unicode_ci,
  `instagram_url` text COLLATE utf8mb4_unicode_ci,
  `pinterest_url` text COLLATE utf8mb4_unicode_ci,
  `tumblr_url` text COLLATE utf8mb4_unicode_ci,
  `flickr_url` text COLLATE utf8mb4_unicode_ci,
  `recaptcha_key` text COLLATE utf8mb4_unicode_ci,
  `recaptcha_secret` text COLLATE utf8mb4_unicode_ci,
  `facebook_key` text COLLATE utf8mb4_unicode_ci,
  `facebook_secret` text COLLATE utf8mb4_unicode_ci,
  `twitter_key` text COLLATE utf8mb4_unicode_ci,
  `twitter_secret` text COLLATE utf8mb4_unicode_ci,
  `google_plus_key` text COLLATE utf8mb4_unicode_ci,
  `google_plus_secret` text COLLATE utf8mb4_unicode_ci,
  `google_map_api` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_width` text COLLATE utf8mb4_unicode_ci,
  `image_height` text COLLATE utf8mb4_unicode_ci,
  `image_size` text COLLATE utf8mb4_unicode_ci,
  `file_type` text COLLATE utf8mb4_unicode_ci,
  `notification_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 = toastr; 2 = sweetalert; 3 = notifyjs',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `company_name`, `site_title`, `site_title_bn`, `site_short_description`, `site_short_description_bn`, `site_header_logo`, `site_footer_logo`, `site_favicon`, `site_banner_image`, `site_email`, `site_phone_primary`, `site_phone_secondary`, `site_address`, `mail_driver`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `mail_encryption`, `facebook_url`, `twitter_url`, `google_plus_url`, `linkedin_url`, `youtube_url`, `instagram_url`, `pinterest_url`, `tumblr_url`, `flickr_url`, `recaptcha_key`, `recaptcha_secret`, `facebook_key`, `facebook_secret`, `twitter_key`, `twitter_secret`, `google_plus_key`, `google_plus_secret`, `google_map_api`, `image_width`, `image_height`, `image_size`, `file_type`, `notification_type`, `created_at`, `updated_at`) VALUES
(1, 'Best CNC Limited', 'PROFESSIONAL CNC ROUTER MACHINE MANUFACTURER IN BANGLADESH', 'প্রফেশনাল সিএনসি রুটার মেশিন ম্যানুফ্যাকচারার বাংলাদেশ', '<p><span style=\"color: rgb(102, 102, 102); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; text-align: center;\">Best CNC is a Bangladesh manufacturer of ATC CNC Router, Wood CNC Router, Woodworking Carving Machine, Wood Engraving Machine, CNC Laser Cutter, CNC Plasma Cutter. Our CNC Routers are specialized for materials such as Woods, Plastics, Aluminum, Copper, Stone. If there is a need of advices or more details, please come to us. Thanks for visiting.</span><br></p>', '<p><span style=\"color: rgb(102, 102, 102); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; text-align: center;\">বেস্ট সিএনসি হ\'ল এটিসি সিএনসি রাউটার, উড সিএনসি রাউটার, উড ওয়ার্কিং কারভিং মেশিন, উড এনগ্রাভিং মেশিন, সিএনসি লেজার কাটার, সিএনসি প্লাজমা কাটারের একটি বাংলাদেশী প্রস্তুতকারক। আমাদের সিএনসি রাউটারগুলি উডস, প্লাস্টিক, অ্যালুমিনিয়াম, কপার, স্টোন জাতীয় উপকরণগুলির জন্য বিশেষীকরণযোগ্য। যদি পরামর্শ বা আরও বিশদ প্রয়োজন হয় তবে দয়া করে আমাদের কাছে আসুন। পরিদর্শনের জন্য ধন্যবাদ.</span><br></p>', '20190821_1566385367712.png', '20190821_1566385399772.png', '20190821_1566373763949.jpg', '20190821_1566373763367.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1920', '500', '500', 'jpeg|png|jpg|gif', 1, NULL, '2019-08-21 05:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime(6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Administrtor', NULL, 'admin@gmail.com', NULL, '$2y$12$arGheOsisyOqqaZ/BsyRKe4LWLPyc00Wspi2HtVaSVR.Vt9Vdfq3q', NULL, 'glfK3hWZnR7TbWGCwV2CfsDh8Q1lVhO9p3Ry7fsWXcVDV1pNJU905JnpYrm9', NULL, NULL, '2019-11-16 21:18:03'),
(38, 'Redwan Ahamad', NULL, 'redwan.ahamad@gmail.com', NULL, '$2y$12$arGheOsisyOqqaZ/BsyRKe4LWLPyc00Wspi2HtVaSVR.Vt9Vdfq3q', NULL, 'wqgr3nAnA1yJQnLxWD81xC6DFlH5xj0C51GaqGmKPFpt9vT6MgqZc78sZaeN', NULL, '2019-11-12 05:46:56', '2019-11-18 01:19:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(32, 38, 19, NULL, NULL),
(33, 52, 19, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
