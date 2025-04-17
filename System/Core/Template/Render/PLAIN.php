<?php

namespace System\Core\Template\Render;

use System\Core\Response;

class PLAIN extends HTML
{
    public function __construct()
    {
        parent::__construct();
        Response::header('Content-Type', 'text/plain; charset=utf-8');
    }
}