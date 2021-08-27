<?php

// [hub1, hub2, hub3, ]
class PageController
{
    public function __construct() {
    }

    // Hub
    // ex3/S2d/project13/Hub1.php
    public function start1() {
        $this->handle();
        $this->state = $this->getState();
        $this->launch($this->state);
    }
    private function handle() {
        State1Service::updateState(); // db or save to file, effect
        State2Service::updateState();
    }
    private function getState() {
        ComboCard1::init();
        ComboCard1::onNotif();
        return ComboCard1::$state;
    }
    private function launch($payload) {
        $level1payload = [];
        $level1payload = $payload;
        Assembled1::init();
        Assembled1::performIn($level1payload);
        Assembled1::performOut();
    }

    // Hub
    public function start2() {
        echo "to be done ...";
    }
}
