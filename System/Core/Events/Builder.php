<?php

namespace System\Core\Events;

use function system\createIndex;

class Builder
{
    const INDEX_POSITION_APPEND = 1, INDEX_POSITION_PREPEND = 0;

    const TEMPLATE = array(
        'class' => null,
        'enabled' => true,
        'method' => 'execute',
        'callback' => null,
        'arguments' => array(),
    );

    protected $eventName;

    protected $eventType;

    protected $eventsList = array();

    protected $index;

    public function __construct($eventName, $eventType, array &$eventsList)
    {
        $this->eventName = mb_strtolower($eventName);
        $this->eventType = $eventType;
        $this->eventsList = &$eventsList;

        $this->index(0);

        $this->eventsList[$this->eventName][$this->index] = self::TEMPLATE;
    }

    public function handler($className, $method = 'execute', ...$arguments)
    {
        $this->custom('class', $className);
        $this->custom('method', $method);
        return $this->custom('arguments', $arguments);
    }

    public function callback(callable $callback, ...$arguments)
    {
        $this->custom('callback', $callback);
        return $this->custom('arguments', $arguments);
    }

    public function enabled($active)
    {
        return $this->custom('enabled', $active);
    }

    public function custom($key, $value)
    {
        $this->eventsList[$this->eventName][$this->index][$key] = $value;
        return $this;
    }

    public function index(int $index = 0, $position = Builder::INDEX_POSITION_APPEND)
    {
        if(isset($this->eventsList[$this->eventName])){
            $index = createIndex($this->eventsList[$this->eventName], $index, $position);

            if(isset($this->eventsList[$this->eventName][$this->index])){
                $this->eventsList[$this->eventName][$index] = $this->eventsList[$this->eventName][$this->index];
                unset($this->eventsList[$this->eventName][$this->index]);
            }
        }
        $this->index = $index;
        return $this;
    }

    public function get()
    {
        return $this->eventsList[$this->eventName];
    }
}