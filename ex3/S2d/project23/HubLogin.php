<?php
class HubLogin
{
    public static $state;

    public static function start() {
        AssembledLogin::init();
        SessionedComponent::init();

        // self::loginCheckAndRedirect();

        self::handle();
        self::getState();

        self::launch();
        // self::perform();

    }

    public static function loginCheckAndRedirect() {
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
        $method = AssembledLogin::$httpMessageHandler['REQUEST_METHOD'];

        // 预处理
        if ($method === "GET") {
        }

        $submit = AssembledLogin::$httpMessageHandler['POST']['submit'];
        if ($method === "POST" && $submit==="submit") {
            $payload['username'] = AssembledLogin::$httpMessageHandler['POST']['username'];
            $payload['password'] = AssembledLogin::$httpMessageHandler['POST']['password'];
            SessionedStateService::tryLogin($payload); // 要直接修改文件的 service 并不知道 state's component 的存在
        }
        if ($method === "POST" && $submit==="logout") {
            SessionedStateService::logout();
        }
    }
    public static function getState() {
        SessionedComponent::onNotif();
        self::$state = SessionedComponent::$state; // 关键值的获取(此两行)
    }

    // launch HTTP response building process to build the response
    public static function launch() {
        $level1payload = [];
        $level1payload = self::$state; // AssembledLogin 并不知道 state's component 的存在
        if (self::$state['isLoggedIn'] === true) { $level1payload['msg'] = 'login successfully'; }
        AssembledLogin::performIn($level1payload);
        AssembledLogin::performOut(); // 处理从 inbound 到 outbound
    }

    public static function perform() {
        if (self::$state['isLoggedIn'] === true) {
            // echo "<h4>logged in successfully</h4>";
            // echo "click to logout";
            // header("Location: ./document2.php");
            // exit();
            $level1payload = [];
            $level1payload = self::$state; // AssembledLogin 并不知道 state's component 的存在
            $level1payload['msg'] = 'login successfully';
            AssembledLogin::performIn($level1payload);
            AssembledLogin::performOut(); // 处理从 inbound 到 outbound
        }
        if (self::$state['isLoggedIn'] === false) {
            $level1payload = [];
            $level1payload = self::$state; // AssembledLogin 并不知道 state's component 的存在
            $level1payload['msg'] = 'invalid info please login again';
            AssembledLogin::performIn($level1payload);
            AssembledLogin::performOut(); // 处理从 inbound 到 outbound
        }
    }
    // 直接显示 you have logged in 或 you haven't logged in

}
