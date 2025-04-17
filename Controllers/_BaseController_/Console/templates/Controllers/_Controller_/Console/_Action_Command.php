<?php

namespace Controllers\_Controller_\Console;

use System\Core\Console\ConsoleInterface;
use function console\success;

class _Action_Command
{
    /** @var ConsoleInterface */
    protected $console;

    public function __construct(ConsoleInterface $console)
    {
        $this->console = $console;
    }

    public function execute()
    {
        success(__METHOD__ . ': OK')->print();
        return true;
    }
}