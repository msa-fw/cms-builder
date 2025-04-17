<?php

namespace System\Core;

use System\Core\Widget\Hub;
use System\Traits\Autoloader;

/**
 * Class Widget
 * @package System\Core
 * @method static|Hub header($key = null)
 * @method static|Hub top($key = null)
 *
 * @method static|Hub bodyTop($key = null)
 * @method static|Hub body($key = null)
 * @method static|Hub bodyDown($key = null)
 *
 * @method static|Hub bottom($key = null)
 * @method static|Hub footer($key = null)
 *
 * @method static|Hub leftbar($key = null)
 * @method static|Hub rightbar($key = null)
 */
class Widget
{
    use Autoloader;

    protected static $widgets = array();

    public static function __callStatic($name, $arguments)
    {
        $widgetName = null;
        if(isset($arguments[0])){
            $widgetName = $arguments[0];
        }
        return new Hub($name, self::$widgets, $widgetName);
    }

    public function __call($name, $arguments)
    {
        return self::__callStatic($name, $arguments);
    }

    public static function getWidgets()
    {
        return self::$widgets;
    }

    public static function getWidget($key)
    {
        return isset(self::$widgets[$key]) ? self::$widgets[$key] : null;
    }
}














