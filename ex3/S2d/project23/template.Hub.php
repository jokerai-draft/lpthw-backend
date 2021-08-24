<?php
class Hub
{
    public state $state;

    public static function start() {
        AssembledX::init();

        self::getState();

        self::launch();
    }

    public static function getState() {
    }

    public static function launch() {
        $level1payload = [];
        $level1payload = self::$state;
        AssembledX::performIn($level1payload);
        AssembledX::performOut();
    }
}
