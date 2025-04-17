<?php

namespace System\Core\Form\Attributes;

use System\Core\Form\Attributes;

/**
 * Class Image
 * @method $this alt($value)
 * @method $this formAction($value)
 * @method $this formEnctype($value)
 * @method $this formMethod($value)
 * @method $this formNoValidate($value)
 * @method $this formTarget($value)
 * @method $this placeholder($value)
 * @method $this src($value)
 * @package System\Core\Form\Attributes
 */
class Image extends Attributes
{
    public function __construct($name, &$field)
    {
        parent::__construct($name, $field);

        $this->class('image-field');
    }
}