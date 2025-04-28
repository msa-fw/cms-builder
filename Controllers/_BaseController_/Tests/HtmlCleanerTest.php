<?php

namespace Controllers\_BaseController_\Tests;

use System\Core\Database;
use System\Helpers\Classes\HtmlCleaner;
use System\Helpers\Classes\HtmlCleaner\Builder;
use Controllers\_BaseController_\Tests\HtmlCleanerTest\BaseHtmlCleanerTest;

class HtmlCleanerTest extends BaseHtmlCleanerTest
{
    /** @var bool|Database\Driver */
    protected $connection;
    /** @var Database\Db */
    protected $database;

    public function __construct()
    {
        $this->connection = Database::connect();
        $this->database = $this->connection->database();
    }

    public function allowTags($target = "https://msa-fw.github.io/wysiwyg/")
    {
        self::setContent($target);
        $htmlCleaner = new HtmlCleaner(self::$content, true);

        $htmlCleaner->setCharset()/*->removeComments(false)*/->filter(function(Builder $tag){
            return $this->allowedTags($tag);
        }, function(Builder $tag){
            return $this->disallowedTags($tag);
        });

//        pre($htmlCleaner->getErrors());
        return $this->saveResult(__FUNCTION__, $htmlCleaner);
    }

    public function reverseAllowTags($target = "https://msa-fw.github.io/wysiwyg/")
    {
        self::setContent($target);
        $htmlCleaner = new HtmlCleaner(self::$content, true);

        $htmlCleaner->setCharset()->filter(function(Builder $tag){
            return $this->disallowedTags($tag);
        }, function(Builder $tag){
            return $this->allowedTags($tag);
        });

//        pre($htmlCleaner->getErrors());
        return $this->saveResult(__FUNCTION__, $htmlCleaner);
    }
}