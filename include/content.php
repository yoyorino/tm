<?php

require_once '../include/db_connect.php';

class DBContent{

    public function GetBlog() {
        $dbblog = new DBBlog();
        return  $dbblog->readContents();
    }

    public function GetProductsByUser($useremail){
        global $database;
        $tmpstr = self::$sqlstrprod  . '\'' . $useremail . '\';';
        $tmpresult = $database->table($tmpstr);
        echo $tmpstr;
        return $tmpresult;
    }
}
class DBBlog extends DBItem{
    private static $readstr = 'select t1.blHeader, t1.blText, t1.blDateAdded, t2.usName, t2.usSurname from tblBlog as t1 left join tblUsers as t2 on t1.blUser = t2.usEmail order by t1.blDateAdded DESC;';


    public function readContent()
    {
        return parent::readContents(self::$readstr, null);
    }
}

class DBKeywords extends DBItem{
    private static $readstr = 'select kzId, kzIzraz, kzPoeni from tblKZborovi where kzProduktID = :kzproduktid ;';
    //private static $readstr = 'select * from tblUsers';

    public function readContent($product)
    {
        $tmp = ['kzproduktid' => $product];
        var_dump($tmp);
        return parent::readContents(self::$readstr, $tmp);
    }
}

class DBLinks extends DBItem{
    protected static $readstr = 'select linkURL, linkClassName, linkIDValue from tblLinks where linkProdukt = :linkProdukt ;';

    public function readContent($product)
    {
        $tmp = ['linkProdukt' => $product];
        return parent::readContents(self::$readstr, $tmp); // TODO: Change the autogenerated stub
    }
}

class DBProducts extends DBItem{
    protected static $readstr = 'select prId, prIme from tmention.tblProdukt where prUser = :prUser;';

    public function readContent($user)
    {
        $tmp = ['prUser' => $user];
        return parent::readContents(self::$readstr, $tmp); // TODO: Change the autogenerated stub
    }
}

class DBComments extends DBItem{
    protected static $readstr = 'select komId, komText from tblKomentari where komLink = :komLink;';
    protected static $insertstr = 'INSERT INTO `tblKomentari`(`komText`, `komLink`) VALUES (:komText, :komLink);';
    public function readContent($linkid)
    {
        $tmp = ['komLink' => $linkid];
        return parent::readContents(self::$readstr, $tmp); // TODO: Change the autogenerated stub
    }

    public function insertContent($text, $linkid){
        //$sql = self::$insertstr . '(\'' . $text . '\' , ' . $linkid . ');';
        $tmp = ['komText' => $text, 'komLink' => $linkid];
        //var_dump($tmp);
        if (!is_null($tmp['komText'])){
            parent::insertContents(self::$insertstr,$tmp);
            return true;
        }
        return false;
    }
}
class DBResult extends DBItem{
    protected static $readstr = '';
    protected static $insertstr = 'INSERT INTO `tblRezultati`(`rezKomid`, `rezKZid`, `rezDateTime`) VALUES (:rezKomid,:rezKZid,:rezDateTime)';

    public function insertContent($komId, $kzId, $datum)
    {
        $tmp = ['rezKomid' => $komId, 'rezKZid' => $kzId, 'rezDateTime' => $datum];
        echo '<br />tmp rezultat: ';
        var_dump($tmp);
        echo '<br />';
        parent::insertContents(self::$insertstr, $tmp); // TODO: Change the autogenerated stub

    }

}
class DBItem{


    public function readContents($sql, $param1){
        return $this->retquery($sql, $param1);
    }

    public function insertContents($sql, $param1){
        $this->query($sql, $param1);
    }
    private function retquery($sql, $param1){
        global $database;
        $result = $database->query($sql,$param1);

        return $result;
    }
    private function query($sql, $param1){
        global $database;

        $database->query($sql, $param1);
    }

}