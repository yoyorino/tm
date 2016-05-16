<?php


require_once "db_connect.php";
//user
//define('key', "value");  // db user

class DBContent{
    //var
    private $database;

    public function __construct() {
        //todo: sve sto treba, momentalno samo baza
        $this->database = new PDODatabase();

    }

    public function getUser($korisnik){
        //$database = new PDODatabase();
        $sql = "SELECT * FROM tblUsers WHERE usEmail = '$korisnik'";
        //echo $sql;
        $result = $this->database->single($sql);
        //echo 'rabota';
        return $result;
    }

    public function tmpFun(){
        $sql = 'select * from tblRoles;';
        print_r($this->database->table($sql));
    }

}
