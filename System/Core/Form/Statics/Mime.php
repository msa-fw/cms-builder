<?php

namespace System\Core\Form\Statics;

use System\Core\Form\Mime\Application;
use System\Core\Form\Mime\Audio;
use System\Core\Form\Mime\Chemical;
use System\Core\Form\Mime\Font;
use System\Core\Form\Mime\Image;
use System\Core\Form\Mime\Message;
use System\Core\Form\Mime\Model;
use System\Core\Form\Mime\Text;
use System\Core\Form\Mime\Video;
use System\Core\Form\Mime\XEPoc;
use System\Core\Form\Mime\XConference;
use System\Core\Form\Mime\ZzApplication;
use System\Core\Form\Mime\FlvApplication;

class Mime
{
    protected $current;
    protected $collection = array();

    public function application()
    {
        $this->set('application');
        return new Application($this->current, $this->collection);
    }

    public function audio()
    {
        $this->set('audio');
        return new Audio($this->current, $this->collection);
    }

    public function chemical()
    {
        $this->set('chemical');
        return new Chemical($this->current, $this->collection);
    }

    public function font()
    {
        $this->set('font');
        return new Font($this->current, $this->collection);
    }

    public function image()
    {
        $this->set('image');
        return new Image($this->current, $this->collection);
    }

    public function message()
    {
        $this->set('message');
        return new Message($this->current, $this->collection);
    }

    public function model()
    {
        $this->set('model');
        return new Model($this->current, $this->collection);
    }

    public function text()
    {
        $this->set('text');
        return new Text($this->current, $this->collection);
    }

    public function video()
    {
        $this->set('video');
        return new Video($this->current, $this->collection);
    }

    public function xEPoc()
    {
        $this->set('x-epoc');
        return new XEPoc($this->current, $this->collection);
    }

    public function xConference()
    {
        $this->set('x-conference');
        return new XConference($this->current, $this->collection);
    }

    public function zzApplication()
    {
        $this->set('zz-application');
        return new ZzApplication($this->current, $this->collection);
    }

    public function flvApplication()
    {
        $this->set('flv-application');
        return new FlvApplication($this->current, $this->collection);
    }

    protected function set($mime)
    {
        $this->current = $mime;
        return $this;
    }

    public function getCollection()
    {
        return $this->collection;
    }

    public function getCurrent()
    {
        return $this->current;
    }
}