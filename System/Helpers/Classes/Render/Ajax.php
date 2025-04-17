<?php

namespace System\Helpers\Classes\Render;

/**
 * Class Ajax
 * @package System\Helpers\Classes\Render
 * @example
 *
 * print modal('link name')->title('modal title')
 *          ->ajax()->link('/')->done()->render();
 *
 * print modal('dsdsd')->ajax(function(\System\Helpers\Classes\Render\Ajax $ajax){
 *           $ajax->method('post');
 *           $ajax->request('test', '12')->request('test2', '123');
 *           $ajax->target('/simple/link');
 *       })->render();
 */
class Ajax
{
    const ENC_TYPE_X_WWW_FORM = 'application/x-www-form-urlencoded';
    const ENC_TYPE_MULTIPART = 'multipart/form-data';
    const ENC_TYPE_PLAIN = 'text/plain';

    const ACCEPT_HTML = 'text/html';
    const ACCEPT_JSON = 'application/json';
    const ACCEPT_TEXT = 'text/plain';
    const ACCEPT_XML = 'application/xml';

    const TEMPLATE = array(
        'link' => '/',
        'async' => true,
        'method' => 'GET',
        'timeout' => 30000,
        'onError' => '',
        'onReadyStateChange' => '',
        'loader' => 'images/spinning_arrows.gif',
        'template' => 'assets/system/ajax.html',
        'arguments' => array(),
        'headers' => array(
            'X-Only-Body'  => 1,
            'Accept'  => 'text/html',
            'Content-type'  => self::ENC_TYPE_X_WWW_FORM,
        ),
    );

    protected $request;
    /** @var  Modal */
    protected $modal;

    public function __construct(Modal $modal, &$request)
    {
        $this->modal = $modal;
        $this->request = &$request;
        $this->request['ajax'] = self::TEMPLATE;
    }

    public function loader($gif = 'images/spinning_arrows.gif')
    {
        return $this->custom('loader', $gif);
    }

    public function template($file = 'assets/system/ajax.html')
    {
        return $this->custom('template', $file);
    }

    public function target($link = '/', $async = true)
    {
        $this->custom('link', $link);
        return $this->custom('async', $async);
    }

    public function timeout($seconds = 60)
    {
        return $this->custom('timeout', $seconds * 1000);
    }

    public function onError($handler = 'console.log(this.ajax)')
    {
        return $this->custom('onError', $handler);
    }

    public function onReadyStateChange($handler = 'if(ajax.readyState){ console.log(ajax.responseText); }')
    {
        return $this->custom('onReadyStateChange', $handler);
    }

    public function method($method = 'GET')
    {
        return $this->custom('method', $method);
    }

    public function header($header, $value)
    {
        $this->request['ajax']['headers'][$header] = $value;
        return $this;
    }

    public function request($field, $value)
    {
        $this->request['ajax']['arguments'][$field] = $value;
        return $this;
    }

    public function custom($key, $value)
    {
        $this->request['ajax'][$key] = $value;
        return $this;
    }

    public function getOnlyControllerBody($value = 1)
    {
        return $this->header('X-Only-Body', $value);
    }

    public function contentType($type = Ajax::ENC_TYPE_X_WWW_FORM)
    {
        return $this->header('Content-type', $type);
    }

    public function accept($accept = Ajax::ACCEPT_HTML)
    {
        return $this->header('Accept', $accept);
    }

    public function done()
    {
        return $this->modal;
    }
}