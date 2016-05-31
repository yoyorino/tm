<?php
// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

/**
 * SITE_ROOT
 */
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'media' . DS . 'sf_sandbox' . DS . 'track_mention');

/**
 * LIB_PATH
 */
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT . DS . 'include');

/**
 * LOG_FILE
 */
defined('LOG_FILE') ? null : define('LOG_FILE', SITE_ROOT . DS . 'logs' . DS . 'log.txt');


// ORDER IS IMPORTANT
require_once LIB_PATH.DS.'db_config.php';     // load config file first

require_once LIB_PATH.DS.'functions.php';  // load basic functions next so that everything after can use them

require_once LIB_PATH.DS.'session.php';    // load core objects
require_once LIB_PATH.DS.'db_connect.php';
require_once LIB_PATH.DS.'db_object.php';

require_once LIB_PATH.DS.'user.php';       // load database-related classes

//klasete moi sto treba da se spoja:

//require_once LIB_PATH.DS.'content.php';
