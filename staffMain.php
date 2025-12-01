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
  <h1 class="title">Staff Portal</h1>
  <h2>Welcome, Staff ID: <?php echo htmlspecialchars($_SESSION["StaffID"]); ?></h2>

  <div class="staffButton">
    <a href="checkIn.html"><button class="btn">Check In</button></a>
    <a href="checkOut.html"><button class="btn">Check Out</button></a>
    <a href="staffManagement.html"><button class="btn">Staff Management</button></a>
    <a href="cleaningScheduler.html"><button class="btn">Cleaning Scheduler</button></a>
    <br /><br />
    <a href="includes/logout.inc.php"><button class="btn logoutBtn">Logout</button></a>
  </div>
</body>
</html>
