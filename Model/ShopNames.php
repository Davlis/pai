<?php

namespace PAI\Model;
require_once "Config/Db.php";
use PAI\Config;

class ShopNames {
    protected $db;

    function __construct(){
        $this->db = new \PAI\Config\Db;
    }

    function getID($name){
        $q = "select id from shopnames where shopname = '" . $email . "'";
        return $this -> db -> oneResultQuery($q);
    }

    function add($name){
        $q = $q = "insert into shopnames (shopname) values ('" . $name . "')";
        return $this -> db -> query($q);
    }
}

?>