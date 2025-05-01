<?php

use System\Core\Config;

Config::general('debug')->write(true);
Config::general('language')->write('ru');
Config::general('paginateLimit')->write(30);
Config::general('tmpDirectory')->write('../cli_tmp');       // difference with linux access rules
Config::general('tmpWebDirectory')->write('../web_tmp');    // difference with linux access rules

Config::database('defaultConnection')->write(DB_DEFAULT_CONNECTION);

Config::database(DB_DEFAULT_CONNECTION)->key('driver')->write(\System\Core\Database\Drivers\MySQLi::class);
Config::database(DB_DEFAULT_CONNECTION)->key('locale')->write(\System\Core\Database\Statics\Locales::ru_RU);
Config::database(DB_DEFAULT_CONNECTION)->key('charset')->write(\System\Core\Database\Statics\Collate::utf8mb4_unicode_520_ci()->getCharset());
Config::database(DB_DEFAULT_CONNECTION)->key('collate')->write(\System\Core\Database\Statics\Collate::utf8mb4_unicode_520_ci()->getCollate());
Config::database(DB_DEFAULT_CONNECTION)->key('engine')->write(\System\Core\Database\Statics\TableOptions::MYSQL_ENGINE_MY_ISAM);
Config::database(DB_DEFAULT_CONNECTION)->key('base')->write('[_DataBaseName_]');
Config::database(DB_DEFAULT_CONNECTION)->key('user')->write('[_DataBaseUser_]');
Config::database(DB_DEFAULT_CONNECTION)->key('pass')->write('[_DataBasePass_]');
Config::database(DB_DEFAULT_CONNECTION)->key('host')->write('[_DataBaseHost_]');
Config::database(DB_DEFAULT_CONNECTION)->key('port')->write('[_DataBasePort_]');
Config::database(DB_DEFAULT_CONNECTION)->key('databaseMode')->write(array(
    'STRICT_TRANS_TABLES',
    'NO_ZERO_IN_DATE',
    'NO_ZERO_DATE',
    'ERROR_FOR_DIVISION_BY_ZERO',
    'NO_ENGINE_SUBSTITUTION',
));

Config::template('defaultRenderClass')->write(\System\Core\Template\Render\HTML::class);
Config::template('siteName')->write('[_SiteName_]');
Config::template('siteTheme')->write('_BaseTheme_');
Config::template('siteIcon')->write('images/logo/favicon.png');
Config::template('siteLogo')->write('images/logo/micro.png');
Config::template('titleDelimiter')->write(' / ');
Config::template('publicDirectory')->write('[_WEB_]');
Config::template('uploadDirectory')->write('files');
Config::template('wysiwygTemplate')->write('wysiwygs/wysiwyg/default.html');
Config::template('compressHtml')->write(false);
Config::template('allowedRenders')->write(array(
    System\Core\Template\Render\XML::class,
    System\Core\Template\Render\HTML::class,
    System\Core\Template\Render\JSON::class,
    System\Core\Template\Render\PLAIN::class,
));

Config::session('sessionName')->write('SESID');
Config::session('sessionLifeTime')->write(86400*365);    // def: 1 year
Config::session('sessionDomain')->write('');

Config::security('secretKey')->write('[_SECRET_KEY_]');
Config::security('csrfTokenExpiryTime')->write(3600);

Config::security('captcha')->key('captchaClass')->write(\System\Core\Form\Captcha\Captcha3::class);
Config::security('captcha')->key('captchaLength')->write(array(5, 6));
Config::security('captcha')->key('captchaFontSize')->write(50);
Config::security('captcha')->key('captchaGenerationDelay')->write(0);
Config::security('captcha')->key('captchaCharsArray')->write(range('a', 'z'));
Config::security('captcha')->key('captchaImageQuality')->write(50);

Config::cache('driver')->write(\System\Core\Cache\Drivers\PHP::class);

Config::cache(\System\Core\Cache\Drivers\PHP::class)->key('enabled')->write(true);
Config::cache(\System\Core\Cache\Drivers\PHP::class)->key('directory')->write('cache');
Config::cache(\System\Core\Cache\Drivers\PHP::class)->key('writeEmptyResult')->write(true);
Config::cache(\System\Core\Cache\Drivers\PHP::class)->key('expiryTime')->write(0);   // 300 = 10 minutes | 0 - disable

Config::cache(\System\Core\Cache\Drivers\JSON::class)->key('enabled')->write(true);
Config::cache(\System\Core\Cache\Drivers\JSON::class)->key('directory')->write('cache');
Config::cache(\System\Core\Cache\Drivers\JSON::class)->key('writeEmptyResult')->write(true);
Config::cache(\System\Core\Cache\Drivers\JSON::class)->key('expiryTime')->write(0);   // 300 = 10 minutes | 0 - disable
