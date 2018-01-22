<div id="login">
    <?php 
        if(isset($_SESSION['loginErr'])) { 
            echo '<div class="error">' . $_SESSION['loginErr'] . "</div>"; 
            $_SESSION['loginErr'] = null; 
        } 
    ?>
    <form action="./login.php"  method="post">
        
        <?php
            if(!isset($_SESSION['activate'])) {
                echo '<input class="input_box" type="text" name="email" placeholder="email" required>';
                echo '<input class="input_box" type="password" name="password" placeholder="password" required>';
                echo '<input class="input_button" type="submit" name="login" value="Login">';
            } else {
                echo '<input class="input_box" type="text" name="code" placeholder="activation code for ' . $_SESSION['email'] . '">';
                echo '<input class="input_button" type="submit" name="activate" value="Activate">';
                echo '<input class="input_button" type="submit" name="cancelActivation" value="Cancel">';
            }
        ?>
    </form>
</div>