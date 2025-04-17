<?php

namespace database;

use System\Core\Database;
use System\Core\Database\Statics\Expression;

function raw($expression)
{
    return new Expression($expression);
}

function now()
{
    return raw("NOW()");
}

function quote($value, $connection = null)
{
    return Database::connect($connection)
        ->quote($value);
}

function compress($value, $connection = null)
{
    if(is_array($value) || is_object($value)){
        $value = json_encode($value);
    }
    $value = quote($value, $connection);
    return raw("COMPRESS($value)");
}

function decompress(...$fields)
{
    $query = array();
    foreach($fields as $field){
        $query[] = "UNCOMPRESS($field) as $field";
    }
    return raw(implode(", ", $query));
}

function toArray($data)
{
    if(is_array($data)){
        return $data;
    }

    $data =  $data ?: array();
    $data = json_encode($data);
    return json_decode($data, true, 2147483647);
}

function toObject($data)
{
    if(is_object($data)){
        return $data;
    }

    $data =  $data ?: array();
    $data = json_encode($data);
    return (object)json_decode($data, false, 2147483647);
}