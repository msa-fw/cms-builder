<?php

namespace System\Core\Form\Validator\Validators;

use System\Core\Language;
use System\Core\Form\Validator;

class Filters
{
    /** @var  Validator */
    protected $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function validateFilters($filters)
    {
        foreach($filters as $type => $options){
            $this->validateFilter($type, $options);
        }
        return $this;
    }

    public function validateFilter($type, $options)
    {
        $value = $this->validator->getFieldAttribute('value');

        foreach($options as $identifier => $flags){
            if(!filter_var($value, $identifier, $flags)){
                $this->validator->error($type, Language::System("form.validation.error.filter.{$type}")
                    ->string(true)->replace_k2v(array('%val%' => $value)));
            }
        }
        return $this;
    }
}