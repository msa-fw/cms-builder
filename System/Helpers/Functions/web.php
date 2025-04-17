<?php

namespace web;

use System\Core\Config;
use System\Core\Router;
use function filesystem\root as filesystemRoot;

/**
 * For files from ROOT./host.name/web dir
 * @param $filePath
 * @return string
 */
function root($filePath)
{
    return filesystemRoot(http($filePath));
}

/**
 * For files from http://host.name/web dir
 * @param $filePath
 * @return string
 */
function http($filePath)
{
    $filePath = trim($filePath, '/');
    $publicDirectory = Config::template('publicDirectory')->read();
    return "/$publicDirectory/$filePath";
}

/**
 * For files from ROOT./host.name/web/files dir
 * @param $path
 * @return string
 */
function fileRoot($path)
{
    return filesystemRoot(fileHttp($path));
}

/**
 * For files from http://host.name/web/files dir
 * @param $path
 * @return string
 */
function fileHttp($path)
{
    $uploadDir = Config::template('uploadDirectory')->read();
    return http("$uploadDir/$path");
}

/**
 * For files from ROOT./host.name/web/templates/[site_theme]/ dir
 * @param $filePath
 * @return string
 */
function templateRoot($filePath)
{
    $filePath = trim($filePath, '/');
    $siteThemeName = Config::template('siteTheme')->read();
    return root("templates/$siteThemeName/$filePath");
}

/**
 * For files from http://host.name/web/templates/[site_theme]/ dir
 * @param $filePath
 * @return string
 */
function templateHttp($filePath)
{
    $filePath = trim($filePath, '/');
    $siteThemeName = Config::template('siteTheme')->read();
    return http("templates/$siteThemeName/$filePath");
}

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