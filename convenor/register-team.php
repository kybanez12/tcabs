<!-- This page allows a convenor to register students into a team -->
<?php
/* Attempt to connect to MySQL database */
include_once("../includes/dbcon.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

//checks if values are not empty
if($_SERVER['REQUEST_METHOD'] == "POST") 
{
    $tname = mysqli_real_escape_string($con, $_POST["tname"]);

    if (!empty($tname)) 
    {
        $stmt = $con->prepare("CALL AddTeam(?)");
        $stmt->bind_param('s', $tname);

        try 
        {
            $stmt->execute();
            echo "<script>alert('Team added successfully'); windows.replace(manage-teams.php)</script>";
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
    $stmt->close();
    $con->next_result();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Register Team</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

<?php include('convenor-header.php');?>
    <div class="container">

        <h3 class="center">Register a Team</h3>

        <div class="row">

            <form class="col s12" method="POST">
                <div class="row">

                    <div class="input-field col s12">
                        <input id="tname" name="tname" type="text" class="validate">
                        <label for="tname">Team Name</label>
                    </div>

                    <div class="submit">
                        <input type="submit" name="reg_team" value="Register Team" />
                    </div>

                </div>
                    
            </form>

        </div>

    </div>

  <?php include('../includes/footer.php'); ?>
  
  </html>