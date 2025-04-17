<?php

namespace System\Core\Form\Attributes;

use System\Core\Form\Attributes;

/**
 * Class Reset
 * @method $this autofocus($default = null)
 * @package System\Core\Form\Attributes
 */
class Reset extends Attributes
{
    public function __construct($name, &$field)
    {
        parent::__construct($name, $field);

        $this->class('reset-field');
    }
}