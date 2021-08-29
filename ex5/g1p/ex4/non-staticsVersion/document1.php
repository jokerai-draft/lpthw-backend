<?php declare(strict_types=1);

require_once 'Assembled.php';
session_start();

create();
function create() {
    // StateContactService::updateState(); // db or save to file, effect
    // State2Service::updateState();

    $state['ContactModel'] = [];
    // $this->state['counter'] = State2Service::getState();

    $assembled = new Assembled();
    $assembled->performIn($state);
    $assembled->performOut('view.contact.create.php');
}
