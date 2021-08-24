<?php
class Component
{
    public static $state;
    public static function init() {
        self::$state = [];
        self::$state = array_merge(self::$state, StateService::getState());
    }
    public static function onNotif() {
        self::$state = StateService::getState();
    }
}
