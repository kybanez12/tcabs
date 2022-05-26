<!-- This page will list all supervisors -->

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
    <h1 class="center">Registered Supervisors</h1></br></br>

    <table class="centered">
        <thead>
          <tr>
              <th>User ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th></th>
          </tr>
        </thead>

        <tbody>
            <?php
                // fetches data from database and stores in array
                $stmt = "CALL GetAllSupervisors()";
                $supervisors_result = mysqli_query($con, $stmt);

                // outputs rows to a table
                while($row = mysqli_fetch_assoc($supervisors_result)){ ?>          
                <tr>
                    <td><?php echo $row["uID"] ?></td>
                    <td><?php echo $row["uFName"] ?></td>
                    <td><?php echo $row["uSName"] ?></td>
                </tr>
                <?php } ?>
        </tbody>
    </table> 
    </br>
    </br>
</div>

<?php include('../includes/footer.php'); ?>
</html>