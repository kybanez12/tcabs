<?php

    require("../includes/dbcon.php");
    $unitid = $_REQUEST['unitID'];
    $user_stmt = "CALL GetUnit($unitid)";
    $result = mysqli_query($con, $user_stmt);
    $row = mysqli_fetch_assoc($result);
    $result->close();
    $con->next_result();
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $unitCode = mysqli_real_escape_string($con, $_POST["unitcode"]);
        $unitName = mysqli_real_escape_string($con, $_POST["unitname"]);
        if (!empty($unitid) && !empty($unitCode) && !empty($unitName))
        {

        $stmt = $con->prepare("CALL UpdateUnit(?, ?, ?)");
        $stmt->bind_param('iss', $unitid, $unitCode, $unitName);

        try
        {
            $stmt->execute();
            header ('Location: manage-units.php');
        }
        catch (Exception $e)
        {
            $errmsg = $e->getMessage();
            echo "<script>alert('$errmsg')</script>";
        }
            $stmt->close();
            $con->next_result();
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
<title>Update User</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

<?php include('admin-header.php');?>

    <div class="container">

        <h3 class="center">Unit Modify</h3>

        <div clas="row">
            <form class="col 12" method="POST">

                <div class="row">
                    <div class="input-field col s12">
                        <input id="unitcode" name="unitcode" type="text" required value="<?php echo $row['unitCode'];?>" class="validate">
                        <label for="unitcode">Unit Code</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="unitname" name="unitname" type="text"  class="validate" required value="<?php echo $row['unitName'];?>">
                        <label for="unitname">Unit Name</label>
                    </div>
                </div>

                <div class="submit">
                    <input type="submit" name="update_unit" value="Update"/>
                </div>

            </form>
        </div>
    </div>




  <?php include('../includes/footer.php'); ?>

  </html>
