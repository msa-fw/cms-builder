<?php

use Controllers\_Controller_\Router;

Router::_Controller_('/_Controller_')->action(\Controllers\_Controller_\Actions\_Action_Action::class);

//Router::_Controller_('/api', function(\System\Core\Router\BuilderNestedInterface $router){
//    $router->suffix(null)->action(\Controllers\_Controller_\Actions\_Action_Action::class, 'page1')->index(5);
//    $router->suffix('')->action(\Controllers\_Controller_\Actions\_Action_Action::class, 'page2')->index(6);
//    return $router;
//})->action('sdsdfsd')->index(4);

/**
 * target link will be `/_BaseController_/custom` if empty `uri` key
 * @see \System\Core\Router\Builder::uri()
 * @see \System\Core\Router\Builder::action()
 */
//Router::_Controller_(null)->action(\Controllers\_Controller_\Controller::class, 'custom')->index(99, 1);

/**
 * Skip calling in Controller/Action classes;
 * Skip response errors 405, 400, 404, 500
 * @see \System\Core\Router::executeController()
 * @see \System\Core\Router::setActiveRoute()
 */
//Router::_Controller_('/str/simple')->action('simple/key/as/required/param/for/active/routes/key')
//    ->call(function(\System\Core\Router\RouterGetterInterface $router){
//        \System\Core\Response::code(200);
//        $router->setControllerName('SimpleController')
//            ->setActionName('SimpleAction');
//    })->granted(80)->denied(30);