<?php

namespace System\Core\Cron;

use function system\createIndex;

class Builder
{
    const INDEX_POSITION_APPEND = 1, INDEX_POSITION_PREPEND = 0;

    const TEMPLATE = array(
        'key' => '',
        'faq' => '',
        'index' => 0,
        'class' => '',
        'method' => 'execute',
        'enabled' => true,
        'timeout' => 86400,
        'frequency' => 3600,
        'arguments' => array(),
        'controller' => null,
    );

    protected $index;

    protected $sortType;

    protected $tasks = array();

    public function __construct($key, array &$tasks)
    {
        $this->tasks = &$tasks;
        $this->index(0);

        $this->tasks[$this->index] = self::TEMPLATE;
        $this->tasks[$this->index]['key'] = $key;
    }

    public function controller($controller)
    {
        return $this->custom('controller', $controller);
    }

    public function action($class, $method = 'execute', ...$arguments)
    {
        $this->custom('class', $class);
        $this->custom('arguments', $arguments);
        return $this->custom('method', $method);
    }

    public function enabled($status = true)
    {
        return $this->custom('enabled', $status);
    }

    public function timeout($timeout = 3600)
    {
        return $this->custom('timeout', $timeout);
    }

    public function frequency($time = 86400)
    {
        return $this->custom('frequency', $time);
    }

    public function faq($message)
    {
        return $this->custom('faq', $message);
    }

    public function custom($key, $value)
    {
        $this->tasks[$this->index][$key] = $value;
        return $this;
    }

    public function index(int $index = 0, $position = Builder::INDEX_POSITION_APPEND)
    {
        $index = createIndex($this->tasks, $index, $position);

        if(isset($this->tasks[$this->index])){
            $this->tasks[$index] = $this->tasks[$this->index];
            unset($this->tasks[$this->index]);
        }
        $this->index = $index;
        return $this;
    }

    public function get()
    {
        return $this->tasks[$this->index];
    }
}