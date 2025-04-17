<?php

namespace System\Helpers\Classes\Render;
/**
 * Class Button
 * @package System\Helpers\Classes\Render
 * @example
 * print modal('link name')->title('modal title')
 *          ->button()->button('ok')->handler('onclick="mainObj.modal.close(\'.modal-window\')"')->class('modal-button-success')->done()
 *          ->button()->button('cancel')->handler('onclick="mainObj.modal.close(\'.modal-window\')"')->class('modal-button-discard')->done()
 *          ->ajax()->link('/')->done()->render();
 */
class Button
{
    const CLASS_BUTTON_SUCCESS = 'modal-button-success';
    const CLASS_BUTTON_DISCARD = 'modal-button-discard';

    const TEMPLATE = array(
        'value' => 'press me',
        'class' => self::CLASS_BUTTON_SUCCESS,
        'handler' => null,
    );

    protected $button;
    /** @var  Modal */
    protected $modal;

    protected $index = 0;

    public function __construct(Modal $modal, &$button)
    {
        $this->modal = $modal;
        $this->button = &$button;
        $this->index = $this->index($this->index);
        $this->button['buttons'][$this->index] = self::TEMPLATE;
    }

    public function button($value = 'press me')
    {
        return $this->custom('value', $value);
    }

    public function class($class = Button::CLASS_BUTTON_SUCCESS)
    {
        return $this->custom('class', $class);
    }

    public function handler($handler)
    {
        return $this->custom('handler', $handler);
    }

    public function custom($key, $value)
    {
        $this->button['buttons'][$this->index][$key] = $value;
        return $this;
    }

    public function done()
    {
        return $this->modal;
    }

    protected function index($index)
    {
        return isset($this->button['buttons'][$index]) ? $this->index($index+1) : $index;
    }
}