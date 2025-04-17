<?php

namespace System\Core\Cache\Drivers;

use System\Core\Cache\Common;
use System\Core\Cache\Interfaces\DriverInterface;

use function filesystem\root;
use function filesystem\read;
use function filesystem\getTmpPath;
use function filesystem\makeDirectory;
use function filesystem\scanDirectoryCallback;

/**
 * Class JSON
 * @package System\Core\Cache\Drivers
 * @method DriverInterface key($key)
 * @method DriverInterface ttl($time)
 * @method DriverInterface query($query)
 * @method DriverInterface bindings(array $bindings)
 * @method DriverInterface getCacheKey()
 * @method DriverInterface getCacheKeyPath()
 */
class JSON extends Common implements DriverInterface
{
    protected static $cacheRoot;

    protected $config = array();

    public function __construct(array $config)
    {
//        ignore_user_abort(true);

        $this->config = $config;

        if(!self::$cacheRoot){
            $this->defineCacheRoot();
        }
    }

    public function __destruct()
    {
//        ignore_user_abort(false);
    }

    public function defineCacheRoot()
    {
        self::$cacheRoot = root(getTmpPath($this->config['directory'] . '/json'));
        makeDirectory(self::$cacheRoot);
        return $this;
    }

    public function path($path)
    {
        parent::path($path);
        $this->cacheKeyPath = str_replace('.', DIRECTORY_SEPARATOR, $this->path);
        return $this;
    }

    public function read()
    {
        $cacheDirectory = self::$cacheRoot . "/{$this->cacheKeyPath}";
        $cacheFile = "{$cacheDirectory}/{$this->getCacheKey()}.json";

        if(file_exists($cacheFile)){
            if($this->expired($cacheFile)){
                return false;
            }

            $this->result = read($cacheFile);
            return true;
        }
        return false;
    }

    public function write($result)
    {
        $cacheDirectory = self::$cacheRoot . "/{$this->cacheKeyPath}";
        makeDirectory($cacheDirectory);

        $cacheFile = "{$cacheDirectory}/{$this->getCacheKey()}.json";
        file_put_contents($cacheFile, json_encode($result, JSON_PRETTY_PRINT));
        return $result;
    }

    public function delete()
    {
        $cacheFile = self::$cacheRoot . "/{$this->cacheKeyPath}/{$this->getCacheKey()}.json";
        if(file_exists($cacheFile)){
            return unlink($cacheFile);
        }
        return false;
    }

    public function clear(...$keys)
    {
        $keys = $keys ?: [$this->path];

        foreach($keys as $key){
            $key = str_replace('.', '/', $key);

            $cacheDirectory = self::$cacheRoot . "/{$key}";

            scanDirectoryCallback($cacheDirectory, function($file){
                if(is_file($file)){
                    return unlink($file);
                }
                if(is_dir($file)){
                    return rmdir($file);
                }
                return false;
            });
        }
        return $this;
    }

    public function result()
    {
        return parent::result();
    }
}