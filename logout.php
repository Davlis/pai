<?php

    namespace PAI;
    require_once "Model/UserSessions.php";
    use PAI\Model;
    $us = new \PAI\Model\UserSessions;

    session_start();
    $us -> end($_SESSION['userid']);

    $_SESSION['userid'] = null;
    $_SESSION['action'] = null;

    setcookie('ssid', null, time() - 3600, "/");

    header("Location: ./index.php");
    exit();

?>