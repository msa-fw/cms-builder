<?php

use System\Core\Config;
use System\Core\Database;
use System\Core\Database\Table\Interfaces\TableInterface;

class create_fillings_table_17434602644014658928
{
    /** @var bool|Database\Driver  */
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::connect();

        $database = Config::database('default')->key('base')->read();
        $this->connection->create($database);
    }

    public function dropTable()
    {
        $this->connection->database()->table('fillings')->drop();
        return $this;
    }

    public function createTable()
    {
        $this->connection->database()->table('fillings')->create(function(TableInterface $table){
            $table->column('id')->bigint(255)->unsigned()->primary();
            $table->column('name')->varchar(200)->unique();
            $table->column('status', 0)->tinyint(4);
            $table->column('created')->timestamp()->currentTimestamp();
            $table->column('updated')->timestamp()->currentTimestamp()->currentTimestampOnUpdate();
        });
        return $this;
    }
}