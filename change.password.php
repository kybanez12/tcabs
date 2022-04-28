<!DOCTYPE html>
<html lang="en">
<head>
<title>PHP Add User</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<?php include('includes/index.header.php');?>
    <div class="container">
        <h3 class="center">Please enter new password</h3>
        <div id="login">
            <form method="POST" enctype="multipart/form-data" action="includes/chgPw.inc.php">
                <div class="label">Password: <input type="password" name="password"></div>
                <div class="submit"><input type="submit" name="chgPw" value="Submit" /></div>
        </div>
    </div>

<?php include('includes/footer.php');?>S