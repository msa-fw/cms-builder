<?php

use System\Singleton;

require_once __DIR__ . "/../core.php";

// catch errors
$debug = Singleton::Debug();


// init events manager
$events = Singleton::Events();
$events->loadControllersParams("configs/events.php");
Singleton::Events()->afterEventsInitialize()->run($events);


Singleton::Events()->beforeSystemStart()->run();


// init config manager
$config = Singleton::Config();
Singleton::Events()->beforeConfigInitialize()->run($config);

$config->initialize();
$config->loadControllersParams("configs/config.php");
Singleton::Events()->afterConfigInitialize()->run($config);


// init request manager
$request = Singleton::Request();
Singleton::Events()->beforeRequestInitialize()->run($request);

$request->initialize();
Singleton::Events()->afterRequestInitialize()->run($request);


// init session manager
$session = Singleton::Session();
Singleton::Events()->beforeSessionStart()->run($session);

$session->setSessionId();
$session->initialize();
Singleton::Events()->afterSessionStart()->run($session);


// init languages manager
$language = Singleton::Language();
Singleton::Events()->beforeLanguageInitialize()->run($language);

$languageCode = $config->general('language')->read('en');
$language->loadControllersParams("languages/$languageCode.php");
Singleton::Events()->afterLanguageInitialize()->run($language);


// init controllers manager
$router = Singleton::Router();
$router->loadControllersParams("configs/router.php");
Singleton::Events()->beforeControllerLoading()->run($router);

$actionResult = $router->runController($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
Singleton::Events()->afterControllerLoading()->run($router, $actionResult);


// init template manager
$accept = $request->headers('accept')
    ->string()->htmlspecialchars();

$template = Singleton::Template($accept);
Singleton::Events()->beforeTemplateInitialize()->run($template);

$template->initialize();
$template->render();
Singleton::Events()->afterTemplateInitialize()->run($template);


// render content
$renderObject = $template->getRenderObject();
Singleton::Events()->beforeTemplateRender()->run($renderObject);

$template->sendHeaders();
$template->sendCookies();

$renderOnlyControllerBody = $request->headers('x-only-body')
    ->string()->htmlspecialchars();

if(!$renderOnlyControllerBody){
    $renderObject->renderContent();
}else{
    $controller = $renderObject->renderController();
    $content = $controller->getControllerContentResult();
    $renderObject->setDataContentResult($content);
}

Singleton::Events()->afterTemplateRender()->run($renderObject);
print $renderObject->getDataContentResult();


Singleton::Events()->afterSystemStart()->run();

