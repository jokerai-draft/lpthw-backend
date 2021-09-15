<?php

class PageController
{
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

    public function start1() {
        $this->state['greetings'] = 'hello!!!';
        $this->state['luckyNumber'] = 42;

        $assmebled = new Assembled();
        $assmebled->performIn($this->state);
        $assmebled->performOut('view1.php');
    }

    public function default() {
        // getState
        $this->state = (new StateAService())->getState();
        // $this->state['counter'] = 12;
        // $this->state['step'] = 1;

        $assmebled = new Assembled();
        $assmebled->performIn($this->state);
        $assmebled->performOut('view2.php');
    }

    // public function storeCounter() {
    //     echo "<pre>";
    //     print_r($this->httpMessageHandler);
    //     echo "</pre>";
    // }
    public function storeCounter() {
        // handle ... 数据过滤
        $payload = [ 'step' => $this->httpMessageHandler['POST']['step'],
            'operation' => $this->httpMessageHandler['POST']['operation'], ];
        $payload = array_map(fn($item) => trim($item), $payload);

        // handle
        (new StateAService())->updateState($payload); // db or save to file, effect

        // 相当于 perform
        header("Location: ./index.php");
        exit();
    }

}
