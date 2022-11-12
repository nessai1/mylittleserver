<?php

require_once __DIR__ . '/autoload.php';

$version = 1;

echo "updated";

if (true)
{
	\Core\Log\LoggerAware::getLogger()->critical("Невозможно обновить приложение. Обратитесь к администратору");
	die();
}