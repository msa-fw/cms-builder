<?php

namespace System\Core\Form\Attributes;

use System\Core\Form\Attributes;

/**
 * Class Color
 * @method $this autocomplete(bool $value)
 * @method $this list($value)
 * @package System\Core\Form\Attributes
 */
class Color extends Attributes
{
    public function __construct($name, &$field)
    {
        parent::__construct($name, $field);

        $this->class('color-field');
    }
}