<?php

namespace System\Core\Console\Dialog;

class Encapsulation
{
    private $question;

    private $answer;

    private $valid;

    public function setQuestion($question)
    {
        $this->question = $question;
        return $this;
    }

    public function setAnswer($answer)
    {
        $this->answer = trim($answer);
        return $this;
    }

    public function setStatus($valid)
    {
        $this->valid = $valid;
        return $this;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function getStatus()
    {
        return $this->valid;
    }
}