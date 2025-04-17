<?php

namespace System\Core\Form\Mime;

/**
 * Class Model
 * @package System\Core\Form\Mime
 * @method Model threeMf()
 * @method Model gltfJson()
 * @method Model gltfBinary()
 * @method Model iges()
 * @method Model mesh()
 * @method Model mtl()
 * @method Model obj()
 * @method Model stepXml()
 * @method Model stepZip()
 * @method Model stepXmlZip()
 * @method Model stl()
 * @method Model vndColladaXml()
 * @method Model vndDwf()
 * @method Model vndGdl()
 * @method Model vndGtw()
 * @method Model vndMts()
 * @method Model vndOpengex()
 * @method Model vndParasolidTransmitBinary()
 * @method Model vndParasolidTransmitText()
 * @method Model vndSapVds()
 * @method Model vndUsdzZip()
 * @method Model vndValveSourceCompiledMap()
 * @method Model vndVtu()
 * @method Model vrml()
 * @method Model xStlAscii()
 * @method Model xStlBinary()
 * @method Model x3dBinary()
 * @method Model x3dFastinfoset()
 * @method Model x3dXml()
 * @method Model x3dVrml()
 * @method Model x3d_Vrml()
 */
class Model extends Common
{
    protected $mime;

    protected $collection;

    protected $availableTypes = array(
        'threemf' => '3mf',
        'gltfjson' => 'gltf+json',
        'gltfbinary' => 'gltf-binary',
        'iges' => 'iges',
        'mesh' => 'mesh',
        'mtl' => 'mtl',
        'obj' => 'obj',
        'stepxml' => 'step+xml',
        'stepzip' => 'step+zip',
        'stepxmlzip' => 'step-xml+zip',
        'stl' => 'stl',
        'vndcolladaxml' => 'vnd.collada+xml',
        'vnddwf' => 'vnd.dwf',
        'vndgdl' => 'vnd.gdl',
        'vndgtw' => 'vnd.gtw',
        'vndmts' => 'vnd.mts',
        'vndopengex' => 'vnd.opengex',
        'vndparasolidtransmitbinary' => 'vnd.parasolid.transmit.binary',
        'vndparasolidtransmittext' => 'vnd.parasolid.transmit.text',
        'vndsapvds' => 'vnd.sap.vds',
        'vndusdzzip' => 'vnd.usdz+zip',
        'vndvalvesourcecompiledmap' => 'vnd.valve.source.compiled-map',
        'vndvtu' => 'vnd.vtu',
        'vrml' => 'vrml',
        'xstlascii' => 'x.stl-ascii',
        'xstlbinary' => 'x.stl-binary',
        'x3dbinary' => 'x3d+binary',
        'x3dfastinfoset' => 'x3d+fastinfoset',
        'x3dxml' => 'x3d+xml',
        'x3dvrml' => 'x3d+vrml',
        'x3d_vrml' => 'x3d-vrml',
    );
}