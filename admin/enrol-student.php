<!-- This page allows a convenor to enrol a student into a unit of study -->
<?php
/* Attempt to connect to MySQL database */
include_once("../includes/dbcon.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

//checks if values are not empty
if($_SERVER['REQUEST_METHOD'] == "POST") 
{
    $userID = mysqli_real_escape_string($con, $_POST["userID"]);
    $unitID = mysqli_real_escape_string($con, $_POST["unitID"]);
    
    if ($_POST["teaching_period"] == "tp1") {
        $teaching_period = 1;
    }
    if ($_POST["teaching_period"] == "tp2") {
        $teaching_period = 2;
    }

    if (!empty($userID) && !empty($unitID) && !empty($teaching_period))
    {
        $stmt = $con->prepare("CALL EnrolStudent(?,?,?)");
        $stmt->bind_param('iii', $userID, $unitID, $teaching_period );

        try 
        {
            $stmt->execute();
            echo "<script>alert('Student enrolled successfully'); windows.replace(enrolment.php) </script>";
        }
        catch (Exception $e)
        {
            $errmsg = $e->getMessage();
            echo "<script>alert('$errmsg')</script>";
        }
    }
    else
    {
        echo "<script>alert('Please enter all fields'); history.go(-1);</script>";
    }
    $stmt->close();
    $con->next_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Enrol Student</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

<?php include('admin-header.php');?>
    <div class="container">
        <h3 class="center">Enrol Student</h3>
        <div class="row">
            <form class="col s12" method="POST" enctype="multipart/form-data" action="">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="userID" name="userID" type="text" class="validate">
                        <label for="userID">User ID</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="unitID" name="unitID" type="text" class="validate">
                        <label for="unitID">Unit ID</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <select class="display: block;" name="teaching_period">
                            <option value=" " disabled selected>Choose your option</option>
                            <option value="tp1">Semester 1 2022</option>
                            <option value="tp2">Semester 2 2022</option>
                        </select>
                        <label>Select Teaching Period</label>
                    </div>
                </div>
                <div class="submit"><input type="submit" name="enrol_student" value="Enrol Student" /></div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var sel = document.querySelectorAll('select');
        M.FormSelect.init(sel);
        });
    </script>


  <?php include('../includes/footer.php'); ?>
  </html>