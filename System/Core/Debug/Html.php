<?php

namespace System\Core\Debug;

use System\Core\Config;
use System\Core\Response;
use System\Core\Language;
use System\Helpers\Classes\Fs;

use function web\render;

class Html
{
    protected $message = '';

    protected $arguments = array(
        'code' => 0,
        'file' => '',
        'line' => '',
        'class' => '',
        'method' => '',
        'message' => '',
        'context' => '',
        'backtrace' => array(),
        'arguments' => array(),
        'isCritical' => false,
    );

    public function __construct(array $arguments)
    {
        $this->arguments = $arguments;

        $this->arguments['header'] = Language::System("error.error_code_{$this->arguments['code']}")->read(' UNKNOWN CRITICAL ERROR! ');
        $this->arguments['header'] = mb_strtoupper($this->arguments['header']);
    }

    public function render()
    {
        if(Config::general('debug')->read()){
            $templateFile = Fs::server()->theme("assets/errors/debugError500.html");
            if(file_exists($templateFile)){
                exit(render($templateFile, $this->arguments));
            }
        }
        if($this->arguments['isCritical']){
            $templateFile = Fs::server()->theme("assets/errors/simple-error.html");
            if(file_exists($templateFile)){
                exit(render($templateFile, $this->arguments));
            }
        }
        Response::code(500);
    }
}