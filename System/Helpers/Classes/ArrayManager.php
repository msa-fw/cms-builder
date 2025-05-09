<?php

namespace System\Helpers\Classes;

use System\Helpers\Classes\ArrayManager\_Array;
use System\Helpers\Classes\ArrayManager\_String;

class ArrayManager
{
    const TYPE_BOOL = 'boolean';
    const TYPE_INT = 'integer';
    const TYPE_FLOAT = 'float';
    const TYPE_DOUBLE = 'double';
    const TYPE_STRING = 'string';
    const TYPE_ARRAY = 'array';
    const TYPE_OBJECT = 'object';
    const TYPE_NULL = 'null';

    protected $key;

    protected $subject;

    public function __construct($key, &$subject)
    {
        $this->key = $key;
        $this->subject = &$subject;
    }

    public function key($key)
    {
        return new self($key, $this->subject[$key]);
    }

    public function exists()
    {
        return isset($this->subject);
    }

    public function read($default = null)
    {
        return $this->subject ?: $default;
    }

    public function write($value)
    {
        $this->subject = $value;
        return $this;
    }

    public function delete()
    {
        $this->subject = null;
        return $this;
    }

    public function set(&$variable)
    {
        $variable = $this->subject;
        return $this;
    }

    public function empty()
    {
        return empty($this->subject);
    }

    public function check(&$variableNotEmpty)
    {
        if(!$variableNotEmpty){
            return $this->set($variableNotEmpty);
        }
        return $this;
    }

    /**
     * Return `key`, if vale is empty
     * @return null
     */
    public function returnKey()
    {
        return $this->read($this->key);
    }

    public function string($returnKeyIfEmpty = false)
    {
        if($returnKeyIfEmpty && !$this->subject){
            return new _String($this->key);
        }
        return new _String($this->subject);
    }

    public function array($returnKeyIfEmpty = false)
    {
        if($returnKeyIfEmpty && !$this->subject){
            return new _Array($this->key);
        }
        return new _Array($this->subject);
    }

    public function call(callable $callback, ...$args)
    {
        $this->subject = call_user_func($callback, $this->subject, ...$args);
        return $this;
    }

    public function type($type = ArrayManager::TYPE_STRING)
    {
        settype($this->subject, $type);
        return $this;
    }
}