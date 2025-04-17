<?php

namespace System\Core\Database\Table;

use System\Core\Database\Interfaces\DriverInterface;
use System\Core\Database\Table\Interfaces\UpdateGetterInterface;

class Update extends Expression implements UpdateGetterInterface
{
    protected $values = array();

    public function __construct(DriverInterface $driver)
    {
        parent::__construct($driver);
    }

    public function get()
    {
        return $this->driver->update($this);
    }

    public function exec(array $bindings = array())
    {
        $query = $this->get();
        $query->bindings($bindings);
        return $query->exec();
    }

    public function values(array $values)
    {
        $this->values = $values;
        return $this;
    }

    public function getValues()
    {
        return $this->values;
    }
}