<?php

namespace Controllers\_BaseController_\Console;

use System\Core\Cron;
use System\Core\Config;
use System\Core\Console\ConsoleInterface;

use function console\danger;
use function console\message;

class CronCommand
{
    protected $tasks = array();

    protected $cronDirectory;

    protected $cron;
    /** @var ConsoleInterface  */
    protected $console;

    public function __construct(ConsoleInterface $console)
    {
        $this->console = $console;

        set_error_handler("\\Controllers\\_BaseController_\\Console\\CronCommand::catchError");
        register_shutdown_function("\\Controllers\\_BaseController_\\Console\\CronCommand::catchFatalError");

        $this->cron = new Cron();
        $this->cron->loadControllersParams('configs/cron.php');

        $this->tasks = Cron::getCronTasks(true);
        ksort($this->tasks);
    }

    public function help()
    {
        $prepared = array();
        foreach($this->tasks as $index => $task){
            $key = "cron:run '{$task['key']}'";
            $prepared[$index]['command'] = $key;
            $prepared[$index]['faq'] = $task['faq'];
        }

        $help = new HelpCommand();
        return $help->run($prepared);
    }

    public function execute()
    {
        foreach($this->tasks as $id => $task){
            $config = Config::getConfig($task['controller']);
            if(!isset($config['enabled']) || !$config['enabled']){
                continue;
            }

            $this->cron->executeCommand($id, $task);

            message(str_repeat('_', 100))->print();
            usleep(100000);
        }
        return true;
    }

    public function runCommand($commandKey)
    {
        $newTasksList = array();
        foreach($this->tasks as $id => $task){
            if($task['key'] == $commandKey){
                $newTasksList[$id] = $task;
            }
        }
        if($newTasksList){
            $this->tasks = $newTasksList;
        }
        return $this->execute();
    }

    public static function catchError($code, $message, $file, $line, $context = null)
    {
        danger("  ERR CODE    $code  ")->print();
        danger("  ERR MSG     $message  ")->print();
        danger("  ERR FILE    $file ($line)  ")->print();
        return true;
    }

    public static function catchFatalError()
    {
        if (@is_array($e = @error_get_last())) {
            $code = isset($e['type']) ? $e['type'] : 0;
            if ($code > 0) {
                $msg = isset($e['message']) ? $e['message'] : '';
                $file = isset($e['file']) ? $e['file'] : '';
                $line = isset($e['line']) ? $e['line'] : '';

                return self::catchError($code, $msg, $file, $line);
            }
        }
        return false;
    }
}