<?php

namespace System\Core\Widget;

use System\Core\Config;
use System\Core\Debug;

class Launcher
{
    protected $key;

    protected $widgets;

    protected $widgetName = null;

    public function __construct($key, &$widgets, $widgetName = null)
    {
        $this->key = $key;
        $this->widgets = &$widgets;
        $this->widgetName = $widgetName;
    }

    public function runWidgets()
    {
        if(isset($this->widgets[$this->key])){
            ksort($this->widgets[$this->key]);

            foreach($this->widgets[$this->key] as $key => &$widget){
                if($this->widgetName){
                    if($key != $this->widgetName){ continue; }
                }else{
                    if(!is_numeric($key)){ continue; }
                }

                if($success = $this->runWidget($widget)){
                    $widget['result'] = $success;
                }
            }
        }
        return new Render($this->key, $this->widgets, $this->widgetName);
    }

    public function runWidget(array &$widget)
    {
        $debug = Debug::widgets();

        if(isset($widget['result'])){
            return $widget['result'];
        }

        if(!$widget['options']['enabled']){
            return false;
        }

        $config = Config::getConfig($widget['controller']);
        if(!isset($config['enabled']) || !$config['enabled']){
            return false;
        }

        if(!$this->checkWidgetAccess($widget['options'])){
            return false;
        }

        if($widget['callback']){
            return call_user_func($widget['callback'], $widget['arguments']);
        }

        if(class_exists($widget['class'])){
            $widgetObject = new $widget['class']($widget);
            $result = call_user_func_array(array($widgetObject, $widget['method']), $widget['arguments']);

            $debug->end()->query($this->key)
                ->class($widget['class'], $widget['method']);

            return $result;
        }

        return false;
    }

    protected function checkWidgetAccess(array $options)
    {
        $groupAccess = new Access();
        $groupAccess->setDefaultAccessValues(true, false);

        if($options['enabledUserGroups']){
            $groupAccess->setDefaultAccessValues(false, true);
            $groupAccess->checkGroupsAccessGranted($options['enabledUserGroups']);
        }

        if($options['disabledUserGroups']){
            $groupAccess->checkGroupsAccessDenied($options['disabledUserGroups']);
        }


        $pageAccess = new Access();
        $pageAccess->setDefaultAccessValues(true, false);

        if($options['enabledPages']){
            $pageAccess->setDefaultAccessValues(false, true);
            $pageAccess->checkEnabledPagesAccess($options['enabledPages']);
        }
        if($options['disabledPages']){
            $pageAccess->checkDisabledPagesAccess($options['disabledPages']);
        }


        $controllerAccess = new Access();
        $controllerAccess->setDefaultAccessValues(true, false);

        if($options['enabledControllers']){
            $controllerAccess->setDefaultAccessValues(false, true);
            $controllerAccess->checkEnabledControllers($options['enabledControllers']);
        }
        if($options['disabledControllers']){
            $controllerAccess->checkDisabledControllers($options['disabledControllers']);
        }


        $uriAccess = new Access();
        $uriAccess->setDefaultAccessValues(true, false);

        if($options['enabledUrisList']){
            $uriAccess->setDefaultAccessValues(false, true);
            $uriAccess->checkEnabledUrisList($options['enabledUrisList']);
        }
        if($options['disabledUrisList']){
            $uriAccess->checkDisabledUrisList($options['disabledUrisList']);
        }

        return $controllerAccess->granted() && !$controllerAccess->denied() &&
            $groupAccess->granted() && !$groupAccess->denied() &&
            $pageAccess->granted() && !$pageAccess->denied() &&
            $uriAccess->granted() && !$uriAccess->denied();
    }
}