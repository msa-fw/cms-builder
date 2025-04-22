<?php

namespace System\Core\Form\Attributes;

use System\Core\Form\Validator\Filters;

class Common
{
    protected $fieldName;

    protected $field = array();

    public function __construct($fieldName, &$field)
    {
        $this->fieldName = $fieldName;
        $this->field = &$field;
    }

    public function label($value, $labelAttributes = array())
    {
        $this->field['label'] = array(
            'value' => $value,
            'attributes' => $labelAttributes
        );
        return $this;
    }

    public function title($value)
    {
        $this->field['attributes']['title'] = $value;
        return $this;
    }

    public function description($value)
    {
        $this->field['description'] = $value;
        return $this;
    }

    public function filters()
    {
        return new Filters($this->fieldName, $this->field);
    }

    public function template($relativePath)
    {
        $this->field['template'] = $relativePath;
        return $this;
    }
}