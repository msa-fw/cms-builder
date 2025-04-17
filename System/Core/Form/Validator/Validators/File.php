<?php

namespace System\Core\Form\Validator\Validators;

use finfo;
use System\Core\Language;
use System\Core\Form\Validator;

class File
{
    protected $fileIndex = 0;

    protected $uploadedFile;

    protected $errors = array(
        1 => true,
        2 => true,
        3 => true,
        4 => null,
        5 => null,
        6 => true,
        7 => true,
        8 => true,
    );
    /** @var  Validator */
    protected $validator;

    public function __construct($index, $uploadedFile, Validator $validator)
    {
        $this->fileIndex = $index;
        $this->uploadedFile = $uploadedFile;
        $this->validator = $validator;
    }

    public function validateUploadErrors()
    {
        if(isset($this->uploadedFile['error']) && $this->uploadedFile['error']){
            if(isset($this->errors[$this->uploadedFile['error']])){
                $key = "uploadError{$this->uploadedFile['error']}";

                $this->validator->error($key . $this->fileIndex, Language::System("form.validation.error.field.file.{$key}")
                    ->string(true)->replace_k2v(array('%file%' => $this->uploadedFile['name'])));
            }else{
                $this->validator->error('uploadError', Language::System("form.validation.error.field.file.uploadError")
                    ->string(true)->replace_k2v(array('%file%' => $this->uploadedFile['name'], '%code%' => $this->uploadedFile['error'])));
            }

            if($this->uploadedFile['error'] == 4 && $this->validator->getFieldAttribute('required')){
                $this->validator->error('uploadError4' . $this->fileIndex, Language::System("form.validation.error.field.file.uploadError4")
                    ->string(true)->replace_k2v(array('%file%' => $this->uploadedFile['name'])));
            }
        }
        return $this;
    }

    public function validateMinSize()
    {
        if($minSize = $this->validator->getFieldAttribute('min-size')){
            if($this->uploadedFile['size'] < $minSize){
                $this->validator->error('minSize' . $this->fileIndex, Language::System('form.validation.error.field.file.minSize')
                    ->string(true)->replace_k2v(array('%file%' => $this->uploadedFile['name'], '%size%' => $this->uploadedFile['size'], '%need%' => $minSize)));
            }
        }
        return $this;
    }

    public function validateMaxSize()
    {
        if($maxSize = $this->validator->getFieldAttribute('max-size')){
            if($this->uploadedFile['size'] > $maxSize){
                $this->validator->error('maxSize' . $this->fileIndex, Language::System('form.validation.error.field.file.maxSize')
                    ->string(true)->replace_k2v(array('%file%' => $this->uploadedFile['name'], '%size%' => $this->uploadedFile['size'], '%need%' => $maxSize)));
            }
        }
        return $this;
    }

    public function validateAccepts()
    {
        if($accept = $this->validator->getFieldAttribute('accept')){
            if(isset($this->uploadedFile['tmp_name']) && !empty($this->uploadedFile['tmp_name']) && class_exists('finfo')){
                $fileInfo = new finfo(FILEINFO_MIME);
                $mime = $fileInfo->file($this->uploadedFile['tmp_name']);
                $mime = preg_replace("#;\s+charset=.*?$#usim", '', $mime);

                if(!in_array($mime, $accept)){
                    $this->validator->error('notAccept' . $this->fileIndex, Language::System("form.validation.error.field.file.notAccept")
                        ->string(true)->replace_k2v(array('%mime%' => $mime, '%field%' => $this->validator->getFieldProperty('name'))));
                }
            }

            if(!in_array($this->uploadedFile['type'], $accept)){
                $this->validator->error('notAccept' . $this->fileIndex, Language::System("form.validation.error.field.file.notAccept")
                    ->string(true)->replace_k2v(array('%mime%' => $this->uploadedFile['type'], '%field%' => $this->validator->getFieldProperty('name'))));
            }
        }
        return $this;
    }
}