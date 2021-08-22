<?php declare(strict_types=1);

require 'autoload.php';

$document1 = new Assembled1();

$document1->databag['age'] = 120;

// $document1->getView();
// $document1->render();

$document1->perform();


/*
http://localhost:8000/document1.php
http://localhost:8000/document1.php?name=tom
http://localhost:8000/document1.php"><script>alert(‘xss’);</script>

http://localhost:8000/document1.php?name=tom&keyword=you"><script>alert('XSS');</script>
*/
