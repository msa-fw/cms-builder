<?php

namespace System\Core\Form\Captcha;

class Captcha extends Common
{
    protected $line = 3;
    protected $rectangle = 3;

    public function pixel()
    {
        for($x = 0; $x < $this->imgWidth; $x++) {
            for($y = 0; $y < $this->imgHeight; $y++) {
                if(!is_int(rand(1, 10)/3)){ continue; }
                $color = imagecolorallocate($this->image, rand(127, 255), rand(127, 255), rand(127, 255));
                imagesetthickness($this->image, rand(2, 10));
                imagesetpixel($this->image, $x, $y, $color);
            }
        }

        return $this;
    }
}