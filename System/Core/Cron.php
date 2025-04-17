<?php

namespace System\Core;

use System\Core\Cron\Builder;
use System\Traits\Autoloader;

use function console\paint;
use function console\danger;
use function console\success;
use function console\warning;
use function filesystem\root;
use function filesystem\read;
use function filesystem\write;
use function filesystem\getTmpPath;
use function filesystem\makeDirectory;

class Cron
{
    use Autoloader;

    protected static $tasks = array();

    protected $cronDirectory;

    /**
     * Register new CRON tasks only from controller children classes
     * @param $name
     * @param $arguments
     * @return Builder
     */
    public static function __callStatic($name, $arguments)
    {
        $builder = new Builder($arguments[0], self::$tasks);
        $builder->controller($name);
        return $builder;
    }

    public function __call($key, $arguments)
    {
        return self::__callStatic($key, $arguments);
    }

    public static function getCronTask($task)
    {
        return isset(self::$tasks[$task]) ? self::$tasks[$task] : null;
    }

    public static function getCronTasks($sort = false)
    {
        if($sort){
            $tasks = self::$tasks;
            uasort($tasks, function($task1, $task2){
                return $task1['index'] > $task2['index'] ? 1 : 0;
            });
            return $tasks;
        }
        return self::$tasks;
    }

    public function __construct()
    {
        $this->cronDirectory = root(getTmpPath() . "/cron");
        makeDirectory($this->cronDirectory);
    }

    public function executeCommand($index, array $params)
    {
        paint("      {$params['key']}       ")->colorWhite()->fonMagenta()->print();

        if(!$params['enabled']){
            danger(Language::System('cron.job.error.disabled')->returnKey())->print();
            return false;
        }

        $cronTaskFile = "{$this->cronDirectory}/{$index}-{$params['key']}.txt";

        if(!$this->checkCronTask($cronTaskFile, $params['timeout'], $params['frequency'])){
            return false;
        }

        if(!$this->exec($params['class'], $params['method'], $params['arguments'])){
            return false;
        }

        if(file_exists($cronTaskFile)){
            $content = read($cronTaskFile);
            $information = json_decode($content, true);
            $information['end'] = time();
            write($cronTaskFile, json_encode($information));
        }
        return $this;
    }

    protected function exec($class, $method, array $params)
    {
        if(class_exists($class)){
            $object = new $class($this);
            if(method_exists($object, $method)){
                if(call_user_func_array(array($object, $method), $params)){
                    success(Language::System('cron.job.successful')->returnKey())->print(" => " . date('Y-m-d, H:i:s') . PHP_EOL);
                    return true;
                }
                warning(Language::System('cron.job.error.emptyResponse')->returnKey())->print(" => " . date('Y-m-d, H:i:s') . PHP_EOL);
                return false;
            }
            danger(Language::System('cron.job.error.invalidMethod')
                ->string(true)->replace_k2v(array('%method%' => "{$class}::{$method}()")))->print(" => " . date('Y-m-d, H:i:s') . PHP_EOL);
            return false;
        }
        danger(Language::System('cron.job.error.invalidClass')
            ->string(true)->replace_k2v(array('%class%' => $class)))->print(" => " . date('Y-m-d, H:i:s') . PHP_EOL);
        return false;
    }

    protected function checkCronTask($cronTaskFile, $timeout, $frequency)
    {
        $currentTime = time();
        if($content = read($cronTaskFile)){
            $information = json_decode($content, true);

            if(!isset($information['end'])){
                if($information['start'] + $timeout < $currentTime){
                    write($cronTaskFile, json_encode(array('start' => $currentTime)));

                    danger(Language::System('cron.job.error.expired')->returnKey())->print(" => " . date('Y-m-d, H:i:s') . PHP_EOL);
                    return true;
                }

                warning(Language::System('cron.job.error.skipped')->returnKey())->print(" => " . date('Y-m-d, H:i:s') . PHP_EOL);
                return false;
            }

            if($information['start'] + $frequency < $currentTime){
                success(Language::System('cron.job.ready')->returnKey())->print(" => " . date('Y-m-d, H:i:s') . PHP_EOL);

                write($cronTaskFile, json_encode(array('start' => $currentTime)));
                return true;
            }

            warning(Language::System('cron.job.error.notReady')->returnKey())->print(" => " . date('Y-m-d, H:i:s') . PHP_EOL);
            return false;
        }
        success(Language::System('cron.job.new')->returnKey())->print(" => " . date('Y-m-d, H:i:s') . PHP_EOL);

        write($cronTaskFile, json_encode(array('start' => $currentTime)));
        return true;
    }
}