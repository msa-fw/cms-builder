<?php

namespace System;

/**
 * Class Singleton
 * @method static|\System\Core\Access Access()
 * @method static|\System\Core\Config Config()
 * @method static|\System\Core\Console Console()
 * @method static|\System\Core\Controller Controller()
 * @method static|\System\Core\Cron Cron()
 * @method static|\System\Core\Database Database()
 * @method static|\System\Core\Debug Debug()
 * @method static|\System\Core\Events Events()
 * @method static|\System\Core\Form Form()
 * @method static|\System\Core\Language Language()
 * @method static|\System\Core\Model Model()
 * @method static|\System\Core\Request Request()
 * @method static|\System\Core\Response Response()
 * @method static|\System\Core\Router Router()
 * @method static|\System\Core\Session Session()
 * @method static|\System\Core\Template Template($accept)
 * @method static|\System\Core\Widget Widget()
 */
class Singleton
{
    protected static $instances = array();

    public static function __callStatic($name, $arguments)
    {
        $class = "\\System\\Core\\$name";
        return self::get($class, ...$arguments);
    }

    public static function get($class, ...$arguments)
    {
        if(!isset(self::$instances[$class])){
            return self::set($class, new $class(...$arguments));
        }
        return self::$instances[$class];
    }

    public static function kill($class)
    {
        if(isset(self::$instances[$class])){
            unset(self::$instances[$class]);
            return true;
        }
        return false;
    }

    public static function set($class, $object)
    {
        self::$instances[$class] = $object;
        return self::$instances[$class];
    }
}