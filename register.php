<?php

namespace PAI;
require_once "Model/Users.php";
require_once "Model/UserPrivileges.php";
use PAI\Model;
$users = new \PAI\Model\Users;
$priv = new \PAI\Model\UserPrivileges;

function index(){
    header("Location: ./index.php");
    exit();
}

session_start();

/*
if(!isset($_POST['reg_email']) || $_POST['reg_email'] == "") {
    $_SESSION['regErr'] = "No email entered!";
    index();
}

if(!isset($_POST['reg_pass']) || $_POST['reg_pass'] == "") {
    $_SESSION['regErr'] = "No password entered!";
    index();
}

if(!isset($_POST['reg_pass2']) || $_POST['reg_pass2'] == "") {
    $_SESSION['regErr'] = "No repeated password entered!";
    index();
}
*/

$email = $_POST["reg_email"];
$pass = $_POST["reg_pass"];
$pass2 = $_POST["reg_pass2"];

if($users -> getID($email)){
    $_SESSION['regErr'] = "User already exists!";
    index();
}

if($pass !== $pass2){
    $_SESSION['regErr'] = "Passwords don't match!";
    index();
}

if(!isset($_POST['reg_name']) || $_POST['reg_name'] == "") {
    $isRegistered = $users -> insertUser($email, $pass, $priv -> getUserID());
} else {
    $name = $_POST['reg_name'];
    $isRegistered = $users -> insertUser($email, $pass, $priv -> getUserID(), $name);
}

if(!$isRegistered){
    $_SESSION['regErr'] = "Couldn't register user due to unknown error!";
    index();
}

$_SESSION['regErr'] = "Account registered! Check your mail for activation code";

$activationcode = $users -> getActivationCode($users -> getID($email));

$message = "Hi, ";
if(isset($name)) { $message = $message . $name . ", "; }
$message = $message . "here is your activation code: " . $activationcode . "\r\nInsert it in the field shown while logging in to activate your account.";

$isSent = mail($email, "Activation code", $message);

if(!$isSent) {
    $_SESSION['regErr'] = $_SESSION['regErr'] . "<br/>ERROR! Couldn't send activaion code!";
}

index();

?>