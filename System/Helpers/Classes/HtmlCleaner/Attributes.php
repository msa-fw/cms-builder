<?php

namespace System\Helpers\Classes\HtmlCleaner;

/**
 * Class Attributes
 * @package System\Helpers\Classes\HtmlCleaner
 * @method $this id(callable $callback = null)
 * @method $this class(callable $callback = null)
 * @method $this style(callable $callback = null)
 * @method $this title(callable $callback = null)
 * @method $this accessKey(callable $callback = null)
 * @method $this contentEditable(callable $callback = null)
 * @method $this dir(callable $callback = null)
 * @method $this draggable(callable $callback = null)
 * @method $this enterKeyHint(callable $callback = null)
 * @method $this hidden(callable $callback = null)
 * @method $this inert(callable $callback = null)
 * @method $this inputMode(callable $callback = null)
 * @method $this lang(callable $callback = null)
 * @method $this popover(callable $callback = null)
 * @method $this spellCheck(callable $callback = null)
 * @method $this tabIndex(callable $callback = null)
 * @method $this translate(callable $callback = null)
 *
 * @method $this onAfterPrint(callable $callback = null)
 * @method $this onBeforePrint(callable $callback = null)
 * @method $this onBeforeUnload(callable $callback = null)
 * @method $this onError(callable $callback = null)
 * @method $this onHashChange(callable $callback = null)
 * @method $this onLoad(callable $callback = null)
 * @method $this onMessage(callable $callback = null)
 * @method $this onOffline(callable $callback = null)
 * @method $this onOnline(callable $callback = null)
 * @method $this onPageHide(callable $callback = null)
 * @method $this onPageShow(callable $callback = null)
 * @method $this onPopState(callable $callback = null)
 * @method $this onResize(callable $callback = null)
 * @method $this onStorage(callable $callback = null)
 * @method $this onUnload(callable $callback = null)
 * @method $this onBlur(callable $callback = null)
 * @method $this onChange(callable $callback = null)
 * @method $this onContextMenu(callable $callback = null)
 * @method $this onFocus(callable $callback = null)
 * @method $this onInput(callable $callback = null)
 * @method $this onInvalid(callable $callback = null)
 * @method $this onReset(callable $callback = null)
 * @method $this onSearch(callable $callback = null)
 * @method $this onSelect(callable $callback = null)
 * @method $this onSubmit(callable $callback = null)
 * @method $this onKeyDown(callable $callback = null)
 * @method $this onKeyPress(callable $callback = null)
 * @method $this onKeyUp(callable $callback = null)
 * @method $this onClick(callable $callback = null)
 * @method $this onDblClick(callable $callback = null)
 * @method $this onMouseDown(callable $callback = null)
 * @method $this onMouseMove(callable $callback = null)
 * @method $this onMouseOut(callable $callback = null)
 * @method $this onMouseOver(callable $callback = null)
 * @method $this onMouseUp(callable $callback = null)
 * @method $this onMouseWheel(callable $callback = null)
 * @method $this onWheel(callable $callback = null)
 * @method $this onDrag(callable $callback = null)
 * @method $this onDragEnd(callable $callback = null)
 * @method $this onDragEnter(callable $callback = null)
 * @method $this onDragLeave(callable $callback = null)
 * @method $this onDragOver(callable $callback = null)
 * @method $this onDragStart(callable $callback = null)
 * @method $this onDrop(callable $callback = null)
 * @method $this onScroll(callable $callback = null)
 * @method $this onCopy(callable $callback = null)
 * @method $this onCut(callable $callback = null)
 * @method $this onPaste(callable $callback = null)
 * @method $this onAbort(callable $callback = null)
 * @method $this onCanPlay(callable $callback = null)
 * @method $this onCanPlayThrough(callable $callback = null)
 * @method $this onCueChange(callable $callback = null)
 * @method $this onDurationChange(callable $callback = null)
 * @method $this onEmptied(callable $callback = null)
 * @method $this onEnded(callable $callback = null)
 * @method $this onLoadedData(callable $callback = null)
 * @method $this onLoadedMetaData(callable $callback = null)
 * @method $this onLoadStart(callable $callback = null)
 * @method $this onPause(callable $callback = null)
 * @method $this onPlay(callable $callback = null)
 * @method $this onPlaying(callable $callback = null)
 * @method $this onProgress(callable $callback = null)
 * @method $this onRateChange(callable $callback = null)
 * @method $this onSeeked(callable $callback = null)
 * @method $this onSeeking(callable $callback = null)
 * @method $this onStalled(callable $callback = null)
 * @method $this onSuspend(callable $callback = null)
 * @method $this onTimeUpdate(callable $callback = null)
 * @method $this onVolumeChange(callable $callback = null)
 * @method $this onWaiting(callable $callback = null)
 * @method $this onToggle(callable $callback = null)
 */
class Attributes
{
    protected $tag;

    protected $tags = array();

    public function __call($name, $arguments)
    {
        return $this->attribute($name, ...$arguments);
    }

    public function __construct($tag, &$tags)
    {
        $this->tag = $tag;
        $this->tags = &$tags;
        $this->tags[$this->tag]['attribute'] = array();
    }

    public function attribute($attribute, callable $callback = null)
    {
        $attribute = mb_strtolower($attribute);
        $this->tags[$this->tag]['attribute'][$attribute] = $callback;
        return $this;
    }

    public function option($key, $value)
    {
        $key = mb_strtolower($key);
        $this->tags[$this->tag]['options'][$key] = $value;
        return $this;
    }

    public function node(callable $callback = null)
    {
        return $this->option('node', $callback);
    }

    public function text(callable $callback = null)
    {
        return $this->option('text', $callback);
    }
}