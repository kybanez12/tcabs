<?php

    require("../includes/dbcon.php");
    $userid = $_REQUEST['userid'];
    $user_stmt = "CALL GetUser($userid)";
    $result = mysqli_query($con, $user_stmt);
    $row = mysqli_fetch_assoc($result);
    $result->close();
    $con->next_result();
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
    
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $fName = mysqli_real_escape_string($con, $_POST["fname"]);
        $sName = mysqli_real_escape_string($con, $_POST["sname"]);
        $Birthday = date("Y-m-d", strtotime($_POST['birthday']));
        $Mobile = mysqli_real_escape_string($con,$_POST['mobile']);
        $Email = mysqli_real_escape_string($con,$_POST['email']);
        if (!empty($userid) && !empty($fName) && !empty($sName) && !empty($Birthday) && !empty($Mobile) && !empty($Email))
        {

        $stmt = $con->prepare("CALL UpdateAUser(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('isssss', $userid, $fName, $sName, $Birthday, $Mobile, $Email);

        try
        {
            $stmt->execute();
            header ('Location: manage-users.php');
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

        <h3 class="center">User Modify</h3>

        <div clas="row">
            <form class="col 12" method="POST">

                <div class="row">
                    <div class="input-field col s12">
                        <input id="fname" name="fname" type="text" required value="<?php echo $row['uFName'];?>" class="validate">
                        <label for="fname">First Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="sname" name="sname" type="text"  class="validate" required value="<?php echo $row['uSName'];?>">
                        <label for="sname">Surname</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="birthday" name="birthday" type="text" required value="<?php echo $row['birthday'];?>" class="validate">
                        <label for="birthday">Date of Birth</label>
                    </div>
                </div>

                <div class="row">
    <div class="input-field col s12">
        <input id="mobile" name="mobile" type="text" class="validate" required value="<?php echo $row['uMobile'];?>">
        <label for="mobile">Mobile</label>
    </div>
</div>
<div class="row">
    <div class="input-field col s12">
        <input id="email" name="email" type="text" class="validate" required value="<?php echo $row['uEmail'];?>">
        <label for="email">Email</label>
    </div>
</div>

                <div class="submit">
                    <input type="submit" name="update_user" value="Update"/>
                </div>

            </form>
        </div>
    </div>




  <?php include('../includes/footer.php'); ?>

  </html>
