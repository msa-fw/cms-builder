<?php

namespace Controllers\_BaseController_\Events;

use System\Core\Debug;
use Controllers\_BaseController_\Config;
use Controllers\_BaseController_\Events\LoggerDrivers\DriverInterface;

class LoggingErrorsEvent
{
    public function __construct()
    {}

    public function execute()
    {
        if(!Config::general('debug')->read()){
            Debug::shutdownTrigger(false);

            set_error_handler("\\Controllers\\_BaseController_\\Events\\LoggingErrorsEvent::catchError");
            register_shutdown_function("\\Controllers\\_BaseController_\\Events\\LoggingErrorsEvent::catchFatalError");
        }
        return $this;
    }

    public static function catchError($code, $message, $file, $line, $context = null)
    {
        self::logError($code, $message, $file, $line);

        Debug::shutdownTrigger(true);
        return Debug::catchError($code, $message, $file, $line, $context);
    }

    public static function catchFatalError()
    {
        if (@is_array($e = @error_get_last())) {
            $code = isset($e['type']) ? $e['type'] : 0;
            if ($code > 0) {
                $message = isset($e['message']) ? $e['message'] : '';
                $file = isset($e['file']) ? $e['file'] : '';
                $line = isset($e['line']) ? $e['line'] : '';

                self::logError($code, $message, $file, $line);

                Debug::shutdownTrigger(true);
                return Debug::catchFatalError();
            }
        }
        return false;
    }

    public static function logError($code, $message, $file, $line)
    {
        /** @var DriverInterface $loggerDriverObject */

        $loggerDriver = Config::_BaseController_('debugLoggerDriver')->read();
        if(class_exists($loggerDriver)){
            $loggerDriverObject = new $loggerDriver();

            $loggerDriverObject->setError($code, $message, $file, $line);
            $loggerDriverObject->add();

            return true;
        }
        return false;
    }
}