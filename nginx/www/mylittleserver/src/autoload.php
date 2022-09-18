<?php

spl_autoload_register(static function ($namespace) {
	$namespace = strtolower(str_replace('\\', '/', $namespace));
	require_once $_SERVER['DOCUMENT_ROOT'] . "/../src/{$namespace}.php";
});