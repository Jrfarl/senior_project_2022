CREATE DATABASE `SeniorProject` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE SeniorProject;

CREATE TABLE `Users` (
  `User_ID` int NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(128) NOT NULL,
  `Last_Name` varchar(128) NOT NULL,
  `Username` varchar(64) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `Session_IP` varchar(45) DEFAULT NULL,
  `User_Status` tinyint(1) NOT NULL DEFAULT '1',
  `Session_ID` varchar(128) DEFAULT NULL,
  `Email` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`User_ID`),
  UNIQUE KEY `Username_UNIQUE` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Status` (
  `Status_Code` int NOT NULL,
  `Status_Name` varchar(128) NOT NULL,
  PRIMARY KEY (`Status_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Priority` (
  `Priority_Level` int NOT NULL,
  `Priority_Name` varchar(45) NOT NULL,
  PRIMARY KEY (`Priority_Level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Group_Reference` (
  `Group_ID` int NOT NULL AUTO_INCREMENT,
  `Group_Name` varchar(128) NOT NULL,
  PRIMARY KEY (`Group_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Config` (
  `Config_ID` int NOT NULL AUTO_INCREMENT,
  `Key` varchar(128) NOT NULL,
  `Value` varchar(128) NOT NULL,
  PRIMARY KEY (`Config_ID`),
  UNIQUE KEY `Key_UNIQUE` (`Key`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Tickets` (
  `Ticket_ID` int NOT NULL AUTO_INCREMENT,
  `Title` varchar(128) NOT NULL,
  `Status_Code` int NOT NULL DEFAULT '0',
  `Description` text,
  `Assigned_To_User_ID` text,
  `Created_By_ID` int NOT NULL,
  `Date_Created` datetime DEFAULT CURRENT_TIMESTAMP,
  `Metadata` text,
  `Priority_Level` int DEFAULT NULL,
  `Assigned_To_Group_ID` text,
  PRIMARY KEY (`Ticket_ID`),
  KEY `fk_Tickets_created_by_idx` (`Created_By_ID`),
  KEY `FK_Ticket_Status_Code_idx` (`Status_Code`),
  KEY `FK_Ticket_Priority_Level_idx` (`Priority_Level`),
  CONSTRAINT `FK_Ticket_Created_By_User` FOREIGN KEY (`Created_By_ID`) REFERENCES `Users` (`User_ID`),
  CONSTRAINT `FK_Ticket_Priority_Level` FOREIGN KEY (`Priority_Level`) REFERENCES `Priority` (`Priority_Level`),
  CONSTRAINT `FK_Ticket_Status_Code` FOREIGN KEY (`Status_Code`) REFERENCES `Status` (`Status_Code`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Comments` (
  `Comment_ID` int NOT NULL AUTO_INCREMENT,
  `Parent_Ticket_ID` int NOT NULL,
  `Parent_Comment_ID` int DEFAULT NULL,
  `Comment_Text` tinytext NOT NULL,
  `Date_Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Created_By_ID` int NOT NULL,
  PRIMARY KEY (`Comment_ID`),
  KEY `FK_Comments_Parent_Ticket_idx` (`Parent_Ticket_ID`),
  KEY `FK_Comments_Parent_Comments_idx` (`Parent_Comment_ID`),
  KEY `FK_Comments_Created_By_User_idx` (`Created_By_ID`),
  CONSTRAINT `FK_Comments_Created_By_User` FOREIGN KEY (`Created_By_ID`) REFERENCES `Users` (`User_ID`),
  CONSTRAINT `FK_Comments_Parent_Comments` FOREIGN KEY (`Parent_Comment_ID`) REFERENCES `Comments` (`Comment_ID`),
  CONSTRAINT `FK_Comments_Parent_Ticket` FOREIGN KEY (`Parent_Ticket_ID`) REFERENCES `Tickets` (`Ticket_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Group_Users` (
  `Line_ID` int NOT NULL AUTO_INCREMENT,
  `User_ID` int NOT NULL,
  `Group_ID` int NOT NULL,
  PRIMARY KEY (`Line_ID`),
  KEY `FK_Group_User_User_ID_idx` (`User_ID`),
  KEY `FK_Group_Users_Group_ID_idx` (`Group_ID`),
  CONSTRAINT `FK_Group_Users_Group_ID` FOREIGN KEY (`Group_ID`) REFERENCES `Group_Reference` (`Group_ID`),
  CONSTRAINT `FK_Group_Users_User_ID` FOREIGN KEY (`User_ID`) REFERENCES `Users` (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Group_Permissions` (
  `Line_ID` int NOT NULL AUTO_INCREMENT,
  `Group_ID` int NOT NULL,
  `Permission` text NOT NULL,
  PRIMARY KEY (`Line_ID`),
  KEY `FK_Group_Permissions_Group_ID_idx` (`Group_ID`),
  CONSTRAINT `FK_Group_Permissions_Group_ID` FOREIGN KEY (`Group_ID`) REFERENCES `Group_Reference` (`Group_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Archived_Tickets` (
  `Ticket_ID` int NOT NULL,
  `Title` varchar(128) NOT NULL,
  `Status_Code` int NOT NULL,
  `Description` text,
  `Assigned_To_User_ID` text,
  `Created_By_ID` int NOT NULL,
  `Metadata` text,
  `Date_Created` datetime DEFAULT NULL,
  `Date_Archived` datetime DEFAULT CURRENT_TIMESTAMP,
  `Priority_Level` int DEFAULT NULL,
  `Assigned_To_Group_ID` text,
  PRIMARY KEY (`Ticket_ID`),
  KEY `FK_Archived_Tickets_Created_By_User_idx` (`Created_By_ID`),
  KEY `FK_Archived_Tickets_Status_Code_idx` (`Status_Code`),
  KEY `FK_Archived_Tickets_Priority_Level_idx` (`Priority_Level`),
  CONSTRAINT `FK_Archived_Tickets_Created_By_User` FOREIGN KEY (`Created_By_ID`) REFERENCES `Users` (`User_ID`),
  CONSTRAINT `FK_Archived_Tickets_Priority_Level` FOREIGN KEY (`Priority_Level`) REFERENCES `Priority` (`Priority_Level`),
  CONSTRAINT `FK_Archived_Tickets_Status_Code` FOREIGN KEY (`Status_Code`) REFERENCES `Status` (`Status_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Archived_Comments` (
  `Comment_ID` int NOT NULL,
  `Parent_Ticket_ID` int NOT NULL,
  `Parent_Comment_ID` int DEFAULT NULL,
  `Comment_Text` tinytext NOT NULL,
  `Date_Created` datetime NOT NULL,
  `Created_By_ID` int NOT NULL,
  PRIMARY KEY (`Comment_ID`),
  KEY `FK_Archived_Comments_Parent_Ticket_idx` (`Parent_Ticket_ID`),
  KEY `FK_Archived_Comments_Created_By_User_idx` (`Created_By_ID`),
  KEY `FK_Archived_Comments_Parent_Comment_idx` (`Parent_Comment_ID`),
  CONSTRAINT `FK_Archived_Comments_Created_By_User` FOREIGN KEY (`Created_By_ID`) REFERENCES `Users` (`User_ID`),
  CONSTRAINT `FK_Archived_Comments_Parent_Ticket` FOREIGN KEY (`Parent_Ticket_ID`) REFERENCES `Archived_Tickets` (`Ticket_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
