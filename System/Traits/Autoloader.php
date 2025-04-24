<?php

namespace System\Traits;

use System\Helpers\Classes\Fs;

trait Autoloader
{
    public function loadControllersParams($autoloadFileName)
    {
        $autoloadFileName = trim($autoloadFileName, '/');
        foreach(glob(Fs::server()->controller("/*/{$autoloadFileName}")) as $file){
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