<?php

namespace System\Core;

use System\Core\Events\Hub;
use System\Traits\Autoloader;

/**
 * Class Events
 * @package System\Core
 * @method static|Hub afterEventsInitialize()
 *
 * @method static|Hub beforeSystemStart()
 * @method static|Hub afterSystemStart()
 *
 * @method static|Hub beforeConfigInitialize()
 * @method static|Hub afterConfigInitialize()
 *
 * @method static|Hub beforeRequestInitialize()
 * @method static|Hub afterRequestInitialize()
 *
 * @method static|Hub beforeSessionStart()
 * @method static|Hub afterSessionStart()
 *
 * @method static|Hub beforeLanguageInitialize()
 * @method static|Hub afterLanguageInitialize()
 *
 * @method static|Hub beforeControllerLoading()
 * @method static|Hub afterControllerLoading()
 *
 * @method static|Hub beforeTemplateInitialize()
 * @method static|Hub afterTemplateInitialize()
 *
 * @method static|Hub beforeTemplateRender()
 * @method static|Hub afterTemplateRender()
 *
 * @method static|Hub beforeCommandLineRunning()
 * @method static|Hub afterCommandLineRunning()
 */
class Events
{
    use Autoloader;

    protected static $events = array();

    /**
     * Register new events only from controller children classes
     * @param $eventName
     * @param $arguments
     * @return Hub
     */
    public static function __callStatic($eventName, $arguments)
    {
        return new Hub($eventName, self::$events);
    }

    public function __call($eventName, $arguments)
    {
        return self::__callStatic($eventName, $arguments);
    }

    public function __construct()
    {
    }

    public static function getEventsList()
    {
        return self::$events;
    }

    public static function getEvent($key)
    {
        return isset(self::$events[$key]) ? self::$events[$key] : null;
    }
}