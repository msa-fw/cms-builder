<?php

namespace Controllers\_BaseController_\Console;

use System\Core\Debug;
use System\Core\Console;
use System\Core\Database;
use System\Helpers\Classes\Fs;
use Controllers\_BaseController_\Config;
use Controllers\_BaseController_\Language;

use function console\paint;
use function console\danger;
use function console\message;
use function console\success;
use function console\warning;
use function reflection\countMethodRequiredParams;
use function reflection\getClassPublicMethodsList;

class TestCommand
{
    public static $tmpDatabaseName;
    /** @var Console\ConsoleInterface */
    protected $console;

    protected $server;

    public function __construct(Console\ConsoleInterface $console)
    {
        $this->console = $console;
        $this->server = Fs::server();

        Debug::shutdownTrigger(false);

        set_error_handler("\\Controllers\\_BaseController_\\Console\\TestCommand::catchError");
        register_shutdown_function("\\Controllers\\_BaseController_\\Console\\TestCommand::catchFatalError");

        self::$tmpDatabaseName = "TMP_TEST_DB-" . md5(microtime(true) . uniqid());

        $this->initialize();
    }

    public function __destruct()
    {
        self::rollback();
    }

    public static function rollback()
    {
        return Database::connect()
            ->delete(self::$tmpDatabaseName);
    }

    public function initialize()
    {
        if($defConnection = Config::database(DB_DEFAULT_CONNECTION)->read()){
            $defConnection['base'] = self::$tmpDatabaseName;

            Config::database(DB_DEFAULT_CONNECTION)->write($defConnection);
        }else{
            exit("Cannot continued.\n");
        }

        Database::connect()
            ->create(self::$tmpDatabaseName);

        $console = new Console();
        $console->runController('migrate:run');
        $console->runController('migrate:run:fill');
    }

    public function runAll()
    {
        $controllerTestClassesDirectory = $this->server->root("Controllers");

        foreach(scandir($controllerTestClassesDirectory) as $controller){
            if($controller == '.' || $controller == '..'){ continue; }

            message(
                Language::_BaseController_('console.tests.controllerExecution')
                    ->string(true)->replace_k2v(array('%controller%' => $controller))
            )->print(' ' . date('H:i:s, d M, Y') . PHP_EOL);

            $this->runController($controller);
        }
        return $this;
    }

    public function runController($controller)
    {
        $controllerTestClassesDirectory = $this->server->root("Controllers/{$controller}/Tests");

        foreach(scandir($controllerTestClassesDirectory) as $file){
            if($file == '.' || $file == '..'){ continue; }

            $fileName = pathinfo($file, PATHINFO_FILENAME);

            message(
                Language::_BaseController_('console.tests.classExecution')->string(true)
                    ->replace_k2v(array('%controller%' => $controller, '%action%' => $fileName))
            )->print(' ' . date('H:i:s, d M, Y') . PHP_EOL);

            $this->runControllerAction($controller, $fileName);
        }
        return $this;
    }

    public function runControllerAction($controller, $action)
    {
        /** @var \ReflectionMethod $item */

        $sleep = Config::_BaseController_('testsSleepTime')->read();

        $className = "\\Controllers\\{$controller}\\Tests\\{$action}";
        if(class_exists($className)){
            foreach(getClassPublicMethodsList($className) as $item){
                $method = $item->getName();

                if($method == '__construct'){ continue; }

                paint(Language::_BaseController_('console.tests.action')->string(true)
                    ->replace_k2v(array('%class%' => $className, '%method%' => $method)))->fon()->fonCyan()->print(' --> ');

                $this->executeMethod($controller, $action, $method);

                if($sleep){
                    usleep($sleep);
                }
            }
            return $this;
        }
        danger(Language::_BaseController_('console.tests.classNotFound')
            ->string()->replace_k2v(array('%class%' => $className)))->print();

        return $this;
    }

    public function executeMethod($controller, $action, $method)
    {
        $className = "\\Controllers\\{$controller}\\Tests\\{$action}";
        $arguments = $this->useAlternativeRouting($controller, $method);

        if(count($arguments) < countMethodRequiredParams($className, $method)){
            warning(Language::_BaseController_('console.tests.skippedByRequiredParams')->returnKey())->print();
            return false;
        }

        $classObject = new $className();
        $timer = microtime(true);
        $result = call_user_func_array(array($classObject, $method), $arguments);
        $timer = number_format(microtime(true) - $timer, 10, '.', ' ');

        if($result){
            success(Language::_BaseController_('console.tests.actionSuccess')
                ->string()->replace_k2v(array('%time%' => $timer)))->print(' ' . date('H:i:s, d M, Y') . PHP_EOL);
            return $result;
        }
        danger(Language::_BaseController_('console.tests.actionError')
            ->string()->replace_k2v(array('%time%' => $timer)))->print(' ' . date('H:i:s, d M, Y') . PHP_EOL);
        return false;
    }

    public static function catchError($code, $message, $file, $line, $context = null)
    {
        self::rollback();

        Debug::shutdownTrigger(true);
        return Debug::catchError($code, $message, $file, $line, $context);
    }

    public static function catchFatalError()
    {
        if (@is_array($e = @error_get_last())) {
            $code = isset($e['type']) ? $e['type'] : 0;
            if ($code > 0) {
                self::rollback();

                Debug::shutdownTrigger(true);
                return Debug::catchFatalError();
            }
        }
        return false;
    }

    protected function useAlternativeRouting($controller, &$method)
    {
        if($index = array_search($controller, $_SERVER['argv'])){
            $arguments = array_slice($_SERVER['argv'], $index);
            if(isset($arguments[2])){
                $method = $arguments[2];
            }
            return array_slice($arguments, 3);
        }
        return array();
    }
}