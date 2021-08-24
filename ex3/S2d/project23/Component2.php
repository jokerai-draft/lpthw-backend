<?php
class Component2
{
    public static $state;
    public static function init() {
        self::$state = [];
        self::$state = array_merge(self::$state, State3Service::getState());
    }
    public static function onNotif() {
        self::$state = State3Service::getState();
    }
}
