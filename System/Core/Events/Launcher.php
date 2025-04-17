<?php

namespace System\Core\Events;

use System\Core\Debug;

class Launcher
{
    protected $event;

    protected $lowerEvent;

    protected $arguments = array();

    protected $eventsList = array();

    protected $sortedList = array();

    public function __construct($event, array &$eventsList, ...$arguments)
    {
        $this->event = $event;
        $this->lowerEvent = mb_strtolower($event);
        $this->arguments = $arguments;
        $this->eventsList = &$eventsList;
    }

    public function runEvents()
    {
        if(isset($this->eventsList[$this->lowerEvent])){
            $this->sortEvents();
            foreach($this->eventsList[$this->lowerEvent] as $index => &$event){
                $event['result'] = $this->runEvent($event);
            }
        }
        return $this;
    }

    public function runEvent(array $event)
    {
        if(!$event['enabled']){ return false; }

        $debug = Debug::events();

        $result = false;
        if(is_callable($event['callback'])){
            $result = call_user_func($event['callback'], ...$this->arguments);
        }else
            if(method_exists($event['class'], $event['method'])){
                $eventObject = new $event['class'](...$this->arguments);
                $result = call_user_func_array(array($eventObject, $event['method']), $event['arguments']);
            }

        $debug->end()->query($this->event)
            ->class($event['class'], $event['method']);

        return $result;
    }

    protected function sortEvents()
    {
        if(!isset($this->sortedList[$this->lowerEvent])){
            ksort($this->eventsList[$this->lowerEvent]);
        }
        $this->sortedList[$this->lowerEvent] = true;
        return $this;
    }
}