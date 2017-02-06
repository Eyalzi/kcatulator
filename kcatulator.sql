-- --------------------------------------------------------
-- מארח:                         localhost
-- Server version:               5.7.17-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL גירסא:               9.3.0.5072
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for kcatulator
CREATE DATABASE IF NOT EXISTS `kcatulator` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `kcatulator`;

-- Dumping structure for table kcatulator.tbl_conditions
CREATE TABLE IF NOT EXISTS `tbl_conditions` (
  `ID` varchar(200) DEFAULT NULL,
  `Condition` varchar(200) DEFAULT NULL,
  `Enzyme_Amount` float DEFAULT NULL,
  `Flux` float DEFAULT NULL,
  `Kapp` float DEFAULT NULL,
  `Organism` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table kcatulator.tbl_reactions
CREATE TABLE IF NOT EXISTS `tbl_reactions` (
  `ID` varchar(200) DEFAULT NULL,
  `Reaction` varchar(200) DEFAULT NULL,
  `Reaction_Name` varchar(200) DEFAULT NULL,
  `Reaction_String` varchar(200) DEFAULT NULL,
  `EC_Number` varchar(200) DEFAULT NULL,
  `Gene_Name` varchar(200) DEFAULT NULL,
  `Gene_Id` varchar(200) DEFAULT NULL,
  `Organism` varchar(200) DEFAULT NULL,
  `Kcat` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
