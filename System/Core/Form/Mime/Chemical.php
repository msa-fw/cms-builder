<?php

namespace System\Core\Form\Mime;
/**
 * Class Chemical
 * @package System\Core\Form\Mime
 * @method Chemical xCdx()
 * @method Chemical xCif()
 * @method Chemical xCmdf()
 * @method Chemical xCml()
 * @method Chemical xCsml()
 * @method Chemical xPdb()
 * @method Chemical xXyz()
 */
class Chemical extends Common
{
    protected $mime;

    protected $collection;

    protected $availableTypes = array(
        'xcdx' => 'x-cdx',
        'xcif' => 'x-cif',
        'xcmdf' => 'x-cmdf',
        'xcml' => 'x-cml',
        'xcsml' => 'x-csml',
        'xpdb' => 'x-pdb',
        'xxyz' => 'x-xyz',
    );
}