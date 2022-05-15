<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TCABS</title>
</head>

<?php include('../includes/index.header.php'); ?>

<div class="container">
	<h1 class="center">Welcome to TCABS</h1>
	        <div id="login">
	          <form method="POST" enctype="multipart/form-data" action="includes/login.inc.php">
                <div class="label">User ID: <input type="text" name="uID"></div>
                <div class="label">Password: <input type="password" name="pword"></div>
                <div class="submit"><input type="submit" name="login" value="Login" /></div>
        </div>

</div>
	

<?php include('../includes/footer.php'); ?>
</html>