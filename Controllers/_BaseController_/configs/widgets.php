<?php

use Controllers\_BaseController_\Widget;

Widget::header()->add()->handler(\Controllers\_BaseController_\Widgets\IndexWidget::class, 'execute', '"header" widget position')
//    ->disabledControllers('_BaseController_', Controllers\_BaseController_\Controller::class)
//    ->disabledPages(\Controllers\_BaseController_\Actions\IndexAction::class)
//    ->disabledUserGroups(\System\Core\Session::USER_GROUP_GUEST)
//    ->disabledUrisList('/simple/simple2/*')
//    ->enabledUserGroups(\System\Core\Session::USER_GROUP_ADMIN)
;


Widget::top()->add()->handler(\Controllers\_BaseController_\Widgets\IndexWidget::class, 'execute', '"top" widget position');

Widget::leftbar()->add()->handler(\Controllers\_BaseController_\Widgets\IndexWidget::class, 'execute', '"leftbar" widget position')
    ->title('Left widget title');
Widget::leftbar()->add()->handler(\Controllers\_BaseController_\Widgets\IndexWidget::class, 'execute', '"leftbar" widget position')
    ->title('Left widget title 2');

Widget::bodyTop()->add()->handler(\Controllers\_BaseController_\Widgets\IndexWidget::class, 'execute', '"bodyTop" widget position');
Widget::bodyDown()->add()->handler(\Controllers\_BaseController_\Widgets\IndexWidget::class, 'execute', '"bodyDown" widget position');

Widget::rightbar()->add()->handler(\Controllers\_BaseController_\Widgets\IndexWidget::class, 'execute', '"rightbar" widget position')
    ->title('Right widget title');
Widget::rightbar()->add()->handler(\Controllers\_BaseController_\Widgets\IndexWidget::class, 'execute', '"rightbar" widget position')
    ->title('Right widget title 2');

Widget::bottom()->add()->handler(\Controllers\_BaseController_\Widgets\IndexWidget::class, 'execute', '"bottom" widget position');

Widget::footer()->add()->handler(\Controllers\_BaseController_\Widgets\IndexWidget::class, 'execute', '"footer" widget position');

Widget::footer()->add()->handler(\Controllers\_BaseController_\Widgets\IndexWidget::class, 'debugWidget')
    ->template('Controllers/_BaseController_/Widgets/DebugWidget.html');


