<!-- This page will be the landing page for an admin after login -->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Dashboard</title>
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
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li><a href="logout.php" class="btn brand z-depth-0">Log Out</a></li>
            </ul>
        </div>
    </nav>
    <h2 class="center">Welcome to TCABS</h2><br><br>
    <h5 class = "center"> Please choose an option:</h5> <br>
    <div class="container">
            <ul id="nav-mobile" class="center hide-on-small-and-down">
                <li><a href="view-convenors.php" class="btn brand z-depth-0">Manage Convenors</a></li> <br>
                <li><a href="view-students.php" class="btn brand z-depth-0">Manage Students</a></li><br>
            </ul>
        </div>


  <?php include('../includes/footer.php'); ?>
  </html>