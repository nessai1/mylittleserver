<?php

require_once __DIR__ . '/autoload.php';

$_ENV['database'] = [
	'host' => 'mysql',
	'username' => 'mylittleuser',
	'password' => 'mylittlepassword',
	'database' => 'mylittleserver',
];

$_ENV['integration_resources'] = [
	'google_tables' => [
		'key' => 'AIzaSyAxBQpgXzhM3NrGHTSt1K5_u56Pp2ZsvhU',
	]
];