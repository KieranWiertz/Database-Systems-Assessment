<?php
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
  <h1 class="title">Manager Portal</h1>
  <h2 class="title">Welcome, Staff ID: <?php echo htmlspecialchars($_SESSION["StaffID"]); ?></h2>

  <div class="staffButton">
    <form action="includes/clockIn.inc.php" method="post">
      <button type="submit" name="clockin" class="btn">Clock In</button>
    </form>
    <form action="includes/clockOut.inc.php" method="post">
      <button type="submit" name="clockout" class="btn">Clock Out</button>
    </form>
    <a href="attendanceHistory.php"><button class="btn">Attendance History</button></a>
    <a href="roomAssignment.php"><button class="btn">Room Assignment</button></a>
    <a href="cleaningScheduler.php"><button class="btn">Cleaning Scheduler</button></a>
    <a href="addStaff.php"><button class="btn">Manage Staff</button></a>

    <br /><br />
    <a href="includes/logout.inc.php"><button class="btn logoutBtn">Logout</button></a>
  </div>

      <div class="footer">
      <p>
        &copy; 2026 The Grand York. Made by Kieran Wiertz for Database Systems
        at York St. John University.
      </p>
    </div>
</body>
</html>
