<?php
    function createTempPassword($birthday) {
        $formatpw = date("m-d-Y", strtotime($_POST["birthday"]));
        $result  = str_replace('-', '', $formatpw);
        return $result;
    }

    
