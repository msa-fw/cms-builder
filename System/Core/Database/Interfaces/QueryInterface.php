<?php

namespace System\Core\Database\Interfaces;

interface QueryInterface
{
    const BINDING_TYPE_BLOB = 'b';
    const BINDING_TYPE_DOUBLE = 'd';
    const BINDING_TYPE_STRING = 's';
    const BINDING_TYPE_INTEGER = 'i';

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
     * @param array $bindingTypes
     * @return self
     */
    public function bindings(array $bindings, array $bindingTypes = array());

    public function getQuery();

    public function getBindings();
}