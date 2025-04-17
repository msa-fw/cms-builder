<?php

namespace System\Core\Cache\Interfaces;

use System\Core\Cache\Result;

interface DriverInterface
{
    /**
     * @param $key
     * @return self
     */
    public function key($key);
    /**
     * @param $path
     * @return self
     */
    public function path($path);

    /**
     * @param $query
     * @return self
     */
    public function query($query);

    /**
     * @param array $bindings
     * @return self
     */
    public function bindings(array $bindings);

    /**
     * @param $time
     * @return self
     */
    public function ttl($time);

    public function read();

    public function write($result);

    public function clear(...$keys);

    public function delete();

    public function getCacheKey();

    public function getCacheKeyPath();

    /**
     * @return Result
     */
    public function result();
}