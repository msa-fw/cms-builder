<?php

namespace Controllers\_BaseController_\Events;

use Controllers\_BaseController_\Config;
use System\Core\Template\Interfaces\RenderInterface;

class RenderEvent
{
    /** @var  RenderInterface */
    protected $render;

    public function __construct(RenderInterface $render)
    {
        $this->render = $render;
    }

    public function compressHtmlContent()
    {
        if(Config::template('compressHtml')->read()){
            $content = str_replace(array("\n","\r","\t"), '', $this->render->getDataContentResult());
            $content = preg_replace(array('/<!--(.*)-->/Uis',"/[[:blank:]]+/"), array('',' '), $content);
            $this->render->setDataContentResult($content);
            return $this;
        }
        return false;
    }
}