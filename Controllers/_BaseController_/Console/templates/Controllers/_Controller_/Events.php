<?php

namespace Controllers\_Controller_;

use System\Core\Events as BaseEventsClass;
use System\Core\Events\Hub;

/**
 * Class Events
 * @package Controllers\_Controller_
 * @method static|Hub before_Controller_Running()
 * @method static|Hub after_Controller_Running()
 * @see \System\Core\Router::runEvent() input arguments for Controller events
 */
class Events extends BaseEventsClass
{}