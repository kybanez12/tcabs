<!DOCTYPE html>
<html lang="en">
<head>
    <title>TCABS</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <style type="text/css">
        .brand{
            background: #cbb09c !important;
        }
        .brand-text{
            color: #cbb09c !important;
        }
    </style>
</head>
<body class="grey lighten-4">
    <nav class="white z-depth-0">   
        <div class="container">
            <a href="index.php" class="brand-logo brand-text">TCABS</a>
        </div>
    </nav>
    <div class="container">
        <h5 class="center">Please choose a new password</h5> <br>
        <div id="row">
            <form class="col s12"method="POST" enctype="multipart/form-data" action="">
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" type="password" class="validate">
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="submit"><input type="submit" name="chgPw" value="Submit" /></div>
        </div>
    </div>

<?php include('includes/footer.php');?>