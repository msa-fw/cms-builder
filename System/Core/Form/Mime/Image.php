<?php

namespace System\Core\Form\Mime;

/**
 * Class Image
 * @package System\Core\Form\Mime
 * @method Image aces()
 * @method Image apng()
 * @method Image astc()
 * @method Image avci()
 * @method Image avcs()
 * @method Image avif()
 * @method Image avifSequence()
 * @method Image bmp()
 * @method Image cdr()
 * @method Image cgm()
 * @method Image dicomRle()
 * @method Image emf()
 * @method Image faxG3()
 * @method Image fits()
 * @method Image g3fax()
 * @method Image gif()
 * @method Image heic()
 * @method Image heicSequence()
 * @method Image heif()
 * @method Image heifSequence()
 * @method Image hej2k()
 * @method Image hsj2()
 * @method Image ico()
 * @method Image icon()
 * @method Image ief()
 * @method Image jls()
 * @method Image jp2()
 * @method Image jpeg()
 * @method Image jpeg2000()
 * @method Image jpeg2000Image()
 * @method Image jph()
 * @method Image jphc()
 * @method Image jpm()
 * @method Image jpx()
 * @method Image jxl()
 * @method Image jxr()
 * @method Image jxra()
 * @method Image jxrs()
 * @method Image jxs()
 * @method Image jxsc()
 * @method Image jxsi()
 * @method Image jxss()
 * @method Image ktx()
 * @method Image ktx2()
 * @method Image openRaster()
 * @method Image pdf()
 * @method Image photoShop()
 * @method Image oJpeg()
 * @method Image png()
 * @method Image prsBTif()
 * @method Image prsPti()
 * @method Image psd()
 * @method Image qoi()
 * @method Image rle()
 * @method Image sgi()
 * @method Image svg()
 * @method Image svgXml()
 * @method Image svgXmlCompressed()
 * @method Image t38()
 * @method Image targa()
 * @method Image tga()
 * @method Image tiff()
 * @method Image tiffFx()
 * @method Image vndAdobePhotoshop()
 * @method Image vndAirzipAcceleratorAzv()
 * @method Image vndDeceGraphic()
 * @method Image vndDjvu()
 * @method Image vndDjvuMultipage()
 * @method Image vndDvbSubtitle()
 * @method Image vndDwg()
 * @method Image vndDxf()
 * @method Image vndFastbidsheet()
 * @method Image vndFpx()
 * @method Image vndFst()
 * @method Image vndFujixeroxEdmicsMmr()
 * @method Image vndFujixeroxEdmicsRlc()
 * @method Image vndMicrosoftIcon()
 * @method Image vndMozillaApng()
 * @method Image vndMsDds()
 * @method Image vndMsModi()
 * @method Image vndMsPhoto()
 * @method Image vndNetFpx()
 * @method Image vndPcoB16()
 * @method Image vndRnRealpix()
 * @method Image vndTencentTap()
 * @method Image vndValveSourceTexture()
 * @method Image vndWapWbmp()
 * @method Image vndXiff()
 * @method Image vndZbrushPcx()
 * @method Image webp()
 * @method Image wmf()
 * @method Image x3ds()
 * @method Image xAdobeDng()
 * @method Image xApplixGraphics()
 * @method Image xBmp()
 * @method Image xBzeps()
 * @method Image xCanonCr2()
 * @method Image xCanonCr3()
 * @method Image xCanonCrw()
 * @method Image xCdr()
 * @method Image xCmuRaster()
 * @method Image xCmx()
 * @method Image xCompressedXcf()
 * @method Image xDds()
 * @method Image x_Djvu()
 * @method Image xDjvu()
 * @method Image xEmf()
 * @method Image xEps()
 * @method Image xExr()
 * @method Image xFits()
 * @method Image xFreehand()
 * @method Image xFujiRaf()
 * @method Image xGimpGbr()
 * @method Image xGimpGih()
 * @method Image xGimpPat()
 * @method Image xGzeps()
 * @method Image xIcb()
 * @method Image xIcns()
 * @method Image xIco()
 * @method Image xIcon()
 * @method Image xIff()
 * @method Image xIlbm()
 * @method Image xJng()
 * @method Image xJp2Codestream()
 * @method Image xJpeg2000Image()
 * @method Image xKodakDcr()
 * @method Image xKodakK25()
 * @method Image xKodakKdc()
 * @method Image xLwo()
 * @method Image xLws()
 * @method Image xMacpaint()
 * @method Image xMinoltaMrw()
 * @method Image xMrsidImage()
 * @method Image xMsBmp()
 * @method Image xMsod()
 * @method Image xNikonNef()
 * @method Image xNikonNrw()
 * @method Image xOlympusOrf()
 * @method Image xPanasonicRaw()
 * @method Image xPanasonicRaw2()
 * @method Image xPanasonicRw()
 * @method Image xPanasonicRw2()
 * @method Image xPcx()
 * @method Image xPentaxPef()
 * @method Image xPhotoCd()
 * @method Image xPhotoshop()
 * @method Image xPict()
 * @method Image xPortableAnymap()
 * @method Image xPortableBitmap()
 * @method Image xPortableGraymap()
 * @method Image xPortablePixmap()
 * @method Image xPsd()
 * @method Image xQuicktime()
 * @method Image xRgb()
 * @method Image xSgi()
 * @method Image xSigmaX3f()
 * @method Image xSkencil()
 * @method Image xSonyArw()
 * @method Image xSonySr2()
 * @method Image xSonySrf()
 * @method Image xSunRaster()
 * @method Image xTarga()
 * @method Image xTga()
 * @method Image xWinBitmap()
 * @method Image xWinMetafile()
 * @method Image xWmf()
 * @method Image xXbitmap()
 * @method Image xXcf()
 * @method Image xXfig()
 * @method Image xXpixmap()
 * @method Image xXpm()
 * @method Image xXwindowdump()
 */
class Image extends Common
{
    protected $mime;

    protected $collection;

    protected $availableTypes = array(
        'aces' => 'aces',
        'apng' => 'apng',
        'astc' => 'astc',
        'avci' => 'avci',
        'avcs' => 'avcs',
        'avif' => 'avif',
        'avifsequence' => 'avif-sequence',
        'bmp' => 'bmp',
        'cdr' => 'cdr',
        'cgm' => 'cgm',
        'dicomrle' => 'dicom-rle',
        'emf' => 'emf',
        'faxg3' => 'fax-g3',
        'fits' => 'fits',
        'g3fax' => 'g3fax',
        'gif' => 'gif',
        'heic' => 'heic',
        'heicsequence' => 'heic-sequence',
        'heif' => 'heif',
        'heifsequence' => 'heif-sequence',
        'hej2k' => 'hej2k',
        'hsj2' => 'hsj2',
        'ico' => 'ico',
        'icon' => 'icon',
        'ief' => 'ief',
        'jls' => 'jls',
        'jp2' => 'jp2',
        'jpeg' => 'jpeg',
        'jpeg2000' => 'jpeg2000',
        'jpeg2000image' => 'jpeg2000-image',
        'jph' => 'jph',
        'jphc' => 'jphc',
        'jpm' => 'jpm',
        'jpx' => 'jpx',
        'jxl' => 'jxl',
        'jxr' => 'jxr',
        'jxra' => 'jxra',
        'jxrs' => 'jxrs',
        'jxs' => 'jxs',
        'jxsc' => 'jxsc',
        'jxsi' => 'jxsi',
        'jxss' => 'jxss',
        'ktx' => 'ktx',
        'ktx2' => 'ktx2',
        'openraster' => 'openraster',
        'pdf' => 'pdf',
        'photoshop' => 'photoshop',
        'pjpeg' => 'pjpeg',
        'png' => 'png',
        'prsbtif' => 'prs.btif',
        'prspti' => 'prs.pti',
        'psd' => 'psd',
        'qoi' => 'qoi',
        'rle' => 'rle',
        'sgi' => 'sgi',
        'svg' => 'svg',
        'svgxml' => 'svg+xml',
        'svgxmlcompressed' => 'svg+xml-compressed',
        't38' => 't38',
        'targa' => 'targa',
        'tga' => 'tga',
        'tiff' => 'tiff',
        'tifffx' => 'tiff-fx',
        'vndadobephotoshop' => 'vnd.adobe.photoshop',
        'vndairzipacceleratorazv' => 'vnd.airzip.accelerator.azv',
        'vnddecegraphic' => 'vnd.dece.graphic',
        'vnddjvu' => 'vnd.djvu',
        'vnddjvumultipage' => 'vnd.djvu+multipage',
        'vnddvbsubtitle' => 'vnd.dvb.subtitle',
        'vnddwg' => 'vnd.dwg',
        'vnddxf' => 'vnd.dxf',
        'vndfastbidsheet' => 'vnd.fastbidsheet',
        'vndfpx' => 'vnd.fpx',
        'vndfst' => 'vnd.fst',
        'vndfujixeroxedmicsmmr' => 'vnd.fujixerox.edmics-mmr',
        'vndfujixeroxedmicsrlc' => 'vnd.fujixerox.edmics-rlc',
        'vndmicrosofticon' => 'vnd.microsoft.icon',
        'vndmozillaapng' => 'vnd.mozilla.apng',
        'vndmsdds' => 'vnd.ms-dds',
        'vndmsmodi' => 'vnd.ms-modi',
        'vndmsphoto' => 'vnd.ms-photo',
        'vndnetfpx' => 'vnd.net-fpx',
        'vndpcob16' => 'vnd.pco.b16',
        'vndrnrealpix' => 'vnd.rn-realpix',
        'vndtencenttap' => 'vnd.tencent.tap',
        'vndvalvesourcetexture' => 'vnd.valve.source.texture',
        'vndwapwbmp' => 'vnd.wap.wbmp',
        'vndxiff' => 'vnd.xiff',
        'vndzbrushpcx' => 'vnd.zbrush.pcx',
        'webp' => 'webp',
        'wmf' => 'wmf',
        'x3ds' => 'x-3ds',
        'xadobedng' => 'x-adobe-dng',
        'xapplixgraphics' => 'x-applix-graphics',
        'xbmp' => 'x-bmp',
        'xbzeps' => 'x-bzeps',
        'xcanoncr2' => 'x-canon-cr2',
        'xcanoncr3' => 'x-canon-cr3',
        'xcanoncrw' => 'x-canon-crw',
        'xcdr' => 'x-cdr',
        'xcmuraster' => 'x-cmu-raster',
        'xcmx' => 'x-cmx',
        'xcompressedxcf' => 'x-compressed-xcf',
        'xdds' => 'x-dds',
        'x_djvu' => 'x-djvu',
        'xdjvu' => 'x.djvu',
        'xemf' => 'x-emf',
        'xeps' => 'x-eps',
        'xexr' => 'x-exr',
        'xfits' => 'x-fits',
        'xfreehand' => 'x-freehand',
        'xfujiraf' => 'x-fuji-raf',
        'xgimpgbr' => 'x-gimp-gbr',
        'xgimpgih' => 'x-gimp-gih',
        'xgimppat' => 'x-gimp-pat',
        'xgzeps' => 'x-gzeps',
        'xicb' => 'x-icb',
        'xicns' => 'x-icns',
        'xico' => 'x-ico',
        'xicon' => 'x-icon',
        'xiff' => 'x-iff',
        'xilbm' => 'x-ilbm',
        'xjng' => 'x-jng',
        'xjp2codestream' => 'x-jp2-codestream',
        'xjpeg2000image' => 'x-jpeg2000-image',
        'xkodakdcr' => 'x-kodak-dcr',
        'xkodakk25' => 'x-kodak-k25',
        'xkodakkdc' => 'x-kodak-kdc',
        'xlwo' => 'x-lwo',
        'xlws' => 'x-lws',
        'xmacpaint' => 'x-macpaint',
        'xminoltamrw' => 'x-minolta-mrw',
        'xmrsidimage' => 'x-mrsid-image',
        'xmsbmp' => 'x-ms-bmp',
        'xmsod' => 'x-msod',
        'xnikonnef' => 'x-nikon-nef',
        'xnikonnrw' => 'x-nikon-nrw',
        'xolympusorf' => 'x-olympus-orf',
        'xpanasonicraw' => 'x-panasonic-raw',
        'xpanasonicraw2' => 'x-panasonic-raw2',
        'xpanasonicrw' => 'x-panasonic-rw',
        'xpanasonicrw2' => 'x-panasonic-rw2',
        'xpcx' => 'x-pcx',
        'xpentaxpef' => 'x-pentax-pef',
        'xphotocd' => 'x-photo-cd',
        'xphotoshop' => 'x-photoshop',
        'xpict' => 'x-pict',
        'xportableanymap' => 'x-portable-anymap',
        'xportablebitmap' => 'x-portable-bitmap',
        'xportablegraymap' => 'x-portable-graymap',
        'xportablepixmap' => 'x-portable-pixmap',
        'xpsd' => 'x-psd',
        'xquicktime' => 'x-quicktime',
        'xrgb' => 'x-rgb',
        'xsgi' => 'x-sgi',
        'xsigmax3f' => 'x-sigma-x3f',
        'xskencil' => 'x-skencil',
        'xsonyarw' => 'x-sony-arw',
        'xsonysr2' => 'x-sony-sr2',
        'xsonysrf' => 'x-sony-srf',
        'xsunraster' => 'x-sun-raster',
        'xtarga' => 'x-targa',
        'xtga' => 'x-tga',
        'xwinbitmap' => 'x-win-bitmap',
        'xwinmetafile' => 'x-win-metafile',
        'xwmf' => 'x-wmf',
        'xxbitmap' => 'x-xbitmap',
        'xxcf' => 'x-xcf',
        'xxfig' => 'x-xfig',
        'xxpixmap' => 'x-xpixmap',
        'xxpm' => 'x-xpm',
        'xxwindowdump' => 'x-xwindowdump',
    );
}