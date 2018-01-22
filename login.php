<?php

namespace PAI;
require_once "Model/Users.php";
require_once "Model/UserSessions.php";
use PAI\Model;

session_start();
$users = new \PAI\Model\Users;
$session = new \PAI\Model\UserSessions;

function index(){
    header("Location: ./index.php");
    exit();
}

function activateSession($userid){
    global $users, $session;

    $session -> start($userid);
    $ssid = $session -> getSSID($userid);
    setcookie('ssid', $ssid, 2147483647, "/");
    $_SESSION['userid'] = $userid;
}

//TODO check if session for that user exist in db during login, if so delete it and create another

if(isset($_POST['cancelActivation'])) {
    $_POST['cancelActivation'] = null;
    $_SESSION['activate'] = null;
    $_SESSION['email'] = null;
    index();
}

if(!isset($_POST['login']) && !isset($_POST['activate'])){
    $_SESSION['debug'] = $_SESSION['debug'] . "<br/>Login cant be accessed outside form";
    index();
}

if(isset($_SESSION['activate'])) {
    $userid = $users -> getID($_SESSION['email']);

    $activationcode = $_POST['code'];
    $dbcode = $users -> getActivationCode($userid);

    if($activationcode !== $dbcode){
        $_SESSION['loginErr'] = 'Wrong activation code!';
        index();
    }

    $_SESSION['activate'] = null;
    $_SESSION['loginErr'] = 'Account activated!';
    $_SESSION['email'] = null;
    $users -> setActive($userid);
    activateSession($userid);
    index();
}

/*
if(!isset($_POST['email']) || $_POST['email'] == "") {
    $_SESSION['loginErr'] = "No email entered!";
    index();
}

if(!isset($_POST['password']) || $_POST['password'] == "") {
    $_SESSION['loginErr'] = "No password entered!";
    index();
}
*/

$email = $_POST['email'];
$userid = $users -> getID($email);

if(!$userid) {
    $_SESSION['loginErr'] = "User doesn't exist!";
    index();
}

$password = $_POST['password'];
$dbpass = $users -> getPassword($userid);
                
if($password !== $dbpass) {
    $_SESSION['loginErr'] = 'Wrong password!';
    index();
}

if(!$users -> isActive($userid)) {
    if(!isset($_SESSION['activate'])) {
        $_SESSION['loginErr'] = 'You need to activate your account!';
        $_SESSION['activate'] = true;
        $_SESSION['email'] = $email;
        index();
    } 
}

$_SESSION['loginErr'] = null;
activateSession($userid);
index();

?>