<?php
session_start();
require_once 'dbh.inc.php';

if (!isset($_SESSION["StaffID"])) {
    header("location: ../index.php");
    exit();
}

$staffID = $_SESSION["StaffID"];

$sql = "SELECT * FROM StaffAttendance WHERE StaffID = ? AND ClockOutTime IS NULL ORDER BY AttendanceID DESC LIMIT 1;";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die("SQL error");
}

mysqli_stmt_bind_param($stmt, "i", $staffID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$row = mysqli_fetch_assoc($result)) {
    header("location: ../checkOut.php?error=noclockin");
    exit();
}

$attendanceID = $row["AttendanceID"];

$sql = "UPDATE StaffAttendance SET ClockOutTime = NOW() WHERE AttendanceID = ?;";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die("SQL error updating clock out");
}

mysqli_stmt_bind_param($stmt, "i", $attendanceID);
mysqli_stmt_execute($stmt);

if ($_SESSION["Role"] === "manager") {
        header("location: ../managerMain.php");
    } else {
        header("location: ../staffMain.php");
    }
exit();
