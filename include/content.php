<?php

require_once "db_connect.php";


class DBContent{

    //public $blog
    private static $sqlstr = 'select t1.blHeader, t1.blText, t1.blDateAdded, t2.usName, t2.usSurname from tblBlog as t1 left join tblUsers as t2 on t1.blUser = t2.usEmail order by t1.blDateAdded DESC;';
    private static $sqlstrprod = 'select * from tblProdukt where prUser = ';

    public static function GetBlog() {
        global $database;
        
        $tmpblog = $database->table(self::$sqlstr);
        return $tmpblog;
    }

    public static function GetProductsByUser($useremail){
        global $database;
        $tmpstr = self::$sqlstrprod  . '\'' . $useremail . '\';';
        $tmpresult = $database->table($tmpstr);
        echo $tmpstr;
        return $tmpresult;
    }
    
}