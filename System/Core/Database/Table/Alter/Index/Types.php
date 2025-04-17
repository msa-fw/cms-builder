<?php

namespace System\Core\Database\Table\Alter\Index;

class Types
{
    protected $name;
    protected $indexes = array();

    public function __construct($name, array &$index)
    {
        $this->name = $name;
        $this->indexes = &$index;
    }

    public function key()
    {
        $this->indexes[$this->name]['type'] = 'key';
        return $this;
    }
    public function unique()
    {
        $this->indexes[$this->name]['type'] = 'unique';
        return $this;
    }
    public function primary()
    {
        $this->indexes[$this->name]['type'] = 'primary';
        return $this;
    }
    public function fulltext()
    {
        $this->indexes[$this->name]['type'] = 'fulltext';
        return $this;
    }
}