<?php
class ComboCard2
{
    public static $state;
    public static function init() {
        self::$state = [];
        // self::$state = array_merge(self::$state, State1Service::getState());
        self::$state['ContactModel'] = StateContactService::getState();
        self::$state['counter'] = State2Service::getState();
    }
    public static function onNotif() {
        self::$state['ContactModel'] = StateContactService::getState();
        self::$state['counter'] = State2Service::getState();
    }
}
