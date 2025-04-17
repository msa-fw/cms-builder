<?php

namespace System\Core\Database\Statics;

use System\Core\Database\Interfaces\DataTypeInterface;
use function database\toArray;
use function database\toObject;

class DataType implements DataTypeInterface
{
    protected $result;

    public function __construct(array $result)
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