<?php

namespace System\Core\Form\Attributes;

use System\Core\Form\Attributes;

/**
 * Class Hidden
 * @package System\Core\Form\Attributes
 */
class Hidden extends Attributes
{
    public function __construct($name, &$field)
    {
        parent::__construct($name, $field);

        $this->class('hidden-field');
    }
}