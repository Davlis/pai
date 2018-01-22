<?php

namespace PAI\Config;

class Db {
    static $host, $port, $user, $password, $dbname, $connection;

    function __construct($host='localhost', $port='5432', $user='postgres', $password='postgres', $dbname='pai'){
        self::$host=$host;
        self::$user=$user;
        self::$port=$port;
        self::$password=$password;
        self::$dbname=$dbname;
        self::$connection=self::__connect();
    }

    function __destruct(){
        //$this -> disconnect();
    }

    function __connect(){
        $connection = pg_pconnect('host= ' . self::$host . ' port=' . self::$port . ' dbname=' . self::$dbname . ' user=' . self::$user . ' password=' . self::$password );
        if($connection){
            return $connection;
        }else{
            return die('Connection error!');
        }
    }

    function connect(){
        return self::$connection;
    }

    function disconnect(){
        pg_close(self::$connection);
    }

    function query($q=""){
        return pg_query($this->connect(), $q);
    }

    function oneResultQuery($q=""){
        $result = $this -> query($q);
        $return = pg_fetch_result($result, 0);
        if($return){
            return $return;
        } else {
            return null;
        }
    }

    function getTable($tablename){
        return pg_copy_to($this -> connect(), $tablename);
    }

    function getArray($q="", $row=null){
        return pg_fetch_array($this -> query($q));
    }
    
    function getColumn($q="", $column=0){
        return pg_fetch_all_columns($this -> query($q), $column);
    }
}

?>