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

function compressHtml($content)
{
    $content = str_replace(array("\n","\r","\t"), '', $content);
    $content = preg_replace(array('/<!--(.*)-->/Uis',"/[[:blank:]]+/"), array('',' '), $content);
    return $content;
}