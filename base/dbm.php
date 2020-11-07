<?php

    function dbm_connection() {
        return mysqli_connect($_SESSION['DB']['address'], $_SESSION['DB']['username'], $_SESSION['DB']['password'], $_SESSION['DB']['db']);
    }

    // * * * * * * * * * * * * *
    //      N A P O K
    // * * * * * * * * * * * * *

    function dbm_addNap($_options) {
        
        $sql = "INSERT INTO napok (time, kp, bv_osz, ny_db, bv_bank, ki_osz, ki_db, bv_a, bv_b, bv_c, bv_d, bv_e) 
        VALUES (".$_options['time'].", ".$_options['kp'].", ".$_options['bv_osz'].", ".$_options['ny_db'].", ".$_options['bv_bank'].", ".$_options['ki_osz'].", ".$_options['ki_db'].", ".$_options['bv_a'].", ".$_options['bv_b'].", ".$_options['bv_c'].", ".$_options['bv_d'].", ".$_options['bv_e'].")";

        $res = false;

        //VALIDATE
        foreach($_options as $v) {
            if(!is_int($v)) {
                echo '.)';
                exit(0);
            }
        }

        $conn = dbm_connection();
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (mysqli_query($conn, $sql)) {
            $res = true;
        } else {
            if(mysqli_error($conn) == "Duplicate entry '".$_options['time']."' for key 'PRIMARY'") {
                if (mysqli_query($conn,"UPDATE napok SET 
                kp = ".$_options['kp'].",
                bv_osz = ".$_options['bv_osz'].",
                ny_db = ".$_options['ny_db'].",
                bv_bank = ".$_options['bv_bank'].",
                ki_osz = ".$_options['ki_osz'].",
                ki_db = ".$_options['ki_db'].",
                bv_a = ".$_options['bv_a'].",
                bv_b = ".$_options['bv_b'].",
                bv_c = ".$_options['bv_c'].",
                bv_d = ".$_options['bv_d'].",
                bv_e = ".$_options['bv_e']."
                WHERE time=".$_options['time'])) {
                    $res = true;
                }
            }
        }

        mysqli_close($conn);

        return $res;
    }

    function dbm_updateNap($_options) {
        
        $res = false;

        //VALIDATE
        foreach($_options as $v) {
            if(!is_int($v)) {
                echo '.)';
                exit(0);
            }
        }

        $conn = dbm_connection();
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (mysqli_query($conn,"UPDATE napok SET 
        kp = ".$_options['kp'].",
        bv_osz = ".$_options['bv_osz'].",
        ny_db = ".$_options['ny_db'].",
        bv_bank = ".$_options['bv_bank'].",
        ki_osz = ".$_options['ki_osz'].",
        ki_db = ".$_options['ki_db'].",
        bv_a = ".$_options['bv_a'].",
        bv_b = ".$_options['bv_b'].",
        bv_c = ".$_options['bv_c'].",
        bv_d = ".$_options['bv_d'].",
        bv_e = ".$_options['bv_e']."
        WHERE time=".$_options['time'])) {
            $res = true;
        }

        mysqli_close($conn);

        return $res;

    }

    function dbm_getNap($_date) {

        

    }

    function dbm_getHonap($_date) {

    }

?>