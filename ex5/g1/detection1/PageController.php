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
        (new State1Service())->updateState(); // db or save to file, effect
        (new State2Service())->updateState();
    }
    private function getState() {
        // $comboCard1 = new ComboCard1();
        // $comboCard1->onNotif();
        // return $comboCard1->getState();
        return (new ComboCard1())->onNotif()->getState();
    }
    private function launch($payload) {
        $level1payload = [];
        $level1payload = $payload;
        $assmebled = new Assembled();
        $assmebled->performIn($level1payload);
        $assmebled->performOut('view1.php');
    }

    // Hub
    public function start2() {
        echo "to be done ...";
    }
}
