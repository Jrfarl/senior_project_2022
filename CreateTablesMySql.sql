CREATE TABLE `Tickets` (
  `Ticket_ID` int NOT NULL,
  `Title` varchar(128) NOT NULL,
  `Status_Code` int NOT NULL DEFAULT '0',
  `Description` tinytext,
  `Assigned_To_ID` int DEFAULT NULL,
  `Created_By_ID` int NOT NULL,
  `Date_Created` datetime DEFAULT CURRENT_TIMESTAMP,
  `Metadata` text,
  PRIMARY KEY (`Ticket_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Users` (
  `User_ID` int NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(128) NOT NULL,
  `Last_Name` varchar(128) NOT NULL,
  `Group_ID` int NOT NULL,
  `Login_ID` varchar(64) NOT NULL,
  `Encrypted_Password` varchar(128) NOT NULL,
  PRIMARY KEY (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Status` (
  `Status_Code` int NOT NULL,
  `Status_Name` varchar(128) NOT NULL,
  PRIMARY KEY (`Status_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Groups` (
  `Group_ID` int NOT NULL AUTO_INCREMENT,
  `Group_Name` varchar(128) NOT NULL,
  `Priviledge_Level` int NOT NULL,
  PRIMARY KEY (`Group_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Config` (
  `Config_ID` int NOT NULL AUTO_INCREMENT,
  `Key` int NOT NULL,
  `Value` varchar(128) NOT NULL,
  PRIMARY KEY (`Config_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `Comments` (
  `Comment_ID` int NOT NULL AUTO_INCREMENT,
  `Parent_Ticket_ID` int NOT NULL,
  `Parent_Comment_ID` int DEFAULT NULL,
  `Comment_Text` tinytext NOT NULL,
  `Date_Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Created_By` varchar(45) NOT NULL,
  PRIMARY KEY (`Comment_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
