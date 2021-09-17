<?php

class ContactController
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

    public function index() {
        // middleware
        $this->authMiddleware();

        $this->state['contacts'] = (new ContactRepository())->getAll();

        $assmebled = new Assembled();
        $assmebled->performIn($this->state);
        $assmebled->performOut('view.contact.index.php');
    }

    public function show($id) {
        // middleware
        $this->authMiddleware();

        $this->state['contact'] = (new ContactRepository())->getById($id);

        $assmebled = new Assembled();
        $assmebled->performIn($this->state);
        $assmebled->performOut('view.contact.show.php');
    }

    public function edit($id) {
        // middleware
        $this->authMiddleware();

        $this->state['contact'] = (new ContactRepository())->getById($id);

        $assmebled = new Assembled();
        $assmebled->performIn($this->state);
        $assmebled->performOut('view.contact.edit.php');
    }

    public function create() {
        // middleware
        $this->authMiddleware();

        $this->state = [];

        $assmebled = new Assembled();
        $assmebled->performIn($this->state);
        $assmebled->performOut('view.contact.create.php');
    }
    // store, update, destroy
    public function store() {
        // middleware
        $this->authMiddleware();

        // handle ... 数据过滤
        $payload = ['name' => $this->httpMessageHandler['POST']['name'],
          'phone' => $this->httpMessageHandler['POST']['phone'],
          'email' => $this->httpMessageHandler['POST']['email'], ];
        $payload = array_map(fn($item) => trim($item), $payload);

        // handle
        $id = (new ContactRepository())->save($payload);

        // getState
        $this->state['contact']['id'] = $id;

        // 相当于 perform
        header("Location: ./index.php?theme=contacts&action=show&id={$this->state['contact']['id']}&controller=ContactController");
        exit();
    }

    public function update($id) {
        // middleware
        $this->authMiddleware();

        // handle ... 数据过滤
        $payload = ['name' => $this->httpMessageHandler['POST']['name'],
          'phone' => $this->httpMessageHandler['POST']['phone'],
          'email' => $this->httpMessageHandler['POST']['email'], ];
        $payload = array_map(fn($item) => trim($item), $payload);
        // $payload['id'] = $this->httpMessageHandler['POST']['id'];
        $payload['id'] = (int)$id;

        // handle
        (new ContactRepository())->update($payload); // should be true

        // getState
        $this->state['contact']['id'] = $id;

        // 相当于 perform
        header("Location: ./index.php?theme=contacts&action=show&id={$this->state['contact']['id']}&controller=ContactController");
        exit();
    }

    public function destroy($id) {
        // middleware
        $this->authMiddleware();

        // handle ... 数据过滤
        $payload = (int)$id;

        // handle
        (new ContactRepository())->delete($payload); // should be true

        // 相当于 perform
        header("Location: ./index.php?theme=contacts&action=index&controller=ContactController");
        exit();
    }

    private function authMiddleware() {
        $this->state['credential'] = (new SessionedStateService())->getState();

        if ($this->state['credential']['isLoggedIn'] === false) {
            header("Location: ./index.php?action=login&controller=SessionController");
            exit();
        }
    }
}
