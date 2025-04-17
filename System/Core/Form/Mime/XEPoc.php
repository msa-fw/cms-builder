<?php

namespace System\Core\Form\Mime;

/**
 * Class XEPoc
 * @package System\Core\Form\Mime
 * @method XEPoc xSisxApp()
 */
class XEPoc extends Common
{
    protected $mime;

    protected $collection;

    protected $availableTypes = array(
        'xsisxapp' => 'x-sisx-app',
    );
}