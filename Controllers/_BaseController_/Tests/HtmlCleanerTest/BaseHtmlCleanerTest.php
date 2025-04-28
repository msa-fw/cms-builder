<?php

namespace Controllers\_BaseController_\Tests\HtmlCleanerTest;

use DOMNode, DOMElement, DOMAttr;
use System\Helpers\Classes\Fs;
use System\Helpers\Classes\HtmlCleaner;
use System\Helpers\Classes\HtmlCleaner\Builder;

use function filesystem\write;
use function filesystem\makeDirectory;

class BaseHtmlCleanerTest
{
    protected static $content = '';

    protected static function setContent($target)
    {
        if(!self::$content){
            self::$content = file_get_contents($target);
            self::$content = self::$content . "\n<pre>\n<code>\n" . self::$content ."\n</code>\n</pre>";
//            self::$content = preg_replace(array('/<!--(.*)-->/Uis',"/[[:blank:]]+/"), array('',' '), self::$content);
//            self::$content = preg_replace("#\n+#usim", "\n", self::$content);
//            self::$content = str_replace(array("\n"), array('<br>'), self::$content);
            return true;
        }
        return false;
    }

    protected function allowedTags(Builder $tag)
    {
        $tag->br();
        $tag->i();
        $tag->u();
        $tag->s();
        $tag->b();

        $tag->div()->title()->class()->id();

        $tag->span()->title()->class()->text(function(DOMNode $node){
            return "[checkpoint] callback " . htmlspecialchars($node->textContent);
        })->id();

        $tag->table()->id()->class()->title();
        $tag->tbody()->id()->class()->title();
        $tag->thead()->id()->class()->title();
        $tag->tr()->id()->class()->title();
        $tag->th()->id()->class()->title();
        $tag->td()->id()->class()->title();

        $tag->pre()->id()->class()->title()->lang();
        $tag->code()->node(function(DOMElement $currentNode, HtmlCleaner $htmlCleaner){
            return "<code lang=\"HTML\">" . htmlspecialchars($htmlCleaner->getHtmlContent($currentNode)) . "</code>";
        })->id()->class()->title()->lang();

        $tag->img()->src()->title()->id()->class()->style()->width()->height();

        $tag->video()->title()->width()->height()
            ->controls(function(DOMAttr $node){
                return !$node->nodeValue ? 'true': $node->nodeValue;
            })->id()->class();

        $tag->audio()->title()->controls(function(DOMAttr $node){
            return !$node->nodeValue ? 'true': $node->nodeValue;
        })->id()->class();

        $tag->source(true)->src(function(DOMAttr $node){
            if(preg_match("#https\:\/\/download\.samplelib\.com\/mp\d+\/sample\-\d+s\.mp\d+#usim", $node->nodeValue)){
                return $node->nodeValue;
            }
            if(preg_match("#https\:\/\/dfm\.hostingradio\.ru\/dfm\d+\.aacp#usim", $node->nodeValue)){
                return $node->nodeValue;
            }
            return '';
        });

        $tag->a()->href()->title()->id()->class();
        return $tag;
    }

    protected function disallowedTags(Builder $tag)
    {
        $tag->script();
        $tag->style();
        $tag->head();
        $tag->meta();
        $tag->link();
        $tag->iframe();
        return $tag;
    }

    protected function saveResult($fileName, HtmlCleaner $htmlCleaner)
    {
        $directoryPath = Fs::server()->temp('tests/html');
        makeDirectory($directoryPath);

        $result = $htmlCleaner->clean();
//        $result = \response\compressHtml($result);

        return write("{$directoryPath}/{$fileName}.html", $result);
    }
}