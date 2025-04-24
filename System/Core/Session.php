<?php

namespace System\Core;

use System\Helpers\Classes\Fs;
use System\Helpers\Classes\ArrayManager;

use function strings\generate;
use function filesystem\makeDirectory;

/**
 * Class Session
 * @package System\Core
 * @method static|ArrayManager user($key = null)
 * @method static|ArrayManager system($key = null)
 * @method static|ArrayManager config($key = null)
 * @method static|ArrayManager message($key = null)
 */
class Session
{
    const USER_GROUPS_KEY = 'userAccessGroupsList';

    const USER_GROUP_GUEST = 0,
        USER_GROUP_USER = 1,
        USER_GROUP_EDITOR = 2,
        USER_GROUP_MODER = 3,
        USER_GROUP_ADMIN = 4;

    protected $sessionId;

    protected $newUserStatus = false;

    public static function __callStatic($key, $arguments)
    {
        $arrayManager = new ArrayManager($key, $_SESSION[$key]);
        if(isset($arguments[0])){
            return $arrayManager->key($arguments[0]);
        }
        return $arrayManager;
    }

    public function __call($key, $arguments)
    {
        return self::__callStatic($key, $arguments);
    }

    public static function getSessions()
    {
        return $_SESSION;
    }

    public static function getSession($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function __construct()
    {
    }

    public function setSessionId()
    {
        $sessionName = Config::session('sessionName')->read();
        if(!($this->sessionId = Request::cookies($sessionName)->string()->htmlspecialchars())){
            $this->newUserStatus = true;
            $this->sessionId = generate(32);
        }
        return $this;
    }

    public function initialize()
    {
        $sessionDirectory = Fs::server()->temp("_session");
        makeDirectory($sessionDirectory);

        ini_set('session.gc_maxlifetime', Config::session('sessionLifeTime')->read());
        ini_set('session.cookie_lifetime', Config::session('sessionLifeTime')->read());
        ini_set('session.cookie_domain', Config::session('sessionDomain')->read());

        session_name(Config::session('sessionName')->read());

        session_save_path($sessionDirectory);

        session_id($this->sessionId);

        session_start();

        return $this;
    }

    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function getNewUserStatus()
    {
        return $this->newUserStatus;
    }
}