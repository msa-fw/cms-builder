<?php

namespace System\Helpers\Classes\HtmlCleaner\Tags;

use System\Helpers\Classes\HtmlCleaner\Attributes;

/**
 * Class Tag_meta
 * @package System\Helpers\Classes\HtmlCleaner\Tags
 * @method Tag_meta charset(callable $callback = null)
 * @method Tag_meta content(callable $callback = null)
 * @method Tag_meta name(callable $callback = null)
 */
class Tag_meta extends Attributes
{
    public function httpEquiv(callable $callback = null)
    {
        return $this->attribute('http-equiv', $callback);
    }
}