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

function log_action($action, $message='') {
    $log_string = date('Y-m-d H:i:s') . ' | '. $action . ': ' . $message . PHP_EOL;

    if (file_exists(LOG_FILE)) {
        if (is_writable(LOG_FILE)) {
            file_put_contents(LOG_FILE, $log_string, FILE_APPEND);
        } else {
            echo LOG_FILE . ' is not writable';
        }
    } else {
        file_put_contents(LOG_FILE, $log_string, FILE_APPEND);
    }
}