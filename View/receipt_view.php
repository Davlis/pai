<?php
    namespace PAI;
    include_once "Model/Receipts.php";
    include_once "Model/Products.php";
    include_once "Model/ProductNames.php";
    use PAI\Model;

    $receipts = new \PAI\Model\Receipts;
    $userreceipts = $receipts -> getReceiptsForUser($_SESSION['userid']);
?>

<h1>Your Receipts:</h1>
<form action="./receipt_controller.php" method="post">

    <?php
        foreach($userreceipts as $id){
            $r_str = '<span>' . $receipts -> getName($id) . ", " . $receipts -> getSum($id) . " PLN</span>";
            
            $view = '<span><button type="submit" name="view" value=' . $id . '>View</button></span>';
            $edit = '<span><button type="submit" name="edit" value=' . $id . '>Edit</button></span>';
            $remove = '<span><button type="submit" name="remove" value=' . $id . '>Remove</button></span>';

            echo '<div class="receipt_box">' . $r_str . $remove . $edit . $view . '</div>';

            //echo '<a href="./receipt_controller.php?id=' . $id . '">' . $r_str . "</a><br/>";
        }
    ?>

    <button type="submit" name="add">Add Receipt</button>
</form>