<?php

namespace System\Helpers\Classes\Render;

use function response\buildQuery;
use System\Core\Response;
use System\Core\Router;

class Url
{
    protected $host;

    protected $hash;

    protected $result;

    protected $controllerAction;

    protected $params = array();

    protected $query = array();

    protected $union = true;

    public function __construct($controllerAction, ...$params)
    {
        $this->controllerAction = $controllerAction;
        $this->params = $params;
    }

    /**
     * @param $host
     * @return Url
     */
    public function host($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @param string $appendHash
     * @return Url
     */
    public function hash($appendHash = '#')
    {
        $this->hash = $appendHash;
        return $this;
    }

    /**
     * @param array $query
     * @param bool $unionRequest
     * @return Url
     */
    public function query(array $query, $unionRequest = true)
    {
        $this->query = $query;
        $this->union = $unionRequest;
        return $this;
    }

    /**
     * @return Url
     */
    public function build()
    {
        $result = array();
        if($this->host){
            $result[] = trim($this->host, '/');
        }

        if($route = Router::getActiveRoute($this->controllerAction)){
            if($this->params && preg_match_all("#([\{|\[](.*?)[\}|\]])#usim", $route['uri'], $matches)){
                $result[] = str_replace($matches[1], $this->params, $route['uri']);
            }else{
                $result[] = $route['uri'];
            }
        }

        if($this->hash){
            $result[] = "#" .trim($this->hash, '#');
        }

        if($this->query){
            $result[] = buildQuery($this->query, $this->union);
        }

        $this->result = implode('', $result);

        $this->result = '/' . trim($this->result, '/');

        return $this;
    }

    public function get()
    {
        return $this->result;
    }

    public function print()
    {
        print $this->result;
    }

    public function redirect($code = 302)
    {
        Response::header('Location', $this->result, $code);
        return $this;
    }
}