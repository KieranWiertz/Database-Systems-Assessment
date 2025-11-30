<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <title>Four Seasons Hotel Staff</title>
  </head>
  <body>
    <h1 class="title">
      Four Seasons Hotels <br />
      Staff Portal
    </h1>
    <div class="loginBody">
      <div class="wrapperLogin">
        <h1 class="title1">Staff Login</h1>
        <form action="includes/login.inc.php" method="post">
          <div class="inputBox">
            <input type="text" name="uid" placeholder="Staff ID" required />
          </div>
          <div class="inputBox">
            <input type="password" name="pwd" placeholder="Password" required />
          </div>
          <button type="submit" name="submit" class="btn">Login</button>
        </form>
      </div>
    </div>
    
    <?php
      if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
          echo "<p>Make sure to fill in all fields</p>";
        } else if ($_GET["error"] == "wronglogin") {
          echo "<p>Incorrect login details!</p>";
        }
      }
    ?>
  </body>
</html>
