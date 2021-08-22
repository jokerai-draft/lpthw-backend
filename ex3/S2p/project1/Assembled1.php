<?php
class Assembled1
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

    public static function perform() {
        self::fillDatabag(); // process before render
        self::process1(); // handle it
        self::outboundProcess1();
        // $map = ['databag' => self::$databag, 'httpMessageHandler' => self::$httpMessageHandler, ];
        // return self::view('view1.php', $map);

        // render view1
        echo "<h4>" . SessionedComponent1::$age . "</h4>";
    }

    protected static function view($page, $databag = []) {
        extract($databag);
        require_once $page;
    }
    protected static function fillDatabag() { // fillDatabag hooker
        // self::$databag['age'] = 13;
    }
    protected static function process1() {
        // version1
        SessionedComponent1::$age = 12;
    }
    protected static function outboundProcess1() {
        // version1
        SessionedComponent1::$age = SessionedComponent1::$age - 2;
    }

}
