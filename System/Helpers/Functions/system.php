<?php

namespace system;

function classesAutoloader($className)
{
    $classPath = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    $classPath = trim($classPath, DIRECTORY_SEPARATOR);
    $classFilePath = ROOT . "/$classPath.php";

    if(file_exists($classFilePath)){
        return include_once $classFilePath;
    }
    return null;
}

function createIndex(array $input, $index, $append = true)
{
    if(isset($input[$index])){
        $newIndex = $append ? $index+1 : $index-1;
        return createIndex($input, $newIndex, $append);
    }
    return $index;
}