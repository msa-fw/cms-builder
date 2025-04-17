<?php

namespace Controllers\_BaseController_;

use System\Core\Events as BaseEventsClass;
use System\Core\Events\Hub;

/**
 * Class Events
 * @package Controllers\_BaseController_
 * @method static|Hub before_BaseController_Running()
 * @method static|Hub after_BaseController_Running()
 * @see \System\Core\Router::runEvent() input arguments for Controller events
 */
class Events extends BaseEventsClass
{}