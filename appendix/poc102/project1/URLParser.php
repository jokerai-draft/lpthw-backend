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
            $route1 = ['controller' => 'PageController', 'method' => 'GET', 'action' => 'default', 'callback' => 'default'];
            $routeA = ['controller' => 'PageController', 'method' => 'GET', 'action' => 'timechecker1', 'callback' => 'timechecker1'];
            $routeB = ['controller' => 'PageController', 'method' => 'GET', 'action' => 'timechecker2', 'callback' => 'timechecker2'];
            $routeGroup1 = [$route1, $routeA, $routeB, ];

            $routeLogin = ['controller' => 'SessionController', 'method' => 'POST', 'action' => 'login', 'callback' => 'store'];
            $routeLogout = ['controller' => 'SessionController', 'method' => 'POST', 'action' => 'logout', 'callback' => 'destroy'];
            $routeLoginPage = ['controller' => 'SessionController', 'method' => 'GET', 'action' => 'login', 'callback' => 'create'];
            $routeGroup2 = [$routeLogin, $routeLogout, $routeLoginPage, ];

            $routes = array_merge($routeGroup1, $routeGroup2);
            foreach ($routes as $v) {
                $className = $v['controller'];
                $controller = new $className();
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

// http://localhost:8000/index.php?action=default
// http://localhost:8000/index.php?action=login
// http://localhost:8000/index.php?action=timechecker1
