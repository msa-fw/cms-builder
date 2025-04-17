<?php

use System\Core\Config;
use System\Core\Database;
use System\Core\Database\Table\Interfaces\TableInterface;

class create_migrations_table_17434601795987360477
{
    /** @var bool|Database\Driver  */
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::connect();

        $database = Config::database('default')->key('base')->read();
        $this->connection->create($database);
    }

    public function dropMigrationsTable()
    {
        $this->connection->database()->table('migrations')->drop();
        return $this;
    }

    public function createMigrationsTable()
    {
        $this->connection->database()->table('migrations')->create(function(TableInterface $table){
            $table->column('id')->bigint(255)->unsigned()->primary();
            $table->column('name')->varchar(200)->unique();
            $table->column('status', 0)->tinyint(4);
            $table->column('created')->timestamp()->currentTimestamp();
            $table->column('updated')->timestamp()->currentTimestamp()->currentTimestampOnUpdate();
        });
        return $this;
    }
}