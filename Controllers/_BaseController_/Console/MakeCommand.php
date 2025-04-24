<?php

namespace Controllers\_BaseController_\Console;

use System\Helpers\Classes\Fs;
use System\Core\Console\ConsoleInterface;
use Controllers\_BaseController_\Console\Make\Filesystem;

class MakeCommand extends Filesystem
{
    /** @var ConsoleInterface */
    protected $console;

    protected $server;

    public function __construct(ConsoleInterface $console)
    {
        $this->server = Fs::server();

        $this->console = $console;
        $this->controllersRoot = $this->root . "/Controllers";
        $this->templatesRoot = $this->root . "/themes";
    }

    public function consoleCommand($controller, $action)
    {
        $this->controller = $controller;
        $this->action = $action;

        $sourceFile = $this->controllersRoot . "/_Controller_/Console/_Action_Command.php";
        $destinationFile = $this->server->root("Controllers/{$controller}/Console/{$action}Command.php");
        return $this->copyFiles($sourceFile, $destinationFile);
    }

    public function controller($controller)
    {
        $this->controller = $controller;

        $sourceFile = $this->controllersRoot;
        $destinationFile = $this->server->root("Controllers");

        $this->copyFiles($sourceFile, $destinationFile);

        $sourceFile = $this->templatesRoot . "/Controllers";
        foreach(scandir($this->server->template('/')) as $theme){
            if($theme == '.' || $theme == '..'){ continue; }
            $destinationFile = $this->server->template("{$theme}/Controllers");

            $this->copyFiles($sourceFile, $destinationFile);
        }

        return true;
    }

    public function action($controller, $action)
    {
        $this->controller = $controller;
        $this->action = $action;

        $sourceFile = $this->controllersRoot . "/_Controller_/Actions/_Action_Action.php";
        $destinationFile = $this->server->root("Controllers/{$controller}/Actions/{$action}Action.php");

        $this->copyFiles($sourceFile, $destinationFile);

        $sourceFile = $this->templatesRoot . "/Controllers/_Controller_/Actions/_Action_Action.html";
        foreach(scandir($this->server->template('/')) as $theme){
            if($theme == '.' || $theme == '..'){ continue; }
            $destinationFile = $this->server->template("{$theme}/Controllers/{$controller}/Actions/{$action}Action.html");
            $this->copyFiles($sourceFile, $destinationFile);
        }

        return true;
    }

    public function cron($controller, $action)
    {
        $this->controller = $controller;
        $this->action = $action;

        $sourceFile = $this->controllersRoot . "/_Controller_/Cron/_Action_Cron.php";
        $destinationFile = $this->server->root("Controllers/{$controller}/Cron/{$action}Cron.php");
        return $this->copyFiles($sourceFile, $destinationFile);
    }

    public function event($controller, $action)
    {
        $this->controller = $controller;
        $this->action = $action;

        $sourceFile = $this->controllersRoot . "/_Controller_/Events/_Action_Event.php";
        $destinationFile = $this->server->root("Controllers/{$controller}/Events/{$action}Event.php");
        return $this->copyFiles($sourceFile, $destinationFile);
    }

    public function form($controller, $action)
    {
        $this->controller = $controller;
        $this->action = $action;

        $sourceFile = $this->controllersRoot . "/_Controller_/Forms/_Action_Form.php";
        $destinationFile = $this->server->root("Controllers/{$controller}/Forms/{$action}Form.php");
        return $this->copyFiles($sourceFile, $destinationFile);
    }

    public function model($controller, $action)
    {
        $this->controller = $controller;
        $this->action = $action;

        $sourceFile = $this->controllersRoot . "/_Controller_/Models/_Action_Model.php";
        $destinationFile = $this->server->root("Controllers/{$controller}/Models/{$action}Model.php");
        return $this->copyFiles($sourceFile, $destinationFile);
    }

    public function test($controller, $action)
    {
        $this->controller = $controller;
        $this->action = $action;

        $sourceFile = $this->controllersRoot . "/_Controller_/Tests/_Action_Test.php";
        $destinationFile = $this->server->root("Controllers/{$controller}/Tests/{$action}Test.php");
        return $this->copyFiles($sourceFile, $destinationFile);
    }

    public function widget($controller, $action)
    {
        $this->controller = $controller;
        $this->action = $action;

        $sourceFile = $this->controllersRoot . "/_Controller_/Widgets/_Action_Widget.php";
        $destinationFile = $this->server->root("Controllers/{$controller}/Widgets/{$action}Widget.php");

        $this->copyFiles($sourceFile, $destinationFile);


        $sourceFile = $this->templatesRoot . "/Controllers/_Controller_/Widgets/_Widget_Widget.html";
        foreach(scandir($this->server->template('/')) as $theme){
            if($theme == '.' || $theme == '..'){ continue; }
            $destinationFile = $this->server->template("{$theme}/Controllers/{$controller}/Widgets/{$action}Widget.html");
            $this->copyFiles($sourceFile, $destinationFile);
        }
        return true;
    }

    public function theme($templateName)
    {
        $this->controller = '_BaseController_';

        $sourceFile = $this->templatesRoot;
        foreach(scandir($this->server->template('/')) as $theme){
            if($theme == '.' || $theme == '..'){ continue; }
            $destinationFile = $this->server->template($templateName);

            $this->copyFiles($sourceFile, $destinationFile);
        }
        return true;
    }
}
