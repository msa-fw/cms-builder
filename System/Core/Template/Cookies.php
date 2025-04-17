<?php

namespace System\Core\Template;

class Cookies
{
    const TEMPLATE = array(
        'name' => '',
        'value' => '',
        'lifeTime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => false,
        'httpOnly' => false,
    );

    protected $key;

    protected $cookies = array();

    public function __construct($name, $value, array &$cookies)
    {
        $this->key = $name;
        $this->cookies = &$cookies;

        $this->cookies[$this->key] = self::TEMPLATE;

        $this->cookies[$this->key]['name'] = $this->key;
        $this->cookies[$this->key]['value'] = $value;
    }

    public function lifeTime($seconds)
    {
        $seconds = (int)$seconds;
        $this->cookies[$this->key]['lifeTime'] = $seconds;
        return $this;
    }

    public function path($relativePath = '/')
    {
        $this->cookies[$this->key]['path'] = $relativePath;
        return $this;
    }

    public function domain($domain = '')
    {
        $this->cookies[$this->key]['domain'] = $domain;
        return $this;
    }

    public function secure($secure = false)
    {
        $this->cookies[$this->key]['secure'] = $secure;
        return $this;
    }

    public function httpOnly($httpOnly = false)
    {
        $this->cookies[$this->key]['httpOnly'] = $httpOnly;
        return $this;
    }
}