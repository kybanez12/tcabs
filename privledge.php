<?php
include "includes/dbcon.php";
    if(!isset($_SESSION['uname'])){
    echo "You are not signed in";
    header('Location: login.php');
}
    $uname = $_SESSION['uname'];
    if ($uname != ""){
        $sql = "CALL CheckPrivledge(?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $uname);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $user = $result->fetch_assoc();
        //$row = $row['userPriv'];
        /*$sql = "CALL CheckPrivledge(".$uname.")";
        echo $sql;
        $result = mysql_query($sql);
        echo "1";
        $query_data = mysql_fetch_row($result);
        $row= $query_data[0];
        echo $row;*/
        //$sqlQuery= "CALL CheckPrivledge(".$uname.")";
        //$result = mysqli_query($con,$sqlQuery);
        //$row = $result->fetch(PDO::FETCH_ASSOC);
        //echo $row;
        //$stmt = $con->prepare("CALL CheckPrivledge(?)");
        //$stmt->bind_param("i", $uname);
        //$stmt->execute();
        //$result = $stmt->get_result();
        //while($row = $result_1->fetch_assoc()) {
        //do something
            //echo $row['userPriv'];
        //}
        //}
        //$stmt = "CALL CheckPrivledge(?)";
        //$stmt->bind_param("i", $uname);
        //$stmt->execute();
        //$result = $stmt->get_result();
        //$row = mysqli_fetch_row($result);
        if($user['rID'] == 1){
            header('Location: admin/admin-dashboard.php');
            echo "Welcome Admin";
        }
        elseif($user['rID'] == 2){
            header('Location: convenor/convenor-dashboard.php');
            echo "Welcome Convenor";
        }
        echo "There was an error validating your login";

        }
        else
            echo "No Valid User";
?>