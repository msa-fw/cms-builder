<?php

namespace Controllers\_BaseController_\Actions;

use function response\url;
use System\Core\Form\Fields;
use Controllers\_BaseController_\Controller;
use Controllers\_BaseController_\Forms\IndexForm;
use Controllers\_BaseController_\Models\IndexModel;
use System\Core\Router\RouterGetterInterface;

class IndexAction extends Controller
{
    /** @var  IndexForm */
    protected $form;

    protected $limit = 10;

    protected $offset = 0;

    public function __construct(RouterGetterInterface $router)
    {
        parent::__construct($router);

        $this->model = new IndexModel();

        $this->form = new IndexForm('simple');
    }

    public function get()
    {
        if($items = $this->model->selectList($this->limit, $this->offset)){
            $this->paginate($this->model->total());
            $this->content->write($items);
        }

        $this->form->create('', function(Fields $field){
            $field->html('d')->wysiwyg();
        });
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