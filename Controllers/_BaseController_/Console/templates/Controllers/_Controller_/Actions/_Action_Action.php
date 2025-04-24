<?php

namespace Controllers\_Controller_\Actions;

use Controllers\_Controller_\Controller;
use Controllers\_Controller_\Forms\_Action_Form;
use Controllers\_Controller_\Models\_Action_Model;
use System\Core\Router\RouterGetterInterface;

use function response\url;

class _Action_Action extends Controller
{
    /** @var  _Action_Form */
    protected $form;

    public function __construct(RouterGetterInterface $router)
    {
        parent::__construct($router);

        $this->model = new _Action_Model();

        $this->form = new _Action_Form('simple');

        $this->form->createForm();
    }

    public function get()
    {
        $this->content->write($this->model->selectList(30));

        return $this->setForm();
    }

    public function post()
    {
        $this->form->validate();

        if($this->form->valid()){
            url(self::class)->build()->redirect();
        }

        return $this->setForm();
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