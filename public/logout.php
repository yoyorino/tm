<?php
require_once '../include/init.php';

$session->logout();
redirect_to('index.php');
