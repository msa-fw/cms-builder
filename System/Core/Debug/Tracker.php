<?php

namespace System\Core\Debug;

class Tracker
{
    protected $key;

    protected $startTime;

    protected $track = array();

    public function __construct($key, array &$track)
    {
        $this->key = $key;
        $this->track = &$track;

        $this->startTime = number_format(microtime(true), 50, '.', '');
    }

    /**
     * @return DebugBuilder
     */
    public function end()
    {
        $endTime = number_format(microtime(true), 50, '.', '');
        $debugBuilder = new DebugBuilder($this->key, $this->track);
        $debugBuilder->time($this->startTime, $endTime);
        return $debugBuilder;
    }
}