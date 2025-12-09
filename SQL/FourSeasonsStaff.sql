-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 09, 2025 at 11:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `FourSeasonsStaff`
--

-- --------------------------------------------------------

--
-- Table structure for table `Bookings`
--

CREATE TABLE `Bookings` (
  `BookingID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `ExpectedCheckIn` date NOT NULL,
  `ExpectedCheckOut` date NOT NULL,
  `ActualCheckIn` datetime DEFAULT NULL,
  `ActualCheckOut` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Bookings`
--

INSERT INTO `Bookings` (`BookingID`, `CustomerID`, `RoomID`, `ExpectedCheckIn`, `ExpectedCheckOut`, `ActualCheckIn`, `ActualCheckOut`) VALUES
(1, 1, 1, '2025-03-01', '2025-03-05', '2025-12-03 11:05:52', '2025-12-03 11:06:52'),
(3, 1, 1, '2025-12-03', '2025-12-04', '2025-12-03 11:09:30', '2025-12-03 19:50:57'),
(4, 1, 1, '2025-12-03', '2025-12-04', '2025-12-03 11:13:58', '2025-12-03 11:14:00'),
(6, 1, 2, '2025-12-03', '2025-12-04', '2025-12-03 19:50:52', '2025-12-03 19:51:27'),
(7, 1, 2, '2025-12-03', '2025-12-04', '2025-12-03 19:51:17', '2025-12-03 19:51:26'),
(8, 1, 3, '2025-12-03', '2025-12-04', '2025-12-03 19:51:23', '2025-12-03 19:51:25'),
(9, 1, 1, '2025-12-03', '2025-12-04', '2025-12-03 19:54:46', '2025-12-03 19:54:50'),
(10, 1, 1, '2025-12-04', '2025-12-05', '2025-12-04 19:57:13', '2025-12-04 19:57:22'),
(11, 1, 1, '2025-12-04', '2025-12-05', '2025-12-04 20:00:40', '2025-12-04 20:03:32'),
(12, 1, 1, '2025-12-04', '2025-12-05', '2025-12-04 20:08:04', '2025-12-04 20:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `CleaningAssignments`
--

CREATE TABLE `CleaningAssignments` (
  `AssignmentID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `AssignmentDate` date NOT NULL,
  `Completed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `CleaningAssignments`
--

INSERT INTO `CleaningAssignments` (`AssignmentID`, `StaffID`, `RoomID`, `AssignmentDate`, `Completed`) VALUES
(1, 2, 1, '2025-12-04', 1),
(2, 1, 3, '2025-12-04', 1),
(3, 3, 2, '2025-12-04', 1),
(4, 1, 1, '2025-12-04', 1),
(5, 1, 1, '2025-12-04', 1),
(6, 1, 1, '2025-12-04', 1),
(7, 1, 1, '2025-12-04', 1),
(8, 1, 1, '2025-12-05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

CREATE TABLE `Customers` (
  `CustomerID` int(11) NOT NULL,
  `PersonID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Customers`
--

INSERT INTO `Customers` (`CustomerID`, `PersonID`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `Floors`
--

CREATE TABLE `Floors` (
  `FloorID` int(11) NOT NULL,
  `FloorNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Floors`
--

INSERT INTO `Floors` (`FloorID`, `FloorNumber`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE `Person` (
  `PersonID` int(11) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Person`
--

INSERT INTO `Person` (`PersonID`, `FirstName`, `LastName`, `Phone`, `Email`) VALUES
(1, 'Kieran', 'Wiertz', '071234567', 'kieranwiertz@email.com'),
(2, 'Stan', 'Smith', '077654321', 'stansmith@email.com'),
(3, 'John', 'Brown', '071726354', 'johnbrown@email.com'),
(4, 'Dave', 'Simpson', '074536271', 'davesimpson@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `Rooms`
--

CREATE TABLE `Rooms` (
  `RoomID` int(11) NOT NULL,
  `RoomNumber` varchar(10) NOT NULL,
  `RoomTypeID` int(11) NOT NULL,
  `FloorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Rooms`
--

INSERT INTO `Rooms` (`RoomID`, `RoomNumber`, `RoomTypeID`, `FloorID`) VALUES
(1, '101', 1, 1),
(2, '102', 2, 1),
(3, '201', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `RoomTypes`
--

CREATE TABLE `RoomTypes` (
  `RoomTypeID` int(11) NOT NULL,
  `Description` varchar(50) NOT NULL,
  `BasePrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `RoomTypes`
--

INSERT INTO `RoomTypes` (`RoomTypeID`, `Description`, `BasePrice`) VALUES
(1, 'Single', 60.00),
(2, 'Double', 90.00),
(3, 'Premium', 150.00);

-- --------------------------------------------------------

--
-- Table structure for table `Staff`
--

CREATE TABLE `Staff` (
  `StaffID` int(11) NOT NULL,
  `PersonID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `PasswordHash` varbinary(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Staff`
--

INSERT INTO `Staff` (`StaffID`, `PersonID`, `RoleID`, `PasswordHash`) VALUES
(1, 1, 1, 0x65636437313837306431393633333136613937653361633334303863393833356164386366306633633162633730333532376333303236353533346637356165),
(2, 2, 2, 0x65636437313837306431393633333136613937653361633334303863393833356164386366306633633162633730333532376333303236353533346637356165),
(3, 3, 3, 0x65636437313837306431393633333136613937653361633334303863393833356164386366306633633162633730333532376333303236353533346637356165);

-- --------------------------------------------------------

--
-- Table structure for table `StaffAttendance`
--

CREATE TABLE `StaffAttendance` (
  `AttendanceID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `ClockInTime` datetime NOT NULL,
  `ClockOutTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `StaffAttendance`
--

INSERT INTO `StaffAttendance` (`AttendanceID`, `StaffID`, `ClockInTime`, `ClockOutTime`) VALUES
(1, 1, '2025-12-03 10:44:41', '2025-12-03 10:44:44'),
(2, 1, '2025-12-03 10:44:54', '2025-12-03 10:45:00'),
(3, 1, '2025-12-03 10:54:16', '2025-12-03 10:54:18'),
(4, 1, '2025-12-04 20:06:25', '2025-12-04 20:06:27'),
(5, 2, '2025-12-04 20:07:51', '2025-12-04 20:07:52'),
(6, 1, '2025-12-05 21:40:03', '2025-12-05 21:40:07'),
(7, 2, '2025-12-06 13:25:26', '2025-12-06 13:25:28');

-- --------------------------------------------------------

--
-- Table structure for table `StaffRoles`
--

CREATE TABLE `StaffRoles` (
  `RoleID` int(11) NOT NULL,
  `RoleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `StaffRoles`
--

INSERT INTO `StaffRoles` (`RoleID`, `RoleName`) VALUES
(1, 'Manager'),
(2, 'Cleaner'),
(3, 'Receptionist'),
(4, 'Doorman');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `CustomerID` (`CustomerID`),
  ADD KEY `RoomID` (`RoomID`);

--
-- Indexes for table `CleaningAssignments`
--
ALTER TABLE `CleaningAssignments`
  ADD PRIMARY KEY (`AssignmentID`),
  ADD KEY `StaffID` (`StaffID`),
  ADD KEY `RoomID` (`RoomID`);

--
-- Indexes for table `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`CustomerID`),
  ADD KEY `PersonID` (`PersonID`);

--
-- Indexes for table `Floors`
--
ALTER TABLE `Floors`
  ADD PRIMARY KEY (`FloorID`);

--
-- Indexes for table `Person`
--
ALTER TABLE `Person`
  ADD PRIMARY KEY (`PersonID`);

--
-- Indexes for table `Rooms`
--
ALTER TABLE `Rooms`
  ADD PRIMARY KEY (`RoomID`),
  ADD UNIQUE KEY `RoomNumber` (`RoomNumber`),
  ADD KEY `RoomTypeID` (`RoomTypeID`),
  ADD KEY `FloorID` (`FloorID`);

--
-- Indexes for table `RoomTypes`
--
ALTER TABLE `RoomTypes`
  ADD PRIMARY KEY (`RoomTypeID`);

--
-- Indexes for table `Staff`
--
ALTER TABLE `Staff`
  ADD PRIMARY KEY (`StaffID`),
  ADD KEY `PersonID` (`PersonID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- Indexes for table `StaffAttendance`
--
ALTER TABLE `StaffAttendance`
  ADD PRIMARY KEY (`AttendanceID`),
  ADD KEY `StaffID` (`StaffID`);

--
-- Indexes for table `StaffRoles`
--
ALTER TABLE `StaffRoles`
  ADD PRIMARY KEY (`RoleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Bookings`
--
ALTER TABLE `Bookings`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `CleaningAssignments`
--
ALTER TABLE `CleaningAssignments`
  MODIFY `AssignmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Customers`
--
ALTER TABLE `Customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Floors`
--
ALTER TABLE `Floors`
  MODIFY `FloorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Person`
--
ALTER TABLE `Person`
  MODIFY `PersonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Rooms`
--
ALTER TABLE `Rooms`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `RoomTypes`
--
ALTER TABLE `RoomTypes`
  MODIFY `RoomTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Staff`
--
ALTER TABLE `Staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `StaffAttendance`
--
ALTER TABLE `StaffAttendance`
  MODIFY `AttendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `StaffRoles`
--
ALTER TABLE `StaffRoles`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`RoomID`) REFERENCES `Rooms` (`RoomID`);

--
-- Constraints for table `CleaningAssignments`
--
ALTER TABLE `CleaningAssignments`
  ADD CONSTRAINT `cleaningassignments_ibfk_1` FOREIGN KEY (`StaffID`) REFERENCES `Staff` (`StaffID`),
  ADD CONSTRAINT `cleaningassignments_ibfk_2` FOREIGN KEY (`RoomID`) REFERENCES `Rooms` (`RoomID`);

--
-- Constraints for table `Customers`
--
ALTER TABLE `Customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`PersonID`) REFERENCES `Person` (`PersonID`);

--
-- Constraints for table `Rooms`
--
ALTER TABLE `Rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`RoomTypeID`) REFERENCES `RoomTypes` (`RoomTypeID`),
  ADD CONSTRAINT `rooms_ibfk_2` FOREIGN KEY (`FloorID`) REFERENCES `Floors` (`FloorID`);

--
-- Constraints for table `Staff`
--
ALTER TABLE `Staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`PersonID`) REFERENCES `Person` (`PersonID`),
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`RoleID`) REFERENCES `StaffRoles` (`RoleID`);

--
-- Constraints for table `StaffAttendance`
--
ALTER TABLE `StaffAttendance`
  ADD CONSTRAINT `staffattendance_ibfk_1` FOREIGN KEY (`StaffID`) REFERENCES `Staff` (`StaffID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
