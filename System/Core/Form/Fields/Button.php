<?php

namespace System\Core\Form\Fields;

use System\Core\Form\Attributes\Reset;
use System\Core\Form\Attributes\Submit;
use System\Core\Form\Attributes\Button as ButtonAttributes;

/**
 * Class Button
 * @package System\Core\Form\Fields
 */
class Button
{
    protected $fieldName;

    protected $field = array();

    public function __construct($fieldName, array &$field)
    {
        $this->fieldName = $fieldName;
        $this->field = &$field;
    }

    public function button($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new ButtonAttributes($this->fieldName, $this->field);
    }

    public function submit($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Submit($this->fieldName, $this->field);
    }

    public function reset($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Reset($this->fieldName, $this->field);
    }
}