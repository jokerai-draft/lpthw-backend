<?php

interface IAssembled
{
    public function performIn($payload);

    public function performOut($view);
}

// 参考
// https://www.php.net/manual/zh/language.oop5.interfaces.php
// https://tutorials.supunkavinda.blog/php/oop-inheritance
