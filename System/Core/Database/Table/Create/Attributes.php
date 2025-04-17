<?php

namespace System\Core\Database\Table\Create;

use System\Core\Database\Interfaces\CollateInterface;

/**
 * Class Attributes
 * @package System\Core\Database\Table\Create
 * @method self first()
 * @method self after($field)
 * @method self unsigned()
 * @method self zerofill()
 * @method self currentTimestamp()
 * @method self currentTimestampOnUpdate()
 */
class Attributes
{
    protected $name;
    protected $column = array();

    public function __call($name, $arguments)
    {
        $name = strtolower($name);
        $this->column['attributes'][$name] = true;
        return $this;
    }

    public function __construct($name, array &$column)
    {
        $this->name = $name;
        $this->column = &$column;
    }

    public function comment($comment)
    {
        $this->column['attributes']['comment'] = $comment;
        return $this;
    }

    /**
     * @param CollateInterface $collate
     * @return $this
     */
    public function collate(CollateInterface $collate)
    {
        if($collate instanceof CollateInterface){
            $this->column['attributes']['charset'] = $collate->getCharset();
            $this->column['attributes']['collate'] = $collate->getCollate();
        }
        return $this;
    }

    public function primary()
    {
        $this->column['indexes']['primary'] = true;
        return $this;
    }

    public function key($name = '')
    {
        $name = $name ?: $this->name;
        $this->column['indexes']['keys'][] = $name;
        return $this;
    }

    public function index($name = '', $length = 0)
    {
        $name = $name ?: $this->name;
        $this->column['indexes']['index'][$name] = $length;
        return $this;
    }

    public function unique($name = '', $length = 0)
    {
        $name = $name ?: $this->name;
        $this->column['indexes']['unique'][$name] = $length;
        return $this;
    }

    public function fulltext($name = '', $length = 0)
    {
        $name = $name ?: $this->name;
        $this->column['indexes']['fulltext'][$name] = $length;
        return $this;
    }
}