<?php

// ex3/S2d2/project12/URLParser.php
class URLParser
{
    private $url;
    private $httpMessageHandler;
    public function __construct() {
        $this->httpMessageHandler = [];
        $this->httpMessageHandler['GET']  = array_map(fn($item) => Utils::escape($item), $_GET);
        $this->httpMessageHandler['POST'] = array_map(fn($item) => Utils::escape($item), $_POST);
        $this->httpMessageHandler['SESSION'] = array_map(fn($item) => Utils::escape($item), $_SESSION);
        $this->httpMessageHandler['URL'] = htmlspecialchars($_SERVER['PHP_SELF']);
        $this->httpMessageHandler['SERVER'] = $_SERVER;
        $this->httpMessageHandler['REQUEST_METHOD'] = $_SERVER['REQUEST_METHOD'];
        $this->httpMessageHandler['QUERY_STRING'] = $_SERVER['QUERY_STRING'] ?? "";
    }
    public function route() {
        $method = $this->httpMessageHandler['REQUEST_METHOD'];
        $action = $this->httpMessageHandler['GET']['action'] ?? $this->httpMessageHandler['POST']['action'] ?? "default";
        if (true) {
            $route1 = ['method' => 'GET',  'action' => 'default', 'callback' => 'default'];
            $route2 = ['method' => 'POST', 'action' => 'store', 'callback' => 'storeCounter'];
            $route3 = ['method' => 'GET',  'action' => 'start1', 'callback' => 'start1'];
            $routes = [$route1, $route2, $route3, ];
            $controller = new PageController();
            foreach ($routes as $v) {
                if ($v['action'] === $action) {
                    if (!isset($v['params'])) {
                        call_user_func([$controller, $v['callback']]);
                    } else {
                        call_user_func([$controller, $v['callback']], ${$v['params']});
                    }
                }
            }
            unset($v);
            exit();
        }
    }
}

// http://localhost:8000/index.php?action=start1
// http://localhost:8000/index.php?action=start1&name=tom
