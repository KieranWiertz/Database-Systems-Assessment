<?php
session_start();

function emptyInputLogin($username, $pwd) {
    return empty($username) || empty($pwd);
}

function loginUser($conn, $username, $pwd) {
    $username = trim($username);
    $pwd = trim($pwd);

    // Select user by StaffID
    $sql = "SELECT * FROM Staff WHERE StaffID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("SQL statement preparation failed.");
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        $pwdHashed = $row["PasswordHash"];

        if (hash("sha256", $pwd) === $pwdHashed) {
            // Start session and store user info
            $_SESSION["StaffID"] = $row["StaffID"];
            $_SESSION["Role"] = ($row["StaffID"] == 1) ? "manager" : "staff";

            // Redirect based on role
            if ($_SESSION["Role"] === "manager") {
                header("location: ../managerMain.php");
            } else {
                header("location: ../staffMain.php");
            }
            exit();
        } else {
            header("location: ../index.php?error=wronglogin");
            exit();
        }
    } else {
        header("location: ../index.php?error=wronglogin");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    require_once 'dbh.inc.php';

    if (emptyInputLogin($username, $pwd)) {
        header("location: ../index.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $pwd);

} else {
    header("location: ../index.php");
    exit();
}
