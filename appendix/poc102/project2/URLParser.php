<?php
// 参考 ex5/g1/detection1/URLParser.php
/*
$route1 = ['method' => 'GET',  'action' => 'index', 'callback' => 'index', 'controller' => 'ContactController'];
$route2 = ['method' => 'GET',  'action' => 'show', 'callback' => 'show', 'params' => 'id', 'controller' => 'ContactController'];
$route3 = ['method' => 'GET',  'action' => 'edit', 'callback' => 'edit', 'params' => 'id', 'controller' => 'ContactController'];
$route4 = ['method' => 'POST', 'action' => 'update', 'callback' => 'update', 'params' => 'id', 'controller' => 'ContactController'];
$route5 = ['method' => 'GET',  'action' => 'create', 'callback' => 'create', 'controller' => 'ContactController'];
$route6 = ['method' => 'POST', 'action' => 'store', 'callback' => 'store', 'controller' => 'ContactController'];
$route7 = ['method' => 'POST', 'action' => 'destroy', 'callback' => 'destroy', 'params' => 'id', 'controller' => 'ContactController'];
$routeGroup2 = [$route1, $route2, $route3, $route4, $route5, $route6, $route7];
*/

// $route1 = ['method' => 'GET', 'action' => 'default', 'callback' => 'default', 'controller' => 'PageController'];
// $routeGroup1 = [$route1, ];


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
        $id = $this->httpMessageHandler['GET']['id'] ?? $this->httpMessageHandler['POST']['id'] ?? "-1";
        $controller = $this->httpMessageHandler['GET']['controller'] ?? $this->httpMessageHandler['POST']['controller'] ?? "PageController";

        if (true) {
            $route1 = ['method' => 'GET', 'action' => 'default', 'callback' => 'default', 'controller' => 'PageController'];
            $routeGroup1 = [$route1];

            $route1 = ['method' => 'GET',  'action' => 'index', 'callback' => 'index', 'controller' => 'ContactController'];
            $route2 = ['method' => 'GET',  'action' => 'show', 'callback' => 'show', 'params' => 'id', 'controller' => 'ContactController'];
            $route3 = ['method' => 'GET',  'action' => 'edit', 'callback' => 'edit', 'params' => 'id', 'controller' => 'ContactController'];
            $route4 = ['method' => 'POST', 'action' => 'update', 'callback' => 'update', 'params' => 'id', 'controller' => 'ContactController'];
            $route5 = ['method' => 'GET',  'action' => 'create', 'callback' => 'create', 'controller' => 'ContactController'];
            $route6 = ['method' => 'POST', 'action' => 'store', 'callback' => 'store', 'controller' => 'ContactController'];
            $route7 = ['method' => 'POST', 'action' => 'destroy', 'callback' => 'destroy', 'params' => 'id', 'controller' => 'ContactController'];
            $routeGroup2 = [$route1, $route2, $route3, $route4, $route5, $route6, $route7];

            $routes = array_merge($routeGroup1, $routeGroup2);
            foreach ($routes as $v) {
                if ($v['action'] === $action && $v['method'] === $method && $v['controller'] === $controller) {
                    $className = $v['controller'];
                    $controllerInstance = new $className();
                    if (!isset($v['params'])) {
                        call_user_func([$controllerInstance, $v['callback']]);
                    } else {
                        call_user_func([$controllerInstance, $v['callback']], ${$v['params']});
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
