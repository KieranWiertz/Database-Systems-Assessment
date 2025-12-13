<?php
session_start();
require_once "includes/dbh.inc.php";

if (!isset($_SESSION["StaffID"])) {
    header("location: index.php");
    exit();
}

$staffID = $_SESSION["StaffID"];

$sql = "
    SELECT FirstName, LastName
    FROM Person
    INNER JOIN Staff ON Staff.PersonID = Person.PersonID
    WHERE Staff.StaffID = ?;
";

$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "i", $staffID);
mysqli_stmt_execute($stmt);
$nameResult = mysqli_stmt_get_result($stmt);
$nameRow = mysqli_fetch_assoc($nameResult);

$fullName = $nameRow["FirstName"] . " " . $nameRow["LastName"];

$sql = "
    SELECT AttendanceID, ClockInTime, ClockOutTime
    FROM StaffAttendance
    WHERE StaffID = ?
    ORDER BY ClockInTime DESC;
";

$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "i", $staffID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance History</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="header">
      <img
        class="logo"
        src="Assets/TheGrandYorkLogo.png"
        alt="The Grand York"
      />
    </div>
<div class="container">
    <h1>Attendance History</h1>
    <h3><?php echo htmlspecialchars($fullName); ?></h3>
</div>

<table>
    <tr>
        <th>Clock In</th>
        <th>Clock Out</th>
        <th>Status</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?php echo $row["ClockInTime"]; ?></td>
            <td>
                <?php
                    echo ($row["ClockOutTime"] !== null)
                        ? $row["ClockOutTime"]
                        : "<i>Still Clocked In</i>";
                ?>
            </td>
            <td>
                <?php echo ($row["ClockOutTime"] !== null) ? "Completed" : "Open Shift"; ?>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<div class="container">
    <a href="staffMain.php"><button class="btn-back">Back to Portal</button></a>
</div>

    <div class="footer">
      <p>
        &copy; 2026 The Grand York. Made by Kieran Wiertz for Database Systems
        at York St. John University.
      </p>
    </div>

</body>
</html>
