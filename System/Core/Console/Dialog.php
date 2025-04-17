<?php

namespace System\Core\Console;

use System\Core\Console\Dialog\Validator;
use System\Core\Console\Dialog\Encapsulation;
use System\Core\Console\Dialog\DialogInterface;
use function console\paint;

class Dialog extends Encapsulation implements DialogInterface
{
    protected static $headerPrinted;

    public function __construct($question, $printWelcomeMessage = true)
    {
        $this->setQuestion($question);
        if($printWelcomeMessage){
            $this->printWelcomeMessage();
        }
        $this->initialize();
    }

    protected function printWelcomeMessage()
    {
        if(!self::$headerPrinted){
            paint("                                                              ")->colorWhite()->fonMagenta()->print();
            paint("        Welcome to Interactive Command Line Interface!        ")->colorWhite()->fonMagenta()->print();
            paint("        Press 'Ctrl + C' to escape.                           ")->colorWhite()->fonMagenta()->print();
            paint("______________________________________________________________")->colorWhite()->fonMagenta()->print();
            self::$headerPrinted = true;
        }
        return self::$headerPrinted;
    }

    protected function initialize()
    {
        print $this->getQuestion() . ": > ";
        $answer = trim(fgets(STDIN));
        $this->setAnswer($answer);
        return $this;
    }

    public function validate()
    {
        return new Validator($this);
    }
}