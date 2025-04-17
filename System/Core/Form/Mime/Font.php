<?php

namespace System\Core\Form\Mime;
/**
 * Class Font
 * @package System\Core\Form\Mime
 * @method Font Collection()
 * @method Font otf()
 * @method Font ttf()
 * @method Font woff()
 * @method Font woff2()
 */
class Font extends Common
{
    protected $mime;

    protected $collection;

    protected $availableTypes = array(
        'collection' => 'collection',
        'otf' => 'otf',
        'ttf' => 'ttf',
        'woff' => 'woff',
        'woff2' => 'woff2',
    );
}