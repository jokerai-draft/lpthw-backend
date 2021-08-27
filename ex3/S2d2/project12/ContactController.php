<?php

// [hub1, hub2, hub3, ]
class ContactController
{
    public function __construct() {
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

    }
}
