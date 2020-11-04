<?php

    function dbm_connection() {
        return new mysqli($_SESSION['DB']['address'], $_SESSION['DB']['username'], $_SESSION['DB']['password'], $_SESSION['DB']['db']);
    }

    // * * * * * * * * * * * * *
    //      N A P O K
    // * * * * * * * * * * * * *

    function dbm_addNap(/* ... */) {
        
    }

    function dbm_updateNap(/* ... */) {
        
    }

    function dbm_getNap($_date) {

    }

    function dbm_getHonap($_date) {

    }

?>