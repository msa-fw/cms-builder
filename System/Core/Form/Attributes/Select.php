<?php

namespace System\Core\Form\Attributes;

use System\Core\Form\Attributes;

/**
 * Class Select
 * @method $this autofocus(bool $value)
 * @method $this form(bool $value)
 * @method $this multiple(bool $value)
 * @method $this required(bool $value)
 * @method $this size(bool $value)
 * @package System\Core\Form\Attributes
 */
class Select extends Attributes
{
    public function __construct($fieldName, &$field)
    {
        parent::__construct($fieldName, $field);

        $this->class('select-field');
    }
}