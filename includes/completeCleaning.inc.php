<?php
require_once "dbh.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = $_POST["id"];

    $sql = "UPDATE CleaningAssignments 
            SET Completed = 1 
            WHERE AssignmentID = ?";

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    header("location: ../cleaningScheduler.php");
    exit();
}
