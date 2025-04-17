<?php

use Controllers\_Controller_\Cron;
use Controllers\_Controller_\Cron\_Action_Cron;

Cron::_Controller_('simple.task')->action(_Action_Cron::class)->faq('_Controller_.cron.job.simpleTask')->timeout(1)->frequency(1);
