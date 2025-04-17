<?php

namespace System\Core\Events;

class Hub
{
    protected $event;

    protected $eventsList = array();

    public function __construct($event, array &$eventsList)
    {
        $this->event = $event;
        $this->eventsList = &$eventsList;
    }

    /**
     * @param array ...$arguments
     * @return Launcher
     */
    public function run(...$arguments)
    {
        $launcher = new Launcher($this->event, $this->eventsList, ...$arguments);
        return $launcher->runEvents();
    }

    /**
     * @param int $eventType
     * @return Builder
     */
    public function add($eventType = Builder::INDEX_POSITION_APPEND)
    {
        return new Builder($this->event, $eventType, $this->eventsList);
    }

    /**
     * @return Builder
     */
    public function append()
    {
        return new Builder($this->event, Builder::INDEX_POSITION_APPEND, $this->eventsList);
    }

    /**
     * @return Builder
     */
    public function prepend()
    {
        return new Builder($this->event, Builder::INDEX_POSITION_PREPEND, $this->eventsList);
    }
}