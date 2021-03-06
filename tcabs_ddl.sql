SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
DROP TABLE IF EXISTS Project_Teams;
DROP TABLE IF EXISTS ENROL;
DROP TABLE IF EXISTS Projects;
DROP TABLE IF EXISTS Teams;
DROP TABLE IF EXISTS PERMISSION;
DROP TABLE IF EXISTS ROLE;
DROP TABLE IF EXISTS ROLE PERMISSION;
DROP TABLE IF EXISTS UNIT;
DROP TABLE IF EXISTS USER;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `ENROL` (
  `uID` int(9) NOT NULL,
  `unitID` int(10) NOT NULL,
  `tpID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `PERMISSION` (
  `pID` int(10) NOT NULL,
  `pName` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `Projects` (
  `pID` int(10) NOT NULL,
  `pName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pDescription` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pStartDate` date DEFAULT NULL,
  `pEndDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `Project_Teams` (
  `uID` int(9) NOT NULL,
  `tID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `ROLE` (
  `rID` int(10) NOT NULL,
  `rName` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `ROLE PERMISSIONS` (
  `rID` int(10) NOT NULL,
  `pID` int(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `Teaching_Period` (
  `tpID` int(10) NOT NULL,
  `tpName` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tpStartDate` date NOT NULL,
  `tpEndDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `Teams` (
  `tID` int(10) NOT NULL,
  `tName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `UNIT` (
  `unitID` int(10) NOT NULL,
  `unitCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `unitName` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `USER` (
  `uID` int(9) NOT NULL,
  `uFName` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `uSName` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `uMobile` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `uEmail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rID` int(10) NOT NULL,
  `pWord` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


ALTER TABLE `ENROL`
  ADD PRIMARY KEY (`uID`,`unitID`),
  ADD KEY `fk_tpID` (`tpID`),
  ADD KEY `fk_unitID` (`unitID`);

ALTER TABLE `PERMISSION`
  ADD PRIMARY KEY (`pID`),
  ADD UNIQUE KEY `pName` (`pName`);

ALTER TABLE `Projects`
  ADD PRIMARY KEY (`pID`);

ALTER TABLE `Project_Teams`
  ADD PRIMARY KEY (`uID`,`tID`),
  ADD KEY `fk_teamID` (`tID`);

ALTER TABLE `ROLE`
  ADD PRIMARY KEY (`rID`),
  ADD UNIQUE KEY `rName` (`rName`);

ALTER TABLE `ROLE PERMISSIONS`
  ADD PRIMARY KEY (`rID`,`pID`),
  ADD KEY `rID` (`rID`),
  ADD KEY `pID` (`pID`);

ALTER TABLE `Teaching_Period`
  ADD PRIMARY KEY (`tpID`);

ALTER TABLE `Teams`
  ADD PRIMARY KEY (`tID`);

ALTER TABLE `UNIT`
  ADD PRIMARY KEY (`unitID`),
  ADD UNIQUE KEY `unitCode` (`unitCode`);

ALTER TABLE `USER`
  ADD PRIMARY KEY (`uID`),
  ADD UNIQUE KEY `uEmail` (`uEmail`),
  ADD UNIQUE KEY `uMobile` (`uMobile`),
  ADD KEY `rID` (`rID`);


ALTER TABLE `PERMISSION`
  MODIFY `pID` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Projects`
  MODIFY `pID` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ROLE`
  MODIFY `rID` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Teaching_Period`
  MODIFY `tpID` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Teams`
  MODIFY `tID` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `UNIT`
  MODIFY `unitID` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `USER`
  MODIFY `uID` int(9) NOT NULL AUTO_INCREMENT;


ALTER TABLE `ENROL`
  ADD CONSTRAINT `fk_tpID` FOREIGN KEY (`tpID`) REFERENCES `Teaching_Period` (`tpID`),
  ADD CONSTRAINT `fk_userID` FOREIGN KEY (`uID`) REFERENCES `USER` (`uID`);

ALTER TABLE `Project_Teams`
  ADD CONSTRAINT `fk_teamID` FOREIGN KEY (`tID`) REFERENCES `Teams` (`tID`),
  ADD CONSTRAINT `fk_uID` FOREIGN KEY (`uID`) REFERENCES `USER` (`uID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `ROLE PERMISSIONS`
  ADD CONSTRAINT `fk_permID` FOREIGN KEY (`pID`) REFERENCES `PERMISSION` (`pID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_roleID` FOREIGN KEY (`rID`) REFERENCES `ROLE` (`rID`) ON UPDATE CASCADE;

ALTER TABLE `USER`
  ADD CONSTRAINT `USER_ibfk_1` FOREIGN KEY (`rID`) REFERENCES `ROLE` (`rID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
