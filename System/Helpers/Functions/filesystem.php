<?php

namespace filesystem;

function makeDirectory($directoryPath, $chmod = 0755)
{
    if(!is_dir($directoryPath) && !is_file($directoryPath)){
        return mkdir($directoryPath, $chmod, true);
    }
    return true;
}

function copyFilesRecursive($target, $destination, callable $callback = null, $chmod = 0755)
{
    if(is_dir($target)){
        foreach(scandir($target) as $file){
            if($file == '.' || $file == '..'){ continue; }
            $newTargetPath = "$target/$file";
            $newDestinationPath = "$destination/$file";
            copyFilesRecursive($newTargetPath, $newDestinationPath, $callback, $chmod);
        }
        return true;
    }

    if(!$callback){
        $directory = dirname($destination);
        makeDirectory($directory, $chmod);
        return copy($target, $destination);
    }
    return call_user_func($callback, $target, $destination);
}

function scanDirectoryCallback($path, callable $callback)
{
    if(is_dir($path)){
        foreach(scandir($path) as $file){
            if($file == '.' || $file == '..'){ continue; }
            scanDirectoryCallback("{$path}/{$file}", $callback);
        }
    }
    return call_user_func($callback, $path);
}

function write($filePath, $content)
{
    return file_put_contents($filePath, $content);
}

function read($filePath)
{
    return file_exists($filePath) ? file_get_contents($filePath) : '';
}