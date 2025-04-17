<?php

namespace Controllers\_Controller_\Forms;

use System\Core\Form;
use System\Core\Request;
use System\Core\Form\Fields;
use System\Core\Form\Statics\Mime;
use System\Helpers\Classes\ArrayManager;
use Controllers\_Controller_\Actions\_Action_Action;

use System\Core\Form\Statics\Extension as E;

use function response\url;

class _Action_Form extends Form
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

    public function createForm()
    {
        $this->encType(Form::ENC_TYPE_MULTIPART);
        $this->title('simple form title');
        $this->description('simple form description');
        $this->noValidate(true);

        $this->create(url(_Action_Action::class)->build()->get(), function(Fields $field){
            $field->csrf('csrf')->value($this->request->key('csrf')->string()->htmlspecialchars())->required(true);

            $field->input('login')->email()->value($this->request->key('login')->string()->htmlspecialchars())->required(true)
                ->append()->description('description')->label('label');

            $field->input('password')->password()->value($this->request->key('password')->string()->htmlspecialchars())->required(true)
                ->append()->description('description')->label('label');

            $field->input('file', 'file')->file($this->files->key('file')->array()->raw())
                ->accept(function(Mime $mime){
                    $mime->text()->javascript()->jscript();
                })->extensions(E::png(), E::jpg(), E::jpeg(), E::webp(), E::bmp())
                ->required(true)->multiple(1)->minSize(1024000)->maxSize(1023)
                ->append()->description('ddd')->label('dds');

            $field->input('file1', 'file')->file($this->files->key('file1')->array()->raw())
                ->required(true)->append()->description('ddd')->label('dds');

            $field->captcha('captchaField')->required(1)->value($this->request->key('captchaField')->string()->htmlspecialchars());

            $field->html('content')->attribute()->required(1)->value($this->request->key('content')->string()->htmlspecialchars())->append();

            $field->textArea('text')->attribute()->required(1)->value($this->request->key('text')->string()->htmlspecialchars())->append();
        });

        return $this;
    }
}