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
//require_once '../include/user.php';
require_once '../include/wwwerk.php';
require_once '../include/filterwerk.php';


echo '<p>Osnovna proba za search: </p><br />';


$dlwww = new wwwerk();
$wwwstr = $dlwww->downloadwww("http://www.gsmarena.com/sony_xperia_z5-reviews-7534.php");
$komentari = $dlwww->GetComments("div", "all-opinions" );

$brkom = count($komentari);
if ($brkom > 0) {
    $fw = new filterwerk();
    for ($i = 0; $i < $brkom; $i++){
        $tmpscore = $fw->CalculatePoints(strtolower($komentari[$i]->nodeValue));
        printf("%s <hr />", $komentari[$i]->nodeValue, $tmpscore[0], $tmpscore[1]);
    }
}
//echo $wwwstr;


//var_dump(User::find_by_email('jovica.spirovski@gmail.com'));



