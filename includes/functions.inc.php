<?php
function emptyInputLogin($username, $pwd) {
    return empty($username) || empty($pwd);
}

function loginUser($conn, $username, $pwd) {
    $username = trim($username);
    $pwd = trim($pwd);

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
            session_start();
            $_SESSION["StaffID"] = $row["StaffID"];
            header("location: ../staffMain.php");
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
