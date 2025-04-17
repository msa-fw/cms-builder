<?php

namespace System\Core\Console;

use System\Core\Console;

interface ConsoleInterface
{
    /**
     * @param array $currentRoute
     * @return Console
     */
    public function setCurrentRoute(array $currentRoute);

    /**
     * @param $controllerName
     * @return Console
     */
    public function setControllerName($controllerName);

    /**
     * @param $actionName
     * @return Console
     */
    public function setActionName($actionName);

    /**
     * @return array
     */
    public function getCurrentRoute();

    /**
     * @return mixed
     */
    public function getControllerName();

    /**
     * @return mixed
     */
    public function getActionName();

    /**
     * @param null $key
     * @return mixed
     */
    public function getCurrentRouteParam($key = null);
}