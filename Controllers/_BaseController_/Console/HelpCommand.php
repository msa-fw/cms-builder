<?php

namespace Controllers\_BaseController_\Console;

use Controllers\_BaseController_\Console;
use System\Core\Console\ConsoleInterface;
use function console\paint;
use function console\success;
use function language\translate;

class HelpCommand
{
    protected $commands = array();

    protected $maxLengthPoint1 = 0;
    protected $maxLengthPoint2 = 0;
    /** @var ConsoleInterface */
    protected $console;

    public function __construct(ConsoleInterface $console)
    {
        $this->console = $console;
        $this->commands = Console::getCommands();
    }

    public function execute($prefix = null)
    {
        $this->printWelcomeToHelpMessage();
        return $this->run($this->commands, $prefix);
    }

    public function run(array $commands, $prefix = null)
    {
        $this->setStringsMaxLengths($commands);

        foreach($commands as $index => $params){
            if(!$params['faq'] || !$params['enabled']){
                unset($commands[$index]);
                continue;
            }

            if($prefix){
                if(strpos($params['command'], $prefix) === 0){
                    $this->render($params['command'], $commands[$index]);
                }
            }else{
                $this->render($params['command'], $commands[$index]);
            }
        }

        $category = '';
        foreach($commands as $params){
            if(!$prefix){
                $this->printCategory($params['command'], $category);
            }

            if(isset($params['message'])){
                $message = $params['message'];

                if(isset($params['rawMessage']) && !empty($params['rawMessage'])){
                    $maxLengthPoint2 = strlen($params['rawMessage']);
                    $message .= str_repeat(" ", $this->maxLengthPoint2-$maxLengthPoint2);
                }

                if($params['faq']){
                    $message .= " - ";
                    $message .= translate($params['faq']);
                }
                print $message . PHP_EOL;
            }
        }
        return true;
    }

    public function printCategory($command, &$category)
    {
        if(preg_match("#(\w+)(([^\w])?)#usm", $command, $match)){
            $match[1] = mb_strtoupper($match[1]);
            if($match[1] != $category){
                $length = mb_strlen($match[1]);
                $multiplier = ceil((100 - $length) / 2);

                print str_repeat('-', 100) . PHP_EOL;
                success(str_repeat(' ', $multiplier) . $match[1] . str_repeat(' ', $multiplier))->print();
            }
            $category = $match[1];
        }
    }

    public function render($command, &$params)
    {
        $message = preg_replace_callback("#(.*?)([\{|\[|\'|\"].*?[\}|\]|\'|\"])$#usm", function($value){
            $maxLengthPoint1 = strlen($value[1]);
            $message = paint("php")
                ->colorBrightWhite()->result('')->get(' ');
            $message .= paint(pathinfo(CLI_ROOT_PATH, PATHINFO_FILENAME) . " ")
                ->colorBrightGreen()->result('')->get("");
            $message .= paint(trim($value[1]))
                ->colorBrightYellow()->result('')->get("");
            $message .= str_repeat(" ", $this->maxLengthPoint1-$maxLengthPoint1);
            $message .= paint(trim($value[2]))->colorWhite()->fonRed()->get("");
            return $message;
        }, $command);

        if(!$message || $message == $command){
            $message = paint("php")->colorBrightWhite()
                ->result('')->get(' ');
            $message .= paint(pathinfo(CLI_ROOT_PATH, PATHINFO_FILENAME) . " ")
                ->colorBrightGreen()->result('')->get("");
            $message .= paint(trim($command))
                ->colorBrightYellow()->result('')->get("");
        }

        $params['message'] = $message;
        return true;
    }

    public function setStringsMaxLengths(array &$commands)
    {
        foreach($commands as $params){
            preg_replace_callback("#(.*?)([\{|\[|\'|\"].*?[\}|\]|\'|\"])$#usm", function($value){
                $maxLengthPoint1 = strlen($value[1]) + 1;
                if($maxLengthPoint1 > $this->maxLengthPoint1){ $this->maxLengthPoint1 = $maxLengthPoint1; }
            }, $params['command']);
        }

        foreach($commands as &$params){
            $params['rawMessage'] = preg_replace_callback("#(.*?)([\{|\[|\'|\"].*?[\}|\]|\'|\"])$#usm", function($value){
                $maxLengthPoint1 = strlen($value[1]);
                $message = "php";
                $message .= pathinfo(CLI_ROOT_PATH, PATHINFO_FILENAME) . " ";
                $message .= $value[1];
                $message .= str_repeat(" ", $this->maxLengthPoint1-$maxLengthPoint1);
                $message .= $value[2];

                $maxLengthPoint2 = strlen($message) + 1;
                if($maxLengthPoint2 > $this->maxLengthPoint2){ $this->maxLengthPoint2 = $maxLengthPoint2; }

                return $message;
            }, $params['command']);

            if(!$params['rawMessage'] || $params['rawMessage'] == $params['command']){
                $params['rawMessage'] = "php";
                $params['rawMessage'] .= pathinfo(CLI_ROOT_PATH, PATHINFO_FILENAME) . "  ";
                $params['rawMessage'] .= $params['command'];
            }
        }
        return $this;
    }

    public function printWelcomeToHelpMessage()
    {
        paint("                                                                 ")->colorWhite()->fonWhite()->print();
        paint("    ___            __________________           _____________    ")->colorWhite()->fonGreen()->print();
        paint("   |   |          |     _________    |         |    ______   \   ")->colorWhite()->fonGreen()->print();
        paint("   |   |__________|    |______   |   |         |   |______|  |   ")->colorWhite()->fonGreen()->print();
        paint("   |    ___________     ______|  |   |         |    _________/   ")->colorWhite()->fonGreen()->print();
        paint("   |   |          |    |         |   |         |   |             ")->colorWhite()->fonGreen()->print();
        paint("   |   |          |    |_________|   |_________|   |             ")->colorWhite()->fonGreen()->print();
        paint("   |___|          |________________________________|             ")->colorWhite()->fonGreen()->print();
        paint("                                                                 ")->colorWhite()->fonGreen()->print();
        paint("                                                                 ")->colorWhite()->fonWhite()->print();
        return $this;
    }
}