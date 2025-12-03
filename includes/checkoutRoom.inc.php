<?php
require_once "dbh.inc.php";

$id = $_GET["id"];

$sql = "UPDATE Bookings 
        SET ActualCheckOut = NOW()
        WHERE BookingID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../roomAssignment.php");
exit();
