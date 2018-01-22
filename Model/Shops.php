<?php

namespace PAI\Model;
require_once "Config/Db.php";
require_once "Model/ShopNames.php";
use PAI\Config;
use PAI\Model;

class Users {
    protected $db;
    protected $shopnames;

    function __construct(){
        $this->db = new \PAI\Db;
        $this->shopnames = new \PAI\Model\ShopNames;
    }

    function getID($shopname){
        $shopnameid = $this -> shopnames -> getID($shopname);
        if(!$shopnameid){
            return null;
        }
        $q = "select id from shops where shopnameid = " . $shopnameid;
        return $this -> db -> oneResultQuery($q);
    }

    function getShopNameID($id){
        $q = "select shopnameid from shops where id = " . $id . "";
        return $this -> db -> oneResultQuery($q);
    }

    
}

?>