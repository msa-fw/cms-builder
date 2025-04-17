<?php

namespace System\Core\Database\Interfaces;

interface ResultInterface
{
    /**
     * @return integer|boolean
     */
    public function id();
    /**
     * @return DataTypeInterface
     */
    public function all();
    /**
     * @return DataTypeInterface
     */
    public function one();
    public function raw();
    public function rows();
    public function field();
    public function fields();
    public function numRows();
}