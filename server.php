<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define("FAKE_COMMAND_LINE_INTERFACE", true);

$link = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$link = urldecode($link);

if($link !== '/' && file_exists(__DIR__ . "/$link")){
    return false;
}

return include_once __DIR__ . "/web/singleton.php";
