<?php

namespace System\Core\Console;

class Output
{
    protected $foreGrounds = array(
        'black' =>          array('fg' => 30, 'bg' => 40),
        'red' =>            array('fg' => 31, 'bg' => 41),
        'green' =>          array('fg' => 32, 'bg' => 42),
        'yellow' =>         array('fg' => 33, 'bg' => 43),
        'blue' =>           array('fg' => 34, 'bg' => 44),
        'magenta' =>        array('fg' => 35, 'bg' => 45),
        'cyan' =>           array('fg' => 36, 'bg' => 46),
        'white' =>          array('fg' => 37, 'bg' => 47),
        'brightBlack' =>    array('fg' => 90, 'bg' => 100),
        'brightRed' =>      array('fg' => 91, 'bg' => 101),
        'brightGreen' =>    array('fg' => 92, 'bg' => 102),
        'brightYellow' =>   array('fg' => 93, 'bg' => 103),
        'brightBlue' =>     array('fg' => 94, 'bg' => 104),
        'brightMagenta' =>  array('fg' => 95, 'bg' => 105),
        'brightCyan' =>     array('fg' => 96, 'bg' => 106),
        'brightWhite' =>    array('fg' => 97, 'bg' => 107),
    );

    protected $message;

    protected $fg;
    protected $bg;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function color($color)
    {
        $this->fg = isset($this->foreGrounds[$color]) ? $this->foreGrounds[$color]['fg'] : 37;
        return $this;
    }

    public function fon($color)
    {
        $this->bg = isset($this->foreGrounds[$color]) ? $this->foreGrounds[$color]['bg'] : 40;
        return $this;
    }

    public function get($endOfLine = PHP_EOL)
    {
        return "\033[{$this->fg}m\033[{$this->bg};1m{$this->message}\033[0m" . $endOfLine;
    }

    public function print($endOfLine = PHP_EOL)
    {
        print $this->get($endOfLine);
        return true;
    }
}