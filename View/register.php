<div id="register">
    <?php 
        if(isset($_SESSION['regErr'])) { 
            echo '<div class="error">' . $_SESSION['regErr'] . "</div>"; 
            $_SESSION['regErr'] = null; 
        } 
    ?>
    <h1>Create an Account:</h1>
    <form action="./register.php" method="post">
        <input class="input_box" type="email" placeholder="email" name="reg_email" required/>
        <input class="input_box" type="text" placeholder="name (not required)" name="reg_name"/>
        <input class="input_box" type="password" placeholder="password" name="reg_pass" required />
        <input class="input_box" type="password" placeholder="repeat password" name="reg_pass2" required />
        <input class="input_button" type="submit" class="data" value="Register" />
    </form>
</div>
