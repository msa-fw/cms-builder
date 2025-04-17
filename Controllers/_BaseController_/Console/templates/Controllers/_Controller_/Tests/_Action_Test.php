<?php

namespace Controllers\_Controller_\Tests;

use System\Core\Database;

class _Action_Test
{
    /** @var bool|Database\Driver */
    protected $connection;
    /** @var Database\Db */
    protected $database;

    public function __construct()
    {
        $this->connection = Database::connect();
        $this->database = $this->connection->database();
    }

    public function execute()
    {
        return true;
    }
}