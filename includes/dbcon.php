<?php
session_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'tcabs663_braden');
define('DB_PASSWORD', 'admin123');
define('DB_NAME', 'tcabs663_tcabs');

/* Attempt to connect to MySQL database */
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>