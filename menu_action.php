<?php
    session_start();
    $_SESSION['action'] = isset($_GET['action']) ? $_GET['action'] : null;
    header("Location: ./index.php");
    exit();
?>