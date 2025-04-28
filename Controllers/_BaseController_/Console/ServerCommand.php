<?php

namespace Controllers\_BaseController_\Console;

use Controllers\_BaseController_\Language;
use System\Core\Console\ConsoleInterface;

use function console\success;
use function console\warning;

class ServerCommand
{
    /** @var ConsoleInterface */
    protected $console;

    public function __construct(ConsoleInterface $console)
    {
        $this->console = $console;
    }

    public function runServer($host = '127.0.0.1', $port = '8080')
    {
        $host = trim($host);
        $port = trim($port, ": ");

        return $this->start($host, $port);
    }

    protected function start($host, $port)
    {
        success(Language::_BaseController_('console.server.startedSuccessfully')
            ->string(true)->replace_k2v(array('%host%' => $host, '%port%' => $port)))->print();
        warning(Language::_BaseController_('console.server.startedEscape')->returnKey())->print(PHP_EOL . str_repeat('.', 50) . PHP_EOL);

        shell_exec(PHP_BINARY . " -S $host:$port server.php");
        return true;
    }
}