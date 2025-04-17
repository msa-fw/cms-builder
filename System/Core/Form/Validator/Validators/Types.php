<?php

namespace System\Core\Form\Validator\Validators;

use System\Core\Language;
use System\Core\Form\Validator;

class Types
{
    /** @var  Validator */
    protected $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function validateEmailField()
    {
        if(!preg_match("#^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$#usim", $this->validator->getFieldAttribute('value'))){
            $this->validator->error('email', Language::System('form.validation.error.field.email')->returnKey());
        }
        return $this;
    }

    public function validatePasswordField()
    {
        $value = $this->validator->getFieldAttribute('value');
        if(!preg_match("#[A-Z]#usm", $value)){
            $this->validator->error('uppercase', Language::System('form.validation.error.field.password.uppercase')->returnKey());
        }
        if(!preg_match("#[0-9]#usm", $value)){
            $this->validator->error('numbers', Language::System('form.validation.error.field.password.numbers')->returnKey());
        }
        if(!preg_match("#[a-z]#usm", $value)){
            $this->validator->error('lowercase', Language::System('form.validation.error.field.password.lowercase')->returnKey());
        }
        if(!preg_match("#[\!-\?]#usm", $value)){
            $this->validator->error('symbols', Language::System('form.validation.error.field.password.symbols')->string(true)
                ->replace_k2v(array('%chars%' => implode('', range('!', '?')))));
        }
        return $this;
    }

    public function validateNumberField()
    {
        if(preg_replace("#^\d+$#sm" ,'', $this->validator->getFieldAttribute('value'))){
            $this->validator->error('number', Language::System('form.validation.error.field.number')->returnKey());
        }
        return $this;
    }

    public function validatePhoneField()
    {
        if(preg_replace("#^\d+$#sm" ,'', $this->validator->getFieldAttribute('value'))){
            $this->validator->error('phone', Language::System('form.validation.error.field.phone')->returnKey());
        }
        return $this;
    }

    public function validateFileField()
    {
        $uploadedFiles = $this->validator->getFieldProperty('default');

        $multiple = $this->validator->getFieldAttribute('multiple');

        if($multiple){
            if(isset($uploadedFiles['name'])){
                $this->validator->error('notMultiple', Language::System('form.validation.error.field.file.notMultiple')->returnKey());
            }

            foreach($uploadedFiles as $index => $uploadedFile){
                $this->validateFile($index, $uploadedFile);
            }
        }

        if(!$multiple){
            if(!isset($uploadedFiles['name'])){
                $this->validator->error('multiple', Language::System('form.validation.error.field.file.multiple')->returnKey());
            }

            $this->validateFile(0, $uploadedFiles);
        }
        return $this;
    }

    protected function validateFile($index, $uploadedFile)
    {
        if(!$this->validator->getFieldAttribute('required') && isset($uploadedFile['error']) && $uploadedFile['error'] == 4){
            return $this;
        }

        $fileValidator = new File($index, $uploadedFile, $this->validator);

        return $fileValidator->validateUploadErrors()
            ->validateMinSize()
            ->validateMaxSize()
            ->validateAccepts();
    }

    public function validateUrlField()
    {
        if($value = $this->validator->getFieldAttribute('value')){
            $linkInfo = parse_url($value);
            if(!isset($linkInfo['scheme']) || !isset($linkInfo['host']) || !isset($linkInfo['path'])){
                $this->validator->error('url', Language::System('form.validation.error.field.url')->returnKey());
            }
        }
        return $this;
    }

    public function validateDateField()
    {
        if(strtotime($this->validator->getFieldAttribute('value')) === false){
            $this->validator->error('date', Language::System('form.validation.error.field.date')->returnKey());
        }
        return $this;
    }
}