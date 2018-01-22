<?php

namespace PAI\Model;
require_once "Config/Db.php";
use PAI\Config;

class UserPrivileges {
    protected $db;

    function __construct(){
        $this->db = new \PAI\Config\Db;
    }

    function getAdminID() {
        $q = "select id from userprivileges where privilegename = 'Admin'";
        return $this -> db -> oneResultQuery($q);
    }

    function getUserID() {
        $q = "select id from userprivileges where privilegename = 'User'";
        return $this -> db -> oneResultQuery($q);
    }
}

?>