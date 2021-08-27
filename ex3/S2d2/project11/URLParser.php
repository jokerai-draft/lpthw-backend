<?php

class URLParser
{
    private $url;
    private $httpMessageHandler;
    public function __construct() {
        $this->httpMessageHandler = [];
        $this->httpMessageHandler['GET']  = array_map(fn($item) => Utils::escape($item), $_GET);
        $this->httpMessageHandler['POST'] = array_map(fn($item) => Utils::escape($item), $_POST);
        $this->httpMessageHandler['URL'] = htmlspecialchars($_SERVER['PHP_SELF']);
        $this->httpMessageHandler['SERVER'] = $_SERVER;
        $this->httpMessageHandler['REQUEST_METHOD'] = $_SERVER['REQUEST_METHOD'];
        $this->httpMessageHandler['QUERY_STRING'] = $_SERVER['QUERY_STRING'] ?? "";
    }
    public function route() {
        $theme = $this->httpMessageHandler['GET']['theme'] ?? "";
        if ($theme === "contacts") {
            $this->subroute();
        }
        if (true) {
            $controller = new PageController();
            if (true) {
                $controller->start1();
                exit();
            }
        }
    }
    public function subroute() {

        // parse url like
        // localhost:8000/document1.php?action=show&id=2 参考 ex3/S2d/project24/items.php
        $method = $this->httpMessageHandler['REQUEST_METHOD'];
        $action = $this->httpMessageHandler['GET']['action'] ?? $this->httpMessageHandler['POST']['action'] ?? "index";
        $id = self::$httpMessageHandler['GET']['id'] ?? self::$httpMessageHandler['POST']['id'] ?? -1;
        $id = (int)$id;
        $event = self::$httpMessageHandler['POST']['event'] ?? null;

        if (true) {
            $controller = new PageController();
            $controller->start2();
            exit();
        }
        if (false) {
            $controller = new ContactController();
            if ($method === "GET" && $action === "index") {
                $controller->index();
                exit();
            }
        }
    }
}
