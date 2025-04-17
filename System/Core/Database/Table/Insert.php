<?php

namespace System\Core\Database\Table;

use System\Core\Database\Interfaces\DriverInterface;
use System\Core\Database\Table\Interfaces\InsertInterface;
use System\Core\Database\Table\Interfaces\InsertGetterInterface;
use System\Core\Database\Table\Interfaces\InsertNestedInterface;

class Insert implements InsertInterface, InsertNestedInterface, InsertGetterInterface
{
    protected $table;
    protected $database;
    protected $insert = array();
    protected $update = array();
    /** @var DriverInterface  */
    protected $driver;

    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    public function database($database)
    {
        $this->database = $database;
        return $this;
    }

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @param array $insert
     * @return $this
     */
    public function insert($insert)
    {
        if(is_callable($insert)){
            $selfInsertObject = new self($this->driver);
            call_user_func($insert, $selfInsertObject);
            $insert = $selfInsertObject;
        }
        $this->insert[] = $insert;
        return $this;
    }

    public function update(array $update)
    {
        $this->update = $update;
        return $this;
    }

    public function get()
    {
        return $this->driver->insert($this);
    }

    public function exec(array $bindings = array())
    {
        $query = $this->get();
        $query->bindings($bindings);
        return $query->exec();
    }

    public function getDatabase()
    {
        return $this->database;
    }

    public function getTable()
    {
        return $this->table;
    }

    public function getInsert()
    {
        return $this->insert;
    }

    public function getUpdate()
    {
        return $this->update;
    }
}