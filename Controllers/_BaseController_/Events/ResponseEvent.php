<?php

namespace Controllers\_BaseController_\Events;

use System\Core\Config;
use System\Core\Router;
use System\Core\Response;

use function language\translate;
use function web\templateHttp;

class ResponseEvent
{
    /** @var Router  */
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function setBaseResponseBefore()
    {
        Response::meta('charset')->custom('charset', 'utf-8');
        Response::meta('viewport')->name('viewport')->content('width=device-width, initial-scale=1.0');
        Response::meta('referrer')->name('referrer')->content('origin-when-cross-origin');
        Response::meta('http-equiv')->custom('http-equiv', 'content-type')->content('text/html; charset=utf-8');
        Response::meta('http-equiv')->custom('http-equiv', 'X-UA-Compatible')->content('IE=edge');

        $icon = Config::template('siteIcon')->read();
        Response::icon(templateHttp($icon));

        $siteName = Config::template('siteName')->read();
        Response::title('main', $siteName);

        return $this;
    }

    public function setBaseResponseAfter()
    {
        $controllerName = $this->router->getControllerName();
        $controllerNameTranslated = translate("{$controllerName}.controller.name");

        Response::title('controller', $controllerNameTranslated);

        Response::meta('author')->name('author')->content('');
        Response::meta('keywords')->name('keywords')->content('');
        Response::meta('description')->name('description')->content($controllerNameTranslated);
        return $this;
    }
}