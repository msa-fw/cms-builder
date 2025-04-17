<?php

namespace Controllers\_Controller_\Widgets;

use Controllers\_Controller_\Language;

class _Action_Widget
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
            'description' => Language::_Controller_('widget.isRemovable')->returnKey(),
        );
    }
}