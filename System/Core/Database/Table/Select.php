<?php

namespace System\Core\Database\Table;

use System\Core\Database\Interfaces\DriverInterface;

class Select extends Expression
{
    public function __construct(DriverInterface $driver)
    {
        parent::__construct($driver);
    }

    public function get()
    {
        return $this->driver->select($this);
    }

    public function exec(array $bindings = array(), array $bindingTypes = array())
    {
        $query = $this->get();
        $query->bindings($bindings, $bindingTypes);
        return $query->exec();
    }
}