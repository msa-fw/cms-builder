<?php

namespace System\Core\Form\Fields;

use System\Core\Form\Attributes;

/**
 * Class Common
 * @package System\Core\Form\Fields
 */
class Common
{
    protected $fieldName;

    protected $field = array();

    public function __construct($fieldName, array &$field)
    {
        $this->fieldName = $fieldName;
        $this->field = &$field;

        $this->field['default'] = null;
        $this->field['attributes']['class'] = 'custom-field';
    }

    /**
     * Example ->property('input', 123)
     * @param $key
     * @param $value
     * @return $this
     */
    public function property($key, $value)
    {
        $this->field[$key] = $value;
        return $this;
    }

    /**
     * Example ->attribute('id', 'simple-id')
     * @param $key
     * @param $value
     * @return Attributes
     */
    public function attribute($key = null, $value = null)
    {
        $attributes = new Attributes($this->fieldName, $this->field);
        return $key && $value ? $attributes->attribute($key, $value) : $attributes;
    }
}