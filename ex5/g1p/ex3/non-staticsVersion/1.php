<?php

// test State2Service.php
require_once 'State2Service.php';

function test1() {
    $state = (new State2Service())->getState();
    var_dump($state);
}
function test2() {
    (new State2Service())->updateState(); // work once visit
    $state = (new State2Service())->getState();
    var_dump($state);
}
function test3() {
    (new State2Service())->updateState();
    $state = (new State2Service())->getState();
    var_dump($state);
}
function test4() {
    (new State2Service())->reset();

    (new State2Service())->updateState(); // work once visit
    $state = (new State2Service())->getState();
    var_dump($state);

    (new State2Service())->updateState(); // work once visit
    $state = (new State2Service())->getState();
    var_dump($state);

    (new State2Service())->updateState(); // work once visit
    $state = (new State2Service())->getState();
    var_dump($state);
}
test4();
