<?php
class Component1
{
    public static $state;
    public static function init() {
        self::$state = [];
    }
    public static function onNotif() {
        self::$state = State1Service::getState();
    }
}
