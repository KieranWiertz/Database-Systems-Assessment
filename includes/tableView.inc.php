<?php
$staff = $conn->query("
    SELECT Staff.StaffID, Person.FirstName, Person.LastName
    FROM Staff
    JOIN Person ON Staff.PersonID = Person.PersonID
");

$rooms = $conn->query("
    SELECT Rooms.RoomID, Rooms.RoomNumber
    FROM Rooms
    WHERE Rooms.RoomID IN (
        SELECT RoomID FROM Bookings WHERE ActualCheckOut IS NOT NULL
    )
    AND Rooms.RoomID NOT IN (
        SELECT RoomID FROM CleaningAssignments WHERE Completed = FALSE
    )
");

$cleaningJobs = $conn->query("
    SELECT 
        CleaningAssignments.AssignmentID,
        Rooms.RoomNumber,
        Person.FirstName,
        Person.LastName,
        CleaningAssignments.AssignmentDate
    FROM CleaningAssignments
    JOIN Rooms ON CleaningAssignments.RoomID = Rooms.RoomID
    JOIN Staff ON CleaningAssignments.StaffID = Staff.StaffID
    JOIN Person ON Staff.PersonID = Person.PersonID
    WHERE CleaningAssignments.Completed = FALSE
");

$roomStatus = $conn->query("
    SELECT Rooms.RoomNumber,

    CASE
        -- 🟥 OCCUPIED
        WHEN EXISTS (
            SELECT 1 FROM Bookings
            WHERE Bookings.RoomID = Rooms.RoomID
            AND ActualCheckIn IS NOT NULL
            AND ActualCheckOut IS NULL
        ) THEN 'Occupied'

        -- 🟧 CLEANING
        WHEN EXISTS (
            SELECT 1 FROM CleaningAssignments
            WHERE CleaningAssignments.RoomID = Rooms.RoomID
            AND Completed = 0
            AND StaffID IS NOT NULL
        ) THEN 'Cleaning'

        -- 🟩 AVAILABLE
        ELSE 'Available to Clean'
    END AS Status

    FROM Rooms
    ORDER BY Rooms.RoomNumber
");
?>