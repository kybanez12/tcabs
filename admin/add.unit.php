<?php

include "../includes/dbcon.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if(isset($_POST['add_unit'])) //something is wrong here
{
    $unitCode = mysqli_real_escape_string($con,$_POST['unitCode']);
    $unitName = mysqli_real_escape_string($con,$_POST['unitName']);

    if (!empty($unitCode) && !empty($unitName)) {

        $stmt = $con->prepare("CALL AddNewUnit(?, ?)");
        $stmt->bind_param("ss", $unitCode, $unitName);

        try
        {
            $stmt->execute();
            echo "<script>alert('New unit added');";
                        echo 'window.location = "manage-units.php";';
            echo '</script>';

        }
        catch (Exception $e)
        {
            $errmsg = $e->getMessage();
            echo "<script>alert('$errmsg'); history.go(-1);</script>";
        }
    }
    else
    {
        echo "<script>alert('Please enter all fields'); history.go(-1);</script>";
    }
    
}
?>

