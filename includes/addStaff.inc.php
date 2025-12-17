<?php
require_once 'dbh.inc.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$action = $_POST['action'] ?? '';

/* ===================== ADD STAFF ===================== */
if ($action === 'add') {

    mysqli_begin_transaction($conn);

    try {
        // Insert Person
        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO Person (FirstName, LastName, Phone, Email)
             VALUES (?, ?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $phone, $email);
        mysqli_stmt_execute($stmt);

        $personId = mysqli_insert_id($conn);

        // Insert Staff
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO Staff (PersonID, RoleID, PasswordHash)
             VALUES (?, ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "iis", $personId, $roleId, $hash);
        mysqli_stmt_execute($stmt);

        mysqli_commit($conn);
        header('Location: addStaff.php?success=added');
        exit;

    } catch (Exception $e) {
        mysqli_rollback($conn);
        die('Error adding staff: ' . $e->getMessage());
    }
}

/* ===================== REMOVE STAFF ===================== */
if ($action === 'remove') {

    $staffId = (int) $_POST['staff_id'];
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
        header('Location: addStaff.php?success=removed');
        exit;

    } catch (Exception $e) {
        mysqli_rollback($conn);
        die('Error removing staff: ' . $e->getMessage());
    }
}

/* ===================== FALLBACK ===================== */
header('Location: addStaff.php');
exit;
