<?php

namespace PAI\Model;
require_once "Config/Db.php";
use PAI\Config;

class Users {
    protected $db;

    function __construct(){
        $this->db = new \PAI\Config\Db;
    }

    function getAllUsers(){
        return $this -> db -> getTable("users");
    }

    function getAllUserID(){
        $q = "select * from users";
        return $this -> db -> getColumn($q);
    }

    function getID($email){
        $q = "select id from users where email = '$email'";
        return $this -> db -> oneResultQuery($q);
    }
    
    function getEmail($id){
        $q = "select email from users where id = $id";
        return $this -> db -> oneResultQuery($q);
    }

    function getName($id){
        $q = "select namefield from users where id = $id";
        return $this -> db -> oneResultQuery($q);
    }

    function getPassword($id){
        $q = "select pass from users where id = $id";
        return $this -> db -> oneResultQuery($q);
    }

    function getPrivilegeID($id){
        $q = "select privilegeid from users where id = $id";
        return $this -> db -> oneResultQuery($q);
    }

    function getActivationCode($id){
        $q = "select activationcode from users where id = $id";
        return $this -> db -> oneResultQuery($q);
    }
    
    function isActive($id){
        $q = "select active::int from users where id = $id";
        $result = $this -> db -> query($q);
        return pg_fetch_result($result, 0);
    }

    function setActive($id){
        $q = "update users set active=true where id = $id";
        return $this -> db -> query($q);
    }

    function insertUser($email, $password, $privilegeid, $name = null){
        if($name){
            $q = "insert into users (email, pass, privilegeid, namefield) values ('$email', '$password', $privilegeid, '$name')";
        } else {
            $q = "insert into users (email, pass, privilegeid) values ('$email', '$password', $privilegeid)";
        }
        return $this -> db -> query($q);
    }

    function deleteUser($userid){
        $q = "delete from users where id = $userid";
        return $this -> db -> query($q);
    }
}

?>