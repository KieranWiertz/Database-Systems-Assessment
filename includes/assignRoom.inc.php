<?php
require_once "dbh.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $customerID = $_POST["customerID"];
    $roomID = $_POST["roomID"];

    /* ✅ BLOCK if customer already has active booking */
    $checkCustomer = $conn->prepare("
        SELECT * FROM Bookings 
        WHERE CustomerID = ? AND ActualCheckOut IS NULL
    ");
    $checkCustomer->bind_param("i", $customerID);
    $checkCustomer->execute();
    if ($checkCustomer->get_result()->num_rows > 0) {
        die("This customer is already checked in.");
    }

    /* ✅ BLOCK if room already occupied */
    $checkRoom = $conn->prepare("
        SELECT * FROM Bookings 
        WHERE RoomID = ? AND ActualCheckOut IS NULL
    ");
    $checkRoom->bind_param("i", $roomID);
    $checkRoom->execute();
    if ($checkRoom->get_result()->num_rows > 0) {
        die("This room is already occupied.");
    }

    /* ✅ Insert booking */
    $sql = "INSERT INTO Bookings 
        (CustomerID, RoomID, ExpectedCheckIn, ExpectedCheckOut, ActualCheckIn)
        VALUES (?, ?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 1 DAY), NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $customerID, $roomID);
    $stmt->execute();

    header("Location: ../roomAssignment.php");
    exit();
}
