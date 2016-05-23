<?php

require_once "db_connect.php";


class DBContent{

    //public $blog
    private static $sqlstr = 'select t1.blHeader, t1.blText, t1.blDateAdded, t2.usName, t2.usSurname from tblBlog as t1 left join tblUsers as t2 on t1.blUser = t2.usEmail order by t1.blDateAdded DESC;';
    private static $sqlstr2 = '';

    public static function GetBlog() {
        global $database;
        
        $tmpblog = $database->table(self::$sqlstr);
        return $tmpblog;
    }

    public static function GetProductsByUser($useremail){
        global $database;

        $tmpresult = $database->table(self::$sqlstr2);
        return $tmpresult;
    }
}