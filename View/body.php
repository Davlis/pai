<body>
    <div id="header">
        <div id="l_space"></div>    
        <div id="logo">
            <img src="Resources/img/logo.png"/>
        </div>
        <div id="header_freespace"></div>
        <div class="login_box">
        
        <?php
            if (isset($_SESSION['userid'])) {
                include "View/welcome.php";
            } else {
                include "View/login.php";
            }
        ?>

        </div>
        <div id="r_space"></div>
    </div>
    <div id="body">
        <div id="l_space"></div>
           
        <?php
            if(isset($_SESSION['userid'])){
                include_once "View/content.php";
            } else {
                include_once "View/register.php";
            }
        ?>

        <div id="r_space"></div>
    </div>
    <div id="debug">
    #debug
    <?php 
        if(isset($_SESSION['debug'])) 
        echo $_SESSION['debug']; 
        $_SESSION['debug'] = "";    
    ?>
    </div>
</body>
</html>