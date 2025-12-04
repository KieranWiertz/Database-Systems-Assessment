<?php
require_once "includes/dbh.inc.php";

$staffID = 1;

$result = $conn->query("
    SELECT 
        CleaningAssignments.AssignmentID,
        Rooms.RoomNumber,
        CleaningAssignments.AssignmentDate
    FROM CleaningAssignments
    JOIN Rooms ON CleaningAssignments.RoomID = Rooms.RoomID
    WHERE CleaningAssignments.Completed = FALSE
    AND CleaningAssignments.StaffID = $staffID
");
?>

<!DOCTYPE html>
<html>
<head><title>My Cleaning Jobs</title></head>
<body>

<h2>My Assigned Cleaning Jobs</h2>

<table border="1" cellpadding="8">
<tr>
    <th>Room</th>
    <th>Date</th>
    <th>Action</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td>Room <?= $row['RoomNumber'] ?></td>
    <td><?= $row['AssignmentDate'] ?></td>
    <td>
        <a href="includes/completeCleaning.inc.php?id=<?= $row['AssignmentID'] ?>">
            Mark Cleaned
        </a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>
