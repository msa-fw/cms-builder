<?php

namespace System\Core\Form\Mime;

/**
 * Class XConference
 * @package System\Core\Form\Mime
 * @method XConference xCooltalk()
 */
class XConference extends Common
{
    protected $mime;

    protected $collection;

    protected $availableTypes = array(
        'xcooltalk' => 'x-cooltalk',
    );
}