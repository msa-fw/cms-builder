<?php

/**
 * PHP 8.3.17
 * @projectStartDate: 06.03.2025 17:46:10
 */

//opcache_reset();

//ignore_user_abort(false);

define('DEBUG_START_TIME', microtime(true));
define('DEBUG_MEMORY_USAGE', memory_get_usage());
define('DEBUG_MEMORY_USAGE_MAX', memory_get_peak_usage());

define('DB_DEFAULT_CONNECTION', 'db_mysqli_connection_one');

define('ROOT', __DIR__);

define('PUBLIC_DIR', '/' . trim(dirname($_SERVER['PHP_SELF']), './'));

error_reporting(0);
ini_set('display_errors', false);
ini_set('display_startup_errors', false);
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

ini_set('memory_limit', '128M');

date_default_timezone_set('Europe/London'); // +00:00 default.

if(file_exists(ROOT . '/vendor/autoload.php')){
    require_once ROOT . '/vendor/autoload.php';
}

/**
 * Load helpers functions
 */
foreach(glob(ROOT . '/System/Helpers/Functions/*.php') as $php){
    require_once $php;
}

spl_autoload_register('\\system\\classesAutoloader');