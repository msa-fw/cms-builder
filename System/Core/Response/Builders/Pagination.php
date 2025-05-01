<?php

namespace System\Core\Response\Builders;

use System\Core\Response;

class Pagination
{
    protected $default = array(
        'total' => 0,
        'union' => true,
        'limit' => 30,
        'offset' => 0,
        'template' => "assets/system/paginate.html",
        'decodeUrl' => true,
        'url' => array(),
    );

    public function __construct($limit, $offset)
    {
        Response::response('paginate')
            ->write($this->default);

        $this->limitItemsPerPage($limit);
        $this->offset($offset);

        $currentUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $currentUrl = trim($currentUrl, '/') ?: '/';
        $this->url($currentUrl);
    }

    public function totalItems($integer = 0)
    {
        return $this->custom('total', $integer);
    }

    public function unionRequest($trigger = true)
    {
        return $this->custom('union', $trigger);
    }

    public function limitItemsPerPage($integer = 30)
    {
        return $this->custom('limit', $integer);
    }

    public function offset($integer = 0)
    {
        return $this->custom('offset', $integer);
    }

    public function template($filePath = "assets/system/paginate.html")
    {
        return $this->custom('template', $filePath);
    }

    public function decodeUrl($integer = true)
    {
        return $this->custom('decodeUrl', $integer);
    }

    public function url($link)
    {
        return $this->custom('url', $link);
    }

    public function custom($key, $value)
    {
        Response::response('paginate')->key($key)->write($value);
        return $this;
    }
}