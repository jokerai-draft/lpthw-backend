<?php
class AssembledLogin
{
    public static $httpMessageHandler;
    public static $databag;
    public static function init(){
        self::$databag = [];
        self::$httpMessageHandler = [];
        self::$httpMessageHandler['GET']  = array_map(fn($item) => Utils::escape($item), $_GET);
        self::$httpMessageHandler['POST'] = array_map(fn($item) => Utils::escape($item), $_POST);
        self::$httpMessageHandler['URL'] = htmlspecialchars($_SERVER['PHP_SELF']);
        self::$httpMessageHandler['SERVER'] = $_SERVER;
        self::$httpMessageHandler['REQUEST_METHOD'] = $_SERVER['REQUEST_METHOD'];
        self::$httpMessageHandler['QUERY_STRING'] = $_SERVER['QUERY_STRING'] ?? "";
    }

    public static function performIn($payload) {
        self::$databag['level1payload'] = $payload;
        self::fillDatabag(); // process before render
        self::process1();
    }
    public static function performOut() {
        $map = ['databag' => self::$databag, 'httpMessageHandler' => self::$httpMessageHandler, ];
        return self::view('view.login.php', $map);
    }

    protected static function process1() {
        // 这里可以做 redirect 到登入之前的页面
        if (isset(self::$databag['level1payload']['location'])) { } // 这个是 <未登入强制跳转: 从 "./document2.php" 跳转到 "./document.login.php?location=document2.php" > 获取的。详见跳转页的 hub
    }
    protected static function view($page, $databag = []) {
        extract($databag);
        require_once $page;
    }
    protected static function fillDatabag() { // fillDatabag hooker
        // self::$databag['age'] = 13;
    }

}
