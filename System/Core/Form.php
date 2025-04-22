<?php

namespace System\Core;

use System\Core\Form\Fields;
use System\Core\Form\Validator;
use System\Core\Form\Captcha\Captcha;
use System\Core\Form\Interfaces\FormInterface;
use System\Core\Form\Interfaces\CaptchaInterface;
use System\Core\Form\Interfaces\ValidatorInterface;

use function encrypt\csrf;
use function strings\generate;
use function web\templateRoot;

/**
 * Class Form
 * @package System\Core
 * @method Form accept($value)
 * @method Form accept_charset($value)
 * @method Form action($value)
 * @method Form autoComplete(bool $value)
 * @method Form encType($value = Form::ENC_TYPE_X_WWW_FORM)
 * @method Form method($value = 'POST')
 * @method Form name($value)
 * @method Form noValidate(bool $value)
 * @method Form rel($value)
 * @method Form target($value)
 * @method Form class($value = 'form-class')
 * @method Form id($value)
 */
class Form implements FormInterface
{
    const ENC_TYPE_X_WWW_FORM = 'application/x-www-form-urlencoded';
    const ENC_TYPE_MULTIPART = 'multipart/form-data';
    const ENC_TYPE_PLAIN = 'text/plain';

    const TARGET_TOP = '_top';
    const TARGET_SELF = '_self';
    const TARGET_BLANK = '_blank';
    const TARGET_PARENT = '_parent';

    protected $csrfTokenName;

    protected $valid = true;

    protected $form = array(
        'name' => '',
        'title' => null,
        'template' => 'assets/system/form.html',
        'description' => null,
        'fields' => array(),
        'attributes' => array(
            'accept' => '',
            'accept_charset' => '',
            'action' => '',
            'autoComplete' => 'on',
            'encType' => self::ENC_TYPE_X_WWW_FORM,
            'method' => 'POST',
            'name' => '',
            'noValidate' => false,
            'rel' => '',
            'target' => '',
            'class' => 'simple-form form-class',
            'id' => 'simple-form',
        ),
        'errors' => array()
    );

    public function __call($name, $arguments)
    {
        $argument = '';
        if(isset($arguments[0])){
            $argument = $arguments[0];
        }
        $this->form['attributes'][$name] = $argument;
        return $this;
    }

    public function __construct($formName)
    {
        if($this->form['name'] = $formName){
            $this->name($this->form['name'])
                ->id($this->form['name'])
                ->class("{$formName}-simple-form {$formName}-form-class simple-form form-class");
        }
    }

    /**
     * @param $url
     * @param callable|Fields $callback
     * @return $this
     */
    public function create($url, callable $callback)
    {
        $this->action($url);
        $fieldsObject = new Fields($this->form['fields']);

        call_user_func($callback, $fieldsObject);

        if(!isset($this->form['fields']['submit'])){
            $fieldsObject->input('submit', 'buttons')
                ->submit(Language::System('form.field.submitValue')->returnKey())
                ->class('submit-button');
        }

        return $this;
    }

    public function validate()
    {
        /** @var ValidatorInterface $validator */

        foreach($this->form['fields'] as $fieldName => &$fieldOptions){
            $validator = new Validator($fieldName, $fieldOptions, $this);
            $validator->validate();
        }

        return $this;
    }

    public function title($value)
    {
        $this->form['title'] = $value;
        return $this;
    }

    public function template($value)
    {
        $this->form['template'] = $value;
        return $this;
    }

    public function description($value)
    {
        $this->form['description'] = $value;
        return $this;
    }

    public function getForm()
    {
        return $this->form;
    }

    public function valid()
    {
        return $this->valid;
    }

    public function error($field, $key, $error)
    {
        $this->valid = false;

        $this->form['errors'][$field][$key] = $error;
        return $this;
    }

    public static function getCsrfToken($fieldName, $length = 32)
    {
        if(!Session::system('csrfs')->key($fieldName)->set($value)->exists()){
            $value = generate($length);
            Session::system('csrfs')->key($fieldName)->write($value);
            Session::system('csrfs')->key("{$fieldName}_exp")->write(time());
            return csrf($value);
        }

        $expTime = Session::system('csrfs')->key("{$fieldName}_exp")->read(0);
        $maxLifeTime = Config::security('csrfTokenExpiryTime')->read(0);

        if($expTime + $maxLifeTime < time()){
            Session::system('csrfs')->key($fieldName)->delete();
            return self::getCsrfToken($fieldName);
        }

        Session::system('csrfs')->key("{$fieldName}_exp")->write(time());
        return csrf($value);
    }

    public static function getCaptchaImage($fieldName)
    {
        /** @var CaptchaInterface $captcha */

        if(is_array($length = Config::security('captcha')->key('captchaLength')->read(6))){
            $length = rand(...$length);
        }

        if(is_array($fontSize = Config::security('captcha')->key('captchaFontSize')->read(100))){
            $fontSize = rand(...$fontSize);
        }

        if(is_array($quality = Config::security('captcha')->key('captchaImageQuality')->read(100))){
            $quality = rand(...$quality);
        }

        $defaultChars = range('A', 'Z');
        if(!is_array($chars = Config::security('captcha')->key('captchaCharsArray')->read())){
            $chars = $defaultChars;
        }

        $captchaText = generate($length, $chars);
        $captchaText = mb_strtoupper($captchaText);
        Session::system('captchaValues')->key($fieldName)->write($captchaText);

        if(is_array($captchaClass = Config::security('captcha')->key('captchaClass')->read(Captcha::class))){
            $captchaClass = rand(...$captchaClass);
        }

        $captcha = new $captchaClass($captchaText, $fontSize);

        return $captcha->generate()
            ->get($quality);
    }
}