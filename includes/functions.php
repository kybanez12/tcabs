<?php
    
    function createTempPassword($birthday) {
        $formatpw = date("m-d-Y", strtotime($_POST["birthday"]));
        $result  = str_replace('-', '', $formatpw);
        $result = password_hash($result, PASSWORD_DEFAULT);
        return $result;
    }

    function emptyNewPassword($pw) {
        $result;
        if (empty($pw)) {
            $result == true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    

    function setNewPw($pw) {
        $query = "insert into users (pWord, first_run) values (?, ?)";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../change.password.php?error=stmtfailed");
            exit();
        }

        $hashedPwd = password_hash($pw, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, 's', $pw);
        mysqli_stmt_execute($stmt);
         
        header("location: ../change.password.php?error=none");

    }

    function emptyInputLogin($userID, $pw) {
        $result;
        if (empty($userID) || empty($pw)) {
            $result == true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    function findUser($con, $userID) {
        $query = "select * from user where uID = ?";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../login.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, 's', $userID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }
        else {
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt);
    }

    function loginUser($con, $userID, $pw) {
        $uidExists = findUser($con, $userID);

        if ($uidExists === false) {
            header("location: ../login.php?error=wronglogin");
            exit();
        }

        $pwHashed = $uidExists["pWord"];
        $checkPw = password_verify($pw, $pwHashed);

        if ($checkPw === false) {
            header("location: ../login.php?error=wrong");
            exit();
        }
        else if ($checkPw === true) {
            session_start();
            $_SESSION["uID"] = $uidExists["uID"];
            header("location: ../index.php");
            exit();
        }
    }

    function check_login($con) {
        if(isset($_SESSION["uid"])) {
            $id = $_SESSION['uid'];
            $query = "select * from user where uID = $id limit 1";

            $result = mysqli_query($con, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_accos($result);
                return $user_data;
            }
        }
        //redirect to login
        header("location: login.php");
        die;
    }
    
