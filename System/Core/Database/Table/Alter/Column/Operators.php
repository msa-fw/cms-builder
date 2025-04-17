<?php

namespace System\Core\Database\Table\Alter\Column;

use System\Core\Database\Table\Create\Column;

class Operators
{
    protected $name;
    protected $columns = array();

    public function __construct($name, array &$columns)
    {
        $this->name = $name;
        $this->columns = &$columns;
    }

    public function add()
    {
        $this->columns[$this->name]['operator'] = 'add';
        return new Column($this->name, $this->columns[$this->name]);
    }

    public function drop()
    {
        $this->columns[$this->name]['operator'] = 'drop';
    }

    public function rename($newName)
    {
        $this->columns[$this->name]['newName'] = $newName;
        $this->columns[$this->name]['operator'] = 'rename';
    }

    public function change($newName)
    {
        $oldName = $this->name;
        $tmp = $this->columns[$this->name];
        unset($this->columns[$oldName]);

        $this->name = $newName;

        $this->columns[$this->name] = $tmp;
        $this->columns[$this->name]['newName'] = $oldName;
        $this->columns[$this->name]['operator'] = 'change';
        return new Column($this->name, $this->columns[$this->name]);
    }

    public function modify()
    {
        $this->columns[$this->name]['operator'] = 'modify';
        return new Column($this->name, $this->columns[$this->name]);
    }
}