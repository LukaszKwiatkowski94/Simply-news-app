-- Simply News App - Database Schema
-- Tables structure without CREATE DATABASE statement

-- ============================================
-- Table: SN_users
-- ============================================
CREATE TABLE IF NOT EXISTS `SN_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================
-- Table: SN_categories
-- ============================================
CREATE TABLE IF NOT EXISTS `SN_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `is_active` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ============================================
-- Table: SN_news
-- ============================================
CREATE TABLE IF NOT EXISTS `SN_news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `author` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_updated` timestamp NULL DEFAULT NULL,
  `id_category` int DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  KEY `id_category` (`id_category`),
  CONSTRAINT `SN_news_ibfk_1` FOREIGN KEY (`author`) REFERENCES `SN_users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `SN_news_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `SN_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================
-- Table: SN_comments
-- ============================================
CREATE TABLE IF NOT EXISTS `SN_comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `newsID` int NOT NULL,
  `authorID` int NOT NULL,
  `content` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `newsID` (`newsID`),
  KEY `authorID` (`authorID`),
  CONSTRAINT `SN_comments_ibfk_1` FOREIGN KEY (`newsID`) REFERENCES `SN_news` (`id`) ON DELETE CASCADE,
  CONSTRAINT `SN_comments_ibfk_2` FOREIGN KEY (`authorID`) REFERENCES `SN_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
