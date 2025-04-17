<?php

namespace System\Core\Database\Interfaces;

use System\Core\Database\Table;
use System\Core\Database\Table\Interfaces\AlterTableGetterInterface;
use System\Core\Database\Table\Interfaces\TableGetterInterface;
use System\Core\Database\Table\Interfaces\ExpressionGetterInterface;
use System\Core\Database\Table\Interfaces\InsertGetterInterface;
use System\Core\Database\Table\Interfaces\UpdateGetterInterface;

interface DriverInterface
{
    /**
     * @return bool
     */
    public function connected();
    /**
     * @param $key
     * @param null $check
     * @return mixed
     */
    public function getConfig($key, $check = null);
    /**
     * @return DriverInterface
     */
    public function connect();
    /**
     * @param string $value
     * @return string
     */
    public function quote($value);
    /**
     * @param $query
     * @return QueryInterface
     */
    public function query($query);
    /**
     * @param $database
     * @return DriverInterface
     */
    public function open($database);
    /**
     * @return ResultInterface
     */
    public function showDatabases();
    /**
     * @return ResultInterface
     */
    public function showProcessList();
    /**
     * @param $database
     * @param $charset
     * @param $collate
     * @return ResultInterface
     */
    public function createDatabase($database, $charset, $collate);
    /**
     * @param $database
     * @return ResultInterface
     */
    public function deleteDatabase($database);

    /**
     * @param $database
     * @param $newName
     * @param $charset
     * @param $collate
     * @return ResultInterface
     */
    public function renameDatabase($database, $newName, $charset, $collate);

    /**
     * @param $database
     * @return ResultInterface
     */
    public function showTables($database);

    /**
     * @param $database
     * @return ResultInterface
     */
    public function showProperties($database);

    /**
     * @param $database
     * @param $table
     * @return ResultInterface
     */
    public function showIndexes($database, $table);

    /**
     * @param $database
     * @param $table
     * @return ResultInterface
     */
    public function showColumns($database, $table);

    /**
     * @param $database
     * @param $oldName
     * @param $newName
     * @return ResultInterface
     */
    public function renameTable($database, $oldName, $newName);

    /**
     * @param $database
     * @param $table
     * @return ResultInterface
     */
    public function optimizeTable($database, $table);

    /**
     * @param $database
     * @param $table
     * @return ResultInterface
     */
    public function truncateTable($database, $table);

    /**
     * @param $database
     * @param $table
     * @return ResultInterface
     */
    public function dropTable($database, $table);
    /**
     * @param TableGetterInterface $interface
     * @return Table
     */
    public function createTable(TableGetterInterface $interface);

    /**
     * @param $interface
     * @return Table
     */
    public function alterTable(AlterTableGetterInterface $interface);

    /**
     * @param ExpressionGetterInterface $select
     * @return QueryInterface
     */
    public function select(ExpressionGetterInterface $select);

    /**
     * @param ExpressionGetterInterface $select
     * @return QueryInterface
     */
    public function delete(ExpressionGetterInterface $select);

    /**
     * @param UpdateGetterInterface $interface
     * @return QueryInterface
     */
    public function update(UpdateGetterInterface $interface);

    /**
     * @param InsertGetterInterface $interface
     * @return QueryInterface
     */
    public function insert(InsertGetterInterface $interface);
}