<?php declare(strict_types=1);

require 'autoload.php';

Assembled1::init();

Assembled1::$databag['age'] = 120;

// $document1->getView();
// $document1->render();

Assembled1::perform();


/*
http://localhost:8000/document1.php
http://localhost:8000/document1.php?name=tom
http://localhost:8000/document1.php"><script>alert(‘xss’);</script>

http://localhost:8000/document1.php?name=tom&keyword=you"><script>alert('XSS');</script>
*/
