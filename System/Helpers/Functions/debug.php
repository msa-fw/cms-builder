<?php

use function console\isCommandLineInterface;

function pre($var, ...$_)
{
    $header = "<pre>";
    $footer = "</pre>";
    $limiter = "<hr>";

    if(isCommandLineInterface()){
        $header = str_repeat("=", 50) . PHP_EOL;
        $footer = str_repeat("=", 50) . PHP_EOL;
        $limiter = PHP_EOL .str_repeat("-", 50) . PHP_EOL;
    }

    print $header;
    foreach(func_get_args() as $arg){
        print_r($arg);
        print $limiter;
    }
    print $footer;
}

function pred($var, ...$_)
{
    $args = func_get_args();
    pre(...$args);
    exit;
}