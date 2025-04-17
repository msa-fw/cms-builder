<?php

namespace System\Core\Widget;

use function system\createIndex;

class Builder
{
    const TEMPLATE = array(
        'title' => null,
        'class' => null,
        'method' => null,
        'callback' => null,
        'controller' => null,
        'templateFile' => null,
        'arguments' => array(),

        'options' => array(
            'enabled' => true,
            'showTitle' => true,
            'enabledPages' => array(),
            'disabledPages' => array(),
            'enabledUrisList' => array(),
            'disabledUrisList' => array(),
            'enabledUserGroups' => array(),
            'disabledUserGroups' => array(),
            'enabledControllers' => array(),
            'disabledControllers' => array(),
        ),
    );

    protected $key;

    protected $index = 0;

    protected $widgets = array();

    protected $widgetName = null;

    public function __construct($key, &$widgets, $widgetName = null)
    {
        $this->key = $key;
        $this->widgets = &$widgets;
        $this->widgetName = $widgetName;

        if($this->widgetName){
            $this->widgets[$this->key][$this->widgetName] = self::TEMPLATE;
        }else{
            $this->widgets[$this->key][$this->index] = self::TEMPLATE;
            $this->index(0);
        }
    }

    public function handler($className, $method = 'execute', ...$arguments)
    {
        $this->custom('class', $className);
        $this->custom('arguments', $arguments);

        if($method){
            $this->custom('method', $method);
        }

        return $this->custom('controller', $this->parseControllerName($className));
    }

    protected function parseControllerName($className)
    {
        if(preg_match("#Controllers\\\\(\w+)#usm", $className, $match)){
            return $match[1];
        }
        return $className;
    }

    public function callback(callable $callback, ...$arguments)
    {
        $this->custom('callback', $callback);
        return $this->custom('arguments', $arguments);
    }

    /**
     * Relative path after current theme name
     * Variable `$filePath` must be with file extension
     * Example: `Controllers/[Controller]/Widgets/DebugWidget.html`
     * @param $filePath
     * @return Builder
     */
    public function template($filePath)
    {
        return $this->custom('templateFile', $filePath);
    }

    public function title($title, $showTitle = true)
    {
        $this->custom('title', $title);
        return $this->options('showTitle', $showTitle);
    }

    public function enabled($value = true)
    {
        return $this->options('enabled', $value);
    }

    public function enabledPages(...$pagesList)
    {
        return $this->options('enabledPages', $pagesList);
    }

    public function disabledPages(...$pagesList)
    {
        return $this->options('disabledPages', $pagesList);
    }

    public function enabledUserGroups(...$userGroups)
    {
        return $this->options('enabledUserGroups', $userGroups);
    }

    public function disabledUserGroups(...$userGroups)
    {
        return $this->options('disabledUserGroups', $userGroups);
    }

    public function enabledControllers(...$controllersList)
    {
        foreach($controllersList as &$controller){
            $controller = $this->parseControllerName($controller);
        }
        return $this->options('enabledControllers', $controllersList);
    }

    public function disabledControllers(...$controllersList)
    {
        foreach($controllersList as &$controller){
            $controller = $this->parseControllerName($controller);
        }
        return $this->options('disabledControllers', $controllersList);
    }

    public function enabledUrisList(...$urisList)
    {
        foreach($urisList as &$uri){
            $uri = trim($uri, '/');
        }
        return $this->options('enabledUrisList', $urisList);
    }

    public function disabledUrisList(...$urisList)
    {
        foreach($urisList as &$uri){
            $uri = trim($uri, '/');
        }
        return $this->options('disabledUrisList', $urisList);
    }

    public function custom($key, $value)
    {
        if($this->widgetName){
            $this->widgets[$this->key][$this->widgetName][$key] = $value;
            return $this;
        }
        $this->widgets[$this->key][$this->index][$key] = $value;
        return $this;
    }

    public function options($key, $value)
    {
        if($this->widgetName){
            $this->widgets[$this->key][$this->widgetName]['options'][$key] = $value;
            return $this;
        }
        $this->widgets[$this->key][$this->index]['options'][$key] = $value;
        return $this;
    }

    public function index(int $index = 0)
    {
        $index = createIndex($this->widgets[$this->key], $index, true);

        if(isset($this->widgets[$this->key][$this->index])){
            $this->widgets[$this->key][$index] = $this->widgets[$this->key][$this->index];
            unset($this->widgets[$this->key][$this->index]);
        }
        $this->index = $index;
        return $this;
    }
}