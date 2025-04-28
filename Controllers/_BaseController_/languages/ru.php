<?php

use Controllers\_BaseController_\Language;

Language::_BaseController_('controller.name')->write('Главная _BaseController_');


Language::_BaseController_('console.make.fileAlreadyExists')->write('Файл `%FILE%` уже существует');
Language::_BaseController_('console.make.errorOnCreatingFile')->write('Файл `%FILE%` по какой-то причине не был создан');
Language::_BaseController_('console.make.fileCreatedSuccessfully')->write('Файл `%FILE%` успешно создан');
Language::_BaseController_('console.make.dontForgetRegisterRoute')->write('Не забудьте зарегистрировать роут для этого скрипта (ред. файл `%FILE%`)');

Language::_BaseController_('console.make.cmd.description')->write('Создать класс консольной команды');
Language::_BaseController_('console.make.controller.description')->write('Создать набор файлов контроллера');
Language::_BaseController_('console.make.action.description')->write('Создать класс экшина контроллера');
Language::_BaseController_('console.make.cron.description')->write('Создать класс CRON задачи');
Language::_BaseController_('console.make.event.description')->write('Создать класс перехватчика событий');
Language::_BaseController_('console.make.form.description')->write('Создать класс билдера HTML-формы');
Language::_BaseController_('console.make.model.description')->write('Создать класс модели контроллера');
Language::_BaseController_('console.make.test.description')->write('Создать класс тестирования скриптов');
Language::_BaseController_('console.make.theme.description')->write('Создать набор файлов HTML-шаблона сайта');
Language::_BaseController_('console.make.widget.description')->write('Создать класс виджета');

Language::_BaseController_('console.help.cmd.descriptionCommon')->write('Получить общую справку для всех команд');
Language::_BaseController_('console.help.cmd.descriptionCategory')->write('Получить справку по категории консольных команд');

Language::_BaseController_('console.tests.test1')->write('Тест интерактивного режима: с колбеком');
Language::_BaseController_('console.tests.test2')->write('Тест интерактивного режима: с обычным сравнением строк');
Language::_BaseController_('console.tests.test3')->write('Тест интерактивного режима: без каких либо проверок валидности ввода');
Language::_BaseController_('console.tests.requestMethods')->write("Тест REQUEST METHOD'ов сайта. Сайт должен быть доступен по HTTP-протоколу");

Language::_BaseController_('console.cron.help')->write("Показать справку и описание по CRON-задачам");
Language::_BaseController_('console.cron.runAllTasks')->write("Выполнить список всех CRON-задач");
Language::_BaseController_('console.cron.runSimpleTask')->write("Выполнить определенную CRON-задачу по ключу");

Language::_BaseController_('console.server.runServer')->write("Запустить локальный сервер разработки");

Language::_BaseController_('console.database.create')->write("Создать базу данных");
Language::_BaseController_('console.database.delete')->write("Удалить базу данных");
Language::_BaseController_('console.database.rename')->write("Переименовать базу данных");
Language::_BaseController_('console.database.table.create')->write("Создать таблицу базы данных");
Language::_BaseController_('console.database.table.drop')->write("Удалить таблицу базы данных");
Language::_BaseController_('console.database.table.rename')->write("Переименовать таблицу базы данных");
Language::_BaseController_('console.database.table.truncate')->write("Очистить таблицу базы данных");
Language::_BaseController_('console.database.table.optimize')->write("Оптимизировать таблицу базы данных");

Language::_BaseController_('console.migration.alter')->write("Создать класс апгрейда таблицы БД");
Language::_BaseController_('console.migration.table')->write("Создать класс создания таблицы БД");
Language::_BaseController_('console.migration.fill')->write("Создать класс заполнения таблицы БД тестовыми данными");
Language::_BaseController_('console.migration.run')->write("Выполнить миграциюю таблиц в базу данных");
Language::_BaseController_('console.migration.runFill')->write("Заполнить таблицы базы данных тестовыми данными");

Language::_BaseController_('console.language.addLanguagePack')->write("Создать набор языковых файлов");
Language::_BaseController_('console.language.langPackAddedSuccessful')->write(" Языковой файл успешно создан в `%file%` ");
Language::_BaseController_('console.language.langPackNotAdded')->write(" Языковой файл не был создан в `%file%`. \n Убедитесь, что целевой файл `%target%` доступен для чтения ");
Language::_BaseController_('console.language.langPackFileAlreadyExist')->write(" Языковой файл уже существует в `%file%` ");

Language::_BaseController_('console.migration.fileCreated')->write("Файл был успешно создан в `%file%`");
Language::_BaseController_('console.migration.fileNotCreated')->write("Файл не был создан в `%file%`");
Language::_BaseController_('console.migration.run.fileExist')->write("Файл `%file%` уже существует");
Language::_BaseController_('console.migration.run.exportedSuccessfully')->write("Файл `%file%` успешно экспортирован");
Language::_BaseController_('console.migration.run.notExported')->write("Файл `%file%` не был экспортирован");

Language::_BaseController_('console.server.startedSuccessfully')->write(" Сервер успешно запущен на хосте `http://%host%:%port%` ");
Language::_BaseController_('console.server.startedEscape')->write(" Для остановки нажмите `CTRL + C` ");

Language::_BaseController_('console.tests.runAll')->write("Выполнить все задекларированные тесты");
Language::_BaseController_('console.tests.runController')->write("Выполнить все тесты контроллера");
Language::_BaseController_('console.tests.runControllerClass')->write("Выполнить конкретный тест контроллера");
Language::_BaseController_('console.tests.runControllerClassMethod')->write("Выполнить конкретный метод теста контроллера (список аргументов неограничен)");
Language::_BaseController_('console.tests.classNotFound')->write("Класс `%class%` не существует");
Language::_BaseController_('console.tests.action')->write("Задача `%class%::%method%()` ");
Language::_BaseController_('console.tests.actionSuccess')->write(" ВЫПОЛНЕНА (за %time% сек)");
Language::_BaseController_('console.tests.actionError')->write(" ПРОВАЛЕНА (после %time% сек)");
Language::_BaseController_('console.tests.skippedByRequiredParams')->write(" ПРОПУЩЕНА (дефицит входящих аргументов)");
Language::_BaseController_('console.tests.controllerExecution')->write("Выполненяется контроллер `%controller%`");
Language::_BaseController_('console.tests.classExecution')->write("Выполненяется класс `%action%` из контроллера `%controller%`");
Language::_BaseController_('console.tests.classMethodExecution')->write("Выполненяется метод `%action%::%method%()` из контроллера `%controller%`");

Language::_BaseController_('cron.job.simpleTask')->write("Запускает на выполнение тестовую задачу; ничего не делает, просто проверяет, что все работает");

Language::_BaseController_('database.createdSuccessfully')->write('База данных `%db%` успешно создана');
Language::_BaseController_('database.notCreated')->write('База данных `%db%` не была создана');
Language::_BaseController_('database.deletedSuccessfully')->write('База данных `%db%` успешно удалена');
Language::_BaseController_('database.notDeleted')->write('База данных `%db%` не была удалена');
Language::_BaseController_('database.renamedSuccessfully')->write('База данных `%db%` успешно переименована в `%new%`');
Language::_BaseController_('database.notRenamed')->write('База данных `%db%` не была переименована в `%new%`');
Language::_BaseController_('database.alreadyExist')->write('База данных `%db%` уже существует');
Language::_BaseController_('database.notExist')->write('База данных `%db%` не существует');

Language::_BaseController_('database.table.createdSuccessfully')->write('Таблица `%db%`.`%tbl%` успешно создана');
Language::_BaseController_('database.table.notCreated')->write('Таблица `%db%`.`%tbl%` не была создана');
Language::_BaseController_('database.table.deletedSuccessfully')->write('Таблица `%db%`.`%tbl%` успешно удалена');
Language::_BaseController_('database.table.notDeleted')->write('Таблица `%db%`.`%tbl%` не была удалена');
Language::_BaseController_('database.table.renamedSuccessfully')->write('Таблица `%db%`.`%tbl%` успешно переименована в `%new%`');
Language::_BaseController_('database.table.notRenamed')->write('Таблица `%db%`.`%tbl%` не была переименована в `%new%`');
Language::_BaseController_('database.table.truncatedSuccessfully')->write('Таблица `%db%`.`%tbl%` успешно очищена');
Language::_BaseController_('database.table.notTruncated')->write('Таблица `%db%`.`%tbl%` не была очищена');
Language::_BaseController_('database.table.optimizedSuccessfully')->write('Таблица `%db%`.`%tbl%` успешно оптимизирована');
Language::_BaseController_('database.table.alreadyExist')->write('Таблица `%db%`.`%tbl%` уже существует');
Language::_BaseController_('database.table.notExist')->write('Таблица `%db%`.`%tbl%` не существует');

Language::_BaseController_('widgets.widget.debug.memory')->write('<div class="key">Память</div> <div class="value">%total% kb</div>');
Language::_BaseController_('widgets.widget.debug.memoryMax')->write('<div class="key">Память (пик)</div> <div class="value">%total% kb</div>');
Language::_BaseController_('widgets.widget.debug.pageGenerationTime')->write('<div class="key">Время страницы</div> <div class="value">%total% s.</div>');
Language::_BaseController_('widgets.widget.debug.templateGenerationTime')->write('<div class="key">Время шаблона</div> <div class="value">%total% s.</div>');

Language::_BaseController_('widgets.widget.debug.eventsLinkValue')->write('<div class="key">События</div> <div class="value">%total%</div>');
Language::_BaseController_('widgets.widget.debug.databaseLinkValue')->write('<div class="key">База данных</div> <div class="value">%total%</div>');
Language::_BaseController_('widgets.widget.debug.cacheLinkValue')->write('<div class="key">Кеш</div> <div class="value">%total%</div>');
Language::_BaseController_('widgets.widget.debug.widgetsLinkValue')->write('<div class="key">Виджеты</div> <div class="value">%total%</div>');
Language::_BaseController_('widgets.widget.debug.filesLinkValue')->write('<div class="key">Файлы</div> <div class="value">%total%</div>');
Language::_BaseController_('widgets.widget.debug.classesLinkValue')->write('<div class="key">Классы</div> <div class="value">%total%</div>');

Language::_BaseController_('widgets.widget.debug.eventsTitle')->write('<div class="key">События: <span class="value">%total%</span></div>');
Language::_BaseController_('widgets.widget.debug.databaseTitle')->write('<div class="key">База данных: <span class="value">%total%</span></div>');
Language::_BaseController_('widgets.widget.debug.cacheTitle')->write('<div class="key">Кеш: <span class="value">%total%</span></div>');
Language::_BaseController_('widgets.widget.debug.widgetsTitle')->write('<div class="key">Виджеты: <span class="value">%total%</span></div>');
Language::_BaseController_('widgets.widget.debug.filesTitle')->write('<div class="key">Файлы: <span class="value">%total%</span></div>');
Language::_BaseController_('widgets.widget.debug.classesTitle')->write('<div class="key">Классы: <span class="value">%total%</span></div>');

Language::_BaseController_('widget.isRemovable')->write('Этот виджет можно удалить');

/**
 * System language translates
 */

Language::System('console.debug.addictedLine')->write("КОМАНДА `%line%`");
Language::System('console.debug.pageGenerationTime')->write("ВРЕМЯ ВЫПОЛНЕНИЯ %time%с.");
Language::System('console.debug.pageMemoryUsage')->write("РАСХОД ПАМЯТИ %memory%кб");
Language::System('console.debug.pageMemoryUsagePeak')->write("РАСХОД ПАМЯТИ В ПИКЕ %memory%кб");

Language::System('cron.job.error.disabled')->write('CRON задача отключена');
Language::System('cron.job.successful')->write('CRON задача успешно завершена');
Language::System('cron.job.error.emptyResponse')->write('CRON задача выполнена, но прислала пустой ответ');
Language::System('cron.job.error.invalidMethod')->write('Не действительный метод `%method%` класса для CRON задачи');
Language::System('cron.job.error.invalidClass')->write('Не существует класс `%class%` для CRON задачи');
Language::System('cron.job.error.expired')->write('CRON задача просрочена');
Language::System('cron.job.error.skipped')->write('CRON задача пропущена');
Language::System('cron.job.ready')->write('CRON задача готова');
Language::System('cron.job.error.notReady')->write('CRON задача еще не готова');
Language::System('cron.job.new')->write('CRON задача создана');

Language::System('form.field.submitValue')->write('Отправить');

Language::System('form.validation.error.field.csrfTokenEmpty')->write('CSRF-токен не был отправлен в запросе');
Language::System('form.validation.error.field.csrfTokenNotEqual')->write('CSRF-токен не совпал с тем, который был отправлен в запросе');
Language::System('form.validation.error.field.captchaNotExists')->write('CAPTCHA не существует. Не с чем сверять. Обновите страницу и повторите попытку.');
Language::System('form.validation.error.field.captchaIsEmpty')->write('CAPTCHA не была отправлена в запросе');
Language::System('form.validation.error.field.captchaNotEqual')->write('CAPTCHA не совпала с той, которая была отправлена в запросе');
Language::System('form.validation.error.field.email')->write('Значение не является корректным e-mail адресом');
Language::System('form.validation.error.field.password.uppercase')->write('Значение должно содержать символы верхнего регистра');
Language::System('form.validation.error.field.password.numbers')->write('Значение должно содержать цифры');
Language::System('form.validation.error.field.password.lowercase')->write('Значение должно содержать символы нижнего регистра');
Language::System('form.validation.error.field.password.symbols')->write('Значение должно содержать символы `%chars%`');
Language::System('form.validation.error.field.number')->write('Значение не является корректным целым числом');
Language::System('form.validation.error.field.phone')->write('Значение не является корректным номером телефона');
Language::System('form.validation.error.field.url')->write('Значение не является корректным URL-адресом');
Language::System('form.validation.error.field.data')->write('Значение не является корректной датой');

Language::System('form.validation.error.field.file.notMultiple')->write('Поле не поддерживает загрузку в режиме одного файла');
Language::System('form.validation.error.field.file.multiple')->write('Поле не поддерживает загрузку файла в множественном режиме');
Language::System('form.validation.error.field.file.minSize')->write('Размер файла <b>`%file%`</b> &mdash; <b>`%size%`</b> байт. Необходимо минимум <b>%need%</b> байт.');
Language::System('form.validation.error.field.file.maxSize')->write('Размер файла <b>`%file%`</b> &mdash; <b>`%size%`</b> байт. Допустимо максимум <b>%need%</b> байт.');
Language::System('form.validation.error.field.file.notAccept')->write('Тип файла `%mime%` не поддерживается для поля <b>`%field%`</b>');

Language::System('form.validation.error.field.file.uploadError')->write('Возникла неизвестная ошибка при загрузкке файла <b>`%file%`</b> (код: # %code%)');
Language::System('form.validation.error.field.file.uploadError1')->write('Размер файла <b>`%file%`</b> превысил максимальный размер конфигурации сервера');
Language::System('form.validation.error.field.file.uploadError2')->write('Размер файла <b>`%file%`</b> превысил максимальный размер конфигурации формы загрузки');
Language::System('form.validation.error.field.file.uploadError3')->write('Файл <b>`%file%`</b> был загружен только частично');
Language::System('form.validation.error.field.file.uploadError4')->write('Файл <b>`%file%`</b> не был загружен. Это поле обязательное.');
Language::System('form.validation.error.field.file.uploadError5')->write('Неизвестная ошибка при загрузке файла <b>`%file%`</b> на сервер');
Language::System('form.validation.error.field.file.uploadError6')->write('Временная папка для загрузки файла <b>`%file%`</b> не установлена');
Language::System('form.validation.error.field.file.uploadError7')->write('Ошибка записи файла <b>`%file%`</b> на диск');
Language::System('form.validation.error.field.file.uploadError8')->write('Сервер прервал загрузку файла <b>`%file%`</b>');

Language::System('form.validation.error.attribute.required')->write('Поле обязательно для заполнения');
Language::System('form.validation.error.attribute.maxlength')->write('Значение больше допустимого. Максимальное значение поля - "%len%" символов');
Language::System('form.validation.error.attribute.minlength')->write('Значение меньше необходимого. Минимальное значение поля - "%len%" символов');

Language::System('form.validation.error.filter.bool')->write('Значение не является булевым (0-1 / TRUE-FALSE)');
Language::System('form.validation.error.filter.domain')->write('Значение не является корректным доменом');
Language::System('form.validation.error.filter.email')->write('Значение не является корректным e-mail адресом');
Language::System('form.validation.error.filter.float')->write('Значение не является корректным числом с плавающей точкой');
Language::System('form.validation.error.filter.int')->write('Значение не является корректным целым числом');
Language::System('form.validation.error.filter.ip')->write('Значение не является корректным IP-адресом');
Language::System('form.validation.error.filter.mac')->write('Значение не является корректным MAC-адресом');
Language::System('form.validation.error.filter.url')->write('Значение не является корректным URL-адресом');

Language::System('form.field.captcha.label.captchaLabel')->write('Докажите, что Вы не робот!');
Language::System('form.field.captcha.label.captchaDescription')->write('<div class="before">Введите символы с картинки в поле напротив</div><div class="after">Если текст плохо видно - кликните на изображение или ссылку "обновить CAPTCHA"</div>');
Language::System('form.field.captcha.link.updateValue')->write('обновить CAPTCHA');

Language::System('console.error.countRequiredParamsNotEqual')->write(' Количество обязательных аргументов для команды `%COMMAND%` не совпало с количеством введенных ');
Language::System('console.error.commandNotFound')->write('     Команда `%COMMAND%` не найдена     ');

Language::System('error.unknownDriverClass')->write('Класс драйвера `%driver%` не существует');
Language::System('error.error_code')->write('неизвестная ошибка #%error_code%');
Language::System('error.error_code_')->write('неизвестная ошибка');
Language::System('error.error_code_0')->write('неизвестная ошибка');
Language::System('error.error_code_1')->write('критическая ошибка');
Language::System('error.error_code_2')->write('предупреждение');
Language::System('error.error_code_4')->write('синтаксическая ошибка');
Language::System('error.error_code_8')->write('уведомление');
Language::System('error.error_code_16')->write('ошибка уровня ядра');
Language::System('error.error_code_32')->write('предупреждение ядра');
Language::System('error.error_code_64')->write('ошибка компиляции');
Language::System('error.error_code_128')->write('предупреждение компиляции');
Language::System('error.error_code_256')->write('пользовательская ошибка');
Language::System('error.error_code_512')->write('пользовательское предупреждение');
Language::System('error.error_code_1024')->write('пользовательское уведомление');
Language::System('error.error_code_2048')->write('требование');
Language::System('error.error_code_4096')->write('восстановляемая ошибка');
Language::System('error.error_code_8192')->write('отклонение');
Language::System('error.error_code_16384')->write('пользовательское отклонение');
Language::System('error.error_code_32767')->write('неизвестная ошибка #%error_code%');
Language::System('error.error_code_db1000')->write('база данных: ошибка соединения');
Language::System('error.error_code_db1001')->write('база данных: ошибка запроса');

Language::System('error.page.400.head')->write('<p>Плохой запрос!</p>');
Language::System('error.page.400.body')->write('<p>Параметры запроса не соответствуют стандартам ресурса!</p>');
Language::System('error.page.401.head')->write('<p>Не авторизовано!</p>');
Language::System('error.page.401.body')->write('<p>Для доступа к странице требуется авторизация!</p>');
Language::System('error.page.403.head')->write('<p>Доступ запрещен!</p>');
Language::System('error.page.403.body')->write('<p>У Вас не хватает прав для доступа к запрашиваемой странице!</p>');
Language::System('error.page.404.head')->write('<p>Страница не найдена!</p>');
Language::System('error.page.404.body')->write('<p>Запрашиваемая Вами страница не была найдена.</p><p>Возможно она временно перемещена, или отсутствует полностью.</p><p>Вернитесь на <a href="/">главную страницу</a> , или воспользуйтесь поиском!</p>');
Language::System('error.page.405.head')->write('<p>Метод запрещен!</p>');
Language::System('error.page.405.body')->write('<p>Метод HTTP-запроса "%Method%" не поддерживается этой страницей!</p>');
Language::System('error.page.418.head')->write('<p>Ой-ой-ой! Что-то пошло не так!</p>');
Language::System('error.page.418.body')->write('<p>Если вы админ сайта, проверьте целостность файловой структуры своего шаблона представления.</p><p>Скорей всего для этой страницы не существует физического файла шаблона.</p>');
Language::System('error.page.500.head')->write('<p>Внутренняя ошибка сервера!</p>');
Language::System('error.page.500.body')->write('<p>Произошла внутренняя ошибка сайта!</p><p>Перезагрузите страницу: если ошибка повторяется - зайдите позже!</p>');
Language::System('error.page.unknown.head')->write('<p>Неизвестная ошибка!</p>');
Language::System('error.page.unknown.body')->write('<p>Произошла неизвестная ошибка сайта! (КОД: № %code%)</p><p>Перезагрузите страницу: если ошибка повторяется - зайдите позже!</p>');

Language::System('wysiwyg.button.title.remove')->write('очистить');
Language::System('wysiwyg.button.title.editSource')->write('редактировать исходный код');
Language::System('wysiwyg.button.title.showBlocks')->write('показать блоки');
Language::System('wysiwyg.button.title.bold')->write('жирный');
Language::System('wysiwyg.button.title.italic')->write('курсив');
Language::System('wysiwyg.button.title.strike')->write('зачеркнутый');
Language::System('wysiwyg.button.title.underline')->write('подчеркнутый');
Language::System('wysiwyg.button.title.header')->write('заголовок');
Language::System('wysiwyg.button.title.header1')->write('<h1>заголовок</h1>');
Language::System('wysiwyg.button.title.header2')->write('<h2>заголовок</h2>');
Language::System('wysiwyg.button.title.header3')->write('<h3>заголовок</h3>');
Language::System('wysiwyg.button.title.header4')->write('<h4>заголовок</h4>');
Language::System('wysiwyg.button.title.header5')->write('<h5>заголовок</h5>');
Language::System('wysiwyg.button.title.header6')->write('<h6>заголовок</h6>');
Language::System('wysiwyg.button.title.quote')->write('цитата');
Language::System('wysiwyg.button.title.code')->write('блок кода');
Language::System('wysiwyg.button.title.link')->write('ссылка');
Language::System('wysiwyg.button.title.hyperlink')->write('гиперссылка');
Language::System('wysiwyg.button.title.hr')->write('линия');
Language::System('wysiwyg.button.title.table')->write('таблица');
Language::System('wysiwyg.button.title.align')->write('выровнять');
Language::System('wysiwyg.button.title.alignCenter')->write('по центру');
Language::System('wysiwyg.button.title.alignJustify')->write('заполнить');
Language::System('wysiwyg.button.title.alignLeft')->write('с левой стороны');
Language::System('wysiwyg.button.title.alignRight')->write('с правой стороны');
Language::System('wysiwyg.button.title.list')->write('список');
Language::System('wysiwyg.button.title.listRating')->write('рейтинговый список');
Language::System('wysiwyg.button.title.listCircled')->write('список с кольцами');
Language::System('wysiwyg.button.title.listPointer')->write('обычный список');
Language::System('wysiwyg.button.title.listCheckbox')->write('список с чекбоксами');
Language::System('wysiwyg.button.title.outlineList')->write('нумерованный список');
Language::System('wysiwyg.button.title.outlineListInteger')->write('числовой список');
Language::System('wysiwyg.button.title.outlineListLetter')->write('буквенный список');
Language::System('wysiwyg.button.title.outlineListRoman')->write('римский список');
Language::System('wysiwyg.button.title.audio')->write('песня');
Language::System('wysiwyg.button.title.image')->write('картинка');
Language::System('wysiwyg.button.title.video')->write('видео');
Language::System('wysiwyg.button.title.file')->write('файл');
Language::System('wysiwyg.button.title.fileManager')->write('из менеджера');
Language::System('wysiwyg.button.title.fileRemote')->write('по ссылке');
Language::System('wysiwyg.button.title.fileUpload')->write('загрузить');
Language::System('wysiwyg.button.title.fullScreen')->write('развернуть на весь экран');

Language::System('wysiwyg.default.value.audio')->write('песня');
Language::System('wysiwyg.default.value.image')->write('картинка');
Language::System('wysiwyg.default.value.video')->write('видео');
Language::System('input.title.placeholder')->write('текст ссылки (не обязательно)...');
Language::System('input.href.placeholder')->write('URL ссылки');

