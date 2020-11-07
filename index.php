<?php

    function neverCallGetSiteKey() {
        return '4D1wCP67Zm2y3Dfq';
    }

    session_start();
    if(!isset($_SESSION['KEY']) || $_SESSION['KEY'] !== neverCallGetSiteKey()) {
        
        date_default_timezone_set('Europe/Budapest');

        $_SESSION = [
            'KEY'       => neverCallGetSiteKey(),
            'START'     => time(),
            'USER'      => false,           // <- load from private
            'MEMBER'    => false,
            'AJAX'      => false,
            'CSRF'      => false,
            'REQUEST_INFO'  => [
                'get_request'   => 0,
                'post_request'  => 0,
                'ajax_request'  => 0,
                'get_last'      => 0,
                'post_last'     => 0,
                'ajax_last'     => 0,
            ],
            'DB'                => false,   // <- load from private
            'TITLE'             => '...',
            'DEFAULT_CONTENT'   => 'login', // <- Be able to open without member rank.
            'SETTINGS'          => false,   // <- load from private
        ];

        //HAM

        if (
            file_exists('private/user.json') &&
            file_exists('private/db.json') &&
            file_exists('private/settings.json')
        ) {
            $_SESSION['USER']       = json_decode(file_get_contents('private/user.json'),true);
            $_SESSION['DB']         = json_decode(file_get_contents('private/db.json'),true);
            $_SESSION['SETTINGS']   = json_decode(file_get_contents('private/settings.json'),true);
        } else {
            echo 'One or more config files are missing or corrupt!';
            exit(0);
        }

    }

    // SETTINGS ...

    function makeDate($_year,$_month,$_day) {
        return mktime(0, 0, 0, $_month, $_day, $_year);
    }

    function getDateStamp() {
        return mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    }

    function getMonthRange($_year,$_month) {
        $_dayCount = date('t',mktime(0, 0, 0, $_month, 1, $_year));
        return [
            'start' => mktime(0, 0, 0, $_month, 1, $_year)          -1,
            'end'   => mktime(0, 0, 0, $_month, $_dayCount, $_year) +86400
        ];
    }

    // AJAX REQUEST

    if(isset($_GET['a'])) {
        $_SESSION['AJAX'] = true;
    } else {
        $_SESSION['AJAX'] = false;
        updateCSRF();
    }

    function updateCSRF() {
        $_SESSION['CSRF'] = bin2hex(random_bytes(32));
    }

    function getCSRF() {
        return $_SESSION['CSRF'];
    }

    // BASE

    function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    function isMember() {
        return $_SESSION['MEMBER'];
    }

    function location($_location) {
        header('Location: ?'.$_location);
        exit(0);
    }

    // LAYOUT NESTED

    function setTitle($_title) {
        $_SESSION['TITLE'] = $_title;
    }

    // LAYOUT

    if(isPost()) {
        $_SESSION['REQUEST_INFO']['post_request'] += 1;
        $_SESSION['REQUEST_INFO']['post_last'] = time();
    } else {
        $_SESSION['REQUEST_INFO']['get_request'] += 1;
        $_SESSION['REQUEST_INFO']['get_last'] = time();
    }

    if($_SESSION['AJAX']) {
        if(isPost()) {
            $_SESSION['REQUEST_INFO']['ajax_request'] += 1;
            $_SESSION['REQUEST_INFO']['ajax_last'] = time();
            require('ajax.php');
        } else {
            echo 'Invalid AJAX call!';
            exit(0);
        }
    } else {
        require('base/layout.php');
    }

?>
