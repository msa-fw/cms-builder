<?php

use System\Core\Database;
use System\Core\Database\Table\Interfaces\TableInterface;

class __name____timestamp__
{
    /** @var bool|Database\Driver  */
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function dropTable()
    {
        $this->connection->database()->table('__table__')->drop();
        return $this;
    }

    public function createTable()
    {
        $this->connection->database()->table('__table__')->create(function(TableInterface $table){
            $table->column('id')->bigint(255)->unsigned()->primary();
            // columns ....
            $table->column('created')->timestamp()->currentTimestamp();
            $table->column('updated')->timestamp()->currentTimestamp()->currentTimestampOnUpdate();
        });
        return $this;
    }
}