<?php

namespace System\Helpers\Classes;

use System\Core\Config;
use function console\isCommandLineInterface;

/**
 * Class Fs
 * @package System\Helpers\Classes
 * @method static|Fs server()
 * @method static|Fs site()
 */
class Fs
{
    protected $root;

    protected $publicDirectory;

    protected $uploadDirectory;

    protected $siteThemeDirectory;

    public static function __callStatic($name, $arguments)
    {
        if(mb_strtolower($name) == 'server'){
            return new self(ROOT);
        }
        return new self('');
    }

    public function __construct($root)
    {
        $this->root = $root;

        $this->publicDirectory = Config::template('publicDirectory')->read('');
        $this->uploadDirectory = Config::template('uploadDirectory')->read('');
        $this->siteThemeDirectory = Config::template('siteTheme')->read('');
    }

    public function root($filePathSuffix)
    {
        $filePathSuffix = trim($filePathSuffix, '/');
        return $this->root . '/' . $filePathSuffix;
    }

    public function controller($filePathSuffix)
    {
        $filePathSuffix = trim($filePathSuffix, '/');
        return $this->root("Controllers/{$filePathSuffix}");
    }

    public function public($filePathSuffix)
    {
        $filePathSuffix = trim($filePathSuffix, '/');
        return $this->root("{$this->publicDirectory}/{$filePathSuffix}");
    }

    public function files($filePathSuffix)
    {
        $filePathSuffix = trim($filePathSuffix, '/');
        return $this->public("{$this->uploadDirectory}/{$filePathSuffix}");
    }

    public function template($filePathSuffix)
    {
        $filePathSuffix = trim($filePathSuffix, '/');
        return $this->public("templates/{$filePathSuffix}");
    }

    public function theme($filePathSuffix)
    {
        $filePathSuffix = trim($filePathSuffix, '/');
        return $this->template("{$this->siteThemeDirectory}/{$filePathSuffix}");
    }

    public function temp($appendSuffixPath = '')
    {
        if($appendSuffixPath){
            $appendSuffixPath = '/' . trim($appendSuffixPath, '/');
        }

        $configTempPathDirKey = "tmpWebDirectory";
        if(isCommandLineInterface() || defined('FAKE_COMMAND_LINE_INTERFACE')){
            $configTempPathDirKey = "tmpDirectory";
        }

        $prefix = Config::general($configTempPathDirKey)->read('/');
        return $this->root($prefix . $appendSuffixPath);
    }
}