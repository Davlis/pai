<?php

namespace PAI\Model;
require_once "Config/Db.php";
use PAI\Config;

class ProductNames {
    protected $db;

    function __construct(){
        $this->db = new \PAI\Config\Db;
    }

    function getID($name) {
        $q = "select id from productnames where productname = '$name'";
        return $this -> db -> oneResultQuery($q);
    }

    function getName($id){
        $q = "select productname from productnames where id = $id";
        return $this -> db -> oneResultQuery($q);
    }

    function insertProductName($name) {
        $q = "insert into productnames (productname) values ('$name')";
        return $this -> db -> query($q);
    }

    function pullName($name){
        $nameid = $this -> getID($name);
        if(!$nameid){
            $this -> insertProductName($name);
            $nameid = $this -> getID($name);
        }
        return $nameid;
    }
}

?>