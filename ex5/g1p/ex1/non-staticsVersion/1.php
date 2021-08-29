<?php

// test ContactRepository.php
require_once 'ContactRepository.php';

function test1() {
    $id = 2;
    $arr1 = (new ContactRepository())->getContactById($id);
    var_dump($arr1);
}
function test2() {
    $arr1 = (new ContactRepository())->getContacts();
    var_dump($arr1);
}
function test3() {
    $arr1 = (new ContactRepository())->getContacts();
    var_dump($arr1);
    echo "\n" . '---' . "\n";
    $contact2 = ['name' => 'Billy', 'phone' => '510-422-6710', 'email' => 'bill@gmail.com', 'id' => 2, ];
    (new ContactRepository())->update($contact2);
    $arr1 = (new ContactRepository())->getContacts(); // get the newest data
    var_dump($arr1);
}
function test4() {
    $arr1 = (new ContactRepository())->getContacts(); // get the newest data
    var_dump($arr1);
    $contact = ['name' => 'Zion', 'phone' => '910-422-3101', 'email' => 'zion@gmail.com', ];
    // (new ContactRepository())->save($contact);
    (new ContactRepository())->getContacts();
}
function test5() {
    (new ContactRepository())->reset();
    $arr1 = (new ContactRepository())->getContacts(); // get the newest data
    var_dump($arr1);
    echo "\n" . '---' . "\n";
    $contact1 = ['name' => 'Zion', 'phone' => '910-422-3101', 'email' => 'zion@gmail.com', ];
    $contact2 = ['name' => 'Iron Man', 'phone' => '310-312-3101', 'email' => 'ironman@gmail.com', ];
    (new ContactRepository())->save($contact1);
    (new ContactRepository())->save($contact2);
    var_dump((new ContactRepository())->getContacts());
}
test5();
