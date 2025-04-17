<?php

namespace System\Core\Router;

use System\Core\Router;

interface RouterGetterInterface
{
    /**
     * @param array $currentRoute
     * @return Router
     */
    public function setCurrentRoute(array $currentRoute);

    /**
     * @param $controllerName
     * @return Router
     */
    public function setControllerName($controllerName);

    /**
     * @param $actionName
     * @return Router
     */
    public function setActionName($actionName);

    /**
     * @return mixed
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