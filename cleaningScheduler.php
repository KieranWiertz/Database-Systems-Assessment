<?php
require_once "includes/dbh.inc.php";
require_once "includes/tableView.inc.php";
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css" />
    <title>Cleaning Scheduler</title>
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

<h1>Cleaning Scheduler</h1>

<h2>Assign Cleaner to Room</h2>

<form action="includes/assignCleaning.inc.php" method="POST">

    <label>Cleaner:</label>
    <select name="staffID" required>
        <option value="">Select Cleaner</option>
        <?php while ($s = $staff->fetch_assoc()): ?>
            <option value="<?= $s['StaffID'] ?>">
                <?= $s['FirstName'] . " " . $s['LastName'] ?>
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

    <button type="submit">Assign Cleaning</button>
</form>

<hr>

<h2>Active Cleaning Jobs</h2>

<table border="1" cellpadding="8">
<tr>
    <th>Room</th>
    <th>Cleaner</th>
    <th>Date</th>
    <th>Finish</th>
</tr>

<?php while ($job = $cleaningJobs->fetch_assoc()): ?>
<tr>
    <td>Room <?= $job['RoomNumber'] ?></td>
    <td><?= $job['FirstName'] . " " . $job['LastName'] ?></td>
    <td><?= $job['AssignmentDate'] ?></td>
    <td>
        <form action="includes/completeCleaning.inc.php" method="POST">
            <input type="hidden" name="id" value="<?= $job['AssignmentID'] ?>">
            <button type="submit">✅ Finished</button>
        </form>
    </td>
</tr>
<?php endwhile; ?>
</table>

<hr>

<h2>Room Status Chart</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Room</th>
    <th>Status</th>
</tr>

<?php while ($row = $roomStatus->fetch_assoc()): ?>
<tr>
    <td>Room <?= $row['RoomNumber'] ?></td>
    <td style="
        font-weight:bold;
        color:
        <?= 
            $row['Status'] === 'Occupied' ? 'red' :
            ($row['Status'] === 'Cleaning' ? 'orange' :
            ($row['Status'] === 'Dirty' ? 'brown' : 'green'))
        ?>
    ">
        <?= $row['Status'] ?>
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
