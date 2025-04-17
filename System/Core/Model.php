<?php

namespace System\Core;

use System\Core\Cache\Result;
use System\Core\Database\Table;
use System\Core\Database\Driver;
use System\Core\Database\Interfaces\QueryInterface;
use System\Core\Database\Interfaces\DataTypeInterface;

/**
 * Class Model
 * @package System\Core
 * @method static|Driver query($query)
 * @method static|Driver showTables()
 * @method static|Driver showProperties()
 * @method static|Table table($table)
 * @method static|Driver getDriver()
 * @method static|Driver getDatabase()
 */
class Model
{
    protected static $staticName = '';

    protected $tableName = '';
    /**
     * @var Database\Driver
     */
    protected $connection;
    /**
     * @var Database
     */
    protected $database;
    /**
     * @var Database\Table
     */
    protected $table;
    /**
     * @var Cache
     */
    protected $cache;

    protected $cacheKeyPath = '';

    public static function __callStatic($name, $arguments)
    {
        $model = new static();
        return $model->database->table($name);
    }

    public function __call($name, $arguments)
    {
        return $this->database->table($name);
    }

    public function __get($name)
    {
        return $this->database->table($name);
    }

    public function __toString()
    {
        return $this->tableName;
    }

    public function __construct()
    {
        $this->cache = new Cache();
        $this->cache->path($this->cacheKeyPath);

        $this->connection = Database::connect();
        $this->database = $this->connection->database();
        $this->table = $this->database->table($this->tableName);
    }

    public function getConnectionInstance()
    {
        return $this->connection;
    }

    public function getDatabaseInstance()
    {
        return $this->database;
    }

    public function getTableInstance()
    {
        return $this->table;
    }

    /**
     * @param QueryInterface $query
     * @return Result|DataTypeInterface
     */
    protected function findManyInCache(QueryInterface $query)
    {
        $this->setCacheParamsFromQuery($query);

        if($this->cache->read()){
            $cacheResult = $this->cache->result();
            return $cacheResult;
        }

        $databaseResult = $query->exec()->all();
        $this->cache->write($databaseResult->array());
        return $databaseResult;
    }

    /**
     * @param QueryInterface $query
     * @return Result|DataTypeInterface
     */
    protected function findOneInCache(QueryInterface $query)
    {
        $this->setCacheParamsFromQuery($query);

        if($this->cache->read()){
            $cacheResult = $this->cache->result();
            return $cacheResult;
        }

        $databaseResult = $query->exec()->one();
        $this->cache->write($databaseResult->array());
        return $databaseResult;
    }

    /**
     * @param QueryInterface $query
     * @return $this
     */
    protected function setCacheParamsFromQuery(QueryInterface $query)
    {
        $this->cache->query($query->getQuery());
        $this->cache->bindings($query->getBindings());
        return $this;
    }
}