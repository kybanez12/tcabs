<?php

include_once("../includes/dbcon.php");

$id = $_REQUEST['userid'];
$get_user_stmt = "CALL GetUser($id)";  
$result = mysqli_query($con, $get_user_stmt);
$row = mysqli_fetch_assoc($result);  
$result->close();    
$con->next_result();
$rID = $row['rID'];
$delete_stmt = "CALL DeleteUser('1',$id)"; // i put rID = 1 since we in admin page, we should be able to delete other users

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try
{
    $result = mysqli_query($con, $delete_stmt);
    header('Location: manage-users.php');

}
catch (Exception $e)
{
    $errmsg = $e->getMessage();
    echo "<script>alert('$errmsg'); history.go(-1); </script>";

}

?>
