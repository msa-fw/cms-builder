<?php

namespace System\Core\Console;

use System\Core\Language;

use function console\paint;
use function console\message;
use function console\success;

class Debug
{
    protected $timer;

    protected $memory;

    protected $headers = array();

    public static function start(...$lines)
    {
        return new self(...$lines);
    }

    public function __construct(...$headers)
    {
        $this->headers = $headers;
        $this->timer = microtime(true);
        $this->memory = memory_get_usage();
    }

    public function end()
    {
        $eol = " | ";
        $limitLine = str_repeat('-', 150);

        message(PHP_EOL . $limitLine, 'white')->print();

        paint('PHP ' . phpversion())->colorWhite()->fonBlue()->print(' / ');

        foreach($this->headers as $line){
            $line = paint($line)->colorWhite()->fonMagenta()->get('');

            message(Language::System('console.debug.addictedLine')
                ->string(true)->replace_k2v(array('%line%' => $line)))->print(": ");
        }

        $time = success(' ' . number_format(microtime(true) - $this->timer, 5, '.', ',') . ' ')->get('');
        $mem = success(' ' . number_format((memory_get_usage()-$this->memory)/1024, 3, '.', ',') . ' ')->get('');
        $peak = success(' ' . number_format((memory_get_peak_usage())/1024, 3, '.', ',') . ' ')->get('');

        message(Language::System('console.debug.pageGenerationTime')
            ->string(true)->replace_k2v(array('%time%' => $time)))->print($eol);

        message(Language::System('console.debug.pageMemoryUsage')
            ->string(true)->replace_k2v(array('%memory%' => $mem)))->print($eol);

        message(Language::System('console.debug.pageMemoryUsagePeak')
            ->string(true)->replace_k2v(array('%memory%' => $peak)))->print();

        message($limitLine, 'white')->print();
    }
}