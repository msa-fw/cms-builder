<?php

namespace Controllers\_BaseController_\Widgets;

use Controllers\_BaseController_\Language;

class IndexWidget
{
    protected $widget = array();

    protected $options = array();

    public function __construct(array &$widget)
    {
        $this->widget = &$widget;
        $this->options = $this->widget['options'];
    }

    public function execute($widgetPosition)
    {
        $this->widget['response'] =  array(
            'simple' => 'some widget response data'
        );

        return array(
            'position' => $widgetPosition,
            'description' => Language::_BaseController_('widget.isRemovable')->returnKey(),
        );
    }

    public function debugWidget()
    {
        return true;
    }
}