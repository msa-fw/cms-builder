<?php

namespace System\Core\Debug;

use function console\isCommandLineInterface;

class ErrorBuilder
{
    protected $query = array(
        'code' => 0,
        'file' => '',
        'line' => '',
        'class' => '',
        'method' => '',
        'message' => '',
        'context' => '',
        'backtrace' => array(),
        'arguments' => array(),
        'isCritical' => true,
    );

    public function __construct($message)
    {
        $this->query['message'] = trim($message);
    }

    public function file($filePath, $lineNumber)
    {
        $this->query['file'] = $filePath;
        $this->query['line'] = $lineNumber;
        return $this;
    }

    public function code($code = 0)
    {
        $this->query['code'] = $code ?: 0;
        return $this;
    }

    public function context($context)
    {
        $this->query['context'] = $context;
        return $this;
    }

    public function class($class, $method)
    {
        $this->query['class'] = $class;
        $this->query['method'] = $method;
        return $this;
    }

    public function backtrace(array $backtrace)
    {
        if(count($backtrace) > 1){
//            unset($backtrace[0]);
        }
        $backtrace = array_values($backtrace);
//        $this->query['backtrace'] = array_reverse($backtrace);
        $this->query['backtrace'] = $backtrace;
        return $this;
    }

    public function critical($isCritical = true)
    {
        $this->query['isCritical'] = $isCritical;
        return $this;
    }

    public function arguments(...$arguments)
    {
        $this->query['arguments'] = $arguments;
        return $this;
    }

    public function render()
    {
        if(isCommandLineInterface()){
            $object = new Cli($this->query);
//            $object->renderErrorMessageHeader();
        }else{
            $object = new Html($this->query);
        }
        $object->render();
        return true;
    }

    public function get()
    {
        return $this->query;
    }
}