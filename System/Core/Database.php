<?php

namespace System\Core;

use System\Core\Database\Driver;
use System\Core\Database\Interfaces\DriverInterface;

class Database
{
    public static $connections = array();

    /**
     * @param null $connectionName
     * @return bool|Driver
     */
    public static function connect($connectionName = null)
    {
        if(!$connectionName){
            $connectionName = Config::database('defaultConnection')->read();
        }

        if(!isset(self::$connections[$connectionName])){
            self::$connections[$connectionName] = self::add($connectionName);
        }
        return self::$connections[$connectionName];
    }

    /**
     * @param $connectionName
     * @return bool|Driver
     */
    public static function add($connectionName)
    {
        /** @var DriverInterface $driverObject */

        if($config = Config::database($connectionName)->read()){
            if(!class_exists($config['driver'])){
                Debug::throw(Language::System('error.unknownDriverClass')->string(true)->replace_k2v(array('%driver%' => $config['driver'])))
                    ->code(1)->file(__FILE__, __LINE__-2)
                    ->backtrace(debug_backtrace())->render();
            }

            $driverObject = new $config['driver']($config);
            $driverObject->connect();

            return new Driver($connectionName, $driverObject);
        }
        return false;
    }
}