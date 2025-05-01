<?php

namespace System\Helpers\Classes;

use DOMDocument, DOMXPath, DOMAttr;
use System\Helpers\Classes\HtmlCleaner\Builder;

class HtmlCleaner
{
    protected $content;

    protected $useInternalErrors;

    protected $charset;

    protected $allowed = array();

    protected $removable = array();

    protected $removeComments = false;

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

    protected $replaceEol = '';

    protected $line2p = false;

    protected $line2pDropEmptyLines = true;

    protected $errors = array();

    public function __construct($content, $useInternalErrors = true)
    {
        $this->content = trim($content);
        $this->useInternalErrors = $useInternalErrors;
    }

    public function __destruct()
    {}

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

    public function removeComments($trigger = true)
    {
        $this->removeComments = $trigger;
        return $this;
    }

    public function line2p($trigger = true, $dropEmptyLines = false)
    {
        $this->line2p = $trigger;
        $this->line2pDropEmptyLines = $dropEmptyLines;
        return $this;
    }

    public function replaceEol($replacement = '<br>$1')
    {
        $this->replaceEol = $replacement;
        return $this;
    }

    /**
     * @php-version-only 7.2 - 8.1
     * @fix Incorrect decoding from www.bing.com and another UTF-8 broken encoding HTML-pages
     * @param $charset
     * @return $this
     */
    public function setCharset($charset = null)
    {
        if(!$charset){
            $charset = mb_detect_encoding($this->content, 'auto');
        }
        $this->charset = $charset;
        return $this;
    }

    public function clean()
    {
        libxml_use_internal_errors($this->useInternalErrors);

        $document = new DOMDocument();

        if($this->charset){
            $document->loadHTML(mb_convert_encoding($this->content, 'HTML-ENTITIES', $this->charset));
        }else{
            $document->loadHTML($this->content);
        }

        $xpath = new DOMXPath($document);
        $nodes = $xpath->query("/*");

        $content = '';
        foreach($nodes as $node){
            $content .= $this->parseDomObject($node);
        }

        $this->errors = libxml_get_errors();
        libxml_clear_errors();

        return $content;
    }

    /**
     * @param \DOMElement|\DOMText $node
     * @param null $parentTag
     * @return string
     */
    protected function parseDomObject($node, $parentTag = null)
    {
        if($node->childNodes->length > 0){
            $content = '';
            foreach($node->childNodes as $index => $child){
                $name = mb_strtolower($child->nodeName);
                /**
                 * @fix Skip HTML-comment string (expl: `<!--<textarea"></textarea>-->`)
                 */
                if($name == '#comment'){
                    if(!$this->removeComments){
                        $content .= "<!--{$child->textContent}-->\n";
                    }
                    continue;
                }

                if(isset($this->removable[$name])){
                    $content .= $this->checkRemovableTag($child, $node, $this->removable[$name]);
                }else
                    if(isset($this->allowed[$name])){
                        if(isset($this->allowed[$name]['options']['node'])){
                            /**
                             * @fix Exclude nested child elements (expl: `<pre><code></code></pre>`)
                             * @see Attributes::node() - use callback for customize if needed
                             */
                            $content .= call_user_func($this->allowed[$name]['options']['node'], $child, $this);
                        }else{
                            $content .= $this->checkAllowedTag($child, $node, $this->allowed[$name]);
                        }
                    }else{
                        $content .= $this->parseDomObject($child, $node->nodeName);
                    }
            }
            return $content;
        }
        if(isset($this->allowed[$parentTag]['options']['text'])){
            return call_user_func($this->allowed[$parentTag]['options']['text'], $node);
        }
        /**
         * @fix Quote HTML-comment string (expl: `<!--<textarea"></textarea>-->`)
         */
        if($node->nodeName == '#comment'){
            if($this->removeComments){
                return '';
            }
            return "<!--{$node->textContent}-->\n";
        }
        /**
         * @fix Quote tags in JSON structure (expl: `wysiwyg.addLang('[{"<h1></h1>"}]')`)
         * @see Attributes::text() - use callback for customize if needed
         */
        return $this->prepareTextResult($node->textContent);
    }

    protected function checkRemovableTag($child, $parent, array $options)
    {
        $content = '';
        if($cleaned = $this->validateTag($child, $this->removable)){
            $name = mb_strtolower($child->nodeName);

            if(!isset($this->nonClosestTags[$name])){
                $content .= "<{$name}";
                $content .= " {$cleaned}>\n";
                $content .= $this->parseDomObject($child, $parent->nodeName);
                $content .= "\n</{$name}>";
            }else{
                $content .= "<{$name}";
                $content .= " {$cleaned}/>";
            }
        }
        return $content;
    }

    protected function checkAllowedTag($child, $parent, array $options)
    {
        $content = '';
        if($cleaned = $this->validateTag($child, $this->allowed)){
            $name = mb_strtolower($child->nodeName);

            if(!isset($this->nonClosestTags[$name])){
                if($result = $this->parseDomObject($child, $parent->nodeName)){
                    $content .= "<{$name}";
                    $content .= " {$cleaned}>\n";
                    $content .= $result;
                    $content .= "\n</{$name}>";
                }else{
                    if(isset($options['options']['removeEmptyTag']) && !$options['options']['removeEmptyTag']){
                        $content .= "<{$name}";
                        $content .= " {$cleaned}>\n";
                        $content .= $result;
                        $content .= "\n</{$name}>";
                    }
                }
            }else{
                $content .= "<{$name}";
                $content .= " {$cleaned}/>";
            }
        }else{
            if(isset($options['options']['removeTagWithoutAttributes']) && $options['options']['removeTagWithoutAttributes']){
                $content .= $this->parseDomObject($child, $parent->nodeName);
            }else{
                $name = mb_strtolower($child->nodeName);

                if(!isset($this->nonClosestTags[$name])){
                    $content .= "<{$name}>\n";
                    $content .= $this->parseDomObject($child, $parent->nodeName);
                    $content .= "\n</{$name}>";
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

                if(!array_key_exists($attrName, $definedTagsList[$name]['attribute'])){ continue; }

                if($valid = $this->validateAttribute($node, $attribute, $definedTagsList[$name]['attribute'][$attrName])){
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

    public function getHtmlContent($node)
    {
        $html = '';
        if($node->childNodes->length > 0){
            foreach($node->childNodes as $child){
                $document = new DOMDocument();
                $document->appendChild($document->importNode($child,true));
                $html .= $document->saveHTML();
            }
        }
        return $html ?: $node->textContent;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    protected function prepareTextResult($result)
    {
        $result = trim($result);
        $result = htmlspecialchars($result);

        if($this->line2p){
            $result = preg_replace_callback("#(.*?)(\r\n|\n|$)#usim", function($f){
                if(!$f[1] && $this->line2pDropEmptyLines){
                    return '';
                }
                return "<p>{$f[1]}</p>\n";
            }, $result);
        }

        if($this->replaceEol){
            $result = preg_replace("#(\r\n|\n)#usim", $this->replaceEol, $result);
        }

        return $result;
    }
}