-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.4.10-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_user_system
CREATE DATABASE IF NOT EXISTS `db_user_system` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `db_user_system`;

-- Dumping structure for table db_user_system.acceptance_reports
CREATE TABLE IF NOT EXISTS `acceptance_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `student_num` varchar(50) DEFAULT NULL,
  `date_reported` varchar(255) DEFAULT NULL,
  `name_student` varchar(255) DEFAULT NULL,
  `student_violation` varchar(255) DEFAULT NULL,
  `allow_class` varchar(255) DEFAULT NULL,
  `allow_phone` varchar(255) DEFAULT NULL,
  `recorded_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  CONSTRAINT `acceptance_uid` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_user_system.acceptance_reports: ~16 rows (approximately)
/*!40000 ALTER TABLE `acceptance_reports` DISABLE KEYS */;
INSERT INTO `acceptance_reports` (`id`, `uid`, `title`, `student_num`, `date_reported`, `name_student`, `student_violation`, `allow_class`, `allow_phone`, `recorded_by`, `created_at`, `updated_at`, `deleted`) VALUES
	(1, 11, '', '201516354', '2021-12-29', 'Clint Jeremy', '', 'Yes', 'No', NULL, '2022-01-07 17:56:08', '2022-01-07 17:56:08', 0),
	(2, 11, 'Acceptance Slip', '201516354', '2022-01-11', 'Juan Dela Cruz', 'No ID', 'Yes', 'Yes', NULL, '2022-01-07 17:56:49', '2022-01-07 17:56:49', 1),
	(3, 11, '', '201516354', '2021-12-28', 'dsadsad', '', 'dsadas', 'dsadsadas', NULL, '2022-01-07 17:57:33', '2022-01-07 17:57:33', 0),
	(4, 11, 'Consultation Report', '201516354', '2022-01-05', 'Juan Luna', 'Not in proper uniform (civilian attire)', 'Yes', 'Yes', NULL, '2022-01-07 18:12:31', '2022-01-07 18:12:31', 1),
	(5, 11, 'Acceptance Slip', '201516354', '2022-02-07', 'De Los Reyes', 'No ID', 'dsadas', 'dsadsa', NULL, '2022-02-02 18:44:47', '2022-02-02 18:44:47', 0),
	(6, 11, 'Acceptance Slip', '201516354', '2022-01-31', 'test', '', 'yes', 'yes', NULL, '2022-02-04 12:32:32', '2022-02-04 12:32:32', 0),
	(8, 11, 'Acceptance Slip', '201516354', '2022-02-14', 'test3', '', 'dasd', 'adas', NULL, '2022-02-04 12:32:50', '2022-02-04 12:32:50', 0),
	(9, 11, 'Acceptance Slip', '201516354', '2022-02-09', 'dsa', '', 'das', 'das', NULL, '2022-02-04 12:32:59', '2022-02-04 12:32:59', 0),
	(12, 11, 'Acceptance Slip', '201516354', '2022-02-08', 'DSADSA', 'Not in proper uniform (civilian attire)', 'DSADASSD', 'ASDASDAS', NULL, '2022-02-04 12:36:40', '2022-02-04 12:36:40', 0),
	(13, 11, 'Acceptance Slip', '201516354', '2022-03-03', 'Bare', '', 'yes', 'yes', NULL, '2022-03-03 21:36:19', '2022-03-29 16:19:48', 0),
	(14, 11, 'Acceptance Slip', '3123123123122022-06-22', 'dsadsadsa', '', 'das', 'dsadsadsa', '', NULL, '2022-06-23 11:21:20', '2022-06-23 11:21:20', 0),
	(15, 11, 'Acceptance', '3123123123122022-06-22', 'dsadasdas', '', 'dsadsad', 'asdasdasdas', 'Clint Jeremy', NULL, '2022-06-23 11:37:46', '2022-06-23 11:37:46', 0),
	(16, 11, 'Acceptance', '2321312', '2022-06-15', 'DSADSADAS', '', 'dasdasdas', 'dsadas', 'Clint Jeremy', '2022-06-23 11:44:04', '2022-06-23 11:44:04', 0),
	(17, 11, 'Acceptance', '2015163534', '2022-06-22', 'BAREE', '', 'YES', 'YES', 'Clint Jeremy', '2022-06-23 11:49:12', '2022-06-23 11:49:12', 0),
	(18, 11, 'Acceptance', '201231231', '2022-06-22', 'clint', '', 'yes', 'yes', 'Clint Jeremy', '2022-06-23 11:55:04', '2022-06-23 11:55:04', 0),
	(19, 11, 'Acceptance', '2123132', '2022-06-15', 'yeees', '', 'yes', 'no', 'Clint Jeremy', '2022-06-23 11:55:25', '2022-06-23 11:55:25', 0),
	(20, 11, 'Acceptance', '20151354', '2022-06-15', 'yeees', 'Not Wearing Proper Uniform (P.E, t-shirt, unprescribed shoes)', 'yees', 'yees', 'Clint Jeremy', '2022-06-23 11:56:29', '2022-06-23 11:56:29', 0);
/*!40000 ALTER TABLE `acceptance_reports` ENABLE KEYS */;

-- Dumping structure for table db_user_system.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_user_system.admin: ~0 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `username`, `password`) VALUES
	(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table db_user_system.all_events
CREATE TABLE IF NOT EXISTS `all_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL DEFAULT '0',
  `event` varchar(255) NOT NULL DEFAULT '0',
  `date` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_user_system.all_events: ~1 rows (approximately)
/*!40000 ALTER TABLE `all_events` DISABLE KEYS */;
INSERT INTO `all_events` (`id`, `subject`, `event`, `date`, `created_at`) VALUES
	(4, 'MEETING FOR THE EVENTS THIS WEEKEEND', 'STAFF MEETING', '2022-05-26', '2022-05-25 18:40:27'),
	(5, 'FOR EVALUATION', 'MEETING ALL STAFFS', '2022-05-28', '2022-05-25 20:37:14');
/*!40000 ALTER TABLE `all_events` ENABLE KEYS */;

-- Dumping structure for table db_user_system.consultation_reports
CREATE TABLE IF NOT EXISTS `consultation_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `student_num` varchar(50) DEFAULT NULL,
  `client` varchar(255) DEFAULT NULL,
  `name_client` varchar(255) DEFAULT NULL,
  `name_org` varchar(255) DEFAULT NULL,
  `time_started` varchar(255) DEFAULT NULL,
  `time_ended` varchar(255) DEFAULT NULL,
  `date_consultation` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `action_taken` varchar(255) DEFAULT NULL,
  `recorded_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  CONSTRAINT `consult_uid` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_user_system.consultation_reports: ~2 rows (approximately)
/*!40000 ALTER TABLE `consultation_reports` DISABLE KEYS */;
INSERT INTO `consultation_reports` (`id`, `uid`, `title`, `student_num`, `client`, `name_client`, `name_org`, `time_started`, `time_ended`, `date_consultation`, `purpose`, `action_taken`, `recorded_by`, `created_at`, `updated_at`, `deleted`) VALUES
	(8, 11, 'Consultation Report', '231312312', 'Student', 'dsadsa', 'dsadas', '01:29', '02:29', '2022-06-02', 'dsadsad', 'sadasdsadsadas', '', '2022-06-23 11:29:51', '2022-06-23 11:29:51', 1),
	(9, 11, 'Consultation', '32321321312', 'Staff', 'dsad', 'dsadsa', '00:37', '02:37', '2022-06-14', 'dsadsadsa', 'dsadsadas', 'Clint Jeremy', '2022-06-23 11:37:32', '2022-06-23 11:37:32', 1);
/*!40000 ALTER TABLE `consultation_reports` ENABLE KEYS */;

-- Dumping structure for table db_user_system.events
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `event` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `when_at` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `replied` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  CONSTRAINT `events_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_user_system.events: ~0 rows (approximately)
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;

-- Dumping structure for table db_user_system.incident_reports
CREATE TABLE IF NOT EXISTS `incident_reports` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `student_num` varchar(50) DEFAULT NULL,
  `time_reported` varchar(255) DEFAULT NULL,
  `time_incident` varchar(255) DEFAULT NULL,
  `persons_involved` varchar(255) DEFAULT NULL,
  `witness_involved` varchar(255) DEFAULT NULL,
  `incident_description` varchar(255) DEFAULT NULL,
  `reported_by` varchar(255) DEFAULT NULL,
  `noted_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `incident_uid` (`uid`),
  CONSTRAINT `incident_uid` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_user_system.incident_reports: ~9 rows (approximately)
/*!40000 ALTER TABLE `incident_reports` DISABLE KEYS */;
INSERT INTO `incident_reports` (`id`, `uid`, `title`, `student_num`, `time_reported`, `time_incident`, `persons_involved`, `witness_involved`, `incident_description`, `reported_by`, `noted_by`, `created_at`, `updated_at`, `deleted`) VALUES
	(2, 11, 'Incident Report', '201516354', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
	(3, 11, 'Incident Report', '201516354', '2021-10-31', '2021-11-24', 'Bare222', 'n/a', 'Nagnakaw nang candy', 'ARWIND SANTOS', 'Jimmy Alapag', NULL, '2022-03-15 13:50:54', 0),
	(4, 11, 'Incident Report', '201516354', '2021-12-15', '2021-12-23', 'Clint JEremy Bare', 'Calixdasdsa', 'Nagsuntukan sa labas', 'Juan Sanchez', 'sadasdas', '2021-12-15 00:08:17', '2022-02-03 20:44:30', 0),
	(5, 11, 'Incident Report', '201516354', '2022-03-25', '2022-03-15', 'Arwind', 'Calixta', 'test', 'dsadasdsa', 'dasdasdasaaa', '2022-03-03 21:23:43', '2022-03-03 21:23:43', 0),
	(6, 11, 'Incident Report', '201516354', '2022-03-14', '2022-03-03', 'Clint', 'Jeremy', 'TEST TEST', 'BARE', 'BARE', '2022-03-03 21:25:17', '2022-03-03 21:25:17', 0),
	(7, 11, 'Incident Report', '201516354', '2022-03-23', '2022-03-03', 'Marciano', 'Del Pilar', 'Any illness or injury that impacts an employee’s ability to work must be noted. The specifics of what is required by law to be included in an incident report will vary depending on the federal or provincial legislation that affects your workplace', 'Luna', 'Juan', '2022-03-03 21:26:02', '2022-04-21 13:46:48', 1),
	(8, 11, 'Incident Report', '201516354', '2022-03-25', '2022-03-09', 'J. Rizal', 'Gomburza', 'An incident report is a form to document all workplace illnesses, injuries, near misses and accidents. An incident report should be completed at the time an incident occurs no matter how minor an injury is.', 'Ramos', 'Lopez', '2022-03-29 14:37:22', '2022-04-21 13:45:57', 1),
	(10, 11, 'Incident Report', '202212345', '2022-06-01', '2022-05-03', 'John Lee', 'Mike Oxmol', 'An incident report is a tool that documents any event that may or may not have caused injuries to a person or damage to a company asset. It is used to capture injuries and accidents, near misses, property and equipment damage, health and safety issues, se', 'Mike Oxmol', '', '2022-06-10 16:45:04', '2022-06-10 16:45:04', 1),
	(11, 11, 'Incident Report', '312312321312', '2022-06-03', '2022-06-15', 'dsad', 'asdsads', 'adsadsadsa', 'dsadas', '', '2022-06-23 11:33:18', '2022-06-23 11:33:18', 1),
	(12, 11, 'Incident Report', '321321312312', '2022-06-22', '2022-06-13', 'dsad', 'sadas', 'dsadsadsa', 'dsadsa', 'Clint Jeremy', '2022-06-23 11:35:19', '2022-06-23 11:35:19', 1),
	(13, 11, 'Incident', '312321312312', '2022-06-21', '2022-06-21', 'dsadsa', 'dasdsa', 'dsadsadsa', 'dsadsa', 'Clint Jeremy', '2022-06-23 11:37:07', '2022-06-23 11:37:07', 1);
/*!40000 ALTER TABLE `incident_reports` ENABLE KEYS */;

-- Dumping structure for table db_user_system.notification
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=601 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_user_system.notification: ~293 rows (approximately)
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` (`id`, `uid`, `type`, `message`, `created_at`) VALUES
	(116, 17, 'user', 'How are you', '2021-05-25 17:04:43'),
	(135, 21, 'admin', 'Record Deleted', '2021-05-26 13:44:58'),
	(136, 21, 'admin', 'Profile Updated', '2021-05-26 13:46:15'),
	(137, 21, 'admin', 'Password Changed', '2021-05-26 13:46:34'),
	(139, 21, 'user', 'How are you?', '2021-05-26 13:52:06'),
	(210, 28, 'user', 'May meeting tayo mamaya 8pm', '2021-05-28 14:10:38'),
	(250, 11, 'admin', 'New Record Added', '2021-06-02 23:47:13'),
	(254, 11, 'admin', 'Record Deleted', '2021-06-03 13:48:13'),
	(255, 11, 'admin', 'Record Deleted', '2021-06-03 13:48:38'),
	(256, 11, 'admin', 'dsadas  Message ', '2021-06-03 14:06:04'),
	(263, 11, 'admin', 'Profile Updated', '2021-06-03 16:27:34'),
	(264, 11, 'admin', 'Record Updated', '2021-06-07 16:17:47'),
	(265, 11, 'admin', 'Record Updated', '2021-06-07 16:19:13'),
	(266, 11, 'admin', 'Record Updated', '2021-06-07 16:20:00'),
	(267, 11, 'admin', 'Record Updated', '2021-06-07 16:22:15'),
	(268, 11, 'admin', 'Record Updated', '2021-06-07 16:22:23'),
	(269, 11, 'admin', 'New Record Added', '2021-09-25 17:39:41'),
	(270, 11, 'admin', 'Profile Updated', '2021-09-25 17:56:56'),
	(271, 11, 'admin', 'Profile Updated', '2021-09-25 17:57:16'),
	(272, 11, 'admin', 'Profile Updated', '2021-09-25 18:04:47'),
	(273, 11, 'admin', 'Profile Updated', '2021-10-23 02:21:29'),
	(274, 11, 'admin', 'Profile Updated', '2021-10-23 02:21:36'),
	(275, 11, 'admin', 'New Record Added', '2021-11-11 01:51:42'),
	(276, 11, 'admin', 'Record Deleted', '2021-11-11 02:03:30'),
	(277, 11, 'admin', 'New Record Added', '2021-11-11 02:03:38'),
	(278, 11, 'admin', 'Record Deleted', '2021-11-11 02:06:55'),
	(279, 11, 'admin', 'New Record Added', '2021-11-11 02:08:14'),
	(280, 11, 'admin', 'New Record Added', '2021-11-11 02:08:35'),
	(281, 11, 'admin', 'Record Deleted', '2021-11-11 02:09:10'),
	(282, 11, 'admin', 'Record Deleted', '2021-11-11 02:09:12'),
	(283, 11, 'admin', 'New Record Added', '2021-11-11 02:09:22'),
	(284, 11, 'admin', 'New Record Added', '2021-11-11 02:10:58'),
	(285, 11, 'admin', 'Record Deleted', '2021-11-11 02:11:00'),
	(286, 11, 'admin', 'Record Deleted', '2021-11-11 02:11:02'),
	(287, 11, 'admin', 'New Record Added', '2021-11-11 02:12:46'),
	(288, 11, 'admin', 'New Record Added', '2021-11-11 02:14:42'),
	(289, 11, 'admin', 'New Record Added', '2021-11-11 02:16:14'),
	(290, 11, 'admin', 'New Record Added', '2021-11-11 02:18:02'),
	(291, 11, 'admin', 'Record Deleted', '2021-11-11 02:19:07'),
	(292, 11, 'admin', 'Record Deleted', '2021-11-11 02:19:11'),
	(293, 11, 'admin', 'Record Deleted', '2021-11-11 02:19:13'),
	(294, 11, 'admin', 'Record Deleted', '2021-11-11 02:19:15'),
	(295, 11, 'admin', 'Record Deleted', '2021-11-11 02:19:17'),
	(296, 11, 'admin', 'New Record Added', '2021-11-11 02:19:32'),
	(297, 11, 'admin', 'New Record Added', '2021-11-11 02:19:45'),
	(298, 11, 'admin', 'New Record Added', '2021-11-11 02:50:59'),
	(299, 11, 'admin', 'New Record Added', '2021-11-11 02:52:11'),
	(300, 11, 'admin', 'New Record Added', '2021-11-11 02:53:45'),
	(301, 11, 'admin', 'New Record Added', '2021-11-11 02:56:22'),
	(302, 11, 'admin', 'New Record Added', '2021-11-11 03:01:32'),
	(303, 11, 'admin', 'New Record Added', '2021-11-11 03:04:41'),
	(304, 11, 'admin', 'New Record Added', '2021-11-11 03:07:27'),
	(305, 11, 'admin', 'New Record Added', '2021-11-11 03:10:19'),
	(306, 11, 'admin', 'New Record Added', '2021-11-11 03:15:16'),
	(307, 11, 'admin', 'New Record Added', '2021-11-11 03:17:23'),
	(308, 11, 'admin', 'Record Updated', '2021-12-14 22:14:12'),
	(309, 11, 'admin', 'Record Updated', '2021-12-14 22:25:49'),
	(310, 11, 'admin', 'Record Updated', '2021-12-14 22:42:22'),
	(311, 11, 'admin', 'Record Updated', '2021-12-14 22:42:27'),
	(312, 11, 'admin', 'Record Updated', '2021-12-14 22:45:01'),
	(313, 11, 'admin', 'Record Updated', '2021-12-14 22:45:24'),
	(314, 11, 'admin', 'Record Updated', '2021-12-14 22:45:30'),
	(315, 11, 'admin', 'Record Updated', '2021-12-14 22:46:17'),
	(316, 11, 'admin', 'Record Updated', '2021-12-14 22:48:20'),
	(317, 11, 'admin', 'Record Updated', '2021-12-14 22:48:56'),
	(318, 11, 'admin', 'Record Updated', '2021-12-14 22:49:03'),
	(319, 11, 'admin', 'Record Updated', '2021-12-14 22:50:44'),
	(320, 11, 'admin', 'Record Updated', '2021-12-14 22:51:03'),
	(321, 11, 'admin', 'Record Updated', '2021-12-14 22:52:46'),
	(322, 11, 'admin', 'Record Updated', '2021-12-14 23:04:21'),
	(323, 11, 'admin', 'Record Updated', '2021-12-14 23:05:58'),
	(324, 11, 'admin', 'Record Updated', '2021-12-14 23:07:02'),
	(325, 11, 'admin', 'Record Updated', '2021-12-14 23:11:43'),
	(326, 11, 'admin', 'Record Updated', '2021-12-14 23:11:53'),
	(327, 11, 'admin', 'Record Updated', '2021-12-14 23:12:52'),
	(328, 11, 'admin', 'Record Updated', '2021-12-14 23:13:17'),
	(329, 11, 'admin', 'Record Updated', '2021-12-14 23:15:53'),
	(330, 11, 'admin', 'Record Updated', '2021-12-14 23:17:45'),
	(331, 11, 'admin', 'Record Updated', '2021-12-14 23:18:11'),
	(332, 11, 'admin', 'Record Updated', '2021-12-14 23:20:39'),
	(333, 11, 'admin', 'Record Updated', '2021-12-14 23:22:09'),
	(334, 11, 'admin', 'Record Updated', '2021-12-14 23:22:25'),
	(335, 11, 'admin', 'Record Updated', '2021-12-14 23:27:05'),
	(336, 11, 'admin', 'Record Updated', '2021-12-14 23:28:26'),
	(337, 11, 'admin', 'Record Updated', '2021-12-14 23:34:19'),
	(338, 11, 'admin', 'Record Updated', '2021-12-14 23:34:34'),
	(339, 11, 'admin', 'Record Updated', '2021-12-14 23:36:12'),
	(340, 11, 'admin', 'Record Updated', '2021-12-14 23:36:34'),
	(341, 11, 'admin', 'Record Updated', '2021-12-14 23:36:49'),
	(342, 11, 'admin', 'Record Updated', '2021-12-14 23:37:24'),
	(343, 11, 'admin', 'Record Updated', '2021-12-14 23:37:54'),
	(344, 11, 'admin', 'Record Updated', '2021-12-14 23:53:35'),
	(345, 11, 'admin', 'Record Updated', '2021-12-14 23:54:30'),
	(346, 11, 'admin', '3', '2021-12-14 23:56:15'),
	(347, 11, 'admin', '3', '2021-12-14 23:57:43'),
	(348, 11, 'admin', 'Incident Report Updated', '2021-12-14 23:58:44'),
	(349, 11, 'admin', 'Incident Report Updated', '2021-12-14 23:58:53'),
	(350, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:00:16'),
	(351, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:01:34'),
	(352, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:03:53'),
	(353, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:05:17'),
	(354, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:05:49'),
	(355, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:06:09'),
	(356, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:06:25'),
	(357, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:06:53'),
	(358, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:07:32'),
	(359, 11, 'admin', 'New Record Added', '2021-12-15 00:08:17'),
	(360, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:08:51'),
	(361, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:09:04'),
	(362, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:10:42'),
	(363, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:10:50'),
	(364, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:11:04'),
	(365, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:13:34'),
	(366, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:13:44'),
	(367, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:14:06'),
	(368, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:14:47'),
	(369, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:16:01'),
	(370, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:16:11'),
	(371, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:16:18'),
	(372, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:16:48'),
	(373, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:16:53'),
	(374, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:17:15'),
	(375, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:17:36'),
	(376, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:24:09'),
	(377, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:24:14'),
	(378, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:24:22'),
	(379, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:25:26'),
	(380, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:25:29'),
	(381, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:26:10'),
	(382, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:26:19'),
	(383, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:26:30'),
	(384, 11, 'admin', 'Incident Report Updated', '2021-12-15 00:26:35'),
	(385, 11, 'admin', 'New Consultation Added', '2021-12-17 00:50:00'),
	(386, 11, 'admin', 'New Consultation Added', '2021-12-17 00:51:35'),
	(387, 11, 'admin', 'Profile Updated', '2021-12-19 20:33:45'),
	(388, 11, 'admin', 'Profile Updated', '2021-12-19 20:41:19'),
	(389, 11, 'admin', 'Profile Updated', '2021-12-19 20:41:59'),
	(390, 11, 'admin', 'Profile Updated', '2021-12-19 20:49:30'),
	(391, 11, 'admin', 'Profile Updated', '2021-12-19 20:50:15'),
	(392, 11, 'admin', 'Profile Updated', '2021-12-19 20:59:55'),
	(393, 11, 'admin', 'New Consultation Added', '2022-01-07 17:46:59'),
	(394, 11, 'admin', 'New Consultation Added', '2022-01-07 17:47:15'),
	(395, 11, 'admin', 'Record Deleted', '2022-01-07 17:47:18'),
	(396, 11, 'admin', 'Record Deleted', '2022-01-07 17:47:22'),
	(397, 11, 'admin', 'Record Deleted', '2022-01-07 17:47:24'),
	(398, 11, 'admin', 'Record Deleted', '2022-01-07 17:47:27'),
	(399, 11, 'admin', 'New Acceptance Added', '2022-01-07 17:56:08'),
	(400, 11, 'admin', 'New Acceptance Added', '2022-01-07 17:56:49'),
	(401, 11, 'admin', 'New Acceptance Added', '2022-01-07 17:57:33'),
	(402, 11, 'admin', 'Record Deleted', '2022-01-07 18:06:43'),
	(403, 11, 'admin', 'Record Deleted', '2022-01-07 18:06:50'),
	(404, 11, 'admin', 'New Acceptance Added', '2022-01-07 18:12:31'),
	(405, 11, 'admin', 'New Acceptance Added', '2022-02-02 18:44:47'),
	(406, 11, 'admin', 'Incident Report Updated', '2022-02-03 12:42:19'),
	(407, 11, 'admin', 'Incident Report Updated', '2022-02-03 20:44:30'),
	(408, 11, 'admin', 'Record Deleted', '2022-02-03 20:44:51'),
	(409, 11, 'admin', 'Record Deleted', '2022-02-03 20:49:09'),
	(410, 11, 'admin', 'Record Deleted', '2022-02-03 20:49:23'),
	(411, 11, 'admin', 'Incident Report Updated', '2022-02-03 22:11:35'),
	(412, 11, 'admin', 'Incident Report Updated', '2022-02-03 22:11:46'),
	(413, 11, 'admin', 'New Acceptance Added', '2022-02-04 12:32:32'),
	(414, 11, 'admin', 'New Acceptance Added', '2022-02-04 12:32:42'),
	(415, 11, 'admin', 'New Acceptance Added', '2022-02-04 12:32:50'),
	(416, 11, 'admin', 'New Acceptance Added', '2022-02-04 12:32:59'),
	(417, 11, 'admin', 'New Acceptance Added', '2022-02-04 12:33:08'),
	(418, 11, 'admin', 'New Acceptance Added', '2022-02-04 12:33:53'),
	(419, 11, 'admin', 'New Acceptance Added', '2022-02-04 12:36:40'),
	(420, 11, 'admin', 'Incident Report Updated', '2022-02-04 12:56:22'),
	(422, 11, 'admin', 'New Record Added', '2022-03-03 21:23:43'),
	(423, 11, 'admin', 'Record Deleted', '2022-03-03 21:24:39'),
	(424, 11, 'admin', 'New Record Added', '2022-03-03 21:25:17'),
	(425, 11, 'admin', 'New Record Added', '2022-03-03 21:26:02'),
	(426, 11, 'admin', 'New Consultation Added', '2022-03-03 21:36:03'),
	(427, 11, 'admin', 'New Acceptance Added', '2022-03-03 21:36:19'),
	(428, 11, 'admin', 'Record Deleted', '2022-03-03 21:56:28'),
	(429, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 13:31:45'),
	(430, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 13:32:21'),
	(431, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 13:34:13'),
	(432, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 13:36:32'),
	(433, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 13:37:37'),
	(434, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 13:39:18'),
	(435, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 13:39:56'),
	(436, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 13:40:18'),
	(437, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 13:44:49'),
	(438, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 13:44:54'),
	(439, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 13:45:32'),
	(440, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 13:45:38'),
	(441, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 13:45:45'),
	(442, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 13:46:11'),
	(443, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 13:46:17'),
	(444, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 13:47:04'),
	(445, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 13:49:25'),
	(446, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 13:49:38'),
	(447, 11, 'admin', 'Incident Report Updated', '2022-03-15 13:50:54'),
	(448, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 14:06:59'),
	(449, 11, 'admin', 'Acceptance Slip Updated', '2022-03-15 14:08:31'),
	(450, 11, 'admin', 'Consultation Report Updated', '2022-03-29 13:28:57'),
	(451, 11, 'admin', 'Consultation Report Updated', '2022-03-29 13:36:15'),
	(452, 11, 'admin', 'Consultation Report Updated', '2022-03-29 13:38:12'),
	(453, 11, 'admin', 'New Consultation Added', '2022-03-29 13:38:42'),
	(454, 11, 'admin', 'Consultation Report Updated', '2022-03-29 13:38:53'),
	(455, 11, 'admin', 'Consultation Report Updated', '2022-03-29 13:38:59'),
	(456, 11, 'admin', 'Consultation Report Updated', '2022-03-29 13:48:57'),
	(457, 11, 'admin', 'Consultation Report Updated', '2022-03-29 13:49:02'),
	(458, 11, 'admin', 'Consultation Report Updated', '2022-03-29 13:49:07'),
	(459, 11, 'admin', 'Consultation Report Updated', '2022-03-29 13:54:17'),
	(460, 11, 'admin', 'Consultation Report Updated', '2022-03-29 13:55:28'),
	(461, 11, 'admin', 'Consultation Report Updated', '2022-03-29 13:55:31'),
	(462, 11, 'admin', 'Consultation Report Updated', '2022-03-29 13:55:58'),
	(463, 11, 'admin', 'Consultation Report Updated', '2022-03-29 13:57:25'),
	(464, 11, 'admin', 'Consultation Report Updated', '2022-03-29 13:57:42'),
	(465, 11, 'admin', 'Consultation Report Updated', '2022-03-29 13:59:00'),
	(466, 11, 'admin', 'Consultation Report Updated', '2022-03-29 14:06:06'),
	(467, 11, 'admin', 'Consultation Report Updated', '2022-03-29 14:09:48'),
	(468, 11, 'admin', 'Consultation Report Updated', '2022-03-29 14:14:44'),
	(469, 11, 'admin', 'Consultation Report Updated', '2022-03-29 14:18:35'),
	(470, 11, 'admin', 'Consultation Report Updated', '2022-03-29 14:18:45'),
	(471, 11, 'admin', 'Consultation Report Updated', '2022-03-29 14:20:52'),
	(472, 11, 'admin', 'Consultation Report Updated', '2022-03-29 14:24:11'),
	(473, 11, 'admin', 'Consultation Report Updated', '2022-03-29 14:26:13'),
	(474, 11, 'admin', 'Consultation Report Updated', '2022-03-29 14:31:52'),
	(475, 11, 'admin', 'Incident Report Updated', '2022-03-29 14:36:44'),
	(476, 11, 'admin', 'Incident Report Updated', '2022-03-29 14:36:59'),
	(477, 11, 'admin', 'New Record Added', '2022-03-29 14:37:22'),
	(478, 11, 'admin', 'Incident Report Updated', '2022-03-29 14:37:55'),
	(479, 11, 'admin', 'Record Deleted', '2022-03-29 14:39:28'),
	(480, 11, 'admin', 'Record Deleted', '2022-03-29 14:39:31'),
	(481, 11, 'admin', 'Incident Report Updated', '2022-03-29 14:40:20'),
	(482, 11, 'admin', 'Incident Report Updated', '2022-03-29 14:43:56'),
	(483, 11, 'admin', 'Incident Report Updated', '2022-03-29 14:44:56'),
	(484, 11, 'admin', 'Record Deleted', '2022-03-29 14:46:07'),
	(485, 11, 'admin', 'Record Deleted', '2022-03-29 14:46:11'),
	(486, 11, 'admin', 'Record Deleted', '2022-03-29 14:46:14'),
	(487, 11, 'admin', 'Incident Report Updated', '2022-03-29 14:48:34'),
	(488, 11, 'admin', 'Consultation Report Updated', '2022-03-29 14:48:40'),
	(489, 11, 'admin', 'Incident Report Updated', '2022-03-29 14:51:02'),
	(490, 11, 'admin', 'Incident Report Updated', '2022-03-29 14:51:08'),
	(491, 11, 'admin', 'Incident Report Updated', '2022-03-29 14:57:52'),
	(492, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:02:06'),
	(493, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:06:44'),
	(494, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:06:58'),
	(495, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:08:47'),
	(496, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:09:43'),
	(497, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:11:24'),
	(498, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:12:25'),
	(499, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:13:32'),
	(500, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:13:48'),
	(501, 11, 'admin', 'dsadasdas', '2022-03-29 15:14:56'),
	(502, 11, 'admin', 'ABCDEF', '2022-03-29 15:15:04'),
	(503, 11, 'admin', 'Acceptance Slip Updated', '2022-03-29 15:17:12'),
	(504, 11, 'admin', 'Acceptance Slip Updated', '2022-03-29 15:17:17'),
	(505, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:19:35'),
	(506, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:19:39'),
	(507, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:21:18'),
	(508, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:27:09'),
	(509, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:29:01'),
	(510, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:29:26'),
	(511, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:35:11'),
	(512, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:35:52'),
	(513, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:39:37'),
	(514, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:39:39'),
	(515, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:39:44'),
	(516, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:40:16'),
	(517, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:40:30'),
	(518, 11, 'admin', '', '2022-03-29 15:42:39'),
	(519, 11, 'admin', '2022-03-25', '2022-03-29 15:43:15'),
	(520, 11, 'admin', '', '2022-03-29 15:43:29'),
	(521, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:48:01'),
	(522, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:48:23'),
	(523, 11, 'admin', 'Incident Report Updated', '2022-03-29 15:48:44'),
	(524, 11, 'admin', '', '2022-03-29 15:49:05'),
	(525, 11, 'admin', '', '2022-03-29 15:50:59'),
	(526, 11, 'admin', '', '2022-03-29 15:51:36'),
	(527, 11, 'admin', '', '2022-03-29 15:52:41'),
	(528, 11, 'admin', '', '2022-03-29 15:53:13'),
	(529, 11, 'admin', '', '2022-03-29 15:53:26'),
	(530, 11, 'admin', '', '2022-03-29 15:53:57'),
	(531, 11, 'admin', '', '2022-03-29 15:54:44'),
	(532, 11, 'admin', '', '2022-03-29 15:56:49'),
	(533, 11, 'admin', '', '2022-03-29 16:01:23'),
	(534, 11, 'admin', '', '2022-03-29 16:01:50'),
	(535, 11, 'admin', '', '2022-03-29 16:04:00'),
	(536, 11, 'admin', '', '2022-03-29 16:05:00'),
	(537, 11, 'admin', '', '2022-03-29 16:05:49'),
	(538, 11, 'admin', '', '2022-03-29 16:05:52'),
	(539, 11, 'admin', '', '2022-03-29 16:07:30'),
	(540, 11, 'admin', '', '2022-03-29 16:10:36'),
	(541, 11, 'admin', '', '2022-03-29 16:11:00'),
	(542, 11, 'admin', '8', '2022-03-29 16:12:11'),
	(543, 11, 'admin', '8', '2022-03-29 16:12:18'),
	(544, 11, 'admin', '8', '2022-03-29 16:12:38'),
	(545, 11, 'admin', '8', '2022-03-29 16:13:40'),
	(546, 11, 'admin', 'Consultation Report Updated', '2022-03-29 16:14:27'),
	(547, 11, 'admin', '', '2022-03-29 16:14:58'),
	(548, 11, 'admin', '5', '2022-03-29 16:15:42'),
	(549, 11, 'admin', '5', '2022-03-29 16:15:48'),
	(550, 11, 'admin', '5', '2022-03-29 16:16:43'),
	(551, 11, 'admin', '5', '2022-03-29 16:18:51'),
	(552, 11, 'admin', 'Acceptance Slip Updated', '2022-03-29 16:19:45'),
	(553, 11, 'admin', 'Acceptance Slip Updated', '2022-03-29 16:19:48'),
	(554, 11, 'admin', 'New Consultation Added', '2022-03-29 16:24:06'),
	(556, 11, 'admin', 'Incident Report Updated', '2022-04-21 13:45:57'),
	(557, 11, 'admin', 'Incident Report Updated', '2022-04-21 13:46:32'),
	(558, 11, 'admin', 'Incident Report Updated', '2022-04-21 13:46:48'),
	(559, 11, 'admin', 'Record Deleted', '2022-04-21 13:46:58'),
	(560, 11, 'admin', '6', '2022-04-21 13:48:52'),
	(561, 11, 'admin', '5', '2022-04-21 13:49:36'),
	(562, 11, 'admin', 'Record Deleted', '2022-04-21 13:49:45'),
	(563, 11, 'admin', 'Record Deleted', '2022-04-21 13:49:49'),
	(564, 11, 'admin', 'Record Deleted', '2022-04-21 13:53:09'),
	(565, 11, 'admin', 'Record Deleted', '2022-04-21 13:53:13'),
	(566, 11, 'admin', 'Record Deleted', '2022-04-21 13:53:15'),
	(567, 11, 'admin', 'Record Deleted', '2022-04-21 13:53:17'),
	(568, 11, 'admin', 'Record Deleted', '2022-04-21 13:53:20'),
	(569, 11, 'admin', 'Record Deleted', '2022-04-21 13:53:22'),
	(570, 11, 'admin', 'Record Deleted', '2022-04-21 13:53:23'),
	(571, 11, 'admin', 'Record Deleted', '2022-04-21 13:53:25'),
	(572, 11, 'admin', 'Record Deleted', '2022-04-21 13:53:27'),
	(573, 11, 'admin', 'Record Deleted', '2022-04-21 13:53:30'),
	(574, 11, 'admin', 'Record Deleted', '2022-04-21 13:53:32'),
	(575, 11, 'admin', 'Profile Updated', '2022-05-25 16:47:38'),
	(580, 11, 'admin', 'New Record Added', '2022-06-10 16:45:04'),
	(581, 11, 'admin', 'New Acceptance Added', '2022-06-23 11:21:21'),
	(582, 11, 'admin', 'New Consultation Added', '2022-06-23 11:29:51'),
	(583, 11, 'admin', 'New Record Added', '2022-06-23 11:33:18'),
	(584, 11, 'admin', 'New Record Added', '2022-06-23 11:35:19'),
	(585, 11, 'admin', 'New Record Added', '2022-06-23 11:37:07'),
	(586, 11, 'admin', 'New Consultation Added', '2022-06-23 11:37:32'),
	(587, 11, 'admin', 'New Acceptance Added', '2022-06-23 11:37:46'),
	(588, 11, 'admin', 'New Acceptance Added', '2022-06-23 11:42:46'),
	(589, 11, 'admin', 'New Acceptance Added', '2022-06-23 11:44:04'),
	(590, 11, 'admin', 'New Acceptance Added', '2022-06-23 11:49:12'),
	(591, 11, 'admin', 'New Acceptance Added', '2022-06-23 11:55:04'),
	(592, 11, 'admin', 'New Acceptance Added', '2022-06-23 11:55:25'),
	(593, 11, 'admin', 'New Acceptance Added', '2022-06-23 11:56:29'),
	(594, 11, 'admin', 'Record Deleted', '2022-06-23 11:56:59'),
	(595, 11, 'admin', 'Record Deleted', '2022-06-23 11:57:02'),
	(596, 11, 'admin', 'Record Deleted', '2022-06-23 11:57:04'),
	(597, 11, 'admin', 'Record Deleted', '2022-06-23 11:57:06'),
	(598, 11, 'admin', 'Record Deleted', '2022-06-23 11:57:08'),
	(599, 11, 'admin', 'Record Deleted', '2022-06-23 11:57:10'),
	(600, 11, 'admin', 'Record Deleted', '2022-06-23 11:57:12');
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;

-- Dumping structure for table db_user_system.record_counts
CREATE TABLE IF NOT EXISTS `record_counts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_user_system.record_counts: ~23 rows (approximately)
/*!40000 ALTER TABLE `record_counts` DISABLE KEYS */;
INSERT INTO `record_counts` (`id`, `title`, `created_at`, `updated_at`) VALUES
	(1, '0', '2022-03-03 21:25:17', '2022-03-03 21:25:17'),
	(2, 'Incident Report', '2022-03-03 21:26:02', '2022-03-03 21:26:02'),
	(3, 'Consultation Report', '2022-03-03 21:36:03', '2022-03-03 21:36:03'),
	(4, 'Acceptance Slip', '2022-03-03 21:36:19', '2022-03-03 21:36:19'),
	(5, 'Consultation Report', '2022-03-29 13:38:41', '2022-03-29 13:38:41'),
	(6, 'Incident Report', '2022-03-29 14:37:22', '2022-03-29 14:37:22'),
	(7, 'Consultation Report', '2022-03-29 16:24:06', '2022-03-29 16:24:06'),
	(8, 'Incident', '2022-05-25 20:27:36', '2022-05-25 20:27:36'),
	(9, 'Consultation', '2022-05-25 20:31:43', '2022-05-25 20:31:43'),
	(10, 'Incident', '2022-06-10 16:45:04', '2022-06-10 16:45:04'),
	(11, 'Acceptance', '2022-06-23 11:21:20', '2022-06-23 11:21:20'),
	(12, 'Consultation', '2022-06-23 11:29:51', '2022-06-23 11:29:51'),
	(13, 'Incident', '2022-06-23 11:33:18', '2022-06-23 11:33:18'),
	(14, 'Incident', '2022-06-23 11:35:19', '2022-06-23 11:35:19'),
	(15, 'Incident', '2022-06-23 11:37:07', '2022-06-23 11:37:07'),
	(16, 'Consultation', '2022-06-23 11:37:32', '2022-06-23 11:37:32'),
	(17, 'Acceptance', '2022-06-23 11:37:46', '2022-06-23 11:37:46'),
	(18, 'Acceptance', '2022-06-23 11:42:46', '2022-06-23 11:42:46'),
	(19, 'Acceptance', '2022-06-23 11:44:04', '2022-06-23 11:44:04'),
	(20, 'Acceptance', '2022-06-23 11:49:12', '2022-06-23 11:49:12'),
	(21, 'Acceptance', '2022-06-23 11:55:04', '2022-06-23 11:55:04'),
	(22, 'Acceptance', '2022-06-23 11:55:25', '2022-06-23 11:55:25'),
	(23, 'Acceptance', '2022-06-23 11:56:29', '2022-06-23 11:56:29');
/*!40000 ALTER TABLE `record_counts` ENABLE KEYS */;

-- Dumping structure for table db_user_system.record_types
CREATE TABLE IF NOT EXISTS `record_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `record_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_user_system.record_types: ~5 rows (approximately)
/*!40000 ALTER TABLE `record_types` DISABLE KEYS */;
INSERT INTO `record_types` (`id`, `record_type`) VALUES
	(1, 'Excuse Letter'),
	(2, 'Incident Report'),
	(5, 'Accomplished Incident Report'),
	(6, 'Excuse Letter of Student'),
	(7, 'Excuse Letter - Violation');
/*!40000 ALTER TABLE `record_types` ENABLE KEYS */;

-- Dumping structure for table db_user_system.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dob` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `token_expired` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_user_system.users: ~10 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `student_number`, `password`, `phone`, `gender`, `dob`, `photo`, `token`, `token_expired`, `created_at`, `verified`, `deleted`) VALUES
	(11, 'Clint Jeremy', 'test5@gmail.com', '201516354', '$2y$10$MVruymcQ.4uUkmJPWDtzC.yS9SClbW6k2sa1CNeUN8c/HJJRSh7eO', '09275011696', 'Male', '1997-11-11', 'uploads/1522021.jpg', '', '2022-06-18 17:23:09', '2021-03-09 16:43:59', 1, 1),
	(15, 'Juan De la Cruz', 'test11@gmail.com', NULL, '$2y$10$VG9hFQuFmLHXnB8UATNLWOXTJyw4g/0ok0D5bZSBLndJcEutih.ZS', '12345678', 'Male', '1990-11-11', 'uploads/charger.jpg', '', '2022-04-25 01:27:39', '2021-05-25 13:07:27', 0, 0),
	(17, 'Clint Jeremy Bare', 'test13@gmail.com', NULL, '$2y$10$FDFi50MxshFnHM.i8Nqs6ezOFa4WcZ9F26NwD2eUq3JSny6dJ8fVG', '1234577', 'Male', '1997-10-28', 'uploads/charger.jpg', '', '2022-04-25 01:28:14', '2021-05-25 16:57:21', 1, 0),
	(18, 'Clint Jeremy Bare', 'test14@gmail.com', NULL, '$2y$10$/.8tsmSpBF6xLm.EM5HAuOkEqotYh9Bp4uaKu.gckCSkOhcR5IJ7e', '321321312', 'Male', '1995-10-10', 'uploads/charger.jpg', '', '2021-05-26 10:44:27', '2021-05-26 10:17:57', 1, 1),
	(21, 'Clint Jeremy Bare', 'test17@gmail.com', NULL, '$2y$10$poDlbVt.EYIx0/Iig3a3Fe6u86O8R2Ktd8n25bXUV0cTvs53889Qe', '12321312', 'Male', '1990-10-10', 'uploads/charger.jpg', '', '2021-05-27 15:17:02', '2021-05-26 13:42:04', 1, 1),
	(28, 'Clint', 'test20@gmail.com', NULL, '$2y$10$fm.lbibA60KxMmNvCmKAzOox7alByQ2d9Bl1ZqfZ6pM.FNw9tHRwG', '123456789', 'Male', '1010-10-10', 'uploads/155909785_165490805267254_7760059071626110549_n.jpg', '', '2021-05-28 14:10:20', '2021-05-28 14:03:09', 1, 1),
	(49, 'tesssstsss', 'calixgaming97@cvsu.edu.ph', '21321312', '$2y$10$L0BwQwtqRK6zQR9larMsOu7Fzi5XY2mZUT8aRdRZyo3Uaz1FuZkAS', '', '', '', '', '', '2022-06-26 16:58:09', '2022-06-26 16:58:09', 0, 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table db_user_system.visitors
CREATE TABLE IF NOT EXISTS `visitors` (
  `id` int(2) NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table db_user_system.visitors: ~0 rows (approximately)
/*!40000 ALTER TABLE `visitors` DISABLE KEYS */;
INSERT INTO `visitors` (`id`, `hits`) VALUES
	(0, 876);
/*!40000 ALTER TABLE `visitors` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
