<?php

namespace System\Core\Database\Table\Abstracts;

use System\Core\Database\Interfaces\CollateInterface;

abstract class TableAttributes
{
    protected $charset;
    protected $collate;
    protected $directory;
    protected $attributes = array();

    /**
     * @param CollateInterface $collate
     * @return $this
     */
    public function collate(CollateInterface $collate)
    {
        if($collate instanceof CollateInterface){
            $this->charset = $collate->getCharset();
            $this->collate = $collate->getCollate();
        }
        return $this;
    }

    public function directory($directory)
    {
        $this->directory = $directory;
        return $this;
    }

    public function autoextendSize($value = 0)
    {
        $this->attributes['autoextendSize'] = $value;
        return $this;
    }
    public function autoIncrement($value = 0)
    {
        $this->attributes['autoIncrement'] = $value;
        return $this;
    }
    public function avgRowLength($value = 0)
    {
        $this->attributes['avgRowLength'] = $value;
        return $this;
    }
    public function checksum($value = true)
    {
        $this->attributes['checksum'] = $value;
        return $this;
    }
    public function comment($value)
    {
        $this->attributes['comment'] = $value;
        return $this;
    }
    public function compression($value)
    {
        $this->attributes['compression'] = $value;
        return $this;
    }
    public function connection($value)
    {
        $this->attributes['connection'] = $value;
        return $this;
    }
    public function delayKeyWrite($value = true)
    {
        $this->attributes['delayKeyWrite'] = $value;
        return $this;
    }
    public function encryption($value)
    {
        $this->attributes['encryption'] = $value;
        return $this;
    }
    public function engine($value)
    {
        $this->attributes['engine'] = $value;
        return $this;
    }
    public function engineAttribute($value)
    {
        $this->attributes['engineAttribute'] = $value;
        return $this;
    }
    public function insertMethod($value)
    {
        $this->attributes['insertMethod'] = $value;
        return $this;
    }
    public function keyBlockSize($value)
    {
        $this->attributes['keyBlockSize'] = $value;
        return $this;
    }
    public function maxRows($value)
    {
        $this->attributes['maxRows'] = $value;
        return $this;
    }
    public function minRows($value)
    {
        $this->attributes['minRows'] = $value;
        return $this;
    }
    public function packKeys($value)
    {
        $this->attributes['packKeys'] = $value;
        return $this;
    }
    public function password($value)
    {
        $this->attributes['password'] = $value;
        return $this;
    }
    public function rowFormat($value)
    {
        $this->attributes['rowFormat'] = $value;
        return $this;
    }
    public function startTransaction()
    {
        $this->attributes['startTransaction'] = false;
        return $this;
    }
    public function secondaryEngineAttribute($value)
    {
        $this->attributes['secondaryEngineAttribute'] = $value;
        return $this;
    }
    public function statsAutoRecalc($value)
    {
        $this->attributes['statsAutoRecalc'] = $value;
        return $this;
    }
    public function statsPersistent($value)
    {
        $this->attributes['statsPersistent'] = $value;
        return $this;
    }
    public function statsSamplePages($value)
    {
        $this->attributes['statsSamplePages'] = $value;
        return $this;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getCharset()
    {
        return $this->charset;
    }

    public function getCollate()
    {
        return $this->collate;
    }

    public function getDirectory()
    {
        return $this->directory;
    }
}