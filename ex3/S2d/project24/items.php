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

        $method = self::$httpMessageHandler['REQUEST_METHOD'];
        $action = self::$httpMessageHandler['GET']['action'] ?? self::$httpMessageHandler['POST']['action'] ?? null;
        $id = self::$httpMessageHandler['GET']['id'] ?? self::$httpMessageHandler['POST']['id'] ?? null;
        $event = self::$httpMessageHandler['POST']['event'] ?? null;

        $payload = [];
        self::$databag['level1payload'] = $payload;

        $controller = new ItemController(self::$httpMessageHandler, self::$databag);
        if ($method === "GET" && $action === "index") {
            $controller->index();
        }
        if ($method === "GET" && $action === "show" && is_null($event)) {
            $id = (int)self::$httpMessageHandler['GET']['id'] ?? -1;
            $controller->show($id);
        }
        if ($method === "GET" && $action === "create" && $event === "store") {
            $controller->create();
        }
        if ($method === "GET" && $action === "edit" && $event === "update") {
            $controller->edit();
        }
        if ($method === "GET" && $action === "show" && $event === "destroy") {
            $controller->destroy();
        }
    }
}

// http://localhost:8000/items.php?action=index
