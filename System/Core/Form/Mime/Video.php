<?php

namespace System\Core\Form\Mime;

/**
 * Class Video
 * @package System\Core\Form\Mime
 * @method Video threeGp()
 * @method Video threeGpp()
 * @method Video threeGppEncrypted()
 * @method Video threeGpp2()
 * @method Video annodex()
 * @method Video avi()
 * @method Video divx()
 * @method Video dv()
 * @method Video fli()
 * @method Video flv()
 * @method Video h261()
 * @method Video h263()
 * @method Video h264()
 * @method Video isoSegment()
 * @method Video jpeg()
 * @method Video jpm()
 * @method Video mj2()
 * @method Video mp2t()
 * @method Video mp4()
 * @method Video mp4vEs()
 * @method Video mpeg()
 * @method Video mpegSystem()
 * @method Video msvideo()
 * @method Video ogg()
 * @method Video quicktime()
 * @method Video vivo()
 * @method Video vndAvi()
 * @method Video vndDeceHd()
 * @method Video vndDeceMobile()
 * @method Video vndDecePd()
 * @method Video vndDeceSd()
 * @method Video vndDeceVideo()
 * @method Video vndDivx()
 * @method Video vndDvbFile()
 * @method Video vndFvt()
 * @method Video vndMpegurl()
 * @method Video vndMsPlayreadyMediaPyv()
 * @method Video vndRadgamettoolsBink()
 * @method Video vndRadgamettoolsSmacker()
 * @method Video vndRnRealvideo()
 * @method Video vndUvvuMp4()
 * @method Video vndVivo()
 * @method Video vndYoutubeYt()
 * @method Video Webm()
 * @method Video xAnim()
 * @method Video xAnnodex()
 * @method Video xAvi()
 * @method Video xF4v()
 * @method Video xFli()
 * @method Video xFlic()
 * @method Video xFlv()
 * @method Video xJavafx()
 * @method Video xM4v()
 * @method Video xMatroska()
 * @method Video xMatroska3d()
 * @method Video xMjpeg()
 * @method Video xMng()
 * @method Video xMpeg()
 * @method Video xMpegSystem()
 * @method Video xMpeg2()
 * @method Video xMpegurl()
 * @method Video xMsAsf()
 * @method Video xMsAsfPlugin()
 * @method Video xMsVob()
 * @method Video xMsWax()
 * @method Video xMsWm()
 * @method Video xMsWmv()
 * @method Video xMsWmx()
 * @method Video xMsWvx()
 * @method Video xMsvideo()
 * @method Video xNsv()
 * @method Video xOgg()
 * @method Video xOgm()
 * @method Video xOgmOgg()
 * @method Video xRealVideo()
 * @method Video xSgiMovie()
 * @method Video xSmv()
 * @method Video xTheora()
 * @method Video xTheoraOgg()
 */
class Video extends Common
{
    protected $mime;

    protected $collection;

    protected $availableTypes = array(
        'threegp' => '3gp',
        'threegpp' => '3gpp',
        'threegppencrypted' => '3gpp-encrypted',
        'threegpp2' => '3gpp2',
        'annodex' => 'annodex',
        'avi' => 'avi',
        'divx' => 'divx',
        'dv' => 'dv',
        'fli' => 'fli',
        'flv' => 'flv',
        'h261' => 'h261',
        'h263' => 'h263',
        'h264' => 'h264',
        'isosegment' => 'iso.segment',
        'jpeg' => 'jpeg',
        'jpm' => 'jpm',
        'mj2' => 'mj2',
        'mp2t' => 'mp2t',
        'mp4' => 'mp4',
        'mp4ves' => 'mp4v-es',
        'mpeg' => 'mpeg',
        'mpegsystem' => 'mpeg-system',
        'msvideo' => 'msvideo',
        'ogg' => 'ogg',
        'quicktime' => 'quicktime',
        'vivo' => 'vivo',
        'vndavi' => 'vnd.avi',
        'vnddecehd' => 'vnd.dece.hd',
        'vnddecemobile' => 'vnd.dece.mobile',
        'vnddecepd' => 'vnd.dece.pd',
        'vnddecesd' => 'vnd.dece.sd',
        'vnddecevideo' => 'vnd.dece.video',
        'vnddivx' => 'vnd.divx',
        'vnddvbfile' => 'vnd.dvb.file',
        'vndfvt' => 'vnd.fvt',
        'vndmpegurl' => 'vnd.mpegurl',
        'vndmsplayreadymediapyv' => 'vnd.ms-playready.media.pyv',
        'vndradgamettoolsbink' => 'vnd.radgamettools.bink',
        'vndradgamettoolssmacker' => 'vnd.radgamettools.smacker',
        'vndrnrealvideo' => 'vnd.rn-realvideo',
        'vnduvvump4' => 'vnd.uvvu.mp4',
        'vndvivo' => 'vnd.vivo',
        'vndyoutubeyt' => 'vnd.youtube.yt',
        'webm' => 'webm',
        'xanim' => 'x-anim',
        'xannodex' => 'x-annodex',
        'xavi' => 'x-avi',
        'xf4v' => 'x-f4v',
        'xfli' => 'x-fli',
        'xflic' => 'x-flic',
        'xflv' => 'x-flv',
        'xjavafx' => 'x-javafx',
        'xm4v' => 'x-m4v',
        'xmatroska' => 'x-matroska',
        'xmatroska3d' => 'x-matroska-3d',
        'xmjpeg' => 'x-mjpeg',
        'xmng' => 'x-mng',
        'xmpeg' => 'x-mpeg',
        'xmpegsystem' => 'x-mpeg-system',
        'xmpeg2' => 'x-mpeg2',
        'xmpegurl' => 'x-mpegurl',
        'xmsasf' => 'x-ms-asf',
        'xmsasfplugin' => 'x-ms-asf-plugin',
        'xmsvob' => 'x-ms-vob',
        'xmswax' => 'x-ms-wax',
        'xmswm' => 'x-ms-wm',
        'xmswmv' => 'x-ms-wmv',
        'xmswmx' => 'x-ms-wmx',
        'xmswvx' => 'x-ms-wvx',
        'xmsvideo' => 'x-msvideo',
        'xnsv' => 'x-nsv',
        'xogg' => 'x-ogg',
        'xogm' => 'x-ogm',
        'xogmogg' => 'x-ogm+ogg',
        'xrealvideo' => 'x-real-video',
        'xsgimovie' => 'x-sgi-movie',
        'xsmv' => 'x-smv',
        'xtheora' => 'x-theora',
        'xtheoraogg' => 'x-theora+ogg',
    );
}