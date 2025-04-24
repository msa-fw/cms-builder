<?php

namespace console;

use System\Core\Console\Dialog;
use System\Core\Console\Output;
use System\Core\Console\Output\Color;

function isCommandLineInterface()
{
    return PHP_SAPI == 'cli';
}

function paint($message)
{
    return new Color($message);
}

function message($message, $color = 'white', $fon = 'black')
{
    $consoleOutput = new Output($message);
    if($message){
        $consoleOutput->color($color);
        $consoleOutput->fon($fon);
    }
    return $consoleOutput;
}

function warning($message)
{
    return message($message, 'white', 'yellow');
}

function success($message)
{
    return message($message, 'white', 'green');
}

function danger($message)
{
    return message($message, 'white', 'brightRed');
}

function dialog($message, $printHeader = false)
{
    return new Dialog($message, $printHeader);
}