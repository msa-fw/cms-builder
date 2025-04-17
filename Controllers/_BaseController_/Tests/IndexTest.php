<?php

namespace Controllers\_BaseController_\Tests;

use System\Core\Database;

class IndexTest
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

    public function execute(){return true;}
    public function execute1(){return false;}
    public function execute2(){return true;}
    public function execute3(){return false;}
    public function execute4(){return true;}
    public function execute5(){return false;}
    public function execute19(){return true;}
    public function execute20(){return false;}
    public function execute21(){return true;}
}