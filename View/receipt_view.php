<?php
    namespace PAI;
    include_once "Model/Receipts.php";
    include_once "Model/Products.php";
    include_once "Model/ProductNames.php";
    use PAI\Model;

    $receipts = new \PAI\Model\Receipts;
    $products = new \PAI\Model\Products;
    $names = new \PAI\Model\ProductNames;

    $receiptid = $_session['receiptid'];
    $producttable = $products -> getProductsForReceipt($receiptid);
?>

<h1>Your Receipts:</h1>






<form action="./product_controller.php" method="post">

    <?php
        foreach($producttable as $productid){
            $r_str = '<span>' . $names -> getName($products -> getNameID($productid)) . ", bought " . $products -> getQuantity($productid)." for " . $products -> getPrice($productid) . " PLN</span>";
            
            $edit = '<span><button type="submit" name="edit" value=' . $id . '>Edit</button></span>';
            $remove = '<span><button type="submit" name="remove" value=' . $id . '>Remove</button></span>';

            echo '<div class="receipt_box">' . $r_str . $remove . $edit . $view . '</div>';

            //echo '<a href="./receipt_controller.php?id=' . $id . '">' . $r_str . "</a><br/>";
        }
    ?>

    <button type="submit" name="add">Add Product</button>
</form>