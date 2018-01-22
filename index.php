<?php
    namespace PAI;
    include_once "Model/UserSessions.php";
    include_once "Model/Users.php";
    include_once "Model/UserPrivileges.php";
    use PAI\Model;

    function showPage(){
        require "View/header.php";
        require "View/body.php";
        exit();
    }

    session_start();
    
    $users = new \PAI\Model\Users;
    $usersessions = new \PAI\Model\UserSessions;
    $userprivileges = new \PAI\Model\UserPrivileges;

    $_SESSION['isAdmin'] = false;
    $_SESSION['debug'] = $_SESSION['debug'] . "<br/>Action: " . $_SESSION['action'];

    if(isset($_SESSION['userid'])) {
        if($users -> getPrivilegeID($_SESSION['userid']) === $userprivileges -> getAdminID()){
            $_SESSION['isAdmin'] = true;
        }
        showPage();
    }

    if(!isset($_COOKIE['ssid'])){
        $_SESSION['userid'] = null;
        showPage();
    }

    $ssid = $_COOKIE['ssid'];
    $userid = $usersessions -> getUserID($ssid);

    if(!$userid){
        setcookie("ssid", null, time() - 3600);
        showPage(); 
    }

    $_SESSION['userid'] = $userid;
    if($users -> getPrivilegeID($userid) === $userprivileges -> getAdminID()){
        $_SESSION['isAdmin'] = true;
    }
    showPage();
?>
