<?php

use Controllers\_BaseController_\Console;

use Controllers\_BaseController_\Console\MakeCommand;
use Controllers\_BaseController_\Console\HelpCommand;
use Controllers\_BaseController_\Console\CronCommand;
use Controllers\_BaseController_\Console\TestCommand;
use Controllers\_BaseController_\Console\TestsCommand;
use Controllers\_BaseController_\Console\ServerCommand;
use Controllers\_BaseController_\Console\LanguageCommand;
use Controllers\_BaseController_\Console\DatabaseCommand;
use Controllers\_BaseController_\Console\MigrationCommand;

Console::_BaseController_('dialog:test')->action(TestsCommand::class, 'test')->faq('_BaseController_.console.tests.test1');
Console::_BaseController_('dialog:test2')->action(TestsCommand::class, 'test2')->faq('_BaseController_.console.tests.test2');
Console::_BaseController_('dialog:test3')->action(TestsCommand::class, 'test3')->faq('_BaseController_.console.tests.test3');

Console::_BaseController_('help')->action(HelpCommand::class)->faq('_BaseController_.console.help.cmd.descriptionCommon');
Console::_BaseController_('help [command prefix]')->action(HelpCommand::class)->faq('_BaseController_.console.help.cmd.descriptionCategory');

Console::_BaseController_('make:controller [controller]')->action(MakeCommand::class, 'controller')->faq('_BaseController_.console.make.controller.description');
Console::_BaseController_('make:action [controller] [action]')->action(MakeCommand::class, 'action')->faq('_BaseController_.console.make.action.description');
Console::_BaseController_('make:command [controller] [action]')->action(MakeCommand::class, 'consoleCommand')->faq('_BaseController_.console.make.cmd.description');
Console::_BaseController_('make:cron [controller] [action]')->action(MakeCommand::class, 'cron')->faq('_BaseController_.console.make.cron.description');
Console::_BaseController_('make:event [controller] [action]')->action(MakeCommand::class, 'event')->faq('_BaseController_.console.make.event.description');
Console::_BaseController_('make:form [controller] [action]')->action(MakeCommand::class, 'form')->faq('_BaseController_.console.make.form.description');
Console::_BaseController_('make:model [controller] [action]')->action(MakeCommand::class, 'model')->faq('_BaseController_.console.make.model.description');
Console::_BaseController_('make:test [controller] [action]')->action(MakeCommand::class, 'test')->faq('_BaseController_.console.make.test.description');
Console::_BaseController_('make:widget [controller] [action]')->action(MakeCommand::class, 'widget')->faq('_BaseController_.console.make.widget.description');
Console::_BaseController_('make:theme [theme]')->action(MakeCommand::class, 'theme')->faq('_BaseController_.console.make.theme.description');

Console::_BaseController_('cron:help')->action(CronCommand::class, 'help')->faq('_BaseController_.console.cron.help');
Console::_BaseController_('cron:run')->action(CronCommand::class, 'execute')->faq('_BaseController_.console.cron.runAllTasks');
Console::_BaseController_('cron:run [task key]')->action(CronCommand::class, 'runCommand')->faq('_BaseController_.console.cron.runSimpleTask');

Console::_BaseController_('db:create [database]')->action(DatabaseCommand::class, 'createDatabase')->faq('_BaseController_.console.database.create');
Console::_BaseController_('db:delete [database]')->action(DatabaseCommand::class, 'dropDatabase')->faq('_BaseController_.console.database.delete');
Console::_BaseController_('db:rename [database] [new database name]')->action(DatabaseCommand::class, 'renameDatabase')->faq('_BaseController_.console.database.rename');

Console::_BaseController_('table:make [database] [table]')->action(DatabaseCommand::class, 'createTable')->faq('_BaseController_.console.database.table.create');
Console::_BaseController_('table:drop [database] [table]')->action(DatabaseCommand::class, 'dropTable')->faq('_BaseController_.console.database.table.drop');
Console::_BaseController_('table:truncate [database] [table]')->action(DatabaseCommand::class, 'truncateTable')->faq('_BaseController_.console.database.table.truncate');
Console::_BaseController_('table:optimize [database] [table]')->action(DatabaseCommand::class, 'optimizeTable')->faq('_BaseController_.console.database.table.optimize');
Console::_BaseController_('table:rename [database] [table] [new table name]')->action(DatabaseCommand::class, 'renameTable')->faq('_BaseController_.console.database.table.rename');

Console::_BaseController_('migrate:alter [table]')->action(MigrationCommand::class, 'alterTable')->faq('_BaseController_.console.migration.alter');
Console::_BaseController_('migrate:create [table]')->action(MigrationCommand::class, 'createTable')->faq('_BaseController_.console.migration.table');
Console::_BaseController_('migrate:fill [table]')->action(MigrationCommand::class, 'createFilling')->faq('_BaseController_.console.migration.fill');
Console::_BaseController_('migrate:run')->action(MigrationCommand::class, 'migrate')->faq('_BaseController_.console.migration.run');
Console::_BaseController_('migrate:run:fill')->action(MigrationCommand::class, 'filling')->faq('_BaseController_.console.migration.runFill');

Console::_BaseController_('lang:add [iso code]')->action(LanguageCommand::class, 'execute')->faq('_BaseController_.console.language.addLanguagePack');
Console::_BaseController_('lang:add [controller] [iso code]')->action(LanguageCommand::class, 'createLangFile')->faq('_BaseController_.console.language.addLanguagePack');

Console::_BaseController_('test:run')->action(TestCommand::class, 'runAll')->faq('_BaseController_.console.tests.runAll');
Console::_BaseController_('test:run [controller]')->action(TestCommand::class, 'runController')->faq('_BaseController_.console.tests.runController');
Console::_BaseController_('test:run [controller] [className]')->action(TestCommand::class, 'runControllerAction')->faq('_BaseController_.console.tests.runControllerClass');
Console::_BaseController_('test:run [controller] [className] [method]')->action(TestCommand::class, 'executeMethod')->faq('_BaseController_.console.tests.runControllerClassMethod');

Console::_BaseController_('server:run [host = 127.0.0.1 : port = 8080]')->action(ServerCommand::class, 'runServer')
    ->pattern('#^server:run(\s+[\w\.]+)?(\:\d+)?$#usm')->faq('_BaseController_.console.server.runServer');
