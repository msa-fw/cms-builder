<?php

namespace System\Core\Router;

class Encapsulation
{
    private $controllerName;

    private $actionName = 'Index';

    private $methodName = '';

    private $currentRoute = array();

    private $actionInstance;

    public function setCurrentRoute(array $currentRoute)
    {
        $this->currentRoute = $currentRoute;
        return $this;
    }

    public function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;
        return $this;
    }

    public function setActionName($actionName)
    {
        $this->actionName = $actionName;
        return $this;
    }

    public function setMethodName($methodName)
    {
        $this->methodName = $methodName;
        return $this;
    }

    public function setActionInstance($actionObject)
    {
        $this->actionInstance = $actionObject;
        return $this;
    }

    public function getCurrentRoute()
    {
        return $this->currentRoute;
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function getActionName()
    {
        return $this->actionName;
    }

    public function getMethodName()
    {
        return $this->methodName;
    }

    public function getCurrentRouteParam($key = null)
    {
        if(isset($this->currentRoute[$key])){
            return $this->currentRoute[$key];
        }
        return null;
    }

    public function getActionInstance()
    {
        return $this->actionInstance;
    }
}