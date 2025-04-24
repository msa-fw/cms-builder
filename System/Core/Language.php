<?php

namespace System\Core;

use System\Helpers\Classes\ArrayManager;
use System\Traits\Autoloader;

/**
 * Class Language
 * @package System\Core
 * @method static|ArrayManager System($key = null)
 */
class Language
{
    use Autoloader;

    protected static $languages = array();

    /**
     * Register new language keys only from controller children classes
     * @param $key
     * @param $arguments
     * @return ArrayManager
     */
    public static function __callStatic($key, $arguments)
    {
        $arrayManager = new ArrayManager($key, self::$languages[$key]);
        if(isset($arguments[0])){
            return $arrayManager->key($arguments[0]);
        }
        return $arrayManager;
    }

    public function __call($key, $arguments)
    {
        return self::__callStatic($key, $arguments);
    }

    public static function getLanguages()
    {
        return self::$languages;
    }

    public static function getLanguage($key)
    {
        return isset(self::$languages[$key]) ? self::$languages[$key] : null;
    }

    public function __construct()
    {
    }
}