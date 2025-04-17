<?php

namespace Controllers\_BaseController_\Console;

use System\Core\Console\Dialog;
use System\Core\Console\ConsoleInterface;
use System\Core\Console\Dialog\DialogInterface;
use function console\danger;
use function console\success;
use function console\warning;

class TestsCommand
{
    protected $needed = 'test';
    /** @var ConsoleInterface */
    protected $console;

    public function __construct(ConsoleInterface $console)
    {
        $this->console = $console;
    }

    /**
     * Validation with callback
     * @return bool
     */
    public function test()
    {
        $dialog = new Dialog(" Please enter `$this->needed` ");

        $dialog->validate()->call(function(DialogInterface $dialog){
            return $dialog->getAnswer() == $this->needed;
        });

        if($dialog->getStatus()){
            return success(' OK, thanks ')->print();
        }
        danger(" Input string `" . $dialog->getAnswer() . "` not equal with `$this->needed` string ")->print();
        return $this->test();
    }

    /**
     * Simple validation: comparing strings
     * @return bool
     */
    public function test2()
    {
        $dialog = new Dialog(" Please enter `$this->needed` ");

        if($dialog->validate()->compare($this->needed)->getStatus()){
            return success(' OK, thanks ')->print();
        }
        danger(" Input string `" . $dialog->getAnswer() . "` not equal with `$this->needed` string ")->print();
        return $this->test2();
    }

    /**
     * No validation mode
     * @return bool
     */
    public function test3()
    {
        $question = warning(" Please enter `$this->needed` ")->get('');

        $dialog = new Dialog($question);

        if($dialog->getAnswer()){
            return success(' OK, thanks ')->print();
        }
        danger(" Input string `" . $dialog->getAnswer() . "` not equal with `$this->needed` string ")->print();
        return $this->test3();
    }
}