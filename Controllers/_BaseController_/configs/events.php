<?php

use Controllers\_BaseController_\Events;

Events::afterRequestInitialize()->append()->handler(Events\RequestEvent::class, 'fillRequestFromPutData');

Events::beforeControllerLoading()->append()->handler(Events\ResponseEvent::class, 'setBaseResponseBefore');
Events::afterControllerLoading()->append()->handler(Events\ResponseEvent::class, 'setBaseResponseAfter');

Events::afterTemplateRender()->append()->handler(Events\RenderEvent::class, 'compressHtmlContent');
Events::afterSessionStart()->append()->handler(Events\SessionEvent::class, 'setDefaultUserGroup');

Events::beforeTemplateRender()->append()->handler(Events\WidgetsEvent::class, 'initializeWidgets');
Events::beforeTemplateRender()->append()->handler(Events\WidgetsEvent::class, 'executeWidgetsForAnotherRenderTypes');

Events::afterConfigInitialize()->append()->handler(Events\LoggingErrorsEvent::class);