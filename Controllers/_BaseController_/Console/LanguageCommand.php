<?php

namespace Controllers\_BaseController_\Console;

use System\Helpers\Classes\Fs;
use Controllers\_BaseController_\Language;
use System\Core\Console\ConsoleInterface;

use function console\danger;
use function console\success;
use function console\warning;
use function filesystem\read;
use function filesystem\write;

class LanguageCommand
{
    protected $controllerDirectory;
    /** @var ConsoleInterface */
    protected $console;

    public function __construct(ConsoleInterface $console)
    {
        $this->console = $console;
        $this->controllerDirectory = Fs::server()->root("Controllers");
    }

    public function execute($languageCode)
    {
        foreach(scandir($this->controllerDirectory) as $controller){
            if($controller == '.' || $controller == '..'){ continue; }

            $this->createLangFile($controller, $languageCode);
        }
        return $this;
    }

    public function createLangFile($controller, $languageCode)
    {
        $languagesDirectory = "{$this->controllerDirectory}/{$controller}/languages";

        $destinationFile = "{$languagesDirectory}/{$languageCode}.php";
        if(file_exists($destinationFile)){
            warning(Language::_BaseController_('console.language.langPackFileAlreadyExist')->string(true)->replace_k2v(array('%file%' => $destinationFile)))->print();
            return false;
        }

        if(($content = $this->getContent($controller, $languagesDirectory, $filePath)) && write($destinationFile, $content)){
            success(Language::_BaseController_('console.language.langPackAddedSuccessful')->string(true)->replace_k2v(array('%file%' => $destinationFile)))->print();
            return $this;
        }
        danger(Language::_BaseController_('console.language.langPackNotAdded')->string(true)->replace_k2v(array('%file%' => $destinationFile, '%target%' => $filePath)))->print();
        return false;
    }

    protected function getContent($controller, $languagesDirectory, &$filePath)
    {
        $content = '';
        foreach(scandir($languagesDirectory) as $file){
            if($file == '.' || $file == '..'){ continue; }

            $filePath = "{$languagesDirectory}/{$file}";

            if(is_file($filePath) && is_readable($filePath)){
                if($tmp = read($filePath)){
                    $content = preg_replace("#->write\((.*?)\);#usim", "->write('');", $tmp);
                    $content = preg_replace("#use Controllers\\\\\w+\\\\Language#usim", "use Controllers\\{$controller}\\Language", $content);
                    $content = preg_replace("#\nLanguage\:\:\w+\(#usim", "\nLanguage::{$controller}(", $content);
                }
            }
        }
        return $content;
    }
}