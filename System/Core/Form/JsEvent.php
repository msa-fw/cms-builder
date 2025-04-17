<?php

namespace System\Core\Form;

use System\Core\Form\Attributes\Common;

/**
 * Class JsEvent
 * @method self abort($value)
 * @method self afterprint($value)
 * @method self autocomplete($value)
 * @method self autocompleteerror($value)
 * @method self beforeprint($value)
 * @method self beforeunload($value)
 * @method self blur($value)
 * @method self cancel($value)
 * @method self canplay($value)
 * @method self canplaythrough($value)
 * @method self change($value)
 * @method self click($value)
 * @method self close($value)
 * @method self contextmenu($value)
 * @method self copy($value)
 * @method self cuechange($value)
 * @method self cut($value)
 * @method self dblclick($value)
 * @method self drag($value)
 * @method self dragend($value)
 * @method self dragenter($value)
 * @method self dragexit($value)
 * @method self dragleave($value)
 * @method self dragover($value)
 * @method self dragstart($value)
 * @method self drop($value)
 * @method self durationchange($value)
 * @method self emptied($value)
 * @method self ended($value)
 * @method self error($value)
 * @method self focus($value)
 * @method self hashchange($value)
 * @method self input($value)
 * @method self invalid($value)
 * @method self keydown($value)
 * @method self keypress($value)
 * @method self keyup($value)
 * @method self load($value)
 * @method self loadeddata($value)
 * @method self loadedmetadata($value)
 * @method self loadstart($value)
 * @method self message($value)
 * @method self mousedown($value)
 * @method self mouseenter($value)
 * @method self mouseleave($value)
 * @method self mousemove($value)
 * @method self mouseout($value)
 * @method self mouseover($value)
 * @method self mouseup($value)
 * @method self wheel($value)
 * @method self mousewheel($value)
 * @method self offline($value)
 * @method self online($value)
 * @method self pagehide($value)
 * @method self pageshow($value)
 * @method self paste($value)
 * @method self pause($value)
 * @method self play($value)
 * @method self playing($value)
 * @method self popstate($value)
 * @method self progress($value)
 * @method self ratechange($value)
 * @method self reset($value)
 * @method self resize($value)
 * @method self scroll($value)
 * @method self search($value)
 * @method self seeked($value)
 * @method self seeking($value)
 * @method self select($value)
 * @method self show($value)
 * @method self sort($value)
 * @method self stalled($value)
 * @method self storage($value)
 * @method self submit($value)
 * @method self suspend($value)
 * @method self timeupdate($value)
 * @method self toggle($value)
 * @method self unload($value)
 * @method self volumechange($value)
 * @method self waiting($value)
 * @package System\Core\Form\Attributes
 */
class JsEvent
{
    protected $fieldName;

    protected $field = array();

    public function __call($name, $arguments)
    {
        $this->attribute($name, isset($arguments[0]) ? $arguments[0] : null);
        return $this;
    }

    public function __construct($fieldName, &$field)
    {
        $this->fieldName = $fieldName;
        $this->field = &$field;
    }

    public function append()
    {
        return new Common($this->fieldName, $this->field);
    }

    public function attribute($name, $value)
    {
        $this->field['attributes']["on{$name}"] = $value;
        return $this;
    }
}