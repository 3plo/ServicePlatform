-- --------------------------------------------------------
-- Сервер:                       127.0.0.1
-- Версія сервера:               5.6.31 - MySQL Community Server (GPL)
-- ОС сервера:                   Win32
-- HeidiSQL Версія:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for services_platform_db
CREATE DATABASE IF NOT EXISTS `services_platform_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `services_platform_db`;


-- Dumping structure for таблиця services_platform_db.access_type
CREATE TABLE IF NOT EXISTS `access_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.access_type_content
CREATE TABLE IF NOT EXISTS `access_type_content` (
  `id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `priority` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`language_id`),
  UNIQUE KEY `title` (`title`),
  KEY `id_language_id` (`id`,`language_id`),
  KEY `access_type_content_language` (`language_id`),
  CONSTRAINT `access_type_content_access_type` FOREIGN KEY (`id`) REFERENCES `access_type` (`id`),
  CONSTRAINT `access_type_content_language` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.category_content
CREATE TABLE IF NOT EXISTS `category_content` (
  `id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `priority` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`language_id`),
  UNIQUE KEY `title` (`title`),
  KEY `id_language_id` (`id`,`language_id`),
  KEY `category_content_language` (`language_id`),
  CONSTRAINT `category_content_category` FOREIGN KEY (`id`) REFERENCES `category` (`id`),
  CONSTRAINT `category_content_language` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.category_group
CREATE TABLE IF NOT EXISTS `category_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL DEFAULT '0',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  `comment` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_id_group_id` (`category_id`,`group_id`),
  KEY `group_id` (`group_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `category_group_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `category_group_group` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.group
CREATE TABLE IF NOT EXISTS `group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.group_content
CREATE TABLE IF NOT EXISTS `group_content` (
  `id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `priority` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`language_id`),
  UNIQUE KEY `title` (`title`),
  KEY `id_language_id` (`id`,`language_id`),
  KEY `group_content_language` (`language_id`),
  CONSTRAINT `group_content_group` FOREIGN KEY (`id`) REFERENCES `group` (`id`),
  CONSTRAINT `group_content_language` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.language
CREATE TABLE IF NOT EXISTS `language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `alias` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.location
CREATE TABLE IF NOT EXISTS `location` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL DEFAULT '',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`),
  KEY `updated_at` (`updated_at`),
  KEY `group_id` (`group_id`),
  KEY `location_updated_by` (`updated_by`),
  CONSTRAINT `location_location_group` FOREIGN KEY (`group_id`) REFERENCES `location_group` (`id`),
  CONSTRAINT `location_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.location_content
CREATE TABLE IF NOT EXISTS `location_content` (
  `id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `priority` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`language_id`),
  UNIQUE KEY `title` (`title`),
  KEY `id_language_id` (`id`,`language_id`),
  KEY `location_content_language` (`language_id`),
  CONSTRAINT `location_content_language` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`),
  CONSTRAINT `location_content_location` FOREIGN KEY (`id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.location_group
CREATE TABLE IF NOT EXISTS `location_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.location_group_content
CREATE TABLE IF NOT EXISTS `location_group_content` (
  `id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `priority` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`language_id`),
  UNIQUE KEY `title` (`title`),
  KEY `id_language_id` (`id`,`language_id`),
  KEY `location_group_content_language` (`language_id`),
  CONSTRAINT `location_group_content_language` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`),
  CONSTRAINT `location_group_content_location_group` FOREIGN KEY (`id`) REFERENCES `location_group` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.role
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL DEFAULT '',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`),
  KEY `updated_at` (`updated_at`),
  KEY `role_updated_by` (`updated_by`),
  CONSTRAINT `role_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.role_content
CREATE TABLE IF NOT EXISTS `role_content` (
  `id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `priority` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`language_id`),
  UNIQUE KEY `title` (`title`),
  KEY `id_language_id` (`id`,`language_id`),
  KEY `role_content_language` (`language_id`),
  CONSTRAINT `role_conetnt_role` FOREIGN KEY (`id`) REFERENCES `role` (`id`),
  CONSTRAINT `role_content_language` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.service
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `price` double unsigned NOT NULL DEFAULT '0',
  `price_fee` double unsigned NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `updated_at` (`updated_at`),
  KEY `service_updated_by` (`updated_by`),
  KEY `price` (`price`),
  KEY `price_fee` (`price_fee`),
  CONSTRAINT `service_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.service_content
CREATE TABLE IF NOT EXISTS `service_content` (
  `id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `priority` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`language_id`),
  UNIQUE KEY `title` (`title`),
  KEY `id_language_id` (`id`,`language_id`),
  KEY `service_content_language` (`language_id`),
  CONSTRAINT `service_content_language` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`),
  CONSTRAINT `service_content_service` FOREIGN KEY (`id`) REFERENCES `service` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.service_group
CREATE TABLE IF NOT EXISTS `service_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(10) unsigned NOT NULL DEFAULT '0',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_id_group_id` (`service_id`,`group_id`),
  KEY `service_group_group` (`group_id`),
  KEY `service_id` (`service_id`),
  CONSTRAINT `service_group_group` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`),
  CONSTRAINT `service_group_service` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.service_location
CREATE TABLE IF NOT EXISTS `service_location` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(10) unsigned NOT NULL DEFAULT '0',
  `location_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_id_location_id` (`service_id`,`location_id`),
  KEY `service_id` (`service_id`),
  KEY `location_id` (`location_id`),
  CONSTRAINT `service_location_location` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`),
  CONSTRAINT `service_location_service` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.service_user
CREATE TABLE IF NOT EXISTS `service_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_id_user_id` (`service_id`,`user_id`),
  KEY `service_id` (`service_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `service_user_service` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`),
  CONSTRAINT `service_user_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.service_user_history
CREATE TABLE IF NOT EXISTS `service_user_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(10) unsigned NOT NULL DEFAULT '0',
  `service_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `date_info` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` int(10) unsigned NOT NULL DEFAULT '0',
  `info` text,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `service_user_id` (`service_user_id`),
  KEY `date_info` (`date_info`),
  KEY `author` (`author`),
  CONSTRAINT `service_user_history_author` FOREIGN KEY (`author`) REFERENCES `user` (`id`),
  CONSTRAINT `service_user_history_service_user` FOREIGN KEY (`service_user_id`) REFERENCES `service_user` (`id`),
  CONSTRAINT `service_user_history_service_user_status` FOREIGN KEY (`status`) REFERENCES `service_user_status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.service_user_status
CREATE TABLE IF NOT EXISTS `service_user_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.service_user_status_content
CREATE TABLE IF NOT EXISTS `service_user_status_content` (
  `id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `priority` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`language_id`),
  UNIQUE KEY `title` (`title`),
  KEY `id_language_id` (`id`,`language_id`),
  KEY `service_user_status_content_language` (`language_id`),
  CONSTRAINT `service_user_status_content_language` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`),
  CONSTRAINT `service_user_status_content_service_user_status` FOREIGN KEY (`id`) REFERENCES `service_user_status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(25) NOT NULL DEFAULT '',
  `login` varchar(25) NOT NULL DEFAULT '',
  `firstname` varchar(25) NOT NULL DEFAULT '',
  `lastname` varchar(25) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(15) NOT NULL DEFAULT '',
  `info` text,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  KEY `user_updated_by` (`updated_by`),
  KEY `password` (`password`),
  KEY `firstname` (`firstname`),
  KEY `lastname` (`lastname`),
  KEY `email` (`email`),
  KEY `phone` (`phone`),
  KEY `active` (`active`),
  CONSTRAINT `user_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.user_access
CREATE TABLE IF NOT EXISTS `user_access` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `aceess_type_id` int(10) unsigned NOT NULL,
  `comment` text,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `addet_by` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_aceess_type_id` (`user_id`,`aceess_type_id`),
  KEY `user_access_access_type` (`aceess_type_id`),
  KEY `user_access_updated_by` (`addet_by`),
  KEY `active` (`active`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_access_access_type` FOREIGN KEY (`aceess_type_id`) REFERENCES `access_type` (`id`),
  CONSTRAINT `user_access_updated_by` FOREIGN KEY (`addet_by`) REFERENCES `user` (`id`),
  CONSTRAINT `user_access_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.user_category
CREATE TABLE IF NOT EXISTS `user_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0',
  `comment` text,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_category_id` (`user_id`,`category_id`),
  KEY `active` (`active`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `user_category_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `user_category_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`),
  CONSTRAINT `user_category_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.user_location
CREATE TABLE IF NOT EXISTS `user_location` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `location_id` int(10) unsigned NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_city_id` (`user_id`,`location_id`),
  KEY `updated_at` (`updated_at`),
  KEY `user_location_updaetd_by` (`updated_by`),
  KEY `user_location_location` (`location_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_location_location` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`),
  CONSTRAINT `user_location_updaetd_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`),
  CONSTRAINT `user_location_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані


-- Dumping structure for таблиця services_platform_db.user_role
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `role_id` int(10) unsigned NOT NULL DEFAULT '0',
  `comment` text,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_role_id` (`user_id`,`role_id`),
  KEY `active` (`active`),
  KEY `user_role_role` (`role_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_role_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
  CONSTRAINT `user_role_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дані для експорту не вибрані
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
