<?php

namespace System\Core\Console\Dialog;

interface DialogInterface
{
    public function setQuestion($question);

    public function setAnswer($answer);

    public function setStatus($valid);

    public function getQuestion();

    public function getAnswer();

    public function getStatus();

    public function validate();
}