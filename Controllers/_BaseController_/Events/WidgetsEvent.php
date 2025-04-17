<?php

namespace Controllers\_BaseController_\Events;

use System\Core\Widget;
use System\Core\Response;
use System\Core\Template\Render\HTML;
use System\Core\Template\Interfaces\RenderInterface;

class WidgetsEvent
{
    /** @var  RenderInterface */
    protected $render;

    public function __construct(RenderInterface $render)
    {
        $this->render = $render;
    }

    public function initializeWidgets()
    {
        $widgets = new Widget();
        $widgets->loadControllersParams("configs/widgets.php");
        return $this;
    }

    public function executeWidgetsForAnotherRenderTypes()
    {
        if(!($this->render instanceof HTML)){

            $allWidgets = Widget::getWidgets();

            foreach($allWidgets as $key => $widgets){

                $launcher = new Widget\Launcher($key, $allWidgets);

                $result = $launcher->runWidgets()->get();

                Response::response('widgets')->key($key)->write($result);
            }
        }
        return $this;
    }
}