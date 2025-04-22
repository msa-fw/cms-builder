<?php

namespace System\Core\Form\Attributes;

use System\Core\Form\Attributes;

/**
 * Class Checkbox
 * @method $this checked(bool $value)
 * @method $this required(bool $value)
 * @package System\Core\Form\Attributes
 */
class Checkbox extends Attributes
{
    public function __construct($name, &$field)
    {
        parent::__construct($name, $field);

        $this->class('checkbox-field');
    }
}