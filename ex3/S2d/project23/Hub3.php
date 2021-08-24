<?php
class Hub3
{
    public static $state;

    public static function start() {
        Assembled3::init();
        Component2::init();

        self::getState();

        self::launch();
    }

    public static function getState() {
        Component2::onNotif();
        self::$state['Component2'] = Component2::$state; // 关键值的获取(此两行)
    }

    public static function launch() {
        $level1payload = [];
        $level1payload = self::$state;
        Assembled3::performIn($level1payload);
        Assembled3::performOut();
    }
}
