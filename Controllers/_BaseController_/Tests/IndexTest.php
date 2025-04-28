<?php

namespace Controllers\_BaseController_\Tests;

use System\Core\Database;
use System\Helpers\Classes\Hash;
use System\Helpers\Classes\HashHmac;
use Controllers\_BaseController_\Config;

use function console\paint;
use function strings\generate;

class IndexTest
{
    /** @var bool|Database\Driver */
    protected $connection;
    /** @var Database\Db */
    protected $database;

    public function __construct()
    {
        $this->connection = Database::connect();
        $this->database = $this->connection->database();
    }

    public function execute()
    {
        return true;
    }

    public function testHashClass()
    {
        $string = generate(16);

        print PHP_EOL;
        foreach(hash_algos() as $algo){
            $algo_ = preg_replace("#[^\w]#usim", '_', $algo);

            $timer = microtime(true);
            $result = call_user_func_array(array(Hash::class, $algo_), array($string));

            $this->printResult($string, $algo, $result, $timer);
        }
        return $this;
    }

    public function testHashHmacClass()
    {
        $string = generate(16);
        $secret = Config::security('secretKey')->read();

        print PHP_EOL;
        foreach(hash_hmac_algos() as $algo){
            $algo_ = preg_replace("#[^\w]#usim", '_', $algo);

            $timer = microtime(true);
            $result = call_user_func_array(array(HashHmac::class, $algo_), array($string, $secret));

            $this->printResult($string, $algo, $result, $timer);
        }
        return $this;
    }

    protected function printResult($string, $algo, $result, $timer)
    {
        $tab = str_repeat(' ', 15-mb_strlen($algo));
        $timer = number_format(microtime(true) - $timer, 10, '.', ' ');

        paint("{$string}")->colorYellow()->result()->print(' ');
        paint("({$algo}):")->fon()->result()->print($tab);
        paint(" {$result} ")->colorWhite()->fonBlue()->print(' ');
        paint("({$timer} s)")->colorWhite()->fonGreen()->print();
    }
}