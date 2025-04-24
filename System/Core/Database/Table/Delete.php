<?php

namespace System\Core\Database\Table;

use System\Core\Database\Interfaces\DriverInterface;

class Delete extends Expression
{
    public function __construct(DriverInterface $driver)
    {
        parent::__construct($driver);
    }

    public function get()
    {
        return $this->driver->delete($this);
    }

    public function exec(array $bindings = array(), array $bindingTypes = array())
    {
        $query = $this->get();
        $query->bindings($bindings, $bindingTypes);
        return $query->exec();
    }
}