<?php

namespace System\Core\Router;

use System\Core\Router;
use function system\createIndex;

class Builder implements BuilderInterface, BuilderNestedInterface
{
    const INDEX_POSITION_APPEND = 1, INDEX_POSITION_PREPEND = 0;

    const TEMPLATE = array(
        'uri' => null,
        'prefix' => null,
        'pattern' => null,
        'enabled' => true,
        'granted' => array(),
        'denied' => array(),
        'arguments' => array(),
        'callback' => null,
        'controller' => null,
        'action' => null,
    );

    protected $uri;

    protected $index;

    protected $prefix;

    protected $controller;

    protected $routes = array();

    public function __construct(&$routes, $controller = null, $prefix = '')
    {
        $this->routes = &$routes;
        $this->controller = $controller;
        $this->prefix = trim($prefix, '/');
    }

    public function uri($uri)
    {
        $this->index();

        if($uri && $uri !== '/'){
            $uri = trim($uri, '/');
        }
        $this->uri = $uri;

        if($this->prefix){
            $uri = "{$this->prefix}/{$uri}";
        }

        $this->routes[$this->index] = self::TEMPLATE;

        $this->custom('uri', $uri);
        $this->custom('prefix', $this->prefix);
        return $this->controller($this->controller);
    }

    public function controller($controller)
    {
        return $this->custom('controller', $controller);
    }

    /**
     * For callback
     * @see \System\Core\Router::prefix()
     * @param $uri
     * @return BuilderInterface
     */
    public function suffix($uri)
    {
        $newSelfObject = new self($this->routes, $this->controller, $this->prefix);
        $newSelfObject->uri($uri);
        return $newSelfObject;
    }

    public function action($action, ...$arguments)
    {
        if(!$this->uri){
            $controller = $this->routes[$this->index]['controller'];

            $chunks = explode('\\', $action);
            $action = end($chunks);

            $action = str_ireplace(array('controller', 'index', 'action'), '', $action);

            $action = $action ? "/{$action}" : "";

            $this->routes[$this->index]['uri'] = mb_strtolower("{$controller}{$action}");

            if($this->prefix){
                $this->routes[$this->index]['uri'] = $this->prefix . '/' . $this->routes[$this->index]['uri'];
            }

        }
        $this->custom('action', $action);
        return $this->custom('arguments', $arguments);
    }

    public function pattern($pattern)
    {
        return $this->custom('pattern', $pattern);
    }

    public function enabled($status = true)
    {
        return $this->custom('enabled', $status);
    }

    public function granted(...$granted)
    {
        return $this->custom('granted', $granted);
    }

    public function denied(...$denied)
    {
        return $this->custom('denied', $denied);
    }

    /**
     * @param callable $callback
     * @param array ...$arguments
     * @return Builder|BuilderInterface
     */
    public function call(callable $callback, ...$arguments)
    {
        $this->custom('callback', $callback);
        return $this->custom('arguments', $arguments);
    }

    public function custom($key, $value)
    {
        $this->routes[$this->index][$key] = $value;
        return $this;
    }

    public function index(int $index = 0, $position = Builder::INDEX_POSITION_APPEND)
    {
        $index = createIndex($this->routes, $index, $position);

        if(isset($this->routes[$this->index])){
            $this->routes[$index] = $this->routes[$this->index];
             unset($this->routes[$this->index]);
        }
        $this->index = $index;
        return $this;
    }

    public function get()
    {
        return $this->routes[$this->index];
    }
}