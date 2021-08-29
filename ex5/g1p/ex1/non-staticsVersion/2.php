<?php

// test StateContactService.php
require_once 'StateContactService.php';
require_once 'ContactRepository.php';

function test1() {
    $state = (new StateContactService())->getState();
    var_dump($state);
}
test1();
