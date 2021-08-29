<?php

interface IContactRepository
{
    public function getContacts();
    public function save($payload);
    public function update($payload);
    public function delete($id);

    public function getContactById($id);

    public function reset();
}

// 参考
// https://www.php.net/manual/zh/language.oop5.interfaces.php
// https://tutorials.supunkavinda.blog/php/oop-inheritance
