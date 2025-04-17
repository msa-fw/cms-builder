<?php

namespace System\Core\Database\Table\Interfaces;

use System\Core\Database\Interfaces\CollateInterface;
use System\Core\Database\Table\Alter\Index\Operators as IndexOperators;
use System\Core\Database\Table\Alter\Column\Operators as ColumnOperators;

interface AlterTableInterface
{
    /**
     * @param $name
     * @param null $default
     * @return ColumnOperators
     */
    public function column($name, $default = null);

    /**
     * @param $name
     * @param int $length
     * @return IndexOperators
     */
    public function index($name, $length = 32);

    /**
     * @param CollateInterface $collate
     * @return self
     */
    public function collate(CollateInterface $collate);

    /**
     * @param $collate
     * @return self
     */
    public function directory($collate);

    /**
     * @param int $value
     * @return self
     */
    public function autoextendSize($value = 0);

    /**
     * @param int $value
     * @return self
     */
    public function autoIncrement($value = 0);

    /**
     * @param int $value
     * @return self
     */
    public function avgRowLength($value = 0);

    /**
     * @param bool $value
     * @return self
     */
    public function checksum($value = true);

    /**
     * @param $value
     * @return self
     */
    public function comment($value);

    /**
     * @param $value
     * @return self
     */
    public function compression($value);

    /**
     * @param $value
     * @return self
     */
    public function connection($value);

    /**
     * @param bool $value
     * @return self
     */
    public function delayKeyWrite($value = true);

    /**
     * @param $value
     * @return self
     */
    public function encryption($value);

    /**
     * @param $value
     * @return self
     */
    public function engine($value);

    /**
     * @param $value
     * @return self
     */
    public function engineAttribute($value);

    /**
     * @param $value
     * @return self
     */
    public function insertMethod($value);

    /**
     * @param $value
     * @return self
     */
    public function keyBlockSize($value);

    /**
     * @param $value
     * @return self
     */
    public function maxRows($value);

    /**
     * @param $value
     * @return self
     */
    public function minRows($value);

    /**
     * @param $value
     * @return self
     */
    public function packKeys($value);

    /**
     * @param $value
     * @return self
     */
    public function password($value);

    /**
     * @param $value
     * @return self
     */
    public function rowFormat($value);

    /**
     * @return self
     */
    public function startTransaction();

    /**
     * @param $value
     * @return self
     */
    public function secondaryEngineAttribute($value);

    /**
     * @param $value
     * @return self
     */
    public function statsAutoRecalc($value);

    /**
     * @param $value
     * @return self
     */
    public function statsPersistent($value);

    /**
     * @param $value
     * @return self
     */
    public function statsSamplePages($value);
}