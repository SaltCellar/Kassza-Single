<?php

    /*

        R E Q U E S T

        $_POST['_csrf']
        $_POST['endpoint']
        $_POST['data']

        R E S P O N S E

        {
            status      <- boolean
            data
            error
            success
            default
        }
    
    */
    
    // Befor

    if(!isPost()) {
        print 'Connection rejected! - Invalid Method!';
        exit(0);
    }

    if(
        !isset($_POST['_csrf']) ||
        !isset($_POST['endpoint']) ||
        !isset($_POST['data'])
    ) {
        print 'Connection rejected!';
        exit(0);
    }

    if(
        $_SESSION['CSRF'] === false ||
        $_SESSION['CSRF'] !== $_POST['_csrf']
    ) {
        print 'Connection rejected!';
        session_destroy();
        exit(0);
    }

    $_POST['data'] = json_decode($_POST['data'],true);

    // * * * * * * * * * * * * * * * * * //
    //          Endpoints
    // * * * * * * * * * * * * * * * * * //

    $P = [

        //Login
        'login' => function() {
            
            if(!isMember()) {

                if (
                    !isset($_POST['data']['username']) ||
                    !isset($_POST['data']['password'])
                ) {
                    response(false,false,"Missing some data parameters!");
                }

                if (
                    password_verify($_POST['data']['username'],$_SESSION['USER']['username']) &&
                    password_verify($_POST['data']['password'],$_SESSION['USER']['password'])
                ) {
                    $_SESSION['MEMBER']     = true;
                    response(true);
                } else {
                    response(false,false,"Invalid username or password!");
                }

                response(false,false,"Unknown Error!");

            } else {
                response(false,false,"Already logged in!");
            }

        },

        //Logout
        'logout' => function() {

            if(isMember()) {
                session_destroy();
                response(true);
            } else {
                response(false,false,"You are not logged in!");
            }

        },

        //Return the settings for the settings UI
        'get-settings' => function() {
            if(isMember()) {
                response(true,$_SESSION['SETTINGS']);
            } else {
                response(false,false,"You are not logged in!");
            }
        },

        //Validate & Update the settings
        'update-settings' => function() {
            if(isMember()) {
                $_OptionName    = $_POST['data']['name'];
                $_OptionValue   = $_POST['data']['value'];

                if(!isset($_SESSION['SETTINGS'][$_OptionName])) {
                    response(false,false,"There is no such setting option!");
                }

                if (is_bool($_OptionValue) !== true) {
                    response(false,false,"The value received is not boolean!");
                }

                $_SESSION['SETTINGS'][$_OptionName] = $_OptionValue;

                file_put_contents('private/settings.json',json_encode($_SESSION['SETTINGS']));

                response(true);
            } else {
                response(false,false,"You are not logged in!");
            }
        },

        //Change username or password
        'change-uop' => function() {

            $_target    = $_POST['data']['target'];
            $_value     = $_POST['data']['value'];

            if (is_bool($_target) !== true) {
                response(false,false,"The [Target] value received is not boolean!");
            }

            if (is_string($_value) !== true) {
                response(false,false,"The [Value] value received is not string!");
            }

            if ( !preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/', $_value) ) {
                response(false,false,"Incorrect string!");
            }

            if($_target) {
                $_SESSION['USER']['username'] = password_hash($_value,PASSWORD_DEFAULT);
            } else {
                $_SESSION['USER']['password'] = password_hash($_value,PASSWORD_DEFAULT);
            }

            file_put_contents('private/user.json',json_encode($_SESSION['USER']));

            response(true);
        },

    ];

    // Execute

    if(isset($P[$_POST['endpoint']])) {
        $P[$_POST['endpoint']]();
    } else {
        //print 'Endpoint not found!';
        response(false,isset($P),"Endpoint not found! -> ".$_POST['endpoint']);
        exit(0);
    }

    // Response

    function response(
        $_status,
        $_data      = false,
        $_error     = false,
        $_success   = false,
        $_default   = false
    ) {
        print json_encode([
            'status'    => $_status,
            'data'      => $_data,
            'error'     => $_error,
            'success'   => $_success,
            'default'   => $_default
        ]);
        exit(0);
    }

?>