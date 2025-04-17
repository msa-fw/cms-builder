<?php

namespace System\Core\Widget;

class Result
{
    protected $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    /**
     * @param Result $variable
     * @return Result $variable
     */
    public function set(&$variable)
    {
        $variable = $this;
        return $this;
    }

    public function exist()
    {
        return !empty($this->result);
    }

    public function get()
    {
        return $this->result;
    }

    public function print()
    {
        print $this->result;
    }
}