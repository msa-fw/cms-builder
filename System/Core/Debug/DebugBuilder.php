<?php

namespace System\Core\Debug;

use function system\createIndex;

class DebugBuilder
{
    const TEMPLATE = array(
        'file' => '',
        'line' => '',
        'query' => '',
        'class' => '',
        'method' => '',
        'context' => '',
        'startTime' => '',
        'endTime' => '',
        'backtrace' => array(),
        'arguments' => array(),
    );

    protected $key;

    protected $index;

    protected $scope = array();

    public function __construct($key, array &$scope)
    {
        $this->key = $key;
        $this->scope = &$scope;

        $index = 0;
        if(isset($this->scope[$this->key])){
            $index = createIndex($this->scope[$this->key], $index);
        }
        $this->index = $index;

        $this->scope[$this->key][$this->index] = self::TEMPLATE;
    }

    public function query($query)
    {
        $this->scope[$this->key][$this->index]['query'] = $query;
        return $this;
    }

    public function time($startTime, $endTime)
    {
        $this->scope[$this->key][$this->index]['startTime'] = $startTime;
        $this->scope[$this->key][$this->index]['endTime'] = $endTime;
        return $this;
    }

    public function startTime($startTime)
    {
        $this->scope[$this->key][$this->index]['startTime'] = $startTime;
        return $this;
    }

    public function endTime($endTime)
    {
        $this->scope[$this->key][$this->index]['endTime'] = $endTime;
        return $this;
    }

    public function file($filePath, $lineNumber)
    {
        $this->scope[$this->key][$this->index]['file'] = $filePath;
        $this->scope[$this->key][$this->index]['line'] = $lineNumber;
        return $this;
    }

    public function class($class, $method)
    {
        $this->scope[$this->key][$this->index]['class'] = $class;
        $this->scope[$this->key][$this->index]['method'] = $method;
        return $this;
    }

    public function backtrace(array $backtrace)
    {
        if(count($backtrace) > 1){
            unset($backtrace[0]);
            $backtrace = array_values($backtrace);
            $this->scope[$this->key][$this->index]['backtrace'] = array_reverse($backtrace);
        }
        return $this;
    }

    public function arguments(array $arguments)
    {
        $this->scope[$this->key][$this->index]['arguments'] = $arguments;
        return $this;
    }

    public function get()
    {
        return $this->scope[$this->key][$this->index];
    }
}