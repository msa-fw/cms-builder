<?php

namespace System\Core\Widget;

use function web\render;
use function web\templateRoot;

class Render
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

    public function renderWidgets()
    {
        $result = array();
        if(isset($this->widgets[$this->key])){
            foreach($this->widgets[$this->key] as $key => $widget){
                if(!isset($widget['result'])){ continue; }

                if($this->widgetName){
                    if($key != $this->widgetName){ continue; }
                }else{
                    if(!is_numeric($key)){ continue; }
                }

                if($renderResult = $this->renderWidget($widget)){
                    $result[] = $renderResult;
                }
            }
        }
        return new Result(implode("", $result));
    }

    public function renderWidget(array $widget)
    {
        $widget['keyId'] = $this->key;

        if(!$widget['templateFile']){
            $widget['templateFile'] = str_replace('\\', '/', $widget['class']) . ".html";
        }

        $widget['templateFile'] = templateRoot($widget['templateFile']);

        if(file_exists($widget['templateFile'])){
            if($result = render($widget['templateFile'], $widget)){
                $widget['content'] = $result;
            }
        }

        if(isset($widget['content']) && !empty($widget['content'])){
            $filePath = templateRoot("assets/system/widget.html");
            return render($filePath, $widget);
        }
        return false;
    }

    public function get($key = null)
    {
        if($key){
            if(isset($this->widgets[$this->key][$key])){
                return $this->widgets[$this->key][$key];
            }
            return array();
        }
        if(isset($this->widgets[$this->key])){
            return $this->widgets[$this->key];
        }
        return array();
    }
}