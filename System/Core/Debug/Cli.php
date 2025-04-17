<?php

namespace System\Core\Debug;

use System\Core\Language;

use function console\danger;
use function console\message;
use function console\warning;

class Cli
{
    protected $message = '';

    protected $arguments = array(
        'code' => 0,
        'file' => '',
        'line' => '',
        'class' => '',
        'method' => '',
        'message' => '',
        'context' => '',
        'backtrace' => array(),
        'arguments' => array(),
        'isCritical' => false,
    );

    public function __construct(array $arguments)
    {
        $this->arguments = $arguments;

        $this->message = Language::System("error.error_code_{$this->arguments['code']}")->read(' UNKNOWN CRITICAL ERROR! ');
        $this->message = mb_strtoupper($this->message);
    }

    public function render()
    {
        print "           ";
        danger(" {$this->message} (CODE #{$this->arguments['code']}) ")->print();

        $this->renderMessageError();

        exit;
    }

    protected function renderMessageError()
    {
        if(isset($this->arguments['arguments'])){
            foreach($this->arguments['arguments'] as $argument){
                $message = '';
                if(isset($argument['CODE'])){
                    $message .= " CODE #{$argument['CODE']}";
                }
                if(isset($argument['SQL'])){
                    $message .= ": {$argument['SQL']}";
                }
                if($message){
                    print " QUERY     ";
                    danger($message)->print();
                }
            }
        }

        $tmp = explode("\nStack trace:", $this->arguments['message']);
        if(!isset($tmp[1])){
            message(" MESSAGE: ")->print(' ');
            danger(" {$this->arguments['message']} ")->print();
        }else{
            $tmp[0] = trim($tmp[0]);
            $tmp[1] = trim($tmp[1]);

            message(" MESSAGE: ")->print(' ');
            danger(" {$tmp[0]} ")->print();

            message(" TRACE:   ")->print('     ');

            foreach(explode("\n", $tmp[1]) as $index => $line){
                $line = trim($line);
                if($index){ print "               "; }
                warning(" $line ")->print();
            }
        }

        message(" FILE:    ")->print(' ');
        message(" {$this->arguments['file']} (LINE: {$this->arguments['line']}) ", 'white', 'magenta')->print();
        return $this;
    }

    public function renderErrorMessageHeader()
    {
        message("                                                                ", 'black', 'white')->print();
        danger("    _______     _______     _______     ________     _______    ")->print();
        danger("   |=======|   |=======|   |=======|   |========|   |=======|   ")->print();
        danger("   |=|_____    |=|   |=|   |=|   |=|   |=|    |=|   |=|   |=|   ")->print();
        danger("   |=======|   |=|   /=|   |=|   /=|   |=|    |=|   |=|   /=|   ")->print();
        danger("   |=|         |======/    |======/    |=|    |=|   |======/    ")->print();
        danger("   |=|         |=| \=\     |=| \=\     |=|    |=|   |=| \=\     ")->print();
        danger("   |=|_____    |=|  \=\    |=|  \=\    |=|____|=|   |=|  \=\    ")->print();
        danger("   |=======|   |=|   \=\   |=|   \=\   |========|   |=|   \=\   ")->print();
        danger("                                                                ")->print();
        message("                                                                ", 'black', 'white')->print();
        return $this;
    }
}