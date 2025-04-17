<?php

namespace arrays;

use SimpleXMLElement;

function implodeR($glue, $chunks)
{
    $result = '';
    if(is_array($chunks)){
        foreach($chunks as $chunk){
            $result .=  implodeR($glue, $chunk);
        }
    }else{
        $result .= $glue . $chunks;
    }
    return trim($result);
}

function array2xml(SimpleXMLElement $xml, $data)
{
    foreach($data as $key => $value){
//        $key = is_numeric($key) ? $key+1 : mb_strtoupper($key);

        $tmpKey = preg_replace("#^\d+#sm", '', $key);

        if(is_array($value)){
            if(!$tmpKey){
                $child = $xml->addChild('value');
                $child->addAttribute('index', $key);
            }else{
                $child = $xml->addChild($key);
            }
            array2xml($child, $value);
        }else{
            $value = is_null($value) ? '' : $value;

            if(!$tmpKey){
                $child = $xml->addChild('value', htmlspecialchars($value));
                $child->addAttribute('index', $key);
            }else{
                $xml->addChild($key, htmlspecialchars($value));
            }
        }
    }
    return $xml;
}
