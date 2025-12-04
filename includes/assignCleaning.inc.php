<?php
require_once "dbh.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $staffID = $_POST["staffID"];
    $roomID  = $_POST["roomID"];

    $check = $conn->prepare("
        SELECT * FROM CleaningAssignments 
        WHERE RoomID = ? AND Completed = FALSE
    ");
    $check->bind_param("i", $roomID);
    $check->execute();

    if ($check->get_result()->num_rows > 0) {
        die("This room is already assigned for cleaning.");
    }

    $sql = "INSERT INTO CleaningAssignments 
            (StaffID, RoomID, AssignmentDate, Completed)
            VALUES (?, ?, CURDATE(), FALSE)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $staffID, $roomID);
    $stmt->execute();

    header("Location: ../cleaningScheduler.php");
    exit();
}
