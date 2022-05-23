<!-- This page will show all registered teams -->
<?php
    require("../includes/dbcon.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Team Management</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

<?php include('convenor-header.php');?>

<div class="container">
    <h1 class="center">Registered Teams</h1></br></br>

    <table class="centered">
        <thead>
          <tr>
              <th>Team ID</th>
              <th>Team Name</th>
              <th></th>
          </tr>
        </thead>

        <tbody>
            <?php
                // fetches data from database and stores in array
                $stmt = "CALL GetAllTeams()";
                $t_result = mysqli_query($con, $stmt);

                // outputs rows to a table
                while($row = mysqli_fetch_assoc($t_result)){ ?>          
                <tr>
                    <td><?php echo $row["tID"] ?></td>
                    <td><?php echo $row["tName"] ?></td>
                    <td><a href="edit-team.php?teamid=<?php echo $row["tID"] ?>">Edit</a></td>
                    <td><a href="delete-team.php?teamid=<?php echo $row["tID"] ?>">Delete</a></td>
                </tr>
                <?php } ?>
        </tbody>
    </table> 
    </br>
    </br>
    <a href="register-team.php" class="right btn brand z-depth-0">Register a Team</a>
</div>

<?php include('../includes/footer.php'); ?>
</html>

