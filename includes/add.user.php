<?php
/* Attempt to connect to MySQL database */
require("dbcon.php");
require("functions.php");

//checks if values are not empty
if(isset($_POST["add_user"]) && !empty($_POST["fname"]) && !empty($_POST["sname"]) && !empty($_POST["birthday"]) && !empty($_POST["mobile"]) && !empty($_POST["email"]) && !empty($_POST["role"])) {

// stores data in variables
$fname = $_POST["fname"];
$sname = $_POST["sname"];
$mobile = $_POST["mobile"];
$birthday = date("Y-d-m", strtotime($_POST["birthday"]));
$email = $_POST["email"];
$password  = createTempPassword($birthday);

// sets role
if ($_POST["role"] == "admin") {
    $role = 1;
}
if ($_POST["role"] == "convenor") {
    $role = 2;
}
if ($_POST["role"] == "student") {
    $role = 3;
}
if ($_POST["role"] == "supervisor") {
    $role = 4;
}

//escapes special characters
$brand=mysqli_real_escape_string($con, $_POST["fname"]);
$brand=mysqli_real_escape_string($con, $_POST["sname"]);
$brand=mysqli_real_escape_string($con, $_POST["birthday"]);
$brand=mysqli_real_escape_string($con, $_POST["mobile"]);
$brand=mysqli_real_escape_string($con, $_POST["email"]);


// inserts new user into database using SQL
$i_users = "INSERT INTO USER (ufname, usname, birthday, umobile, uemail, rid, pWord) VALUES ('$fname','$sname', '$birthday', '$mobile','$email', '$role', '$password')";
mysqli_query($con,$i_users);
$id=mysqli_insert_id($con);

// fetches data from database and stores in array
$sel_user = "SELECT ufname,usname,pWord,uemail from USER ORDER by usname ASC";
$u_result = mysqli_query($con, $sel_user);
echo "<body>";
echo "<div class=\"formresults\">";

if(! $u_result ) {
die('Could not get data: ' . mysql_error());
}

while($r = mysqli_fetch_array($u_result, MYSQLI_ASSOC)) {
$fname = $r["ufname"];
$sname = $r["usname"];
$password = $r["pWord"];
$email = $r["uemail"];
echo "<div> First Name: " . $fname . "<br> Surname: " . $sname . "<br> Password: " . $password . "<br> Email: " . $email . "</div>";
}
echo "<div><a href=\"http://localhost/TCABS/register_user.php\">&laquo; Back to form</a></div>";
echo "</div>";
echo "</body>";
echo "</html>";
}
else {
    header("location: ../register_user.php");
}
