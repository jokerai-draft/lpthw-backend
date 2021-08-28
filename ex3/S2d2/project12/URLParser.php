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
    public function subroute() {

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
            $controller = new ContactController();
            if ($method === "GET" && $action === "index") {
                $controller->index();
                exit();
            }
            if ($method === "GET" && $action === "show") {
                $controller->show($id);
                exit();
            }
            if ($method === "GET" && $action === "edit") {
                $controller->edit($id);
                exit();
            }


            // todo - done
            if ($method === "POST" && $action === "update") {
                $controller->update($id);
                exit();
            }
            if ($method === "GET" && $action === "create") {
                $controller->create();
                exit();
            }
            if ($method === "POST" && $action === "store") {
                $controller->store();
                exit();
            }

            // todo - done
            if ($method === "POST" && $action === "destroy") {
                $controller->destroy($id);
                exit();
            }
        }
    }
}
