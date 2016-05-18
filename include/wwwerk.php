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

    public function GetByTag($tagstr){
        $d = new DOMDocument;
        $mock = new DOMDocument;
        $d->loadHTML($this->pagestring);
        $body = $d->getElementsByTagName($tagstr)->item(0);
        foreach ($body->childNodes as $child){
            $mock->appendChild($mock->importNode($child, true));
        }
        print_r($mock->saveHTML());
    }

}