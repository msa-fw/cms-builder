<?php

namespace System\Core;

use System\Helpers\Classes\Fs;
use System\Traits\Autoloader;
use System\Helpers\Classes\ArrayManager;

/**
 * Class Config
 * @package System\Core
 * @method static|ArrayManager template($key = null)
 * @method static|ArrayManager general($key = null)
 * @method static|ArrayManager database($key = null)
 * @method static|ArrayManager session($key = null)
 * @method static|ArrayManager security($key = null)
 * @method static|ArrayManager cache($key = null)
 */
class Config
{
    use Autoloader;

    protected static $config = array();

    /**
     * Register new configs only from controller children classes
     * @param $key
     * @param $arguments
     * @return ArrayManager
     */
    public static function __callStatic($key, $arguments)
    {
        $arrayManager = new ArrayManager($key, self::$config[$key]);
        if(isset($arguments[0])){
            return $arrayManager->key($arguments[0]);
        }
        return $arrayManager;
    }

    public function __call($key, $arguments)
    {
        return self::__callStatic($key, $arguments);
    }

    public static function getConfigs()
    {
        return self::$config;
    }

    public static function getConfig($key)
    {
        return isset(self::$config[$key]) ? self::$config[$key] : null;
    }

    public function __construct()
    {
    }

    public function initialize()
    {
        $this->includeAutoloadFile(Fs::server()->root("config.php"));
        return $this;
    }
}