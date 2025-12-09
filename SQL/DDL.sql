CREATE Database IF NOT EXISTS `FourSeasonsHotel`;
USE `FourSeasonsHotel`;

CREATE TABLE `Bookings` (
  `BookingID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `ExpectedCheckIn` date NOT NULL,
  `ExpectedCheckOut` date NOT NULL,
  `ActualCheckIn` datetime DEFAULT NULL,
  `ActualCheckOut` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `CleaningAssignments` (
  `AssignmentID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `AssignmentDate` date NOT NULL,
  `Completed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Customers` (
  `CustomerID` int(11) NOT NULL,
  `PersonID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Floors` (
  `FloorID` int(11) NOT NULL,
  `FloorNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Person` (
  `PersonID` int(11) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Rooms` (
  `RoomID` int(11) NOT NULL,
  `RoomNumber` varchar(10) NOT NULL,
  `RoomTypeID` int(11) NOT NULL,
  `FloorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `RoomTypes` (
  `RoomTypeID` int(11) NOT NULL,
  `Description` varchar(50) NOT NULL,
  `BasePrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Staff` (
  `StaffID` int(11) NOT NULL,
  `PersonID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `PasswordHash` varbinary(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `StaffAttendance` (
  `AttendanceID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `ClockInTime` datetime NOT NULL,
  `ClockOutTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `StaffRoles` (
  `RoleID` int(11) NOT NULL,
  `RoleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;