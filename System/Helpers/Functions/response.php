<?php

namespace response;

use System\Helpers\Classes\Render\Url;

/**
 * @param $controllerActionClassName
 * @param array ...$params
 * @return Url
 */
function url($controllerActionClassName, ...$params)
{
    return new Url($controllerActionClassName, ...$params);
}

function buildQuery(array $query, $decode = true)
{
    $queryString = http_build_query($query);
    $queryString = $queryString ? "?{$queryString}" : '';
    return $decode ? urldecode($queryString) : $queryString;
}

function compressHtml($content)
{
    $content = str_replace(array("\n","\r","\t"), '', $content);
    $content = preg_replace(array('/<!--(.*)-->/Uis',"/[[:blank:]]+/"), array('',' '), $content);
    return $content;
}