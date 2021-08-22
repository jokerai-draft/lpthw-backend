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
    protected static function process1() {
        // if ($_SERVER['REQUEST_METHOD'] === "POST") {
        //     // echo "<pre>"; print_r($_POST); echo "</pre>";
        //     file_put_contents("storage", serialize(Utils::escape($_POST['locker'])));
        // }
        // $locker = unserialize(file_get_contents("storage")); // content, text, data, "locker" ; state, handler

        if (self::$httpMessageHandler['REQUEST_METHOD'] === "POST") {
            $lockers = [self::$httpMessageHandler['POST']['locker1'], self::$httpMessageHandler['POST']['locker2'], self::$httpMessageHandler['POST']['locker3'], ];  // 这里可以做成另一个 object 让它自己执行储存过程
            // $lockers = array_map(fn($item) => Utils::escape($item), $lockers); // done already
            $lockers = array_map(fn($item) => rtrim($item), $lockers);
            file_put_contents("storage", serialize($lockers));
        }
    }
    protected static function outboundProcess1() {
        // getLockers
        // also fill the databag
        $lockers = unserialize(file_get_contents("storage")); // content, text, data, "locker" ; state, handler
        self::$databag['locker1'] = $lockers[0] ?? "";
        self::$databag['locker2'] = $lockers[1] ?? "";
        self::$databag['locker3'] = $lockers[2] ?? "";
    }

}
