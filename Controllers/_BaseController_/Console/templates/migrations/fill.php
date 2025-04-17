<?php

use System\Core\Database;
use System\Core\Database\Table\Interfaces\InsertNestedInterface;

class __name____timestamp__
{
    /** @var bool|Database\Driver  */
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function fillTable()
    {
        $this->connection->database()->table('__table__')->insert(function(InsertNestedInterface $insert){
            for($id = 0; $id < 1000; $id++){
                $insert->insert(array('id' => $insert));
            }
        });
        return $this;
    }
}