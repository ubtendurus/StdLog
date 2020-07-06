-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jul 06, 2020 at 06:40 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `std_log`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clock_comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_strike` int(255) DEFAULT NULL,
  `time_format` int(11) DEFAULT NULL,
  `iprestriction` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opt` varchar(800) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `country`, `timezone`, `clock_comment`, `max_strike`, `time_format`, `iprestriction`, `opt`) VALUES
(1, 'United States of America', 'America/New_York', 'on', 2, 1, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_form_grade`
--

DROP TABLE IF EXISTS `tbl_form_grade`;
CREATE TABLE IF NOT EXISTS `tbl_form_grade` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `grade` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_form_grade`
--

INSERT INTO `tbl_form_grade` (`id`, `grade`) VALUES
(5, '5A'),
(6, '11A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_form_school`
--

DROP TABLE IF EXISTS `tbl_form_school`;
CREATE TABLE IF NOT EXISTS `tbl_form_school` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `school` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_form_school`
--

INSERT INTO `tbl_form_school` (`id`, `school`) VALUES
(8, 'NOBLE ACADEMY CLEVELAND');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_people`
--

DROP TABLE IF EXISTS `tbl_people`;
CREATE TABLE IF NOT EXISTS `tbl_people` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `emailaddress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `civilstatus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `height` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `weight` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `mobileno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `birthday` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `nationalid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthplace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `homeaddress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `stdstatus` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `stdtype` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_people`
--

INSERT INTO `tbl_people` (`id`, `firstname`, `mi`, `lastname`, `age`, `gender`, `emailaddress`, `civilstatus`, `height`, `weight`, `mobileno`, `birthday`, `nationalid`, `birthplace`, `homeaddress`, `stdstatus`, `stdtype`, `avatar`) VALUES
(1, 'ADMIN', '', 'TEST', NULL, '', 'test@test.com', '', NULL, NULL, NULL, '2020-01-03', '', '', '', 'Active', NULL, ''),
(2, 'DEMO', '', 'STUDENT', NULL, '', 'student@test.com', '', NULL, NULL, NULL, '2020-01-03', '', '', '', 'Active', NULL, ''),
(3, 'UGUR', '', 'TENDURUS', 27, 'MALE', 'test1@test.com', '', NULL, NULL, NULL, '2020-06-10', '123456789123456', 'EUCLID', '1054 E 200TH STREET', 'Active', 'Regular', ''),
(6, 'BURAK', '', 'TENDURUS', 22, 'MALE', 'test3@test3.com', '', '', '', NULL, '2020-07-09', '', '', '', 'Active', 'Regular', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_people_attendance`
--

DROP TABLE IF EXISTS `tbl_people_attendance`;
CREATE TABLE IF NOT EXISTS `tbl_people_attendance` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` int(11) DEFAULT NULL,
  `idno` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `date` date DEFAULT NULL,
  `student` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `timein` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timeout` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalhours` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `status_timein` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `status_timeout` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `strike` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_people_attendance`
--

INSERT INTO `tbl_people_attendance` (`id`, `reference`, `idno`, `date`, `student`, `timein`, `timeout`, `totalhours`, `status_timein`, `status_timeout`, `comment`, `created_at`, `strike`) VALUES
(51, 6, '54321', '2020-07-03', 'TENDURUS, BURAK ', '2020-07-03 03:57:58 PM', '2020-07-03 04:04:15 PM', '0.0', 'Ok', 'Ok', 'TEST', '2020-07-03 19:57:58', 1),
(52, 6, '54321', '2020-07-03', 'TENDURUS, BURAK ', '2020-07-03 04:04:08 PM', '2020-07-03 04:04:15 PM', '0.0', 'Ok', 'Ok', 'TEST', '2020-07-03 20:04:08', 2),
(53, 6, '54321', '2020-07-03', 'TENDURUS, BURAK ', '2020-07-03 04:04:13 PM', '2020-07-03 04:04:15 PM', '0.0', 'Ok', 'Ok', 'TEST', '2020-07-03 20:04:13', 3),
(54, 3, '12345', '2020-07-03', 'TENDURUS, UGUR ', '2020-07-03 04:25:37 PM', '2020-07-03 04:25:43 PM', '0.0', 'Ok', 'Ok', 'TEST', '2020-07-03 20:25:37', 1),
(55, 3, '12345', '2020-07-06', 'TENDURUS, UGUR ', '2020-07-06 01:18:09 AM', '2020-07-06 01:18:14 AM', '0.0', 'Ok', 'Ok', 'TEST', '2020-07-06 05:18:09', 1),
(56, 3, '12345', '2020-07-06', 'TENDURUS, UGUR ', '2020-07-06 01:18:12 AM', '2020-07-06 01:18:14 AM', '0.0', 'Ok', 'Ok', 'TEST', '2020-07-06 05:18:12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report_views`
--

DROP TABLE IF EXISTS `tbl_report_views`;
CREATE TABLE IF NOT EXISTS `tbl_report_views` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `report_id` int(11) DEFAULT NULL,
  `last_viewed` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_report_views`
--

INSERT INTO `tbl_report_views` (`id`, `report_id`, `last_viewed`, `title`) VALUES
(1, 1, 'Jul, 03 2020', 'student List Report'),
(2, 2, 'Jul, 03 2020', 'student Attendance Report'),
(3, 3, 'Jul, 02 2020', 'student Leaves Report'),
(4, 4, 'Jul, 02 2020', 'student Schedule Report'),
(5, 5, 'Jul, 03 2020', 'Organizational Profile'),
(6, 6, 'Jul, 03 2020', 'User Accounts Report'),
(7, 7, 'Jul, 03 2020', 'student Birthdays');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_school_data`
--

DROP TABLE IF EXISTS `tbl_school_data`;
CREATE TABLE IF NOT EXISTS `tbl_school_data` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` int(11) NOT NULL,
  `school` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `grade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `schoolemail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `idno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `startdate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `reason` varchar(455) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_school_data`
--

INSERT INTO `tbl_school_data` (`id`, `reference`, `school`, `grade`, `schoolemail`, `idno`, `startdate`, `reason`) VALUES
(3, 3, 'NOBLE ACADEMY CLEVELAND', '5A', 'burak@noblecleveland.org', '12345', '2020-06-01', ''),
(6, 6, 'NOBLE ACADEMY CLEVELAND', '11A', 'test3@test3.com', '54321', '2020-07-06', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` int(11) DEFAULT NULL,
  `idno` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `role_id` int(11) DEFAULT NULL,
  `acc_type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `reference`, `idno`, `name`, `email`, `role_id`, `acc_type`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, '001122', 'DEMO, Test', 'test@test.com', 1, 2, 1, '$2y$10$mDAH.R8JG5ThPelt4zRXc.8sxizt.tqXQfndx5s/W/3j0Sq6xS3LG', '', '2018-10-31 12:10:04', '2018-10-31 12:10:04'),
(2, 2, '001133', 'DEMO, student', 'student@example.com', 2, 1, 1, '$2y$10$3qjhKES39RmTl4k7PQWJ.OfG4uFzzF/iYJI8A1BLgYs2uDEfe5pry', '', '2018-12-21 05:20:18', '2018-12-21 05:20:18'),
(3, 3, '12345', 'TENDURUS, UGUR', 'test1@test.com', 2, 1, 1, '$2y$10$WblQVkr.T5qKxdhcm33wEuR4oGJcnysprhhTv7MEgi7YHz74fAEKm', NULL, '2020-06-30 20:05:56', '2020-06-30 20:05:56');

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

DROP TABLE IF EXISTS `users_permissions`;
CREATE TABLE IF NOT EXISTS `users_permissions` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `perm_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1844 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_permissions`
--

INSERT INTO `users_permissions` (`id`, `role_id`, `perm_id`) VALUES
(1798, 1, 1),
(1799, 1, 2),
(1800, 1, 22),
(1801, 1, 21),
(1802, 1, 23),
(1803, 1, 24),
(1804, 1, 25),
(1805, 1, 3),
(1806, 1, 31),
(1807, 1, 32),
(1808, 1, 4),
(1809, 1, 41),
(1810, 1, 42),
(1811, 1, 43),
(1812, 1, 44),
(1813, 1, 5),
(1814, 1, 52),
(1815, 1, 53),
(1816, 1, 9),
(1817, 1, 91),
(1818, 1, 7),
(1819, 1, 8),
(1820, 1, 81),
(1821, 1, 82),
(1822, 1, 83),
(1823, 1, 10),
(1824, 1, 101),
(1825, 1, 102),
(1826, 1, 103),
(1827, 1, 104),
(1828, 1, 11),
(1829, 1, 111),
(1830, 1, 112),
(1831, 1, 12),
(1832, 1, 121),
(1833, 1, 122),
(1834, 1, 13),
(1835, 1, 131),
(1836, 1, 132),
(1837, 1, 14),
(1838, 1, 141),
(1839, 1, 142),
(1840, 1, 15),
(1841, 1, 151),
(1842, 1, 152),
(1843, 1, 153);

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

DROP TABLE IF EXISTS `users_roles`;
CREATE TABLE IF NOT EXISTS `users_roles` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`id`, `role_name`, `state`) VALUES
(1, 'ADMIN', 'Active'),
(2, 'STUDENT', 'Active');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
