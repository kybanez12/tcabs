<!-- This page will show all registered projects -->
<?php
    include("../includes/dbcon.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Project Management</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

<?php include('convenor-header.php');?>

<div class="container">
    <h1 class="center">Registered Projects</h1></br></br>
     <table class="centered highlight">
        <thead>
          <tr>
              <th>Project ID</th>
              <th>Project Name</th>
              <th>Project Description</th>
              <th>Start Date</th>
              <th>End Date</th>
          </tr>
        </thead>

        <tbody>
        <?php
            $stmt = "CALL GetAllProjects()";
            $p_result = mysqli_query($con, $stmt);

            while($row = mysqli_fetch_assoc($p_result)) { 
                $startdate = date("d-m-y", strtotime($row["pStartDate"]));
                $enddate = date("d-m-y", strtotime($row["pEndDate"])); ?>
                <tr>
                    <td><?php echo $row["pID"] ?></td>
                    <td><?php echo $row["pName"] ?></td>
                    <td><?php echo $row["pDescription"] ?></td>
                    <td><?php echo $startdate ?></td>
                    <td><?php echo $enddate ?></td>
                    <td><a href="edit-project.php?projectid=<?php echo $row["pID"] ?>">Edit</a></td>
                    <td><a href="delete-project.php?projectid=<?php echo $row["pID"] ?>">Delete</a></td>
                </tr><?php } ?>
        </tbody>
      </table>
      </br>
      </br>
    <a href="register-project.php" class="right btn brand z-depth-0">Register a Project</a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<?php include('../includes/footer.php'); ?>
</html>
