<?php

namespace System\Core\Response\Builders;

class Breadcrumbs
{
    const TEMPLATE = array(
        'link' => '',
        'title' => '',
        'icon' => '',
    );

    protected $key;

    protected $breadcrumbs;

    public function __construct($key, array &$breadcrumbs)
    {
        $this->key = $key;
        $this->breadcrumbs = &$breadcrumbs;
        $this->breadcrumbs[$this->key] = self::TEMPLATE;
    }

    public function link($value)
    {
        return $this->custom('link', $value);
    }

    public function title($value)
    {
        return $this->custom('title', $value);
    }

    public function icon($value)
    {
        return $this->custom('icon', $value);
    }

    public function custom($key, $value)
    {
        $this->breadcrumbs[$this->key][$key] = $value;
        return $this;
    }
}