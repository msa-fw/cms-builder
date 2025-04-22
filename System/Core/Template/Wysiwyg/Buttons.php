<?php

namespace System\Core\Template\Wysiwyg;

/**
 * Class Buttons
 * @package System\Core\Form\Fields\Html
 * @method Attributes remove()
 * @method Attributes editSource()
 * @method Attributes showBlocks()
 * @method Attributes limiter()
 *
 * @method Attributes bold()
 * @method Attributes italic()
 * @method Attributes strike()
 * @method Attributes underline()
 * @method Attributes hr()
 *
 * @method Attributes quote()
 * @method Attributes table()
 * @method Attributes code()
 * @method Attributes link()
 * @method Attributes header()
 * @method Attributes h1()
 * @method Attributes h2()
 * @method Attributes h3()
 * @method Attributes h4()
 * @method Attributes h5()
 * @method Attributes h6()
 *
 * @method Attributes align()
 * @method Attributes alignCenter()
 * @method Attributes alignJustify()
 * @method Attributes alignLeft()
 * @method Attributes alignRight()
 *
 * @method Attributes list()
 * @method Attributes listRating()
 * @method Attributes listCircled()
 * @method Attributes listPointer()
 * @method Attributes listCheckbox()
 *
 * @method Attributes outlineList()
 * @method Attributes outlineListInteger()
 * @method Attributes outlineListLetter()
 * @method Attributes outlineListRoman()
 *
 * @method Attributes fileManager()
 * @method Attributes fileRemote()
 * @method Attributes fileUpload()
 *
 * @method Attributes audio()
 * @method Attributes image()
 * @method Attributes video()
 * @method Attributes file()
 *
 * @method Attributes fullScreen()
 *
 */
class Buttons
{
    protected $package = array();

    public function __call($name, $arguments)
    {
        return $this->params($name);
    }

    public function __construct(&$package)
    {
        $this->package = &$package;
        $this->package = array();
    }

    protected function params($buttonName)
    {
        $attributes = new Attributes($buttonName, $this->package);
        return $attributes;
    }
}