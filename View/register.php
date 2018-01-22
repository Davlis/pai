<div id="register">
    
    <?php 
        if(isset($_SESSION['regErr'])) { 
            echo '<div class="error">' . $_SESSION['regErr'] . "</div>"; 
            $_SESSION['regErr'] = null; 
        } 
    ?>

    <h1>Create an Account:</h1>
    <form action="./register.php" method="post">
        <input type="email" placeholder="email" name="reg_email" required/>
        <input type="text" placeholder="name (not required)" name="reg_name"/>
        <input type="password" placeholder="password" name="reg_pass" required />
        <input type="password" placeholder="repeat password" name="reg_pass2" required />
        <button type="submit" name="register">Register</button>
    </form>
</div>
