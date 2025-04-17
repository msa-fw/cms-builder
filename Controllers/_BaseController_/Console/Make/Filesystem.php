<?php

namespace Controllers\_BaseController_\Console\Make;

use Controllers\_BaseController_\Language;

use function console\danger;
use function console\success;
use function filesystem\read;
use function filesystem\copyFilesRecursive;

class Filesystem
{
    protected $root = ROOT . '/Controllers/_BaseController_/Console/templates';
    protected $controllersRoot;
    protected $templatesRoot;

    protected $controller;
    protected $action;

    protected function copyFiles($sourceFilePath, $destFilePath)
    {
        $this->action = $this->action ?: 'Index';

        return copyFilesRecursive($sourceFilePath, $destFilePath, function($target, $destination){
            $destination = str_replace(array('_Controller_', '_Action_', '_Widget_'), array($this->controller, $this->action, $this->action), $destination);

            $directory = dirname($destination);
            if(!is_dir($directory)){ mkdir($directory, 0755, true); }

            if(file_exists($destination)){
                return danger(Language::_BaseController_('console.make.fileAlreadyExists')->string(true)->replace_k2v(array('%FILE%' => $destination)))->print();
            }

            $content = read($target);
            $content = str_replace(array('_Controller_', '_Action_', '_Widget_'), array($this->controller, $this->action, $this->action), $content);

            if(file_put_contents($destination, $content) !== false){
                return success(Language::_BaseController_('console.make.fileCreatedSuccessfully')->string(true)->replace_k2v(array('%FILE%' => $destination)))->print();
            }
            return danger(Language::_BaseController_('console.make.errorOnCreatingFile')->string(true)->replace_k2v(array('%FILE%' => $destination)))->print();
        });
    }
}