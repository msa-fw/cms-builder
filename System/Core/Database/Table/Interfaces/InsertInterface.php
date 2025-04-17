<?php

namespace System\Core\Database\Table\Interfaces;

use System\Core\Database\Interfaces\QueryInterface;
use System\Core\Database\Interfaces\ResultInterface;

interface InsertInterface
{
    /**
     * @param array $insert
     * @return self
     */
    public function insert($insert);

    /**
     * @param array $update
     * @return self
     */
    public function update(array $update);

    /**
     * @return QueryInterface
     */

    public function get();

    /**
     * @return ResultInterface
     */
    public function exec();
}