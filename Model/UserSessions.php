<?php

namespace PAI\Model;
require_once "Config/Db.php";
use PAI\Config;

class UserSessions {
    protected $db;

    function __construct(){
        $this->db = new \PAI\Config\Db;
    }

    function start($userid){
        $q = "insert into usersessions (userid) values (" . $userid . ")";
        return $this -> db -> query($q);
    }

    function end($userid){
        $q = "delete from usersessions where userid = " . $userid;
        return $this -> db -> query($q);
    }

    function getUserID($ssid){
        $q = "select userid from usersessions where ssid = '" . $ssid . "'";
        return $this -> db -> oneResultQuery($q);
    }

    function getSSID($userid){
        $q = "select ssid from usersessions where userid = " . $userid;
        return $this -> db -> oneResultQuery($q);
    }
}

?>