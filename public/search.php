<?php
/**
 * Created by PhpStorm.
 * User: stanoja
 * Date: 5/23/16
 * Time: 12:11 PM
 */

require_once 'include/functions.php';
require_once 'include/db_connect.php';
require_once 'include/content.php';
//require_once 'include/user.php';
require_once 'include/wwwerk.php';
require_once 'include/filterwerk.php';


//$database = new PDODatabase();
//print_r($database->single('select * from tblRoles;'));
//printf("\n");
//print_r($database->single('SELECT * FROM tblUsers WHERE usEmail = \'bobansta@gmail.com\';'));

$content = new DBContent();
$result = $content->getUser("bobansta@gmail.com");
if (isset($result)){
    printf("Welcome, %s!", $result);
}
else {
    printf("");
}
//print_r($content->tmpFun());
echo '<hr>';

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



