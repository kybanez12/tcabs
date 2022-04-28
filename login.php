<!DOCTYPE html>
<html lang="en">
<head>
<title>PHP Add User</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

<?php include('includes/header.php');?>
    <div class="container">
        <h3 class="center">Login</h3>
        <div id="login">
            <form method="POST" enctype="multipart/form-data" action="includes/login.inc.php">
                <div class="label">User ID or Email: <input type="text" name="name"></div>
                <div class="label">Password: <input type="password" name="password"></div>
                <div class="submit"><input type="submit" name="login" value="Login" /></div>
        </div>
    </div>

<?php include('includes/footer.php');?>