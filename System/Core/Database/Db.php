<?php

namespace System\Core\Database;

use System\Core\Database\Interfaces\QueryInterface;
use System\Core\Database\Interfaces\DriverInterface;

class Db
{
    protected $database;

    protected $driver;

    public function __construct($database, DriverInterface $driver)
    {
        $this->database = $database;
        $this->driver = $driver;
    }

    /**
     * @param $query
     * @return QueryInterface
     */
    public function query($query)
    {
        return $this->driver->query($query);
    }

    public function showTables()
    {
        return $this->driver->showTables($this->database);
    }

    public function showProperties()
    {
        return $this->driver->showProperties($this->database);
    }

    public function table($table)
    {
        return new Table($this->database, $table, $this->driver);
    }

    public function getDriver()
    {
        return $this->driver;
    }

    public function getDatabase()
    {
        return $this->database;
    }
}