<?php

namespace Controllers\_BaseController_\Tests;

use System\Core\Database;
use System\Helpers\Classes\HtmlCleaner;
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
        $htmlCleaner->setCharset();
        $htmlCleaner->line2p();
//        $htmlCleaner->replaceEol();
//        $htmlCleaner->removeComments(false);
        $htmlCleaner->filter($this->allowedTags(), $this->disallowedTags());
//        pre($htmlCleaner->getErrors());
        return $this->saveResult(__FUNCTION__, $htmlCleaner);
    }

    public function reverseAllowTags($target = "https://msa-fw.github.io/wysiwyg/")
    {
        self::setContent($target);
        $htmlCleaner = new HtmlCleaner(self::$content, true);
        $htmlCleaner->setCharset();
        $htmlCleaner->line2p();
        $htmlCleaner->replaceEol();
        $htmlCleaner->removeComments(false);
        $htmlCleaner->filter($this->disallowedTags(), $this->allowedTags());
//        pre($htmlCleaner->getErrors());
        return $this->saveResult(__FUNCTION__, $htmlCleaner);
    }
}