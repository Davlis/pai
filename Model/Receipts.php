<?php

namespace PAI\Model;
require_once "Config/Db.php";
use PAI\Config;

class Receipts {
    protected $db;

    function __construct(){
        $this->db = new \PAI\Config\Db;
    }

    function getReceiptsForUser($userid) {
        $q = "select * from receipts where userid = $userid";
        return $this -> db -> getColumn($q);
    }

    function insertReceipt($userid, $name=null, $datestamp=null, $shopid = null) {
        $q = "insert into receipts (userid, namefield, datestamp, shopid) values ($userid, $name, $datestamp, $shopid)";
        return $this -> db -> query($q);
    }

    function updateReceipt($receiptid, $name=null, $datestamp=null, $shopid = null) {
        $q = "update receipts set namefield=$name, datestamp=$datestamp, shopid=$shopid where id = $receiptid";
        return $this -> db -> query($q);
    }

    function deleteReceipt($receiptid){
        $q = "delete from products where receiptid = $receiptid;";
        $q = $q . "delete from receipts where id = $receiptid;";
        return $this -> db -> query($q);
    }

    function getName($receiptid){
        $q = "select namefield from receipts where id = $receiptid";
        return $this -> db -> oneResultQuery($q);
    }
    
    function getSum($receiptid){
        $q = "select r_sum from receipts where id = $receiptid";
        return $this -> db -> oneResultQuery($q);
    }
    
    function getDate($receiptid){
        $q = "select datestamp from receipts where id = $receiptid";
        $result = $this -> db -> query($q);
        return pg_fetch_result($result, 0);
    }
}

?>