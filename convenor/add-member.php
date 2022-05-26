<?php
/* Attempt to connect to MySQL database */
include_once("../includes/dbcon.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if($_SERVER['REQUEST_METHOD'] == "POST") 
{
    $uID = mysqli_real_escape_string($con, $_POST['uID']);
    $tID = mysqli_real_escape_string($con, $_POST['tID']);

    // checks if inputs are emtpy
    if (!empty($uID) && !empty($tID)) 
    {
        $stmt = $con->prepare("CALL AddTeamMember(?,?)");
        $stmt->bind_param('ii', $uID, $tID);

        try 
        {
            $stmt->execute();
            echo "<script>alert('Team Member added')</script>";
            
        }
        catch (Exception $e)
        {
            $errmsg = $e->getMessage();
            echo "<script>alert('$errmsg')</script>";
        }
    }
    else
    {
        echo "<script>alert('Please enter User and Team ID')</script>";
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

        <h3 class="center">Add a Team Member</h3>

        <div class="row">

            <form class="col s12" method="POST">
                <div class="row">

                    <div class="input-field col s12">
                        <input id="uID" name="uID" type="text" class="validate">
                        <label for="uID">User ID</label>
                    </div>

                    <div class="input-field col s12">
                        <input id="tID" name="tID" type="text" class="validate">
                        <label for="tID">Team ID</label>
                    </div>

                </div>

                <div class="submit">
                        <input type="submit" name="add_member" value="Add Member" />
                </div>
                
            </form>

        </div>

    </div>

  <?php include('../includes/footer.php'); ?>
  
  </html>