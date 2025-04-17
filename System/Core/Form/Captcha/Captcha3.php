<?php

namespace System\Core\Form\Captcha;

use function math\percent;
use function strings\generate;

class Captcha3 extends Common
{
    protected $line = 3;

    public function line()
    {
        return $this;
    }

    public function pixel()
    {
        return $this;
    }

    public function rectangle()
    {
        return $this;
    }

    protected function shadow($size, $angle, $xPosition, $yPosition, $font, $letter, $start = 0)
    {
        $color = imagecolorallocate($this->image, rand(220, 255), rand(220, 255), rand(220, 255));
        for($i = $start; $i < percent($this->fontSize, 5, 'floor') + $start; $i++){
            imagettftext($this->image, $size, $angle, $xPosition+$i, $yPosition+$i, $color, $font, $letter);
        }
        return $this;
    }

    public function text()
    {
        $percentage = percent($this->fontSize, 10, 'floor');

        $this->scatterLetters(0, 128);

        for($i = 0; $i < $this->wordLen; $i++) {
            $font = $this->fonts[array_rand($this->fonts)];

            $initial =  $i ? 5 : 10;

            $letter = $this->word[$i];

            $xPosition = $initial + $this->fontSize * $i;
            $yPosition = floor($this->imgHeight/2)+floor($this->fontSize/2);

            $angle = rand(-10, 10);
            $size = rand($this->fontSize - $percentage, $this->fontSize + $percentage);

            $this->shadow($size, $angle, $xPosition, $yPosition, $font, $letter);

            $color = imagecolorallocate($this->image, rand(0, 127), rand(0, 127), rand(0, 127));
            imagettftext($this->image, $size, $angle, $xPosition, $yPosition, $color, $font, $letter);
        }
        return $this;
    }

    protected function scatterLetters($size = 50, $lettersLimit = 32)
    {
        $font = $this->fonts[array_rand($this->fonts)];

        $backgroundLetters = generate($lettersLimit, range('a', 'z'), range('A', 'Z'));
        $backgroundLettersLength = mb_strlen($backgroundLetters);

        $letterPosition = floor($this->imgHeight/2)+floor($this->fontSize/2);

        for($i = 0; $i < $backgroundLettersLength; $i++) {
            $letter = $backgroundLetters[$i];

            $xPosition = rand(20, $this->imgWidth);
            $yPosition = rand(
                $letterPosition - percent($letterPosition, 70, 'floor'),
                $letterPosition + percent($letterPosition, 70, 'floor')
            );

            $angle = 0;
            $size = rand(
                $this->fontSize - percent($this->fontSize, 90, 'floor'),
                $this->fontSize - percent($this->fontSize, 50, 'floor')
            );
            $color = imagecolorallocate($this->image, rand(100, 200), rand(100, 200), rand(100, 200));
            imagettftext($this->image, $size, $angle, $xPosition, $yPosition, $color, $font, $letter);
        }
        return $this;
    }
}