<?php

require_once __DIR__ . '/autoload.php';

echo "loaded";

$_ENV['DATABASE'] = [
	'host' => 'mysql',
	'user' => 'root',
	'password' => '',
	'database' => 'ovito',
];