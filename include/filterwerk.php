<?php

/**
 * Created by PhpStorm.
 * User: stanoja
 * Date: 5/19/16
 * Time: 10:55 AM
 */
class filterwerk
{
    private $words = array(
        array("great", 5),
        array("bad", -3),
        array("awful", -5),
        array("dying", -5),
        array("very lost", -3),
        array("love", 5),
        array("unhappy", -3),
        array("very bad", -3),
        array("big problem", -5),
        array("slow", -3),
        array("fast", 3),
        array("reliable", 3),
        array("incredible", 5),
        array("crap", -5),
        array("best", 10),
        array("overheat", -1),
        array("rubbish", -5)

    );

    public function _constructor(){
        
    }

    public function CalculatePoints($commstr){
        $result = array();
        $tmpscore = 0;
        $maxscore = 0;
        $pscore = 0;
        $nscore = 0;
        for ($i = 0; $i< count($this->words);$i++) {
            if (strpos($commstr, $this->words[$i][0]) !== false) {
                $tmpscore += $this->words[$i][1];
                if ($this->words[$i][1] > 0)
                    $pscore += $this->words[$i][1];
                else
                    $nscore += $this->words[$i][1];
            }
        }
        $add = abs($nscore);
        $maxscore = $pscore + $add;
        $tmpscore += $add;
        array_push($result, $tmpscore, $maxscore);
        $percent = ($tmpscore/$maxscore)*100;
        $bod = "";
        printf("%d / %d, %d%%<br />", $tmpscore, $maxscore, $percent);
        if ($percent < 40 )
            $bod = "Negative";
        else if ($percent > 60)
            $bod = "Positive";
        else
            $bod = "Neutral";

        if (($tmpscore == 0) && ($maxscore == 0))
            $bod = "Neutral";
        printf(" %s <br />", $bod);
        return $result;
    }
}