<?php 
    if(isset($_SESSION['loginErr'])) { 
        echo '<div class="error">' . $_SESSION['loginErr'] . "</div>"; 
        $_SESSION['loginErr'] = null; 
    } 
?>

<form action="./login.php"  method="post">
    
<?php
    if(!isset($_SESSION['activate'])) {
        echo '<input type="text" name="email" placeholder="email" required>';
        echo '<input type="password" name="password" placeholder="password" required>';
        echo '<button type="submit" name="login">Login</button>';
    } else {
        echo '<input type="text" name="code" placeholder="activation code for ' . $_SESSION['email'] . '">';
        echo '<button type="submit" name="activate">Activate</button>';
        echo '<button type="submit" name="cancelActivation">Cancel</button>';
    }
?>

</form>