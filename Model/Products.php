<?php

namespace PAI\Model;
require_once "Config/Db.php";
use PAI\Config;

class Products {
    protected $db;

    function __construct(){
        $this->db = new \PAI\Db;
    }

    function getProductsForReceipt($receiptid) {
        $q = "select * from products where receiptid = $receiptid";
        return $this -> db -> getColumn($q);
    }

    function insertProducts($prodnameid, $receiptid, $quantity, $price) {
        $q = "insert into products (productnameid, receiptid, quantity, price) values ($prodnameid, $receiptid, $quantity, $price)";
        return $this -> db -> query($q);
    }

    function updateProduct($id, $nameid, $quantity, $price) {
        $q = "update products set productnameid=$nameid, quantity=$quantity, price=$price where id = $id";
        return $this -> db -> query($q);
    }

    function deleteProduct($id){
        $q = "delete from products where id = $id;";
        return $this -> db -> query($q);
    }

    function getNameID($id){
        $q = "select productnameid from products where id = $id";
        return $this -> db -> oneResultQuery($q);
    }
    
    function getReceiptID($id){
        $q = "select receiptid from products where id = $id";
        return $this -> db -> oneResultQuery($q);
    }
    
    function getQuantity($id){
        $q = "select quantity from products where id = $id";
        return $this -> db -> oneResultQuery($q);
    }

    function getPrice($id){
        $q = "select price from products where id = $id";
        return $this -> db -> oneResultQuery($q);
    }
}

?>