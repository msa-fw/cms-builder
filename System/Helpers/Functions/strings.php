<?php

namespace strings;

function generate($length = 128, ...$arguments)
{
    if(!$arguments){
        $arguments = array(range(0, 9), range('a', 'z'), range('A', 'Z'));
    }

    $symbols = array_merge(...$arguments);
    $gen = '';
    for ($i = 0; $i < $length; $i++) {
        $gen .= $symbols[rand(0, count($symbols)-1)];
    }
    return $gen;
}