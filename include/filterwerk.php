<?php

/**
 * Created by PhpStorm.
 * User: stanoja
 * Date: 5/19/16
 * Time: 10:55 AM
 */
class filterwerk
{
    private $words;
    private $productid;
    private $dbrez;

    public function __construct($prid){
        $this->productid=$prid;
        $this->dbrez = new DBResult();
    }

    public function initKeyWords(){
        $dbkw = new DBKeywords();
        $tablekw = $dbkw->readContents($this->productid);
        if (count($tablekw) > 0){
            $this->words = $tablekw;
        }
        //$tmpkw = DBBlog::readContents();
        echo 'keywords: <b>';
        var_dump($tablekw);
        echo '</b> <br />';
    }

    public function CalculatePoints($commstr, $comId, $date){
        $result = array();
        //echo 'commstr:' . $commstr;
        //var_dump($commstr);
        $tmpscore = 0;
        $maxscore = 0;
        $pscore = 0;
        $nscore = 0;

        $str = (string)$commstr;
        echo '<br /><p>';
        var_dump($str);
        echo '</p><br />';
        echo '<br />Pronajdeni zborovi: ';

        foreach ($this->words as $kz){
            if (strpos($str, $kz->kzIzraz) !== false){
                echo $kz->kzIzraz . ' ';
                $this->dbrez->insertContents($comId, $kz->kzId , $date);
            }
        }
        return $result;
    }
}