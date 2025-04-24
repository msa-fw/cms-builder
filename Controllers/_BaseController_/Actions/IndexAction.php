<?php

namespace Controllers\_BaseController_\Actions;

use Controllers\_BaseController_\Controller;
use Controllers\_BaseController_\Forms\IndexForm;
use Controllers\_BaseController_\Models\IndexModel;
use System\Core\Router\RouterGetterInterface;

class IndexAction extends Controller
{
    /** @var  IndexForm */
    protected $form;

    public function __construct(RouterGetterInterface $router)
    {
        parent::__construct($router);

        $this->model = new IndexModel();

        $this->form = new IndexForm('simple');
    }

    public function get()
    {
        return $this;
    }

    public function post()
    {
        return $this;
    }

    public function head()
    {
        return $this;
    }

    public function put()
    {
        return $this;
    }

    public function delete()
    {
        return $this;
    }

    public function connect()
    {
        return $this;
    }

    public function options()
    {
        return $this;
    }

    public function trace()
    {
        return $this;
    }

    public function patch()
    {
        return $this;
    }
}