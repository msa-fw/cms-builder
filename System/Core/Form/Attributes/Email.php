<?php

namespace System\Core\Form\Attributes;

use System\Core\Form\Attributes;

/**
 * Class Email
 * @method $this autocomplete(bool $value)
 * @method $this list($value)
 * @method $this maxlength($value)
 * @method $this minlength($value)
 * @method $this multiple(bool $value)
 * @method $this pattern($value)
 * @method $this placeholder($value)
 * @method $this readonly(bool $value)
 * @method $this required(bool $value)
 * @method $this size($value)
 * @package System\Core\Form\Attributes
 */
class Email extends Attributes
{
    public function __construct($name, &$field)
    {
        parent::__construct($name, $field);

        $this->class('email-field');
        $this->maxlength(255);
    }
}