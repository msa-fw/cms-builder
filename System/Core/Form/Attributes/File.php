<?php

namespace System\Core\Form\Attributes;

use System\Core\Form\Attributes;
use System\Core\Form\Statics\Mime;

/**
 * Class File
 * @method $this multiple(bool $value)
 * @method $this required(bool $value)
 * @package System\Core\Form\Attributes
 */
class File extends Attributes
{
    public function __construct($name, &$field)
    {
        parent::__construct($name, $field);

        $this->class('file-field ');
    }

    /**
     * @param callable|Mime $callback
     * @return $this
     */
    public function accept(callable $callback)
    {
        $mimeObject = new Mime();
        call_user_func($callback, $mimeObject);

        $mimeTypes = array();
        foreach($mimeObject->getCollection() as $mime => $types){
            $types = $types ?: array('*');

            foreach($types as $type){
                $mimeTypes[] = "{$mime}/{$type}";
            }
        }

        $this->attribute('accept', $mimeTypes);
        return $this;
    }

    public function extensions(...$_)
    {
        $mimeTypes = array();
        foreach($_ as $item){
            if(is_array($item)){
                foreach($item as $mimeType){
                    $mimeTypes[] = $mimeType;
                }
            }else{
                $mimeTypes[] = $item;
            }
        }

        $this->attribute('accept', $mimeTypes);
        return $this;
    }

    public function minSize($bites)
    {
        $this->attribute('min-size', $bites);
        return $this;
    }

    public function maxSize($bites)
    {
        $this->attribute('max-size', $bites);
        return $this;
    }
}