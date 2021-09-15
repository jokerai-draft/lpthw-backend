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

    public function default() {
        $this->state['credential'] = (new SessionedStateService())->getState();

        $assmebled = new Assembled();
        $assmebled->performIn($this->state);
        $assmebled->performOut('view.default.php');
    }

    public function timechecker1() {
        $this->state['credential'] = (new SessionedStateService())->getState();

        $assmebled = new Assembled();
        $assmebled->performIn($this->state);
        $assmebled->performOut('view.timechecker1.php');
    }
    public function timechecker2() {
        $this->state['credential'] = (new SessionedStateService())->getState();

        if ($this->state['credential']['isLoggedIn'] === false) {
            header("Location: ./index.php?action=login&location=timechecker2");
            exit();
        } else {
            $assmebled = new Assembled();
            $assmebled->performIn($this->state);
            $assmebled->performOut('view.timechecker2.php');
        }
    }

}
