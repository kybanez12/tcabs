<!-- this page will show all users -->
<?php
    include("../includes/dbcon.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>User Management</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

<?php include('admin-header.php');?>

<div class="container">
    
    <h1 class="center">Registered User</h1></br></br>
     <table class="centered highlight">
        <thead>
          <tr>
              <th>ID</th>
              <th>First Name</th>
              <th>Surname</th>
              <th>Mobile</th>
              <th>Email</th>
          </tr>
        </thead>

        <tbody>
        <?php
            $stmt = "CALL ListUsers()";
            $p_result = mysqli_query($con, $stmt);

            while($row = mysqli_fetch_assoc($p_result)) { 
                ?>
                <tr>
                    <td><?php echo $row["uID"] ?></td>
                    <td><?php echo $row["uFName"] ?></td>
                    <td><?php echo $row["uSName"] ?></td>
                    <td><?php echo $row["uMobile"] ?></td>
                    <td><?php echo $row["uEmail"] ?></td>
                    <td><a href="edit-user.php?userid=<?php echo $row["uID"] ?>">Edit</a></td>
                    <td><a href="delete-user.php?userid=<?php echo $row["uID"] ?>">Delete</a></td>
                </tr><?php } ?>
        </tbody>
      </table>
      </br>
      </br>
    
    
    <a href="register-user.php" class="right btn brand z-depth-0">Register a User</a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<?php include('../includes/footer.php'); ?>
</html>