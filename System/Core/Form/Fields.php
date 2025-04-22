<?php

namespace System\Core\Form;

use System\Core\Form;
use System\Core\Language;
use System\Core\Form\Fields\Html;
use System\Core\Form\Fields\Input;
use System\Core\Form\Fields\Select;
use System\Core\Form\Fields\Button;
use System\Core\Form\Fields\Common;
use function response\url;

/**
 * Class Fields
 * @package System\Core\Form
 */
class Fields
{
    protected $fields = array();

    public function __construct(array &$fields)
    {
        $this->fields = &$fields;
    }

    public function input($fieldName, $fieldSet = null)
    {
        $fieldSet = $fieldSet ?: __FUNCTION__;
        $this->fields[$fieldName]['fieldType'] = 'input';
        $this->fields[$fieldName]['name'] = $fieldName;
        $this->fields[$fieldName]['fieldSet'] = $fieldSet;
        return new Input($fieldName, $this->fields[$fieldName]);
    }

    public function button($fieldName, $fieldSet = null)
    {
        $fieldSet = $fieldSet ?: __FUNCTION__;
        $this->fields[$fieldName]['fieldType'] = 'button';
        $this->fields[$fieldName]['name'] = $fieldName;
        $this->fields[$fieldName]['fieldSet'] = $fieldSet;
        return new Button($fieldName, $this->fields[$fieldName]);
    }

    public function select($fieldName, $fieldSet = null)
    {
        $fieldSet = $fieldSet ?: __FUNCTION__;
        $this->fields[$fieldName]['fieldType'] = 'select';
        $this->fields[$fieldName]['name'] = $fieldName;
        $this->fields[$fieldName]['fieldSet'] = $fieldSet;
        return new Select($fieldName, $this->fields[$fieldName]);
    }

    /**
     * @param $fieldName
     * @return Attributes
     */
    public function captcha($fieldName)
    {
        $this->fields[$fieldName]['fieldType'] = 'captcha';
        $this->fields[$fieldName]['name'] = $fieldName;
        $this->fields[$fieldName]['fieldSet'] = __FUNCTION__;

        $captchaLink = url('updateCaptchaAction')
            ->query(array('field' => $fieldName))
            ->build()->get();

        $input = new Input($fieldName, $this->fields[$fieldName]);
        $attributes = $input->text($captchaLink)
            ->class('captcha-field');

        $attributes->attribute('__captchaField', true);
        $attributes->append()
            ->label(Language::System('form.field.captcha.label.captchaLabel')->read())
            ->description(Language::System('form.field.captcha.label.captchaDescription')->read());

        return $attributes;
    }

    public function csrf($fieldName)
    {
        $this->fields[$fieldName]['fieldType'] = 'input';
        $this->fields[$fieldName]['name'] = $fieldName;
        $this->fields[$fieldName]['fieldSet'] = __FUNCTION__;

        $input = new Input($fieldName, $this->fields[$fieldName]);
        $input->hidden(Form::getCsrfToken($fieldName));

        $attributes = new Attributes($fieldName,$this->fields[$fieldName]);
        $attributes->attribute('__csrfTokenKey', true);
        return $attributes;
    }

    public function textArea($fieldName, $fieldSet = null)
    {
        $fieldSet = $fieldSet ?: __FUNCTION__;
        $this->fields[$fieldName]['fieldType'] = 'textarea';
        $this->fields[$fieldName]['name'] = $fieldName;
        $this->fields[$fieldName]['fieldSet'] = $fieldSet;
        $this->fields[$fieldName]['type'] = 'textarea';

        $attributes = new Common($fieldName, $this->fields[$fieldName]);
        $attributes->attribute('class', 'text-area-field');

        return $attributes;
    }

    public function html($fieldName, $fieldSet = null)
    {
        $fieldSet = $fieldSet ?: __FUNCTION__;
        $this->fields[$fieldName]['fieldType'] = 'html';
        $this->fields[$fieldName]['name'] = $fieldName;
        $this->fields[$fieldName]['fieldSet'] = $fieldSet;
        $this->fields[$fieldName]['type'] = 'html';

        return new Html($fieldName, $this->fields[$fieldName]);
    }

    public function field($fieldName, $fieldType, $fieldSet = null)
    {
        $fieldSet = $fieldSet ?: __FUNCTION__;
        $this->fields[$fieldName]['name'] = $fieldName;
        $this->fields[$fieldName]['fieldType'] = $fieldType;
        $this->fields[$fieldName]['fieldSet'] = $fieldSet;

        return new Common($fieldName, $this->fields[$fieldName]);
    }
}