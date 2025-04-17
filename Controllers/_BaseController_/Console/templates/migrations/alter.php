<?php

use System\Core\Database;
use System\Core\Database\Statics\Collate;
use System\Core\Database\Table\Interfaces\AlterTableInterface;

class __name____timestamp__
{
    /** @var bool|Database\Driver  */
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function alter()
    {
        $this->connection->database()->table('__table__')->alter(function(AlterTableInterface $table){
            $table->column('fieldName')->add()->varchar(255)->unique()->collate(Collate::utf8mb4_unicode_520_ci());     // example
        });
        return $this;
    }
}