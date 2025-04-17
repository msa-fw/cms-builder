<?php

namespace System\Core\Cache;

use function database\toArray;
use function database\toObject;

class Result
{
    protected $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function array()
    {
        return toArray($this->result);
    }

    public function object()
    {
        return toObject($this->result);
    }
}