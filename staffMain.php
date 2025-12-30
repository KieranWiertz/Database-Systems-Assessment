<?php
require_once "includes/dbh.inc.php";
require_once "includes/tableView.inc.php";
session_start();

if (!isset($_SESSION["StaffID"])) {
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles.css" />
  <title>Staff Portal</title>
</head>
<body>
      <div class="header">
      <img
        class="logo"
        src="Assets/TheGrandYorkLogo.png"
        alt="The Grand York"
      />
    </div>
  <h1 class="title">Staff Portal</h1>
  <h2 class="title">Welcome, Staff ID: <?php echo htmlspecialchars($_SESSION["StaffID"]); ?></h2>

  <div class="staffButton">
    <form action="includes/clockIn.inc.php" method="post">
      <button type="submit" name="clockin" class="btn">Clock In</button>
    </form>
    <form action="includes/clockOut.inc.php" method="post">
      <button type="submit" name="clockout" class="btn">Clock Out</button>
    </form>
    <a href="attendanceHistory.php"><button class="btn">Attendance History</button></a>
    <br />
    <a href="includes/logout.inc.php"><button class="btn logoutBtn">Logout</button></a>
  </div>

  <div class="views">
    <table border="1" cellpadding="8">
<tr>
    <th>Room</th>
    <th>Cleaner</th>
    <th>Date</th>
</tr>

<?php while ($job = $cleaningJobs->fetch_assoc()): ?>
<tr>
    <td>Room <?= $job['RoomNumber'] ?></td>
    <td><?= $job['FirstName'] . " " . $job['LastName'] ?></td>
    <td><?= $job['AssignmentDate'] ?></td>
</tr>
<?php endwhile; ?>
</table>

<table border="1" cellpadding="8">
<tr>
    <th>Room</th>
    <th>Customer</th>
    <th>Check In</th>
</tr>

<?php
$result = $conn->query("
    SELECT 
        Rooms.RoomNumber,
        Person.FirstName,
        Person.LastName,
        Bookings.ActualCheckIn,
        Bookings.BookingID
    FROM Bookings
    JOIN Rooms ON Bookings.RoomID = Rooms.RoomID
    JOIN Customers ON Bookings.CustomerID = Customers.CustomerID
    JOIN Person ON Customers.PersonID = Person.PersonID
    WHERE Bookings.ActualCheckOut IS NULL
");

while ($row = $result->fetch_assoc()):
?>
<tr>
    <td><?= $row['RoomNumber'] ?></td>
    <td><?= $row['FirstName'] . " " . $row['LastName'] ?></td>
    <td><?= $row['ActualCheckIn'] ?></td>
</tr>
<?php endwhile; ?>
</table>
  </div>

      <div class="footer">
      <p>
        &copy; 2026 The Grand York. Made by Kieran Wiertz for Database Systems
        at York St. John University.
      </p>
    </div>
</body>
</html>
