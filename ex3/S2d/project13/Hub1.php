<?php
class Hub1
{
    public static $state;

    public static function start() {
        Assembled1::init();
        Component1::init();

        // self::loginCheck();

        self::handle();
        self::getState();

        self::launch();

    }

    public static function loginCheck() {
        // echo "login please";
        // exit();
        SessionedComponent::init();
        SessionedComponent::onNotif();
        if (SessionedComponent::$state['isLoggedIn'] !== true) {
            // StateSessionService::tryLogin(); // bypass
            // echo "please login";
            // better to redirct to "document.login.php/login.php" as it renders view('view.login.php'); // to trigger tryLogin()
            // exit();
            header("Location: ./document.login.php?location=document1.php");
            exit();
        }
        if (SessionedComponent::$state['isLoggedIn'] === true) {
            // StateSessionService::logout();
        }
    }

    // like an event handler
    // it could also happen as handling separately GET and POST request; in a POST request, it consumes state service directly and firstly (having the state prepared (according to the events) [heavy], before [light] the attempting to get the newest state)
    public static function handle() {
        State1Service::updateState();
        State2Service::updateState();
    }
    public static function getState() {
        Component1::onNotif();
        self::$state = Component1::$state; // 关键值的获取(此两行)
    }

    // launch HTTP response building process to build the response
    public static function launch() {
        $level1payload = [];
        $level1payload = self::$state; // Assembled1 并不知道 state's component 的存在
        Assembled1::performIn($level1payload);
        Assembled1::performOut(); // 处理从 inbound 到 outbound
    }

}
