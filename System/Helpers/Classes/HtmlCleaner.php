<?php

namespace System\Helpers\Classes;

use DOMDocument, DOMXPath, DOMAttr;
use System\Helpers\Classes\HtmlCleaner\Builder;

class HtmlCleaner
{
    protected static $debug = array();

    protected $content;

    protected $allowed = array();

    protected $removable = array();

    protected $nonClosestTags = array(
        'area'      => true,
        'base'      => true,
        'br'        => true,
        'col'       => true,
        'embed'     => true,
        'hr'        => true,
        'img'       => true,
        'input'     => true,
        'link'      => true,
        'meta'      => true,
        'param'     => true,
        'source'    => true,
        'track'     => true,
        'wbr'       => true,
        'command'   => true,
        'keygen'    => true,
        'menuitem'  => true,
        'frame'     => true,
    );

    public function __construct($content)
    {
        self::$debug['startTime'] = microtime(true);
        self::$debug['startMemory'] = memory_get_usage();

        $this->content = trim($content);
    }

    public function __destruct()
    {
        /*pre(
            number_format(microtime(true) - self::$debug['startTime'], 10, '.', ','),
            number_format(memory_get_usage() - self::$debug['startMemory'], 2, '.', ',')
        );*/
    }

    /**
     * @param callable|Builder $allowedTagsList
     * @param callable|Builder|null $removableTagsWithContentList
     * @return $this
     */
    public function filter(callable $allowedTagsList, callable $removableTagsWithContentList = null)
    {
        $allowedBuilder = new Builder($this->allowed);
        call_user_func($allowedTagsList, $allowedBuilder);

        if($removableTagsWithContentList){
            $removableBuilder = new Builder($this->removable);
            call_user_func($removableTagsWithContentList, $removableBuilder);
        }
        return $this;
    }

    public function clean()
    {
        $doc = new DOMDocument();
        $doc->loadHTML($this->content);

        $xpath = new DOMXPath($doc);
        $nodes = $xpath->query("/*");

        $content = '';
        foreach($nodes as $node){
            $content .= $this->parseDomObject($node);
        }
        return $content;
    }

    /**
     * @param \DOMElement|\DOMText $node
     * @return string
     */
    protected function parseDomObject($node)
    {
        if($node->childNodes->length > 0){
            $content = '';
            foreach($node->childNodes as $index => $child){
                $name = mb_strtolower($child->nodeName);

                if(isset($this->removable[$name])){
                    $content .= $this->checkRemovableTag($child, $this->removable[$name]);
                }else
                if(isset($this->allowed[$name])){
                    $content .= $this->checkAllowedTag($child, $this->allowed[$name]);
                }else{
                    $content .= $this->parseDomObject($child);
                }
            }
            return $content;
        }
        return $node->textContent;
    }

    protected function checkRemovableTag($child, array $options)
    {
        $content = '';
        if($cleaned = $this->validateTag($child, $this->removable)){
            $name = mb_strtolower($child->nodeName);

            $content .= "<{$name}";
            $content .= " {$cleaned}";

            if(!isset($this->nonClosestTags[$name])){
                $content .= ">\n";
                $content .= $this->parseDomObject($child);
                $content .= "\n</{$name}>";
            }else{
                $content .= "/>\n";
            }
        }
        return $content;
    }

    protected function checkAllowedTag($child, array $options)
    {
        $content = '';
        if($cleaned = $this->validateTag($child, $this->allowed)){
            $name = mb_strtolower($child->nodeName);

            $content .= "<{$name}";
            $content .= " {$cleaned}";

            if(!isset($this->nonClosestTags[$name])){
                $content .= ">\n";
                $content .= $this->parseDomObject($child);
                $content .= "\n</{$name}>";
            }else{
                $content .= "/>\n";
            }
        }else{
            if($options['opts']['removeTagWithoutAttributes']){
                $content .= $this->parseDomObject($child);
            }else{
                $name = mb_strtolower($child->nodeName);

                $content .= "<{$name}";
                if(!isset($this->nonClosestTags[$name])){
                    $content .= ">\n";
                    $content .= $this->parseDomObject($child);
                    $content .= "\n</{$name}>";
                }else{
                    $content .= "/>\n";
                }
            }
        }
        return $content;
    }

    protected function validateTag($node, array $definedTagsList)
    {
        $attributes = array();
        $name = mb_strtolower($node->nodeName);

        if($definedTagsList[$name]){
            foreach($node->attributes as $attrIndex => $attribute){
                $attrName = mb_strtolower($attribute->nodeName);

                if(!array_key_exists($attrName, $definedTagsList[$name]['attr'])){ continue; }

                if($valid = $this->validateAttribute($node, $attribute, $definedTagsList[$name]['attr'][$attrName])){
                    $attributes[] = $valid;
                }
            }
        }
        return implode(' ', $attributes);
    }

    protected function validateAttribute($parent, $attribute, $callback)
    {
        $attrName = mb_strtolower($attribute->nodeName);

        if(is_callable($callback) && $callback){
            $attribute->nodeValue = call_user_func($callback, $attribute, $parent);
        }

        if($attribute->nodeValue){
            return "{$attrName}=\"{$attribute->nodeValue}\"";
        }
        return null;
    }
}