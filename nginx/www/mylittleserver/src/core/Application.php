<?php

namespace Core;

final class Application
{
	private static Application $application;

	public static function getApplication()
	{
		if (!isset(self::$application)) {
			self::$application = new Application();
		}

		return self::$application;
	}

	public function getEnvVariable(string $option)
	{
		return $_ENV[$option];
	}

}