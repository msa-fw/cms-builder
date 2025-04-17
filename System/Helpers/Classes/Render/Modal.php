<?php

namespace System\Helpers\Classes\Render;

use function web\render;
use function web\templateRoot;

class Modal
{
    const SIZE_FREE = 0;
    const SIZE_SMALL = 300;
    const SIZE_NORMAL = 800;
    const SIZE_BIG = 1200;
    const SIZE_LARGE = 1600;

    const TEMPLATE = array(
        'id' => null,
        'title' => null,
        'value' => null,
        'content' => null,
        'ajax' => array(),
        'buttons' => array(),
        'class' => 'link-class',
        'size' => self::SIZE_FREE,
        'template' => 'assets/system/modal.html',
    );

    protected $modal;

    public function __construct($linkValue)
    {
        $this->modal = self::TEMPLATE;
        $this->linkValue($linkValue);
        $this->modal['id'] = "modal-" . md5(microtime(true) . uniqid());
    }

    public function id($id)
    {
        return $this->custom('id', $id);
    }

    public function title($title)
    {
        return $this->custom('title', $title);
    }

    public function body($body)
    {
        return $this->custom('content', $body);
    }

    public function size($size = Modal::SIZE_FREE)
    {
        return $this->custom('size', $size);
    }

    public function linkValue($value)
    {
        return $this->custom('value', $value);
    }

    public function linkClass($class = 'link-class')
    {
        return $this->custom('class', $class);
    }

    public function template($file = 'assets/system/modal.html')
    {
        return $this->custom('template', $file);
    }

    public function button(callable $callback = null)
    {
        $button = new Button($this, $this->modal);
        if($callback){
            call_user_func($callback, $button);
            return $this;
        }
        return $button;
    }

    public function ajax(callable $callback = null)
    {
        $ajax = new Ajax($this, $this->modal);
        if($callback){
            call_user_func($callback, $ajax);
            return $this;
        }
        return $ajax;
    }

    public function custom($key, $value)
    {
        $this->modal[$key] = $value;
        return $this;
    }

    public function render()
    {
        $file = templateRoot($this->modal['template']);
        return render($file, $this->modal);
    }
}