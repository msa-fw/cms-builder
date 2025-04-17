<?php

namespace System\Core\Widget;

use System\Core\Access as BaseAccess;

class Access extends BaseAccess
{
    public function checkDisabledPagesAccess(array $disabledPages)
    {
        foreach($disabledPages as $action){
            if(isset(self::$currentRouter['action']) && self::$currentRouter['action'] == $action){
                $this->granted = false;
                $this->denied = true;
            }
        }
        return $this;
    }

    public function checkEnabledPagesAccess(array $enabledPages)
    {
        foreach($enabledPages as $action){
            if(isset(self::$currentRouter['action']) && self::$currentRouter['action'] == $action){
                $this->granted = true;
                $this->denied = false;
            }
        }
        return $this;
    }

    public function checkDisabledControllers(array $disabledController)
    {
        foreach($disabledController as $controller){
            if(isset(self::$currentRouter['controller']) && self::$currentRouter['controller'] == $controller){
                $this->granted = false;
                $this->denied = true;
            }
        }
        return $this;
    }

    public function checkEnabledControllers(array $enabledController)
    {
        foreach($enabledController as $controller){
            if(isset(self::$currentRouter['controller']) && self::$currentRouter['controller'] == $controller){
                $this->granted = true;
                $this->denied = false;
            }
        }
        return $this;
    }

    public function checkDisabledUrisList(array $disabledUriList)
    {
        foreach($disabledUriList as $uri){
            if(isset(self::$currentRouter['uri']) && preg_match("#{$uri}#usim", self::$currentRouter['uri'])){
                $this->granted = false;
                $this->denied = true;
            }
        }
        return $this;
    }

    public function checkEnabledUrisList(array $enabledUriList)
    {
        foreach($enabledUriList as $uri){
            if(isset(self::$currentRouter['uri']) && preg_match("#{$uri}#usim", self::$currentRouter['uri'])){
                $this->granted = true;
                $this->denied = false;
            }
        }
        return $this;
    }
}