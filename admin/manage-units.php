<!-- this page will show all registered units -->
<?php
    include("../includes/dbcon.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Unit Management</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

<?php include('admin-header.php');?>

<div class="container">
    <h1 class="center">Registered Units</h1></br></br>
    <table class="centered highlight">
        <thead>
          <tr>
              <th>Unit ID</th>
              <th>Unit Code</th>
              <th>Unit Name</th>
          </tr>
        </thead>

        <tbody>
        <?php
            $stmt = "CALL ListUnits()";
            $p_result = mysqli_query($con, $stmt);

            while($row = mysqli_fetch_assoc($p_result)) { ?>
                <tr>
                    <td><?php echo $row["unitID"] ?></td>
                    <td><?php echo $row["unitCode"] ?></td>
                    <td><?php echo $row["unitName"] ?></td>
                    <td><a href="edit-unit.php?unitID=<?php echo $row["unitID"] ?>">Edit</a></td>
                    <td><a href="delete-unit.php?unitID=<?php echo $row["unitID"] ?>">Delete</a></td>
                </tr><?php } ?>
        </tbody>
      </table>
      </br>
      </br>
    <a href="register-unit.php" class="right btn brand z-depth-0">Register a Unit</a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</div>

<?php include('../includes/footer.php'); ?>
</html>