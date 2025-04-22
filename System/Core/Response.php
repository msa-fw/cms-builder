<?php

namespace System\Core;

use System\Core\Template\Cookies;
use System\Helpers\Classes\ArrayManager;
use System\Core\Response\Builders\Meta;
use System\Core\Response\Builders\Breadcrumbs;

/**
 * Class Response
 * @package System\Core
 * @method static|ArrayManager response($key = null)
 */
class Response
{
    const HTTP_RESPONSE_CODES = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        103 => 'Early Hints',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        208 => 'Already Reported',
        226 => 'IM Used',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'unused',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Payload Too Large',
        414 => 'URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        421 => 'Misdirected Request',
        422 => 'Unprocessable Content',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Too Early',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        451 => 'Unavailable For Legal Reasons',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        510 => 'Not Extended',
        511 => 'Network Authentication Required',
    );

    protected static $response = array(
        'code' => 200,
        'status' => 'OK',
        'header' => array(),
        'cookie' => array(),
        'title' => array(),
        'meta' => array(),
        'icon' => array(),
        'breadcrumbs' => array(),
    );

    public static function __callStatic($key, $arguments)
    {
        $arrayManager = new ArrayManager($key, self::$response[$key]);
        if(isset($arguments[0])){
            return $arrayManager->key($arguments[0]);
        }
        return $arrayManager;
    }

    public function __call($key, $arguments)
    {
        return self::__callStatic($key, $arguments);
    }

    public static function getResponses()
    {
        return self::$response;
    }

    public static function getResponse($key)
    {
        return isset(self::$response[$key]) ? self::$response[$key] : null;
    }

    public static function icon($link, $id = "id", $rel="shortcut icon")
    {
        self::$response['icon'][$id] = array(
            'id' => $id,
            'rel' => $rel,
            'href' => $link,
        );
    }

    public static function title($key, $value)
    {
        return self::$response['title'][$key] = $value;
    }

    public static function code($value = false)
    {
        if($value !== false && isset(self::HTTP_RESPONSE_CODES[$value])){
            self::$response['code'] = $value;
            self::status(self::HTTP_RESPONSE_CODES[$value]);
        }
        return self::$response['code'];
    }

    public static function status($value = false)
    {
        if($value !== false){ self::$response['status'] = $value; }
        return self::$response['status'];
    }

    public static function header($key, $value = false, $code = false)
    {
        if($value !== false){
            self::$response['header'][$key] = $value;
            self::code($code);
        }
        return isset(self::$response['header'][$key]) ? self::$response['header'][$key] : null;
    }

    public static function cookie($name, $value)
    {
        return new Cookies($name, $value, self::$response['cookie']);
    }

    public static function meta($key)
    {
        return new Meta($key, self::$response['meta']);
    }

    public static function breadcrumbs($name)
    {
        return new Breadcrumbs($name, self::$response['breadcrumbs'][$name]);
    }

    public function __construct()
    {
    }
}