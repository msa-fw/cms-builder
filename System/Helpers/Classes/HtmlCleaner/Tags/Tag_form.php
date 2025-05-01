<?php

namespace System\Helpers\Classes\HtmlCleaner\Tags;

use System\Helpers\Classes\HtmlCleaner\Attributes;

/**
 * Class Tag_form
 * @package System\Helpers\Classes\HtmlCleaner\Tags
 * @method Tag_form action(callable $callback = null)
 * @method Tag_form autocomplete(callable $callback = null)
 * @method Tag_form enctype(callable $callback = null)
 * @method Tag_form method(callable $callback = null)
 * @method Tag_form name(callable $callback = null)
 * @method Tag_form novalidate(callable $callback = null)
 * @method Tag_form rel(callable $callback = null)
 * @method Tag_form target(callable $callback = null)
 */
class Tag_form extends Attributes
{
    public function acceptCharset(callable $callback = null)
    {
        return $this->attribute('accept-charset', $callback);
    }
}