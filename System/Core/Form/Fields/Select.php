<?php

namespace System\Core\Form\Fields;

use System\Core\Form\Attributes\Select as SelectAttributes;

/**
 * Class Select
 * @package System\Core\Form\Fields
 */
class Select
{
    protected $fieldName;

    protected $field = array();

    public function __construct($fieldName, array &$field)
    {
        $this->fieldName = $fieldName;
        $this->field = &$field;
    }

    public function options(array $options)
    {
        $this->field['options'] = $options;
        return new SelectAttributes($this->fieldName, $this->field);
    }
}