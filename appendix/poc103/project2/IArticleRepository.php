<?php

interface IArticleRepository
{
    public function getAll();
    public function save($payload);
    public function update($payload);
    public function delete($id);

    public function getById($id);
    // $entity = ['title' => '-1', 'body' => '-1', 'user_id' => '-1', 'id'=>-1];

    public function reset();
}

// 参考
// https://www.php.net/manual/zh/language.oop5.interfaces.php
// https://tutorials.supunkavinda.blog/php/oop-inheritance
