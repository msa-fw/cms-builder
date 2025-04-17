<?php

namespace System\Core\Form\Interfaces;

interface FormInterface
{
    /**
     * @return bool
     */
    public function valid();

    /**
     * @param $field
     * @param $key
     * @param $error
     * @return FormInterface
     */
    public function error($field, $key, $error);

    /**
     * @return array
     */
    public function getForm();

    /**
     * @return FormInterface
     */
    public function validate();

    /**
     * @param $value
     * @return FormInterface
     */
    public function title($value);

    /**
     * @param $value
     * @return FormInterface
     */
    public function template($value);

    /**
     * @param $value
     * @return FormInterface
     */
    public function description($value);

    /**
     * @param $url
     * @param callable $callback
     * @return FormInterface
     */
    public function create($url, callable $callback);
}