<?php
   
    $userID = $_POST["uID"];
    $pw = $_POST["pword"];

    include 'dbcon.php';
    include 'functions.php';
    if (emptyInputLogin($userID, $pw) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }
        loginUser($con, $userID, $pw);

?>
   
    