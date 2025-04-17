<?php

namespace System\Core\Template\Render;

use System\Core\Config;
use System\Core\Request;
use System\Core\Response;
use System\Helpers\Classes\ArrayManager;
use System\Core\Template\Interfaces\RenderInterface;

use function web\render;
use function web\renderStyle;
use function web\renderScript;
use function web\templateRoot;

class HTML implements RenderInterface
{
    const SCRIPT_STYLE_POSITION_HEAD = 1;
    const SCRIPT_STYLE_POSITION_BODY = 2;
    const SCRIPT_STYLE_POSITION_FOOTER  = 3;

    protected static $scripts = array();

    protected static $styles = array();

    protected $undefined = array();

    protected $dataContent = '';

    protected $controllerContent = '';

    public function __get($name)
    {
        return isset($this->undefined[$name]) ? $this->undefined[$name] : null;
    }

    public function __set($name, $value)
    {
        $this->undefined[$name] = $value;
        return $this;
    }

    public function __construct()
    {
        Response::header('Content-Type', 'text/html; charset=utf-8');
    }

    public function renderContent()
    {
        $templateMainFile = templateRoot("index.html");
        $this->dataContent = render($templateMainFile, array('render' => $this));
        return $this;
    }

    public function getDataContentResult()
    {
        return $this->dataContent;
    }

    public function setDataContentResult($content)
    {
        $this->dataContent = $content;
        return $this;
    }

    public function setControllerContentResult($content)
    {
        $this->controllerContent = $content;
        return $this;
    }

    public function getControllerContentResult()
    {
        return $this->controllerContent;
    }

    public function renderController(ArrayManager $manager = null)
    {
        if(Response::code() == 200){
            $controller = $manager ?: Response::response('controller');

            $template = $this->getControllerActionTemplateFile($controller);

            if(file_exists($template)){
                $this->controllerContent = render($template, array('render' => $this));
                return $this;
            }
            Response::code(424);
        }

        return $this->renderErrorPage(Response::code());
    }

    public function renderErrorPage($responseCode)
    {
        $errorFilePath = templateRoot("assets/errors/{$responseCode}.html");
        if(!file_exists($errorFilePath)){
            $errorFilePath = templateRoot("assets/errors/unknownError.html");
        }
        $this->controllerContent = render($errorFilePath, array(
            'render' => $this,
            'code' => $responseCode
        ));
        return $this;
    }

    public function renderForm(ArrayManager $form)
    {
        if($formData = $form->array()->raw()){
            $template = templateRoot($formData['template']);

            $sortedList = array();
            foreach($formData['fields'] as $key => $value){
                $sortedList[$value['fieldSet']][$key] = $value;
            }

            $formData['fields'] = $sortedList;

            $formData['render'] = $this;

            return render($template, $formData);
        }
        return '';
    }

    public function renderFields($formName, $fieldsList = array())
    {
        $template = templateRoot("assets/fields/fieldSet.html");

        return render($template, array(
            'formName' => $formName,
            'fields' => $fieldsList,
            'render' => $this,
        ));
    }

    public function getControllerActionTemplateFile(ArrayManager $controller)
    {
        $controllerName = $controller->key('controller')->read('');
        $actionName = $controller->key('action')->read('');
        return templateRoot("Controllers/{$controllerName}/Actions/{$actionName}.html");
    }

    public function renderIcon()
    {
        foreach(Response::getResponse('icon') as $icons){
            $icon = array();
            foreach($icons as $name => $attribute){
                $icon[] = "{$name}=\"{$attribute}\"";
            }
            print "<link " . implode(' ', $icon) . "/>\n";
        }
    }

    public function renderTitle()
    {
        if($title = Response::getResponse('title')){
            $title = array_reverse($title);

            $delimiter = Config::template('titleDelimiter')->read();
            print "<title>" . implode($delimiter, $title) . "</title>\n";
        }
        return $this;
    }

    public function renderMetaTags()
    {
        foreach(Response::getResponse('meta') as $metaTags){
            foreach($metaTags as $meta){
                $tag = array();
                foreach($meta as $key => $value){
                    $value = htmlspecialchars($value);
                    $tag[] = "{$key}=\"{$value}\"";
                }
                print "<meta " . implode(" ", $tag) . ">\n";
            }
        }
    }

    public function renderJsFiles($position = self::SCRIPT_STYLE_POSITION_HEAD)
    {
        foreach(self::$scripts as $filePath => $filePosition){
            if($position){
                if($filePosition == $position){
                    $this->renderJsFile($filePath, true);
                    unset(self::$scripts[$filePath]);
                }
                continue;
            }
            $this->renderJsFile($filePath, true);
            unset(self::$scripts[$filePath]);
        }
        return $this;
    }

    public function renderCssFiles($position = self::SCRIPT_STYLE_POSITION_HEAD)
    {
        foreach(self::$styles as $filePath => $filePosition){
            if($position){
                if($filePosition == $position){
                    $this->renderCssFile($filePath, true);
                    unset(self::$styles[$filePath]);
                }
                continue;
            }
            $this->renderCssFile($filePath, true);
            unset(self::$styles[$filePath]);
        }
        return $this;
    }

    public function renderJsFile($scriptFile, $printOutput = true)
    {
        $output = renderScript($scriptFile);
        return $printOutput ? print $output : $output;
    }

    public function renderCssFile($stylesFile, $printOutput = true)
    {
        $output = renderStyle($stylesFile);
        return $printOutput ? print $output : $output;
    }

    /**
     * Drop from scope array, variable $position is empty
     * @param $path
     * @param int $position
     * @return bool
     */
    public static function addJs($path, $position = self::SCRIPT_STYLE_POSITION_HEAD)
    {
        if(!$position && isset(self::$scripts[$path])){
            unset(self::$scripts[$path]);
            return false;
        }
        self::$scripts[$path] = $position;
        return true;
    }

    /**
     * Drop from scope array, variable $value is empty
     * @param $path
     * @param int $position
     * @return bool
     */
    public static function addCss($path, $position = self::SCRIPT_STYLE_POSITION_HEAD)
    {
        if(!$position && isset(self::$styles[$path])){
            unset(self::$styles[$path]);
            return false;
        }
        self::$styles[$path] = $position;
        return true;
    }
}