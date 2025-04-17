<?php

namespace System\Core\Database\Table;

use System\Core\Database\Table\Create\Column;
use System\Core\Database\Interfaces\DriverInterface;
use System\Core\Database\Interfaces\CollateInterface;
use System\Core\Database\Table\Abstracts\TableAttributes;
use System\Core\Database\Table\Interfaces\TableInterface;
use System\Core\Database\Table\Interfaces\TableGetterInterface;

/**
 * Class Create
 * @package System\Core\Database\Table
 * @method TableAttributes collate(CollateInterface $collate);
 * @method TableAttributes directory($collate);
 * @method TableAttributes autoextendSize($value = 0);
 * @method TableAttributes autoIncrement($value = 0);
 * @method TableAttributes avgRowLength($value = 0);
 * @method TableAttributes checksum($value = true);
 * @method TableAttributes comment($value);
 * @method TableAttributes compression($value);
 * @method TableAttributes connection($value);
 * @method TableAttributes delayKeyWrite($value = true);
 * @method TableAttributes encryption($value);
 * @method TableAttributes engine($value);
 * @method TableAttributes engineAttribute($value);
 * @method TableAttributes insertMethod($value);
 * @method TableAttributes keyBlockSize($value);
 * @method TableAttributes maxRows($value);
 * @method TableAttributes minRows($value);
 * @method TableAttributes packKeys($value);
 * @method TableAttributes password($value);
 * @method TableAttributes rowFormat($value);
 * @method TableAttributes startTransaction();
 * @method TableAttributes secondaryEngineAttribute($value);
 * @method TableAttributes statsAutoRecalc($value);
 * @method TableAttributes statsPersistent($value);
 * @method TableAttributes statsSamplePages($value);
 */
class Create extends TableAttributes implements TableInterface, TableGetterInterface
{
    protected $table;
    protected $database;
    protected $columns = array();
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

    public function column($name, $default = null)
    {
        $this->columns[$name]['type'] = '';
        $this->columns[$name]['default'] = $default;
        $this->columns[$name]['indexes'] = array();
        $this->columns[$name]['attributes'] = array();
        return new Column($name, $this->columns[$name]);
    }

    public function getTable()
    {
        return $this->table;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function getDatabase()
    {
        return $this->database;
    }
}