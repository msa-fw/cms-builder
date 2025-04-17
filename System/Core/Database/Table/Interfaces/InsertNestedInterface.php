<?php

namespace System\Core\Database\Table\Interfaces;

interface InsertNestedInterface
{
    /**
     * @param array $insert
     * @return self
     */
    public function insert($insert);
}