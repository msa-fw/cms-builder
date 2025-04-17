<?php

namespace System\Core\Database\Drivers;

use Exception, mysqli as mysqliInstance;
use System\Core\Database\Drivers\MySQLi\Query;
use System\Core\Database\Drivers\MySQLi\Builder;
use System\Core\Database\Interfaces\DriverInterface;
use System\Core\Database\Table\Interfaces\TableGetterInterface;
use System\Core\Database\Table\Interfaces\InsertGetterInterface;
use System\Core\Database\Table\Interfaces\UpdateGetterInterface;
use System\Core\Database\Table\Interfaces\ExpressionGetterInterface;
use System\Core\Database\Table\Interfaces\AlterTableGetterInterface;

/**
 * Class MySQLi
 * @package System\Core\Database\Drivers
 */
class MySQLi implements DriverInterface
{
    protected $config = array();

    protected $connected = false;
    /** @var  mysqliInstance */
    protected $mysqli;
    /** @var  Builder */
    protected $builder;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->builder = new Builder();
    }

    public function __destruct()
    {
        $this->closeConnection();
    }

    /**
     * @param $key
     * @param null $check
     * @return mixed|null
     */
    public function getConfig($key, $check = null)
    {
        if($check){ return $check; }
        return isset($this->config[$key]) ? $this->config[$key] : null;
    }

    protected function resetConfig(...$keys)
    {
        foreach($keys as $key){
            if(isset($this->config[$key])){ unset($this->config[$key]); }
        }
        return $this;
    }

    public function connect()
    {
        mysqli_report(MYSQLI_REPORT_ALL & ~MYSQLI_REPORT_INDEX);
//        mysqli_report(MYSQLI_REPORT_OFF);

        $this->mysqli = new mysqliInstance($this->config['host'], $this->config['user'], $this->config['pass'], '', $this->config['port']);
        $this->connected = true;

        $this->resetConfig('host', 'user', 'pass', 'port');
        $this->setCharset($this->config['charset']);
        $this->setDefaultParams()->do();

        return $this;
    }

    public function connected()
    {
        return $this->connected;
    }

    public function quote($value)
    {
        return "'" . $this->mysqli->real_escape_string($value) . "'";
    }

    public function query($sql)
    {
        return new Query($sql, $this->mysqli, $this);
    }

    public function open($database)
    {
        $database = $this->getConfig('base', $database);

        if($this->connected()){
            $this->mysqli->select_db($database);
        }
        return $this;
    }

    public function showDatabases()
    {
        return $this->query("SHOW DATABASES")->do();
    }

    public function showProcessList()
    {
        return $this->query("SHOW FULL PROCESSLIST")->do();
    }

    public function createDatabase($database, $charset, $collate)
    {
        $database = $this->getConfig('base', $database);
        $charset = $this->getConfig('charset', $charset);
        $collate = $this->getConfig('collate', $collate);

        $query = "CREATE DATABASE IF NOT EXISTS\n";
        $query .= "`{$database}`\n";
        $query .= "DEFAULT CHARSET={$charset} COLLATE={$collate}";

        return $this->query($query)->do();
    }

    public function deleteDatabase($database)
    {
        $database = $this->getConfig('base', $database);
        $query = "DROP DATABASE IF EXISTS `{$database}`";
        return $this->query($query)->do();
    }

    public function renameDatabase($database, $newName, $charset, $collate)
    {
        $this->createDatabase($newName, $charset, $collate);

        $tables = $this->query("SHOW TABLES FROM  `$database`")->do()->all()->array();
        foreach($tables as $table){
            foreach($table as $key => $value){
                $this->query("RENAME TABLE `{$database}`.`{$value}` TO `{$newName}`.`{$value}`")->do();
            }
        }
        return $this->deleteDatabase($database);
    }

    public function showTables($database)
    {
        return $this->query("SHOW TABLES FROM `{$database}`")->do();
    }

    public function showProperties($database)
    {
        return $this->query("SHOW TABLE STATUS FROM `{$database}`")->do();
    }

    public function showIndexes($database, $table)
    {
        return $this->query("SHOW INDEXES FROM `{$database}`.`$table`")->do();
    }

    public function showColumns($database, $table)
    {
        return $this->query("SHOW COLUMNS FROM `{$database}`.`$table`")->do();
    }

    public function renameTable($database, $oldName, $newName)
    {
        return $this->query("RENAME TABLE `{$database}`.`{$oldName}` TO `{$database}`.`{$newName}`")->do();
    }

    public function optimizeTable($database, $table)
    {
        return $this->query("OPTIMIZE TABLE `{$database}`.`$table`")->do();
    }

    public function truncateTable($database, $table)
    {
        return $this->query("TRUNCATE TABLE `{$database}`.`$table`")->do();
    }

    public function dropTable($database, $table)
    {
        return $this->query("DROP TABLE IF EXISTS `{$database}`.`$table`")->do();
    }

    public function createTable(TableGetterInterface $interface)
    {
        $charset = $this->getConfig('charset', $interface->getCharset());
        $collate = $this->getConfig('collate', $interface->getCollate());

        $sql = $this->builder->buildCreateTableQuery($this->getConfig('engine'), $charset, $collate, $interface);
        return $this->query($sql)->do();
    }

    public function alterTable(AlterTableGetterInterface $interface)
    {
        $sql = $this->builder->buildAlterTableQuery($this->getConfig('engine'), $interface);
        return $this->query($sql)->do();
    }

    public function select(ExpressionGetterInterface $interface)
    {
        $bindings = array();
        $sql = $this->builder->buildSelectQuery($interface, $bindings);
        return $this->query($sql)->bindings($bindings);
    }

    public function delete(ExpressionGetterInterface $interface)
    {
        $bindings = array();
        $sql = $this->builder->buildDeleteQuery($interface, $bindings);
        return $this->query($sql)->bindings($bindings);
    }

    public function update(UpdateGetterInterface $interface)
    {
        $bindings = array();
        $sql = $this->builder->buildUpdateQuery($interface, $bindings);
        return $this->query($sql)->bindings($bindings);
    }

    public function insert(InsertGetterInterface $interface)
    {
        $bindings = array();
        $sql = $this->builder->buildInsertQuery($interface, $bindings);
        return $this->query($sql)->bindings($bindings);
    }

    protected function setCharset($charset)
    {
        if($this->connected()){
            $this->mysqli->set_charset($charset);
        }

        return $this;
    }

    protected function setDefaultParams()
    {
        $query = "SET ";
        $query .= "time_zone = '" . date('P') . "', \n";
        $query .= "lc_messages = '" . $this->config['locale'] . "', \n";
        $query .= "sql_mode='" . implode(',', $this->config['databaseMode']) . "', \n";
        $query .= "default_storage_engine = " . $this->config['engine'] . ", \n";
        $query .= "default_tmp_storage_engine = " . $this->config['engine'] . ";";

        return $this->query($query);
    }

    protected function closeConnection()
    {
        if($this->connected()){
            $this->mysqli->close();
        }
        return $this;
    }
}