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
        <input type="password" placeholder="password" name="reg_pass" id="pass" 
        onchange="checkPasswords()" required />
        <input type="password" placeholder="repeat password" name="reg_pass2" id="passRe" onkeyup="checkPasswords()" required />
        <span id="error-log"></span>
        <button type="submit" name="register">Register</button>
    </form>

</div>

<script>

function checkPasswords() {
    var password = document.getElementById('pass').value
    var passwordRepeated = document.getElementById('passRe').value

    if (password !== passwordRepeated) {
        renderError('Password must be the same as above.');
    } else {
        clearError()
    }    
}

function renderError(msg) {
    document.getElementById('error-log').innerHTML = msg;
}

function clearError() {
    document.getElementById('error-log').innerHTML = '';
}
</script>