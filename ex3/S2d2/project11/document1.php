<?php declare(strict_types=1);

require 'autoload.php';
session_start();

$URLParser = new URLParser();
$URLParser->route();
