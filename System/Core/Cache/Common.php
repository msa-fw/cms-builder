<?php

namespace System\Core\Cache;

class Common
{
    protected $key;

    protected $path;

    protected $query;

    protected $result;

    protected $cacheKey;

    protected $expiryTime;

    protected $cacheKeyPath;

    protected $bindings = array();

    public function key($key)
    {
        $this->key = $key;
        return $this;
    }

    public function path($path)
    {
        $this->path = $path;
        return $this;
    }

    public function query($query)
    {
        $this->query = $query;
        return $this;
    }

    public function bindings(array $bindings)
    {
        foreach($bindings as $key => $value){
            $this->bindings[$key] = $value;
        }
        return $this;
    }

    public function ttl($time)
    {
        $this->expiryTime = $time;
        return $this;
    }

    protected function expired($cacheFile)
    {
        if($this->expiryTime && filemtime($cacheFile) + $this->expiryTime > time()){
            return false;
        }
        unlink($cacheFile);
        return true;
    }

    public function getCacheKey()
    {
        if($this->key){
            return $this->key;  // return pre-defined cache key
        }

        $query = null;
        if($this->query){
            $query .= str_replace(array_keys($this->bindings), '?', $this->query);
        }

        if($this->bindings){
            $query .= json_encode(array_values($this->bindings));
        }

        $this->cacheKey = md5($query);
        return $this->cacheKey;
    }

    public function getCacheKeyPath()
    {
        return $this->cacheKeyPath;
    }

    public function result()
    {
        return new Result($this->result);
    }
}