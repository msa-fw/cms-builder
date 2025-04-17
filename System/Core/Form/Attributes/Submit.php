<?php

namespace System\Core\Form\Attributes;

use System\Core\Form\Attributes;

/**
 * Class Submit
 * @method $this autofocus($value)
 * @method $this formaction($value)
 * @method $this formenctype($value)
 * @method $this formmethod($value)
 * @method $this formnovalidate($value)
 * @method $this formtarget($value)
 * @method $this required(bool $value)
 * @package System\Core\Form\Attributes
 */
class Submit extends Attributes
{
    public function __construct($name, &$field)
    {
        parent::__construct($name, $field);

        $this->class('submit-field');
    }
}