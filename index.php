<?php
session_start();

include("includes/dbcon.php");
include("includes/functions.php");

$user_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TCABS</title>
</head>

<?php include('includes/index.header.php'); ?>

<div class="container">
	<h1 class="center">Welcome to TCABS</h1>
</div>
<?php include('includes/footer.php'); ?>
</html>