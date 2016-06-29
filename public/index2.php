<?php

require_once '../include/init.php';
$tmp = User::CheckCodeValid('10000002');
echo $tmp;
User::register('Slobodan','Stanoja' , 'boban@gmail.com' , 'proba123123' , 10000002);
