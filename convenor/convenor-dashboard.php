<!-- This page will be the landing page for an convenor after login -->
<!-- need to write code to check if user is logged in -->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Convenor Dashboard</title>
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
            <a href="convenor-dashboard.php" class="brand-logo brand-text">TCABS</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li><a href="../login/logout.php" class="btn brand z-depth-0">Log Out</a></li>
            </ul>
        </div>
    </nav>
    <h2 class="center">Welcome to TCABS</h2><br><br>
    <h5 class = "center"> Please choose an option:</h5> <br>
    <div class="container">
        <ul id="nav-mobile" class="center hide-on-small-and-down">
                <li><a href="manage-teams.php" class="btn brand z-depth-0">Manage Teams</a></li><br>
                <li><a href="manage-projects.php" class="btn brand z-depth-0">Manage Projects</a></li><br>
                <li><a href="manage-supervisors.php" class="btn brand z-depth-0">Manage Supervisors</a></li>
        </ul><br><br>
    </div>
  <?php include('../includes/footer.php'); ?>
  </html>