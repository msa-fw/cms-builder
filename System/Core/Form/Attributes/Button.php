<?php

namespace System\Core\Form\Attributes;

use System\Core\Form\Attributes;

/**
 * Class Button
 * @method $this autofocus($default = null)
 * @package System\Core\Form\Attributes
 */
class Button extends Attributes
{
    public function __construct($name, &$field)
    {
        parent::__construct($name, $field);
        $this->class('button-field');
    }
}