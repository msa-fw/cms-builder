<?php

namespace System\Core\Console\Output;

class Color
{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function colorBlack()
    {
        return $this->fon('black');
    }

    public function colorRed()
    {
        return $this->fon('red');
    }

    public function colorGreen()
    {
        return $this->fon('green');
    }

    public function colorYellow()
    {
        return $this->fon('yellow');
    }

    public function colorBlue()
    {
        return $this->fon('blue');
    }

    public function colorMagenta()
    {
        return $this->fon('magenta');
    }

    public function colorCyan()
    {
        return $this->fon('cyan');
    }

    public function colorWhite()
    {
        return $this->fon('white');
    }

    public function colorBrightBlack()
    {
        return $this->fon('brightBlack');
    }

    public function colorBrightRed()
    {
        return $this->fon('brightRed');
    }

    public function colorBrightGreen()
    {
        return $this->fon('brightGreen');
    }

    public function colorBrightYellow()
    {
        return $this->fon('brightYellow');
    }

    public function colorBrightBlue()
    {
        return $this->fon('brightBlue');
    }

    public function colorBrightMagenta()
    {
        return $this->fon('brightMagenta');
    }

    public function colorBrightCyan()
    {
        return $this->fon('brightCyan');
    }

    public function colorBrightWhite()
    {
        return $this->fon('brightWhite');
    }

    public function fon($color = '')
    {
        return new Background($this->message, $color);
    }
}