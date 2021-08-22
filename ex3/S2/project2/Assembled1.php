<?php
class Assembled1
{
    public static $httpMessageHandler;
    public static $databag;
    public static function init(){
        self::$databag = [];
        self::$httpMessageHandler = [];
        self::$httpMessageHandler['GET']  = array_map(fn($item) => Utils::escape($item), $_GET);
        // self::$httpMessageHandler['GET']  = $_GET;
        self::$httpMessageHandler['POST'] = array_map(fn($item) => Utils::escape($item), $_POST);
        self::$httpMessageHandler['URL']  = htmlspecialchars($_SERVER['PHP_SELF']);
    }

    public static function perform() {
        self::fillDatabag(); // process before render
        $map = ['databag' => self::$databag, 'httpMessageHandler' => self::$httpMessageHandler, ];
        return self::view('view1.php', $map);
    }

    protected static function view($page, $databag = []) {
        extract($databag);
        require_once $page;
    }
    protected static function fillDatabag() { // fillDatabag hooker
        // self::$databag['age'] = 13;
    }

}
