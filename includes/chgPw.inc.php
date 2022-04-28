<?php
//checks if user got to page correctly
if (isset($_POST["submit"])) {
    
    $pw = $_POST["password"];

    require_once 'dbcon.php';
    require_once 'functions.php';

    //calls function from functions.php checks if pw empty
    if (emptyNewPassword($pw) !== false)) {
        header("location: ../change.password.php?error=emptypassword");
        exit();
    }
    //calls function from functions.php to set new password
    setNewPw($pw);
    
        
}







