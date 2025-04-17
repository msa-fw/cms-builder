<?php

namespace Controllers\_BaseController_\Forms;

use System\Core\Form;
use System\Core\Request;
use System\Core\Form\Fields;
use System\Core\Form\Statics\Mime;
use System\Helpers\Classes\ArrayManager;
use Controllers\_BaseController_\Actions\IndexAction;

use System\Core\Form\Statics\Extension as E;

use function response\url;

class IndexForm extends Form
{
    protected $csrfTokenName;

    /** @var ArrayManager */
    protected $files;
    /** @var ArrayManager */
    protected $request;

    public function __construct($formName = null)
    {
        parent::__construct($formName);

        $this->files = Request::files($formName);
        $this->request = Request::request($formName);
    }
}