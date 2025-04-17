<?php

namespace System\Core\Response\Builders;

use function system\createIndex;

class Meta
{
    protected $key;

    protected $index = 0;

    protected $metas;

    public function __construct($key, array &$metas)
    {
        $this->key = $key;
        $this->metas = &$metas;

        $this->metas[$this->key][$this->index] = array();

        $this->index();
    }

    public function name($value)
    {
        return $this->custom('name', $value);
    }

    public function property($value)
    {
        return $this->custom('property', $value);
    }

    public function content($value)
    {
        return $this->custom('content', $value);
    }

    public function custom($key, $value)
    {
        $this->metas[$this->key][$this->index][$key] = $value;
        return $this;
    }

    public function index(int $index = 0)
    {
        $index = createIndex($this->metas[$this->key], $index, true);

        if(isset($this->metas[$this->key][$this->index])){
            $this->metas[$this->key][$index] = $this->metas[$this->key][$this->index];
            unset($this->metas[$this->key][$this->index]);
        }
        $this->index = $index;
        return $this;
    }
}