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
        $action = self::$httpMessageHandler['GET']['action'] ?? self::$httpMessageHandler['POST']['action'] ?? "index";
        $id = self::$httpMessageHandler['GET']['id'] ?? self::$httpMessageHandler['POST']['id'] ?? -1;
        $id = (int)$id;
        $event = self::$httpMessageHandler['POST']['event'] ?? null;

        self::$databag['level1payload'] = [];
        $payload1 = self::$httpMessageHandler;
        $payload2 = self::$databag;
        $controller = new ItemController($payload1, $payload2);
        if ($method === "GET" && $action === "index") {
            $controller->index();
        }
        if ($method === "GET" && $action === "show") {
            $controller->show($id);
        }
        if ($method === "GET" && $action === "create") {
            $controller->create();
        }
        if ($method === "GET" && $action === "edit") {
            $controller->edit($id);
        }
        if ($method === "POST" && $event === "destroy") {
            $controller->destroy($id);
        }
        if ($method === "POST" && $event === "store") {
            $controller->store();
        }
        if ($method === "POST" && $event === "update") {
            $controller->update($id);
        }
    }
}

/*
http://localhost:8000/items.php?action=index
http://localhost:8000/items.php?action=create
http://localhost:8000/items.php?action=edit&id=2

*/
