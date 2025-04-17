<?php

namespace System\Helpers\Classes;

class Files
{
    protected $maxRecursionDepth = 128;

    protected $currentKey = null;

    protected $input = array();

    protected $output= array();

    protected $requiredKeys = array('name', 'type', 'tmp_name', 'error', 'size', 'full_path');

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function setRequiredKeys(...$_)
    {
        $this->requiredKeys = $_;
        return $this;
    }

    /**
     * The variable `$maxNestingDepth = 128` should be stop
     * recursion when the specified depth is reached.
     * @param int $maxNestingDepth
     * @return $this
     */
    public function prepare($maxNestingDepth = 128)
    {
        $this->maxRecursionDepth = $maxNestingDepth;
        $this->prepareMultilevelFilesArray($this->input, $this->output);
        return $this;
    }

    public function output()
    {
        return $this->output;
    }

    protected function prepareMultilevelFilesArray($input, &$output, &$depth = 0)
    {
        if($depth > $this->maxRecursionDepth){ return; }

        $depth++;

        if(is_array($input)){
            foreach($input as $key => $values){
                // lock field names `error`, `size`, `name`, `type`, `tmp_name`
                if($this->checkRequiredKeys($input)){
                    $this->currentKey = $key;
                    $this->prepareMultilevelFilesArray($values, $output, $depth);
                }else
                    if(is_array($values)){
                        $this->prepareMultilevelFilesArray($values, $output[$key], $depth);
                    }else{
                        $depth = 0;
                        $output[$key][$this->currentKey] = $values;
                    }
            }
        }else{
            $depth = 0;
            $output[$this->currentKey] = $input;
        }
    }

    protected function checkRequiredKeys($input)
    {
        foreach($this->requiredKeys as $field){
            if(!isset($input[$field])){ return false;}
        }
        return true;
    }
}