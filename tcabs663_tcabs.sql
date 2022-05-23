-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2022 at 04:41 AM
-- Server version: 5.7.23-23
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tcabs663_tcabs`
--

DELIMITER $$
--
-- Procedures
--
$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `PERMISSION`
--

CREATE TABLE `PERMISSION` (
  `pID` int(10) NOT NULL,
  `pName` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ROLE`
--

CREATE TABLE `ROLE` (
  `rID` int(10) NOT NULL,
  `rName` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE `USER` (
  `uID` int(10) NOT NULL,
  `uFName` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `uSName` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `uMobile` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `uEmail` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `USER`
--

INSERT INTO `USER` (`uID`, `uFName`, `uSName`, `uMobile`, `uEmail`) VALUES
(15, 'Brandon ', 'Ferry', '0448837759', 'Brandon_ferry@hotmail.com'),
(16, 'Braden', 'Steenvoorden', '0468573226', 'braden@hewstone.com.au');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `PERMISSION`
--
ALTER TABLE `PERMISSION`
  ADD PRIMARY KEY (`pID`),
  ADD UNIQUE KEY `pName` (`pName`);

--
-- Indexes for table `ROLE`
--
ALTER TABLE `ROLE`
  ADD PRIMARY KEY (`rID`),
  ADD UNIQUE KEY `rName` (`rName`);

--
-- Indexes for table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`uID`),
  ADD UNIQUE KEY `uEmail` (`uEmail`),
  ADD UNIQUE KEY `uMobile` (`uMobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `PERMISSION`
--
ALTER TABLE `PERMISSION`
  MODIFY `pID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ROLE`
--
ALTER TABLE `ROLE`
  MODIFY `rID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `USER`
--
ALTER TABLE `USER`
  MODIFY `uID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE Role_Permissions (
        rID INT(10) NOT NULL,
        pID INT(10) NOT NULL,
        PRIMARY KEY (rID, pID),
        CONSTRAINT FK_PermissionRoleID FOREIGN KEY (rID) REFERENCES Role(rID),
        CONSTRAINT FK_RoleIDPermission FOREIGN KEY (pID) REFERENCES PERMISSION(pID)
    );

DROP TABLE IF EXISTS Project_Teams;
DROP TABLE IF EXISTS Projects;
DROP TABLE IF EXISTS Teams;

CREATE TABLE Projects (
  pID INT(10) NOT NULL AUTO_INCREMENT,
  pName VARCHAR(50),
  pDescription VARCHAR(100),
  pStartDate DATE,
  pEndDate DATE,
  PRIMARY KEY (pID)
);
/
CREATE TABLE Teams (
  tID INT(10) NOT NULL AUTO_INCREMENT,
  tName varchar(50),
  PRIMARY KEY (tID)
);
/
CREATE TABLE Project_Teams (
  uID INT(9),
  tID INT(10),
  projectManager TINYINT,
  PRIMARY KEY (uID, tID),
  CONSTRAINT FK_userID FOREIGN KEY (uID) REFERENCES User(uID)
  ON DELETE CASCADE,
  CONSTRAINT FK_teamID FOREIGN KEY (tID) REFERENCES Teams(tID)
  ON DELETE RESTRICT
);
/
DROP PROCEDURE IF EXISTS AddProject;

DELIMITER $$

CREATE PROCEDURE AddProject(
    IN in_pName VARCHAR(50),
    IN in_pDescription varchar(100),
    IN in_pStartDate DATE,
    IN in_pEndDate DATE
)

BEGIN

  -- checks if project exists by checking project name and start date
  SELECT COUNT(*) INTO @rowcount1 FROM Projects
  WHERE pName = in_pName;

  SELECT COUNT(*) INTO @rowcount2 FROM Projects
  WHERE pStartDate = in_pStartDate;

  IF @rowcount1 <> 0 AND @rowcount2 <> 0 THEN
        SIGNAL SQLSTATE '45102'
          SET MESSAGE_TEXT = 'Project already registered', MYSQL_ERRNO = 20002;
  END IF;

  -- checks if start and end date is entered correctly
  IF in_pStartDate > in_pEndDate THEN
    SIGNAL SQLSTATE '45103'
      SET MESSAGE_TEXT = 'Start date cannot occur after end date', MYSQL_ERRNO = 20003;
  END IF; 

-- inserts new row into project table
  INSERT INTO Projects(pName, pDescription, pStartDate, pEndDate)
  VALUES (in_pName, in_pDescription, in_pStartDatE, in_pEndDate);

END$$

DELIMITER ;
/
DROP PROCEDURE IF EXISTS AddTeam;

DELIMITER $$

CREATE PROCEDURE AddTeam(
  IN in_tName VARCHAR(20)
)
BEGIN

-- checks if team name taken
  SELECT COUNT(*) INTO @rowcount FROM Teams
  WHERE tName = in_tName;

  IF @rowcount <> 0 THEN
    SIGNAL SQLSTATE '45104'
      SET MESSAGE_TEXT = 'Team name already registered', MYSQL_ERRNO = 20004;
  END IF;

  -- insert new row into team table
  INSERT INTO Teams(tName)
  VALUES (in_tName);
  
END$$

DELIMITER ;
/
DROP PROCEDURE IF EXISTS InsertUser;

DELIMITER $$

CREATE PROCEDURE InsertUser(
    IN inFName VARCHAR(20), 
    IN inSName VARCHAR(20),
    IN inBirthday DATE, 
    IN inMobile VARCHAR(13),
    IN inEmail VARCHAR(50), 
    IN inrID INT
)
BEGIN
  -- checks if mobile exists
  SELECT COUNT(*) INTO @rowcount FROM USER
  WHERE uMobile = inMobile;
      IF @rowcount <> 0 THEN
         SIGNAL SQLSTATE '45100'
          SET MESSAGE_TEXT = 'That mobile number already exists under a different user', MYSQL_ERRNO = 20000;
      END IF;

  -- checks if email exists
  SELECT COUNT(*) INTO @rowcount FROM USER
  WHERE uEmail = inEmail;
      IF @rowcount <> 0 THEN
         SIGNAL SQLSTATE '45101'
          SET MESSAGE_TEXT = 'That email already exists under a different user', MYSQL_ERRNO = 20001;
      END IF;
  
    -- insert a new row into User table
    INSERT INTO USER(uFName,uSName,birthday,uMobile,uEmail,rID, pWord)
    VALUES(inFName,inSName,inBirthday,inMobile,inEmail,inrID, birthday);

END$$

DELIMITER ;
/
DROP PROCEDURE IF EXISTS GetAllProjects;

DELIMITER $$

CREATE PROCEDURE GetAllProjects(
)
BEGIN

  SELECT * FROM Projects;

END$$

DELIMITER ;
/
DROP PROCEDURE IF EXISTS GetAllTeams;

DELIMITER $$

CREATE PROCEDURE GetAllTeams(
)
BEGIN

  SELECT * FROM Teams;

END$$

DELIMITER ;
/
DROP PROCEDURE IF EXISTS AddTeamMember;

DELIMITER $$

CREATE PROCEDURE AddTeamMember(
    IN in_uID INT(9),
    IN in_tID INT(10),
    IN in_projectManager TINYINT
)

BEGIN

  SELECT COUNT(*) INTO @rowcount
  FROM USER
  WHERE uID = in_uID;
    IF @rowcount = 0 THEN 
      SIGNAL SQLSTATE '45106'
        SET MESSAGE_TEXT = 'Student not registered', MYSQL_ERRNO = 20006;
    END IF;

  SELECT COUNT(*) INTO @rowcount2
  FROM teams
  WHERE tID = in_tID;
    IF @rowcount2 = 0 THEN 
      SIGNAL SQLSTATE '45107'
        SET MESSAGE_TEXT = 'Team not registered', MYSQL_ERRNO = 20007;
    END IF;

  SELECT COUNT(*) INTO @rowcount3
  FROM Project_Teams 
  WHERE uID = in_uID;
    IF @rowcount3 <> 0 THEN 
      SIGNAL SQLSTATE '45105'
        SET MESSAGE_TEXT = 'Student already in a team', MYSQL_ERRNO = 20005;
    END IF;

  INSERT INTO Project_teams (uID, tID, projectManager) 
  VALUES(in_uID, in_tID, in_projectManager);

END$$

DELIMITER ;
/
DROP PROCEDURE IF EXISTS DeleteTeamMember;

DELIMITER $$

CREATE PROCEDURE DeleteTeamMember(
    IN in_uID INT(10) 
)
BEGIN

  DELETE FROM Project_teams where uID=in_uID;

END$$

DELIMITER ;
/
DROP PROCEDURE IF EXISTS GetTeam;

DELIMITER $$

CREATE PROCEDURE GetTeam(
    IN in_tID INT(10) 
)
BEGIN

  SELECT * FROM Teams WHERE tID = in_tID;

END$$

DELIMITER ;
/
DROP PROCEDURE IF EXISTS GetTeamMembers;

DELIMITER $$

CREATE PROCEDURE GetTeamMembers(
    IN in_tID INT(10) 
)
BEGIN

  SELECT  teams.tName, 
          user.uID,
          user.uFName, 
          user.uSName
  FROM Project_teams pt 
  INNER JOIN teams ON teams.tID = pt.tID
  INNER JOIN user ON user.uID = pt.uID
  WHERE pt.tID = in_tID;
  
END$$

DELIMITER ;
/
DROP PROCEDURE IF EXISTS UpdateTeamName;

DELIMITER $$

CREATE PROCEDURE UpdateTeamName(
    IN in_tID INT(10),
    IN in_tName VARCHAR(50) 
)
BEGIN

  SELECT COUNT(*) INTO @rowcount
  FROM teams
  WHERE tName = in_tName;
    IF @rowcount <> 0 THEN
      SIGNAL SQLSTATE '45108'
        SET MESSAGE_TEXT = 'Team name already chosen', MYSQL_ERRNO = 20008;
    END IF;

  SELECT tName 
  FROM teams 
  WHERE tID = in_tID 
  FOR UPDATE;

  UPDATE teams
  SET tName = in_tName
  WHERE tID = in_tID;
  
END$$

DELIMITER ;
/
DROP PROCEDURE IF EXISTS DeleteMember;

DELIMITER $$

CREATE PROCEDURE DeleteMember(
    IN in_uID INT(9)
)
BEGIN

  DELETE FROM Project_Teams
  WHERE uID = in_uID;

END$$

DELIMITER ;
/
DROP PROCEDURE IF EXISTS GetUserTeamID;

DELIMITER $$

CREATE PROCEDURE GetUserTeamID(
    IN in_uID INT(9)
)
BEGIN

  SELECT tID from Project_Teams
  WHERE uID = in_uID;

END$$

DELIMITER ;
/
DROP PROCEDURE IF EXISTS GetProject;

DELIMITER $$

CREATE PROCEDURE GetProject(
    IN in_pID INT(10)
)
BEGIN

  SELECT * FROM Projects WHERE pID = in_pID;

END$$

DELIMITER ;
/
DROP PROCEDURE IF EXISTS DeleteProject;

DELIMITER $$

CREATE PROCEDURE DeleteProject(
    IN in_pID INT(10)
)
BEGIN

  DELETE FROM Projects
  WHERE pID = in_pID;

END$$

DELIMITER ;
/
DROP PROCEDURE IF EXISTS DeleteTeam;

DELIMITER $$

CREATE PROCEDURE DeleteTeam(
    IN in_tID INT(10)
)
BEGIN

  SELECT COUNT(*) INTO @rowcount
  FROM Project_teams
  WHERE tID = in_tID;
    IF @rowcount <> 0 THEN
      SIGNAL SQLSTATE '45108'
        SET MESSAGE_TEXT = 'Student still registered in team', MYSQL_ERRNO = 20008;
    END IF;

  DELETE FROM Teams
  WHERE tID = in_tID;

END$$

DELIMITER ;
/
DROP PROCEDURE IF EXISTS UpdateProject;

DELIMITER $$

CREATE PROCEDURE UpdateProject(
    IN in_pID INT(10),
    IN in_pName VARCHAR(50),
    IN in_pDescription VARCHAR(100),
    IN in_startDate date,
    IN in_endDate date

)
BEGIN

  SELECT COUNT(*) INTO @rowcount
  FROM projects
  WHERE pName = in_pName;
    IF @rowcount <> 0 THEN
      SIGNAL SQLSTATE '45108'
        SET MESSAGE_TEXT = 'Project name already chosen', MYSQL_ERRNO = 20008;
    END IF;

  SELECT COUNT(*) INTO @rowcount1 FROM Projects
  WHERE pName = in_pName;

  SELECT COUNT(*) INTO @rowcount2 FROM Projects
  WHERE pStartDate = in_startDate;

  IF @rowcount1 <> 0 AND @rowcount2 <> 0 THEN
        SIGNAL SQLSTATE '45102'
          SET MESSAGE_TEXT = 'Project already registered', MYSQL_ERRNO = 20002;
  END IF;

  IF in_startDate > in_endDate THEN
    SIGNAL SQLSTATE '45103'
      SET MESSAGE_TEXT = 'Start date cannot occur after end date', MYSQL_ERRNO = 20003;
  END IF;

  UPDATE projects
  SET 
    pName = in_pName,
    pDescription = in_pDescription,
    pStartDate = in_startDate,
    pEndDate = in_endDate
  WHERE pID = in_pID;
  
END$$

DELIMITER ;
/

CALL UpdateProject(1, "PLEASE", "I BEG YOU", "2022-05-28", "2022-08-29");