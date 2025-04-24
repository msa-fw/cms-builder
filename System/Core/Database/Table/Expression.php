<?php

namespace System\Core\Database\Table;

use System\Core\Database\Interfaces\QueryInterface;
use System\Core\Database\Interfaces\DriverInterface;
use System\Core\Database\Interfaces\ResultInterface;
use System\Core\Database\Table\Interfaces\ExpressionInterface;
use System\Core\Database\Table\Interfaces\ExpressionGetterInterface;
use System\Core\Database\Table\Interfaces\ExpressionNestedInterface;
use System\Core\Database\Table\Interfaces\ExpressionParentInterface;

class Expression implements ExpressionInterface, ExpressionParentInterface, ExpressionGetterInterface, ExpressionNestedInterface
{
    protected $table;
    protected $database;

    protected $fields = array();
    protected $where = array();
    protected $join = array();
    protected $order = array();
    protected $group = array();
    protected $heaving = array();

    protected $limit = 0;
    protected $offset = 0;

    /** @var DriverInterface  */
    protected $driver;

    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    public function database($database)
    {
        $this->database = $database;
        return $this;
    }

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function fields(...$fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @param string|callable|ExpressionParentInterface $key
     * @param string $operator
     * @param string|boolean|integer|null|callable|ExpressionNestedInterface $value
     * @return $this
     */
    public function where($key, $operator = '=', $value = null)
    {
        if(is_callable($key)){
            /** @var ExpressionParentInterface $select */
            $select = new self($this->driver);
            call_user_func($key, $select);
            $key = $select;
        }
        if(is_callable($value)){
            /** @var ExpressionNestedInterface $select */
            $select = new self($this->driver);
            call_user_func($value, $select);
            $value = $select;
        }
        $this->where[] = array(
            'key' => $key,
            'value' => $value,
            'operator' => $operator,
            'concat' => 'AND',
        );
        return $this;
    }

    /**
     * @param string|callable|ExpressionParentInterface $key
     * @param string $operator
     * @param string|boolean|integer|null|callable|ExpressionNestedInterface $value
     * @return $this
     */
    public function orWhere($key, $operator = '=', $value = null)
    {
        if(is_callable($key)){
            /** @var ExpressionParentInterface $select */
            $select = new self($this->driver);
            call_user_func($key, $select);
            $key = $select;
        }
        if(is_callable($value)){
            /** @var ExpressionNestedInterface $select */
            $select = new self($this->driver);
            call_user_func($value, $select);
            $value = $select;
        }
        $this->where[] = array(
            'key' => $key,
            'value' => $value,
            'operator' => $operator,
            'concat' => 'OR',
        );
        return $this;
    }

    public function limit($limit, $offset = 0)
    {
        $this->limit = $limit;
        $this->offset = $offset;
        return $this;
    }

    public function join($table2, $expression, $operator = 'LEFT')
    {
        $this->join[] = array(
            'table' => $table2,
            'expression' => $expression,
            'operator' => $operator,
        );
        return $this;
    }

    public function order($field, $sort = 'ASC')
    {
        $this->order[] = array(
            'key' => $field,
            'value' => $sort,
        );
        return $this;
    }

    public function group($field, $sort = 'ASC')
    {
        $this->group[] = array(
            'key' => $field,
            'value' => $sort,
        );
        return $this;
    }

    public function heaving($key, $value, $operator = '=')
    {
        $this->heaving[] = array(
            'key' => $key,
            'value' => $value,
            'operator' => $operator,
        );
        return $this;
    }

    /**
     * @return QueryInterface
     */
    public function get()
    {
        return $this->driver->query('');
    }

    /**
     * @param array $bindings
     * @param array $bindingTypes
     * @return ResultInterface
     */
    public function exec(array $bindings = array(), array $bindingTypes = array())
    {
        return $this->driver->query('')->exec();
    }

    public function getDatabase()
    {
        return $this->database;
    }
    public function getTable()
    {
        return $this->table;
    }
    public function getLimit()
    {
        return $this->limit;
    }
    public function getOffset()
    {
        return $this->offset;
    }
    public function getFields()
    {
        return $this->fields;
    }
    public function getWhere()
    {
        return $this->where;
    }
    public function getJoin()
    {
        return $this->join;
    }
    public function getOrder()
    {
        return $this->order;
    }
    public function getGroup()
    {
        return $this->group;
    }
    public function getHeaving()
    {
        return $this->heaving;
    }
}