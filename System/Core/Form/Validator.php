<?php

namespace System\Core\Form;

use System\Core\Form;
use System\Core\Session;
use System\Core\Language;
use System\Core\Form\Interfaces\FormInterface;
use System\Core\Form\Interfaces\ValidatorInterface;
use System\Core\Form\Validator\Validators\Types;
use System\Core\Form\Validator\Validators\Filters;
use System\Core\Form\Validator\Validators\Attributes;

use function encrypt\csrf;

class Validator implements ValidatorInterface
{
    protected $fieldName;

    protected $field = array();

    protected $validators = array();
    /** @var  Form */
    protected $form;

    /**
     * Validator constructor.
     * @param $fieldName
     * @param $field
     * @param FormInterface $form
     */
    public function __construct($fieldName, &$field, FormInterface $form)
    {
        $this->fieldName = $fieldName;
        $this->field = &$field;
        $this->form = $form;

        $this->addValidator(Types::class);
        $this->addValidator(Filters::class);
        $this->addValidator(Attributes::class);
    }

    /**
     * @param $className
     * @param bool|object $enabled
     * @return $this
     */
    public function addValidator($className, $enabled = true)
    {
        $this->validators[$className] = $enabled;
        return $this;
    }

    public function validate()
    {
        if(!$this->getFieldAttribute('required') && !$this->getFieldAttribute('value')){
            return $this;
        }

        /** @var Attributes|Types|Filters $validator */

        if(isset($this->field['attributes']['__csrfTokenKey'])){
            $this->validateCsrfToken();
        }

        if(isset($this->field['attributes']['__captchaField'])){
            $this->validateCaptcha();
        }

        foreach($this->validators as $className => $validator){
            if($this->validators[$className] === null){ continue; }     // skip NULL`ed validators (equal `unset()` function)

            if(!is_object($validator)){
                $validator = new $className($this);
            }

            if(isset($this->field['type']) && method_exists($className, "validate{$this->field['type']}Field")){
                call_user_func(array($validator, "validate{$this->field['type']}Field"));
            }

            if(isset($this->field['filters']) && method_exists($className, "validateFilters")){
                $validator->validateFilters($this->field['filters']);
            }

            if(isset($this->field['attributes']) && method_exists($className, "validateAttributes")){
                $validator->validateAttributes($this->field['attributes']);
            }
        }
        return $this;
    }

    protected function validateCsrfToken()
    {
        $sessionValue = Session::system('csrfs')->key($this->fieldName)->read();

        if(!($value = $this->getFieldAttribute('value'))){
            $this->error('is_empty', Language::System('form.validation.error.field.csrfTokenEmpty')->returnKey());
        }

        if(csrf($sessionValue) != $value){
            $this->error('not_equal', Language::System('form.validation.error.field.csrfTokenNotEqual')->returnKey());
        }
        return $this;
    }

    protected function validateCaptcha()
    {
        if(!($sessionValue = Session::system('captchaValues')->key($this->fieldName)->read(''))){
            $this->error('captchaIsEmpty', Language::System('form.validation.error.field.captchaNotExists')->returnKey());
        }

        if(!($value = $this->getFieldAttribute('value'))){
            $this->error('captchaIsEmpty', Language::System('form.validation.error.field.captchaIsEmpty')->returnKey());
        }

        if(mb_strtolower($sessionValue) != mb_strtolower($value)){
            $this->error('captchaNotEqual', Language::System('form.validation.error.field.captchaNotEqual')->returnKey());
        }
        return $this;
    }

    public function getFieldAttribute($key)
    {
        return isset($this->field['attributes'][$key]) ? $this->field['attributes'][$key] : null;
    }

    public function getFieldProperty($key)
    {
        return isset($this->field[$key]) ? $this->field[$key] : null;
    }

    public function error($key, $message)
    {
        $this->field['errors'][] = $message;
        $this->form->error($this->fieldName, $key, $message);
        return $this;
    }
}