<div id="content" class="menu_grid">
    <div id="menu">

    <?php
        echo '<div class="menu_box"><a href="./menu_action.php?action=receipt_view">Receipts</a></div>';
        //echo '<div class="menu_box"><a href="./menu_action.php?action=receipt_add">Add Receipt</a></div>';    

        if($_SESSION['isAdmin']){
            echo '<div id="last_box" class="menu_box"><a href="./menu_action.php?action=delete_users">Delete Users</a></div>';
        }
    ?>

    </div>
    <div id="script">
        
    <?php 
        if(isset($_SESSION['bodyErr'])) { 
            echo '<div class="error">' . $_SESSION['bodyErr'] . "</div>"; 
            $_SESSION['bodyErr'] = null; 
        } 
        
        if(isset($_SESSION['action'])){
            $script = "View/" . $_SESSION['action'] . ".php";
            include $script;
        }
    ?>

    </div>
</div>