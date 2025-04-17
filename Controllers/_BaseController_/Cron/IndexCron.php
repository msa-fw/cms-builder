<?php

namespace Controllers\_BaseController_\Cron;

class IndexCron
{
    public function __construct()
    {
    }

    public function execute()
    {
        print "ok\n";
        return true;
    }
}