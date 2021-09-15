<?php

class Assembled
{
    public $httpMessageHandler;
    public $databag;
    public function __construct() {
        $this->databag = [];
        $this->httpMessageHandler = [];
        $this->httpMessageHandler['GET']  = array_map(fn($item) => Utils::escape($item), $_GET);
        $this->httpMessageHandler['POST'] = array_map(fn($item) => Utils::escape($item), $_POST);
        $this->httpMessageHandler['SESSION'] = array_map(fn($item) => Utils::escape($item), $_SESSION);
        $this->httpMessageHandler['URL'] = htmlspecialchars($_SERVER['PHP_SELF']);
        $this->httpMessageHandler['SERVER'] = $_SERVER;
        $this->httpMessageHandler['REQUEST_METHOD'] = $_SERVER['REQUEST_METHOD'];
        $this->httpMessageHandler['QUERY_STRING'] = $_SERVER['QUERY_STRING'] ?? "";
    }

    public function performIn($payload) {
        $this->databag['level1payload'] = $payload;
        $this->fillDatabag(); // process before render
        $this->process1();
    }
    public function performOut($view) {
        $map = ['databag' => $this->databag, 'httpMessageHandler' => $this->httpMessageHandler, ];
        return $this->view($view, $map);
    }

    protected function process1() {

    }
    protected function view($page, $databag = []) {
        extract($databag);
        require_once $page;
    }
    protected function fillDatabag() { // fillDatabag hooker
        $this->databag['age'] = 133;
    }

}
