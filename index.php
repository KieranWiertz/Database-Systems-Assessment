<?php
session_start();

if (isset($_SESSION["StaffID"])) {
    header("Location: staffMain.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Login</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <div class="header">
      <img
        class="logo"
        src="Assets/TheGrandYorkLogo.png"
        alt="The Grand York"
      />
    </div>
    <h2 class="title">Staff Login</h2>
    <div class="inputBox">
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Staff ID" required>
            <input type="password" name="pwd" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    <div class="footer">
      <p>
        &copy; 2026 The Grand York. Made by Kieran Wiertz for Database Systems
        at York St. John University.
      </p>
    </div>

    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Make sure to fill in all fields</p>";
        } elseif ($_GET["error"] == "wronglogin") {
            echo "<p>Incorrect login details!</p>";
        }
    }
    ?>
</body>
</html>
