<?php

namespace System\Core\Console\Dialog;

class Validator
{
    protected $dialog;

    public function __construct(DialogInterface $dialog)
    {
        $this->dialog = $dialog;
    }

    public function call(callable $callback)
    {
        $this->dialog->setStatus(call_user_func($callback, $this->dialog));

        return $this->dialog;
    }

    public function compare($value, $strict = false)
    {
        $answer = $this->dialog->getAnswer();

        if($strict){
            $valid = ($answer === $value);
        }else{
            $value = mb_strtolower($value);
            $answer = mb_strtolower($answer);

            $valid = ($answer == $value);
        }

        $this->dialog->setStatus($valid);

        return $this->dialog;
    }
}