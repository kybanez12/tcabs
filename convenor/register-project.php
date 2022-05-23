<!-- This page allows a convenor to register a project -->
<?php
/* Attempt to connect to MySQL database */
include_once("../includes/dbcon.php");

//checks if values are not empty
if($_SERVER['REQUEST_METHOD'] == "POST") 
{
    $pname = mysqli_real_escape_string($con, $_POST["pname"]);
    $pdescription = mysqli_real_escape_string($con, $_POST["pdescription"]);
    $startdate = date("Y-m-d", strtotime($_POST["startdate"]));
    $enddate = date("Y-m-d", strtotime($_POST["enddate"]));

    if (!empty($pname) && !empty($pdescription) && !empty($startdate) && !empty($enddate)) 
    {
        $stmt = $con->prepare("CALL AddProject(?, ?, ?, ?)");
        $stmt->bind_param('ssss', $pname, $pdescription, $startdate, $enddate);

        try 
        {
            $stmt->execute();
            echo "<script>alert('Project added successfully')</script>";
        }
        catch (Exception $e)
        {
            $errmsg = $e->getMessage();
            echo "<script>alert('$errmsg')</script>";
        }
    }
    else
    {
        echo "<script>alert('Please enter all fields')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Register Project</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

<?php include('convenor-header.php');?>
    <div class="container">
        <h3 class="center">Register a Project</h3>
        <div class="row">
            <form class="col s12" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="pname" name="pname" type="text" class="validate">
                        <label for="pname">Project Name</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="pdescription" name="pdescription"  class="materialize-textarea">
                        <label for="pdescription">Project Description</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input type="text" name="startdate" class="datepicker">
                        <label for="startdate">Start Date</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="text" name="enddate" class="datepicker">
                        <label for="enddate">End Date</label>
                    </div>
                </div>
                
              <div class="submit "><input type="submit" name="reg_project" value="Register Project"/></div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.datepicker');
        M.Datepicker.init(elems, {
            format:'dd-mm-yyyy'
        });
     });
    </script>

  <?php include('../includes/footer.php'); ?>
  </html>