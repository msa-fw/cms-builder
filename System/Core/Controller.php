<?php

namespace System\Core;

use System\Core\Response\Builders\Pagination;
use System\Core\Router\RouterGetterInterface;
use System\Core\Form\Interfaces\FormInterface;
use System\Helpers\Classes\ArrayManager;

class Controller
{
    protected $limit = 30;

    protected $offset = 0;

    protected $model;
    /** @var  FormInterface */
    protected $form;
    /** @var  RouterGetterInterface  */
    protected $router;
    /** @var  ArrayManager */
    protected $content;
    /** @var  ArrayManager  */
    protected $controller;
    /**
     * Deprecate undefined Request Methods
     * @param $name
     * @param $arguments
     * @return bool
     */
    public function __call($name, $arguments)
    {
        return false;
    }

    public function __construct(RouterGetterInterface $router)
    {
        $this->router = $router;
        $this->content = Response::response('content');
        $this->controller = Response::response('controller');

        $this->limit = Config::general('paginateLimit')->read($this->limit);
        $this->offset = Request::request('offset')->type(ArrayManager::TYPE_INT)->read($this->offset);

        $this->setBaseResponseInfoOfController();
    }

    protected function setBaseResponseInfoOfController()
    {
        $this->controller->key('controller')->write($this->router->getControllerName());
        $this->controller->key('action')->write($this->router->getActionName());
        return $this;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getRouter()
    {
        return $this->router;
    }

    protected function setForm()
    {
        Response::response('form')
            ->write($this->form->getForm());

        return $this;
    }

    protected function paginate($total)
    {
        $pagination = new Pagination($this->limit, $this->offset);
        $pagination->totalItems($total);
        return $pagination;
    }
}