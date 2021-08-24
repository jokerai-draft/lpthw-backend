<?php
class SessionedComponent
{
    public static $state;
    public static function init() {
        self::$state = [];
        self::$state = array_merge(self::$state, SessionedStateService::getState());
    }
    public static function onNotif() {
        self::$state = array_merge(self::$state, SessionedStateService::getState());
    }
}
