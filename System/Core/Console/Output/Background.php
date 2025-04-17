<?php

namespace System\Core\Console\Output;

use System\Core\Console\Output;

class Background
{
    protected $message;

    protected $color;

    public function __construct($message, $color)
    {
        $this->message = $message;
        $this->color = $color;
    }

    public function fonBlack()
    {
        return $this->result('black');
    }

    public function fonRed()
    {
        return $this->result('red');
    }

    public function fonGreen()
    {
        return $this->result('green');
    }

    public function fonYellow()
    {
        return $this->result('yellow');
    }

    public function fonBlue()
    {
        return $this->result('blue');
    }

    public function fonMagenta()
    {
        return $this->result('magenta');
    }

    public function fonCyan()
    {
        return $this->result('cyan');
    }

    public function fonWhite()
    {
        return $this->result('white');
    }

    public function fonBrightBlack()
    {
        return $this->result('brightBlack');
    }

    public function fonBrightRed()
    {
        return $this->result('brightRed');
    }

    public function fonBrightGreen()
    {
        return $this->result('brightGreen');
    }

    public function fonBrightYellow()
    {
        return $this->result('brightYellow');
    }

    public function fonBrightBlue()
    {
        return $this->result('brightBlue');
    }

    public function fonBrightMagenta()
    {
        return $this->result('brightMagenta');
    }

    public function fonBrightCyan()
    {
        return $this->result('brightCyan');
    }

    public function fonBrightWhite()
    {
        return $this->result('brightWhite');
    }

    public function result($background = '')
    {
        $output = new Output($this->message);
        $output->color($this->color);
        $output->fon($background);
        return $output;
    }
}