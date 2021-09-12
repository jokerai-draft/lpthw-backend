<?php

class PageController
{
    public function __construct() {
    }

    public function start1() {
        $this->state['greetings'] = 'hello!!!';
        $this->state['luckyNumber'] = 42;

        $assmebled = new Assembled();
        $assmebled->performIn($this->state);
        $assmebled->performOut('view1.php');
    }
}
