<?php

namespace web;

use System\Core\Config;

/**
 * Render data to HTML document
 * @param $filePath
 * @param array $data
 * @return string
 */
function render($filePath, $data)
{
    ob_start();
    extract($data);
    include $filePath;
    return trim(ob_get_clean());
}

/**
 * @param $jsFile
 * @param array $arguments
 * @return string
 */
function renderScript($jsFile, array $arguments = array())
{
    $arguments['type'] = 'text/javascript';
    $arguments['src'] = "{$jsFile}.js";

    if(Config::general('debug')->read()){
        $arguments['src'] = $arguments['src'] . "?" . time();
    }

    $args = array();
    foreach($arguments as $key => $value){
        $args[] = "$key=\"$value\"";
    }
    $args = implode(' ', $args);
    return "<script $args ></script>\n";
}

/**
 * @param $cssFile
 * @param array $arguments
 * @return string
 */
function renderStyle($cssFile, array $arguments = array())
{
    $arguments['type'] = "text/css";
    $arguments['rel'] = "stylesheet";
    $arguments['href'] = "{$cssFile}.css";

    if(Config::general('debug')->read()){
        $arguments['href'] = $arguments['href'] . "?" . time();
    }

    $args = array();
    foreach($arguments as $key => $value){
        $args[] = "$key=\"$value\"";
    }
    $args = implode(' ', $args);
    return "<link $args />\n";
}