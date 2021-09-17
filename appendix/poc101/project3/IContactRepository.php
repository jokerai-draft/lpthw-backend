<?php

interface IContactRepository
{
    public function getAll();
    public function save($payload);
    public function update($payload);
    public function delete($id);

    public function getById($id);

    public function reset();
}

// 参考
// https://www.php.net/manual/zh/language.oop5.interfaces.php
// https://tutorials.supunkavinda.blog/php/oop-inheritance
