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