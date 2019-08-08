/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table movie.actor
CREATE TABLE IF NOT EXISTS `actor` (
  `actorid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`actorid`),
  UNIQUE KEY `actorid` (`actorid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table movie.director
CREATE TABLE IF NOT EXISTS `director` (
  `directorid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`directorid`),
  UNIQUE KEY `actorid` (`directorid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table movie.genre
CREATE TABLE IF NOT EXISTS `genre` (
  `genreid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`genreid`),
  UNIQUE KEY `genreid` (`genreid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=379 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table movie.studio
CREATE TABLE IF NOT EXISTS `studio` (
  `studioid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`studioid`),
  UNIQUE KEY `genreid` (`studioid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table movie.title
CREATE TABLE IF NOT EXISTS `title` (
  `unique` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `originaltitle` varchar(255) DEFAULT NULL,
  `sorttitle` varchar(255) DEFAULT NULL,
  `set` varchar(255) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `top250` int(11) DEFAULT NULL,
  `trailer` varchar(255) DEFAULT NULL,
  `votes` int(11) DEFAULT NULL,
  `rating` decimal(5,0) DEFAULT NULL,
  `outline` text DEFAULT NULL,
  `plot` text DEFAULT NULL,
  `tagline` text DEFAULT NULL,
  `runtime` int(11) DEFAULT NULL,
  `releasedate` date DEFAULT NULL,
  `studio` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT NULL,
  `fanart` varchar(255) DEFAULT NULL,
  `mpaa` varchar(255) DEFAULT NULL,
  `id` varchar(50) NOT NULL,
  `genreid` int(11) NOT NULL,
  `actorid` int(11) NOT NULL,
  `directorid` int(11) NOT NULL,
  `Added` datetime DEFAULT NULL,
  PRIMARY KEY (`unique`),
  UNIQUE KEY `id` (`unique`),
  UNIQUE KEY `title` (`title`),
  UNIQUE KEY `titleid` (`id`),
  UNIQUE KEY `orgtitle` (`originaltitle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table movie.titleactor
CREATE TABLE IF NOT EXISTS `titleactor` (
  `titactid` int(11) NOT NULL AUTO_INCREMENT,
  `titleid` int(11) NOT NULL,
  `actorid` int(11) NOT NULL,
  PRIMARY KEY (`titactid`),
  UNIQUE KEY `id` (`titactid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table movie.titledirector
CREATE TABLE IF NOT EXISTS `titledirector` (
  `titdirid` int(11) NOT NULL AUTO_INCREMENT,
  `titleid` int(11) NOT NULL,
  `diractorid` int(11) NOT NULL,
  PRIMARY KEY (`titdirid`),
  UNIQUE KEY `id` (`titdirid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table movie.titlegenre
CREATE TABLE IF NOT EXISTS `titlegenre` (
  `titgenid` int(11) NOT NULL AUTO_INCREMENT,
  `titleid` int(11) NOT NULL,
  `genreid` int(11) NOT NULL,
  PRIMARY KEY (`titgenid`),
  UNIQUE KEY `id` (`titgenid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table movie.titlestudio
CREATE TABLE IF NOT EXISTS `titlestudio` (
  `titstuid` int(11) NOT NULL AUTO_INCREMENT,
  `titleid` int(11) NOT NULL,
  `studiorid` int(11) NOT NULL,
  PRIMARY KEY (`titstuid`),
  UNIQUE KEY `id` (`titstuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
