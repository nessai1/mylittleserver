<?php
//spl_autoload_register(static function ($namespace) {
//	$namespace = strtolower(str_replace('\\', '/', $namespace));
//	require_once $_SERVER['DOCUMENT_ROOT'] . "/../src/{$namespace}.php";
//});

require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';

static $applicationInit = false;
if (!$applicationInit)
{
	$applicationInit = true;
	\WebLab\Core\Application::initApplication();
}