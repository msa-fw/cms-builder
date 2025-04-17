<?php

namespace System\Core\Form\Mime;

/**
 * Class FlvApplication
 * @package System\Core\Form\Mime
 * @method FlvApplication octetStream()
 */
class FlvApplication extends Common
{
    protected $mime;

    protected $collection;

    protected $availableTypes = array(
        'octetstream' => 'octet-stream',
    );
}