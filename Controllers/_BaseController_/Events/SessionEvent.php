<?php

namespace Controllers\_BaseController_\Events;

use System\Core\Access;
use System\Core\Session;

class SessionEvent
{
    /** @var  Session */
    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function setDefaultUserGroup($userDefaultGroups = array(Session::USER_GROUP_GUEST))
    {
        if(!$this->session->user(Session::USER_GROUPS_KEY)->read()){
            $this->session->user(Session::USER_GROUPS_KEY)->write($userDefaultGroups);
        }
        Access::setCurrentUserGroups($this->session->user(Session::USER_GROUPS_KEY)->read());
        return $this;
    }
}