<?php

namespace Controllers\_BaseController_;

use System\Core\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * For any request methods, if needed
     * @see \System\Core\Router::executeController()
     * @see \System\Core\Router\Builder::action()
     * @return $this
     */
    public function custom()
    {
        return $this;
    }
}