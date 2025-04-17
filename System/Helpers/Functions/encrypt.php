<?php

namespace encrypt;

use System\Core\Config;

function csrf($value)
{
    $configKey = Config::security('secretKey')->read();
    return md5(sha1(md5($value . sha1($configKey)) . md5($configKey . sha1($value))));
}