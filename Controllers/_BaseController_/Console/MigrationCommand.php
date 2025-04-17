<?php

namespace Controllers\_BaseController_\Console;

use System\Core\Database;
use System\Core\Console\ConsoleInterface;
use Controllers\_BaseController_\Console\Migration\AbstractMigrationClass;

class MigrationCommand extends AbstractMigrationClass
{
    const ROOT = ROOT . "/Controllers/_BaseController_/Console/templates/migrations";

    /** @var ConsoleInterface */
    protected $console;

    public function __construct(ConsoleInterface $console)
    {
        $this->console = $console;
        $this->connection = Database::connect();
        $this->rootDirectory = "temp/migrations";
    }

    public function alterTable($table)
    {
        $target = self::ROOT . "/alter.php";
        return $this->copyFile($table, $target, 'schema', "alter_{$table}_table");
    }

    public function createTable($table)
    {
        $target = self::ROOT . "/create.php";
        return $this->copyFile($table, $target, 'schema', "create_{$table}_table");
    }

    public function createFilling($table)
    {
        $target = self::ROOT . "/fill.php";
        return $this->copyFile($table, $target, 'insert', "fill_{$table}_table");
    }

    public function filling()
    {
        $migrations = $this->getFillingsFromDb();

        foreach($this->getFilesList('insert') as $filePath){
            $fileName = pathinfo($filePath, PATHINFO_FILENAME);

            if($this->runMigrationFromFile($filePath, $fileName, $migrations)){

                $this->connection->database()->table('fillings')->insert(array(
                    'status' => 1,
                    'name' => $fileName,
                ))->get()->exec()->id();
            }
        }
        return $this;
    }

    public function migrate()
    {
        $migrations = $this->getMigrationsFromDb();

        foreach($this->getFilesList('schema') as $filePath){
            $fileName = pathinfo($filePath, PATHINFO_FILENAME);

            if($this->runMigrationFromFile($filePath, $fileName, $migrations)){

                $this->connection->database()->table('migrations')->insert(array(
                    'status' => 1,
                    'name' => $fileName,
                ))->get()->exec()->id();
            }
        }
        return $this;
    }
}