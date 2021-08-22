<?php
spl_autoload_register(function($className) {
	$baseDir = __DIR__;
	$file = '\\' . $className . '.php';
	$file = $baseDir . str_replace('\\', DIRECTORY_SEPARATOR, $file);
	if (file_exists($file)) {
		include $file;
	}
});

// https://tutorials.supunkavinda.blog/php/oop-autoloading
