-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.18-log - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица diplom.cities
CREATE TABLE IF NOT EXISTS `cities` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `c_name` varchar(250) NOT NULL,
  `с_description` varchar(350) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы diplom.cities: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` (`c_id`, `c_name`, `с_description`) VALUES
	(1, 'Токио', 'Цветущий токио - столица японии '),
	(2, 'Логдон', NULL),
	(3, 'Париж', NULL),
	(4, 'Лас-Вегас', NULL);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;

-- Дамп структуры для таблица diplom.rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `r_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `r_name` varchar(250) NOT NULL,
  `r_desc` varchar(300) NOT NULL,
  `r_price` int(10) unsigned NOT NULL,
  `r_start` int(10) unsigned NOT NULL,
  `r_end` int(10) unsigned NOT NULL,
  `r_city` int(10) unsigned NOT NULL,
  `r_capacity` int(10) NOT NULL DEFAULT '1',
  `r_capacity_child` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы diplom.rooms: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` (`r_id`, `r_name`, `r_desc`, `r_price`, `r_start`, `r_end`, `r_city`, `r_capacity`, `r_capacity_child`) VALUES
	(1, 'Спальгы', 'аываы ', 433, 1527638400, 1528738400, 1, 1, 3);
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;

-- Дамп структуры для таблица diplom.rooms_convs
CREATE TABLE IF NOT EXISTS `rooms_convs` (
  `rc_room_id` int(10) unsigned NOT NULL,
  `rc_stars` tinyint(3) unsigned NOT NULL DEFAULT '3',
  `rc_wifi` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `rc_transfer` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `rc_parking` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `rc_pool` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `rc_fitness` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `rc_balcony` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `rc_cond` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `rc_coffee` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `rc_tub` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`rc_room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы diplom.rooms_convs: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `rooms_convs` DISABLE KEYS */;
INSERT INTO `rooms_convs` (`rc_room_id`, `rc_stars`, `rc_wifi`, `rc_transfer`, `rc_parking`, `rc_pool`, `rc_fitness`, `rc_balcony`, `rc_cond`, `rc_coffee`, `rc_tub`) VALUES
	(1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1);
/*!40000 ALTER TABLE `rooms_convs` ENABLE KEYS */;

-- Дамп структуры для таблица diplom.users
CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `u_email` varchar(150) NOT NULL,
  `u_name` varchar(150) NOT NULL,
  `u_pass` varchar(150) NOT NULL,
  `u_registered` int(10) unsigned DEFAULT NULL,
  `u_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `u_email_UNIQUE` (`u_email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы diplom.users: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`u_id`, `u_email`, `u_name`, `u_pass`, `u_registered`, `u_admin`) VALUES
	(8, 'roman@a.com', 'Roman', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1527625628, 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
