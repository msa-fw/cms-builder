<?php

namespace System\Core\Template\Render;

use SimpleXMLElement;
use System\Core\Response;
use System\Helpers\Classes\ArrayManager;
use System\Core\Template\Interfaces\RenderInterface;
use function arrays\array2xml;

class XML implements RenderInterface
{
    protected $undefined = array();

    protected $dataContent = '';

    protected $controllerContent = '';

    public function __construct()
    {
        Response::header('Content-Type', 'application/xml; charset=utf-8');
    }

    public function renderContent()
    {
        $xmlRoot = new SimpleXMLElement('<root/>');

        $content = array2xml($xmlRoot, Response::getResponses());
        $this->dataContent = $content->asXML();

        return $this;
    }

    public function renderController(ArrayManager $manager = null)
    {
        if(Response::code() == 200){
            $xmlRoot = new SimpleXMLElement('<root/>');

            $content = array2xml($xmlRoot, Response::response('content')->read());
            $this->controllerContent = $content->asXML();
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