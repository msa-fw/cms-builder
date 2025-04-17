<?php

namespace System\Core;

use System\Core\Template\Interfaces\RenderInterface;

class Template
{
    protected static $generationTime;

    protected $accept;

    protected $lowerAcceptMethods = array();

    protected $upperAcceptMethods = array();
    /** @var  RenderInterface */
    protected $responseContentRender;

    public function __construct($accept)
    {
        self::$generationTime = microtime(true);
        $this->accept($accept);
    }

    public function sendHeaders()
    {
        $responseCode = Response::code();

        if(isset(Response::HTTP_RESPONSE_CODES[$responseCode])){
            $responseStatus = Response::HTTP_RESPONSE_CODES[$responseCode];

            http_response_code($responseCode);
            header("Status: $responseCode $responseStatus");
        }

        foreach(Response::getResponse('header') as $key => $value){
            header("{$key}: {$value}");
        }
    }

    public function sendCookies()
    {
        foreach(Response::getResponse('cookie') as $key => $cookie){
            if($cookie['lifeTime']){
                $cookie['lifeTime'] = time()+$cookie['lifeTime'];
            }
            setcookie($cookie['name'], $cookie['value'], $cookie['lifeTime'], $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httpOnly']);
        }
    }

    public function initialize()
    {
        if($headerChunks = preg_split("#[;,]#sm", $this->accept, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY)){
            array_map(function($value){
                $temp = explode('/', $value);

                if(isset($temp[1])){
                    $value = $temp[1];

                    $value = preg_replace("#[^\w]#", '_', $value);
                    $value = trim($value, '_');

                    if($value){
                        $this->lowerAcceptMethods[] = mb_strtolower($value);
                        $this->upperAcceptMethods[] = mb_strtoupper($value);
                    }
                }
            }, $headerChunks);
        }
        return $this;
    }

    public function render()
    {
        $allowedMethods = Config::template('allowedRenders')->read(array());

        foreach($this->upperAcceptMethods as $acceptMethod){
            if($className = $this->getAllowedMethod($acceptMethod, $allowedMethods)){
                if(class_exists($className)){
                    $this->responseContentRender = new $className();
                    return true;
                }
            }
        }

        if($defaultRenderClass = Config::template('defaultRenderClass')->read(array())){
            $this->responseContentRender = new $defaultRenderClass();
            return true;
        }
        return false;
    }

    protected function getAllowedMethod($acceptMethod, $allowedMethods)
    {
        foreach($allowedMethods as $method){
            if(preg_match("#\\\\$acceptMethod$#usim", $method)){
                return $method;
            }
        }
        return false;
    }

    public function accept($accept)
    {
        $this->accept = $accept;
        return $this;
    }

    /**
     * @return RenderInterface
     */
    public function getRenderObject()
    {
        return $this->responseContentRender;
    }

    public static function getGenTime($compareTime)
    {
        return $compareTime - self::$generationTime;
    }
}