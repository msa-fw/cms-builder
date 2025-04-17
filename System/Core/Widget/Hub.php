<?php

namespace System\Core\Widget;

class Hub
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

    public function add()
    {
        return new Builder($this->key, $this->widgets, $this->widgetName);
    }

    public function run()
    {
        $launcher = new Launcher($this->key, $this->widgets, $this->widgetName);
        return $launcher->runWidgets();
    }

    public function render()
    {
        return $this->run()
            ->renderWidgets();
    }
}