<?php
require('dbcon.php');
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL:" . mysqli_error();
}

if(isset($_POST["add_user"]) && !empty($_POST["fname"]) && !empty($_POST["sname"]) && !empty($_POST["mobile"]) && !empty($_POST["email"])) {
$fname = $_POST["fname"];
$sname = $_POST["sname"];
$mobile = $_POST["mobile"];
$email = $_POST["email"];


$brand=mysqli_real_escape_string($con, $_POST["fname"]);
$brand=mysqli_real_escape_string($con, $_POST["sname"]);
$brand=mysqli_real_escape_string($con, $_POST["mobile"]);
$brand=mysqli_real_escape_string($con, $_POST["email"]);

$i_users = "INSERT INTO USER (ufname,usname,umobile,uemail) VALUES ('$fname','$sname','$mobile','$email')";
mysqli_query($con,$i_users);
$id=mysqli_insert_id($con);


$sel_user = "SELECT ufname,usname,umobile,uemail from USER ORDER by usname ASC";
$u_result = mysqli_query($con, $sel_user);
echo "<body>";
echo "<div class=\"formresults\">";

if(! $u_result ) {
die('Could not get data: ' . mysql_error());
}

while($r = mysqli_fetch_array($u_result, MYSQLI_ASSOC)) {
$fname = $r["ufname"];
$sname = $r["usname"];
$mobile = $r["umobile"];
$email = $r["uemail"];
echo "<div> First Name: " . $fname . "<br> Surname: " . $sname . "<br> Mobile: " . $mobile . "<br> Email: " . $email . "</div>";
}
echo "<div><a href=\"http://tcabs.space/new/index.php\">&laquo; Back to form</a></div>";
echo "</div>";
echo "</body>";
echo "</html>";
}
else {
echo "<body>";
echo "<div class=\"formresults\">";
echo "<div>Something BAD happened!</div>";
echo "<div><a href=\"http://tcabs.space/new/index.php\">&laquo; Back to form</a></div>";
echo "</div>";
echo "</body>";
echo "</html>";
}
