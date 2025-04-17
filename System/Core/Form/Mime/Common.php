<?php

namespace System\Core\Form\Mime;

class Common
{
    protected $mime;

    protected $collection;

    protected $availableTypes = array();

    public function __call($name, $arguments)
    {
        $name = mb_strtolower($name);
        if(isset($this->availableTypes[$name])){
            $this->set($this->availableTypes[$name]);
        }
        return $this;
    }

    public function __construct($mime, &$collection)
    {
        $this->mime = $mime;
        $this->collection = &$collection;

        $this->collection[$this->mime] = array();
    }

    public function set($type)
    {
        $this->collection[$this->mime][] = $type;
        return $this;
    }
}