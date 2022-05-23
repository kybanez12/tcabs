<?php
session_start();

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'kristian');
define('DB_PASSWORD', 'mk(_Jz]PBMUq._Mv');
define('DB_NAME', 'tcabs');

/* Attempt to connect to MySQL database */
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>