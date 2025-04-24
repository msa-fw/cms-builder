<?php

namespace System;

use System\Core\Config;
use System\Core\Database;
use System\Helpers\Classes\Fs;
use System\Core\Console\Dialog;

use function console\danger;
use function console\message;
use function console\success;
use function console\warning;
use function strings\generate;
use function filesystem\read;
use function filesystem\write;
use function filesystem\makeDirectory;
use function filesystem\scanDirectoryCallback;

/**
 * Only CLI-mode
 * System installer: not for using
 * Try execute command `php install` in your console
 * For first run, after copy system files
 * Class Installer
 * @package System
 */
class Installer
{
    protected $answers = array(
        'siteName' => 'My Site',
        'publicDir' => 'public',
        'defaultController' => 'Home',
        'defaultTemplate' => 'main',

        'databaseName' => '',
        'databaseUser' => '',
        'databasePass' => '',
        'databaseHost' => 'localhost',
        'databasePort' => '3306',
    );

    protected $sourceFiles = array(
        'config' => '_config.php',
        'htaccess' => '_.htaccess',
    );

    protected $server;

    public function __construct()
    {
        $this->server = Fs::server();

        $this->sourceFiles['self'] = $_SERVER['PHP_SELF'];
        $this->sourceFiles['config'] = $this->server->root($this->sourceFiles['config']);
        $this->sourceFiles['htaccess'] = $this->server->root($this->sourceFiles['htaccess']);
    }

    public function setSiteName()
    {
        $dialog = new Dialog(message("Enter site name")->get(''));

        if($answer = $dialog->getAnswer()){
            $this->answers['siteName'] = $answer;
            return $this;
        }
        return $this->setSiteName();
    }

    public function setPublicDir()
    {
        $dialog = new Dialog(message("Enter site public directory")->get(''));

        if($answer = $dialog->getAnswer()){
            $answer = preg_replace("#[^\w]+#usim", '_', $answer);
            $this->answers['publicDir'] = preg_replace("#\_+#usim", '_',  $answer);
            return $this;
        }
        return $this->setPublicDir();
    }

    public function setDefaultControllerName()
    {
        $dialog = new Dialog(message("Enter site default controller name")->get(''));

        if($answer = $dialog->getAnswer()){
            $answer = preg_replace("#[^\w]+#usim", '_', $answer);
            $this->answers['defaultController'] = preg_replace("#\_+#usim", '_',  $answer);
            return $this;
        }
        return $this->setDefaultControllerName();
    }

    public function setDefaultThemeName()
    {
        $dialog = new Dialog(message("Enter site default template name")->get(''));

        if($answer = $dialog->getAnswer()){
            $answer = preg_replace("#[^\w]+#usim", '_', $answer);
            $this->answers['defaultTemplate'] = preg_replace("#\_+#usim", '_',  $answer);
            return $this;
        }
        return $this->setDefaultThemeName();
    }

    public function setDatabaseConfiguration()
    {
        $dialog = new Dialog(message("Enter site database name")->get(''));
        $this->answers['databaseName'] = $dialog->getAnswer();

        $dialog = new Dialog(message("Enter site database user")->get(''));
        $this->answers['databaseUser'] = $dialog->getAnswer();

        $dialog = new Dialog(message("Enter site database user password")->get(''));
        $this->answers['databasePass'] = $dialog->getAnswer();

        $dialog = new Dialog(message("Enter site database host (or `{$this->answers['databaseHost']}` def)")->get(''));
        $this->answers['databaseHost'] = $dialog->getAnswer() ?: $this->answers['databaseHost'];

        $dialog = new Dialog(message("Enter site database port (or `{$this->answers['databasePort']}` def)")->get(''));
        $answer = $dialog->getAnswer();
        $this->answers['databasePort'] = is_numeric($answer) ? $answer : $this->answers['databasePort'];

        try{
            Config::database('installConnectionTest')->key('driver')->write(\System\Core\Database\Drivers\MySQLi::class);
            Config::database('installConnectionTest')->key('locale')->write(\System\Core\Database\Statics\Locales::ru_RU);
            Config::database('installConnectionTest')->key('charset')->write(\System\Core\Database\Statics\Collate::utf8mb4_unicode_520_ci()->getCharset());
            Config::database('installConnectionTest')->key('collate')->write(\System\Core\Database\Statics\Collate::utf8mb4_unicode_520_ci()->getCollate());
            Config::database('installConnectionTest')->key('engine')->write(\System\Core\Database\Statics\TableOptions::MYSQL_ENGINE_MY_ISAM);
            Config::database('installConnectionTest')->key('base')->write($this->answers['databaseName']);
            Config::database('installConnectionTest')->key('user')->write($this->answers['databaseUser']);
            Config::database('installConnectionTest')->key('pass')->write($this->answers['databasePass']);
            Config::database('installConnectionTest')->key('host')->write($this->answers['databaseHost']);
            Config::database('installConnectionTest')->key('port')->write($this->answers['databasePort']);
            Config::database('installConnectionTest')->key('databaseMode')->write(array(
                'STRICT_TRANS_TABLES',
                'NO_ZERO_IN_DATE',
                'NO_ZERO_DATE',
                'ERROR_FOR_DIVISION_BY_ZERO',
                'NO_ENGINE_SUBSTITUTION',
            ));

            Database::connect('installConnectionTest')->query('show databases');
        }catch(\Exception $exception){
            danger($exception->getMessage())->print();
            return $this->setDatabaseConfiguration();
        }

        return $this;
    }

    public function install()
    {
        if($config = file_get_contents($this->sourceFiles['config'])){
            $replace = array(
                '[_SiteName_]'      => $this->answers['siteName'],
                '[_WEB_]'           => $this->answers['publicDir'],
                '[_SECRET_KEY_]'    => generate(128),
                '_BaseTheme_'       => $this->answers['defaultTemplate'],

                '[_DataBaseName_]' => $this->answers['databaseName'],
                '[_DataBaseUser_]' => $this->answers['databaseUser'],
                '[_DataBasePass_]' => $this->answers['databasePass'],
                '[_DataBaseHost_]' => $this->answers['databaseHost'],
                '[_DataBasePort_]' => $this->answers['databasePort'],
            );

            $config = str_replace(array_keys($replace), array_values($replace), $config);
            file_put_contents($this->server->root('config.php'), $config);
        }

        if($htaccess = file_get_contents($this->sourceFiles['htaccess'])){
            $htaccess = str_replace(array('[_SiteName_]', '[_WEB_]'), array($this->answers['siteName'], $this->answers['publicDir']), $htaccess);
            file_put_contents($this->server->root('.htaccess'), $htaccess);
        }

        rename($this->server->root('web'), $this->server->root($this->answers['publicDir']));

        scanDirectoryCallback(ROOT, function($file){
            if(is_file($file)){
                $content = read($file);
                $content = str_replace(array('_BaseController_', 'web/'), array($this->answers['defaultController'], "{$this->answers['publicDir']}/"), $content);
                write($file, $content);
            }
            if(strpos($file, 'Controllers/_BaseController_') || strpos($file, 'templates/_BaseTheme_')){
                $newFileName = str_replace(
                    array('_BaseController_', '_BaseTheme_'),
                    array($this->answers['defaultController'], $this->answers['defaultTemplate']),
                    $file
                );

                makeDirectory(dirname($newFileName));
                if(is_file($file)){
                    copy($file, $newFileName);
                    return unlink($file);
                }
                return rmdir($file);
            }
            return false;
        });
    }

    public function clean()
    {
        $dialog = new Dialog(warning(" Delete config source files? (Yes/No) ")->get(''));

        if($dialog->validate()->compare('Yes')->getStatus()){
            foreach($this->sourceFiles as $sourceFile){
                if(unlink($sourceFile)){
                    success(" File $sourceFile deleted ")->print();
                }else{
                    danger(" Error on deleting file $sourceFile ")->print();
                }
            }
        }
    }

    public function run($currentDirectory)
    {
        $dialog = new Dialog(warning(" Run system? (y/n) ")->get(''));

        if($dialog->validate()->compare('y')->getStatus()){
            $commandPath = PHP_BINARY . ' ' . $currentDirectory;

            print shell_exec("{$commandPath}/cli migrate:run");
            print shell_exec("{$commandPath}/cli migrate:run:fill");
            print shell_exec("{$commandPath}/cli server:run");
        }
    }
}