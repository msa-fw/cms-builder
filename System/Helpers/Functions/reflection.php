<?php

namespace reflection;

use ReflectionType;
use ReflectionClass;
use ReflectionMethod;
use ReflectionFunction;

function countCallbackParams($callback)
{
    $reflection = new ReflectionFunction($callback);
    return count($reflection->getParameters());
}

function getCallbackParams($callback)
{
    $reflection = new ReflectionFunction($callback);
    return $reflection->getParameters();
}

function getCallbackParamType($name, $callback)
{
    foreach(getCallbackParams($callback) as $item){
        if($item->getName() == $name){
            $type = $item->getType();
            return $type instanceof ReflectionType ? $type->getName() : null;
        }
    }
    return false;
}

function countMethodRequiredParams($action, $method)
{
    $reflect = new ReflectionMethod($action, $method);
    return $reflect->getNumberOfRequiredParameters();
}

function getClassPublicMethodsList($className)
{
    $reflection = new ReflectionClass($className);
    return $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
}