<?php declare(strict_types=1);

require 'autoload.php';
session_start();

Eh1::handle();

class Eh1
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

    public static function handle() {
        self::init();

        self::$databag['level1payload'] = [];
        $payload1 = self::$httpMessageHandler;
        $payload2 = self::$databag;
        $controller = new PageControllerX($payload1, $payload2);
        if (true) {
            $controller->start();
        }
    }
}
