<?php

include "../includes/dbcon.php";

if(isset($_POST['add_user'])) //something is wrong here
{
    $fname = mysqli_real_escape_string($con,$_POST['fname']);
    $sname = mysqli_real_escape_string($con,$_POST['sname']);
    $birthday = date("Y-m-d", strtotime($_POST['birthday']));
    $mobile = mysqli_real_escape_string($con,$_POST['mobile']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    if ($_POST["role"] == "admin") {
        $role = 1;
    }
    if ($_POST["role"] == "convenor") {
        $role = 2;
    }
    if ($_POST["role"] == "student") {
        $role = 3;
    }
    if ($_POST["role"] == "supervisor") {
        $role = 4;
    }
    
    if ($fname != "" && $sname != "" && $birthday != "" && $mobile != "" && $email != "") {

        $stmt = $con->prepare("CALL InsertUser(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $fname, $sname, $birthday, $mobile, $email, $role);
        
        try 
        {
            $stmt->execute();
            echo "<script>alert('New user added'); history.go(-1);</script>";

        }
        catch (Exception $e)
        {
            $errmsg = $e->getMessage();
            echo "<script>alert('$errmsg'); history.go(-1);</script>";
        }
    }
}
