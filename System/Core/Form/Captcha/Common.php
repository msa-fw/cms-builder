<?php

namespace System\Core\Form\Captcha;

use System\Core\Form\Interfaces\CaptchaInterface;

use function math\percent;
use function strings\generate;
use function web\templateRoot;

class Common implements CaptchaInterface
{
    protected $image;
    protected $imgWidth;
    protected $imgHeight;

    protected $word;
    protected $wordLen;
    protected $fontSize;

    protected $mainColor;

    protected $line = 0;
    protected $rectangle = 0;
    protected $fonts = array();

    public function __construct($word, $fontSize = 20)
    {
        $this->fonts = glob(templateRoot('fonts/captcha/*.ttf'));

        $this->word = $word;
        $this->fontSize = $fontSize;
        $this->wordLen = mb_strlen($this->word);
        $this->imgWidth = $this->wordLen * $this->fontSize + percent($this->wordLen * $fontSize, 10, 'floor');
        $this->imgHeight = ceil($this->imgWidth * 0.4);
        $this->image = imagecreatetruecolor($this->imgWidth, $this->imgHeight);

        $this->background();
    }

    public function generate()
    {
        return $this->text()
            ->rectangle()
            ->line()
            ->pixel();
    }

    protected function background()
    {
        imageantialias($this->image, true);
        imagefill($this->image, 0, 0, imagecolorallocate($this->image, rand(127, 255), rand(127, 255), rand(127, 255)));
        return $this;
    }

    public function pixel()
    {
        for($x = 0; $x < $this->imgWidth; $x++) {
            for($y = 0; $y < $this->imgHeight; $y++) {
                if(!is_int(rand(1, 100)/3)){ continue; }
                $color = imagecolorallocate($this->image, rand(0, 255), rand(0, 255), rand(0, 255));
                imagesetthickness($this->image, rand(2, 10));
                imagesetpixel($this->image, $x, $y, $color);
            }
        }

        return $this;
    }

    public function rectangle()
    {
        for($i = 0; $i < $this->rectangle; $i++) {
            $tick = floor($this->fontSize/20);
            imagesetthickness($this->image, $tick);
//            $color = imagecolorallocate($this->image, rand(0, 255), rand(0, 255), rand(0, 255));
            imagerectangle($this->image, rand(0, $this->imgWidth), rand(0, $this->imgWidth), rand(0, $this->imgWidth), 0, $this->getMainColor());
        }

        return $this;
    }

    public function line()
    {
        for($i = 0; $i < $this->line; $i++) {
            $tick = floor($this->fontSize/20);

            imagesetthickness($this->image, $tick);

            $x = rand(0, $this->imgWidth);
            $y = rand(0, $this->imgHeight);
            $x2 = rand($x, $this->imgWidth);
            $y2 = rand($y, $this->imgHeight);

            imageline($this->image, $x, $y, $x2, $y2, $this->getMainColor());

            for($i2 = 0; $i2 < 10; $i2++){
                imageline($this->image, $x+$i2, $y+$i2, $x2+$i2, $y2+$i2, $this->getMainColor());
            }
        }

        return $this;
    }

    public function text()
    {
        $percentage = percent($this->fontSize, 10, 'floor');

        $this->scatterLetters(rand($this->fontSize-20, $this->fontSize+20));

        for($i = 0; $i < $this->wordLen; $i++) {
            $initial =  $i ? 5 : 10;

            $letter = $this->word[$i];
            $font = $this->fonts[array_rand($this->fonts)];

            $xPosition = $initial + $this->fontSize * $i;
            $yPosition = floor($this->imgHeight/2)+floor($this->fontSize/2);

            $angle = rand(-10, 10);
            $size = rand($this->fontSize - $percentage, $this->fontSize + $percentage);

            $this->shadow($size, $angle, $xPosition, $yPosition, $font, $letter);
            imagettftext($this->image, $size, $angle, $xPosition, $yPosition, $this->getMainColor(), $font, $letter);
        }
        return $this;
    }

    protected function shadow($size, $angle, $xPosition, $yPosition, $font, $letter, $start = 0)
    {
        for($i = $start; $i < percent($this->fontSize, 5, 'floor') + $start; $i++){
            $color = imagecolorallocate($this->image, rand(0, 150), rand(0, 150), rand(0, 150));
            imagettftext($this->image, $size, $angle, $xPosition+$i, $yPosition+$i, $color, $font, $letter);
        }
        return $this;
    }

    protected function scatterLetters($size = 50, $lettersLimit = 32)
    {
        $font = $this->fonts[array_rand($this->fonts)];

        $backgroundLetters = generate($lettersLimit, range('a', 'z'), range('A', 'Z'));
        $backgroundLettersLength = mb_strlen($backgroundLetters);

        for($i = 0; $i < $backgroundLettersLength; $i++) {
            $letter = $backgroundLetters[$i];

            $xPosition = rand(0, $this->imgWidth);
            $yPosition = rand(0, $this->imgHeight);

            $angle = rand(-30, 30);
            $color = imagecolorallocate($this->image, rand(127, 255), rand(127, 255), rand(127, 255));
            imagettftext($this->image, $size, $angle, $xPosition, $yPosition, $color, $font, $letter);
        }
        return $this;
    }

    protected function getMainColor()
    {
        if(!$this->mainColor){
            $this->mainColor = imagecolorallocate($this->image, rand(0, 150), rand(0, 150), rand(0, 150));
        }
        return $this->mainColor;
    }

    public function get($quality = 70)
    {
        ob_start();
        imagejpeg($this->image, null, $quality);
        imagedestroy($this->image);
        return ob_get_clean();
    }
}