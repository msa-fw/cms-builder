<?php

namespace Controllers\_BaseController_\Events;

use System\Core\Request;

class RequestEvent
{
    /** @var  Request */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function fillRequestFromPutData()
    {
        if($putContent = file_get_contents('php://input')){
            parse_str($putContent, $GLOBALS['_PUT']);

            $this->request->setRequest($GLOBALS['_PUT']);
        }
        return $this;
    }
}