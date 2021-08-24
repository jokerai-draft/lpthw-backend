<?php
class Hub3
{
    public static $state;

    public static function start() {
        Assembled3::init();
        Component2::init();

        self::handle();
        self::getState();

        self::launch();
    }

    public static function handle() {
        $method = Assembled3::$httpMessageHandler['REQUEST_METHOD'];
        $event  = Assembled3::$httpMessageHandler['POST']['event'] ?? null;
        if ($method === "GET") {
        }
        if ($method === "POST" && $event === "addContact") {
            $payload['name'] = Assembled3::$httpMessageHandler['POST']['name'];
            $payload['phone'] = Assembled3::$httpMessageHandler['POST']['phone'];
            $payload['email'] = Assembled3::$httpMessageHandler['POST']['email'];
            $payload = array_map(fn($item) => trim($item), $payload);
            State3Service::addContact($payload);
        }
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
