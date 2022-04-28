<?php

/* Attempt to connect to MySQL database */
$con = mysqli_connect('localhost', 'kristian', 'mk(_Jz]PBMUq._Mv', 'tcabs');
 
// Check connection
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>