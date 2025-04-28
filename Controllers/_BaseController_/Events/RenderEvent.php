<?php

namespace Controllers\_BaseController_\Events;

use Controllers\_BaseController_\Config;
use function response\compressHtml;
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
            $content = $this->render->getDataContentResult();
            $content = compressHtml($content);
            $this->render->setDataContentResult($content);
            return $this;
        }
        return false;
    }
}