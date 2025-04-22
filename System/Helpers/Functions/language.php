<?php

namespace language;

use System\Core\Language;

function translate($key, $replace = array())
{
    $tmp = explode('.', $key, 2);
    if(isset($tmp[1])){
        $controller  = $tmp[0];
        $keyString  = $tmp[1];

        if($value = Language::$controller($keyString)->read()){
            if($replace){
                $keys = array_keys($replace);
                $values = array_values($replace);
                return str_replace($keys, $values, $value);
            }
            return $value;
        }
    }
    return $key;
}