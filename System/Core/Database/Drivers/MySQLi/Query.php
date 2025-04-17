<?php

namespace System\Core\Database\Drivers\MySQLi;

use mysqli_stmt, mysqli_sql_exception;
use mysqli as mysqliInstance;
use System\Core\Database\Drivers\MySQLi;
use System\Core\Database\Statics\Expression;
use System\Core\Database\Interfaces\QueryInterface;

class Query implements QueryInterface
{
    protected $query;

    protected $bindings = array();

    protected $mysqliInterface;

    protected $mysqli;

    public function __construct($query, mysqliInstance $mysqliInterface, MySQLi $mysqli)
    {
        $this->query = $query;
        $this->mysqli = $mysqliInterface;
        $this->mysqliInterface = $mysqli;
    }

    public function bindings(array $bindings)
    {
        foreach($bindings as $key => $value){
            $this->bindings[$key] = $value;
        }
        return $this;
    }

    /**
     * @return Result
     */
    public function exec()
    {
        $debug = Debug::database();

        $stmt = null;
        $result = false;

        if($this->mysqliInterface->connected()){
            try{
                $stmt = $this->prepareStatement();
                if($stmt instanceof mysqli_stmt){
                    $result = $stmt->get_result();
                }
            }catch(mysqli_sql_exception $exception){
                $this->exception($exception->getCode(), $exception->getMessage(), __METHOD__, __LINE__);
            }
        }

        $debug->end()->query($this->query)
            ->backtrace(debug_backtrace());

        return new Result($result, $this->mysqli, $stmt);
    }

    /**
     * @return Result
     */
    public function do()
    {
        $debug = Debug::database();

        $result = false;
        if($this->mysqliInterface->connected()){
            try{
                $result = $this->mysqli->query($this->query);
            }catch(mysqli_sql_exception $exception){
                $this->exception($exception->getCode(), $exception->getMessage(), __METHOD__, __LINE__);
            }
        }

        $debug->end()->query($this->query)
            ->backtrace(debug_backtrace());

        return new Result($result, $this->mysqli);
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getBindings()
    {
        return $this->bindings;
    }

    protected function prepareStatement()
    {
        foreach($this->bindings as $key => $value){
            if($value instanceof Expression){
                $value = $value->getValue();
                $this->query = str_replace($key, $value, $this->query);
                unset($this->bindings[$key]);
            }else
                if(isset($this->bindings[$value])){
                    $this->query = str_replace($key, $value, $this->query);
                    unset($this->bindings[$key]);
                }
        }

        $this->query = str_replace(array_keys($this->bindings), '?', $this->query);
        $stmt = $this->mysqli->prepare($this->query);

        if($stmt instanceof mysqli_stmt){
            $stmt->execute(array_values($this->bindings));
            return $stmt;
        }
        return new Result();
    }

    protected function exception($code, $message, $method = __METHOD__, $line = __LINE__)
    {
        Debug::throw($message)->code('db1001')
            ->file(__FILE__, $line)
            ->class(__CLASS__, $method)
            ->arguments(array(
                'SQL' => $this->query,
                'CODE' => $code
            ))->backtrace(debug_backtrace())
            ->render();

        return $this;
    }
}