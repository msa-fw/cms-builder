<?php

namespace System\Core\Form\Validator\Validators;

use System\Core\Language;
use System\Core\Form\Validator;

class Attributes
{
    /** @var  Validator */
    protected $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function validateAttributes(array $attributes)
    {
        foreach($attributes as $attribute => $value){
            if(method_exists($this, "validate{$attribute}Attribute")){
                call_user_func(array($this, "validate{$attribute}Attribute"));
            }
        }
        return $this;
    }

    public function validateRequiredAttribute()
    {
        if($this->validator->getFieldAttribute('required') && !$this->validator->getFieldAttribute('value')){
            $this->validator->error('required', Language::System('form.validation.error.attribute.required')->returnKey());
        }
        return $this;
    }

    public function validateMaxLengthAttribute()
    {
        if($length = $this->validator->getFieldAttribute('maxlength')){
            if($length < mb_strlen($this->validator->getFieldAttribute('value'))){
                $this->validator->error('maxlength', Language::System('form.validation.error.attribute.maxlength')
                    ->string(true)->replace_k2v(array('%len%' => $length)));
            }
        }
        return $this;
    }

    public function validateMinLengthAttribute()
    {
        if($length = $this->validator->getFieldAttribute('minlength')){
            if($length > mb_strlen($this->validator->getFieldAttribute('value'))){
                $this->validator->error('minlength', Language::System('form.validation.error.attribute.minlength')
                    ->string(true)->replace_k2v(array('%len%' => $length)));
            }
        }
        return $this;
    }
}