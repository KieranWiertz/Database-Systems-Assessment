<?php
require_once "includes/dbh.inc.php";

$customers = $conn->query("
    SELECT Customers.CustomerID, Person.FirstName, Person.LastName
    FROM Customers
    JOIN Person ON Customers.PersonID = Person.PersonID
    WHERE Customers.CustomerID NOT IN (
        SELECT CustomerID FROM Bookings WHERE ActualCheckOut IS NULL
    )
");

$rooms = $conn->query("
    SELECT RoomID, RoomNumber 
    FROM Rooms 
    WHERE RoomID NOT IN (
        SELECT RoomID FROM Bookings WHERE ActualCheckOut IS NULL
    )
    AND RoomID NOT IN (
        SELECT RoomID FROM CleaningAssignments WHERE Completed = FALSE
    )
");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css" />
    <title>Room Assignment</title>
</head>
<body>
    <div class="header">
      <img
        class="logo"
        src="Assets/TheGrandYorkLogo.png"
        alt="The Grand York"
      />
    </div>
<a href="managerMain.php"><button class="btn">Back to Manager Portal</button></a>

<h2>Assign Customer to Room</h2>

<form action="includes/assignRoom.inc.php" method="POST">

    <label>Customer:</label>
    <select name="customerID" required>
        <option value="">Select Customer</option>
        <?php while ($c = $customers->fetch_assoc()): ?>
            <option value="<?= $c['CustomerID'] ?>">
                <?= $c['FirstName'] . " " . $c['LastName'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <br><br>

    <label>Room:</label>
    <select name="roomID" required>
        <option value="">Select Room</option>
        <?php while ($r = $rooms->fetch_assoc()): ?>
            <option value="<?= $r['RoomID'] ?>">
                Room <?= $r['RoomNumber'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <br><br>

    <button type="submit">Check In</button>
</form>

<hr>

<h2>Current Room Occupancy</h2>

<table border="1" cellpadding="8">
<tr>
    <th>Room</th>
    <th>Customer</th>
    <th>Check In</th>
    <th>Action</th>
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
    <td>
        <a href="includes/checkoutRoom.inc.php?id=<?= $row['BookingID'] ?>">
            Check Out
        </a>
    </td>
</tr>
<?php endwhile; ?>
</table>

    <div class="footer">
      <p>
        &copy; 2026 The Grand York. Made by Kieran Wiertz for Database Systems
        at York St. John University.
      </p>
    </div>

</body>
</html>
