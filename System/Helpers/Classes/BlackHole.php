<?php

namespace System\Helpers\Classes;

use stdClass;

class BlackHole extends stdClass
{
    public static function __set_state($properties)
    {
        return $properties;
    }

    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    public function __get($name)
    {
        return new self();
    }

    public function __set($name, $value)
    {
        return new self();
    }

    public function __call($name, $arguments)
    {
        return new self();
    }

    public function __clone()
    {
        return new self();
    }

    public function __debugInfo()
    {
        return array();
    }

    public function __invoke()
    {
        return new self();
    }

    public function __isset($name)
    {
        return false;
    }

    public function __sleep()
    {
        return false;
    }

    public function __toString()
    {
        return '';
    }

    public function __unset($name)
    {
        return false;
    }

    public function __wakeup()
    {
        return false;
    }
}