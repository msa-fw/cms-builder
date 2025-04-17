<?php

namespace System\Core;

use System\Core\Debug\Tracker;
use System\Core\Cache\Interfaces\DriverInterface;

class Cache
{
    protected $query;

    protected $driver;

    protected $config = array();
    /** @var  DriverInterface */
    protected $driverInterface;
    /** @var  Tracker */
    protected $debug;

    public function __construct()
    {
        $this->driver = Config::cache('driver')->read();

        if(!class_exists($this->driver)){
            Debug::throw(Language::System('error.unknownDriverClass')->string(true)->replace_k2v(array('%driver%' => $this->driver)))
                ->code(256)->file(__FILE__, __LINE__)
                ->backtrace(debug_backtrace())->render();
        }

        $this->config = Config::cache($this->driver)->read();
        $this->driverInterface = new $this->driver($this->config);
        $this->ttl($this->config['expiryTime']);
    }

    /**
     * Set custom predefined key.
     * Need for static objects
     * if `expiryTime` is `0`
     * @param string $key
     * @return $this
     */
    public function key($key)
    {
        $this->driverInterface->key($key);
        return $this;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function path($path)
    {
        $this->driverInterface->path($path);
        return $this;
    }

    /**
     * @param string $query
     * @return $this
     */
    public function query($query)
    {
        $this->query = $query;
        $this->driverInterface->query($this->query);
        return $this;
    }

    /**
     * @param array $bindings
     * @return $this
     */
    public function bindings($bindings)
    {
        if(is_array($bindings)){
            $this->driverInterface->bindings($bindings);
        }
        return $this;
    }

    public function read()
    {
        if($this->config['enabled']){
            if($result = $this->driverInterface->read()){
                $this->debug = Debug::cache();
                return $result;
            }
        }
        return false;
    }

    /**
     * @param mixed $result
     * @return mixed
     */
    public function write($result)
    {
        if($this->config['enabled']){
            if(!$result){
                if($this->config['writeEmptyResult']){
                    return $this->driverInterface->write($result);
                }
                return $result;
            }
            return $this->driverInterface->write($result);
        }
        return $result;
    }

    public function clear(...$keys)
    {
        if($this->config['enabled']){
            return $this->driverInterface->clear(...$keys);
        }
        return $this;
    }

    public function delete()
    {
        if($this->config['enabled']){
            return $this->driverInterface->delete();
        }
        return $this;
    }

    public function ttl($time)
    {
        return $this->driverInterface->ttl($time);
    }

    public function result()
    {
        if($result = $this->driverInterface->result()){
            $this->debug->end()->query($this->query)
                ->file($this->driver . ': '. $this->driverInterface->getCacheKeyPath() . '/' . $this->driverInterface->getCacheKey(), 0)
                ->backtrace(debug_backtrace());

            return $result;
        }
        return null;
    }
}