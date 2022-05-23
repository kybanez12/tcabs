<?php
/* Attempt to connect to MySQL database */
include_once("../includes/dbcon.php");


if($_SERVER['REQUEST_METHOD'] == "POST") 
{
    $uID = mysqli_real_escape_string($con, $_POST['uID']);
    $tID = mysqli_real_escape_string($con, $_POST['tID']);

    // check for Project Manager
    if (!empty($_POST['pmCheck'])) 
    {
        $pmcheck = 1;
    }
    else
    {
        $pmcheck = 0;
    }
    
    // checks if inputs are emtpy
    if (!empty($uID) && !empty($tID)) 
    {
        $stmt = $con->prepare("CALL AddTeamMember(?, ?, ?)");
        $stmt->bind_param('iii', $uID, $tID, $pmCheck);

        try 
        {
            $stmt->execute();
            echo "<script>alert('Team Member added successfully')</script>";
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
                    
                    <div class="col s12">
                        <label>
                            <input type="checkbox" name="pmCheck" value="1"/>
                            <span>Project Manager</span>
                        </label>
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