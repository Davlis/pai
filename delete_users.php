<?php

    namespace PAI;
    require_once "Model/Users.php";
    require_once "Model/UserPrivileges.php";
    use PAI\Model;
    $users = new \PAI\Model\Users;
    $priv = new \PAI\Model\UserPrivileges;

    session_start();

    function index(){
        header("Location: ./index.php");
        exit();
    }

    $userid = $_GET['id'];
    $code = $users -> getActivationCode($userid);

    if(!isset($_GET['confirm'])) {
        $_SESSION['bodyErr'] = '<a class="error" href="./delete_users.php?id=' . $_GET['id'] . '&amp;confirm=' . $code . '">Confirm deletion of user ' . $users -> getEmail($_GET['id']) . ' by clicking here</a>';
        index();
    }

    if($_GET['confirm'] !== $code) {
        $_SESSION['bodyErr'] = "Confirmation error!";
        index();
    }

    if($userid == $_SESSION['userid']) {
        $_SESSION['bodyErr'] = "Cannot delete your own account!";
        index();
    }

    if($users -> getPrivilegeID($userid) == $priv -> getAdminID()) {
        $_SESSION['bodyErr'] = "Cannot delete administrator account!";
        index();
    }

    $result = $users -> deleteUser($userid);
    $_SESSION['bodyErr'] = $result ? "User deleted successfully!" : "Error while deleting user!";
    index();

?>