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
        $this->httpMessageHandler['URL'] = htmlspecialchars($_SERVER['PHP_SELF']);
        $this->httpMessageHandler['SERVER'] = $_SERVER;
        $this->httpMessageHandler['REQUEST_METHOD'] = $_SERVER['REQUEST_METHOD'];
        $this->httpMessageHandler['QUERY_STRING'] = $_SERVER['QUERY_STRING'] ?? "";
    }
    public function route() {
        $theme = $this->httpMessageHandler['GET']['theme'] ?? $this->httpMessageHandler['POST']['theme'] ?? "";
        if ($theme === "contacts") {
            $this->subroute();
            exit();
        }
        if (true) {
            $controller = new PageController();
            if (true) {
                $controller->start1();
                exit();
            }
        }
    }
    private function subroute() {

        // parse url like
        // localhost:8000/document1.php?theme=contacts
        // localhost:8000/document1.php?theme=contacts&action=show&id=2 参考 ex3/S2d/project24/items.php
        //
        $method = $this->httpMessageHandler['REQUEST_METHOD'];
        $action = $this->httpMessageHandler['GET']['action'] ?? $this->httpMessageHandler['POST']['action'] ?? "index";
        $id = $this->httpMessageHandler['GET']['id'] ?? $this->httpMessageHandler['POST']['id'] ?? "-1";

        if (false) {
            $controller = new PageController();
            $controller->start2();
            exit();
        }
        if (true) {
            $route1 = ['method' => 'GET',  'action' => 'index', 'callback' => 'index'];
            $route2 = ['method' => 'GET',  'action' => 'show', 'callback' => 'show', 'params' => 'id'];
            $route3 = ['method' => 'GET',  'action' => 'edit', 'callback' => 'edit', 'params' => 'id'];
            $route4 = ['method' => 'POST', 'action' => 'update', 'callback' => 'update', 'params' => 'id'];
            $route5 = ['method' => 'GET',  'action' => 'create', 'callback' => 'create'];
            $route6 = ['method' => 'POST', 'action' => 'store', 'callback' => 'store'];
            $route7 = ['method' => 'POST', 'action' => 'destroy', 'callback' => 'destroy', 'params' => 'id'];
            $routes = [$route1, $route2, $route3, $route4, $route5, $route6, $route7];
            $controller = new ContactController();
            foreach ($routes as $v) {
                if ($v['action'] === $action && $v['method'] === $method) {
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
