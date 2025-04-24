<?php

namespace Controllers\_BaseController_\Console\Migration;

use Exception;
use System\Helpers\Classes\Fs;
use Controllers\_BaseController_\Language;
use System\Core\Database\Driver;

use function console\danger;
use function console\success;
use function filesystem\read;
use function filesystem\write;
use function console\warning;
use function filesystem\makeDirectory;
use function reflection\getClassPublicMethodsList;

abstract class AbstractMigrationClass
{
    /** @var bool|Driver  */
    protected $connection;

    protected $rootDirectory;

    protected function getFilesList($directory)
    {
        $filesList = glob(Fs::server()->root("{$this->rootDirectory}/$directory/*.php"));
        usort($filesList, function($value1, $value2){
            preg_match("#_(\d+)\.php#usim", $value1, $match1);
            preg_match("#_(\d+)\.php#usim", $value2, $match2);

            if(isset($match1[1])){ $value1 = $match1[1]; }
            if(isset($match2[1])){ $value2 = $match2[1]; }

            return $value1 > $value2 ? 1 : 0;
        });
        return $filesList;
    }

    protected function runMigrationFromFile($filePath, $fileName, $migrations)
    {
        if($this->fileExistInDb($migrations, $fileName)){
            warning(Language::_BaseController_('console.migration.run.fileExist')->string(true)->replace_k2v(array('%file%' => $filePath)))->print();
            return false;
        }

        $fileContent = read($filePath);
        if(preg_match("#\nclass\s+(.*?)\{#usim", $fileContent, $match)){
            $className = trim($match[1]);
            include_once $filePath;

            $classObject = new $className();
            foreach(getClassPublicMethodsList($className) as $publicMethod){
                if($publicMethod->name == '__construct'){ continue; }

                call_user_func_array(array($classObject, $publicMethod->name), array());
            }
            success(Language::_BaseController_('console.migration.run.exportedSuccessfully')->string(true)->replace_k2v(array('%file%' => $filePath)))->print();
            return true;
        }
        danger(Language::_BaseController_('console.migration.run.notExported')->string(true)->replace_k2v(array('%file%' => $filePath)))->print();
        return false;
    }

    protected function fileExistInDb($migrations, $fileName)
    {
        foreach($migrations as $item){
            if($item['name'] == $fileName){
                return true;
            }
        }
        return false;
    }

    protected function getMigrationsFromDb()
    {
        $migrations = array();
        try{
            $table = $this->connection->database()->table('migrations');
            if($table->exist()){
                $migrations = $table->select('*')->get()->do()->all()->array();
            }
        }catch(Exception $exception){
            danger($exception->getMessage())->print();
        }
        return $migrations;
    }

    protected function getFillingsFromDb()
    {
        $migrations = array();
        try{
            $table = $this->connection->database()->table('fillings');
            if($table->exist()){
                $migrations = $table->select('*')->get()->do()->all()->array();
            }
        }catch(Exception $exception){
            danger($exception->getMessage())->print();
        }
        return $migrations;
    }

    protected function copyFile($table, $target, $destination, $suffix)
    {
        $suffix = $suffix . "_" . number_format(microtime(true), 10, '','');

        $replace = array(
            '__table__' => $table,
            '__name____timestamp__' => $suffix,
        );

        if($content = $this->replaceContent($target, $replace)){
            $destination = "{$this->rootDirectory}/{$destination}";
            makeDirectory($destination);

            $dateStamp = date('Y-m-d');
            $destination = Fs::server()->root("$destination/{$dateStamp}_{$suffix}.php");

            if(write($destination, $content)){
                success(Language::_BaseController_('console.migration.fileCreated')->string(true)->replace_k2v(array('%file%' => $destination)))->print();
                return true;
            }
        }
        danger(Language::_BaseController_('console.migration.fileNotCreated')->string(true)->replace_k2v(array('%file%' => $destination)))->print();
        return false;
    }

    protected function replaceContent($file, array $replace)
    {
        if($content = read($file)){
            return str_replace(array_keys($replace), array_values($replace), $content);
        }
        return '';
    }
}