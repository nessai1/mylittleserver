<?php
spl_autoload_register(static function ($namespace) {
	$namespace = strtolower(str_replace('\\', '/', $namespace));
	require_once $_SERVER['DOCUMENT_ROOT'] . "/../src/{$namespace}.php";
});

static $configLoaded = false;
static $applicationUpdated = false;

if (!$configLoaded)
{
	$configLoaded = true;
	require_once __DIR__ . '/config.php';
}

if (!$applicationUpdated)
{
	$applicationUpdated = true;
	require_once __DIR__ . '/updater.php';
}