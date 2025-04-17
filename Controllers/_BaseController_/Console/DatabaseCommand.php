<?php

namespace Controllers\_BaseController_\Console;

use System\Core\Database;
use Controllers\_BaseController_\Language;
use System\Core\Console\ConsoleInterface;
use System\Core\Database\Table\Interfaces\TableInterface;

use function console\success;
use function console\warning;

class DatabaseCommand
{
    /** @var  Database\Driver */
    protected $connection;
    /** @var ConsoleInterface */
    protected $console;

    public function __construct(ConsoleInterface $console)
    {
        $this->console = $console;
        $this->connection = Database::connect();
    }

    public function createDatabase($databaseName)
    {
        if($this->connection->exist($databaseName)){
            warning(Language::_BaseController_('database.alreadyExists')
                ->string(true)->replace_k2v(array('%db%' => $databaseName)))->print();
        }else{
            $this->connection->create($databaseName);

            if($this->connection->exist($databaseName)){
                success(Language::_BaseController_('database.createdSuccessfully')
                    ->string(true)->replace_k2v(array('%db%' => $databaseName)))->print();
                return $this;
            }
            warning(Language::_BaseController_('database.notCreated')
                ->string(true)->replace_k2v(array('%db%' => $databaseName)))->print();
        }
        return $this;
    }

    public function dropDatabase($databaseName)
    {
        if($this->connection->exist($databaseName)){
            warning(Language::_BaseController_('database.notExists')
                ->string(true)->replace_k2v(array('%db%' => $databaseName)))->print();
        }else{
            $this->connection->delete($databaseName);

            if($this->connection->exist($databaseName)){
                warning(Language::_BaseController_('database.notDeleted')
                    ->string(true)->replace_k2v(array('%db%' => $databaseName)))->print();
                return $this;
            }
            success(Language::_BaseController_('database.deletedSuccessfully')
                ->string(true)->replace_k2v(array('%db%' => $databaseName)))->print();
        }
        return $this;
    }

    public function renameDatabase($databaseName, $newDatabaseName)
    {
        if($this->connection->exist($newDatabaseName)){
            warning(Language::_BaseController_('database.alreadyExists')
                ->string(true)->replace_k2v(array('%db%' => $newDatabaseName)))->print();
        }else{
            $this->connection->rename($databaseName, $newDatabaseName, null, null);

            if($this->connection->exist($databaseName) || !$this->connection->exist($newDatabaseName)){
                warning(Language::_BaseController_('database.notRenamed')
                    ->string(true)->replace_k2v(array('%db%' => $databaseName, '%new%' => $newDatabaseName)))->print();
                return $this;
            }
            success(Language::_BaseController_('database.renamedSuccessfully')
                ->string(true)->replace_k2v(array('%db%' => $databaseName, '%new%' => $newDatabaseName)))->print();
        }
        return $this;
    }

    public function createTable($databaseName, $tableName)
    {
        $database = $this->connection->database($databaseName);

        if($database->table($tableName)->exist()){
            warning(Language::_BaseController_('database.table.alreadyExist')
                ->string(true)->replace_k2v(array('%tbl%' => $tableName, '%db%' => $databaseName)))->print();
        }else{
            $database->table($tableName)->create(function(TableInterface $table){
                $table->column('id')->bigint(255)->unsigned()->primary();
            });

            if($database->table($tableName)->exist()){
                success(Language::_BaseController_('database.table.createdSuccessfully')
                    ->string(true)->replace_k2v(array('%tbl%' => $tableName, '%db%' => $databaseName)))->print();
                return $this;
            }
            warning(Language::_BaseController_('database.table.notCreated')
                ->string(true)->replace_k2v(array('%tbl%' => $tableName, '%db%' => $databaseName)))->print();
        }
        return $this;
    }

    public function dropTable($databaseName, $tableName)
    {
        $database = $this->connection->database($databaseName);

        if(!$database->table($tableName)->exist()){
            warning(Language::_BaseController_('database.table.notExist')
                ->string(true)->replace_k2v(array('%tbl%' => $tableName, '%db%' => $databaseName)))->print();
        }else{
            $database->table($tableName)->drop();

            if($database->table($tableName)->exist()){
                warning(Language::_BaseController_('database.table.notDeleted')
                    ->string(true)->replace_k2v(array('%tbl%' => $tableName, '%db%' => $databaseName)))->print();
                return $this;
            }
            success(Language::_BaseController_('database.table.deletedSuccessfully')
                ->string(true)->replace_k2v(array('%tbl%' => $tableName, '%db%' => $databaseName)))->print();
        }
        return $this;
    }

    public function renameTable($databaseName, $tableName, $newTableName)
    {
        $database = $this->connection->database($databaseName);

        if($database->table($newTableName)->exist()){
            warning(Language::_BaseController_('database.table.alreadyExist')->string(true)
                ->replace_k2v(array('%tbl%' => $newTableName, '%db%' => $databaseName)))->print();
        }else{
            $database->table($tableName)->rename($newTableName);

            if(!$database->table($tableName)->exist() && $database->table($newTableName)->exist()){
                success(Language::_BaseController_('database.table.renamedSuccessfully')
                    ->string(true)->replace_k2v(array('%tbl%' => $tableName, '%db%' => $databaseName, '%new%' => $newTableName)))->print();
                return $this;
            }
            warning(Language::_BaseController_('database.table.notRenamed')
                ->string(true)->replace_k2v(array('%tbl%' => $tableName, '%db%' => $databaseName, '%new%' => $newTableName)))->print();
        }
        return $this;
    }

    public function truncateTable($databaseName, $tableName)
    {
        $result = $this->connection->database($databaseName)
            ->table($tableName)->truncate();

        if(!$result->all()->array()){
            success(Language::_BaseController_('database.table.truncatedSuccessfully')
                ->string(true)->replace_k2v(array('%tbl%' => $tableName, '%db%' => $databaseName)))->print();
            return $this;
        }
        warning(Language::_BaseController_('database.table.notTruncated')->string(true)
            ->replace_k2v(array('%tbl%' => $tableName, '%db%' => $databaseName)))->print();
        return $this;
    }

    public function optimizeTable($databaseName, $tableName)
    {
        $this->connection->database($databaseName)
            ->table($tableName)->optimize();

        success(Language::_BaseController_('database.table.optimizedSuccessfully')
            ->string(true)->replace_k2v(array('%tbl%' => $tableName, '%db%' => $databaseName)))->print();
        return $this;
    }
}