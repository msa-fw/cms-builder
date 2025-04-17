<?php

namespace System\Core\Database\Table\Interfaces;

interface ExpressionNestedInterface
{
    /**
     * @param $table
     * @return self
     */
    public function table($table);

    /**
     * @param array ...$fields
     * @return self
     */
    public function fields(...$fields);

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
}