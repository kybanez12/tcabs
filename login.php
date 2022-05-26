<?php
include "includes/dbcon.php";

if(isset($_POST['but_submit'])){

    $uname = mysqli_real_escape_string($con,$_POST['uID']);
    $password = mysqli_real_escape_string($con,$_POST['pword']);


    if ($uname != "" && $password != ""){
        
        $stmt = $con->prepare("CALL LogIn(?, ?)");
        $stmt->bind_param("is", $uname, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_array($result);
        $count = $row['cntUser'];

        if($count > 0){
            $_SESSION['uname'] = $uname;
            header('Location: privledge.php');
        }else{
            echo "Invalid username and password";
        }

    }

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>TCABS</title>
    </head>
    
    <?php include('includes/index.header.php'); ?>
    
    <body>
        <div class="container">
            <h1 class="center">Welcome to TCABS</h1>
            <form method="post" action="">
                <div id="div_login">
                    <div>
                        <input type="text" class="textbox" id="uID" name="uID" placeholder="User ID:" />
                    </div>
                    <div>
                        <input type="password" class="textbox" id="pword" name="pword" placeholder="Password:"/>
                    </div>
                    <div>
                        <input type="submit" value="Submit" name="but_submit" id="but_submit" />
                    </div>
                </div>
            </form>
        </div>
    </body>
    <?php include('includes/footer.php'); ?>
</html>