<?php

namespace System\Core\Form\Interfaces;

interface ValidatorInterface
{
    /**
     * @return ValidatorInterface
     */
    public function validate();

    /**
     * @param $key
     * @return mixed
     */
    public function getFieldAttribute($key);

    /**
     * @param $key
     * @return mixed
     */
    public function getFieldProperty($key);

    /**
     * @param string $key
     * @param string $message
     * @return ValidatorInterface
     */
    public function error($key, $message);
}