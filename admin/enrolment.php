<?php
    include("../includes/dbcon.php");
    $stmt = "CALL GetAllEnrol()";
    $enrol_result = mysqli_query($con, $stmt);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Project Management</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

<?php include('admin-header.php');?>

<div class="container">
    <h1 class="center">Student Enrolment</h1></br></br>
     <table class="centered highlight">
        <thead>
          <tr>
              <th>Unit Code</th>
              <th>Unit Name</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Teaching Period</th>
          </tr>
        </thead>
        <tbody>
        <?php
            
            while($row = mysqli_fetch_assoc($enrol_result)) { 
            ?>
                <tr>
                    <td><?php echo $row["unitCode"] ?></td>
                    <td><?php echo $row["unitName"] ?></td>
                    <td><?php echo $row["uFName"] ?></td>
                    <td><?php echo $row["uSName"] ?></td>
                    <td><?php echo $row["tpName"] ?></td>
                </tr><?php } ?>
        </tbody>
      </table>
      </br>
      </br>
    <a href="enrol-student.php" class="right btn brand z-depth-0">Enrol Student</a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<?php include('../includes/footer.php'); ?>
</html>