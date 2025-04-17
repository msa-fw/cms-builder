<?php

namespace System;

use stdClass;

/**
 * Class ObjectManager
 * @package System
 * @method ObjectManager get()
 * @method ObjectManager set($value)
 */
class ObjectManager extends stdClass
{
    private $data;

    public function __call($name, $arguments)
    {
        if(key_exists(0, $arguments)){
            $this->data = $arguments[0];
            return $this;
        }
        return $this->data;
    }

    public function __set($name, $value)
    {
        $this->data[$name] = new self($value);
    }

    public function __get($key)
    {
        if(isset($this->data[$key])){
            return $this->data[$key];
        }

        if(is_array($this->data)){
            $this->data[$key] = new self(null);
            return $this->data[$key];
        }
        return $this;
    }

    public function __construct($data)
    {
        if(is_array($data)){
            foreach($data as $key => $value){
                $this->data[$key] = new self($value);
            }
        }else{
            $this->data = $data;
        }
    }

    public function __destruct()
    {}
}