<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputLogin($username, $pwd)) {
        header("location: ../index.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $pwd);

} else {
    header("location: ../index.php");
    exit();
}
