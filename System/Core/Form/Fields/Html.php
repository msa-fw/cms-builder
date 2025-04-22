<?php

namespace System\Core\Form\Fields;

use System\Core\Config;

/**
 * Class Html
 * @package System\Core\Form\Fields
 */
class Html
{
    protected $fieldName;

    protected $field = array();

    public function __construct($fieldName, array &$field)
    {
        $this->fieldName = $fieldName;
        $this->field = &$field;

        $template = Config::template('wysiwygTemplate')
            ->read('wysiwygs/wysiwyg/default.html');

        $this->wysiwygTemplate($template);
    }

    public function wysiwygTemplate($filePath)
    {
        $this->field['wysiwygTemplate'] = $filePath;
        return $this;
    }

    public function wysiwyg($default = null)
    {
        $this->field['type'] = 'html';
        $this->field['default'] = $default;

        $attributes = new Common($this->fieldName, $this->field);
        $attributes->attribute('class', 'content-editable-field-hidden');

        return $attributes;
    }
}