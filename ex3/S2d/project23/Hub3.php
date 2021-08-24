<?php
class Hub3
{
    public static $state;

    public static function start() {
        Assembled3::init();

        self::getState();

        self::launch();
    }

    public static function getState() {
    }

    public static function launch() {
        $level1payload = [];
        $level1payload = self::$state;
        $level1payload['greetings'] = 'hohoho';
        Assembled3::performIn($level1payload);
        Assembled3::performOut();
    }
}
