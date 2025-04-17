<?php

namespace System\Traits;

use function filesystem\controller;

trait Autoloader
{
    public function loadControllersParams($autoloadFileName)
    {
        $autoloadFileName = trim($autoloadFileName, '/');
        foreach(glob(controller("/*/{$autoloadFileName}")) as $file){
            $this->includeAutoloadFile($file);
        }
        return $this;
    }

    public function includeAutoloadFile($filePath)
    {
        if(is_readable($filePath)){
            return include_once $filePath;
        }
        return null;
    }
}