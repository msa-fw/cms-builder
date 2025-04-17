<?php

namespace System\Core\Console;

use System\Core\Console;
use function system\createIndex;

class Builder
{
    const INDEX_POSITION_APPEND = 1, INDEX_POSITION_PREPEND = 0;

    const TEMPLATE = array(
        'command' => null,
        'action' => null,
        'method' => 'execute',
        'arguments' => array(),
        'pattern' => null,
        'faq' => null,
        'enabled' => true,
        'granted' => array(),
        'denied' => array(),
        'callback' => null,
        'controller' => null,
    );

    protected $index;

    protected $commands = array();

    public function __construct($command, &$commands)
    {
        $command = trim($command);
        $this->commands = &$commands;
        $this->index(0);

        $this->commands[$this->index] = self::TEMPLATE;
        $this->commands[$this->index]['command'] = $command;

    }

    public function controller($controller)
    {
        return $this->custom('controller', $controller);
    }

    public function action($action, $method = 'execute', ...$arguments)
    {
        $this->custom('action', $action);
        $this->custom('method', $method);
        return $this->custom('arguments', $arguments);
    }

    public function pattern($pattern)
    {
        return $this->custom('pattern', $pattern);
    }

    public function faq($description)
    {
        return $this->custom('faq', $description);
    }

    public function enabled($enabled = true)
    {
        return $this->custom('enabled', $enabled);
    }

    public function call(callable $callback, ...$arguments)
    {
        $this->custom('callback', $callback);
        return $this->custom('arguments', $arguments);
    }

    public function custom($key, $value)
    {
        $this->commands[$this->index][$key] = $value;
        return $this;
    }

    public function index(int $index = 0, $position = Builder::INDEX_POSITION_APPEND)
    {
        $index = createIndex($this->commands, $index, $position);

        if(isset($this->commands[$this->index])){
            $this->commands[$index] = $this->commands[$this->index];
            unset($this->commands[$this->index]);
        }
        $this->index = $index;
        return $this;
    }

    public function get()
    {
        return $this->commands[$this->index];
    }
}