<?php

/**
 * Created by PhpStorm.
 * User: stanoja
 * Date: 5/18/16
 * Time: 12:29 PM
 */
class wwwerk
{
    //private $url = "";
    //private $tag = "";
    private $pagestring = "";
    private $comments;
    public function __construct()
    {
        //$this->tag = $tagstr;
        //$this->curl_download($url);
    }

    public function downloadwww($urlstr){
        // is cURL installed yet?
        if (!function_exists('curl_init')){
            die('Sorry cURL is not installed!');
        }

        // init
        $ch = curl_init();

        // URL
        curl_setopt($ch, CURLOPT_URL, $urlstr);
        // User agent
        curl_setopt($ch, CURLOPT_USERAGENT, "TMention 0.1");
        // Include header in result? (0 = yes, 1 = no)
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // Return = true, print = false
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        // Download the given URL, and return output
        $output = curl_exec($ch);
        // Close the cURL
        curl_close($ch);
        $this->pagestring = $output;

        return $output;
    }

    public function GetComments($tagname, $idvalue){
        $d = new DOMDocument();
        $d->loadHTML($this->pagestring);
        $commparentnode = $d->getElementById($idvalue);
        $commnodes = $this->getElementsByClass($commparentnode, $tagname);
        $arrlen = count($commnodes);
        //print_r($commnodes);

        //for ($i = 0; $i < $arrlen; $i++){
        //    printf("%s <br />", $commnodes[$i]->nodeValue);
        //}
        if (!empty($commnodes))
            $this->$commnodes;
        return $commnodes;
    }

    private function getElementsByClass(&$parentNode, $tagname){
        $nodes = array();
        $childNodeList = $parentNode->getElementsByTagName($tagname);
        for ($i = 0; $i < $childNodeList->length; $i++) {
            $temp = $childNodeList->item($i);
                $nodes[]=$temp;

        }
        return $nodes;
    }

}