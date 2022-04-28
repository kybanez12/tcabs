<?php
   
    $userID = $_POST["uID"];
    $pw = $_POST["pword"];

    require_once 'dbcon.php';
    require_once 'functions.php';

    if (emptyInputLogin($userID, $pw) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($con, $userID, $pw);
   
    