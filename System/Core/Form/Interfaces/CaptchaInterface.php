<?php

namespace System\Core\Form\Interfaces;

interface CaptchaInterface
{
    /**
     * @return CaptchaInterface
     */
    public function generate();

    /**
     * @param int $quality
     * @return string
     */
    public function get($quality = 70);
}