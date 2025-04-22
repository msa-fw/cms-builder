<?php

namespace Controllers\_BaseController_\Events\LoggerDrivers;

interface DriverInterface
{
    /**
     * @param $code
     * @param $message
     * @param $file
     * @param $line
     * @return DriverInterface
     */
    public function setError($code, $message, $file, $line);
    
    public function add();
}