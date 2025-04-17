<?php

namespace System\Core;

class Access
{
    protected $granted;
    protected $denied;

    protected static $currentRouter = array();

    protected static $currentUserGroups = array();

    public static function setCurrentRouter(array $currentRouter)
    {
        self::$currentRouter = $currentRouter;
        return true;
    }

    public static function setCurrentUserGroups(array $currentUserGroups)
    {
        self::$currentUserGroups = $currentUserGroups;
        return true;
    }

    public function __construct()
    {}

    public function checkGroupsAccessGranted($allowedGroups)
    {
        foreach($allowedGroups as $allowedGroup){
            if(in_array($allowedGroup, self::$currentUserGroups)){
                $this->granted = true;
                $this->denied = false;
            }
        }
        return $this;
    }

    public function checkGroupsAccessDenied($allowedGroups)
    {
        foreach($allowedGroups as $allowedGroup){
            if(in_array($allowedGroup, self::$currentUserGroups)){
                $this->granted = false;
                $this->denied = true;
            }
        }
        return $this;
    }

    public function setDefaultAccessValues($granted, $denied)
    {
        $this->granted = $granted;
        $this->denied = $denied;
        return $this;
    }

    public function granted()
    {
        return $this->granted;
    }

    public function denied()
    {
        return $this->denied;
    }
}