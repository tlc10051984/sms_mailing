-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.3.13-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных bd_sms
CREATE DATABASE IF NOT EXISTS `bd_sms` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bd_sms`;

-- Дамп структуры для таблица bd_sms.bufer
CREATE TABLE IF NOT EXISTS `bufer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `date` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы bd_sms.bufer: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `bufer` DISABLE KEYS */;
INSERT INTO `bufer` (`id`, `id_client`, `name`, `status`, `date`) VALUES
	(64, 1, 'REX', NULL, '12.11.2021'),
	(65, 1, 'REX', NULL, '12.11.2021'),
	(66, 1, 'REX', NULL, '12.11.2021');
/*!40000 ALTER TABLE `bufer` ENABLE KEYS */;

-- Дамп структуры для таблица bd_sms.name
CREATE TABLE IF NOT EXISTS `name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `date` text DEFAULT NULL,
  `e_mail` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Дамп данных таблицы bd_sms.name: ~11 rows (приблизительно)
/*!40000 ALTER TABLE `name` DISABLE KEYS */;
INSERT INTO `name` (`id`, `id_client`, `name`, `status`, `date`, `e_mail`) VALUES
	(24, 1, 'REX', 0, '11.11.2021', 'tlc10051984@gmail.com'),
	(27, 1, 'REX', 0, '11.11.2021', 'tlc10051984@gmail.com'),
	(28, 1, 'REX', 0, '11.11.2021', 'tlc10051984@gmail.com'),
	(29, 1, 'REX', 0, '11.11.2021', 'tlc10051984@gmail.com'),
	(30, 1, 'REX', 0, '11.11.2021', 'tlc10051984@gmail.com'),
	(31, 1, 'REX', 0, '12.11.2021', 'tlc10051984@gmail.com'),
	(32, 1, 'REX', 0, '12.11.2021', 'tlc10051984@gmail.com'),
	(33, 1, 'REX', 0, '12.11.2021', 'tlc10051984@gmail.com'),
	(34, 1, 'REX', 0, '12.11.2021', 'tlc10051984@gmail.com'),
	(35, 1, 'REX', 0, '12.11.2021', 'tlc10051984@gmail.com'),
	(36, 1, 'REX', 1, '12.11.2021', 'tlc10051984@gmail.com');
/*!40000 ALTER TABLE `name` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
