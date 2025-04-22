<?php

namespace System\Core;

use System\Helpers\Classes\Files;
use System\Helpers\Classes\ArrayManager;

/**
 * Class Request
 * @package System\Core
 * @method static|ArrayManager files($key = null)
 * @method static|ArrayManager cookies($key = null)
 * @method static|ArrayManager headers($key = null)
 * @method static|ArrayManager request($key = null)
 */
class Request
{
    protected static $request = array();

    public static function __callStatic($key, $arguments)
    {
        $arrayManager = new ArrayManager($key, self::$request[$key]);
        if(isset($arguments[0])){
            return $arrayManager->key($arguments[0]);
        }
        return $arrayManager;
    }

    public function __call($key, $arguments)
    {
        return self::__callStatic($key, $arguments);
    }

    public static function getRequests()
    {
        return self::$request;
    }

    public static function getRequest($key)
    {
        return isset(self::$request[$key]) ? self::$request[$key] : null;
    }

    public function __construct()
    {
    }

    public function initialize()
    {
        $this->setCookies($_COOKIE);
        $this->setHeaders(apache_request_headers());
        $this->setRequest($_REQUEST);

        $filesObject = new Files($_FILES);
        $filesObject->setRequiredKeys('name', 'type', 'tmp_name', 'error', 'size');
        $filesObject->prepare();

        $this->setFiles($filesObject->output());
        return $this;
    }

    public function setFiles($files)
    {
        self::$request['files'] = $files;
        return $this;
    }

    public function setCookies($cookies)
    {
        self::$request['cookies'] = $cookies;
        return $this;
    }

    public function setRequest($request)
    {
        self::$request['request'] = $request;
        return $this;
    }

    public function setHeaders($headers)
    {
        foreach($headers as $key => $value){
            $key = mb_strtolower($key);
            self::$request['headers'][$key] = $value;
        }
        return $this;
    }
}