<?php

namespace System\Core;

use System\Traits\Autoloader;
use System\Core\Router\Builder;
use System\Core\Events\Launcher;
use System\Core\Router\Encapsulation;
use System\Core\Router\BuilderInterface;
use System\Core\Router\RouterGetterInterface;
use System\Core\Router\BuilderNestedInterface;

use function reflection\countMethodRequiredParams;

class Router extends Encapsulation implements RouterGetterInterface
{
    use Autoloader;

    /**
     * For generation URLs `href`-value for `<a>` tags
     * Skip checking `enabled controller` enabled in loops
     * @var array $activeRoutes
     */
    protected static $activeRoutes = array();

    protected static $routes = array();

    protected $requestMethod;

    protected $requestUri;

    /**
     * Register new routes only from controller children classes
     * Variable $arguments[0] (URI pattern) REQUIRED
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        if(isset($arguments[1]) && is_callable($arguments[1])){
            return self::prefix($name, $arguments[0], $arguments[1]);
        }
        $builder = new Builder(self::$routes);
        $builder->uri($arguments[0]);
        $builder->controller($name);
        return $builder;
    }

    public function __call($key, $arguments)
    {
        return self::__callStatic($key, $arguments);
    }

    /**
     * @param $controllerName
     * @param $uriPrefix
     * @param callable|BuilderNestedInterface $callback
     * @return BuilderInterface
     */
    protected static function prefix($controllerName, $uriPrefix, callable $callback)
    {
        $builder = new Builder(self::$routes, $controllerName, $uriPrefix);
        if($result = call_user_func($callback, $builder)){
            $newBuilder = new Builder(self::$routes, $controllerName);
            return $newBuilder->uri($uriPrefix)
                ->controller($controllerName);
        }
        return $result;
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function getRoute($key)
    {
        return isset(self::$routes[$key]) ? self::$routes[$key] : null;
    }

    public static function setActiveRoute(array $route)
    {
        $action = $route['action'];
        self::$activeRoutes[$action] = $route;
        return true;
    }

    public static function getActiveRoute($action)
    {
        if(isset(self::$activeRoutes[$action])){
            return self::$activeRoutes[$action];
        }
        return false;
    }

    public static function getActiveRoutes()
    {
        return self::$activeRoutes;
    }

    public function __construct()
    {
    }

    public function runController($requestUri, $requestMethod)
    {
        if(Response::code() > 200){
            return false;
        }

        $requestUri = parse_url($requestUri, PHP_URL_PATH);
        $requestUri = urldecode($requestUri);
        $requestUri = trim($requestUri, '/') ?: '/';

        $this->requestUri = $requestUri;
        $this->requestMethod = $requestMethod;

        if(!$this->parseRoutes()){
            Response::code(404);
            return false;
        }

        if(!$this->checkAccess()){
            Response::code(403);
            return false;
        }

        $callback = $this->getCurrentRouteParam('callback');
        if($callback && is_callable($callback)){
            $arguments = $this->getCurrentRouteParam('arguments') ?: array();
            return call_user_func($callback, $this, ...$arguments);
        }

        $this->parseControllerParams();

        return $this->executeController();
    }

    protected function executeController()
    {
        if($action = $this->getCurrentRouteParam('action')){
            if(!($method = $this->getCurrentRouteParam('method'))){
                $method = $this->requestMethod;
            }
            $this->setMethodName($method);

            if(!method_exists($action, $method)){
                Response::code(405);
                return false;
            }

            $params = $this->getCurrentRouteParam('arguments') ?: array();

            if(count($params) < countMethodRequiredParams($action, $method)){
                Response::code(400);
                return false;
            }

            $actionObject = new $action($this);
            $this->setActionInstance($actionObject);

            $this->runEvent('before', ...$params);
            if(Response::code() > 200){
                return false;
            }

            if($result = call_user_func_array(array($actionObject, $method), $params)){
                $this->runEvent('after', $result, ...$params);
                return $result;
            }
            Response::code(404);
            return false;
        }
        Response::code(500);
        return false;
    }

    protected function parseRoutes()
    {
        ksort(self::$routes);

        foreach(self::$routes as &$route){
            if(!$route['enabled']){ continue; }

            $config = Config::getConfig($route['controller']);
            if(!isset($config['enabled']) || !$config['enabled']){
                continue;
            }

            if(!$route['pattern']){
                $replacedUri = preg_replace_callback("#[\{|\[](.*?)[\}|\]]#usm", function($value){
                    if(strpos($value[1], 'int') !== false){
                        return "(\d+)";
                    }
                    if(strpos($value[1], 'str') !== false){
                        return "([^\d]+)";
                    }
                    return "(.*?)";
                }, $route['uri']);

                $route['pattern'] = "#^$replacedUri$#usm";
            }

            if(preg_match($route['pattern'], $this->requestUri, $requestParams)){
                $requestParams = array_slice($requestParams, 1);
                $route['arguments'] = array_merge($route['arguments'], $requestParams);

                $this->setCurrentRoute($route);
            }

            self::setActiveRoute($route);
        }
        return $this->getCurrentRoute();
    }

    protected function checkAccess()
    {
        Access::setCurrentRouter($this->getCurrentRoute());

        $access = new Access();

        $access->setDefaultAccessValues(true, false);

        if($allowedGroups = $this->getCurrentRouteParam('granted')){
            $access->setDefaultAccessValues(false, true);
            $access->checkGroupsAccessGranted($allowedGroups);
        }

        if($disallowedGroups = $this->getCurrentRouteParam('denied')){
            $access->checkGroupsAccessDenied($disallowedGroups);
        }
        return $access->granted() && !$access->denied();
    }

    protected function parseControllerParams()
    {
        if($action = $this->getCurrentRouteParam('action') ?: ''){
            $chunks = explode('\\', $action);
            $this->setActionName(end($chunks));
        }

        if($controller = $this->getCurrentRouteParam('controller')){
            $this->setControllerName($controller);
        }

        if($method = $this->getCurrentRouteParam('method')){
            $this->setMethodName($method);
        }
        return $this;
    }

    protected function runEvent($eventType, ...$arguments)
    {
        if($controller = $this->getCurrentRouteParam('controller')){
            $event = "{$eventType}{$controller}Running";

            if($events = Events::getEventsList()){
                $launcher = new Launcher($event, $events, ...$arguments);
                return $launcher->runEvents();
            }
        }
        return false;
    }
}