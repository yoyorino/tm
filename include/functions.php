<?php

//spl_autoload_register(function ($class) {
//    include 'classes/' . $class . '.class.php';
//});
function __autoload($class) {
    $class = strtolower($class);
    $path = 'include/' . $class . '.php';
    if (file_exists($path)) {
        require_once "{$path}";
    } else {
        die('The file ' . $path . ' could not be found.');
    }
}

function redirect_to($location = null) {
    if ($location != null) {
        header('Location: ' . $location);
        exit;
    }
}