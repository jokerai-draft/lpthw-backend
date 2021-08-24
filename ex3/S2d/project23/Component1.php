<?php
class Component1
{
    public static $state;
    public static function init() {
        self::$state = [];
        // self::$state = array_merge(self::$state, State1Service::getState());
        self::$state[0] = State1Service::getState();
        self::$state[1] = State2Service::getState();
    }
    public static function onNotif() {
        self::$state[0] = State1Service::getState();
        self::$state[1] = State2Service::getState();
    }
}
