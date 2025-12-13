CREATE DATABASE IF NOT EXISTS `thegrandhotel`;
use `thegrandhotel`;


CREATE TABLE `Person` (
  `PersonID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PersonID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `StaffRoles` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(50) NOT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Floors` (
  `FloorID` int(11) NOT NULL AUTO_INCREMENT,
  `FloorNumber` int(11) NOT NULL,
  PRIMARY KEY (`FloorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `RoomTypes` (
  `RoomTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(50) NOT NULL,
  `BasePrice` decimal(10,2) NOT NULL,
  PRIMARY KEY (`RoomTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Customers` (
  `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
  `PersonID` int(11) NOT NULL,
  PRIMARY KEY (`CustomerID`),
  KEY `PersonID` (`PersonID`),
  CONSTRAINT `customers_fk_person`
    FOREIGN KEY (`PersonID`) REFERENCES `Person` (`PersonID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Staff` (
  `StaffID` int(11) NOT NULL AUTO_INCREMENT,
  `PersonID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `PasswordHash` varbinary(255) NOT NULL,
  PRIMARY KEY (`StaffID`),
  KEY `PersonID` (`PersonID`),
  KEY `RoleID` (`RoleID`),
  CONSTRAINT `staff_fk_person`
    FOREIGN KEY (`PersonID`) REFERENCES `Person` (`PersonID`),
  CONSTRAINT `staff_fk_role`
    FOREIGN KEY (`RoleID`) REFERENCES `StaffRoles` (`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Rooms` (
  `RoomID` int(11) NOT NULL AUTO_INCREMENT,
  `RoomNumber` varchar(10) NOT NULL,
  `RoomTypeID` int(11) NOT NULL,
  `FloorID` int(11) NOT NULL,
  PRIMARY KEY (`RoomID`),
  UNIQUE KEY `RoomNumber` (`RoomNumber`),
  KEY `RoomTypeID` (`RoomTypeID`),
  KEY `FloorID` (`FloorID`),
  CONSTRAINT `rooms_fk_roomtype`
    FOREIGN KEY (`RoomTypeID`) REFERENCES `RoomTypes` (`RoomTypeID`),
  CONSTRAINT `rooms_fk_floor`
    FOREIGN KEY (`FloorID`) REFERENCES `Floors` (`FloorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Bookings` (
  `BookingID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `ExpectedCheckIn` date NOT NULL,
  `ExpectedCheckOut` date NOT NULL,
  `ActualCheckIn` datetime DEFAULT NULL,
  `ActualCheckOut` datetime DEFAULT NULL,
  PRIMARY KEY (`BookingID`),
  KEY `CustomerID` (`CustomerID`),
  KEY `RoomID` (`RoomID`),
  CONSTRAINT `bookings_fk_customer`
    FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`),
  CONSTRAINT `bookings_fk_room`
    FOREIGN KEY (`RoomID`) REFERENCES `Rooms` (`RoomID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `CleaningAssignments` (
  `AssignmentID` int(11) NOT NULL AUTO_INCREMENT,
  `StaffID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `AssignmentDate` date NOT NULL,
  `Completed` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`AssignmentID`),
  KEY `StaffID` (`StaffID`),
  KEY `RoomID` (`RoomID`),
  CONSTRAINT `cleaning_fk_staff`
    FOREIGN KEY (`StaffID`) REFERENCES `Staff` (`StaffID`),
  CONSTRAINT `cleaning_fk_room`
    FOREIGN KEY (`RoomID`) REFERENCES `Rooms` (`RoomID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `StaffAttendance` (
  `AttendanceID` int(11) NOT NULL AUTO_INCREMENT,
  `StaffID` int(11) NOT NULL,
  `ClockInTime` datetime NOT NULL,
  `ClockOutTime` datetime DEFAULT NULL,
  PRIMARY KEY (`AttendanceID`),
  KEY `StaffID` (`StaffID`),
  CONSTRAINT `attendance_fk_staff`
    FOREIGN KEY (`StaffID`) REFERENCES `Staff` (`StaffID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
