<?php
    namespace PAI;
    include_once "Model/Users.php";
    use PAI\Model;

    $users = new \PAI\Model\Users;
    $usertable = $users -> getAllUserID();

    //var_dump($usertable);

    echo "<h1>Delete User:</h1>";

    foreach($usertable as $userid){
        $active = $users -> isActive($userid) ? ", activated" : ", not activated";
        $user = $users -> getName($userid) . ", " . $users -> getEmail($userid) . $active;
        
        echo '<a href="./delete_users.php?id=' . $userid . '">' . $user . "</a><br/>";
    }
?>