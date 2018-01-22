<?php 
    namespace PAI\View;
    require_once "Model/Users.php";
    use PAI\Model;

    if(isset($_SESSION['loginErr'])) { 
        echo '<div class="error">' . $_SESSION['loginErr'] . "</div>"; 
        $_SESSION['loginErr'] = null; 
    } 

    $users = new \PAI\Model\Users;
    $name = $users -> getName($_SESSION['userid']);
    echo '<div class="text_box">Welcome, ' . $name . '</div>';
?>

<form action="./logout.php">
    <button type="submit">Logout</button>
</form>
