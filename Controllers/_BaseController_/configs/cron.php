<?php

use Controllers\_BaseController_\Cron;
use Controllers\_BaseController_\Cron\IndexCron;

Cron::_BaseController_('simple.task')->action(IndexCron::class)->faq('_BaseController_.cron.job.simpleTask')->timeout(1)->frequency(1);
