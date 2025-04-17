<?php

namespace System\Core\Database\Table\Interfaces;

interface ExpressionParentInterface
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
}