<?php

use System\Core\Form;
use System\Core\Request;
use Controllers\_BaseController_\Config;
use Controllers\_BaseController_\Router;
use System\Core\Router\RouterGetterInterface;

Router::_BaseController_('/')->action(\Controllers\_BaseController_\Actions\IndexAction::class);

Router::_BaseController_('/captcha/update')->action('updateCaptchaAction')->call(function(RouterGetterInterface $router){
    $delay = Config::security('captcha')
        ->key('captchaGenerationDelay')->read(0);

    sleep($delay);

    $field = Request::request('field')->read('');

    header('Content-Type: image/jpeg');

    if($image = Form::getCaptchaImage($field)){
        print ($image);
    }
    return exit;
});


//Router::_BaseController_('/api', function(\System\Core\Router\BuilderNestedInterface $router){
//    $router->suffix(null)->action(\Controllers\_BaseController_\Actions\IndexAction::class, 'page1')->index(5);
//    $router->suffix('')->action(\Controllers\_BaseController_\Actions\IndexAction::class, 'page2')->index(6);
//    return $router;
//})->action('sdsdfsd')->index(4);

/**
 * target link will be `/_BaseController_/custom` if empty `uri` key
 * @see \System\Core\Router\Builder::uri()
 * @see \System\Core\Router\Builder::action()
 */
//Router::_BaseController_(null)->action(\Controllers\_BaseController_\Controller::class, 'custom')->index(99, 1);

/**
 * Skip calling in Controller/Action classes;
 * Skip response errors 405, 400, 404, 500
 * @see \System\Core\Router::executeController()
 * @see \System\Core\Router::setActiveRoute()
 */
//Router::_BaseController_('/str/simple')->action('simple/key/as/required/param/for/active/routes/key')
//    ->call(function(\System\Core\Router\RouterGetterInterface $router){
//        \System\Core\Response::code(200);
//        $router->setControllerName('SimpleController')
//            ->setActionName('SimpleAction');
//    })->granted(80)->denied(30);