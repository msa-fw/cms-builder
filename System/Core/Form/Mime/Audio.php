<?php

namespace System\Core\Form\Mime;

/**
 * Class Audio
 * @package System\Core\Form\Mime
 * @method Audio threeGpp()
 * @method Audio threeGppEncrypted()
 * @method Audio threeGpp2()
 * @method Audio aac()
 * @method Audio ac3()
 * @method Audio adpcm()
 * @method Audio amr()
 * @method Audio amrEncrypted()
 * @method Audio amrWb()
 * @method Audio amrWbEncrypted()
 * @method Audio annodex()
 * @method Audio basic()
 * @method Audio dff()
 * @method Audio dsd()
 * @method Audio dsf()
 * @method Audio flac()
 * @method Audio imelody()
 * @method Audio m3u()
 * @method Audio m4a()
 * @method Audio midi()
 * @method Audio mobileXmf()
 * @method Audio mp2()
 * @method Audio mp3()
 * @method Audio mp4()
 * @method Audio mpeg()
 * @method Audio mpegurl()
 * @method Audio ogg()
 * @method Audio prsSid()
 * @method Audio s3m()
 * @method Audio scpls()
 * @method Audio silk()
 * @method Audio tta()
 * @method Audio usac()
 * @method Audio vndAudible()
 * @method Audio vndAudibleAax()
 * @method Audio vndAudibleAaxc()
 * @method Audio vndDeceAudio()
 * @method Audio vndDigitalWinds()
 * @method Audio vndDra()
 * @method Audio vndDts()
 * @method Audio vndDtsHd()
 * @method Audio vndLucentVoice()
 * @method Audio vndMRealaudio()
 * @method Audio vndMsPlayreadyMediaPya()
 * @method Audio vndNokiaMobileXmf()
 * @method Audio vndNueraEcelp4800()
 * @method Audio vndNueraEcelp7470()
 * @method Audio vndNueraEcelp9600()
 * @method Audio vndRip()
 * @method Audio vndRnRealaudio()
 * @method Audio vndWave()
 * @method Audio vorbis()
 * @method Audio wav()
 * @method Audio wave()
 * @method Audio webm()
 * @method Audio wma()
 * @method Audio xAac()
 * @method Audio xAifc()
 * @method Audio xAiff()
 * @method Audio xAiffc()
 * @method Audio xAmzxml()
 * @method Audio xAnnodex()
 * @method Audio xApe()
 * @method Audio xCaf()
 * @method Audio xDff()
 * @method Audio xDsd()
 * @method Audio xDsf()
 * @method Audio xDts()
 * @method Audio xDtshd()
 * @method Audio xFlac()
 * @method Audio xFlacOgg()
 * @method Audio xGsm()
 * @method Audio xHxAacAdts()
 * @method Audio xImelody()
 * @method Audio xIriverPla()
 * @method Audio xIt()
 * @method Audio xM3u()
 * @method Audio xM4a()
 * @method Audio xM4b()
 * @method Audio xM4r()
 * @method Audio xMatroska()
 * @method Audio xMidi()
 * @method Audio xMinipsf()
 * @method Audio xMo3()
 * @method Audio xMod()
 * @method Audio xMp2()
 * @method Audio xMp3()
 * @method Audio xMp3Playlist()
 * @method Audio xMpeg()
 * @method Audio xMpegurl()
 * @method Audio xMpg()
 * @method Audio xMsAsx()
 * @method Audio xMsWax()
 * @method Audio xMsWma()
 * @method Audio xMsWmv()
 * @method Audio xMusepack()
 * @method Audio xOgg()
 * @method Audio xOggflac()
 * @method Audio xOpusOgg()
 * @method Audio xPnAudibleaudio()
 * @method Audio xPnRealaudio()
 * @method Audio xPnRealaudioPlugin()
 * @method Audio xPsf()
 * @method Audio xPsflib()
 * @method Audio xRealaudio()
 * @method Audio xRn3gppAmr()
 * @method Audio xRn3gppAmrEncrypted()
 * @method Audio xRn3gppAmrWb()
 * @method Audio xRn3gppAmrWbEncrypted()
 * @method Audio xS3m()
 * @method Audio xScpls()
 * @method Audio xShorten()
 * @method Audio xSpeex()
 * @method Audio xSpeexOgg()
 * @method Audio xStm()
 * @method Audio xTak()
 * @method Audio xTta()
 * @method Audio xVoc()
 * @method Audio xVorbis()
 * @method Audio xVorbisOgg()
 * @method Audio xWav()
 * @method Audio xWavpack()
 * @method Audio xWavpackCorrection()
 * @method Audio xXi()
 * @method Audio xXm()
 * @method Audio xXmf()
 * @method Audio xm()
 * @method Audio xmf()
 */
class Audio extends Common
{
    protected $mime;

    protected $collection;

    protected $availableTypes = array(
        'threeGpp' => '3gpp',
        'threeGppEncrypted' => '3gpp-encrypted',
        'threeGpp2' => '3gpp2',
        'aac' => 'aac',
        'ac3' => 'ac3',
        'adpcm' => 'adpcm',
        'amr' => 'amr',
        'amrencrypted' => 'amr-encrypted',
        'amrwb' => 'amr-wb',
        'amrwbencrypted' => 'amr-wb-encrypted',
        'annodex' => 'annodex',
        'basic' => 'basic',
        'dff' => 'dff',
        'dsd' => 'dsd',
        'dsf' => 'dsf',
        'flac' => 'flac',
        'imelody' => 'imelody',
        'm3u' => 'm3u',
        'm4a' => 'm4a',
        'midi' => 'midi',
        'mobilexmf' => 'mobile-xmf',
        'mp2' => 'mp2',
        'mp3' => 'mp3',
        'mp4' => 'mp4',
        'mpeg' => 'mpeg',
        'mpegurl' => 'mpegurl',
        'ogg' => 'ogg',
        'prssid' => 'prs.sid',
        's3m' => 's3m',
        'scpls' => 'scpls',
        'silk' => 'silk',
        'tta' => 'tta',
        'usac' => 'usac',
        'vndaudible' => 'vnd.audible',
        'vndaudibleaax' => 'vnd.audible.aax',
        'vndaudibleaaxc' => 'vnd.audible.aaxc',
        'vnddeceaudio' => 'vnd.dece.audio',
        'vnddigitalwinds' => 'vnd.digital-winds',
        'vnddra' => 'vnd.dra',
        'vnddts' => 'vnd.dts',
        'vnddtshd' => 'vnd.dts.hd',
        'vndlucentvoice' => 'vnd.lucent.voice',
        'vndmrealaudio' => 'vnd.m-realaudio',
        'vndmsplayreadymediapya' => 'vnd.ms-playready.media.pya',
        'vndnokiamobilexmf' => 'vnd.nokia.mobile-xmf',
        'vndnueraecelp4800' => 'vnd.nuera.ecelp4800',
        'vndnueraecelp7470' => 'vnd.nuera.ecelp7470',
        'vndnueraecelp9600' => 'vnd.nuera.ecelp9600',
        'vndrip' => 'vnd.rip',
        'vndrnrealaudio' => 'vnd.rn-realaudio',
        'vndwave' => 'vnd.wave',
        'vorbis' => 'vorbis',
        'wav' => 'wav',
        'wave' => 'wave',
        'webm' => 'webm',
        'wma' => 'wma',
        'xaac' => 'x-aac',
        'xaifc' => 'x-aifc',
        'xaiff' => 'x-aiff',
        'xaiffc' => 'x-aiffc',
        'xamzxml' => 'x-amzxml',
        'xannodex' => 'x-annodex',
        'xape' => 'x-ape',
        'xcaf' => 'x-caf',
        'xdff' => 'x-dff',
        'xdsd' => 'x-dsd',
        'xdsf' => 'x-dsf',
        'xdts' => 'x-dts',
        'xdtshd' => 'x-dtshd',
        'xflac' => 'x-flac',
        'xflacogg' => 'x-flac+ogg',
        'xgsm' => 'x-gsm',
        'xhxaacadts' => 'x-hx-aac-adts',
        'ximelody' => 'x-imelody',
        'xiriverpla' => 'x-iriver-pla',
        'xit' => 'x-it',
        'xm3u' => 'x-m3u',
        'xm4a' => 'x-m4a',
        'xm4b' => 'x-m4b',
        'xm4r' => 'x-m4r',
        'xmatroska' => 'x-matroska',
        'xmidi' => 'x-midi',
        'xminipsf' => 'x-minipsf',
        'xmo3' => 'x-mo3',
        'xmod' => 'x-mod',
        'xmp2' => 'x-mp2',
        'xmp3' => 'x-mp3',
        'xmp3playlist' => 'x-mp3-playlist',
        'xmpeg' => 'x-mpeg',
        'xmpegurl' => 'x-mpegurl',
        'xmpg' => 'x-mpg',
        'xmsasx' => 'x-ms-asx',
        'xmswax' => 'x-ms-wax',
        'xmswma' => 'x-ms-wma',
        'xmswmv' => 'x-ms-wmv',
        'xmusepack' => 'x-musepack',
        'xogg' => 'x-ogg',
        'xoggflac' => 'x-oggflac',
        'xopusogg' => 'x-opus+ogg',
        'xpnaudibleaudio' => 'x-pn-audibleaudio',
        'xpnrealaudio' => 'x-pn-realaudio',
        'xpnrealaudioplugin' => 'x-pn-realaudio-plugin',
        'xpsf' => 'x-psf',
        'xpsflib' => 'x-psflib',
        'xrealaudio' => 'x-realaudio',
        'xrn3gppamr' => 'x-rn-3gpp-amr',
        'xrn3gppamrencrypted' => 'x-rn-3gpp-amr-encrypted',
        'xrn3gppamrwb' => 'x-rn-3gpp-amr-wb',
        'xrn3gppamrwbencrypted' => 'x-rn-3gpp-amr-wb-encrypted',
        'xs3m' => 'x-s3m',
        'xscpls' => 'x-scpls',
        'xshorten' => 'x-shorten',
        'xspeex' => 'x-speex',
        'xspeexogg' => 'x-speex+ogg',
        'xstm' => 'x-stm',
        'xtak' => 'x-tak',
        'xtta' => 'x-tta',
        'xvoc' => 'x-voc',
        'xvorbis' => 'x-vorbis',
        'xvorbisogg' => 'x-vorbis+ogg',
        'xwav' => 'x-wav',
        'xwavpack' => 'x-wavpack',
        'xwavpackcorrection' => 'x-wavpack-correction',
        'xxi' => 'x-xi',
        'xxm' => 'x-xm',
        'xxmf' => 'x-xmf',
        'xm' => 'xm',
        'xmf' => 'xmf',
    );
}