<?php

namespace System\Core\Database\Interfaces;

interface QueryInterface
{
    /**
     * @deprecated Unsafe method; BE CAREFUL
     * @return ResultInterface
     */
    public function do();

    /**
     * @return ResultInterface
     */
    public function exec();

    /**
     * @param array $bindings
     * @return self
     */
    public function bindings(array $bindings);

    public function getQuery();

    public function getBindings();
}