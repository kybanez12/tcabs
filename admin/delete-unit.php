<?php

include_once("../includes/dbcon.php");

$id = $_REQUEST['unitID'];
$delete_stmt = "CALL DeleteUnit($id)";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try
{
    $result = mysqli_query($con, $delete_stmt);
    header('Location: manage-units.php');

}
catch (Exception $e)
{
    $errmsg = $e->getMessage();
    echo "<script>alert('$errmsg'); history.go(-1); </script>";

}

?>
