<?php 
    namespace PAI\View;
    require_once "Model/Users.php";
    use PAI\Model;
?>

<div id="welcome">
    <?php 
        if(isset($_SESSION['loginErr'])) { 
            echo '<div class="error">' . $_SESSION['loginErr'] . "</div>"; 
            $_SESSION['loginErr'] = null; 
        } 
    ?>
    Welcome, 

    <?php
        $users = new \PAI\Model\Users;
        $name = $users -> getName($_SESSION['userid']);
        echo $name;
    ?>
    <br>
    <form action="./logout.php" method="post">
        <input class="input_button" type="submit" value="Logout">
    </form>

</div>