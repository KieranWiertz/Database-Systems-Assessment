<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/dbh.inc.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: add_staff.php');
    exit;
}

$action = $_POST['action'] ?? '';

/* =======================
   ADD STAFF
======================= */
if ($action === 'add') {

    $firstName = trim($_POST['first_name'] ?? '');
    $lastName  = trim($_POST['last_name'] ?? '');
    $phone     = trim($_POST['phone'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $roleId    = (int) ($_POST['role_id'] ?? 0);
    $password  = $_POST['password'] ?? '';

    if (!$firstName || !$lastName || !$roleId || !$password) {
        die('Missing required fields');
    }

    mysqli_begin_transaction($conn);

    try {
        // Insert Person
        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO Person (FirstName, LastName, Phone, Email)
             VALUES (?, ?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "ssss",
            $firstName,
            $lastName,
            $phone,
            $email
        );
        mysqli_stmt_execute($stmt);

        $personId = mysqli_insert_id($conn);

        // Insert Staff
        $hash = hash('sha256', $password);
        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO Staff (PersonID, RoleID, PasswordHash)
             VALUES (?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "iis",
            $personId,
            $roleId,
            $hash
        );
        mysqli_stmt_execute($stmt);

        mysqli_commit($conn);
        header('Location: add_staff.php?success=added');
        exit;

    } catch (Exception $e) {
        mysqli_rollback($conn);
        die('Error adding staff');
    }
}

/* =======================
   REMOVE STAFF
======================= */
if ($action === 'remove') {

    $staffId = (int) ($_POST['staff_id'] ?? 0);

    if (!$staffId) {
        die('Invalid staff ID');
    }

    mysqli_begin_transaction($conn);

    try {
        // Get PersonID
        $stmt = mysqli_prepare(
            $conn,
            "SELECT PersonID FROM Staff WHERE StaffID = ?"
        );
        mysqli_stmt_bind_param($stmt, "i", $staffId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $staff = mysqli_fetch_assoc($result);

        if (!$staff) {
            throw new Exception('Staff not found');
        }

        $personId = $staff['PersonID'];

        // Delete Staff
        $stmt = mysqli_prepare(
            $conn,
            "DELETE FROM Staff WHERE StaffID = ?"
        );
        mysqli_stmt_bind_param($stmt, "i", $staffId);
        mysqli_stmt_execute($stmt);

        // Delete Person
        $stmt = mysqli_prepare(
            $conn,
            "DELETE FROM Person WHERE PersonID = ?"
        );
        mysqli_stmt_bind_param($stmt, "i", $personId);
        mysqli_stmt_execute($stmt);

        mysqli_commit($conn);
        header('Location: add_staff.php?success=removed');
        exit;

    } catch (Exception $e) {
        mysqli_rollback($conn);
        die('Error removing staff');
    }
}

header('Location: add_staff.php');
exit;
