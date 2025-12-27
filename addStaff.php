<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/includes/dbh.inc.php';

/* =====================
   Fetch Roles
===================== */
$roles = [];
$result = mysqli_query(
    $conn,
    "SELECT RoleID, RoleName FROM StaffRoles ORDER BY RoleName"
);
while ($row = mysqli_fetch_assoc($result)) {
    $roles[] = $row;
}

/* =====================
   Fetch Staff for Removal
===================== */
$staffList = [];
$result = mysqli_query(
    $conn,
    "SELECT s.StaffID, p.FirstName, p.LastName
     FROM Staff s
     JOIN Person p ON s.PersonID = p.PersonID
     ORDER BY p.LastName, p.FirstName"
);
while ($row = mysqli_fetch_assoc($result)) {
    $staffList[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Manage Staff</title>
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

    <a href="managerMain.php">
      <button class="btn">Back to Manager Portal</button>
    </a>

    <h2 class="title">Add Staff Member</h2>

    <div class="title">
      <form action="includes/addStaff.inc.php" method="post">
        <input type="hidden" name="action" value="add" />

        <input
          type="text"
          name="first_name"
          placeholder="First Name"
          required
        /><br />

        <input
          type="text"
          name="last_name"
          placeholder="Last Name"
          required
        /><br />

        <input type="text" name="phone" placeholder="Phone" /><br />
        <input type="email" name="email" placeholder="Email" /><br />

        <select name="role_id" required>
          <option value="">Select Role</option>
          <?php foreach ($roles as $role): ?>
            <option value="<?= $role['RoleID']; ?>">
              <?= htmlspecialchars($role['RoleName']); ?>
            </option>
          <?php endforeach; ?>
        </select><br />

        <input
          type="password"
          name="password"
          placeholder="Password"
          required
        /><br />

        <button type="submit">Add Staff</button>
      </form>

      <hr />

      <h2>Remove Staff Member</h2>

      <form action="includes/addStaff.inc.php" method="post">
        <input type="hidden" name="action" value="remove" />

        <select name="staff_id" required>
          <option value="">Select Staff Member</option>
          <?php foreach ($staffList as $staff): ?>
            <option value="<?= $staff['StaffID']; ?>">
              <?= htmlspecialchars($staff['FirstName'] . ' ' . $staff['LastName']); ?>
            </option>
          <?php endforeach; ?>
        </select><br />

        <button type="submit">Remove Staff</button>
      </form>
    </div>

    <br />

    <div class="footer">
      <p>
        &copy; 2026 The Grand York. Made by Kieran Wiertz for Database Systems
        at York St. John University.
      </p>
    </div>

  </body>
</html>
