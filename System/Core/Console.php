<?php

namespace System\Core;

use System\Traits\Autoloader;
use System\Core\Console\Builder;
use System\Core\Router\Encapsulation;
use System\Core\Console\ConsoleInterface;

use function console\danger;
use function reflection\countMethodRequiredParams;

/**
 * Class Console
 * @package System\Core
 */
class Console extends Encapsulation implements ConsoleInterface
{
    use Autoloader;

    protected static $commands = array();

    protected $requestCommand;

    protected $errorPosition;

    /**
     * Register new console commands only from controller children classes
     * Variable $arguments[0] (console command pattern) REQUIRED
     * @param $name
     * @param $arguments
     * @return bool|Builder
     */
    public static function __callStatic($name, $arguments)
    {
        $builder = new Builder($arguments[0], self::$commands);
        $builder->controller($name);
        return $builder;
    }

    public function __call($key, $arguments)
    {
        return self::__callStatic($key, $arguments);
    }

    public static function getCommands()
    {
        return self::$commands;
    }

    public static function getCommand($key)
    {
        return isset(self::$commands[$key]) ? self::$commands[$key] : null;
    }

    public function __construct()
    {
        $this->errorPosition = str_repeat(PHP_EOL . str_repeat('_', 100), 1) . PHP_EOL . PHP_EOL;
    }

    protected function parseRoutes()
    {
        ksort(self::$commands);

        foreach(self::$commands as &$command){
            if(!$command['enabled']){ continue; }

            $config = Config::getConfig($command['controller']);
            if(!isset($config['enabled']) || !$config['enabled']){
                continue;
            }

            if(!$command['pattern']){
                $replacedCommand = preg_replace_callback("#[\{|\[](.*?)[\}|\]]#usm", function($value){
                    if(strpos($value[1], 'int') !== false){
                        return "(\d+)";
                    }
                    if(strpos($value[1], 'str') !== false){
                        return "([^\d]+)";
                    }
                    return "(.*?)";
                }, $command['command']);

                $command['pattern'] = "#^$replacedCommand$#usm";
            }

            if(preg_match($command['pattern'], $this->requestCommand, $requestParams)){
                $requestParams = array_slice($requestParams, 1);
                $command['arguments'] = array_merge($command['arguments'], $requestParams);
                $this->setCurrentRoute($command);
            }
        }
        return $this->getCurrentRoute();
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

    public function runController($requestCommand)
    {
        if($this->requestCommand = trim($requestCommand)){
            if(!$this->parseRoutes()){
                return $this->help($this->requestCommand);
            }

            $callback = $this->getCurrentRouteParam('callback');
            if($callback && is_callable($callback)){
                return call_user_func($callback, $this);
            }

            $this->parseControllerParams();
            if($this->executeController()){
                return true;
            }
            return false;
        }
        return $this->help($this->requestCommand);
    }

    protected function executeController()
    {
        if($action = $this->getCurrentRouteParam('action')){
            $params = $this->getCurrentRouteParam('arguments') ?: array();

            $method = $this->getCurrentRouteParam('method');
            if(count($params) < countMethodRequiredParams($action, $method)){
                danger(Language::System('console.error.countRequiredParamsNotEqual')
                    ->string(true)->replace_k2v(array('%COMMAND%' => "php " . CLI_ROOT_PATH . " " .$this->requestCommand)))->print($this->errorPosition);
                return false;
            }

            $actionObject = new $action($this);
            $this->setActionInstance($actionObject);

            if(call_user_func_array(array($actionObject, $this->getCurrentRouteParam('method')), $params)){
                return true;
            }
            return false;
        }
        return $this->help($this->requestCommand);
    }

    protected function help($command)
    {
        $this->runController('help');

        print PHP_EOL . str_repeat('-', 100) . PHP_EOL;

        danger(Language::System('console.error.commandNotFound')
            ->string(true)->replace_k2v(array('%COMMAND%' => "php " . CLI_ROOT_PATH . " " . $command)))->print($this->errorPosition);
        return false;
    }
}