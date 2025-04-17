<?php

namespace System\Core\Database\Drivers\MySQLi;

use mysqli, mysqli_stmt, mysqli_result;
use System\Core\Database\Statics\DataType;
use System\Core\Database\Interfaces\ResultInterface;
use System\Core\Database\Interfaces\DataTypeInterface;

/**
 * Class Result
 * @package Core\Database\MySQLi
 * @property $current_field;
 * @property $field_count;
 * @property $lengths;
 * @property $num_rows;
 * @property $type;
 * @method mysqli_result close()
 * @method mysqli_result free()
 * @method mysqli_result data_seek($offset)
 * @method mysqli_result fetch_field()
 * @method mysqli_result fetch_fields()
 * @method mysqli_result fetch_field_direct($fieldNr)
 * @method mysqli_result fetch_all($resultType = null)
 * @method mysqli_result fetch_array($resultType = MYSQLI_BOTH)
 * @method mysqli_result fetch_assoc()
 * @method mysqli_result fetch_object($class_name = null, array $params = null)
 * @method mysqli_result fetch_row()
 * @method mysqli_result field_seek($fieldNr)
 * @method mysqli_result free_result()
 */
class Result implements ResultInterface
{
    /** @var  mysqli_result|bool|string|array */
    protected $result;
    /** @var mysqli_stmt */
    protected $statement;
    /** @var mysqli */
    protected $mysqli;

    public function __construct($result = null, mysqli $mysqli = null, $statement = null)
    {
        $this->result = $result;
        $this->mysqli = $mysqli;
        $this->statement = $statement;
    }

    public function __call($name, $arguments)
    {
        if(!is_null($this->result) && method_exists($this->result, $name)){
            return call_user_func_array(array($this->result, $name), $arguments);
        }
        return false;
    }

    public function __get($name)
    {
        return isset($this->result->{$name}) ? $this->result->{$name} : null;
    }

    public function __destruct()
    {
        if($this->result instanceof mysqli_result){
            $this->result->free();
        }
        if($this->statement instanceof mysqli_stmt){
            $this->statement->free_result();
        }
//        if($this->result instanceof mysqli_result){
//            $this->result->close();
//        }
//        if($this->statement instanceof mysqli_stmt){
//            $this->statement->close();
//        }
    }

    public function id()
    {
        if($this->mysqli instanceof mysqli){
            return $this->mysqli->insert_id;
        }
        return false;
    }

    public function rows()
    {
        if($this->statement instanceof mysqli_stmt){
            return $this->statement->affected_rows;
        }
        if($this->mysqli instanceof mysqli){
            return $this->mysqli->affected_rows;
        }
        return false;
    }

    /**
     * @return DataTypeInterface
     */
    public function one()
    {
        $result = array();
        if($this->result instanceof mysqli_result){
            $result = $this->result->fetch_assoc();
        }
        return new DataType($result);
    }

    /**
     * @return DataTypeInterface
     */
    public function all()
    {
        $result = array();
        if($this->result instanceof mysqli_result){
            while ($row = $this->result->fetch_assoc()) {
                $result[] = $row;
            }
        }
        return new DataType($result);
    }

    public function field()
    {
        if($this->result instanceof mysqli_result){
            return $this->result->fetch_field();
        }
        return array();
    }

    public function fields()
    {
        if($this->result instanceof mysqli_result){
            $result = array();
            foreach($this->result->fetch_fields() as $row){
                $result[] = $row;
            }
            return $result;
        }
        return array();
    }

    public function numRows()
    {
        if($this->result instanceof mysqli_result){
            return $this->result->num_rows;
        }
        return false;
    }

    public function raw()
    {
        return $this->result;
    }
}