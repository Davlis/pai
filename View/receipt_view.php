<?php
    namespace PAI;
    include_once "Model/Receipts.php";
    include_once "Model/Products.php";
    include_once "Model/ProductNames.php";
    use PAI\Model;

    $receipts = new \PAI\Model\Receipts;
    $userreceipts = $receipts -> getReceiptsForUser($_SESSION['userid']);


    //var_dump($usertable);

    echo "<h1>Your Receipts:</h1>";

    foreach($userreceipts as $id){
        $r_str = $receipts -> getName($userid) . ", " . $receipt -> getSum($userid) . "PLN";
        
        echo '<a href="./receipt_view.php?id=' . $id . '">' . $r_str . "</a><br/>";
    }
    echo '<span><button class="input_button" action="./receipt_add.php">Add Receipt</button></span>';
?>