<?php
    require_once("../includes/dbcon.php");
    $id = $_REQUEST['teamid'];
    $team_stmt = "CALL GetTeam($id)";
    $result = mysqli_query($con, $team_stmt);
    $row = mysqli_fetch_assoc($result);
    $result->close();
    $con->next_result();

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $tName = mysqli_real_escape_string($con, $_POST["tname"]);

        if (!empty($tName)) 
        {
        $stmt = $con->prepare("CALL UpdateTeamName(?, ?)");
        $stmt->bind_param('is', $id, $tName);

        try 
        {
            $stmt->execute();
            header ('Location: ' .$_SERVER['REQUEST_URI']);


        }
        catch (Exception $e)
        {
            $errmsg = $e->getMessage();
            echo "<script>alert('$errmsg')</script>";
        }
    }
    else
    {
        echo "<script>alert('Please enter a team name')</script>";
    }
    $stmt->close();
    $con->next_result();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Update Team</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

<?php include('convenor-header.php');?>
    <div class="container">
        <h3 class="center">
            <?php echo $row["tName"];?> Members
        </h3>
        <div>
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
                        $member_stmt = "CALL GetTeamMembers($id)";
                        $member_result = mysqli_query($con, $member_stmt);
                        while($member_row = mysqli_fetch_assoc($member_result)){ ?>       
                        <tr>
                            <td><?php echo $member_row["uID"] ?></td>
                            <td><?php echo $member_row["uFName"] ?></td>
                            <td><?php echo $member_row["uSName"] ?></td>
                            <td><a href="remove-member.php?userid=<?php echo $member_row["uID"] ?>">Delete</a></td>
                        </tr>
                </tbody>
                <?php }?>
            </table>
            </br>
            </br>
            <a href="add-member.php" class="left btn brand z-depth-0">Add Members</a> 
        </div>

        </br>           
        </br>            

    </div> 

    <div class="container">                       
         <h3 class="center">Team Maintenance</h3>

        <div class="row">
            <h5 class="left">Change Team Name</h3>
        </div>
           
        <div class="row">
            <form class="col s6" method="POST">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="tname" name="tname" type="text" required value="<?php echo $row['tName'];?>" class="validate">
                    </div>
                </div>

                <div class="submit">
                    <input type="submit" name="update_team" value="Update"/>
                </div>
            </form>
        </div>
    </div>

    </br>
    </br>

    

    

  <?php include('../includes/footer.php'); ?>
  
  </html>