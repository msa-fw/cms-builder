<?php

use Controllers\_BaseController_\Config;

Config::_BaseController_('enabled')->write(true);

Config::_BaseController_('testsSleepTime')->write(0);

Config::_BaseController_('debugLoggerDriver')->write(\Controllers\_BaseController_\Events\LoggerDrivers\FS::class);