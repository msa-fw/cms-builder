<?php

namespace System\Core\Form\Mime;

/**
 * Class ZzApplication
 * @package System\Core\Form\Mime
 * @method X-epoc XSisxApp()
 * @method ZzApplication zzWinAssoc123()
 * @method ZzApplication zzWinAssocCab()
 * @method ZzApplication zzWinAssocCdr()
 * @method ZzApplication zzWinAssocDoc()
 * @method ZzApplication zzWinAssocHlp()
 * @method ZzApplication zzWinAssocMdb()
 * @method ZzApplication zzWinAssocUu()
 * @method ZzApplication zzWinAssocXls()
 */
class ZzApplication extends Common
{
    protected $mime;

    protected $collection;

    protected $availableTypes = array(
        'zzwinassoc123' => 'zz-winassoc-123',
        'zzwinassoccab' => 'zz-winassoc-cab',
        'zzwinassoccdr' => 'zz-winassoc-cdr',
        'zzwinassocdoc' => 'zz-winassoc-doc',
        'zzwinassochlp' => 'zz-winassoc-hlp',
        'zzwinassocmdb' => 'zz-winassoc-mdb',
        'zzwinassocuu' => 'zz-winassoc-uu',
        'zzwinassocxls' => 'zz-winassoc-xls',
    );
}