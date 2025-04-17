<?php

namespace System\Core\Database\Table\Alter\Index;

class Operators
{
    protected $name;
    protected $indexes = array();

    public function __construct($name, array &$index)
    {
        $this->name = $name;
        $this->indexes = &$index;
        $this->indexes[$this->name]['type'] = 'index';
    }

    public function add($columnName)
    {
        $this->indexes[$this->name]['colName'] = $columnName;
        $this->indexes[$this->name]['operator'] = 'add';
        return new Types($this->name, $this->indexes);
    }

    public function drop()
    {
        $this->indexes[$this->name]['operator'] = 'drop';
        return new Types($this->name, $this->indexes);
    }

    public function rename($newName)
    {
        $this->indexes[$this->name]['newName'] = $newName;
        $this->indexes[$this->name]['operator'] = 'rename';
    }
}