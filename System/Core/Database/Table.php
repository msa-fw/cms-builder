<?php

namespace System\Core\Database;

use function database\raw;
use System\Core\Database\Table\Alter;
use System\Core\Database\Table\Create;
use System\Core\Database\Table\Delete;
use System\Core\Database\Table\Insert;
use System\Core\Database\Table\Select;
use System\Core\Database\Table\Update;
use System\Core\Database\Interfaces\DriverInterface;
use System\Core\Database\Table\Interfaces\InsertInterface;
use System\Core\Database\Table\Interfaces\ExpressionInterface;
use System\Core\Database\Table\Interfaces\TableInterface;
use System\Core\Database\Table\Interfaces\AlterTableInterface;
use System\Core\Database\Table\Interfaces\InsertNestedInterface;

class Table
{
    protected $database;

    protected $table;

    protected $driver;

    public function __construct($database, $table, DriverInterface $driver)
    {
        $this->database = $database;
        $this->table = $table;
        $this->driver = $driver;
    }

    public function showIndexes()
    {
        return $this->driver->showIndexes($this->database, $this->table);
    }

    public function showColumns()
    {
        return $this->driver->showColumns($this->database, $this->table);
    }

    public function rename($newName)
    {
        return $this->driver->renameTable($this->database, $this->table, $newName);
    }

    public function drop()
    {
        return $this->driver->dropTable($this->database, $this->table);
    }

    public function truncate()
    {
        return $this->driver->truncateTable($this->database, $this->table);
    }

    public function optimize()
    {
        return $this->driver->optimizeTable($this->database, $this->table);
    }

    public function exist()
    {
        foreach($this->driver->showTables($this->database)->all()->array() as $tables){
            foreach($tables as $table){
                if($table == $this->table){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param callable|TableInterface $callback
     * @return self
     */
    public function create(callable $callback)
    {
        $object = new Create($this->driver);
        $object->database($this->database);
        $object->table($this->table);
        call_user_func($callback, $object);
        $this->driver->createTable($object);
        return $this;
    }

    /**
     * @param callable|AlterTableInterface $callback
     * @return self
     */
    public function alter(callable $callback)
    {
        $object = new Alter($this->driver);
        $object->database($this->database);
        $object->table($this->table);
        call_user_func($callback, $object);
        $this->driver->alterTable($object);
        return $this;
    }

    /**
     * @param string $field
     * @param array ...$fields
     * @return ExpressionInterface
     */
    public function select($field = '*', ...$fields)
    {
        $fields = func_get_args();
        $object = new Select($this->driver);
        $object->database($this->database);
        $object->table($this->table);
        $object->fields(...$fields);
        return $object;
    }

    /**
     * @param string $field
     * @return ExpressionInterface
     */
    public function count($field = '*')
    {
        return $this->select(raw("count({$field}) as {$field}"));
    }

    /**
     * @param string $field
     * @return ExpressionInterface
     */
    public function min($field)
    {
        return $this->select(raw("min({$field}) as {$field}"));
    }

    /**
     * @param string $field
     * @return ExpressionInterface
     */
    public function max($field)
    {
        return $this->select(raw("max({$field}) as {$field}"));
    }

    /**
     * @param string $field
     * @return ExpressionInterface
     */
    public function sum($field)
    {
        return $this->select(raw("sum({$field}) as {$field}"));
    }

    /**
     * @param string $field
     * @return ExpressionInterface
     */
    public function avg($field)
    {
        return $this->select(raw("avg({$field}) as {$field}"));
    }

    /**
     * @param array|callable|InsertNestedInterface $values
     * @return InsertInterface
     */
    public function insert($values)
    {
        $object = new Insert($this->driver);
        $object->database($this->database);
        $object->table($this->table);
        $object->insert($values);
        return $object;
    }

    /**
     * @param array $values
     * @return ExpressionInterface
     */
    public function update(array $values)
    {
        $object = new Update($this->driver);
        $object->database($this->database);
        $object->table($this->table);
        $object->values($values);
        return $object;
    }

    /**
     * @return ExpressionInterface
     */
    public function delete()
    {
        $object = new Delete($this->driver);
        $object->database($this->database);
        $object->table($this->table);
        return $object;
    }
}