<?php

namespace System\Core\Form\Fields;

use System\Core\Form\Attributes\Button;
use System\Core\Form\Attributes\Checkbox;
use System\Core\Form\Attributes\Color;
use System\Core\Form\Attributes\Date;
use System\Core\Form\Attributes\DatetimeLocal;
use System\Core\Form\Attributes\Email;
use System\Core\Form\Attributes\File;
use System\Core\Form\Attributes\Hidden;
use System\Core\Form\Attributes\Image;
use System\Core\Form\Attributes\Month;
use System\Core\Form\Attributes\Number;
use System\Core\Form\Attributes\Password;
use System\Core\Form\Attributes\Radio;
use System\Core\Form\Attributes\Range;
use System\Core\Form\Attributes\Reset;
use System\Core\Form\Attributes\Search;
use System\Core\Form\Attributes\Submit;
use System\Core\Form\Attributes\Tel;
use System\Core\Form\Attributes\Text;
use System\Core\Form\Attributes\Time;
use System\Core\Form\Attributes\Url;
use System\Core\Form\Attributes\Week;

/**
 * Class Input
 * @package System\Core\Form\Fields
 */
class Input
{
    protected $fieldName;

    protected $field = array();

    public function __construct($fieldName, array &$field)
    {
        $this->fieldName = $fieldName;
        $this->field = &$field;
    }

    /**
     * @param null $default
     * @return Button
     */
    public function button($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Button($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return Checkbox
     */
    public function checkbox($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Checkbox($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return Color
     */
    public function color($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Color($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return Date
     */
    public function date($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Date($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return DatetimeLocal
     */
    public function datetimeLocal($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new DatetimeLocal($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return Email
     */
    public function email($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Email($this->fieldName, $this->field);
    }

    /**
     * @param array $requestedFiles
     * @return File
     */
    public function file(array $requestedFiles)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $requestedFiles;

        $file = new File($this->fieldName, $this->field);
        return $file->value(!empty($requestedFiles));
    }

    /**
     * @param null $default
     * @return Hidden
     */
    public function hidden($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Hidden($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return Image
     */
    public function image($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Image($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return Month
     */
    public function month($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Month($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return \System\Core\Form\Attributes\Number
     */
    public function number($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Number($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return Password
     */
    public function password($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Password($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return Radio
     */
    public function radio($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Radio($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return Range
     */
    public function range($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Range($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return Reset
     */
    public function reset($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Reset($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return Search
     */
    public function search($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Search($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return Submit
     */
    public function submit($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Submit($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return Tel
     */
    public function tel($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Tel($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return Text
     */
    public function text($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Text($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return Time
     */
    public function time($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Time($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return Url
     */
    public function url($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Url($this->fieldName, $this->field);
    }

    /**
     * @param null $default
     * @return Week
     */
    public function week($default = null)
    {
        $this->field['type'] = __FUNCTION__;
        $this->field['default'] = $default;
        return new Week($this->fieldName, $this->field);
    }
}