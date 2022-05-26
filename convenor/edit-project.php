<?php

    require("../includes/dbcon.php");
    $projectid = $_REQUEST['projectid'];
    $project_stmt = "CALL GetProject($projectid)";
    $result = mysqli_query($con, $project_stmt);
    $row = mysqli_fetch_assoc($result);
    $result->close();
    $con->next_result();
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $pName = mysqli_real_escape_string($con, $_POST["pname"]);
        $pDescription = mysqli_real_escape_string($con, $_POST["pdescription"]);
        $startdate = date("Y-m-d", strtotime($_POST["startdate"]));
        $enddate = date("Y-m-d", strtotime($_POST["enddate"]));

        if (!empty($projectid) && !empty($pName) && !empty($pDescription) && !empty($startdate) && !empty($enddate)) 
        {
            
        $stmt = $con->prepare("CALL UpdateProject(?, ?, ?, ?, ?)");
        $stmt->bind_param('issss', $projectid, $pName, $pDescription, $startdate, $enddate);

        try 
        {
            $stmt->execute();
            header ('Location: manage-projects.php');
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
<title>Update Team</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

<?php include('convenor-header.php');?>

    <div class="container">       

        <h3 class="center">Project Maintenance</h3>

        <div clas="row">
            <form class="col 12" method="POST">

                <div class="row">
                    <div class="input-field col s12">
                        <input id="pname" name="pname" type="text" required value="<?php echo $row['pName'];?>" class="validate">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="pdescription" name="pdescription"  class="validate" required value="<?php echo $row['pDescription'];?>">
                    </div>
                </div>

                <div class="row">

                    <div class="input-field col s6">
                        <input type="text" name="startdate" class="datepicker" required value= "<?php echo date('d-m-y', strtotime($row['pStartDate']));?>">
                    </div>

                    <div class="input-field col s6">
                        <input type="text" name="enddate" class="datepicker" required value= "<?php echo date('d-m-y', strtotime($row['pEndDate']));?>">
                    </div>
                    
                </div>

                <div class="submit">
                    <input type="submit" name="update_project" value="Update"/>
                </div>

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