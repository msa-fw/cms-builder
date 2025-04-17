<?php

namespace System\Core\Template\Render;

use System\Core\Response;
use System\Helpers\Classes\ArrayManager;
use System\Core\Template\Interfaces\RenderInterface;

class JSON implements RenderInterface
{
    protected $undefined = array();

    protected $dataContent = '';

    protected $controllerContent = '';

    public function __construct()
    {
        Response::header('Content-Type', 'application/json; charset=utf-8');
    }

    public function renderContent()
    {
        $this->dataContent = json_encode(Response::getResponses(), JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        return $this;
    }

    public function renderController(ArrayManager $manager = null)
    {
        if(Response::code() == 200){
            $this->controllerContent = json_encode(Response::response('content')->read(), JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        }
        return $this;
    }

    public function getDataContentResult()
    {
        return $this->dataContent;
    }

    public function setDataContentResult($content)
    {
        $this->dataContent = $content;
        return $this;
    }

    public function setControllerContentResult($content)
    {
        $this->controllerContent = $content;
        return $this;
    }

    public function getControllerContentResult()
    {
        return $this->controllerContent;
    }
}