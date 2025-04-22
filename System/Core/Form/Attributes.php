<?php

namespace System\Core\Form;

use System\Core\Form\Attributes\Common;

/**
 * Class Attributes
 * @method $this id($value)
 * @method $this class($value)
 * @method $this value($request)
 * @method $this disabled($value)
 * @method $this required(bool $value)
 * @package System\Core\Form
 */
class Attributes
{
    protected $fieldName;

    protected $field = array();

    public function __call($name, $arguments)
    {
        $this->attribute($name, isset($arguments[0]) ? $arguments[0] : null);
        return $this;
    }

    public function __construct($fieldName, &$field)
    {
        $this->fieldName = $fieldName;
        $this->field = &$field;

        $this->id($this->fieldName);
    }

    public function call(callable $callback)
    {
        call_user_func($callback, $this);
        return $this->append();
    }

    public function append()
    {
        return new Common($this->fieldName, $this->field);
    }

    public function on()
    {
        return new JsEvent($this->fieldName, $this->field);
    }

    public function attribute($name, $value)
    {
        $this->field['attributes'][$name] = $value;
        return $this;
    }
}