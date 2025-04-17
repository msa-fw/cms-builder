<?php

namespace System\Core;

use System\Core\Debug\Tracker;
use System\Core\Debug\ErrorBuilder;

/**
 * Class Debug
 * @package System\Core
 * @method static|Tracker cache()
 * @method static|Tracker events()
 * @method static|Tracker system()
 * @method static|Tracker widgets()
 * @method static|Tracker database()
 */
class Debug
{
    protected static $shutdown = true;

    protected static $debug = array();

    public static function __callStatic($key, $arguments)
    {
        return new Tracker($key, self::$debug);
    }

    public function __call($key, $arguments)
    {
        return self::__callStatic($key, $arguments);
    }

    public static function getDebug($key)
    {
        return isset(self::$debug[$key]) ? self::$debug[$key] : null;
    }

    public static function getDebugs()
    {
        return self::$debug;
    }

    public function __construct()
    {
        set_error_handler("\\System\\Core\\Debug::catchError");
        register_shutdown_function("\\System\\Core\\Debug::catchFatalError");
    }

    public static function catchError($code, $message, $file, $line, $context = null)
    {
        if(self::$shutdown){
            $builder = new ErrorBuilder($message);

            $builder->code($code)
                ->file($file, $line)
                ->context($context)
                ->critical(false)
                ->backtrace(debug_backtrace())
                ->render();
        }

        return true;
    }

    public static function catchFatalError()
    {
        if (@is_array($e = @error_get_last())) {
            $code = isset($e['type']) ? $e['type'] : 0;
            if ($code > 0) {
                $msg = isset($e['message']) ? $e['message'] : '';
                $file = isset($e['file']) ? $e['file'] : '';
                $line = isset($e['line']) ? $e['line'] : '';

                if(self::$shutdown){
                    $builder = new ErrorBuilder($msg);

                    return $builder->code($code)
                        ->file($file, $line)
                        ->backtrace(debug_backtrace())
                        ->render();
                }
            }
        }
        return false;
    }

    public static function throw($message)
    {
        return new ErrorBuilder($message);
    }

    public static function shutdownTrigger($value)
    {
        self::$shutdown = $value;
    }
}