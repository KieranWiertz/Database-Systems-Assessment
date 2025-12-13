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
    <h1 class="title">Four Seasons Hotels</h1>
    <h2 class="title">Staff Login</h2>
    <div class="inputBox">
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Staff ID" required>
            <input type="password" name="pwd" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
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
