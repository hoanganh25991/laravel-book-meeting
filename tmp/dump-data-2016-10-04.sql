-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.13-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.5105
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for book_meeting
CREATE DATABASE IF NOT EXISTS `book_meeting` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `book_meeting`;

-- Dumping structure for table book_meeting.bookings
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `start_date` datetime DEFAULT NULL,
  `end_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `room_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `description` tinytext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_room_id_foreign` (`room_id`),
  KEY `bookings_created_by_foreign` (`created_by`),
  CONSTRAINT `bookings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `bookings_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table book_meeting.bookings: ~7 rows (approximately)
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` (`id`, `start_date`, `end_date`, `room_id`, `created_by`, `description`, `created_at`, `updated_at`) VALUES
	(9, '2016-10-04 10:34:00', '2016-10-05 11:30:00', 1, 1, 'hoang anh ngu nhu bo', '2016-10-04 03:35:24', '2016-10-04 03:35:24'),
	(10, '2016-10-03 01:00:00', '2016-10-05 15:25:00', 1, 1, 'booking after create use as JOINED', '2016-10-04 08:58:35', '2016-10-04 08:58:35'),
	(11, '2016-10-12 02:30:00', '2016-10-12 17:14:00', 1, 1, 'vai lo chua, jquery now work with both other version', '2016-10-04 09:14:59', '2016-10-04 09:14:59'),
	(12, '2016-10-04 00:30:00', '2016-10-04 01:30:00', 1, 2, 'verify no need to load created_by', '2016-10-04 09:43:41', '2016-10-04 09:43:41');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;

-- Dumping structure for table book_meeting.booking_user
CREATE TABLE IF NOT EXISTS `booking_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `booking_id` int(10) unsigned NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `booking_user_booking_id_user_id_unique` (`user_id`,`booking_id`),
  KEY `booking_user_booking_id_foreign` (`booking_id`),
  CONSTRAINT `booking_user_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  CONSTRAINT `booking_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Dumping data for table book_meeting.booking_user: ~4 rows (approximately)
/*!40000 ALTER TABLE `booking_user` DISABLE KEYS */;
INSERT INTO `booking_user` (`id`, `user_id`, `booking_id`, `status`, `created_at`, `updated_at`) VALUES
	(11, 2, 9, 'joined', '2016-10-04 05:37:08', '2016-10-04 05:37:08'),
	(14, 3, 9, 'pending', '2016-10-04 08:20:10', '2016-10-04 08:20:10'),
	(20, 1, 10, 'joined', '2016-10-04 08:58:35', '2016-10-04 08:58:35'),
	(21, 1, 11, 'joined', '2016-10-04 09:14:59', '2016-10-04 09:14:59'),
	(22, 1, 9, 'joined', '2016-10-04 16:33:50', '2016-10-04 09:33:59'),
	(23, 2, 12, 'joined', '2016-10-04 09:43:41', '2016-10-04 09:43:41'),
	(24, 1, 12, 'joined', '2016-10-04 09:43:48', '2016-10-04 09:44:04'),
	(25, 3, 12, 'pending', '2016-10-04 17:22:09', '2016-10-04 17:22:11');
/*!40000 ALTER TABLE `booking_user` ENABLE KEYS */;

-- Dumping structure for table book_meeting.booking_versions
CREATE TABLE IF NOT EXISTS `booking_versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash_code` varchar(50) NOT NULL,
  `booking_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_versions_booking_id_foreign` (`booking_id`),
  CONSTRAINT `booking_versions_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table book_meeting.booking_versions: ~0 rows (approximately)
/*!40000 ALTER TABLE `booking_versions` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking_versions` ENABLE KEYS */;

-- Dumping structure for table book_meeting.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` tinytext,
  `created_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table book_meeting.groups: ~4 rows (approximately)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
	(1, 'originally', 'abc def ghk', 1, '2016-10-04 03:46:48', '2016-10-04 03:46:48'),
	(3, 'redoc', 'hello a tinker', 1, '2016-10-04 03:49:57', '2016-10-04 03:49:57'),
	(6, 'hoang anh ngu nhu bo', 'asdflkja;f', 1, '2016-10-04 04:08:16', '2016-10-04 04:08:16'),
	(7, 'askdlfj', 'aksldjflk', 2, '2016-10-04 04:10:16', '2016-10-04 04:10:16');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Dumping structure for table book_meeting.group_user
CREATE TABLE IF NOT EXISTS `group_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_user_group_id_user_id_unique` (`group_id`,`user_id`),
  KEY `group_user_user_id_foreign` (`user_id`),
  CONSTRAINT `group_user_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  CONSTRAINT `group_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dumping data for table book_meeting.group_user: ~9 rows (approximately)
/*!40000 ALTER TABLE `group_user` DISABLE KEYS */;
INSERT INTO `group_user` (`id`, `group_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'joined', '2016-10-04 03:46:48', '2016-10-04 03:46:48'),
	(3, 3, 1, 'joined', '2016-10-04 03:49:57', '2016-10-04 03:49:57'),
	(5, 6, 1, 'joined', '2016-10-04 04:08:16', '2016-10-04 04:08:16'),
	(6, 7, 2, 'pending', '2016-10-04 04:10:16', '2016-10-04 04:10:16'),
	(8, 1, 2, 'joined', '2016-10-04 11:37:17', '2016-10-04 07:43:31'),
	(14, 6, 2, 'joined', '2016-10-04 07:01:27', '2016-10-04 07:47:27'),
	(15, 3, 2, 'joined', '2016-10-04 07:01:43', '2016-10-04 07:47:22'),
	(17, 7, 1, 'pending', '2016-10-04 07:19:38', '2016-10-04 07:19:38'),
	(18, 1, 3, 'joined', '2016-10-04 14:20:59', '2016-10-04 07:46:30');
/*!40000 ALTER TABLE `group_user` ENABLE KEYS */;

-- Dumping structure for table book_meeting.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table book_meeting.migrations: ~13 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`migration`, `batch`) VALUES
	('2014_10_12_000000_create_users_table', 1),
	('2014_10_12_100000_create_password_resets_table', 1),
	('2016_09_28_103425_alter-table-bookings-add-foreign-key', 1),
	('2016_09_28_104145_alter-table-user_booking-add-foreign-key', 2),
	('2016_09_28_104910_alter-table-group_user-add-foreign-key', 3),
	('2016_09_28_105810_alter-table-booking_versions-add-foreign-key', 4),
	('2016_09_29_092011_alter-table-group_user-add-unique', 5),
	('2016_09_29_142153_alter-table-user_booking-rename', 6),
	('2016_10_03_023845_alter-table-booking_user-add-status', 7),
	('2016_10_03_042903_alter-table-bookings-rename-date', 8),
	('2016_10_03_043026_alter-table-bookings-add-column-end_date', 9),
	('2016_10_04_053804_alter-table-group-name-unique', 10),
	('2016_10_04_054107_alter-table-booking_user-booking-n-user-unique', 11);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table book_meeting.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table book_meeting.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table book_meeting.rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT 'meeting room',
  `address` tinytext,
  `locate` tinytext,
  `description` tinytext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table book_meeting.rooms: ~1 rows (approximately)
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` (`id`, `name`, `address`, `locate`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'office work', '110A Quoc Huong', 'lau 2', 'product discussion', '2016-10-03 06:54:13', '2016-10-03 06:54:13');
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;

-- Dumping structure for table book_meeting.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table book_meeting.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Anh Le Hoang', 'lehoanganh25991@gmail.com', '$2y$10$f3dTu47EYfD0WEeB6Xc8y.OggqG9HDp5IODgF4OcPL6e0K1f3Qdou', 'zUbiBLUc5qkWfHvX8PePAOrAuqGg94sSvUrhwExKngqUEEwwbfDkzFUmLkRi', '2016-10-03 04:10:22', '2016-10-04 07:20:10'),
	(2, 'Ti', 'user@admin.com', '$2y$10$xNw3H060GPTBsE5wjsn17OrDtrOYuuB9NEPnfdmj2E1sLptNP3Bm2', '7LPYxfERWBxWWCYpFgrdqVa5D0gDCWtnebBWvtWBJGOy1yQ1ZltOGG0qP3g5', '2016-10-04 04:09:47', '2016-10-04 06:35:25'),
	(3, 'user2', 'user2@admin.com', '$2y$10$6CVHiln/3DcTGWUj2hdgC.Llr8b7qJDyFr26vPmevka8xWdXqIf6i', 'X0GXEKXtYF2ZEoa3jpTa2EdsVbLozjeMJluBXu14R0YQmdbmLACUbgD8pyGH', '2016-10-04 07:20:34', '2016-10-04 07:21:11');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
