<?php

namespace System\Core\Database\Table\Interfaces;

use System\Core\Database\Interfaces\QueryInterface;
use System\Core\Database\Interfaces\ResultInterface;

interface ExpressionInterface
{
    /**
     * @param string|callable|ExpressionParentInterface $key
     * @param string $operator
     * @param string|boolean|integer|null|callable|ExpressionNestedInterface $value
     * @return self
     */
    public function where($key, $operator = '=', $value = null);

    /**
     * @param string|callable|ExpressionParentInterface $key
     * @param string $operator
     * @param string|null|boolean|integer|callable|ExpressionNestedInterface $value
     * @return self
     */
    public function orWhere($key, $operator = '=', $value = null);

    /**
     * @param $limit
     * @param int $offset
     * @return self
     */
    public function limit($limit, $offset = 0);

    /**
     * @param $table2
     * @param $expression
     * @param string $operator
     * @return self
     */
    public function join($table2, $expression, $operator = 'LEFT');

    /**
     * @param $field
     * @param string $sort
     * @return self
     */
    public function order($field, $sort = 'ASC');

    /**
     * @param $field
     * @param string $sort
     * @return self
     */
    public function group($field, $sort = 'ASC');

    /**
     * @param $key
     * @param $value
     * @param string $operator
     * @return self
     */
    public function heaving($key, $value, $operator = '=');

    /**
     * @return QueryInterface
     */
    public function get();

    /**
     * @param array $bindings
     * @return ResultInterface
     */
    public function exec(array $bindings = array());
}