<?php
require_once 'include/functions.php';
require_once 'include/db_connect.php';
require_once 'include/db_content.php';
//require_once 'include/user.php';


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


$junk = new Junk;
var_dump(User::find_by_email('jovica.spirovski@gmail.com'));



