<?php

// [hub1, hub2, hub3, ]
class ContactController
{
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

    // Hub
    // ex3/S2d/project13/Hub1.php
    public function index() {
        $this->handle();
        $this->state = $this->getState();
        $this->launch($this->state);
    }
    private function handle() {
        StateContactService::updateState(); // db or save to file, effect
        State2Service::updateState();
    }
    private function getState() {
        ComboCard2::init();
        ComboCard2::onNotif();
        return ComboCard2::$state;
    }
    private function launch($payload) {
        $level1payload = [];
        $level1payload = $payload;
        Assembled::init();
        Assembled::performIn($level1payload);
        Assembled::performOut('view.contact.index.php');
    }

    // Hub
    public function show($id) {
        StateContactService::updateState(); // db or save to file, effect
        State2Service::updateState();

        $this->state['ContactModel'] = (new ContactRepository())->getContactById($id);
        $this->state['counter'] = State2Service::getState();

        Assembled::init();
        Assembled::performIn($this->state);
        Assembled::performOut('view.contact.show.php');
    }

    // Hub
    public function edit($id) {
        StateContactService::updateState(); // db or save to file, effect
        State2Service::updateState();

        $this->state['ContactModel'] = (new ContactRepository())->getContactById($id);
        $this->state['counter'] = State2Service::getState();

        Assembled::init();
        Assembled::performIn($this->state);
        Assembled::performOut('view.contact.edit.php');
    }

    public function update($id) {
        // handle ... 数据过滤
        $payload = ['name' => $this->httpMessageHandler['POST']['name'], 'phone' => $this->httpMessageHandler['POST']['phone'], 'email' => $this->httpMessageHandler['POST']['email'], ];
        $payload = array_map(fn($item) => trim($item), $payload);
        // $payload['id'] = $this->httpMessageHandler['POST']['id'];
        $payload['id'] = (int)$id;

        // handle
        StateContactService::updateState(); // db or save to file, effect
        State2Service::updateState();
        $contactRepository = new ContactRepository();
        $contactRepository->update($payload); // should be true

        // getState
        $this->state['ContactModel']['id'] = $id;
        $this->state['counter'] = State2Service::getState();

        // 相当于 perform
        header("Location: ./document1.php?theme=contacts&action=show&id={$this->state['ContactModel']['id']}");
        exit();
    }

    public function store() {
        // handle ... 数据过滤
        $payload = ['name' => $this->httpMessageHandler['POST']['name'], 'phone' => $this->httpMessageHandler['POST']['phone'], 'email' => $this->httpMessageHandler['POST']['email'], ];
        $payload = array_map(fn($item) => trim($item), $payload);

        // handle
        StateContactService::updateState(); // db or save to file, effect
        State2Service::updateState();
        $contactRepository = new ContactRepository();
        $id = $contactRepository->save($payload);

        // getState
        $this->state['ContactModel']['id'] = $id;
        $this->state['counter'] = State2Service::getState();

        // 相当于 perform
        header("Location: ./document1.php?theme=contacts&action=show&id={$this->state['ContactModel']['id']}");
        exit();
    }

    public function create() {
        StateContactService::updateState(); // db or save to file, effect
        State2Service::updateState();

        $this->state['ContactModel'] = [];
        $this->state['counter'] = State2Service::getState();

        Assembled::init();
        Assembled::performIn($this->state);
        Assembled::performOut('view.contact.create.php');
    }
}
