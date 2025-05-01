<?php

namespace templates;

use System\Helpers\Classes\Fs;
use System\Helpers\Classes\Render\Modal;

use function web\render;

function modal($modalLinkValue)
{
    return new Modal($modalLinkValue);
}

function n2br($value)
{
    return str_replace("\n", '<br>', $value);
}

function br2n($value)
{
    return str_replace('<br>', "\n", $value);
}

function attributes2string(array $attributes, $skipEmptyValues = true, ...$skips)
{
    $result = array();
    foreach($attributes as $key => $value){
        if($skips && in_array($key, $skips)){ continue; }
        if(!$value && $skipEmptyValues){ continue; }
        $result[] = "{$key}=\"$value\"";
    }
    return implode(' ', $result);
}

function paginate($pagination, $printOutput = true)
{
    if($pagination){
        $template = Fs::server()->theme($pagination['template']);
        if(file_exists($template)){
            $output = render($template, $pagination);
            return $printOutput ? print($output) : $output;
        }
    }
    return '';
}