<?php

namespace System\Core\Database;

use System\Core\Database\Interfaces\DriverInterface;
use System\Core\Database\Interfaces\QueryInterface;
use System\Core\Database\Interfaces\ResultInterface;

class Driver
{
    protected $connection;

    protected $driver;

    public function __construct($connection, DriverInterface $driver)
    {
        $this->connection = $connection;
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

    /**
     * @param string $value
     * @return string
     */
    public function quote($value)
    {
        return $this->driver->quote($value);
    }

    /**
     * @return ResultInterface
     */
    public function showDatabases()
    {
        return $this->driver->showDatabases();
    }

    /**
     * @return ResultInterface
     */
    public function showProcessList()
    {
        return $this->driver->showProcessList();
    }

    /**
     * @param null $database
     * @param null $charset
     * @param null $collate
     * @return ResultInterface
     */
    public function create($database = null, $charset = null, $collate = null)
    {
        return $this->driver->createDatabase($database, $charset, $collate);
    }

    /**
     * @param null $database
     * @return ResultInterface
     */
    public function delete($database = null)
    {
        return $this->driver->deleteDatabase($database);
    }

    public function rename($database, $newName, $charset, $collate)
    {
        return $this->driver->renameDatabase($database, $newName, $charset, $collate);
    }

    public function exist($databaseName)
    {
        foreach($this->showDatabases()->all()->array() as $databases){
            foreach($databases as $database){
                if($database == $databaseName){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param null $database
     * @return Db
     */
    public function database($database = null)
    {
        $database = $this->driver->getConfig('base', $database);
        $this->driver->open($database);
        return new Db($database, $this->driver);
    }

    public function getDriver()
    {
        return $this->driver;
    }
}