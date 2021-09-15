<?php

class SessionController
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

    // public function store() {
    //     echo "<pre>";
    //     print_r($this->httpMessageHandler);
    //     echo "</pre>";
    // }
    public function store() {
        // handle ... 数据过滤
        $payload = [ 'username' => $this->httpMessageHandler['POST']['username'],
            'password' => $this->httpMessageHandler['POST']['password'], ];
        $payload = array_map(fn($item) => trim($item), $payload);

        // handle
        $isLoggedIn = (new SessionedStateService())->login($payload); // db or save to file, effect

        // 相当于 perform
        if ($isLoggedIn === true) {
            header("Location: ./index.php");
            exit();
        } else {
            header("Location: ./index.php?action=login");
            exit();
        }
    }
    public function destroy() {
        // handle
        (new SessionedStateService())->logout(); // db or save to file, effect

        // 相当于 perform
        header("Location: ./index.php");
        exit();
    }
    public function create() {
        $isAlreadyLoggedIn = (bool)$this->httpMessageHandler['SESSION']['isLoggedIn'] ?? false;
        if ($isAlreadyLoggedIn === true) {
            // 相当于 perform
            header("Location: ./index.php");
            exit();
        }
        if ($isAlreadyLoggedIn === false) {
            $this->state = [];

            $assmebled = new Assembled();
            $assmebled->performIn($this->state);
            $assmebled->performOut('view.session.create.php');
        }
    }

}
