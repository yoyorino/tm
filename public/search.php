<?php
/**
 * Created by PhpStorm.
 * User: stanoja
 * Date: 5/23/16
 * Time: 12:11 PM
 */

require_once '../include/functions.php';
require_once '../include/db_connect.php';
require_once '../include/content.php';
require_once '../include/wwwerk.php';
require_once '../include/filterwerk.php';

$dlwww = new wwwerk();
$wwwstr = $dlwww->downloadwww("http://www.gsmarena.com/sony_xperia_z5-reviews-7534.php");
$komentari = $dlwww->GetComments("div", "all-opinions" );

$brkom = count($komentari);
$dbComm = new DBComments();

$datum = (new DateTime())->format("Y-m-d h:i:s");

//$data = array();
if ($brkom > 0) {
    $fw = new filterwerk(2);
    $fw->initKeyWords();
    $lastinserted = $database->last_inserted_id();
    for ($i = 0; $i < $brkom; $i++){
        $dbComm->insertContent($komentari[$i]->nodeValue, 2);
        $li = $database->last_inserted_id();
        if ($li !== $lastinserted) {
            $tmpscore = $fw->CalculatePoints(strtolower($komentari[$i]->nodeValue), $li, $datum);
            $tmppoint = array();
            $tmppoint['Broj'] = $i;
            $tmppoint['y'] = $tmpscore[2];
        }
    }
    //var_dump($data);
}
//echo json_encode($data);
//return $data;
?>