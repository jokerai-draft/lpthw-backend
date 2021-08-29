<?php

// test State1Service.php
require_once 'State1Service.php';

function test1() {
    $state = (new State1Service())->getState();
    var_dump($state);
}
function test2() {
    (new State1Service())->updateState();
    $state = (new State1Service())->getState();
    var_dump($state);
}
function test3() {
    (new State1Service())->updateState();
    $state = (new State1Service())->getState();
    var_dump($state);
}
function test4() {
    (new State1Service())->reset();
    $state = (new State1Service())->getState();
    var_dump($state);

    (new State1Service())->updateState();
    $state = (new State1Service())->getState();
    var_dump($state);

    (new State1Service())->updateState();
    $state = (new State1Service())->getState();
    var_dump($state);
}
test4();
