<?php

include_once("../includes/dbcon.php");

$id = $_REQUEST['userid'];
$get_team_stmt = "CALL GetUserTeamID($id)";
$result= mysqli_query($con, $get_team_stmt);
$row = $result;
$result->close();
$con->next_result();
$stmt = "Call DeleteMember($id)";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try 
{
    $result = mysqli_query($con, $stmt);
    header('Location: manage-teams.php');
            

}
catch (Exception $e)
{
    $errmsg = $e->getMessage();
    echo "<script>alert('$errmsg')</script>";
}

?>