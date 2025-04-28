<?php

if(!function_exists('apache_request_headers')){
    function apache_request_headers()
    {
        $result = array();
        foreach($_SERVER as $key => $value){
            if(strpos($key, 'HTTP_') === 0){
                $key = substr($key, 5);
                $key = str_replace('_', '-', $key);
                $key = mb_strtolower($key);
                $result[$key] = trim($value);
            }
        }
        return $result;
    }
}